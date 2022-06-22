@extends('instituciones.admin.layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info {
            display: none;
        !important;
        }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="panel_head">
            <!-- Main title -->
            <div class="card_main_title">
                <h1 class="txt_title_panel_head">Convenios</h1>
            </div>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Add agreement -->
                <div class="col-md-12 col-lg-2 button__add_card">
                    <a href="{{ route('institucion.configuracion.convenios.create') }}" class="button__green_card"
                    id="btn-agregar-contacto">Agregar convenio
                    </a>
                </div>
                <!-- Search bar -->
                <div class="col-md-6 button__search_card">
                    <form method="get">
                        <button id="search" type="button" class="{{ (request('search')) ? 'search_togggle':'' }}">
                            <input class="mb-0" type="search" name="search" id="search" placeholder="Buscar" value="{{ request('search') }}">
                        </button>
                    </form>
                </div>
                <!-- Document action buttons  -->
                <div class="offset-md-2 col-md-4 offset-lg-1 col-lg-3 button__doc_download">
                    <div class="toolt bottom">
                        <button class="file_excel"></button>
                        <span class="tiptext">Doc. Excel</span>
                    </div>
                    <div class="toolt bottom">
                        <button class="file_pdf"></button>
                        <span class="tiptext">Doc. PDF</span>
                    </div>
                    <div class="toolt bottom">
                        <button class="file_printer"></button>
                        <span class="tiptext">Imprimir</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel_body">
            <div class="row m-0">
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
                <!-- Agreement card -->
                @if($convenios->isNotEmpty())
                    @foreach($convenios as $convenio)
                        <div class="col-md-6 col-lg-4 p-0 px-md-2 pr-xl-3 mt_card_float card__col">
                            <div class="card card__">
                                <div class="row card__row_column">
                                    <!-- Estado activo o inactivo -->
                                    <div class="col-12 p-0 mb-3 d-flex justify-content-end">
                                        <a href="#" class="btn__activado">
                                            <span>activo</span>
                                        </a>
                                    </div>
                                    <!-- Image agreement -->
                                    <div class="img_card_float">
                                        <img src="{{ asset($convenio->url_image ?? '/img/menu/avatar.png') }}">
                                    </div>

                                    <div class="col-12 card__data">
                                        <!-- card data top -->
                                        <div class="card__data_top mb-1">
                                            <div class="">
                                                <h4 class="txt_h4_card_float">{{ $convenio->nombre_completo }}</h4>
                                            </div>

                                            <div class="">
                                                <h5 class="txt_h5_card_float">{{ $convenio->tipo_establecimiento }}</h5>
                                            </div>

                                            <div class="">
                                                <h6 class="txt_h6_card_float">Código: &nbsp;{{ $convenio->codigo_convenio }}</h6>
                                            </div>
                                        </div>
                                        <!-- card data down -->
                                        <div class="card__data_down pl-xl-4">
                                            <div class="pl-md-3">
                                                <i data-feather="phone" class="icon_span_card"></i>
                                                <span class="txt_span_card">{{ "{$convenio->celular} - {$convenio->telefono}" }}</span>
                                            </div>

                                            <div class="toolt bottom">
                                                <div class="pl-md-3 width__tool_tip">
                                                    <i data-feather="mail" class="icon_span_card"></i>
                                                    <span class="txt_span_card">{{ $convenio->correo }}</span>
                                                </div>
                                                <span class="tiptext">{{ $convenio->correo }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- view more and edit buttons -->
                                <div class="row mx-0 mt-3 mt-md-2 justify-content-md-center">
                                    @can('accesos-institucion','ver-convenios')
                                        <div class="col-12 col-md-3 p-0 mb-2 mb-md-0 button__down_card">
                                            <button class="button__bg_green_card boton-convenio"
                                                data-url="{{ route('institucion.configuracion.convenios.show', ['convenio' => $convenio->id]) }}">Ver más
                                            </button>
                                        </div>
                                    @endcan

                                    @can('accesos-institucion','editar-convenio')
                                        <div class="col-12 col-md-3 p-0 button__down_card">
                                            <a class="button__border_green_card"
                                                href="{{ route('institucion.configuracion.convenios.edit', ['convenio' => $convenio->id]) }}">Editar
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- Pagination buttons -->
                <div class="col-12 p-0 pr-md-2 pr-xl-3 mt-4 butons__pagination_card">
                    @if(!$convenios->onFirstPage())
                        <div class="toolt bottom">
                            <a href="{{ $convenios->previousPageUrl() }}" class="btn_right_pag_card"></a>
                            <span class="tiptext">Previus</span>
                        </div>
                    @endif
                    @if(!$convenios->onLastPage())
                        <div class="toolt bottom">
                            <a href="{{ $convenios->nextPageUrl() }}" class="btn_left_pag_card"></a>
                            <span class="tiptext">Next</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal see agreement -->
    <div class="modal fade" id="modal-convenio" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal__">
                <!-- Modal header -->
                <div class="modal-header row m-0 px-3 mb-lg-5 pl-lg-4">
                    <div class="col-12 p-0">
                        <button type="button" class="close modal_btn_close_top" data-dismiss="modal" aria-label="Close">
                            <span class="modal_x_close" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Título principal -->
                    <div class="col-12 modal_main_title">
                        <h1 class="modal_title_green">Ver Convenio</h1>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body px-3 px-lg-4 m-0 mt-5 mt-lg-0 mb-lg-3">
                    <!-- Imagen imprersa del profesional -->
                    <div class="modal_body_img">
                        <img class="modal_img_float" src="{{ asset('img/menu/avatar.png') }}">
                    </div>
                    <!-- Sección data -->
                    <div class="mb-lg-4 pt-md-3 px-md-4 modal_info_data_open">
                        <h4 class="pt-5 pt-lg-4 mb-3 txt_subtitle_modal_card">Información básica</h4>

                        <div class="row m-0">
                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Nombre:</h4>
                                <div class="modal_data_user">
                                    <span id="nombre_completo"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">NIT:</h4>
                                <div class="modal_data_user">
                                    <span id="mascara_identificacion"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Código del prestador del servicio:</h4>
                                <div class="modal_data_user">
                                    <span id="sgsss"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Tipo de convenio:</h4>
                                <div class="modal_data_user">
                                    <span id="tipo_convenio"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Código del convenio:</h4>
                                <div class="modal_data_user">
                                    <span id="codigo_convenio"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Forma de pago:</h4>
                                <div class="modal_data_user">
                                    <span id="forma_pago"></span>
                                </div>
                            </div>

                            <div class="col-12 modal_info_user">
                                <h4 class="modal_data_form">Tipo del contribuyente:</h4>
                                <div class="modal_data_user">
                                    <span id="tipo_contribuyente"></span>
                                </div>
                            </div>

                            <div class="col-12 d-md-block modal_info_user">
                                <h4 class="modal_data_form">Actividad económica:</h4>
                                <div class="pl-md-0 modal_data_user modal_content_txt">
                                    <div id="actividad_economica" class="modal_short_text"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pb-md-3 px-md-4 modal_info_data_open">
                        <div class="col-12 mb-3 px-md-4 d-lg-none dropdown-divider" style="border: 1px solid #DBDADA"></div>
                        <h4 class="txt_subtitle_modal_card my-3">Información de contacto</h4>

                        <div class="row m-0">
                            <div class="col-md-6 col-lg-12 d-md-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Tipo de establecimiento:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="tipo_establecimiento"></span>
                                </div>
                            </div>

                            <div class="col-md-6 d-md-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Dirección:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="direccion">Cll 00 # 00 - 00</span>
                                </div>
                            </div>

                            <div class="col-md-6 d-md-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Código postal:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="codigo_postal"></span>
                                </div>
                            </div>

                            <div class="col-md-6 d-md-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">País:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="pais"></span>
                                </div>
                            </div>

                            <div class="col-md-6 d-md-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Departamento:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="departamento"></span>
                                </div>
                            </div>

                            <div class="col-md-6 d-md-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Ciudad:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="ciudad"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Teléfonos:</h4>
                                <div class="modal_data_user">
                                    <span id="telefono"></span> -
                                    <span id="celular"></span>
                                </div>
                            </div>

                            {{-- <div class="col-12 modal_info_user">
                                <h4 class="modal_data_form">Provincia:</h4>
                                <div class="modal_data_user">
                                    <span id="provincia"></span>
                                </div>
                            </div> --}}

                            <div class="col-12 modal_info_user">
                                <h4 class="modal_data_form">Correo:</h4>
                                <div class="modal_data_user">
                                    <span id="correo"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal_btn_down_center mb-4">
                    <button type="button" class="button__form_green" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <script>
        // Inicializar iconos data-feather
        feather.replace()
    </script>

    <script>

        //ver convenio
        $('.boton-convenio').click(function (event) {
            var btn = $(this);

            $.get(btn.data('url'), function (response) {

                $.each(response.item, function (key, item) {
                    if (key !== 'foto') $('#' + key).html(item);
                    if (key === 'foto') $('#modal-foto').attr('src', item);
                });

                $('#modal-convenio').modal();
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

    <!-- Evento mostrar y ocultar un tramo del texto en los servicios-->
    <script>
        $("#actividad_economica").on('click', function(){
            var div = $(this);
            
            if (div.hasClass("modal_short_text")){
                div.removeClass("modal_short_text").addClass("modal_long_text");
            }
            else {
                div.removeClass("modal_long_text").addClass("modal_short_text");
            }
        });
    </script>
@endsection
