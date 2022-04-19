@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl green_bold">Mis Servicios</h1>
            </div>

            <!-- Contenedor barra de búsqueda y botón agregar contacto -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-9 p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar Servicio">
                    </div>

                    <div class="col-md-3 p-0 content_btn_right">
                        <a href="{{ route('institucion.configuracion.servicios.create') }}" class="button_green" id="btn-agregar-contacto">
                            Agregar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contenedor formato tabla de la lista de contactos -->
            <div class="containt_main_table mb-3">
                <div class="table-responsive">
                    <table class="table table_agenda" id="table-pacientes">
                        <thead class="thead_green">
                        <tr>
                            <th>Nombre</th>
                            <th>Valor</th>
                            <th>Especialidad</th>
                            <th class="text-center">Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($servicios->isNotEmpty())
                            @foreach($servicios as $servicio)
                                <tr>
                                    <td>{{ $servicio->nombre }}</td>
                                    <td>{{ $servicio->valor }}</td>
                                    <td>{{ $servicio->especialidad->nombreEspecialidad }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around px-3">

                                            @can('accesos-institucion','ver-servicios')
                                                <a class="btn_action_green tool top" style="width: 33px"
                                                   href="" data-target="#modal_ver_servicio" data-toggle="modal">
                                                    <i data-feather="eye"></i> <span class="tiptext">Ver servicio</span>
                                                </a>
                                            @endcan

                                            @can('accesos-institucion','editar-servicio')
                                                <a class="btn_action_green tool top" style="width: 33px"
                                                   href="{{ route('institucion.configuracion.servicios.edit', ['servicio' => $servicio->id]) }}">
                                                    <i data-feather="edit"></i> <span class="tiptext">Editar servicio</span>
                                                </a>
                                            @endcan

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ver Servicio -->
    <div class="modal fade" id="modal_ver_servicio">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Mantener las cases "label-*" -->
                <div class="modal-body">
                    <h1 style="color: #019F86">Ver Servicio</h1>

                    <div class="content__border_see_contacs" style="background-color: #6eb1a6"></div>

                    <div class="modal_info_cita pt-4">
                        <div class="row mb-2">
                            <div class="col-lg-4 info_contac mb-lg-2">
                                <span>Duración (minuto):&nbsp;</span>
                                <span>000</span>
                            </div>

                            <div class="col-lg-4 info_contac mb-lg-2">
                                <span>Descanso (minuto):&nbsp;</span>
                                <span>000</span>
                            </div>

                            <div class="col-lg-4 info_contac mb-lg-2">
                                <span>Valor:&nbsp;</span>
                                <span>000.000.00</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Nombre:</h4>
                                <span>Nombre 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Especialidad:</h4>
                                <span>Especialidad 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Tipo del servicio:</h4>
                                <span>Tipo del servicio 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>CUPS:</h4>
                                <span>CUPS - 00000 111</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Número de citas activas del paciente:</h4>
                                <span>000</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Metodo:</h4>
                                <span>Metodo 1</span>
                            </div>

                            <div class="col-12 info_contac mt-lg-2">
                                <h4>Descripción:</h4>
                                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, debitis. Veritatis vitae. 
                                    Corporis distinctio voluptatem illo reprehenderit minima voluptates esse obcaecati tempore doloribus. 
                                    Laboriosam adipisci iure eaque? Ab ut excepturi delectus.
                                </span>
                            </div>
                        </div>

                        <h4 class="fs_subtitle green_light">Convenios vinculados</h4>
                        <div class="row mb-2">
                            <div class="col-12 info_contac d-lg-flex">
                                <h4>Nombre del convenio:&nbsp;</h4>
                                <span>Tipo de establecimiento 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Pago convenio:</span>
                                <span>$&nbsp;000.000</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Pago paciente</span>
                                <span>$&nbsp;000.000</span>
                            </div>
                        </div>

                        <!-- Linea división de elementos -->
                        <div class="dropdown-divider my-2" style="height:3px; background-color: #6eb1a6"></div>

                        <div class="row mb-2">
                            <div class="col-12 info_contac d-lg-flex">
                                <h4>Nombre del convenio:&nbsp;</h4>
                                <span>Tipo de establecimiento 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Pago convenio:</span>
                                <span>$&nbsp;000.000</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Pago paciente</span>
                                <span>$&nbsp;000.000</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <script>
        // Inicializar iconos data-feather
        feather.replace()
    </script>

    <script>
        //Inicializar tabla
        var table = $('#table-pacientes').DataTable({
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
            ],
            paging: true,

        });

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });
    </script>
@endsection
