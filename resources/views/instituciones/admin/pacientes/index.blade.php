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
                <h1 class="txt_title_panel_head">Pacientes</h1>
            </div>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Add patient -->
                <div class="col-md-12 col-lg-2 button__add_card">
                    <a href="{{ route('institucion.pacientes.crear') }}" class="button__green_card"
                    id="btn-agregar-contacto">Agregar paciente
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
                <!-- Patient card -->
                @if($pacientes->isNotEmpty())
                    @foreach($pacientes as $paciente)
                        <div class="col-md-6 col-lg-4 p-0 px-md-2 pr-xl-3 mt-4 card__col">
                            <div class="card card__">
                                <div class="row pt-2 card__row_column">
                                    <!-- Informative buttons desktop-->
                                    <div class="col-12 d-none d-lg-flex button__info_card btn_float_right">
                                        <button class="btn_icon_card tool top" data-url="" data-toggle="modal" data-target="#modal_see_patient">
                                            <i data-feather="eye" class="icon_btn_card_desk"></i> 
                                            <span class="tiptext">Ver paciente</span>
                                        </button>
                                    </div>
                                    <!-- Image patient -->
                                    <div class="col-lg-3 p-0 mb-1 d-flex justify-content-center align-self-md-start">
                                        <img class="img_card2_module" src="/img/menu/avatar.png">
                                    </div>
                                    <!-- Information patient -->
                                    <div class="col-lg-9 card__data pt_card_float">
                                        <!-- card data top -->
                                        <div class="card__data_top">
                                            <div class="mb_card">
                                                <h4 class="txt_h4_card">{{ "{$paciente->user->primernombre} {$paciente->user->primerapellido}" }}</h4>
                                            </div>
                                            <div class="mb_card">
                                                <h5 class="txt_h5_card">{{ $paciente->eps }}</h5>
                                            </div>
                                            <div class="mb_card">
                                                <h6 class="txt_h6_card">{{ $paciente->user->identificacion }}</h6>
                                            </div>
                                        </div>
                                        <!-- Informative buttons mobile-->
                                        <div class="d-lg-none button__info_card mb_card">
                                            <button class="btn_icon_card tool top" data-url="" data-toggle="modal" data-target="#modal_see_patient">
                                                <i data-feather="eye" class="icon_btn_card_mobile"></i> 
                                                <span class="tiptext">Ver paciente</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-11 my-2 dropdown-divider"></div>
                                    <!-- Information patient -->
                                    <div class="col-12 px-0 px-lg-4 px-xl-3">
                                        <!-- card data down -->
                                        <div class="card__data_down">
                                            <div class="mb_card">
                                                <i data-feather="phone" class="icon_span_green_card"></i>
                                                <span class="txt_span_card">{{ $paciente->celular }}</span>
                                            </div>

                                            <div class="">
                                                <i data-feather="mail" class="icon_span_green_card"></i>
                                                <span class="txt_span_card">{{ $paciente->user->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- Pagination buttons -->
                <div class="col-12 p-0 pr-md-2 pr-xl-3 mt-4 butons__pagination_card">
                    @if(!$pacientes->onFirstPage())
                        <div class="toolt bottom">
                            <a href="{{ $pacientes->previousPageUrl() }}" class="btn_right_pag_card"></a>
                            <span class="tiptext">Previus</span>
                        </div>
                    @endif
                    @if(!$pacientes->onLastPage())
                        <div class="toolt bottom">
                            <a href="{{ $pacientes->nextPageUrl() }}" class="btn_left_pag_card"></a>
                            <span class="tiptext">Next</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal see patient -->
    <div class="modal fade" id="modal_see_patient" data-backdrop="static" data-keyboard="false">
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
                        <h1 class="modal_title_green">Ver Paciente</h1>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body px-3 px-lg-4 m-0 mb-lg-3">
                    <!-- Imagen imprersa del profesional -->
                    <div class="row m-0">
                        <div class="col-12 p-0 mb-3 d-flex justify-content-center">
                            <img class="img_printed_modal" src="/img/menu/avatar.png">
                        </div>
                    </div>
                    <!-- Sección data -->
                    <div class="modal_info_data_open">
                        <div class="row m-0">
                            <div class="col-12 col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Nombre:</h4>
                                <div class="modal_data_user">
                                    <span id="nombre">María Carolina Pérez Perdomo</span>
                                </div>
                            </div>

                            <div class="col-md-6 modal_info_user">
                                <h4 class="modal_data_form">Identificación:</h4>
                                <div class="modal_data_user">
                                    <span id="">C.C. 52458791</span>
                                </div>
                            </div>

                            <div class="col-md-6 modal_info_user">
                                <h4 class="modal_data_form">Fecha de nacimiento:</h4>
                                <div class="modal_data_user">
                                    <span id="">28/11/1985</span>
                                </div>
                            </div>

                            <div class="col-md-6 modal_info_user">
                                <h4 class="modal_data_form">Sexo Biológico:</h4>
                                <div class="modal_data_user">
                                    <span id="">Femenino</span>
                                </div>
                            </div>

                            <div class="col-md-6 modal_info_user">
                                <h4 class="modal_data_form">Estado Civil:</h4>
                                <div class="modal_data_user">
                                    <span id="">Casado/a</span>
                                </div>
                            </div>

                            <div class="col-md-6 modal_info_user">
                                <h4 class="modal_data_form">Ocupación:</h4>
                                <div class="modal_data_user">
                                    <span id="">Empleado/a</span>
                                </div>
                            </div>

                            <div class="col-12 mb-3 dropdown-divider"></div>

                            <div class="col-md-6 d-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Grupo Sanguíneo:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="">B+</span>
                                </div>
                            </div>

                            <div class="col-md-6 d-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Alergias:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="">Lorem ipsum do</span>
                                </div>
                            </div>

                            <div class="col-md-6 d-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Entidad Médica:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="">Lorem ipsum do</span>
                                </div>
                            </div>

                            <div class="col-md-6 d-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Categoría de Discapacidad:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="">Lorem ipsum do</span>
                                </div>
                            </div>

                            <div class="col-12 mb-3 dropdown-divider"></div>

                            <div class="col-md-6 d-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">País:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="">Colombia</span>
                                </div>
                            </div>

                            <div class="col-md-6 d-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Departamento:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="">Norte de Santander</span>
                                </div>
                            </div>

                            <div class="col-md-6 d-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Ciudad:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="">Santo Domingo de Silos</span>
                                </div>
                            </div>

                            <div class="col-md-6 d-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Dirección:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="">Calle 127A # 7-53 Cs 7003</span>
                                </div>
                            </div>

                            <div class="col-md-6 d-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Teléfono:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="">0000000</span>
                                </div>
                            </div>

                            <div class="col-md-6 d-block d-lg-flex modal_info_user">
                                <h4 class="modal_data_form">Correo:</h4>
                                <div class="pl-md-0 pl-lg-2 modal_data_user">
                                    <span id="">mariacaro85@gmail.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modalfooter -->
                <div class="modal_btn_down_center mt-md-3 mt-lg-0 mb-4">
                    <button type="button" class="button__form_green" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

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
            dom: 'lfBrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    className: 'red',
                    title: 'Resultados',
                    exportOptions: {
                        //columns: ":not(:last-child)",
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
                        //columns: ":not(:last-child)",
                    },
                },
            ],
        });

        $("#search").on('keyup change', function () {
            var texto = $(this).val();
            table.search(texto).draw();
        });
    </script>

    <script>
        $('#search').on('click', function () {
            $('#search').addClass('search_togggle');
        });
    </script>
@endsection
