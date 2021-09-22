@extends('layouts.app')

@section('content')

  <div class="container-fluid p-0">
    <!-- Carrusel Banner principal, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
    <section class="swiper-container swiper_principalGaleriaProf">
      <div class="swiper-wrapper">
        @foreach ($objbannersprincipalProfesiones as $objbannersprincipalProfesiones)
          <div class="swiper-slide ">
              <img class="swiper-slide" src="{{URL::asset($objbannersprincipalProfesiones->rutaImagenVenta)}}">
              <div class="contain_slide_prinHome">
                  <h1 class="titulo-slide_prinHome" style="color:{{($objbannersprincipalProfesiones->color_titulo)}};">{{($objbannersprincipalProfesiones->titulo_banner)}}</h1>
                  <p class="texto_banner_ramaSalud" style="color:{{($objbannersprincipalProfesiones->color_texto)}};">{{($objbannersprincipalProfesiones->texto_banner)}}</p>
                  @if(!empty($objbannersprincipalProfesiones->urlBoton_banner))
                    <a type="submit" href="{{($objbannersprincipalProfesiones->urlBoton_banner)}}" target="blank" class="btn_agendarHome"> {{ __('Ver más') }}
                      <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt="">
                    </a>
                  @endif
              </div>
          </div>  
        @endforeach
      </div>
    </section>

    <!-- Titulo principal de la vista -->
    <section >
      <h1 class="title_ramSalud"> Ramas de la salud </h1>
    </section>

    <!-- Contenedor de las tarjetas de las profesiones -->
    <section class="row col-12 col-lg-10 col-xl-8 container_ramSalud">
      @foreach ($objprofesiones as $profesion)
        <div class="col-5 col-lg-3 section_ramSalud">
          <div class="content_img_ramSalud">
            <img class="imagen_ramSalud" src="{{URL::asset($profesion->urlimagen)}}">
          </div>

          <h2 class="subTitle_ramSalud">{{$profesion->nombreProfesion}}</h2>

          <p class="text_ramSalud">{{$profesion->descripcion}}</p>

          <div class="section_btn_ramSalud">
            <a class="content_btn_ramSalud" href="{{url('Especialidades-Medicas/'.$profesion->slug)}}">
              <button type="submit" value="" class="btnVer_ramSalud" > Ver especialidades
                <img class="icon_arrow_ramSalud" src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" alt="">
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
              @foreach ($objcarruselprofesiones as $objcarruselprofesiones)
                <img class="swiper-slide" src="{{URL::asset($objcarruselprofesiones->rutaImagenVenta)}}">
              @endforeach
            </div>
        </div>

        <!-- If we need navigation buttons -->
        <div class="btn-prev"></div>
        <div class="btn-next"></div>
    </section>
  </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/galeriaProfesiones.js') }}"></script>
@endsection
