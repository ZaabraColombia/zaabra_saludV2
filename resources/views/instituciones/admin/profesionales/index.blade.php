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
            <h1 class="title_contain_card">Profesionales</h1>
        </div>

        <div class="row m-0 pr-md-3 pr-xl-4">
            <!-- Add professional -->
            <div class="col-md-12 col-lg-2 p-0 mb-4 card_content_btn_add">
                <a href="{{ route('institucion.profesionales.create') }}" class=" py-2 card_btn_add_green"
                   id="btn-agregar-contacto">Agregar profesional
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
            @if($profesionales->isNotEmpty())
                @foreach($profesionales as $profesional)
                    <div class="col-md-6 col-xl-4 p-0 pr-md-3 pr-xl-4 mb-4 card__col">
                        <div class="card container_card p-0">
                            <div class="card__">
                                <div class="row card__row_column">
                                    <!-- Informative buttons desktop-->
                                    <div class="card_content_btn_info col-12 d-none d-md-flex mb-md-1">
                                        <a class="card_btn_info tool top">
                                            <i data-feather="lock" class="icon_btn_info_md"></i> <span class="tiptext">Agenda configurada</span>
                                        </a>

                                        {{--@if (empty($profesional->horario) or empty($profesional->disponibilidad_agenda) or empty( $profesional->consultorio))
                                        <button class="card_btn_info tool top">
                                            <i style="width: 23px" data-feather="lock"></i>
                                            <span class="tiptext">Calendario no configurado</span>
                                        </button>
                                        @else
                                        <button class="card_btn_info tool top">
                                            <i style="width: 23px" data-feather="unlock"></i>
                                            <span class="tiptext">Calendario configurado</span>
                                        </button>
                                        @endif--}}

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
                                    <!-- Image professional -->
                                    <div class="col-md-3 p-0 mb-2 d-flex justify-content-center align-self-md-start">
                                        <a href="{{ route('PerfilInstitucion-profesionales', ['slug' => $profesional->institucion->slug, 'prof' => "$profesional->primer_nombre $profesional->primer_apellido"]) }}"
                                           target="_blank">
                                            <img class="card__imagen"
                                                 src='{{ asset($profesional->foto_perfil_institucion ?? 'img/menu/avatar.png') }}'>
                                        </a>
                                    </div>
                                    <!-- Information professional -->
                                    <div class="col-md-9 mb-3 card_info_user">
                                        <div class="card_txt_h">
                                            <h4 class="card_h4">{{ $profesional->nombre_completo }}</h4>
                                        </div>

                                        <div class="card_txt_h">
                                            <h5 class="card_h5">{{ $profesional->nombre_especialidad ?? '' }}</h5>
                                        </div>
                                        <!-- Informative buttons mobile-->
                                        <div class="card_content_btn_info d-md-none">
                                            <a class="card_btn_info tool top">
                                                <i data-feather="lock"></i> <span
                                                    class="tiptext">Calendario no configurado</span>
                                            </a>

                                            {{--@if (empty($profesional->horario) or empty($profesional->disponibilidad_agenda) or empty( $profesional->consultorio))
                                            <button class="card_btn_info tool top">
                                                <i style="width: 23px" data-feather="lock"></i>
                                                <span class="tiptext">Calendario no configurado</span>
                                            </button>
                                            @else
                                            <button class="card_btn_info tool top">
                                                <i style="width: 23px" data-feather="unlock"></i>
                                                <span class="tiptext">Calendario configurado</span>
                                            </button>
                                            @endif--}}

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

                                    <div class="col-12 p-0 card_content_btn_center">
                                        <button class="card_btn_see_green" data-toggle="modal" data-target="#modal_see_professional">Ver más</button>
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

    <!-- Modal see professional -->
    <div class="modal fade" id="modal_see_professional" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal__">
                <!-- Modal header -->
                <div class="modal-header row m-0 px-3 pl-lg-4">
                    <div class="col-12 p-0">
                        <button type="button" class="close modal_btn_close_top" data-dismiss="modal" aria-label="Close">
                            <span class="modal_x_close" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Título principal verde -->
                    <div class="col-12 modal_main_title">
                        <h1 class="modal_title_green">Ver Profesional</h1>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body px-3 px-lg-4 m-0 mb-lg-3">
                    <!-- Sección data sin borde -->
                    <div class="modal_info_data_open">
                        <div class="row m-0">
                            <div class="col-12 modal_info_user">
                                <h4 class="modal_data_form">Nombre:</h4>
                                <div class="modal_data_user">
                                    <span id="nombre">María Carolina Pérez Perdomo</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Identificación:</h4>
                                <div class="modal_data_user">
                                    <span id="">C.C. 52458791</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Fecha de nacimiento:</h4>
                                <div class="modal_data_user">
                                    <span id="">28/11/1985</span>
                                </div>
                            </div>

                            <div class="col-12 dropdown-divider"></div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Correo:</h4>
                                <div class="modal_data_user">
                                    <span id="">mariacaro85@gmail.com</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Teléfono:</h4>
                                <div class="modal_data_user">
                                    <span id="">0000000</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Móvil:</h4>
                                <div class="modal_data_user">
                                    <span id="">300 000 0000</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Dirección:</h4>
                                <div class="modal_data_user">
                                    <span id="">Calle 127A # 7-53 Cs 7003</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">País:</h4>
                                <div class="modal_data_user">
                                    <span id="">Colombia</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Departamento:</h4>
                                <div class="modal_data_user">
                                    <span id="">Norte de Santander</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Ciudad:</h4>
                                <div class="modal_data_user">
                                    <span id="">Santo Domingo de Silos</span>
                                </div>
                            </div>

                            <div class="col-12 dropdown-divider"></div>

                            <div class="col-lg-12 modal_info_user">
                                <h4 class="modal_data_form">Especialidad principal:</h4>
                                <div class="modal_data_user">
                                    <span id="">Otorrinolaringología</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Tarjeta profesional</h4>
                                <div class="modal_data_user">
                                    <span id="">000000</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Cargo:</h4>
                                <div class="modal_data_user">
                                    <span id="">Presidente</span>
                                </div>
                            </div>

                            <div class="col-lg-6 modal_info_user">
                                <h4 class="modal_data_form">Universidad:</h4>
                                <div class="modal_data_user">
                                    <span id="">Universidad del Rosario</span>
                                </div>
                            </div>

                            <div class="col-lg-12 modal_info_user d-lg-block">
                                <h4 class="modal_data_form">Otras especialidades:</h4>
                                <div class="modal_data_user_bg">
                                    <span class="modal_data_user_bg" id="">Cirugía plástica facial</span>
                                    <span class="modal_data_user_bg" id="">Rinitis alérgica y sinusitis</span>
                                    <span class="modal_data_user_bg" id="">Otorrinolaringología</span>
                                    <span class="modal_data_user_bg" id="">Cirugía plástica facial</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modalfooter -->
                <div class="modal_btn_down_center mb-4">
                    <button type="button" class="modal_btn_green" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

    <script>
        //crear bloqueo
        $('.bloquear-agenda').on('click', function (eve) {
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
