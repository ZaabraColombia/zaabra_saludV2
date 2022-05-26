@extends('layouts.app')

@section('content')
  <!-- Carrusel Banner principal, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
  <section class="swiper-container swiper_principalGaleriaProf">
    <div class="swiper-wrapper">
      @foreach ($objbannersprincipalEspecialidades as $banner)
        <div class="swiper-slide ">
          <img class="swiper-slide" src="{{URL::asset($banner->rutaImagenVenta)}}">

          <div class="main_banner_top {{ ($banner->banner_plantilla_id == 1)? 'banner_small': (($banner->banner_plantilla_id == 2)? 'banner_medium': (($banner->banner_plantilla_id == 3)? 'banner_large':'')) }}">
            <div class="img_banner_top">    
              <img src="{{URL::asset($banner->ruta_logo)}}" alt="">
            </div>   
          
            <h1 style="color:{{($banner->color_titulo)}};">{{($banner->titulo_banner)}}</h1>
            <p  style="color:{{($banner->color_texto)}};">{{($banner->texto_banner)}}</p>
            @if(!empty($banner->urlBoton_banner))
              <a class="mt-lg-2" type="submit" href="{{($banner->urlBoton_banner)}}" target="blank" class="btn_agendarHome"> {{ __('Ver más') }}
              </a>
            @endif
          </div>
        </div>
      @endforeach
    </div>

    <div class="swiper-pagination pagination_home"></div>
  </section>

  <!-- Titulo principal de la vista -->
  <section>
    <h1  class="title_espeMed">Especialidades {{$objnombreProfesion->nombreProfesion}}</h1>
  </section>

  <!-- Contenedor de las tarjetas de las profesiones -->
  <section class="row col-11 col-xl-8 container_espeMed">
    @foreach ($objEspecialidades as $especialidad)
      <div class="col-6 col-lg-3 section_espeMed">
        <div class="content_img_espeMed">
          <img class="imagen_espeMed" src="{{URL::asset($especialidad->urlimagen)}}">
        </div>

        <h2 class="subTitle_espeMed">{{$especialidad->nombreEspecialidad}}</h2>

        <div class="section_btn_espeMed">
          <a class="content_btn_espMed" href="{{ route('Especialistas-En', ['nombreEspecialidad' => $especialidad->slug]) }}">
            <button type="submit" value="" class="btnVer_espMed" > Ver especialistas
              <img class="icon_arrow_espMed" src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" alt="">
            </button>
          </a>
        </div>
      </div>
    @endforeach
  </section>

  <!-- Carrusel Banner principal, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
  <section class="swiper-container swiper_principalGaleriaProf">
    <div class="swiper-wrapper">
      @foreach ($objbannerssecundarioEspecialidades as $banner)
        <div class="swiper-slide ">
          <img class="swiper-slide" src="{{URL::asset($banner->rutaImagenVenta)}}">

          <div class="main_banner_secundario {{ ($banner->banner_plantilla_id == 1)? 'banner_small': (($banner->banner_plantilla_id == 2)? 'banner_medium': (($banner->banner_plantilla_id == 3)? 'banner_large':'')) }}">
            <div class="img_banner_top">    
              <img src="{{URL::asset($banner->ruta_logo)}}" alt="">
            </div>   
          
            <h1 style="color:{{($banner->color_titulo)}};">{{($banner->titulo_banner)}}</h1>
            <p  style="color:{{($banner->color_texto)}};">{{($banner->texto_banner)}}</p>
            @if(!empty($banner->urlBoton_banner))
              <a class="mt-lg-2" type="submit" href="{{($banner->urlBoton_banner)}}" target="blank"   
                  style="background-color:{{($banner->background_btn)}}; color:{{($banner->color_btn)}};">
                  {{($banner->texto_btn)}}
              </a>
            @endif
          </div>
        </div>
      @endforeach
    </div>

    <div class="swiper-pagination pagination_home"></div>
  </section>
  









  <!--carousel universidades-->
  <section class="seccion_carrusel_inferior">   <!-- Funcionalidad del carrusel alojada en el archivo home.js -->
    <h2 class="titulo_principal">Ellos confían en nosotros</h2>

    <div class="swiper-container swiper_logos_inferior">
      <div class="swiper-wrapper">
        @foreach ($objcarruselespecialidades as $carrusel_especialidades)
          <img class="swiper-slide" src="{{URL::asset($carrusel_especialidades->rutaImagenVenta)}}">
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
