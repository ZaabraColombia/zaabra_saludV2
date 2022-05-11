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
                <div class="col-12">
                    @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading">Hecho!</h4>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table_agenda" id="table-pacientes">
                        <thead class="thead_green">
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo de servicio</th>
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
                                    <td>{{ $servicio->tipo_servicio->nombre ?? '' }}</td>
                                    <td>${{ number_format($servicio->valor, 0, ',', '.') }}</td>
                                    <td>{{ $servicio->especialidad->nombreEspecialidad }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around px-3">

                                            @can('accesos-institucion','ver-servicios')
                                                <a class="btn_action_green tool top boton-servicio" style="width: 33px"
                                                   data-url="{{ route('institucion.configuracion.servicios.show', ['servicio' => $servicio->id]) }}">
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
    <div class="modal fade" id="modal-servicio">
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
                                <span id="duracion"></span>
                            </div>

                            <div class="col-lg-4 info_contac mb-lg-2">
                                <span>Descanso (minuto):&nbsp;</span>
                                <span id="descanso"></span>
                            </div>

                            <div class="col-lg-4 info_contac mb-lg-2">
                                <span>Valor:&nbsp;</span>
                                <span id="valor"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Nombre:</h4>
                                <span id="nombre"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Especialidad:</h4>
                                <span id="especialidad"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Tipo del servicio:</h4>
                                <span id="tipo_servicio">Tipo del servicio 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>CUPS:</h4>
                                <span id="cup">CUPS - 00000 111</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Número de citas activas del paciente:</h4>
                                <span id="citas_activas">000</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Tipo de atención:</h4>
                                <span id="tipo_atencion"></span>
                            </div>

                            <div class="col-12 info_contac mt-lg-2">
                                <h4>Descripción:</h4>
                                <span id="descripcion"></span>
                            </div>
                        </div>

                        <h4 class="fs_subtitle green_light" style="border-bottom: 2px solid #6eb1a6;">Convenios vinculados</h4>
                        <div id="convenios-lista">
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

        //ver servicios
        $('.boton-servicio').click(function (event) {
            var btn = $(this);

            $.get(btn.data('url'), function (response) {
                console.log(response);

                $.each(response.item, function (key, item) {
                    if (key !== 'convenios') $('#' + key).html(item);
                });

                $('#convenios-lista').html('');
                $.each(response.item.convenios_lista, function (key, item) {
                    $('#convenios-lista').append('<div class="row mb-2">' +
                        '<div class="col-12 info_contac d-lg-flex">' +
                        '<h4>Nombre del convenio:&nbsp;</h4>' +
                        '<span>' + item.nombre_completo + '</span>' +
                        '</div>' +

                        '<div class="col-lg-6 info_contac">' +
                        '<span>Pago convenio:</span>' +
                        '<span>$' + item.pivot.valor_convenio + '</span>' +
                        '</div>' +

                        '<div class="col-lg-6 info_contac">' +
                        '<span>Pago paciente</span>' +
                        '<span>$' + item.pivot.valor_paciente + '</span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="dropdown-divider my-2" style="height:3px; background-color: #6eb1a6"></div>'
                    );
                });

                $('#modal-servicio').modal();
            }, "json").fail(function (error) {
                console.log(error);
            });
        });
    </script>
@endsection
