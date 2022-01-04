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

    <!-- {{--
    <div class="container_principal_instProf">
        <section class="container_tarjetas_instProf">
            @foreach ($objProfesionalesIns as $profesional)
                <div class="card tarjeta_instProf">
                    <img class="img_perfil_instProf" src="{{ asset($profesional->foto_perfil_institucion) }}">
                    <div class="card-body content_tarjeta_instProf">
                        @if(!empty($profesional->nombre_especialidad))
                            <h2>{{$profesional->nombre_especialidad}}</h2>
                        @endif
                        <h5 class="niega_uppercase">{{$profesional->primer_nombre}} {{$profesional->primer_apellido}}</h5>
                        @if(!empty($profesional->nombre_especialidad))
                            <p>Especialista en {{$profesional->nombre_especialidad}}</p>
                        @endif
                        <p>{{$profesional->nombre_universidad}}</p>

                            <p>{{$profesional->cargo}}</p>

                        @if(!empty($profesional->nombre_especialidad))
                            <div class="content_btn_instprof">
                                <a class="btn_agendar_instProf" href=""> Agendar cita
                                    <i class="fas fa-arrow-right pl-2"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </section>
    </div>--}} -->
    
    <section class="container-fluid content_main mb-5">
        <!-- Carrusel de especialidades -->
        <div class="swiper-container swiper_especialidad"> 
            <ul id="filterControls" class="list-inline cbp-l-filters-alignRight swiper-wrapper pt-5">
                @if($institucion[0]->idtipoInstitucion == 9)
                    <li class="list-inline-item cbp-filter-item cbp-filter-item-active u-cubeportfolio__item asociado all_asociados swiper-slide" data-filter="*">Asociados</li>
                @else
                    <li class="list-inline-item cbp-filter-item cbp-filter-item-active u-cubeportfolio__item asociado all_asociados swiper-slide" data-filter="*">Profesionales</li>
                @endif
                @foreach($especialidades as $item)
                    <li class="list-inline-item cbp-filter-item u-cubeportfolio__item asociado one_especiality swiper-slide" data-filter=".{{ Str::slug($item) }}">{{ $item }}</li>
                @endforeach
            </ul>
    
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev btn_prev"></div>
            <div class="swiper-button-next btn_next"></div> 
        </div>

        <!-- Contenido de las tarjetas de los profesionales -->
            <div id="grid-container" class="container_grid">
                @foreach ($objProfesionalesIns as $profesional)
                    <?php
                        $esp = '';

                        if (!empty($profesional->especialidades->toArray()))
                        {
                            foreach ($profesional->especialidades as $item)
                            $esp .= Str::slug($item->nombreEspecialidad) . ' ';

                            $especialidad = $profesional->especialidades[0]->nombreEspecialidad; 
                        }
                        else {
                            $especialidad = $profesional->nombre_especialidad;
                            $esp = Str::slug($especialidad);
                        }
                    ?>

                    <div class="card cbp-item {{ $esp }} pt-4">
                        <img class="img_professional" src="{{ asset($profesional->foto_perfil_institucion) }}">

                        <div class="card-body px-1 py-3">
                            <h2 class="specialty titulo_card mb-1">{{$especialidad}}</h2>
                            <h2 class="subSpecialty subSpecialty_text titulo_card mb-1">{{$especialidad}}</h2>

                            <h2 class="niega_uppercase subTitulo_card">{{$profesional->primer_nombre}} {{$profesional->primer_apellido}}</h2>

                            <p class="specialty text_card">Especialista en {{$especialidad}}</p>
                            <p class="subSpecialty text_card">Especialista en <span class="subSpecialty_text">{{$especialidad}}</span></p>

                            <p class="name_university text_univ_card">{{$profesional->nombre_universidad}}</p>
                            <h2 class="cargo_profInst text_cargo_card">{{$profesional->cargo}}</h2>
                   

                            <div class="content_btn_cardProf mt-1">
                                <a class="btn_cardProf" href=""> Agendar cita
                                    <i class="fas fa-arrow-right pl-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

    </section>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/cubeportfolio-full/js/jquery.cubeportfolio.min.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready( function() {
            jQuery('#grid-container').cubeportfolio({
                filters: '#filterControls',
                mediaQueries: [
                    {"width" : 1500, "cols" : 7},
                    {"width" : 1300, "cols" : 6},
                    {"width" : 1100, "cols" : 5},
                    {"width" :  900, "cols" : 4},
                    {"width" :  700, "cols" : 3},
                    {"width" :  300, "cols" : 2},
                ]
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
    </script>
@endsection


