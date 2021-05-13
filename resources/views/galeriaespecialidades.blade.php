@extends('layouts.app')

@section('content')


  <section class="swiper-container">
    <div class="swiper-wrapper">
      @foreach ($objbannersprincipalEspecialidades as $objbannersprincipalEspecialidades)
        <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objbannersprincipalEspecialidades->rutaImagenVenta)}}">
      @endforeach
      </div>
  </section>

  <section class="section_titulo-especialidad">
    <span> Especialidades Medicina </span>
  </section>

  <section class="row col-10 col-xl-8 section_tarjetas-especilidades">
    @foreach ($objEspecialidades as $objEspecialidades)
      <div class="col-6 col-lg-3 mb-3 mb-md-4">
        <div class="imagen_profesion">
          <img class="imagen_especialidad" src="{{URL::asset($objEspecialidades->urlimagen)}}">
        </div>

        <div class="nombre_profesion">
          <span>{{$objEspecialidades->nombreEspecialidad}}</span>
        </div>
        <a href="{{url('galeriaProfesionales/'.$objEspecialidades->idEspecialidad)}}"></a>
        <div class="contenido_boton-ver">
          <a href="">
            <button type="submit" value="" class="boton_ver-especialidad" >
            <span> Ver especialidades </span>
            <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="icono_flecha-ver" alt=""> 
          </a>
        </div>
      </div>
    @endforeach
  </section>















  @foreach ($objbannerssecundarioEspecialidades as $objbannerssecundarioEspecialidades)
    <img class="logoHeaderSProfesionales" src="{{URL::asset($objbannerssecundarioEspecialidades->rutaImagenVenta)}}">
  @endforeach

  <div class="row m-auto w-75">
    <section class="swiper-container col-12 p-0 m-0">
      <div class="swiper-wrapper">
        @foreach ($objcarruselespecialidades as $objcarruselespecialidades)
          <img class="swiper-slide logosUniversidades" src="{{URL::asset($objcarruselespecialidades->rutaImagenVenta)}}">
        @endforeach
      </div>

      <div class="swiper-pagination"></div>

      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </section>
  </div>

@endsection

