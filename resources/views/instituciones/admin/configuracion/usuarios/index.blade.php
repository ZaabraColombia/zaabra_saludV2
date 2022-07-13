@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="panel_head">
            <!-- Main title -->
            <div class="card_main_title">
                <h1 class="txt_title_panel_head color_green">Usuarios</h1>
            </div>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Add user -->
                <div class="col-md-12 col-lg-auto mr-lg-3 button__add_card">
                    <a href="{{ route('institucion.configuracion.usuarios.create') }}" class="button__green_card" id="btn-agregar-contacto">Agregar usuario</a>
                </div>
                <!-- Search bar -->
                <div class="col-md-6 col-lg-5 col-xl-5 mr-lg-auto button__search_card">
                    <form method="get">
                        <button id="search" type="button" class="icon__search_green {{ (request('search')) ? 'search_togggle':'' }}">
                            <input class="mb-0" type="search" name="search" id="search" placeholder="Buscar" value="{{ request('search') }}">
                        </button>
                    </form>
                </div>
                <!-- Document action buttons  -->
                <div class="col-md-4 ml-md-auto col-lg-auto button__doc_download">
                    <div class="toolt bottom">
                        <button class="file_excel"></button>
                        <span class="tiptext">Exportar excel</span>
                    </div>
                    <div class="toolt bottom">
                        <button class="file_pdf"></button>
                        <span class="tiptext">Exportar PDF</span>
                    </div>
                    <div class="toolt bottom">
                        <button class="file_printer"></button>
                        <span class="tiptext">Imprimir</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel_body">
            <div class="row m-0 mt-3 mt-md-4 mt-lg-3">
                <!-- alert notice -->
                <div class="col-12" id="alertas">
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
                <!-- User card -->
                @if($usuarios->isNotEmpty())
                    @foreach($usuarios as $usuario)
                        <div class="col-md-6 col-lg-4 spaceCard_between card__col">
                            <div class="card card__user">
                                <div class="row card__row_column">
                                    <!-- Estado activo o inactivo -->
                                    <div class="btn_position_user">
                                        <button href="#" class="{{ ($usuario->estado)?'btn__activado':'btn__desactivado' }}">
                                            <span>{{ ($usuario->estado)?'Activo':'Inactivo' }}</span>
                                        </button>
                                    </div>
                                    <!-- Image user -->
                                    <div class="col-12 p-0 mb-2 d-flex justify-content-center">
                                        <img class="img_card2_module" src='{{ asset($usuario->auxiliar->foto ?? 'img/menu/avatar.png') }}'>
                                    </div>
                                    <!-- Information patient -->
                                    <div class="col-12 card__data">
                                        <!-- card data top -->
                                        <div class="card__data_top">
                                            <div class="mb__cards">
                                                <h4 class="txt_h4_card_user">{{ "$usuario->primernombre $usuario->apellidos" }}</h4>
                                            </div>
                                            <div class="">
                                                <h5 class="txt_h5_card_user">{{ $usuario->auxiliar->cargo }}</h5>
                                            </div>
                                        </div>   
                                    </div>
                                    <div class="col-12 my-1 dropdown-divider"></div>
                                    <!-- Information patient -->
                                    <div class="col-12 px-0">
                                        <!-- card data down -->
                                        <div class="card__data_down_user">
                                            <div class="mb__cards">
                                                <i data-feather="phone" class="icon_span_green_card"></i>
                                                <span class="txt_span_card_user">{{ $usuario->auxiliar->celular }}</span>
                                            </div>

                                            <div class="toolt bottom">
                                                <div class="mb-xl-0 mb__cards width__tool_tip">
                                                    <i data-feather="mail" class="icon_span_green_card"></i>
                                                    <span class="txt_span_card_user">{{ $usuario->email }}</span>
                                                </div>
                                                <span class="tiptext">{{ $usuario->email }}</span>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <!-- view more and edit buttons -->
                                <div class="row m-0 mt-2 justify-content-md-center">
                                    @can('accesos-institucion', 'editar-usuario')
                                        <div class="col-12 col-md-3 btn_right button__down_card">
                                            <button type="submit" class="button__bg_green_card modal-usuario"
                                                data-url="{{ route('institucion.configuracion.usuarios.show', ['usuario'=>$usuario->id]) }}">
                                                Ver más
                                            </button>
                                        </div>
                                    @endcan

                                    @can('accesos-institucion', 'editar-usuario')
                                        <div class="col-12 col-md-3 btn_left button__down_card">
                                            <a type="submit" class="button__border_green_card"
                                                href="{{ route('institucion.configuracion.usuarios.edit', ['usuario'=>$usuario->id]) }}">
                                                Editar
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- Pagination buttons -->
                {{ $usuarios->links("pagination::simple-bootstrap-4") }}
            </div>
        </div>
    </div>

    <!-- Modal see user -->
    <div class="modal fade" id="modal_ver_usuario" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal__">
                <!-- Modal header -->
                <div class="modal-header row m-0 px-3 pl-lg-4">
                    <div class="col-12 p-0">
                        <button type="button" class="close modal_btn_close_top" data-dismiss="modal" aria-label="Close">
                            <span class="modal_x_close" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Título principal -->
                    <div class="col-12 modal_main_title">
                        <h1 class="modal_title_green">Ver Usuario</h1>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body px-4 m-0 mb-lg-3">
                    <!-- Imagen imprersa del profesional -->
                    <div class="row m-0">
                        <div class="col-12 p-0 mb-2 mb-lg-3 d-flex justify-content-center">
                            <img class="img_printed_modal" src="{{ asset('img/menu/avatar.png') }}">
                        </div>
                    </div>
                    <!-- Sección data sin borde -->
                    <div class="modal_info_data_open">
                        <div class="row m-0">
                            <div class="col-12 p-0">
                                <div class="row m-0 flex-lg-row-reverse">
                                    <div class="col-12 col-lg-3 p-0 mb-3 d-flex justify-content-center justify-content-lg-end">
                                        <div id="estado-modal">
                                            <span></span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-lg-9 p-0">
                                        <h4 class="txt_subtitle_modal_card mb-3">Información Principal</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Nombres:</h4>
                                <div class="modal_data_user">
                                    <span id="nombres"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Apellidos:</h4>
                                <div class="modal_data_user">
                                    <span id="apellidos"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Documento:</h4>
                                <div class="modal_data_user">
                                    <span id="numero_identificacion"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Fecha de Nacimiento:</h4>
                                <div class="modal_data_user">
                                    <span id="fecha_nacimineto"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Teléfonos:</h4>
                                <div class="modal_data_user">
                                    <span id="telefonos"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Correo:</h4>
                                <div class="modal_data_user">
                                    <span id="correo"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Dirección:</h4>
                                <div class="modal_data_user">
                                    <span id="direccion"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">País:</h4>
                                <div class="modal_data_user">
                                    <span id="pais"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Departamento:</h4>
                                <div class="modal_data_user">
                                    <span id="departamento"></span>
                                </div>
                            </div>

                            {{--<div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Provincia:</h4>
                                <div class="modal_data_user">
                                    <span id="provincia"></span>
                                </div>
                            </div>--}}

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Ciudad:</h4>
                                <div class="modal_data_user">
                                    <span id="ciudad"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal_info_data_open mt-lg-3">
                        <div class="col-12 mb-3 d-lg-none dropdown-divider"></div>

                        <h4 class="txt_subtitle_modal_card mb-3">Accesos del Usuario</h4>

                        <div class="row m-0 pl-lg-5" id="accesos-lista">
                        </div>
                    </div>
                </div>
                  <!-- Modalfooter -->
                <div class="modal_btn_down_center mb-4">
                    <button type="button" class="button__form_green" data-dismiss="modal">Cerrar</button>
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

        $("#search").on('keyup change',function(){
            // var texto = $(this).val();
            // table.search(texto).draw();
        });

        $('.modal-usuario').click(function (event) {
            var btn = $(this);

            $.get(btn.data('url'), function (response) {
                console.log(response);

                $.each(response.item, function (key, item) {
                    if (key !== 'accesos') $('#' + key).html(item);
                });

                $('#estado-modal').attr('class', (response.item.estado === 'Activado') ? 'btn__activado':'btn__desactivado');
                // $('#estado-modal').find('i').data('feather', ( response.item.estado === 'Activado') ? 'check-circle':'x-circle');
                $('#estado-modal').find('span').html( response.item.estado);

                $('#accesos-lista').html('');
                $.each(response.item.accesos, function (key, item) {
                    $('#accesos-lista').append(
                        '<div class="col-md-6 d-flex pl-0 modal_info_user">' +
                            '<i data-feather="check" style="color: #019F86;"></i>' +
                            ' <div class="pl-2 modal_data_form">' +
                                '<span>' + item.nombre + '</span>' +
                            '</div>' +
                        '</div>'
                        );
                });

                feather.replace();
                $('#modal_ver_usuario').modal();
            }, "json").fail(function (error) {
                console.log(error);
            });
        });
    </script>

    <script>
        $('#search').on('click', function () {
            $('#search').addClass('search_togggle');
        });
    </script>
@endsection
