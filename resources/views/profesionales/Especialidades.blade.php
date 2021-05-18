@extends('layouts.app')

@section('content')
  <!-- Carrusel Banner principal, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
  <section class="swiper-container">
    <div class="swiper-wrapper">
      @foreach ($objbannersprincipalEspecialidades as $objbannersprincipalEspecialidades)
        <img class="swiper-slide imagen_bannerPrin-espc" src="{{URL::asset($objbannersprincipalEspecialidades->rutaImagenVenta)}}">
      @endforeach
    </div>
  </section>

  <!-- Titulo principal de la vista -->
  <section>
    <h2  class="section_titulo-especialidad"> Especialidades Medicina </h2>
  </section>

  <!-- Contenedor de las tarjetas de las profesiones -->
  <section class="row col-10 col-xl-8 section_tarjetas-especilidades">
    @foreach ($objEspecialidades as $objEspecialidades)
      <div class="col-6 col-lg-3 mb-3 mb-md-4">
        <div class="imagen_profesion">
          <img class="imagen_especialidad" src="{{URL::asset($objEspecialidades->urlimagen)}}">
        </div>

        <div class="nombre_profesion">
          <span>{{$objEspecialidades->nombreEspecialidad}}</span>
        </div>

        <div class="contenido_boton-ver">
          <a href="{{url('Profesionales/'.$objEspecialidades->idEspecialidad)}}">
            <button type="submit" value="" class="boton_ver-especialidad" >
            <span> Ver especialidades </span>
            <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="icono_flecha-ver" alt=""> 
          </a>
        </div>
      </div>
    @endforeach
  </section>

  <!-- Carrusel de logos inferior, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
  <section class="contains_slider-logos-galeriaProf">
    <div class="col-11 col-lg-10 swiper-container swiper_logosGaleriaProf">
      <div class="swiper-wrapper">
      @foreach ($objcarruselespecialidades as $objcarruselespecialidades)
          <img class="swiper-slide" src="{{URL::asset($objcarruselespecialidades->rutaImagenVenta)}}">
        @endforeach
      </div>

      <!-- If we need navigation buttons -->
      <!-- <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div> -->
    </div>
  </section>
@endsection

