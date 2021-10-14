@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/cubeportfolio-full/css/cubeportfolio.min.css') }}">
@endsection

@section('content')

    <!-- Swiper Banner principal, funcionalidad del swiper alojada en el archivo instituciones.js -->
    <div class="imagen_inst_instProf">
        <div class="img_institucion_instProf" style="background: url('{{URL::asset($institucion[0]->imagen)}}') center center no-repeat;"></div>
        <h1 class="nombre_inst_instProf">{{$institucion[0]->nombreinstitucion}}</h1>
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
                                    <i class="fas fa-arrow-right arrow_mas"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </section>
    </div>--}} -->

    <section class="container-fluid" style="background: #F9F9F9;">
        <!-- Filter -->
        <div class="swiper-container swiper_btn_especialidades"> 
            <ul id="filterControls" class="list-inline cbp-l-filters-alignRight text-center option_line_profInst swiper-wrapper">
                <li class="list-inline-item cbp-filter-item cbp-filter-item-active u-cubeportfolio__item asociado all_asociados swiper-slide" data-filter="*">Asociados</li>
                @foreach($especialidades as $item)
                    <li class="list-inline-item cbp-filter-item u-cubeportfolio__item asociado one_especiality swiper-slide" data-filter=".{{ Str::slug($item) }}">{{ $item }}</li>
                @endforeach
            </ul>
     
        </div>
        
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev btnPrev_especialidades"></div>
        <div class="swiper-button-next btnNext_especialidades"></div> 
        <!-- End Filter -->

        <!-- Contenido de las tarjetas de los profesionales -->
        <div class="container_targets_prof">
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

                    <div class="card cbp-item {{ $esp }}">
                        <img class="img_perfil_instProf" src="{{ asset($profesional->foto_perfil_institucion) }}">

                        <div class="card-body">
                            <h2 class="specialty">{{$especialidad}}</h2>
                            <h2 class="subSpecialty subSpecialty_text">{{$especialidad}}</h2>

                            <h5 class="niega_uppercase">{{$profesional->primer_nombre}} {{$profesional->primer_apellido}}</h5>

                            <p class="specialty">Especialista en {{$especialidad}}</p>
                            <p class="subSpecialty">Especialista en <span class="subSpecialty_text">{{$especialidad}}</span></p>

                            <p>{{$profesional->nombre_universidad}}</p>
                            <h4 class="cargo_profInst">{{$profesional->cargo}}</h4>

                            <div class="btn_tarjeta_prof">
                                <a href=""> Agendar cita
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End Content -->
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/cubeportfolio-full/js/jquery.cubeportfolio.min.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready( function() {
            jQuery('#grid-container').cubeportfolio({
                filters: '#filterControls',
                  



            });

            jQuery ("#grid-container"). on ('updateSinglePageComplete.cbp', function () {
                
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
            const swiper_galeria_prof = new Swiper(".swiper_btn_especialidades", {
                //loop: true,
                //resizeObserver: true,
            
                autoplay: {
                delay: 4500,
                disableOnInteraction: false,
                },
            
                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },
                // Navigation arrows
                navigation: {
                nextEl: '.btnPrev_especialidades',
                prevEl: '.btnNext_especialidades',
                },
            
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 2,
                        slidesPerGroup: 1,
                    },
                    // when window width is >= 768px
                    768: {
                        slidesPerView: 3,
                        slidesPerGroup: 1,
                    },
                    // when window width is >= 1024px
                    1024: {
                        slidesPerView: 4,
                        slidesPerGroup: 1,
                    },
                        // when window width is >= 1360px
                    1360: {
                        slidesPerView: 5,
                        lidesPerGroup: 1,
                    },
                    
                    // when window width is >= 1920px
                    1920: {
                        slidesPerView: 7,
                        lidesPerGroup: 1,
                    },
                }
            });
        });
    </script>
@endsection


