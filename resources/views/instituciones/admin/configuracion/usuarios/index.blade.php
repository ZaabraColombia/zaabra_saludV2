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
                                            href="">
                                            <i data-feather="eye"></i> <span class="tiptext">Ver usuario</span>
                                        </a>
                                
                                        <a class="btn_action_green tool top" style="width: 33px"
                                            href="">
                                            <i data-feather="edit"></i> <span class="tiptext">Editar usuario</span>
                                        </a>
                                    
                                        <a class="btn_action_green tool top" style="width: 33px"
                                            href="">
                                            <i data-feather="trash-2"></i> <span class="tiptext">Eliminar usuario</span>
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