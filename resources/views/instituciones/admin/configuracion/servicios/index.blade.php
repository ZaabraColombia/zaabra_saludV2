@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <style>
        .dataTables_filter, .dataTables_info { display: none;!important; }
    </style>
@endsection

@extends('instituciones.admin.layouts.layout')

@section('contenido')
    <div class="container-fluid px-3 px-md-5 px-xl-5">
        <div class="my-4">
            <h1 class="title_contain_card">Servicios</h1>
        </div>

        <!-- Contenedor barra de búsqueda, botón agregar contacto, descargas y paginación -->
        <div class="row card_buttons_top">
            <div class="col-md-3 col-lg-2 p-0 card_content_btn_add mb-4">
                <a href="{{ route('institucion.configuracion.servicios.create') }}" class="card_btn_add_green py-2" id="btn-agregar-contacto">
                    Agregar servicio
                </a>
            </div>

            <div class="col-md-5 col-lg-7 pl-0 pr-0 pr-md-2 pr-xl-1 mb-4 card_btn_search">
                <button id="search">
                    <input class="mb-0" type="search" name="search" id="search" placeholder="Buscar">
                </button>
            </div>

            <div class="col-md-2 col-lg-2 p-0 mb-4 container_btn_docs">
                <button><div class="file_excel"></div></button>
                <button><div class="file_pdf"></div></button>
                <button><div class="file_printer"></div></button>
            </div>

            <div class="col-md-2 col-lg-1 d-none d-md-flex p-0 mb-4 pagination__right">
                <button class="pag_btn_right"></button>
                <button class="pag_btn_left"></button>
            </div>
        </div>

        <!-- Tarjetas Profesionales -->
        <div class="row m-0">
            <div class="col-12" id="alertas" >
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
                    <div class="col-md-6 col-lg-4 p-0 px-md-3 px-xl-2 my-3 card__col">
                        <div class="card container_card p-0">                            
                            <div class="card_float py-4">                             
                                <div class="row card__row_column">
                                    <div class="col-12 mb-3 card_float_info_float">
                                        <div class="card_txt_h txt_doble_linea">
                                            <h4 class="card_h4 green_official">{{ $servicio->nombre }}</h4>
                                        </div>

                                        <div class="card_txt_h">
                                            <h5 class="card_h5">{{ $servicio->tipo_servicio->nombre ?? '' }}</h5>
                                        </div>

                                        <div class="card_txt_span">
                                            <span class="card_span">Valor: &nbsp;${{ number_format($servicio->valor, 0, ',', '.') }}</span>
                                        </div>

                                        <div class="card_txt_span">
                                            <span class="card_span">Especialidad: &nbsp;{{ $servicio->especialidad->nombreEspecialidad }}</span>
                                        </div>
                                    </div>

                                    <div class="col-12 pad_buttons_bottom">
                                        <div class="row m-0">
                                            @can('accesos-institucion','ver-servicios')
                                                <div class="col-12 col-lg-6 p-0 mb-3 mb-lg-0 card_content_buttons_bottom">
                                                    <button class="card_btn_green boton-servicio"
                                                            data-url="{{ route('institucion.configuracion.servicios.show', ['servicio' => $servicio->id]) }}">
                                                        Ver más
                                                    </button>
                                                </div>
                                            @endcan

                                            @can('accesos-institucion','editar-servicio')
                                                <div class="col-12 col-lg-6 p-0 card_content_buttons_bottom">
                                                    <a class="card_btn_transparent"
                                                        href="{{ route('institucion.configuracion.servicios.edit', ['servicio' => $servicio->id]) }}">
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
                <button class="pag_btn_right"></button>
                <button class="pag_btn_left"></button>
            </div>
        </div>
    </div>

    <!-- Modal Ver Servicio -->
    <div class="modal fade" id="modal-servicio" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal__">
                <div class="modal-header row m-0 px-2 px-lg-3">
                    <div class="col-12 p-0">
                        <button type="button" class="close modal_btn_close_top" data-dismiss="modal" aria-label="Close">
                            <span class="modal_x_close" aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="col-12 mb-3 modal_main_title">
                        <h1 class="modal_title_green">Ver Servicio</h1>
                    </div>
                </div>
                
                <div class="modal-body">
                    <div class="modal_info_data py-4">
                        <div class="row m-0">
                            <div class="col-lg-4 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Duración (minuto):</h4>
                                <div class="modal_data_user">
                                    <span id="duracion"></span>
                                </div>
                            </div>

                            <div class="col-lg-4 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Descanso (minuto):</h4>
                                <div class="modal_data_user">
                                    <span id="descanso"></span>
                                </div>
                            </div>

                            <div class="col-lg-4 modal_info_user display_info_data">
                                <h4 class="modal_data_form">Valor:</h4>
                                <div class="modal_data_user">
                                    <span id="valor"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Nombre:</h4>
                                <div class="modal_data_user">
                                    <span id="nombre"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Especialidad:</h4>
                                <div class="modal_data_user">
                                    <span id="especialidad"></span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Tipo del servicio:</h4>
                                <div class="modal_data_user">
                                    <span id="tipo_servicio">Tipo del servicio 1</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">CUPS:</h4>
                                <div class="modal_data_user">
                                    <span id="cup">CUPS - 00000 111</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Número de citas activas del paciente:</h4>
                                <div class="modal_data_user">
                                    <span id="citas_activas">000</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Tipo de atención:</h4>
                                <div class="modal_data_user">
                                    <span id="tipo_atencion"></span>
                                </div>
                            </div>

                            <div class="col-12 modal_info_user mt-lg-2">
                                <h4 class="modal_data_form">Descripción:</h4>
                                <div class="modal_data_user">
                                    <span id="descripcion"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal_info_data py-4">
                        <h4 class="fs_subtitle black_bolder mb-3">Convenios vinculados</h4>
                        <div id="convenios-lista"></div>
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
                    $('#convenios-lista').append(
                        '<div class="row m-0">' +
                            '<div class="col-12 modal_info_user display_info_data">' +
                                '<h4 class="modal_data_form">Nombre del convenio:</h4>' +
                                '<div class="modal_data_user">' +
                                    '<span>' + item.nombre_completo + '</span>' +
                                '</div>' +
                            '</div>' +

                            '<div class="col-lg-6 modal_info_user display_info_data">' +
                                '<h4 class="modal_data_form">Pago convenio:</h4>' +
                                '<div class="modal_data_user">' +
                                    '<span>$' + item.pivot.valor_convenio + '</span>' +
                                '</div>' +
                            '</div>' +

                            '<div class="col-lg-6 modal_info_user display_info_data">' +
                                '<h4 class="modal_data_form">Pago paciente:</h4>' +
                                '<div class="modal_data_user">' +
                                    '<span>$' + item.pivot.valor_paciente + '</span>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="dropdown-divider mt-0" style="height:2px; background-color: #E6E6E6"></div>'
                    );
                });

                $('#modal-servicio').modal();
            }, "json").fail(function (error) {
                console.log(error);
            });
        });
    </script>
@endsection
