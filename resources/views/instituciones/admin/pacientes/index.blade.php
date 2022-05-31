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
    <div class="container-fluid px-3 px-md-5 pt-5 left_alignment">
        <div class="mb-4">
            <h1 class="title_contain_card">Pacientes</h1>
        </div>

        <div class="row m-0 pr-md-3 pr-xl-4">
            <!-- Add patient -->
            <div class="col-md-12 col-lg-2 p-0 mb-4 card_content_btn_add">
                <a href="{{ route('institucion.pacientes.create') }}" class=" py-2 card_btn_add_green"
                   id="btn-agregar-contacto">Agregar paciente
                </a>
            </div>
            <!-- Search bar -->
            <div class="col-md-6 col-lg-6 p-0 pl-lg-1 pl-xl-1 mb-4 card_btn_search">
                <form method="get">
                    <button id="search" type="button" class="{{ (request('search')) ? 'search_togggle':'' }}">
                        <input class="mb-0" type="search" name="search" id="search" placeholder="Buscar" value="{{ request('search') }}">
                    </button>
                </form>
            </div>
            <!-- Document action buttons  -->
            <div class="col-md-4 col-lg-3 p-0 mb-4 container_btn_docs">
                <button>
                    <div class="file_calendar"></div>
                </button>
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
            <!-- Pagination buttons -->
            <div class="col-md-2 col-lg-1 d-none d-md-flex p-0 mb-4 pagination__right">
                @if(!$pacientes->onFirstPage())
                    <a href="{{ $pacientes->previousPageUrl() }}" class="pag_btn_right"></a>
                @else
                    <button disabled class="pag_btn_right disabled"></button>
                @endif
                @if(!$pacientes->onLastPage())
                    <a href="{{ $pacientes->nextPageUrl() }}" class="pag_btn_left"></a>
                @else
                    <button disabled class="pag_btn_left disabled"></button>
                @endif
            </div>
        </div>

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
            <!-- Professional card -->
            @if($pacientes->isNotEmpty())
                @foreach($pacientes as $paciente)
                    <div class="col-md-6 col-xl-4 p-0 pr-md-3 pr-xl-4 mb-4 card__col">
                        <div class="card container_card p-0">
                            <div class="card_avatar">
                                <div class="row m-0 mb-3 pb-2 bord_bootom">
                                    <div class="col-3 p-0 mb-2 d-flex justify-content-center align-self-md-start">
                                        <img class="card__imagen_avatar" src="/img/menu/avatar.png">
                                    </div>

                                    <div class="col-9 card_avatar_info_user">
                                        <div class="card_txt_h">
                                            <h4 class="card_h4">{{ "{$paciente->user->primernombre} {$paciente->user->primerapellido}" }}</h4>
                                        </div>

                                        <div class="card_txt_h">
                                            <h5 class="card_h5">{{ $paciente->eps }}</h5>
                                        </div>

                                        <div class="card_txt_h">
                                            <h6 class="card_h6">{{ $paciente->user->identificacion }}</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-0">
                                    <div class="col-12 card_avatar_info_user">
                                        <div class="card_txt_span mb-2">
                                            <i data-feather="phone" class="card_icon"></i><span
                                                class="card_span">{{ "{$paciente->celular} - {$paciente->telefono}" }}</span>
                                        </div>

                                        <div class="card_txt_span">
                                            <i data-feather="mail" class="card_icon"></i><span
                                                class="card_span">{{ $paciente->user->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <!-- Pagination buttons -->
            <div class="col-12 d-md-none p-0 mb-4 pagination__right">
                <button class="pag_btn_right"></button>
                <button class="pag_btn_left"></button>
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
