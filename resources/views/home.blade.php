@extends('layouts.app')

@section('content')
    <!--carrusel banner principal home--> 
<section class="swiper-container swiper_principal">
      <div class="swiper-wrapper">
            @foreach ($objbannersprincipalHome as $objbannersprincipalHome)
                  <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objbannersprincipalHome->rutaImagenVenta)}}">
            @endforeach
      </div>

      <div class="swiper-pagination"></div>

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
                    <p class="parrafo_home">Accede a un directorio con cientos de especialistas de todas las ramas de la salud.</p>
                    <a href="{{url('/Profesiones')}}" class="ver_mas especialistas hvr-sweep-to-right">Ver mas
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
                    <p class="parrafo_home">Clinicas, centros medicos y odontologicos, toma de examenes y mucho mas</p>
                    <a href="{{url('/Entidades')}}" class="ver_mas instituciones hvr-sweep-to-right">Ver mas
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
            @foreach ($objprofesionaleshome as $objprofesionaleshome)
            <div class="card swiper-slide">
                <img class="card-img-top" src="{{URL::asset($objprofesionaleshome->fotoperfil)}}">
                <div class="card-body">
                    <h5>{{$objprofesionaleshome->nombreEspecialidad}}</h5>
                    <p>{{$objprofesionaleshome->nombreuniversidad}}</p>
                    <p>{{$objprofesionaleshome->primernombre}} {{$objprofesionaleshome->primerapellido}}</p>
                    <a href="" class="btn-profesional hvr-sweep-to-right">Ver detalles
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
    <h1 class="titulo_logos">Ellos Confian en Nosotros</h1>
    <div class="swiper-container swiper_logoshome">
        <div class="swiper-wrapper">
            @foreach ($objbanneruniversidad as $objbanneruniversidad)
                <img class="swiper-slide" src="{{URL::asset($objbanneruniversidad->rutaImagenVenta)}}">
            @endforeach
        </div>
    </div>
</section>



@endsection