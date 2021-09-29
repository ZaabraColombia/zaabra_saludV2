@extends('layouts.app')

@section('content')

    <!-- Swiper Banner principal, funcionalidad del swiper alojada en el archivo instituciones.js -->
    <section class="swiper-container swiper_principalInstProf">
        <div class="swiper-wrapper">
        @foreach ($objbannersprincipalInstitucionProfesionales as $objbannersprincipalInstitucionProfesionales)
            <div class="swiper-slide ">
                <img class="swiper-slide" src="{{URL::asset($objbannersprincipalInstitucionProfesionales->rutaImagenVenta)}}">
                <div class="containt_slide_instProf"> <!--estilos de la clase "containt_slide_prinProf" ubicados en el archivo especialidades.scss -->
                    @if(!empty($objbannersprincipalInstitucionProfesionales->titulo_banner))
                        <h1 class="titulo_banner_prof" style="color:{{($objbannersprincipalInstitucionProfesionales->color_titulo)}};">{{($objbannersprincipalInstitucionProfesionales->titulo_banner)}}</h1>
                    @endif

                    @if(!empty($objbannersprincipalInstitucionProfesionales->texto_banner))
                        <p class="texto_banner_prof" style="color:{{($objbannersprincipalInstitucionProfesionales->color_texto)}};">{{($objbannersprincipalInstitucionProfesionales->texto_banner)}}</p>
                    @endif

                    @if(!empty($objbannersprincipalInstitucionProfesionales->urlBoton_banner))
                        <a class="btn_agendarHome" type="submit" href="{{($objbannersprincipalInstitucionProfesionales->urlBoton_banner)}}" target="blank"> {{ __('Ver más') }}
                            <img class="flecha_ingreso-membresia" src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" alt="">
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
            @foreach ($objProfesionalesIns as $objProfesionalesIns)
                <div class="card tarjeta_instProf">
                    <img class="img_perfil_instProf" src="{{URL::asset($objProfesionalesIns->foto_perfil_institucion)}}">
                    <div class="card-body content_tarjeta_instProf">
                        <h2>{{$objProfesionalesIns->nombre_especialidad}}</h2>
                        <h5 class="niega_uppercase">{{$objProfesionalesIns->primer_nombre}} {{$objProfesionalesIns->primer_apellido}}</h5>
                        <p>Especialista en {{$objProfesionalesIns->nombre_especialidad}}</p>
                        <p>{{$objProfesionalesIns->nombre_universidad}}</p>
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
@endsection


