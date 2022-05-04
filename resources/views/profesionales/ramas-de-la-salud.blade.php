@extends('layouts.app')

@section('content')
  <div class="container-fluid p-0">
    <!-- Carrusel Banner principal, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
    <section class="swiper-container swiper_principalGaleriaProf">
      <div class="swiper-wrapper">
        @foreach ($objbannersprincipalProfesiones as $objbannersprincipalProfesiones)
          <div class="swiper-slide ">
              <img class="swiper-slide" src="{{URL::asset($objbannersprincipalProfesiones->rutaImagenVenta)}}">

              <div class="main_banner_top {{ ($objbannersprincipalProfesiones->banner_plantilla_id == 1)? 'banner_small': (($objbannersprincipalProfesiones->banner_plantilla_id == 2)? 'banner_medium': (($objbannersprincipalProfesiones->banner_plantilla_id == 3)? 'banner_large':'')) }}">
                  <div class="img_banner_top">    
                    <img src="{{URL::asset($objbannersprincipalProfesiones->ruta_logo)}}" alt="">
                  </div>  

                  <h1 style="color:{{($objbannersprincipalProfesiones->color_titulo)}};">{{($objbannersprincipalProfesiones->titulo_banner)}}</h1>
                  <p  style="color:{{($objbannersprincipalProfesiones->color_texto)}};">{{($objbannersprincipalProfesiones->texto_banner)}}</p>
                  @if(!empty($objbannersprincipalProfesiones->urlBoton_banner))
                    <a class="mt-lg-2" type="submit" href="{{($objbannersprincipalProfesiones->urlBoton_banner)}}" target="blank" class="btn_agendarHome"> {{ __('Ver más') }}
                    </a>
                  @endif
              </div>
          </div>  
        @endforeach
      </div>

      <div class="swiper-pagination pagination_home"></div>
    </section>

    <!-- Titulo principal de la vista -->
    <h1 class="titulo_principal"> Ramas de la salud </h1>

    <!-- Contenedor de las tarjetas de las profesiones -->
    <section class="row col-12 col-lg-10 col-xl-8 container_ramSalud">
      @foreach ($objprofesiones as $profesion)
        <div class="col-5 col-lg-3 section_ramSalud animacion_tarjeta">
          <div class="content_img_ramSalud">
            <img class="imagen_ramSalud" src="{{URL::asset($profesion->urlimagen)}}">
          </div>

          <h2 class="subTitle_ramSalud">{{$profesion->nombreProfesion}}</h2>

          <p class="text_ramSalud">{{$profesion->descripcion}}</p>

          <div class="section_btn_ramSalud">
            <a class="content_btn_ramSalud" href="{{ route('Especialidades', ['nombreProfesion' => $profesion->slug]) }}">
              <button type="submit" value="" class="btnVer_ramSalud" > Ver especialidades
                <img class="icon_arrow_ramSalud" src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" alt="">
              </button>
            </a>
          </div>
        </div>
      @endforeach
    </section>

    <!--carousel universidades-->
    <section class="seccion_carrusel_inferior">   <!-- Funcionalidad del carrusel alojada en el archivo home.js -->
      <h2 class="titulo_principal">Ellos confían en nosotros</h2>

      <div class="swiper-container swiper_logos_inferior">
        <div class="swiper-wrapper">
          @foreach ($objcarruselprofesiones as $objcarruselprofesiones)
            <img class="swiper-slide" src="{{URL::asset($objcarruselprofesiones->rutaImagenVenta)}}">
          @endforeach
        </div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev flecha_izquierda"></div>
        <div class="swiper-button-next flecha_derecha"></div> 
      </div>
    </section>
  </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/galeriaProfesiones.js') }}"></script>
@endsection
