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
    <div class="container-fluid px-3 px-md-5 px-xl-5">
        <div class="my-4">
            <h1 class="title_contain_card">Convenios</h1>
        </div>

        <!-- Contenedor barra de búsqueda, botón agregar contacto, descargas y paginación -->
        <div class="row card_buttons_top">
            <div class="col-md-3 col-lg-2 p-0 card_content_btn_add mb-4">
                <a href="{{ route('institucion.configuracion.convenios.create') }}" class="card_btn_add_green py-2"
                   id="btn-agregar-contacto">
                    Agregar convenio
                </a>
            </div>

            <div class="col-md-5 col-lg-7 pl-0 pr-0 pr-md-2 pr-xl-1 mb-4 card_btn_search">
                <form method="get">
                    <button id="search" class="{{ (request('search')) ? 'search_togggle':'' }}" type="button">
                        <input class="mb-0" type="search" name="search" id="search" placeholder="Buscar"
                               value="{{ request('search') }}">
                    </button>
                </form>
            </div>

            <div class="col-md-2 col-lg-2 p-0 mb-4 container_btn_docs">
                <button>
                    <div class="file_excel"></div>
                </button>
                <button>
                    <div class="file_pdf"></div>
                </button>
                <button>
                    <div class="file_printer"></div>
                </button>
            </div>

            <div class="col-md-2 col-lg-1 d-none d-md-flex p-0 mb-4 pagination__right">
                @if(!$convenios->onFirstPage())
                    <a href="{{ $convenios->previousPageUrl() }}" class="pag_btn_right"></a>
                @else
                    <button disabled class="pag_btn_right disabled"></button>
                @endif
                @if(!$convenios->onLastPage())
                    <a href="{{ $convenios->nextPageUrl() }}" class="pag_btn_left"></a>
                @else
                    <button disabled class="pag_btn_left disabled"></button>
                @endif
            </div>
        </div>

        <!-- Tarjetas Profesionales -->
        <div class="row m-0">
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

            @if($convenios->isNotEmpty())
                @foreach($convenios as $convenio)
                    <div class="col-md-6 col-lg-4 p-0 px-md-3 px-xl-2 mt-5 mb-3 card__col">
                        <div class="card container_card p-0">
                            <div class="card_float">
                                <div class="row card__row_column">
                                    <div class="card_content_img_float">
                                        <img class="card__imagen_float" src="{{ asset($convenio->url_image ?? '/img/menu/avatar.png') }}">
                                    </div>

                                    <div class="col-12 mb-3 card_float_info_float">
                                        <div class="card_txt_h">
                                            <h4 class="card_h4">{{ $convenio->nombre_completo }}</h4>
                                        </div>

                                        <div class="card_txt_h">
                                            <h5 class="card_h5">{{ $convenio->tipo_establecimiento }}</h5>
                                        </div>

                                        <div class="card_txt_h">
                                            <h6 class="card_h6">Código: &nbsp;{{ $convenio->codigo_convenio }}</h6>
                                        </div>

                                        <div class="card_txt_span">
                                            <i data-feather="phone" class="card_icon"></i><span
                                                class="card_span">{{ "{$convenio->celular} - {$convenio->telefono}" }}</span>
                                        </div>

                                        <div class="toolt bottom">
                                            <div class="card_txt_span mail">
                                                <i data-feather="mail" class="card_icon"></i><span
                                                    class="card_span">{{ $convenio->correo }}</span>
                                            </div>
                                            <span class="tiptext">{{ $convenio->correo }}</span>
                                        </div>
                                    </div>

                                    <div class="col-12 pad_buttons_bottom">
                                        <div class="row m-0">
                                            @can('accesos-institucion','ver-convenios')
                                                <div
                                                    class="col-12 col-lg-6 p-0 mb-3 mb-lg-0 card_content_buttons_bottom">
                                                    <button class="card_btn_green boton-convenio"
                                                            data-url="{{ route('institucion.configuracion.convenios.show', ['convenio' => $convenio->id]) }}">
                                                        Ver más
                                                    </button>
                                                </div>
                                            @endcan

                                            @can('accesos-institucion','editar-convenio')
                                                <div class="col-12 col-lg-6 p-0 card_content_buttons_bottom">
                                                    <a class="card_btn_transparent"
                                                       href="{{ route('institucion.configuracion.convenios.edit', ['convenio' => $convenio->id]) }}">
                                                        Editar
                                                    </a>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        @endif
        <!-- Botones de paginación -->
            <div class="col-12 d-md-none p-0 mb-3 pagination__right">
                @if(!$convenios->onFirstPage())
                    <a href="{{ $convenios->previousPageUrl() }}" class="pag_btn_right"></a>
                @else
                    <button disabled class="pag_btn_right disabled"></button>
                @endif
                @if(!$convenios->onLastPage())
                    <a href="{{ $convenios->nextPageUrl() }}" class="pag_btn_left"></a>
                @else
                    <button disabled class="pag_btn_left disabled"></button>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Ver Convenio -->
    <div class="modal fade" id="modal-convenio" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal__">
                <div class="modal-header row m-0 px-2 px-lg-3">
                    <div class="col-12 p-0">
                        <button type="button" class="close modal_btn_close_top" data-dismiss="modal" aria-label="Close">
                            <span class="modal_x_close" aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="col-12 modal_main_title">
                        <h1 class="modal_title_green">Ver Convenio</h1>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="modal_body_img">
                        <img class="modal_img_float" id="modal-foto" src="{{ asset('img/menu/avatar.png') }}">
                    </div>

                    <div class="modal_info_data">
                        <h4 class="fs_subtitle black_bolder mt-3">Información básica</h4>

                        <div class="row m-0">
                            <div class="col-lg-6 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Nombre:</h4>
                                <div class="modal_data_user">
                                    <span id="nombre_completo"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user display_info_data">
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

                            <div class="col-lg-6 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Código del convenio:</h4>
                                <div class="modal_data_user">
                                    <span id="codigo_convenio"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Tipo del contribuyente:</h4>
                                <div class="modal_data_user">
                                    <span id="tipo_contribuyente"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Actividad económica:</h4>
                                <div class="modal_data_user">
                                    <span id="actividad_economica"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Forma de pago:</h4>
                                <div class="modal_data_user">
                                    <span id="forma_pago"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Tipo de convenio:</h4>
                                <div class="modal_data_user">
                                    <span id="tipo_convenio"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal_info_data">
                        <h4 class="fs_subtitle black_bolder">Información de contacto</h4>

                        <div class="row m-0">
                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Tipo de establecimiento:</h4>
                                <div class="modal_data_user">
                                    <span id="tipo_establecimiento"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Dirección:</h4>
                                <div class="modal_data_user">
                                    <span id="direccion">Cll 00 # 00 - 00</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Código postal:</h4>
                                <div class="modal_data_user">
                                    <span id="codigo_postal"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user display_info_data">
                                <h4 class="modal_data_form">País:</h4>
                                <div class="modal_data_user">
                                    <span id="pais"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Departamento:</h4>
                                <div class="modal_data_user">
                                    <span id="departamento"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Provincia:</h4>
                                <div class="modal_data_user">
                                    <span id="provincia"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Ciudad:</h4>
                                <div class="modal_data_user">
                                    <span id="ciudad"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Teléfonos:</h4>
                                <div class="modal_data_user">
                                    <span id="telefono"></span> -
                                    <span id="celular"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user display_info_data d-block d-lg-flex">
                                <h4 class="modal_data_form">Correo:</h4>
                                <div class="modal_data_user">
                                    <span id="correo"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal_btn_down_center mb-4">
                    <button type="button" class="modal_btn_green" data-dismiss="modal">Cerrar</button>
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
            dom: 'lfBrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    className: 'red',
                    title: 'Resultados',
                    exportOptions: {
                        columns: ":not(:last-child)",
                        modifier: {
                            page: 'current'
                        }
                    },
                    //text: 'Red',
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    className: 'border_left',
                    title: 'Resultados',
                    exportOptions: {
                        columns: ":not(:last-child)",
                    },
                },
            ],
        });

        $("#search").on('keyup change', function () {
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
                    if (key === 'foto') $('#modal-foto').attr('src', item);
                });
                // $('#accesos-lista').html('');
                // $.each(response.item.accesos, function (key, item) {
                //     $('#accesos-lista').append('<div class="col-md-6 col-lg-4 d-flex pl-0 modal_info_user">'
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

    <script>
        $('#search').on('click', function () {
            $('#search').addClass('search_togggle');
        });
    </script>
@endsection
