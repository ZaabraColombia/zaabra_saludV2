@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset(' plugins/DataTables/Responsive-2.2.9/css/responsive.bootstrap.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="panel_head_op2">
            <!-- Main title -->
            <div class="mb-4">
                <h1 class="txt_title_panel_head">Historico de citas</h1>
                <h2 class="txt_subtitle_panel_head">Encuentre aquí las citas agendadas por sus pacientes.</h2>
            </div>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Search bar -->
                <div class="col-md-6 p-0 mb-4 button__search_card">
                    <form method="get">
                        <button id="search" type="button" class="{{ (request('search')) ? 'search_togggle':'' }}">
                            <input class="mb-0" type="search" name="search" id="search" placeholder="Buscar" value="{{ request('search') }}">
                        </button>
                    </form>
                </div>
                <!-- Document action buttons  -->
                <div class="col-md-4 p-0 mb-4 justify-content-md-end button__doc_download">
                    <button class="file_calendar"></button>
                    <button class="file_excel"></button>
                    <button class="file_pdf"></button>
                    <button class="file_printer"></button>
                </div>
                <!-- Pagination buttons -->
                <div class="col-md-2 p-0 mb-4 d-none d-md-flex butons__pagination_card">
                    <button class="btn_right_pag_card"></button>
                    <button class="btn_left_pag_card"></button>
                </div>
            </div>
        </div>

        <div class="panel_body_op2">
            <!-- Contenedor formato tabla de la lista de pacientes -->
            <div class="containt_main_table mb-3">
                {{--
                <div class="col-md-4 col-xl-3 p-0 input__box">
                    <label for="date"><b>Filtrar por fecha</b></label>
                    <input type="date" id="date" class="form-control"/>
                </div>
                --}}

                <table class="table display responsive nowrap" style="width: 100%" id="table-citas">
                    <thead class="thead_green">
                        <tr>
                            <th>Hora cita</th>
                            <th>Fecha de cita</th>
                            <th>Especialidad</th>
                            <th>Profesional</th>
                            <th>Paciente</th>
                            <th>Identificación</th>
                            <th>Lugar</th>
                            <th>Celular</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
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
    <script src="{{ asset('plugins/DataTables/DateTime-1.1.2/js/dataTables.dateTime.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment-with-locales.min.js') }}"></script>
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>--}}
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/datetime-moment.js"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        $(document).ready( function () {

            $.fn.dataTable.moment( 'DD-MM / YYYY', 'es');
            $.fn.dataTable.moment( 'HH:mm A \- HH:mm A', 'es');


            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var dateS = $('#date').val();
                var startDate = moment(data[0], 'DD-MM / YYYY');

                if (dateS == null || dateS === '') return true;
                return startDate.format('YYYY-MM-DD') === dateS;
            });

            //Inicializar tabla
            var table = $('#table-citas').DataTable({
                bFilter: false,
                bInfo: false,
                responsive: true,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                dom: 'lfBrtip',
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        className: 'red',
                        title:'Resultados',
                        exportOptions: {
                            //columns: ":not(:last-child)",
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
                        title: 'Resultados',
                        exportOptions: {
                            //columns: ":not(:last-child)",
                        },
                    },
                ],
                searching: true,
                columnDefs: [
                    {
                        targets: [-1],
                        orderable: false,
                    }
                ],
                columns:[
                    {data: "hora", name: "fecha_inicio"},
                    {data: "fecha", name: "fecha_inicio"},
                    {data: "especialidad.nombreEspecialidad", name: "especialidad.nombreEspecialidad"},
                    {data: "profesional_ins.nombre_completo", name: 'profesional_ins.nombre_completo'},
                    {data: "paciente.user.nombre_completo", name: 'paciente.user.nombre_completo'},
                    {data: "paciente.user.numerodocumento", name: 'paciente.user.numerodocumento'},
                    {data: "lugar", name: "lugar"},
                    {data: "paciente.celular", name: "paciente.celular"},
                    {data: "estado", name: "estado"},
                ],
                serverSide: true,
                ajax:{
                    type: 'post',
                    url: '{{ route('institucion.citas.lista-citas') }}',
                },
            });

            $("#search").on('keyup change',function(){
                var texto = $(this).val();
                table.search(texto).draw();
            });
            $("#date").on('change',function(){
                table.draw();
            });
        });
    </script>

    <!-- Script barra de búsqueda desplegable -->
    <script>
        $('#search').on('click', function () {
            $('#search').addClass('search_togggle');
        });
    </script>
@endsection
