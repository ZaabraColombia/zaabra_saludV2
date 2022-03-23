@extends('paciente.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf" id="basic-table">
            <div class="my-4 my-xl-5">
                <h1 class="title_miCita">Mis pagos</h1>
                <span class="subtitle_miCita">Encuentre aquí los pagos realizados por cada una de sus citas.</span>
            </div>

            <!-- Contenedor barra de búsqueda pagos -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-9 p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar Pagos">
                    </div>
                </div>
            </div>

            <!-- Contenedor formato tabla de la lista de pagos -->
            <div class="containt_main_table mb-3">
                <div class="table-responsive">
                    <table class="table table_agenda" id="table-pagos">
                        <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Tipo de cita</th>
                            <th>Valor</th>
                            {{--<th></th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @if($pagos->isNotEmpty())
                            @foreach($pagos as $pago)
                                <tr>
                                    <td>{{ $pago->fecha->format('d-m-Y') }}</td>
                                    <td>{{ $pago->fecha->format('H:i a') }}</td>
                                    <td>{{ $pago->cita->tipo_consulta->nombreconsulta }}</td>
                                    <td>${{ number_format($pago->valor, 0, ",", ".") }}</td>
                                    {{-- <td class="content_btn_descargar">                         --}}
                                    {{--     <button class="btn_descargar_pago">                    --}}
                                    {{--         Descargar&nbsp;<i class="fas fa-download"></i>     --}}
                                    {{--     </button>                                              --}}
                                    {{-- </td>                                                      --}}
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
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
            columnDefs: [
                {
                    targets: [-1],
                    orderable: false,
                }
            ]
        });

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });
    </script>
@endsection
