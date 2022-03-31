@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
        <section class="section pr-lg-4">
            <div class="row containt_agendaProf mb-3" id="basic-table">
                <div class="col-12 p-0">
                    <div class="my-4 my-xl-5">
                        <h1 class="title__xl green_bold">Pagos</h1>
                        <span class="text__md black_light">Encuentre aquí los pagos realizados por cada una de sus citas.</span>
                    </div>

                    <!-- Contenedor barra de búsqueda -->
                    <div class="containt_main_table mb-3">
                        <div class="row m-0">
                            <div class="col-md-9 p-0 input__box mb-0">
                                <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar pagos">
                            </div>
                        </div>
                    </div>

                    <div class="containt_main_table mb-3">
                        <div class="table-responsive">
                            <table class="table table_agenda" id="table-pagos">
                                <thead class="thead_green">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Especialidad</th>
                                        <th>Lugar de atención</th>
                                        <th>Estado</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {{--@if($pagos->isNotEmpty())
                                        @foreach($pagos as $pago)
                                            <tr>
                                                <td>{{ $pago->fecha->format('d-m /Y') }}</td>
                                                <td>{{ $pago->cita->tipo_consulta->nombreconsulta ?? ''}}</td>
                                                <td>{{ $pago->cita->paciente->user->nombre_completo ?? ''}}</td>
                                                <td>{{ ($pago->aprobado) ? 'Aprobado':'Por pagar' }}</td>
                                                <td>${{ number_format($pago->valor, 0, ",", ".") }}</td>
                                                <!-- <td class="content_btn_descargar">

                                                </td> -->
                                            </tr>
                                        @endforeach
                                    @endif --}}
                                    <tr>
                                        <td>Nombre 1</td>
                                        <td>Especialidad 1</td>
                                        <td>Lugar atención 1</td>
                                        <td>Estado 1</td>
                                        <td>Valor 1</td>
                                    </tr>

                                    <tr>
                                        <td>Nombre 2</td>
                                        <td>Especialidad 2</td>
                                        <td>Lugar atención 2</td>
                                        <td>Estado 2</td>
                                        <td>Valor 2</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
        });

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });
    </script>
@endsection
