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
                <h1 class="title__xl blue_bold">Mis Profesionales</h1>
            </div>

            <!-- Contenedor barra de búsqueda y botón agregar contacto -->
            <div class="containt_main_table mb-3">
                <div class="row m-0">
                    <div class="col-md-9 p-0 input__box mb-0">
                        <input class="mb-md-0" type="search" name="search" id="search" placeholder="Buscar Paciente">
                    </div>

                    <div class="col-md-3 p-0 content_btn_right">
                        <button type="button" class="button_blue" id="btn-agregar-contacto">
                            Agregar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Contenedor formato tabla de la lista de contactos -->
            <div class="containt_main_table mb-3">
                <div class="table-responsive">
                    <table class="table table_agenda" id="table-pacientes">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Especialidad</th>
                                <th>Correo</th>
                                <th>Teléfonos</th>
                                <th>Dirección</th>
                                <th class="text-right">Acción</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="pr-0">
                                    <div class="user__xl">
                                        <div class="pr-2">
                                            <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                        </div>

                                        <div>
                                            <span>Jesus Antonio Robles Torres</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologo</td>
                                <td>jesusa@hotmail.com</td>
                                <td>300 1245 3245 - 456 2365</td>
                                <td>Cra 43 # 65 - 45 sur</td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="" target="_blank">
                                        <i data-feather="external-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="">
                                        <i data-feather="calendar"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <div class="user__xl">
                                        <div class="pr-2">
                                            <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                        </div>

                                        <div>
                                            <span>Jesus Antonio Robles Torres</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologo</td>
                                <td>jesusa@hotmail.com</td>
                                <td>300 1245 3245 - 456 2365</td>
                                <td>Cra 43 # 65 - 45 sur</td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="" target="_blank">
                                        <i data-feather="external-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="">
                                        <i data-feather="calendar"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <div class="user__xl">
                                        <div class="pr-2">
                                            <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                        </div>

                                        <div>
                                            <span>Jesus Antonio Robles Torres</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologo</td>
                                <td>jesusa@hotmail.com</td>
                                <td>300 1245 3245 - 456 2365</td>
                                <td>Cra 43 # 65 - 45 sur</td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="" target="_blank">
                                        <i data-feather="external-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="">
                                        <i data-feather="calendar"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <div class="user__xl">
                                        <div class="pr-2">
                                            <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                        </div>

                                        <div>
                                            <span>Jesus Antonio Robles Torres</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologo</td>
                                <td>jesusa@hotmail.com</td>
                                <td>300 1245 3245 - 456 2365</td>
                                <td>Cra 43 # 65 - 45 sur</td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="" target="_blank">
                                        <i data-feather="external-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="">
                                        <i data-feather="calendar"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <div class="user__xl">
                                        <div class="pr-2">
                                            <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                        </div>

                                        <div>
                                            <span>Jesus Antonio Robles Torres</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologo</td>
                                <td>jesusa@hotmail.com</td>
                                <td>300 1245 3245 - 456 2365</td>
                                <td>Cra 43 # 65 - 45 sur</td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="" target="_blank">
                                        <i data-feather="external-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="">
                                        <i data-feather="calendar"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <div class="user__xl">
                                        <div class="pr-2">
                                            <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                        </div>

                                        <div>
                                            <span>Jesus Antonio Robles Torres</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologo</td>
                                <td>jesusa@hotmail.com</td>
                                <td>300 1245 3245 - 456 2365</td>
                                <td>Cra 43 # 65 - 45 sur</td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="" target="_blank">
                                        <i data-feather="external-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="">
                                        <i data-feather="calendar"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <div class="user__xl">
                                        <div class="pr-2">
                                            <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                        </div>

                                        <div>
                                            <span>Jesus Antonio Robles Torres</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologo</td>
                                <td>jesusa@hotmail.com</td>
                                <td>300 1245 3245 - 456 2365</td>
                                <td>Cra 43 # 65 - 45 sur</td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="" target="_blank">
                                        <i data-feather="external-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="">
                                        <i data-feather="calendar"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <div class="user__xl">
                                        <div class="pr-2">
                                            <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                        </div>

                                        <div>
                                            <span>Jesus Antonio Robles Torres</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologo</td>
                                <td>jesusa@hotmail.com</td>
                                <td>300 1245 3245 - 456 2365</td>
                                <td>Cra 43 # 65 - 45 sur</td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="" target="_blank">
                                        <i data-feather="external-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="">
                                        <i data-feather="calendar"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <div class="user__xl">
                                        <div class="pr-2">
                                            <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                        </div>

                                        <div>
                                            <span>Jesus Antonio Robles Torres</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologo</td>
                                <td>jesusa@hotmail.com</td>
                                <td>300 1245 3245 - 456 2365</td>
                                <td>Cra 43 # 65 - 45 sur</td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="" target="_blank">
                                        <i data-feather="external-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="">
                                        <i data-feather="calendar"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <div class="user__xl">
                                        <div class="pr-2">
                                            <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                        </div>

                                        <div>
                                            <span>Jesus Antonio Robles Torres</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologo</td>
                                <td>jesusa@hotmail.com</td>
                                <td>300 1245 3245 - 456 2365</td>
                                <td>Cra 43 # 65 - 45 sur</td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="" target="_blank">
                                        <i data-feather="external-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="">
                                        <i data-feather="calendar"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <div class="user__xl">
                                        <div class="pr-2">
                                            <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                        </div>

                                        <div>
                                            <span>Jesus Antonio Robles Torres</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologo</td>
                                <td>jesusa@hotmail.com</td>
                                <td>300 1245 3245 - 456 2365</td>
                                <td>Cra 43 # 65 - 45 sur</td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="" target="_blank">
                                        <i data-feather="external-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="">
                                        <i data-feather="calendar"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-0">
                                    <div class="user__xl">
                                        <div class="pr-2">
                                            <img class="img__contacs" src='{{ asset($profesional->fotoperfil ?? 'img/menu/avatar.png') }}'>
                                        </div>

                                        <div>
                                            <span>Jesus Antonio Robles Torres</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Dermatologo</td>
                                <td>jesusa@hotmail.com</td>
                                <td>300 1245 3245 - 456 2365</td>
                                <td>Cra 43 # 65 - 45 sur</td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="" target="_blank">
                                        <i data-feather="external-link"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn_action" style="width: 33px" href="">
                                        <i data-feather="calendar"></i>
                                    </a>
                                </td>
                            </tr>
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
                    targets: [-1,-2],
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
