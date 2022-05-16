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
                        <a href="{{ route('institucion.configuracion.usuarios.create') }}" class="button_green" id="btn-agregar-contacto">
                            Agregar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tarjetas de Usuarios -->
            <div class="row m-0">
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
                @if($usuarios->isNotEmpty())
                    @foreach($usuarios as $usuario)
                        <div class="col-md-6 col-xl-4 p-0 px-md-1 mb-3">
                            <div class="card containt__card p-0">
                                <div class="card-header p-2">
                                    <h5 class="m-0" style="line-height: 1.1">{{ "$usuario->primernombre $usuario->apellidos" }}</h5>
                                </div>
                                
                                <div class="card-body p-2 pb-3"> 
                                    <div class="p-0 mb-2 d-flex justify-content-end">
                                        <a href="#" class="{{ ($usuario->estado)?'btn__activado':'btn__desactivado' }}">
                                            <span>{{ ($usuario->estado)?'Activado':'Desactivado' }}</span>
                                        </a>
                                    </div>  
                                
                                    <div class="row m-0 justify-content-center">
                                        <div class="col-3 p-0 d-flex justify-content-xl-center">
                                            <img class="img__cuadrada" src='/img/user/31/31-1630611954.jpg'>
                                        </div>

                                        <div class="col-9 p-0" style="line-height: 1.3">
                                            <div class="">
                                                <span class="">Gerente administrativo</span>
                                            </div>

                                            <div class="">
                                                <span class="">{{ $usuario->auxiliar->celular }}</span>
                                            </div>

                                            <div class="toolt bottom">
                                                <div class=" mail">
                                                    <span>{{ $usuario->email }}</span>
                                                </div>
                                                <span class="tiptext">{{ $usuario->email }}</span>    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row content_btn_center mx-0 mb-3">
                                    @can('accesos-institucion', 'editar-usuario')
                                        <button type="submit" class="btn_green modal-usuario mr-2" 
                                            data-url="{{ route('institucion.configuracion.usuarios.show', ['usuario'=>$usuario->id]) }}">
                                            Ver más
                                        </button>
                                    @endcan
                        
                                    @can('accesos-institucion', 'editar-usuario')
                                        <a type="submit" class="btn_green px-4" 
                                            href="{{ route('institucion.configuracion.usuarios.edit', ['usuario'=>$usuario->id]) }}">
                                            Editar
                                        </a>   
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach    
                @endif        
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
                        <div id="estado-modal">
                            <span style="vertical-align: middle"></span>
                        </div>

                        <h4 class="fs_subtitle green_light mt-4" style="border-bottom: 2px solid #6eb1a6;">Información básica</h4>
                        <div class="row mb-2">
                            <div class="col-lg-6 info_contac">
                                <span>Nombres:&nbsp;</span>
                                <span id="nombres"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span>Apellidos:&nbsp;</span>
                                <span id="apellidos"></span>
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

        $('.modal-usuario').click(function (event) {
            var btn = $(this);

            $.get(btn.data('url'), function (response) {
                console.log(response);

                $.each(response.item, function (key, item) {
                    if (key !== 'accesos' && key !== 'estado' ) $('#' + key).html(item);
                });

                console.log(response.item);

                $('#estado-modal').attr('class', (response.item.estado === 'Activado') ? 'estado__activo_modal':'estado__inactivo_modal');
                // $('#estado-modal').find('i').data('feather', ( response.item.estado === 'Activado') ? 'check-circle':'x-circle');
                $('#estado-modal').find('span').html( response.item.estado);

                $('#accesos-lista').html('');
                $.each(response.item.accesos, function (key, item) {
                    $('#accesos-lista').append('<div class="col-lg-6 d-flex pl-0 info_contac">'
                        + '<i data-feather="check-circle" style="color: #019F86;" width="17"></i>'
                        + '<span class="pl-2">' + item.nombre + '</span>'
                        + '</div>');
                });
                feather.replace()
                
                $('#modal_ver_usuario').modal();
            }, 

            "json").fail(function (error) {
                console.log(error);
            });
        });
    </script>
@endsection
