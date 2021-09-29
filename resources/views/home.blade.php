@extends('layouts.app')


@section('content')
    <!--carrusel banner principal home-->
    <section class="swiper-container swiper_principal banner_principalHom">
        <div class="swiper-wrapper">
            @foreach ($objbannersprincipalHome as $objbannersprincipalHome)
                <div class="swiper-slide ">
                    <img class="swiper-slide" src="{{URL::asset($objbannersprincipalHome->rutaImagenVenta)}}">
                    <div class="contain_slide_prinHome">
                        <h1 class="titulo-slide_prinHome" style="color:{{($objbannersprincipalHome->color_titulo)}};">{{($objbannersprincipalHome->titulo_banner)}}</h1>
                        <p class="text_slide_prinHome" style="color:{{($objbannersprincipalHome->color_texto)}};">{{($objbannersprincipalHome->texto_banner)}}</p>
                        <a type="submit" href="{{($objbannersprincipalHome->urlBoton_banner)}}" target="blank" class="btn_agendarHome" 
                            style="background-color:{{($objbannersprincipalHome->background_btn)}}; color:{{($objbannersprincipalHome->color_btn)}};"> {{($objbannersprincipalHome->texto_btn)}}
                            <i class="fa fa-arrow-right ml-1 ml-md-2"></i>
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

    <!--MENU PORTAFOLIO-->
    <h1 class="titulo_portafolio">Nuestro Portafolio</h1>

    <section class="contains_menu">
        <div class="row row_contains">
            <div class="col-md-6 col-lg-6 col-12 hvr-float-shadow contains-card">
                <div class="contains_submenu">
                    <div class="contains_image mx-auto">
                        <img class="imagen_home" src="{{URL::asset('/img/home/especialidades-medicas.svg')}}">
                    </div>

                    <div class="contains_text">
                        <h1 class="titulo_home">Especialidades médicas</h1>
                        <p class="parrafo_home"> Acceda a contenido de los mejores especialistas y agende su cita médica. </p>
                        <a href="{{url('/ramas-de-la-salud')}}" class="ver_mas especialistas hvr-sweep-to-right">Ver más
                            <i class="fas fa-arrow-right arrow_mas"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-12 hvr-float-shadow contains-card">
                <div class="contains_submenu">
                    <div class="contains_image mx-auto">
                        <img class="imagen_home" src="{{URL::asset('/img/home/instituciones-medicas.svg')}}">
                    </div>

                    <div class="contains_text">
                        <h1 class="titulo_home">Instituciones médicas</h1>
                        <p class="parrafo_home"> Clínicas, centros médicos y odontológicos, toma de exámenes y mucho más.</p>
                        <a href="{{url('/Instituciones-Medicas')}}" class="ver_mas instituciones hvr-sweep-to-right">Ver más
                            <i class="fas fa-arrow-right arrow_mas"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--parallax home-->
    <section class="contains_parallax">
        @foreach ($objbannersparallaxHome as $objbannersparallaxHome)
                <div class="zaabrasalud_parallax" style="background-image: url( {{URL::asset($objbannersparallaxHome->rutaImagenVenta)}} );"></div>
        @endforeach
    </section>

    <!--carousel especialistas-->
    <h1 class="titulo_portafolio">Nuestros Especialistas</h1>
    <section class="contains_slider_especialistas">
        <div class="swiper-container swiper_especialistas">
            <div class="swiper-wrapper">
                @foreach ($objprofesionaleshome as $profesionales_home)
                <div class="card swiper-slide">
                    <img class="card-img-top" src="{{URL::asset($profesionales_home->fotoperfil)}}">
                    <div class="card-body">
                        <h5>{{$profesionales_home->nombreEspecialidad}}</h5>
                        <span>Especialista en {{$profesionales_home->nombreEspecialidad}}</span>
                        <p>{{$profesionales_home->nombreuniversidad}}</p>
                        <p>{{$profesionales_home->primernombre}} {{$profesionales_home->primerapellido}}</p>
                        <a href="{{url('PerfilProfesional/'.$profesionales_home->slug)}}" class="btn-profesional hvr-sweep-to-right">Ver detalles
                            <i class="fas fa-arrow-right arrow_mas"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- If we need navigation buttons -->
        <div class="btn-prev"></div>
        <div class="btn-next"></div>
    </section>

    <!--banner triple-->
    <section class="contains_slider_triple">
        <div class="swiper-container swiper_triple">
            <div class="swiper-wrapper">
                @foreach ($objcarruselTriple as $objcarruselTriple)
                    <img class="swiper-slide" src="{{URL::asset($objcarruselTriple->rutaImagenVenta)}}">
                @endforeach
            </div>
        </div>
    </div>

    <!--carousel universidades-->
    <section class="contains_slider_logoshome">
        <h2 class="titulo_logos">Ellos confían en nosotros</h2>
        <div class="swiper-container swiper_logoshome">
            <div class="swiper-wrapper">
                @foreach ($objbanneruniversidad as $objbanneruniversidad)
                    <img class="swiper-slide" src="{{URL::asset($objbanneruniversidad->rutaImagenVenta)}}">
                @endforeach
            </div>
        </div>

        <!-- If we need navigation buttons -->
        <div class="btn-prev"></div>
        <div class="btn-next"></div>
    </section>

@endsection

@section('scripts')
    <script src="{{ asset('js/galeriaProfesiones.js') }}"></script>
@endsection
