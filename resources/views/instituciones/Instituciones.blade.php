@extends('layouts.app')

@section('content')
   <!-- Carrusel Banner principal, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
   <section class="swiper-container swiper_principalGaleriaProf" style="background: chartreuse;">
      <div class="swiper-wrapper">

        @foreach ($objcarruselinstitucionespremiun as $objcarruselinstitucionespremiun)
        <div class="col-12">
            <img class="swiper-slide imagen_bannerPrin-prof" src="{{URL::asset($objcarruselinstitucionespremiun->imagen)}}">
            <span>{{$objcarruselinstitucionespremiun->nombreinstitucion}}</span>
            <span>{{$objcarruselinstitucionespremiun->nombre}}</span>
            <span>{{$objcarruselinstitucionespremiun->quienessomos}}</span>
            <span>{{$objcarruselinstitucionespremiun->url}}</span>
        </div>
        @endforeach
      </div>
    </section>   

    <!-- Carrusel Banner principal, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
   <section class="swiper-container swiper_principalGaleriaProf" style="background: deeppink;">
      <div class="swiper-wrapper">

        @foreach ($objinstitucionespagonormal as $objinstitucionespagonormal)
        <div class="col-12">
            <img class="swiper-slide imagen_bannerPrin-prof" src="{{URL::asset($objinstitucionespagonormal->imagen)}}">
            <span>{{$objinstitucionespagonormal->nombreinstitucion}}</span>
            <span>{{$objinstitucionespagonormal->nombre}}</span>
            <span>{{$objinstitucionespagonormal->quienessomos}}</span>
            <span>{{$objinstitucionespagonormal->url}}</span>
            <span>{{$objinstitucionespagonormal->nombretipo}}</span>
        </div>
        @endforeach
      </div>
    </section>  

        <!-- Carrusel Banner principal, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
   <section class="swiper-container swiper_principalGaleriaProf" style="background: darkorange;">
      <div class="swiper-wrapper">

        @foreach ($objinstitucionessinpago as $objinstitucionessinpago)
        <div class="col-12">
            <span>{{$objinstitucionessinpago->nombreinstitucion}}</span>
            <span>{{$objinstitucionespagonormal->nombretipo}}</span>
        </div>
        @endforeach
      </div>
    </section>      

      <!-- Carrusel de logos inferior, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
    <section class="contains_slider-logos-galeriaProf">
      <div class="col-11 col-lg-10 swiper-container swiper_logosGaleriaProf">
        <div class="swiper-wrapper">
          @foreach ($objcarruselPublicidadinstituciones as $objcarruselPublicidadinstituciones)
            <img class="swiper-slide" src="{{URL::asset($objcarruselPublicidadinstituciones->rutaImagenVenta)}}">
          @endforeach
        </div>

        <!-- If we need navigation buttons -->
        <!-- <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div> -->
      </div>
    </section    

    @endsection