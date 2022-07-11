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
            <h1 class="title blue_two">Servicios</h1>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Add button -->
                @can('accesos-profesional',['agregar-servicio'])
                    <div class="col-md-12 col-lg-auto btn__card_add">
                        <a href="{{ route('profesional.configuracion.servicios.create') }}" id="btn-agregar-contacto" class="bg_blue_two">Agregar servicio</a>
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
        <div id="cardServ" class="panel_body">
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
                @if($servicios->isNotEmpty())
                    @foreach($servicios as $servicio)
                        <div class="col-md-6 col-lg-4 mt_card card__space card__width_desk">
                            <!-- card -->
                            <div class="card__mod">
                                <!-- card header -->
                                <div class="card__header pt-1 pb-0">
                                    <div class="row m-0">
                                        <div class="col-12 p-0">
                                            <h4 class="text-center h4_card_fs18 blue_two">{{ $servicio->nombre }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- card boody -->
                                <div class="card__body pt-0 pb-2">
                                    <div class="row mx-0 mt-2">
                                        <!-- Estado activo o inactivo -->
                                        <div class="col-12 p-0 justify-content-center btn__estado">
                                            <button class="btn__activado">
                                                <span>Activo</span>
                                            </button>
                                        </div>

                                        <div class="col-12 p-0 mt-2 mb-1">
                                            <h4 class="text-center h4_card_fs18 ">{{ $servicio->tipo_servicio->nombre ?? '' }}</h4>
                                        </div>

                                        <div class="col-9 p-0 m-auto lineh_med">
                                            <div class="mb-1">
                                                <span class="span_card_fs12">Valor: &nbsp;${{ number_format($servicio->valor, 0, ',', '.') }}</span>
                                            </div>

                                            <div class="card_especialidad_serv">
                                                <span class="span_card_fs12">Especialidad: &nbsp;{{ $servicio->especialidad->nombreEspecialidad }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- card footer -->
                                <div class="card__footer pt-0 pb-1">
                                    <div class="row m-0 justify-content-center">
                                        <div class="col-12 col-md-3 p-0 btn__card_down">
                                            <button class="bg_blue_two boton-convenio"
                                                data-url="{{ route('profesional.configuracion.servicios.show', ['servicio' => $servicio->id]) }}">Ver más
                                            </button>
                                        </div>

                                        @can('accesos-profesional',['editar-servicio'])
                                            <div class="col-12 col-md-3 p-0 btn__card_down">
                                                <a href="{{ route('profesional.configuracion.servicios.edit', ['servicio' => $servicio->id]) }}">
                                                    <button class="bord_blue_two">Editar</button>
                                                </a>
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
    <div class="modal fade" id="modal-servicio" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Mantener las cases "label-*" -->
                <div class="modal-body">
                    <h1>Ver Servicio</h1>

                    <div class="content__border_see_contacs"></div>

                    <div class="modal_info_cita pt-4">
                        <div class="row mb-2">
                            <div class="col-lg-4 info_contac mb-lg-2">
                                <span>Duración (minuto):&nbsp;</span>
                                <span id="duracion"></span>
                            </div>

                            <div class="col-lg-4 info_contac mb-lg-2">
                                <span>Descanso (minuto):&nbsp;</span>
                                <span id="descanso"></span>
                            </div>

                            <div class="col-lg-4 info_contac mb-lg-2">
                                <span>Valor:&nbsp;</span>
                                <span id="valor"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Nombre:</h4>
                                <span id="nombre"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Especialidad:</h4>
                                <span id="especialidad"></span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Tipo del servicio:</h4>
                                <span id="tipo_servicio">Tipo del servicio 1</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>CUPS:</h4>
                                <span id="cup">CUPS - 00000 111</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Número de citas activas del paciente:</h4>
                                <span id="citas_activas">000</span>
                            </div>

                            <div class="col-lg-6 info_contac">
                                <h4>Tipo de atención:</h4>
                                <span id="tipo_atencion"></span>
                            </div>

                            <div class="col-12 info_contac mt-lg-2">
                                <h4>Descripción:</h4>
                                <span id="descripcion"></span>
                            </div>
                        </div>

                        <h4 class="fs_subtitle blue_light" style="border-bottom: 2px solid #7fadcb;">Convenios vinculados</h4>
                        <div id="convenios-lista">
                            <div class="row mb-2">
                                <div class="col-12 info_contac d-lg-flex">
                                    <h4>Nombre del convenio:&nbsp;</h4>
                                    <span>Tipo de establecimiento 1</span>
                                </div>

                                <div class="col-lg-6 info_contac">
                                    <span>Pago convenio:</span>
                                    <span>$&nbsp;000.000</span>
                                </div>

                                <div class="col-lg-6 info_contac">
                                    <span>Pago paciente</span>
                                    <span>$&nbsp;000.000</span>
                                </div>
                            </div>

                            <!-- Linea división de elementos -->
                            <div class="dropdown-divider my-2" style="height:3px; background-color: #7fadcb;"></div>

                            <div id="convenios-lista">
                                <div class="row mb-2">
                                    <div class="col-12 info_contac d-lg-flex">
                                        <h4>Nombre del convenio:&nbsp;</h4>
                                        <span>Tipo de establecimiento 1</span>
                                    </div>

                                    <div class="col-lg-6 info_contac">
                                        <span>Pago convenio:</span>
                                        <span>$&nbsp;000.000</span>
                                    </div>

                                    <div class="col-lg-6 info_contac">
                                        <span>Pago paciente</span>
                                        <span>$&nbsp;000.000</span>
                                    </div>
                                </div>

                                <!-- Linea división de elementos -->
                                <div class="dropdown-divider my-2" style="height:3px; background-color: #7fadcb;"></div>

                                <div class="row mb-2">
                                    <div class="col-12 info_contac d-lg-flex">
                                        <h4>Nombre del convenio:&nbsp;</h4>
                                        <span>Tipo de establecimiento 1</span>
                                    </div>

                                    <div class="col-lg-6 info_contac">
                                        <span>Pago convenio:</span>
                                        <span>$&nbsp;000.000</span>
                                    </div>

                                    <div class="col-lg-6 info_contac">
                                        <span>Pago paciente</span>
                                        <span>$&nbsp;000.000</span>
                                    </div>
                                </div>
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
                    $('#convenios-lista').append('<div class="row mb-2">' +
                        '<div class="col-12 info_contac d-lg-flex">' +
                        '<h4>Nombre del convenio:&nbsp;</h4>' +
                        '<span>' + item.nombre_completo + '</span>' +
                        '</div>' +

                        '<div class="col-lg-6 info_contac">' +
                        '<span>Pago convenio:</span>' +
                        '<span>$' + item.pivot.valor_convenio + '</span>' +
                        '</div>' +

                        '<div class="col-lg-6 info_contac">' +
                        '<span>Pago paciente</span>' +
                        '<span>$' + item.pivot.valor_paciente + '</span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="dropdown-divider my-2" style="height:3px; background-color: #7fadcb"></div>'
                    );
                });

                $('#modal-servicio').modal();
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
