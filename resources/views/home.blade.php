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
<h1 class="titulo_portafolio">Nuestro Portafolio</h1>

<section class="contains_menu">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-12 hvr-float-shadow">
            <div>
                <div class="contains_image mx-auto">
                    <img class="imagen_home" src="{{URL::asset('/img/home/especialidades-medicas.svg')}}">
                </div>

                <div class="contains_text">
                    <h1 class="titulo_home">Especialidades médicas</h1>
                    <p class="parrafo_home">Accede a un directorio con cientos de especialistas de todas las ramas de la salud.</p>
                    <a href="" class="ver_mas especialistas">Ver mas</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12 hvr-float-shadow">
            <div>
                <div class="contains_image mx-auto">
                    <img class="imagen_home" src="{{URL::asset('/img/home/instituciones-medicas.svg')}}">
                </div>

                <div class="contains_text">
                    <h1 class="titulo_home">Instituciones médicas</h1>
                    <p class="parrafo_home">Clinicas, centros medicos y odontologicos, toma de examenes y mucho mas</p>
                    <a href="" class="ver_mas instituciones">Ver mas</a>
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


