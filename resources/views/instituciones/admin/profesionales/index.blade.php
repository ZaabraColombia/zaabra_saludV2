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
    <div class="container-fluid px-3 px-md-5 px-xl-5 width_xl_95">
        <div class="my-4">
            <h1 class="title_contain_card">Profesionales</h1>
        </div>

        <!-- Contenedor barra de búsqueda, botón agregar contacto, descargas y paginación -->
        <div class="row m-0">

            <div class="col-md-12 col-lg-2 p-0 card_content_btn_add mb-4">
                <a href="{{ route('institucion.profesionales.create') }}" class="card_btn_add_green py-2"
                   id="btn-agregar-contacto">
                    Agregar profesional
                </a>
            </div>
            <div class="col-md-6 col-lg-6 pl-0 pr-0 pr-md-2 pr-xl-1 mb-4 card_btn_search">
                <form method="get">
                    <button id="search" type="button" class="{{ (request('search')) ? 'search_togggle':'' }}">
                        <input class="mb-0" type="search" name="search" id="search" placeholder="Buscar" value="{{ request('search') }}">
                    </button>
                </form>
            </div>

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

            <div class="col-md-2 col-lg-1 d-none d-md-flex p-0 mb-4 pagination__right">
                @if(!$profesionales->onFirstPage())
                    <a href="{{ $profesionales->previousPageUrl() }}" class="pag_btn_right"></a>
                @else
                    <button disabled class="pag_btn_right disabled"></button>
                @endif
                @if(!$profesionales->onLastPage())
                    <a href="{{ $profesionales->nextPageUrl() }}" class="pag_btn_left"></a>
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

            @if($profesionales->isNotEmpty())
                @foreach($profesionales as $profesional)
                    <div class="col-md-6 col-xl-4 p-0 px-md-1 mb-3">
                        <div class="card container_card p-0">
                            <div class="card__">
                                <div class="row card__row_column">
                                    <div class="card_content_btn_info col-12 d-none d-md-flex mb-md-1">
                                        <a class="card_btn_info tool top"
                                           href="{{ route('institucion.profesionales.edit', ['profesional' => $profesional->id_profesional_inst]) }}">
                                            <i data-feather="lock" class="icon_btn_info_md"></i> <span class="tiptext">Editar profesional</span>
                                        </a>

                                        <a class="card_btn_info tool top"
                                           href="{{ route('institucion.profesionales.edit', ['profesional' => $profesional->id_profesional_inst]) }}">
                                            <i data-feather="edit" class="icon_btn_info_md"></i> <span class="tiptext">Editar profesional</span>
                                        </a>

                                        <a class="card_btn_info tool top"
                                           href="{{ route('institucion.profesionales.configurar_calendario', ['profesional' => $profesional->id_profesional_inst]) }}">
                                            <i data-feather="calendar" class="icon_btn_info_md"></i> <span
                                                class="tiptext">Configurar agenda</span>
                                        </a>

                                        <button class="card_btn_info tool top bloquear-agenda"
                                                data-url="{{ route('institucion.profesionales.bloquear-calendario', ['profesional' => $profesional->id_profesional_inst]) }}">
                                            <i data-feather="slash" class="icon_btn_info_md"></i> <span class="tiptext">Bloquear agenda</span>
                                        </button>
                                    </div>

                                    <div class="col-md-3 p-0 mb-2 d-flex justify-content-center align-self-md-start">
                                        <a href="{{ route('PerfilInstitucion-profesionales', ['slug' => $profesional->institucion->slug, 'prof' => "$profesional->primer_nombre $profesional->primer_apellido"]) }}"
                                           target="_blank">
                                            <img class="card__imagen"
                                                 src='{{ asset($profesional->foto_perfil_institucion ?? 'img/menu/avatar.png') }}'>
                                        </a>
                                    </div>

                                    <div class="col-md-9 card_info_user">
                                        <div class="card_txt_h">
                                            <h4 class="card_h4">{{ $profesional->nombre_completo }}</h4>
                                        </div>

                                        <div class="card_txt_h">
                                            <h5 class="card_h5">{{ $profesional->nombre_especialidad ?? '' }}</h5>
                                        </div>

                                        <div class="card_content_btn_info d-md-none">
                                            <a class="card_btn_info tool top"
                                               href="{{ route('institucion.profesionales.edit', ['profesional' => $profesional->id_profesional_inst]) }}">
                                                <i data-feather="lock"></i> <span
                                                    class="tiptext">Editar profesional</span>
                                            </a>

                                            <a class="card_btn_info tool top"
                                               href="{{ route('institucion.profesionales.edit', ['profesional' => $profesional->id_profesional_inst]) }}">
                                                <i data-feather="edit"></i> <span
                                                    class="tiptext">Editar profesional</span>
                                            </a>

                                            <a class="card_btn_info tool top"
                                               href="{{ route('institucion.profesionales.configurar_calendario', ['profesional' => $profesional->id_profesional_inst]) }}">
                                                <i data-feather="calendar"></i> <span
                                                    class="tiptext">Configurar agenda</span>
                                            </a>

                                            <button class="card_btn_info tool top bloquear-agenda"
                                                    data-url="{{ route('institucion.profesionales.bloquear-calendario', ['profesional' => $profesional->id_profesional_inst]) }}">
                                                <i data-feather="slash"></i> <span
                                                    class="tiptext">Bloquear agenda</span>
                                            </button>
                                        </div>

                                        <div class="toolt bottom">
                                            <div class="card_txt_span mail">
                                                <i data-feather="mail" class="card_icon"></i><span
                                                    class="card_span">{{ $profesional->correo }}</span>
                                            </div>
                                            <span class="tiptext">{{ $profesional->correo }}</span>
                                        </div>

                                        <div class="card_txt_span">
                                            <i data-feather="phone" class="card_icon"></i><span
                                                class="card_span">{{ "{$profesional->celular} - {$profesional->telefono}" }}</span>
                                        </div>

                                        <div class="card_txt_span">
                                            <i data-feather="map-pin" class="card_icon"></i><span
                                                class="card_span">{{ $profesional->direccion }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="col-12 d-md-none p-0 mb-4 pagination__right">
                <button class="pag_btn_right"></button>
                <button class="pag_btn_left"></button>
            </div>
        </div>
    </div>

    <!-- Modal  bloquear cita -->
    <div class="modal fade" id="modal-bloquear-agenda" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" id="form-bloquear-agenda">
                    @csrf
                    <div class="modal-body">
                        <h1 style="color: #019f86">Bloquear Agenda</h1>

                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-reasignar"></div>

                                <div class="col-12 col-md-6 pl-0 pr-1">
                                    <label for="fecha_inicio">Fecha inicio</label>
                                    <input type="datetime-local" id="fecha_inicio" name="fecha_inicio">
                                </div>

                                <div class="col-12 col-md-6 pr-0 pl-1">
                                    <label for="fecha_fin">Fecha fin</label>
                                    <input type="datetime-local" id="fecha_fin" name="fecha_fin">
                                </div>

                                <div class="col-12 p-0">
                                    <label for="observacion">Comentarios</label>
                                    <textarea name="observacion" id="observacion" cols="35" rows="5"></textarea>
                                </div>
                            </div>
                            <input type="hidden" id="id_cita-reasignar" name="id_cita"/>
                        </div>
                    </div>

                    <div class="modal-footer content_btn_center">
                        <button type="button" class="button_transparent" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="button_green">Bloquear</button>
                    </div>
                </form>
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
                    targets: [-1, -2],
                    orderable: false,
                }
            ],
            paging: true,

        });

        $("#search").on('keyup change', function () {
            var texto = $(this).val();
            table.search(texto).draw();
        });

        //crear bloqueo
        table.on('click', '.bloquear-agenda', function (eve) {
            var btn = $(this);
            console.log('ok');

            $('#form-bloquear-agenda')[0].reset();
            $('#form-bloquear-agenda').attr('action', btn.data('url'));
            $('#modal-bloquear-agenda').modal();

        });

        $('#form-bloquear-agenda').submit(function (e) {
            e.preventDefault();

            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'json',
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    $('#alertas').html(alert(response.message, 'success'));
                    $('#modal-bloquear-agenda').modal('hide');
                },
                error: (response) => {
                    $('#alertas').html(alert(response.responseJSON.message, 'danger'));
                    $('#modal-bloquear-agenda').modal('hide');
                }
            });
        });
    </script>

    <script>
        $('#search').on('click', function () {
            $('#search').addClass('search_togggle');
        });
    </script>
@endsection
