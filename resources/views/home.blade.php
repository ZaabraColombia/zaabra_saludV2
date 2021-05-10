@extends('layouts.app')

@section('content')

    <!--carrusel banner principal home--> 
<section class="swiper-container">
      <div class="swiper-wrapper">
            @foreach ($objbannersprincipalHome as $objbannersprincipalHome)
                  <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objbannersprincipalHome->rutaImagenVenta)}}">
            @endforeach
      </div>

      <div class="swiper-pagination"></div>

      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

</section>
<!--MENU PORTAFOLIO-->
<h1 class="titulo_menu">Nuestro Portafolio</h1>

<section class="contains_menu">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-12 hvr-wobble-vertical">
            <div>
                <div class="image-height mx-0">
                    <img class="imagen-carrusel-home" src="{{$urlZaabra}}img/areas/especialidades-medicas.svg">
                </div>

                <div>
                    <h1 class="texto-carrousel-home">Especialidades médicas</h1>
                    <p class="parrafo-carrousel-home">Accede a un directorio con cientos de especialistas de todas las ramas de la salud.</p>
                    <a href="" class="ver-mas especialistas">Ver mas</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12 hvr-wobble-vertical">
            <div>
                <div class="image-height mx-0">
                    <img class="imagen-carrusel-home" src="{{$urlZaabra}}img/areas/instituciones-medicas.svg">
                </div>

                <div>
                    <h1 class="texto-carrousel-home">Instituciones médicas</h1>
                    <p class="parrafo-carrousel-home">Clinicas, centros medicos y odontologicos, toma de examenes y mucho mas</p>
                    <a href="" class="ver-mas instituciones">Ver mas</a>
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
 <!--profesionales home--> 
<div>
      @foreach ($objprofesionaleshome as $objprofesionaleshome)
        <div class="col-6">
            <div class="col-12">
               <img class="" src="{{URL::asset($objprofesionaleshome->fotoperfil)}}">
            </div>
            <div class="col-12">
             <span>{{$objprofesionaleshome->primernombre}} {{$objprofesionaleshome->primerapellido}}</span>
            </div>
            <div class="col-12">
             <span>{{$objprofesionaleshome->nombreEspecialidad}}</span>
            </div>
            <div class="col-12">
             <span>{{$objprofesionaleshome->nombreuniversidad}}</span>
            </div>
        </div>
      @endforeach
</div>
<!--carrusel home--> 
<div>
  @foreach ($objcarruselhome as $objcarruselhome)
      <img class="" src="{{URL::asset($objcarruselhome->rutaImagenVenta)}}">
  @endforeach
</div>



@endsection


