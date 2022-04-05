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
                                        <div class="d-flex justify-content-around px-3">
                                            <a class="btn_action_green tool top" style="width: 33px"
                                               href="" data-target="#modal_ver_convenio" data-toggle="modal">
                                                <i data-feather="eye"></i> <span class="tiptext">ver convenio</span>
                                            </a>

                                            <a class="btn_action_green tool top" style="width: 33px"
                                               href="{{ route('institucion.configuracion.convenios.edit', ['convenio' => $convenio->id]) }}">
                                                <i data-feather="edit"></i> <span class="tiptext">editar convenio</span>
                                            </a>

                                            {{--<a class="btn_action_green tool top" style="width: 33px"
                                               href="">
                                                <i data-feather="settings"></i> <span class="tiptext">configurar convenio</span>
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
    <div class="modal fade modal_contactos" id="modal_ver_convenio">
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
                        <img class="img__see_contacs" src='{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}'>
                    </div>

                    <div class="content__border_see_contacs" style="background-color: #6eb1a6"></div>
                       
                    <div class="modal_info_cita pt-5">
                        <h4 class="fs_subtitle green_light" style="border-bottom: 2px solid #6eb1a6;">Información básica</h4>
                        <div class="row mb-2">
                            <div class="col-lg-6 info_contac">
                                <h4>Nombres:</h4>
                                <span>Nombre 1 Nombre 2</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Apellidos:</h4>
                                <span>Apellido 1 Apellido 2</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Cc</h4>
                                <span>0000000000</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Código del prestador del servicio:</h4>
                                <span>00000 00000000 00000000</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Código del convenio:</h4>
                                <span>00000 00000000 00000000</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Tipo del contribuyente:</h4>
                                <span>Tipo contribuyente 1</span>
                            </div>
                            
                            <div class="col-lg-6 info_contac">
                                <h4>Actividad económica:</h4>
                                <span>Actividad 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Forma de pago:</h4>
                                <span>Forma pago 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Tipo de convenio:</h4>
                                <span>Tipo de dconvenio 1</span>
                            </div>
                        </div>

                        <h4 class="fs_subtitle green_light" style="border-bottom: 2px solid #6eb1a6;">Información de contacto</h4>
                        <div class="row mb-2">
                            <div class="col-lg-6 info_contac">
                                <h4>Tipo de establecimiento:</h4>
                                <span>Tipo de establecimiento 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Dirección:</h4>
                                <span>Cll 00 # 00 - 00</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Código postal</h4>
                                <span>0000000000</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>País:</h4>
                                <span>País 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Departamento:</h4>
                                <span>Departamento 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Provincia:</h4>
                                <span>Provincia 1</span>
                            </div>
                            
                            <div class="col-lg-6 info_contac">
                                <h4>Ciudad:</h4>
                                <span>Ciudad 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Teléfonos:</h4>
                                <span>000 0000 000</span> -
                                <span>000 0000</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Correo:</h4>
                                <span>ejemplo@.com</span>
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
