@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/cubeportfolio-full/css/cubeportfolio.min.css') }}">
@endsection

@section('content')

    <!-- Swiper Banner principal, funcionalidad del swiper alojada en el archivo instituciones.js -->
    <section class="swiper-container swiper_principalInstProf">
        <div class="swiper-wrapper">
        @foreach ($objbannersprincipalInstitucionProfesionales as $objbannersprincipalInstitucionProfesionales)
            <div class="swiper-slide ">
                <img class="swiper-slide" src="{{ asset($objbannersprincipalInstitucionProfesionales->rutaImagenVenta) }}">
                <div class="containt_slide_instProf"> <!--estilos de la clase "containt_slide_prinProf" ubicados en el archivo especialidades.scss -->
                    @if(!empty($objbannersprincipalInstitucionProfesionales->titulo_banner))
                        <h1 class="titulo_banner_prof" style="color:{{($objbannersprincipalInstitucionProfesionales->color_titulo)}};">{{($objbannersprincipalInstitucionProfesionales->titulo_banner)}}</h1>
                    @endif

                    @if(!empty($objbannersprincipalInstitucionProfesionales->texto_banner))
                        <p class="texto_banner_prof" style="color:{{($objbannersprincipalInstitucionProfesionales->color_texto)}};">{{($objbannersprincipalInstitucionProfesionales->texto_banner)}}</p>
                    @endif

                    @if(!empty($objbannersprincipalInstitucionProfesionales->urlBoton_banner))
                        <a class="btn_agendarHome" type="submit" href="{{($objbannersprincipalInstitucionProfesionales->urlBoton_banner)}}" target="blank"> {{ __('Ver más') }}
                            <img class="flecha_ingreso-membresia" src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" alt="">
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
        </div>
    </section>

    <!-- Tarjetas profesionales de la institución -->
    <div class="container_principal_instProf">
        <section class="container_tarjetas_instProf">
            @foreach ($objProfesionalesIns as $profesional)
                <div class="card tarjeta_instProf">
                    <img class="img_perfil_instProf" src="{{ asset($profesional->foto_perfil_institucion) }}">
                    <div class="card-body content_tarjeta_instProf">
                        <h2>{{$profesional->nombre_especialidad}}</h2>
                        <h5 class="niega_uppercase">{{$profesional->primer_nombre}} {{$profesional->primer_apellido}}</h5>
                        <p>Especialista en {{$profesional->nombre_especialidad}}</p>
                        <p>{{$profesional->nombre_universidad}}</p>
                        <div class="content_btn_instprof">
                            <a class="btn_agendar_instProf" href=""> Agendar cita
                                <i class="fas fa-arrow-right arrow_mas"></i>
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </section>
    </div>
    <section class="container mb-5">
        <div class="">
            <!-- Filter -->
            <ul id="filterControls" class="list-inline cbp-l-filters-alignRight text-center">
                <li class="list-inline-item cbp-filter-item cbp-filter-item-active u-cubeportfolio__item" data-filter="*">Asociados</li>
                @foreach($especialidades as $item)
                    <li class="list-inline-item cbp-filter-item u-cubeportfolio__item" data-filter=".{{ Str::slug($item) }}">{{ $item }}</li>
                @endforeach
            </ul>
            <!-- End Filter -->

            <!-- Content -->
            <div id="grid-container">
                @foreach ($objProfesionalesIns as $profesional)
                    <div class="card tarjeta_instProf cbp-item {{ Str::slug($profesional->nombre_especialidad) }}">
                        <img class="img_perfil_instProf" src="{{ asset($profesional->foto_perfil_institucion) }}">
                        <div class="card-body content_tarjeta_instProf">
                            <h2>{{$profesional->nombre_especialidad}}</h2>
                            <h5 class="niega_uppercase">{{$profesional->primer_nombre}} {{$profesional->primer_apellido}}</h5>
                            <p>Especialista en {{$profesional->nombre_especialidad}}</p>
                            <p>{{$profesional->nombre_universidad}}</p>
                            <div class="content_btn_instprof">
                                <a class="btn_agendar_instProf" href=""> Agendar cita
                                    <i class="fas fa-arrow-right arrow_mas"></i>
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
                mediaQueries: [
                    {"width" : 1500, "cols" : 4},
                    {"width" : 1100, "cols" : 4},
                    {"width" : 800, "cols" : 3},
                    {"width" : 480, "cols" : 2},
                    {"width" : 380, "cols" : 1},
                ]
            });
        });
    </script>
@endsection


