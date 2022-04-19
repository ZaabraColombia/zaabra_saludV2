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
                <h1 class="title__xl green_bold">Mis Convenios</h1>
            </div>

            <!-- Contenedor barra de búsqueda y botón agregar contacto -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-9 p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar Convenio" />
                    </div>

                    <div class="col-md-3 p-0 content_btn_right">
                        <a href="{{ route('institucion.configuracion.convenios.create') }}" class="button_green" id="btn-agregar-contacto">
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
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Tipo de empresa</th>
                            <th>Teléfonos</th>
                            <th>Correo</th>
                            <th class="text-center">Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($convenios->isNotEmpty())
                            @foreach($convenios as $convenio)
                                <tr>
                                    <td>{{ $convenio->codigo_convenio }}</td>
                                    <td>
                                        <span>{{ $convenio->nombre_completo }}</span> <br>
                                        {{--<span>EPS</span>--}}
                                    </td>
                                    <td>
                                        <span>{{ $convenio->tipo_establecimiento }}</span>
                                    </td>
                                    <td>
                                        <span>{{ "{$convenio->telefono} - {$convenio->celular}" }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $convenio->correo }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">

                                            @can('accesos-institucion','ver-convenios')
                                                <button class="btn_action_green tool top boton-convenio" style="width: 33px"
                                                        data-url="{{ route('institucion.configuracion.convenios.show', ['convenio' => $convenio->id]) }}">
                                                    <i data-feather="eye"></i> <span class="tiptext">Ver convenio</span>
                                                </button>
                                            @endcan

                                            @can('accesos-institucion','editar-convenio')
                                                <a class="btn_action_green tool top" style="width: 33px"
                                                   href="{{ route('institucion.configuracion.convenios.edit', ['convenio' => $convenio->id]) }}">
                                                    <i data-feather="edit"></i> <span class="tiptext">Editar convenio</span>
                                                </a>
                                            @endcan

                                            {{--<a class="btn_action_green tool top" style="width: 33px"
                                               href="">
                                                <i data-feather="settings"></i> <span class="tiptext">Configurar convenio</span>
                                            </a>--}}
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

    <!-- Modal Ver Convenio -->
    <div class="modal fade" id="modal-convenio">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Mantener las cases "label-*" -->
                <div class="modal-body">
                    <h1 style="color: #019F86">Ver Convenio</h1>

                    <div class="content__see_contacs" style="background-color: #6eb1a6">
                        <img class="img__see_contacs" id="foto" src=''>
                    </div>

                    <div class="content__border_see_contacs" style="background-color: #6eb1a6"></div>

                    <div class="modal_info_cita pt-5">
                        <h4 class="fs_subtitle green_light" style="border-bottom: 2px solid #6eb1a6;">Información básica</h4>
                        <div class="row mb-2">
                            <div class="col-lg-6 info_contac">
                                <h4>Nombre:</h4>
                                <span id="nombre_completo"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span id="mascara_identificacion"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Código del prestador del servicio:</h4>
                                <span id="sgsss"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Código del convenio:</h4>
                                <span id="codigo_convenio"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Tipo del contribuyente:</h4>
                                <span id="tipo_contribuyente"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Actividad económica:</h4>
                                <span id="actividad_economica"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Forma de pago:</h4>
                                <span id="forma_pago"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Tipo de convenio:</h4>
                                <span id="tipo_convenio"></span>
                            </div>
                        </div>

                        <h4 class="fs_subtitle green_light" style="border-bottom: 2px solid #6eb1a6;">Información de contacto</h4>
                        <div class="row mb-2">
                            <div class="col-lg-6 info_contac">
                                <h4>Tipo de establecimiento:</h4>
                                <span id="tipo_establecimiento"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Dirección:</h4>
                                <span id="direccion">Cll 00 # 00 - 00</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Código postal</h4>
                                <span id="codigo_postal"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>País:</h4>
                                <span id="pais"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Departamento:</h4>
                                <span id="departamento"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Provincia:</h4>
                                <span id="provincia"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Ciudad:</h4>
                                <span id="ciudad"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Teléfonos:</h4>
                                <span id="telefono"></span> -
                                <span id="celular"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Correo:</h4>
                                <span id="correo"></span>
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

        //ver convenio
        $('.boton-convenio').click(function (event) {
            var btn = $(this);

            $.get(btn.data('url'), function (response) {
                console.log(response);

                $.each(response.item, function (key, item) {
                    if (key !== 'foto') $('#' + key).html(item);
                    if (key === 'foto') $('#' + key).attr('src', item);
                });
                // $('#accesos-lista').html('');
                // $.each(response.item.accesos, function (key, item) {
                //     $('#accesos-lista').append('<div class="col-md-6 col-lg-4 d-flex pl-0 info_contac">'
                //         + '<i data-feather="check-circle" style="color: #0083D6;" width="17"></i>'
                //         + '<span class="pl-2">' + item.nombre + '</span>'
                //         + '</div>');
                // });
                //
                // feather.replace();
                $('#modal-convenio').modal();
            }, "json").fail(function (error) {
                console.log(error);
            });
        });
    </script>
@endsection
