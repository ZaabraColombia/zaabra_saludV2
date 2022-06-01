@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/cubeportfolio-full/css/cubeportfolio.min.css') }}">
@endsection

@section('content')

    <!-- Swiper Banner principal, funcionalidad del swiper alojada en el archivo instituciones.js -->
    <div class="content_bannerMain">
        <div class="image_bannerMain" style="background: url('{{URL::asset($institucion[0]->imagen)}}') center center no-repeat;"></div>
        <h1 class="titulo_bannerMain">{{$institucion[0]->nombreinstitucion}}</h1>
    </div>

    <section class="container-fluid content_main mb-5">
        <!-- Barra de búsqueda -->
        <div class="containt__buscador mt-5">
            {{--
            <div class="" id="barra_busqueda">
                <input id="filtro-box" type="text" placeholder="Especialidad, Médico o Universidad"
                       data-search=".searching" class="buscador__input" value="{{ request()->prof }}">
                <button class="buscador__button buscador__icon"></button>
            </div>
            --}}

            <div class="buscador" id="barra_busqueda">
                <input id="js-search-blog-posts" type="text" placeholder="Especialidad, Médico o Universidad"
                       autocomplete="off" data-search=".searching" class="bp-search-input buscador__input">
                <button class="buscador__button buscador__icon"></button>
            </div>
        </div>
        <!-- Carrusel de especialidades -->
        <div class="swiper-container swiper_especialidad">
            <ul id="filterControls" class="list-inline cbp-l-filters-alignRight swiper-wrapper pt-5">
                @if($institucion[0]->idtipoInstitucion == 9)
                    <li class="list-inline-item cbp-filter-item cbp-filter-item-active u-cubeportfolio__item asociado all_asociados swiper-slide" data-filter="*">Asociados</li>
                @else
                    <li class="list-inline-item cbp-filter-item cbp-filter-item-active u-cubeportfolio__item asociado all_asociados swiper-slide" data-filter="*">Profesionales</li>
                @endif

                @foreach($especialidades as $item)
                    <li class="list-inline-item cbp-filter-item u-cubeportfolio__item asociado one_especiality swiper-slide" data-filter=".{{ Str::slug($item->nombreEspecialidad ?? '') }}">{{ $item->nombreEspecialidad ?? '' }}</li>
                @endforeach
            </ul>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev btn_prev"></div>
            <div class="swiper-button-next btn_next"></div>
        </div>

        <!-- Contenido de las tarjetas de los profesionales -->
        <div id="grid-container" class="container_grid">
            @if($profesionales->isNotEmpty())

                @foreach ($profesionales as $profesional)
                    @php
                        $esp = " " . Str::slug($profesional->especialidad_principal->nombreEspecialidad ?? '');
                        $esp .= " " . $profesional->especialidades->map(function ($item) {return  Str::slug($item->nombreEspecialidad ?? '');})->implode(" ");
                        $filtro = $profesional->especialidad_principal->nombreEspecialidad ?? '';
                        $filtro .= " ".$profesional->especialidades->pluck('nombreEspecialidad')->implode(' ');

                    @endphp

                    <div class="card cbp-item {{ $esp ?? '' }} pt-4 zoom_img">
                        <img class="img_professional" src="{{ asset($profesional->foto_perfil_institucion) }}">

                        <div class="card-body px-1 py-3">
                            <h2 class="specialty titulo_card mb-1 searching">{{$profesional->especialidad_principal->nombreEspecialidad ?? ''}}</h2>
                            <h2 class="subSpecialty subSpecialty_text titulo_card mb-1">{{$profesional->especialidad_principal->nombreEspecialidad ?? ''}}</h2>

                            <h2 class="niega_uppercase subTitulo_card searching">{{$profesional->primer_nombre}} {{$profesional->primer_apellido}}</h2>

                            <p class="specialty text_card searching">Especialista en {{$profesional->especialidad_principal->nombreEspecialidad ?? ''}}</p>
                            <p class="subSpecialty text_card">Especialista en <span class="subSpecialty_text">{{$profesional->especialidad_principal->nombreEspecialidad ?? ''}}</span></p>

                            <p class="name_university text_univ_card searching">{{$profesional->universidad->nombreuniversidad}}</p>
                            <h2 class="cargo_profInst text_cargo_card searching">{{$profesional->cargo}}</h2>
                            <div style="display: none" class="searching">{{ $filtro ?? '' }}  {{ eliminar_tildes("{$profesional->primer_nombre} {$profesional->primer_apellido}") }}</div>

                            <div class="content_btn_center mt-1">
                                <a class="btn_card_green" href="{{ route('paciente.asignar-cita-institucion-profesional', ['profesional' => $profesional->slug]) }}"> Agendar cita
                                    <i class="fas fa-arrow-right pl-1"></i>
                                </a>
                            </div>
                            <div class="content_btn_center mt-1">
                                <button class="btn_ver_mas btn-servicios" data-id="{{ $profesional->id_profesional_inst }}">Ver más</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </section>

    @if(session()->has('error-agenda'))
        <!-- Modal agenda profesinal no disponible -->
        <div class="modal fade" id="modal_agenda_no_disponible" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal_container">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <h1>Disponibilidad de Agenda</h1>

                        <div class="">
                            <div class="card card_day mb-2">
                                <div class="card-header">
                                    <div class="card_header_day"></div>
                                    <div class="card_header_day"></div>
                                </div>

                                <div class="card-body">
                                    <div class="elemento_no_disponible">
                                        <i data-feather="cloud-off" class="no_disponible"></i>
                                    </div>
                                </div>
                                <div class="card-footer"></div>
                            </div>

                            <div class="text-center p-3">
                                <p class="black_light fs_text">Profesional {{ session('error-agenda')['nombre'] }}</p>
                                <p class="black_light fs_text">Especialización {{ session('error-agenda')['especialidad'] }}</p>
                                <p class="black_light fs_text">Actualmente no tiene agenda disponible.</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer content_btn_center">

                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(session()->has('warning-profesional'))
        <!-- Modal info iniciar login como paciente -->
        <div class="modal fade" id="modal_profesional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal_container">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="elemento_infortmativo mt-3">
                            <i data-feather="alert-triangle" class="informativo"></i>
                        </div>

                        <div class="text-center mt-4 px-3 py-0">
                            <p class="black_light fs_text">Para agendar cita medica, inicie sesión como paciente.</p>
                        </div>
                    </div>

                    <div class="modal-footer content_btn_center">
                        <button type="button" class="button_transparent" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Servicios profesional de una institución -->
    <div class="modal fade" id="modal-profesional-servicios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                </div>
                <!-- modal body -->
                <div class="modal-body">
                    <!-- Información del profeisonal -->
                    <div class="row align-items-md-center mx-0 mb-4">
                        <div class="col-md-3 col-lg-2 d-flex justify-content-center mb-3 mb-md-0 p-0">
                            <img class="img__see_contacs" id="modal-foto" />
                        </div>
                        <div class="col-md-9 col-lg-10 p-0 pl-md-2">
                            <h5 class="fs_subtitle_module black_strong" id="modal-profesional"></h5>
                            <p class="fs_text green_bold" id="modal-especialidad"></p>
                        </div>
                    </div>
                    <!-- Servicios del profesional -->
                    <div class="acordeon" id="collapsed">
                        <!-- Servicio visible -->
                        <div class="row mx-0 mb-4 text-center text-md-left">
                            <div class="col-md-7 p-0 py-md-1">
                                <h5 class="fs_text black_strong mb-1 mb-md-0">Otorrinolaringología - Procedimiento quirúrgico</h5>
                            </div>

                            <div class="col-md-3 p-0 py-md-1 d-flex justify-content-center align-items-center">
                                <span class="fs_text black_light">$ 0.000.000</span>
                            </div>

                            <div class="col-md-2 p-0 py-md-1 mt-1 mt-md-0 content_btn_center">
                                <button class="btn_card_green">Agendar</button>
                            </div>
                        </div>

                        <!-- Servicio oculto en desplegable -->
                        <div class="row mx-0 mb-4 text-center text-md-left justify-content-center">
                            <div class="card-header col-md-7 p-0 servicio_medico" id="servicio_one">
                                <h5 class="p-0 mb-0 fs_text black_strong" >
                                    Otorrinolaringología - Procedimiento quirúrgico
                                </h5>
                            </div>

                            <div class="col-md-3 p-0 py-md-1 d-flex justify-content-center align-items-center">
                                <span class="fs_text black_light">$ 0.000.000</span>
                            </div>

                            <button class="d-none d-md-block col-md-2 p-0 btn_ver_servicio green_light" type="button" data-toggle="collapse"
                                    data-target="#collapse_one" aria-expanded="true" aria-controls="collapse_one" onclick="cambiarTexto()" id="texto2">
                                Ver más
                            </button>

                            <div id="collapse_one" class="collapse" aria-labelledby="servicio_one" data-parent="#collapsed">
                                <div class="card-body pt-2 px-2 pb-0">
                                    Los precios de este servico pueden variar según el caso. Para agendar una cita, comuníquese al 000 0000.
                                </div>
                            </div>

                            <button class="d-md-none d-md-2 p-0 mt-2 btn_ver_servicio green_light" type="button" data-toggle="collapse"
                                    data-target="#collapse_one" aria-expanded="true" aria-controls="collapse_one" onclick="cambiarTexto()" id="texto">
                                Ver más
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div
@endsection

@section('scripts')
    <script src="{{ asset('plugins/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('plugins/cubeportfolio-full/js/jquery.cubeportfolio.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <script>
        feather.replace()
    </script>

    <script type="text/javascript">
        @if (session()->has('error-agenda')) $('#modal_agenda_no_disponible').modal();@endif
        @if(session()->has('warning-profesional')) $('#modal_profesional').modal(); @endif
        @php $rest = request()->prof;@endphp

        jQuery(document).ready( function() {
            'use strict';

            var cube = jQuery('#grid-container');
            cube.cubeportfolio('init', {
                layoutMode: 'grid',
                filterDeeplinking: true,
                //caption: 'revealBottom',
                filters: '#filterControls',
                //search: '#filtro-box',
                search: '#js-search-blog-posts',
                mediaQueries: [
                    {"width" : 1500, "cols" : 7},
                    {"width" : 1300, "cols" : 6},
                    {"width" : 1100, "cols" : 5},
                    {"width" :  900, "cols" : 4},
                    {"width" :  700, "cols" : 3},
                    {"width" :  300, "cols" : 2},
                ]
            });
            cube.on('initComplete.cbp', function (event) {
                @if(!empty($rest))
                $('input#js-search-blog-posts').val('{{ $rest }}').trigger('keyup');
                @endif
            });

        });


        $(document).ready(function(){
            $(".all_asociados").on( "click", function() {
                $('.specialty').show();
                $('.cargo_profInst').show();
                $('.subSpecialty').hide();
            });
            $(".one_especiality").on( "click", function() {
                $('.subSpecialty').show();
                $('.subSpecialty_text').text($(this).text());
                $('.specialty').hide();
                $('.cargo_profInst').hide();
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Función para el slider de la línea de opciones de la landing page instituciones
            const swiper_galeria_prof = new Swiper(".swiper_especialidad", {
                //loop: true,
                //resizeObserver: true,

                autoplay: {
                    delay: 5500,
                    disableOnInteraction: false,
                },

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },
                // Navigation arrows
                navigation: {
                    nextEl: '.btn_next',
                    prevEl: '.btn_prev',
                },

                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 2,
                        slidesPerGroup: 1,
                        spaceBetween: 15,
                    },
                    // when window width is >= 768px
                    600: {
                        slidesPerView: 4,
                        slidesPerGroup: 1,
                        spaceBetween: 20,
                    },
                    // when window width is >= 1024px
                    1024: {
                        slidesPerView: 5,
                        slidesPerGroup: 1,
                        spaceBetween: 20,
                    },
                    // when window width is >= 1360px
                    1360: {
                        slidesPerView: 6,
                        lidesPerGroup: 1,
                        spaceBetween: 20,
                    },

                    // when window width is >= 1920px
                    1920: {
                        slidesPerView: 8,
                        lidesPerGroup: 1,
                        spaceBetween: 20,
                    },
                }
            });
        });

        $('.btn-servicios').click(function () {
            var btn = $(this);
            $.ajax({
                url: '{{ route('institucion.profesional-servicios') }}',
                method: 'post',
                header:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {profesional: btn.data('id')},
                dataType: 'json',
                success: function (response) {
                    $('#modal-profesional').html(response.nombre);
                    $('#modal-especialidad').html(response.especialidad);
                    $('#modal-foto').attr('src', response.foto);

                    var servicios = $('#collapsed');
                    servicios.empty();

                    $.each(response.servicios, function (key, item) {

                        if (item.virtual) {
                            servicios.append('<div class="row mx-0 mb-4 text-center text-md-left">' +
                                '<div class="col-md-7 p-0 py-md-1">' +
                                '<h5 class="fs_text black_strong mb-1 mb-md-0">' +
                                item.nombre +
                                '</h5>' +
                                '</div>' +

                                '<div class="col-md-3 p-0 py-md-1 d-flex justify-content-center align-items-center">' +
                                '<span class="fs_text black_light">' +
                                item.valor +
                                '</span>' +
                                '</div>' +

                                '<div class="col-md-2 p-0 py-md-1 mt-1 mt-md-0 content_btn_center">' +
                                '<a href="' + item.url + '" class="btn_card_green">Agendar</a>' +
                                '</div>' +
                                '</div>');
                        } else {
                            servicios.append('<div class="row mx-0 mb-4 text-center text-md-left justify-content-center">' +
                                '<div class="card-header col-md-7 p-0 servicio_medico" id="servicio_one">' +
                                '<h5 class="p-0 mb-0 fs_text black_strong" >' +
                                item.nombre +
                                '</h5>' +
                                '</div>' +

                                '<div class="col-md-3 p-0 py-md-1 d-flex justify-content-center align-items-center">' +
                                '<span class="fs_text black_light">' +
                                item.valor +
                                '</span>' +
                                '</div>' +

                                '<button class="d-none d-md-block col-md-2 p-0 btn_ver_servicio green_light" type="button" data-toggle="collapse"' +
                                'data-target="#collapse_one" aria-expanded="true" aria-controls="collapse_one" onclick="cambiarTexto()" id="texto2">' +
                                'Ver más' +
                                '</button>' +

                                '<div id="collapse_one" class="collapse" aria-labelledby="servicio_one" data-parent="#collapsed">' +
                                '<div class="card-body pt-2 px-2 pb-0">' +
                                'Los precios de este servico pueden variar según el caso. Para agendar una cita, comuníquese al {{ $institucion[0]->telefonouno }}.' +
                                '</div>' +
                                '</div>' +

                                '<button class="d-md-none d-md-2 p-0 mt-2 btn_ver_servicio green_light" type="button" data-toggle="collapse"' +
                                'data-target="#collapse_one" aria-expanded="true" aria-controls="collapse_one" onclick="cambiarTexto()" id="texto">' +
                                'Ver más' +
                                '</button>' +
                                '</div>');
                        }
                    });

                    $('#modal-profesional-servicios').modal();
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });

        // Función para cambiar el texto del botón desplegable "Más información"
        function cambiarTexto() {
            texto.innerHTML=texto.innerHTML=="Ver menos"?"Ver más":"Ver menos";
            texto2.innerHTML=texto2.innerHTML=="Ver menos"?"Ver más":"Ver menos";
        }
    </script>
@endsection


