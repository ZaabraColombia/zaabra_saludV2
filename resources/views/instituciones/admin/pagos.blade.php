@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="panel_head_op2">
            <!-- Main title -->
            <div class="mb-4">
                <h1 class="txt_title_panel_head color_green">Pagos</h1>
                <h2 class="txt_subtitle_panel_head">Encuentre aquí los pagos realizados por cada una de sus citas.</h2>
            </div>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Search bar -->
                <div class="col-md-6 col-lg-5 col-xl-5 mr-lg-auto button__search_card">
                    <form method="get">
                        <button id="search" type="button" class="icon__search_green {{ (request('search')) ? 'search_togggle':'' }}">
                            <input class="mb-0" type="search" name="search" id="search" placeholder="Buscar" value="{{ request('search') }}">
                        </button>
                    </form>
                </div>
                <!-- Document action buttons  -->
                <div class="col-md-4 ml-md-auto col-lg-auto button__doc_download">
                    <button class="file_calendar"></button>
                    <button class="file_excel"></button>
                    <button class="file_pdf"></button>
                    <button class="file_printer"></button>
                </div>
            </div>
        </div>

        <div class="panel_body_op2 mt-4">
            <div class="containt_main_table mb-3">
                <div class="table-responsive">
                    <table class="table table_agenda" id="table-pagos">
                        <thead class="thead_green">
                            <tr>
                                <th>Nombre paciente</th>
                                <th>Nombre profesional</th>
                                <th>Especialidad</th>
                                <th>Lugar de atención</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Valor</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($pagos->isNotEmpty())
                                @foreach($pagos as $pago)
                                    <tr>
                                        <td>{{ $pago->cita->paciente->user->nombre_completo ?? ''}}</td>
                                        <td>{{ $pago->cita->profesional_ins->nombre_completo ?? ''}}</td>
                                        <td>{{ $pago->cita->especialidad->nombreEspecialidad ?? ''}}</td>
                                        <td>{{ $pago->cita->lugar ?? ''}}</td>
                                        <td>{{ ($pago->aprobado) ? 'Aprobado':'Por pagar' }}</td>
                                        <td>{{ $pago->fecha->format('d-m /Y') }}</td>
                                        <td>${{ number_format($pago->valor, 0, ",", ".") }}</td>
                                        <!-- <td class="content_btn_descargar">

                                        </td> -->
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pagination buttons -->
            <div class="col-12 d-md-none p-0 mt-4 butons__pagination_card">
                <button class="btn_right_pag_card"></button>
                <button class="btn_left_pag_card"></button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        //Inicializar tabla
        var table = $('#table-pagos').DataTable({
            bFilter: false,
            bInfo: false,
            response: true,
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            searching: true,
            dom: 'lfBrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    className: 'red',
                    title:'Resultados',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    },
                    //text: 'Red',
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'border_left',
                    title:function () {
                        return 'Resultados';
                    }
                },
            ],
        });

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });
    </script>

    <!-- Script barra de búsqueda desplegable -->
    <script>
        $('#search').on('click', function () {
            $('#search').addClass('search_togggle');
        });
    </script>
@endsection
