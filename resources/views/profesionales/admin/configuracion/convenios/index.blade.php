@extends('profesionales.admin.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid panel_container">
        <!-- panel head -->
        <div class="panel_head">
            <!-- Title -->
            <h1 class="title blue_two">Convenios</h1>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Add button -->
                @can('accesos-profesional',['agregar-convenio'])
                    <div class="col-md-12 col-lg-auto btn__card_add">
                        <a href="{{ route('profesional.configuracion.convenios.create') }}" id="btn-agregar-contacto" class="bg_blue_two">Agregar convenio</a>
                    </div>
                @endcan
                <!-- Search bar -->
                <div class="col-md-6 col-lg-5 col-xl-5 mr-lg-auto search">
                    <form method="get">
                        <button id="search" type="button" class="icon_search_blue {{ (request('search')) ? 'search_togggle':'' }}">
                            <input type="search" name="search" id="search" placeholder="Buscar" value="{{ request('search') }}">
                        </button>
                    </form>
                </div>
                <!-- Document action buttons  -->
                <div class="col-md-4 ml-md-auto col-lg-auto btns__export_doc">
                    <div class="toolTip bottom">
                        <button class="file_excel"></button>
                        <span class="toolText">Doc. Excel</span>
                    </div>
                    <div class="toolTip bottom">
                        <button class="file_pdf"></button>
                        <span class="toolText">Doc. PDF</span>
                    </div>
                    <div class="toolTip bottom">
                        <button class="file_printer"></button>
                        <span class="toolText">Imprimir</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- panel body -->
        <div id="cardConv" class="panel_body">
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
                @if($convenios->isNotEmpty())
                    @foreach($convenios as $convenio)
                        <div class="col-md-6 col-lg-4 mt_card card__space card__width_desk">
                            <!-- card -->
                            <div class="card__mod">
                                <!-- card header -->
                                <div class="card__header p-0">
                                    <div class="row m-0">
                                        <!-- Image agreement -->
                                        <div class="img__perfil_float">
                                            <img src="{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}">
                                        </div>
                                        <!-- Estado activo o inactivo -->
                                        <div class="col-12 p-0 btn__estado">
                                            <button class="btn__activado">
                                                <span>Activo</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- card boody -->
                                <div class="card__body">
                                    <div class="row mx-0 mt-1">
                                        <div class="col-12 p-0 mb-1">
                                            <h4 class="text-center h4_card_fs18 black_bolder">{{ $convenio->nombre_completo }}</h4>

                                            <h5 class="h5_card_fs15 text-center">{{ $convenio->tipo_establecimiento }}</h5>

                                            <h5 class="h5_card_fs9 text-center">Código: &nbsp;{{ $convenio->codigo_convenio }}</h5>
                                        </div>

                                        <div class="col-9 p-0 m-auto lineh_med">
                                            <div class="pl-md-3">
                                                <i data-feather="phone" class="icon_contac_card"></i>
                                                <span class="span_card_fs12">{{ "{$convenio->celular} - {$convenio->telefono}" }}</span>
                                            </div>

                                            <div class="toolTip bottom">
                                                <div class="pl-md-3 tooltip_data">
                                                    <i data-feather="mail" class="icon_contac_card"></i>
                                                    <span class="span_card_fs12">{{ $convenio->correo }}</span>
                                                </div>
                                                <span class="toolText">{{ $convenio->correo }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- card footer -->
                                <div class="card__footer pt-0 pb-1">
                                    <div class="row m-0 justify-content-center">
                                        @can('accesos-institucion','ver-convenios')
                                            <div class="col-12 col-md-3 p-0 btn__card_down">
                                                <button class="bg_blue_two boton-convenio"
                                                    data-url="{{ route('profesional.configuracion.convenios.show', ['convenio' => $convenio->id]) }}">Ver más
                                                </button>
                                            </div>
                                        @endcan

                                        @can('accesos-institucion','editar-convenio')
                                            <div class="col-12 col-md-3 p-0 btn__card_down">
                                                <a href="{{ route('profesional.configuracion.convenios.edit', ['convenio' => $convenio->id]) }}" class="bord_blue_two">Editar</a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- Pagination buttons -->
                <div class="col-12 p-0 pr-md-2 pr-xl-3 mt-4 butons__pagination_card">
                    <div class="toolTip bottom">
                        <a disabled class="btn_right_pag_card disabled"></a>
                        <span class="toolText">Previus</span>
                    </div>

                    <div class="toolTip bottom">
                        <a disabled class="btn_left_pag_card disabled"></a>
                        <span class="toolText">Next</span>
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
