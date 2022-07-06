@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info {
            display: none;
        !important;
        }
    </style>
@endsection

@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="panel_head">
            <!-- Main title -->
            <div class="card_main_title">
                <h1 class="txt_title_panel_head color_green">Servicios</h1>
            </div>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Add service -->
                <div class="col-md-12 col-lg-auto mr-lg-3 button__add_card">
                    <a href="{{ route('institucion.configuracion.servicios.create') }}" class="button__green_card" id="btn-agregar-contacto">Agregar servicio</a>
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
                <!-- Service card -->
                @if($servicios->isNotEmpty())
                    @foreach($servicios as $servicio)
                        <div class="col-md-6 col-lg-4 spaceCard_between card__col">
                            <div class="card card__serv">
                                <div class="row card__row_column">
                                    <div class="col-12 card__data">
                                        <!-- card data top -->
                                        <div class="card__data_top">
                                            <div class="card__content_fixed_height">
                                                <h4 class="txt_h4_green_card_float">{{ $servicio->nombre }}</h4>
                                            </div>

                                            <div class="col-12 p-0 my-2 d-flex justify-content-center">
                                                <button class="btn__activado">
                                                    <span>activo</span>
                                                </button>
                                            </div>

                                            <div class="mb_card">
                                                <h5 class="txt_h5_card_float">{{ $servicio->tipo_servicio->nombre ?? '' }}</h5>
                                            </div>
                                        </div>
                                        <!-- card data down -->
                                        <div class="card__data_down pl-xl-4">
                                            <div class="pl-3 mb_card">
                                                <span class="txt_span_card">Valor: &nbsp;${{ number_format($servicio->valor, 0, ',', '.') }}</span>
                                            </div>

                                            <div class="pl-3 mb_card">
                                                <span class="txt_span_card">Especialidad: &nbsp;{{ $servicio->especialidad->nombreEspecialidad }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- view more and edit buttons -->
                                <div class="row mx-0 mt-3 mt-md-2 justify-content-md-center">
                                    @can('accesos-institucion','ver-servicios')
                                        <div class="col-12 col-md-3 p-0 mb-2 mb-md-0 button__down_card">
                                            <button class="button__bg_green_card boton-servicio"
                                                data-url="{{ route('institucion.configuracion.servicios.show', ['servicio' => $servicio->id]) }}">Ver más
                                            </button>
                                        </div>
                                    @endcan

                                    @can('accesos-institucion','editar-servicio')
                                        <div class="col-12 col-md-3 p-0 button__down_card">
                                            <a class="button__border_green_card"
                                                href="{{ route('institucion.configuracion.servicios.edit', ['servicio' => $servicio->id]) }}">Editar
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- Pagination buttons -->
                {{ $servicios->links("pagination::simple-bootstrap-4") }}
            </div>
        </div>
    </div>

    <!-- Modal see service -->
    <div class="modal fade" id="modal-servicio" data-backdrop="static" data-keyboard="false">
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
                        <h1 class="modal_title_green">Ver Servicio</h1>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body px-3 px-lg-4 m-0">
                    <!-- Sección data -->
                    <div class="mb-lg-4 modal_info_data_open">
                        <div class="row m-0 pl-lg-3">
                            <div class="col-12 modal_info_user">
                                <h4 class="modal_data_form">Nombre:</h4>
                                <div class="modal_data_user">
                                    <span id="nombre"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Tipo de servicio:</h4>
                                <div class="modal_data_user">
                                    <span id="tipo_servicio"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Especialidad:</h4>
                                <div class="modal_data_user">
                                    <span id="especialidad"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Duración (min):</h4>
                                <div class="modal_data_user">
                                    <span id="duracion"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Descanso (min):</h4>
                                <div class="modal_data_user">
                                    <span id="descanso"></span>
                                </div>
                            </div> 

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Número de citas activas:</h4>
                                <div class="modal_data_user">
                                    <span id="citas_activas">000</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Valor:</h4>
                                <div class="modal_data_user">
                                    $ &nbsp;<span id="valor"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Tipo de atención:</h4>
                                <div class="modal_data_user">
                                    <span id="tipo_atencion"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">CUPS:</h4>
                                <div class="modal_data_user">
                                    <span id="cup"></span>
                                </div>
                            </div>

                            <div class="col-12 modal_info_user">
                                <h4 class="modal_data_form">Descripción:</h4>
                                <div class="modal_data_user">
                                    <span id="descripcion"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal_info_data_open row__convenio">
                        <h4 class="txt_subtitle_modal_card mb-3">Convenios vinculados</h4>
                     
                        <div class="row m-0 mb-md-3 convenio_scroll" id="convenios-lista"></div>
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
                    $('#convenios-lista').append(
                        '<div id="cov" class="col-md-6 convenio_vinculado">' +
                            '<div class="row m-0 card__conven">' +
                                '<div class="col-lg-3 p-0 mb-2 pl-lg-1 disp_img_modal_card">' +
                                    '<img class="img_section_modal" src="/img/menu/avatar.png">' +  
                                    '<h5 class="txt_span_sm_card heigth_txt_conv">' + item.nombre_completo + '</h5>' +
                                '</div>' +

                                '<div class="col-lg-9 px-4 px-md-3 pl-lg-0 pr-lg-2 mt-1 mb-3 disp__modal_card">' +
                                    '<div class="row m-0 modal_info_user disp_txt_modal_card">' +
                                        '<div class="col-7 p-0 card_precio_serv">' +
                                            '<h4 class="txt_pago_convenio pl-1">Pago convenio:' + '</h4>' +
                                            '<span class="txt__pesos">$' + '</span>' + 
                                        '</div>' +
                                        '<div class="col-5 p-0 text-right modal_data_user">' + 
                                            '<span class="txt__pesos pr-1">' + item.pivot.valor_convenio + '</span>' +
                                        '</div>' +
                                    '</div>' +

                                    '<div class="row m-0 modal_info_user disp_txt_modal_card">' +
                                        '<div class="col-7 p-0 card_precio_serv">' +
                                            '<h4 class="txt_pago_convenio pl-1">Pago paciente:' + '</h4>' +
                                            '<span class="txt__pesos">$' + '</span>' + 
                                        '</div>' +
                                        '<div class="col-5 p-0 text-right modal_data_user">' + 
                                            '<span class="txt__pesos pr-1">' + item.pivot.valor_paciente + '</span>' + 
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>'
                    );
                });

            $('#modal-servicio').modal();
            }, "json").fail(function (error) {
                console.log(error);
            });
        });

        $('#search').on('click', function () {
            $('#search').addClass('search_togggle');
        });
    </script>
@endsection
