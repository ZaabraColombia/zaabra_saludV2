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
                <h1 class="title__xl green_bold">Mis Usuarios</h1>
            </div>

            <!-- Contenedor barra de búsqueda y botón agregar contacto -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-9 p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar usuario">
                    </div>

                    <div class="col-md-3 p-0 content_btn_right">
                        <a href="" class="button_green" id="btn-agregar-contacto">
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
                            <th>Identificación</th>
                            <th>E-mail</th>
                            <th>Roles</th>
                            <th>Estado</th>
                            <th class="text-center">Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nombre Apellido</td>
                                <td>
                                    <span>0 000 000 000</span>
                                </td>
                                <td>
                                    <span>ejemplo@.com</span>
                                </td>
                                <td>Roll 1</td>
                                <td>Estado 1</td>
                                <td>
                                    <div class="d-flex justify-content-around px-3">
                                        <a class="btn_action_green tool top" style="width: 33px"
                                            href="" data-target="#modal_see_user" data-toggle="modal">
                                            <i data-feather="eye"></i> <span class="tiptext">Ver usuario</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ver user -->
    <div class="modal fade" id="modal_see_user">
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
                                <span>Nombre 1 Nombre 2</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Apellidos:&nbsp;</span>
                                <span>Apellido 1 Apellido 2</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Cc&nbsp;</span>
                                <span>0000000000</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Fecha de nacimiento:&nbsp;</span>
                                <span>dd - mm - aaaa</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Teléfonos:&nbsp;</span>
                                <span>000 0000 000</span> -
                                <span>000 0000</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Correo:&nbsp;</span>
                                <span>ejemplo@.com</span>
                            </div>
                            
                            <div class="col-lg-6 info_contac">
                                <span>Dirección:&nbsp;</span>
                                <span>Cll 00 # 00 - 00</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Ciudad:&nbsp;</span>
                                <span>Ciudad 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Provincia:&nbsp;</span>
                                <span>Provincia 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Departamento:&nbsp;</span>
                                <span>Departamento 1</span>
                            </div>
                        </div>

                        <h4 class="fs_subtitle green_light" style="border-bottom: 2px solid #6eb1a6;">Accesos del usuario</h4>
                        <div class="row m-0 mb-2">
                            <div class="col-md-6 col-lg-4 d-flex pl-0 info_contac">
                                <i data-feather="check-circle" style="color: #0083D6;" width="17"></i>
                                <span class="pl-2">Acceso 1</span>
                            </div>

                            <div class="col-md-6 col-lg-4 d-flex pl-0 info_contac">
                                <i data-feather="check-circle" style="color: #0083D6;" width="17"></i>
                                <span class="pl-2">Acceso 2</span>
                            </div>

                            <div class="col-md-6 col-lg-4 d-flex pl-0 info_contac">
                                <i data-feather="check-circle" style="color: #0083D6;" width="17"></i>
                                <span class="pl-2">Acceso 3</span>
                            </div>

                            <div class="col-md-6 col-lg-4 d-flex pl-0 info_contac">
                                <i data-feather="check-circle" style="color: #0083D6;" width="17"></i>
                                <span class="pl-2">Acceso 4</span>
                            </div>

                            <div class="col-md-6 col-lg-4 d-flex pl-0 info_contac">
                                <i data-feather="check-circle" style="color: #0083D6;" width="17"></i>
                                <span class="pl-2">Acceso 5</span>
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