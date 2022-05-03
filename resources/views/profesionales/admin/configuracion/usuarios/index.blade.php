@extends('profesionales.admin.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid p-0 pr-lg-4">
        <div class="containt_agendaProf">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl blue_bold">Mis Usuarios</h1>
            </div>

            <!-- Contenedor barra de búsqueda y botón agregar contacto -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-9 p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar usuario">
                    </div>

                    <div class="col-md-3 p-0 content_btn_right">
                        <a href="{{ route('profesional.configuracion.usuarios.create') }}" class="button_blue" id="btn-agregar-contacto">
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
                        <thead class="thead_blue">
                        <tr>
                            <th>Nombre</th>
                            <th>Identificación</th>
                            <th>E-mail</th>
                            <th>Estado</th>
                            <th class="text-center">Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($usuarios->isNotEmpty())
                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->nombre_completo }}</td>
                                    <td>{{ "{$usuario->tipo_documento->nombre_corto} {$usuario->numerodocumento}" }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ ($usuario->estado) ? 'Activado':'Desactivado' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around px-3">

                                            <button class="btn_action  tool top modal-usuario" style="width: 33px"
                                                    data-url="{{ route('profesional.configuracion.usuarios.show', ['usuario' => $usuario->id]) }}">
                                                <i data-feather="eye"></i> <span class="tiptext">Ver usuario</span>
                                            </button>
                                            <a class="btn_action  tool top" style="width: 33px"
                                               href="{{ route('profesional.configuracion.usuarios.edit', ['usuario' => $usuario->id]) }}">
                                                <i data-feather="edit"></i> <span class="tiptext">Editar usuario</span>
                                            </a>
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

    <!-- Modal Ver user -->
    <div class="modal fade" id="modal_ver_usuario">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Mantener las cases "label-*" -->
                <div class="modal-body">
                    <h1 class="mb-3" style="color: #019F86">Ver Usuario</h1>

                    <div class="content__border_see_contacs" style="background-color: #6eb1a6"></div>

                    <div class="modal_info_cita pt-3 px-2">
                        <h4 class="fs_subtitle green_light" style="border-bottom: 2px solid #6eb1a6;">Información básica</h4>
                        <div class="row mb-2">
                            <div class="col-lg-6 info_contac">
                                <span>Nombres:&nbsp;</span>
                                <span id="nombres">Nombre 1 Nombre 2</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Apellidos:&nbsp;</span>
                                <span id="apellidos">Apellido 1 Apellido 2</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span id="numero_identificacion"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Fecha de nacimiento:&nbsp;</span>
                                <span id="fecha_nacimineto"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Teléfonos:&nbsp;</span>
                                <span id="telefonos"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Correo:&nbsp;</span>
                                <span id="correo"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Dirección:&nbsp;</span>
                                <span id="direccion"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>País:&nbsp;</span>
                                <span id="pais"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Departamento:&nbsp;</span>
                                <span id="departamento"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Provincia:&nbsp;</span>
                                <span id="provincia"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Ciudad:&nbsp;</span>
                                <span id="ciudad"></span>
                            </div>


                        </div>

                        <h4 class="fs_subtitle green_light" style="border-bottom: 2px solid #6eb1a6;">Accesos del usuario</h4>
                        <div class="row m-0 mb-2" id="accesos-lista">
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

        // $('.modal-usuario').click(function (event) {
        //     var btn = $(this);
        //
        //     $.get(btn.data('url'), function (response) {
        //         console.log(response);
        //
        //         $.each(response.item, function (key, item) {
        //             if (key !== 'accesos') $('#' + key).html(item);
        //         });
        //         $('#accesos-lista').html('');
        //         $.each(response.item.accesos, function (key, item) {
        //             $('#accesos-lista').append('<div class="col-md-6 col-lg-4 d-flex pl-0 info_contac">'
        //                 + '<i data-feather="check-circle" style="color: #019F86;" width="17"></i>'
        //                 + '<span class="pl-2">' + item.nombre + '</span>'
        //                 + '</div>');
        //         });
        //
        //         feather.replace();
        //         $('#modal_ver_usuario').modal();
        //     }, "json").fail(function (error) {
        //         console.log(error);
        //     });
        // });
    </script>
@endsection
