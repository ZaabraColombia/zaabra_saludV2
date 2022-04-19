@extends('layouts.app')

@section('content')
    <!-- BANNER PRINCIPAL - funcionalidad archivo home.js-->
    <section class="swiper-container swiper_principal">
        <div class="swiper-wrapper">
            @foreach ($objbannersprincipalHome as $objbannersprincipalHome)
                <div class="swiper-slide">
                    <img class="swiper-slide" src="{{URL::asset($objbannersprincipalHome->rutaImagenVenta)}}">

                    <div class="banner_top_content_inside">
                        <img class="banner_top_logo" src="{{URL::asset($objbannersprincipalHome->ruta_logo)}}" alt="">
                        <h1 class="banner_top_title" style="color:{{($objbannersprincipalHome->color_titulo)}};">{{($objbannersprincipalHome->titulo_banner)}}</h1>
                        <p class="banner_top_text" style="color:{{($objbannersprincipalHome->color_texto)}};">{{($objbannersprincipalHome->texto_banner)}}</p>
                        <a class="banner_top_button" type="submit" href="{{($objbannersprincipalHome->urlBoton_banner)}}" target="blank"
                            style="background-color:{{($objbannersprincipalHome->background_btn)}}; color:{{($objbannersprincipalHome->color_btn)}};">
                            {{($objbannersprincipalHome->texto_btn)}}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="swiper-pagination pagination_home"></div>

        <!-- If we need navigation buttons -->
        <!-- <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div> -->
    </section>

    <h1 class="title_home">Nuestro Portafolio</h1>

    <!-- TARJETAS - Especialidades e Instituciones médicas -->
    <section class="seccion_tarjetas">
        <div class="tarjeta_opcion animacion_tarjeta">
            <div class="cabecera_tarjeta">
                <img class="icono_tarjeta" src="{{URL::asset('/img/home/especialidades-medicas.svg')}}">
            </div>

            <div class="cuerpo_tarjeta">
                <h5 class="subTitulo_contenido">Especialidades médicas</h5>
                <p class="txt_contenido"> Acceda a contenido de los mejores especialistas y agende su cita médica. </p>

                <a href="{{url('/ramas-de-la-salud')}}" class="btn_central_azul animación_boton">Ver más
                    <i class="fas fa-arrow-right pl-1"></i>
                </a>
            </div>
        </div>

        <div class="tarjeta_opcion animacion_tarjeta">
            <div class="cabecera_tarjeta">
                <img class="icono_tarjeta" src="{{URL::asset('/img/home/instituciones-medicas.svg')}}">
            </div>

            <div class="cuerpo_tarjeta">
                <h5 class="subTitulo_contenido">Instituciones médicas</h5>
                <p class="txt_contenido"> Clínicas, centros médicos y odontológicos, toma de exámenes y mucho más.</p>

                <a href="{{url('/Instituciones-Medicas')}}" class="btn_central_verde animación_boton">Ver más
                    <i class="fas fa-arrow-right pl-1"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- PARALLAX -->
    @foreach ($objbannersparallaxHome as $objbannersparallaxHome)
        <div class="imagen_parallax" style="background-image: url( {{URL::asset($objbannersparallaxHome->rutaImagenVenta)}} );"></div>
    @endforeach

    <h1 class="title_home">Nuestros Especialistas</h1>

    <!-- CARRUSEL - Especialistas -->
    <div class="swiper-container swiper_especialistas">
        <div class="swiper-wrapper">
            @foreach ($objprofesionaleshome as $profesionales_home)
            <div class="card swiper-slide border-0">
                <a href="{{url('PerfilProfesional/'.$profesionales_home->slug)}}" class="m-0">
                    <img class="imagen_especialista" src="{{URL::asset($profesionales_home->fotoperfil)}}">

                    <div class="card-body contenido_especialista">
                        <h5 class="titulo_contenido">{{$profesionales_home->nombreEspecialidad}}</h5>
                        <span class="txt_especialista">Especialista en {{$profesionales_home->nombreEspecialidad}}</span>
                        <p class="txt_especialista"> <b>{{$profesionales_home->nombreuniversidad}}</b></p>
                        <p class="txt_especialista">{{$profesionales_home->primernombre}} {{$profesionales_home->primerapellido}}</p>

                        <div class="seccion_btn_central">
                            <a href="{{url('PerfilProfesional/'.$profesionales_home->slug)}}" class="btn_grande_central_azul">Ver detalles
                                <i class="fas fa-arrow-right pl-1"></i>
                            </a>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev flecha_izquierda"></div>
        <div class="swiper-button-next flecha_derecha"></div>
    </div>

    <!-- BANNER TRIPLE -->
    <div class="swiper-container swiper_triple">
        <div class="swiper-wrapper">
            @foreach ($objcarruselTriple as $objcarruselTriple)
                <img class="swiper-slide"  src="{{URL::asset($objcarruselTriple->rutaImagenVenta)}}">
            @endforeach
        </div>
    </div>

    <h1 class="title_home" style="color: #019f86">Nuestros Asociados</h1>

    <!-- CARRUSEL - Instituciones -->
    <div class="swiper-container swiper_especialistas">
        <div class="swiper-wrapper">
            @foreach ($intitucionProfesionales as $profesional)
                <div class="card swiper-slide border-0">
                    <a href="{{ route('PerfilInstitucion', ['slug' => $profesional->institucion->slug]) }}" class="m-0">
                        <img class="imagen_especialista" src="{{ asset($profesional->foto_perfil_institucion) }}">
                        <div class="card-body contenido_especialista">
                            <h5 class="titulo_contenido" style="color: #019f86">
                                @if(!empty($profesional->especialidades[0]))
                                    {{ $profesional->especialidades[0]->nombreEspecialidad }}
                                @endif
                            </h5>
                            <span class="txt_especialista" style="height: 37px; line-height: 1">
                                @if(!empty($profesional->especialidades[0]))
                                    Especialista en {{ $profesional->especialidades[0]->nombreEspecialidad }}
                                @endif
                            </span>
                            <p class="txt_especialista">
                                @if(!empty($profesional->universidad->nombreuniversidad))
                                    <b>{{$profesional->universidad->nombreuniversidad}}</b>
                                @endif
                            </p>
                            <p class="txt_especialista">
                                {{ $profesional->primer_nombre }} {{ $profesional->primer_apellido }}
                            </p>

                            <div class="seccion_btn_central">
                                <a href="{{ route('PerfilInstitucion', ['slug' => $profesional->institucion->slug]) }}"
                                   class="btn_central_verde">
                                    Ver detalles <i class="fas fa-arrow-right pl-1"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev flecha_izquierda" style="color: #019f86"></div>
        <div class="swiper-button-next flecha_derecha" style="color: #019f86"></div>
    </div>


    <!-- CARRUSEL - Entidades -->
    <section class="seccion_carrusel_inferior">
        <h2 class="title_home">Ellos confían en nosotros</h2>
        <div class="swiper-container swiper_logos_inferior">
            <div class="swiper-wrapper">
                @foreach ($objbanneruniversidad as $objbanneruniversidad)
                    <img class="swiper-slide" src="{{URL::asset($objbanneruniversidad->rutaImagenVenta)}}">
                @endforeach
            </div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev flecha_izquierda"></div>
            <div class="swiper-button-next flecha_derecha"></div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/galeriaProfesiones.js') }}"></script>
@endsection
