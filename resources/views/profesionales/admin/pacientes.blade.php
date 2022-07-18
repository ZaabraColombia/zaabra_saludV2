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
            <h1 class="title blue_two">Pacientes</h1>
            <!-- Toolbar -->
            <div class="row m-0">
                <!-- Add button -->
                @can('accesos-profesional',['agregar-paciente'])
                    <div class="col-md-12 col-lg-auto btn__card_add">
                        <a href="#" id="" class="bg_blue_two">Agregar paciente</a>
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
                        <button class="file_calendar"></button>
                        <span class="toolText">Calendario</span>
                    </div>
                    <div class="toolTip bottom">
                        <button class="file_excel"></button>
                        <span class="toolText">Eportar Excel</span>
                    </div>
                    <div class="toolTip bottom">
                        <button class="file_pdf"></button>
                        <span class="toolText">Eportar PDF</span>
                    </div>
                    <div class="toolTip bottom">
                        <button class="file_printer"></button>
                        <span class="toolText">Imprimir</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- panel body -->
        <div id="" class="panel_body">
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
                @if($pacientes->isNotEmpty())
                    @foreach($pacientes as $paciente)
                        <div class="col-md-6 col-lg-4 mb_card card__space card__width_desk">
                            <!-- card -->
                            <div class="card__mod">
                                <!-- card header -->
                                <div class="card__header p-0">
                                </div>
                                <!-- card boody -->
                                <div class="card__body py-0 pb-lg-2 pr-lg-1">
                                    <div class="row mx-0">
                                        <!-- Image patient -->
                                        <div class="col-12 col-lg-2 mb-1 px-lg-0 pt-lg-2 img__perfil_estatic">
                                            <img src="{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}">
                                        </div>

                                        <div class="col-12 col-lg-10 pl-lg-4 pr-lg-0 mb-lg-2 card_flex_column">
                                            <div>
                                                <h5 class="text-center text-lg-left h5_fs14_med black_">{{ $paciente->user->nombre_completo }}</h5>

                                                <h5 class="text-center text-lg-left mb-1 h5_fs14_reg black_">{{ $paciente->eps }}</h5>

                                                <h5 class="text-center text-lg-left h5_fs12_reg black_">{{ $paciente->user->numerodocumento }}</h5>
                                            </div>

                                            <!-- Informative buttons mobile-->
                                            <div class="card_icon_info">
                                                <button class="btn_icon_info_card toolTip top" data-url="" data-toggle="modal" data-target="#modal_see_patient">
                                                    <i data-feather="eye" class="icon_info_card"></i> 
                                                    <span class="toolText">Ver paciente</span>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-12 m-auto px-md-4 pl-lg-0 pr-lg-1 card_bord_top">
                                            <div class="pl-md-3 pl-lg-0 mt-3 mb-2 mt-lg-2">
                                                <i data-feather="phone" class="icon_contac_blue_card"></i>
                                                <span class="span_fs12_reg black_">{{ $paciente->celular }}</span>
                                            </div>

                                            <div class="toolTip bottom">
                                                <div class="pl-md-3 pl-lg-0 tooltip_data">
                                                    <i data-feather="mail" class="icon_contac_blue_card"></i>
                                                    <span class="span_fs12_reg black_">{{ $paciente->user->email }}</span>
                                                </div>
                                                <span class="toolText">{{ $paciente->user->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- card footer -->
                                <div class="card__footer p-0">
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
                    title:'Resultados',
                    exportOptions: {
                        //columns: ":not(:last-child)",
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

        $("#search").on('keyup change',function(){
            var texto = $(this).val();
            table.search(texto).draw();
        });
    </script>

    <!-- Función para el despliegue de la barra de busqueda -->
    <script>
        $('#search').on('click', function () {
            $('#search').addClass('search_togggle');
        });
    </script>
@endsection
