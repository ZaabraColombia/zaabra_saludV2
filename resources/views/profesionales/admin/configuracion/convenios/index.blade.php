@extends('profesionales.admin.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid panel_container">
        <div class="panel_head">
            <!-- Main title -->
            <div class="card_main_title">
                <h1 class="txt_title_panel_head blue__">Convenios</h1>
            </div>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Add agreement -->
                @can('accesos-profesional',['agregar-convenio'])
                    <div class="col-md-12 col-lg-2 button__add_card">
                        <a href="{{ route('profesional.configuracion.convenios.create') }}" class="button__blue_card" id="btn-agregar-contacto">
                            Agregar convenio
                        </a>
                    </div>
                @endcan
                <!-- Search bar -->
                <div class="col-md-6 button__search_blue_card">
                    <form method="get">
                        <button id="search" type="button" class="{{ (request('search')) ? 'search_togggle':'' }}">
                            <input class="mb-0" type="search" name="search" id="search" placeholder="Buscar" value="{{ request('search') }}">
                        </button>
                    </form>
                </div>
                <!-- Document action buttons  -->
                <div class="offset-md-2 col-md-4 offset-lg-1 col-lg-3 button__blue_doc_download">
                    <div class="toolt bottom">
                        <button class="file_calendar"></button>
                        <span class="tiptext">Calendario</span>
                    </div>
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
                                        <img src="{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}">
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
                                            <button class="button__bg_blue_card boton-convenio"
                                                data-url="{{ route('profesional.configuracion.convenios.show', ['convenio' => $convenio->id]) }}">Ver más
                                            </button>
                                        </div>
                                    @endcan

                                    @can('accesos-institucion','editar-convenio')
                                        <div class="col-12 col-md-3 p-0 button__down_card">
                                            <a class="button__border_blue_card"
                                                href="{{ route('profesional.configuracion.convenios.edit', ['convenio' => $convenio->id]) }}">Editar
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
                    <div class="toolt bottom">
                        <a disabled class="btn_right_pag_card disabled"></a>
                        <span class="tiptext">Previus</span>
                    </div>

                    <div class="toolt bottom">
                        <a disabled class="btn_left_pag_card disabled"></a>
                        <span class="tiptext">Next</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ver Convenio -->
    <div class="modal fade" id="modal-convenio" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Mantener las cases "label-*" -->
                <div class="modal-body">
                    <h1>Ver Convenio</h1>

                    <div class="content__see_contacs">
                        <img class="img__see_contacs" id="foto" src='{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}'>
                    </div>

                    <div class="content__border_see_contacs"></div>

                    <div class="modal_info_cita pt-5">
                        <h4 class="fs_subtitle blue_light" style="border-bottom: 2px solid #7fadcb;">Información básica</h4>
                        <div class="row mb-2">
                            <div class="col-lg-6 info_contac">
                                <h4>Nombre:</h4>
                                <span id="nombre_completo"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <span id="mascara_identificacion"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Código del prestador del servicio:</h4>
                                <span id="sgsss"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Código del convenio:</h4>
                                <span id="codigo_convenio"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Tipo del contribuyente:</h4>
                                <span id="tipo_contribuyente"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Actividad económica:</h4>
                                <span id="actividad_economica"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Forma de pago:</h4>
                                <span id="forma_pago"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Tipo de convenio:</h4>
                                <span id="tipo_convenio"></span>
                            </div>
                        </div>

                        <h4 class="fs_subtitle blue_light" style="border-bottom: 2px solid #7fadcb;">Información de contacto</h4>
                        <div class="row mb-2">
                            <div class="col-lg-6 info_contac">
                                <h4>Tipo de establecimiento:</h4>
                                <span id="tipo_establecimiento"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Dirección:</h4>
                                <span id="direccion">Cll 00 # 00 - 00</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Código postal</h4>
                                <span id="codigo_postal"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>País:</h4>
                                <span id="pais"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Departamento:</h4>
                                <span id="departamento"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Provincia:</h4>
                                <span id="provincia"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Ciudad:</h4>
                                <span id="ciudad"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Teléfonos:</h4>
                                <span id="telefono"></span> -
                                <span id="celular"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Correo:</h4>
                                <span id="correo"></span>
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
            dom: 'lfBrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    className: 'red',
                    title:'Resultados',
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

        $("#search").on('keyup change',function(){
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
                    if (key === 'foto') $('#' + key).attr('src', item);
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
@endsection
