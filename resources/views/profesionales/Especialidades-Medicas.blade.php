@extends('layouts.app')

@section('content')
  <!-- Carrusel Banner principal, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
  <section class="swiper-container swiper_principalGaleriaProf">
    <div class="swiper-wrapper">
      @foreach ($objbannersprincipalEspecialidades as $objbannersprincipalEspecialidades)
        <img class="swiper-slide imagen_bannerPrin-espc" src="{{URL::asset($objbannersprincipalEspecialidades->rutaImagenVenta)}}">
      @endforeach
    </div>
  </section>

  <!-- Titulo principal de la vista -->
  <section>
    <h1  class="title_espeMed">Especialidades {{$objnombreProfesion->nombreProfesion}}</h1>
  </section>

  <!-- Contenedor de las tarjetas de las profesiones -->
  <section class="row col-11 col-xl-8 container_espeMed">

    @foreach ($objEspecialidades as $objEspecialidades)
      <div class="col-6 col-lg-3 section_espeMed">
        <div class="content_img_espeMed">
          <img class="imagen_espeMed" src="{{URL::asset($objEspecialidades->urlimagen)}}">
        </div>

        <h2 class="subTitle_espeMed">{{$objEspecialidades->nombreEspecialidad}}</h2>

        <div class="section_btn_espeMed">
          <a class="content_btn_espMed" href="{{url('Especialistas/'.$objEspecialidades->nombreEspecialidad)}}">
            <button type="submit" value="" class="btnVer_espMed" > Ver especialidades
              <img class="icon_arrow_espMed" src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" alt="">
            </button>
          </a>
        </div>
      </div>
    @endforeach
  </section>

  <!-- Carrusel de logos inferior, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
  <!--carousel universidades-->
  <section class="contains_slider_logoshome">
      <h2 class="titulo_logos">Ellos confían en nosotros</h2>
      <div class="swiper-container swiper_logoshome">
          <div class="swiper-wrapper">
            @foreach ($objcarruselespecialidades as $objcarruselespecialidades)
              <img class="swiper-slide" src="{{URL::asset($objcarruselespecialidades->rutaImagenVenta)}}">
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
