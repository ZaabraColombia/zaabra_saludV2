@extends('layouts.app')

@section('content')
  <section class="swiper-container swiper_principalGaleriaProf"> <!-- Función del slider del banner se encuentra en el archivo galeriaProfesiones.js -->
    <div class="swiper-wrapper">
      @foreach ($objbannersprincipalInstituciones as $objbannersprincipalInstituciones)
        <div class="swiper-slide ">
          <img class="swiper-slide" src="{{URL::asset($objbannersprincipalInstituciones->rutaImagenVenta)}}">

          <div class="main_banner_top {{ ($objbannersprincipalInstituciones->banner_plantilla_id == 1)? 'banner_small': (($objbannersprincipalInstituciones->banner_plantilla_id == 2)? 'banner_medium': (($objbannersprincipalInstituciones->banner_plantilla_id == 3)? 'banner_large': '')) }}">
            <div class="img_banner_top">    
              <img src="{{URL::asset($objbannersprincipalInstituciones->ruta_logo)}}" alt="">
            </div>
          
            <h1 style="color:{{($objbannersprincipalInstituciones->color_titulo)}};">{{($objbannersprincipalInstituciones->titulo_banner)}}</h1>
            <p  style="color:{{($objbannersprincipalInstituciones->color_texto)}};">{{($objbannersprincipalInstituciones->texto_banner)}}</p>

            @if(!empty($objbannersprincipalProfesiones->urlBoton_banner))
              <a class="mt-lg-2" type="submit" href="{{($objbannersprincipalInstituciones->urlBoton_banner)}}" target="blank" class="btn_agendarHome"> {{ __('Ver más') }}
              </a>
            @endif
          </div>
        </div>
      @endforeach
    </div>

    <div class="swiper-pagination pagination_home"></div>
  </section>

  <h1 class="titulo_principal" style="color: #019F86"> Instituciones </h1>

  <!-- Contenedor de las tarjetas de las profesiones -->
  <div class="row col-12 col-lg-10 col-xl-8 container_entidades">
    @foreach ($objinstituciones as $objinstituciones)
      <div class="col-5 col-lg-3 section_entidades animacion_tarjeta">
        <div class="content_img_entidades">
          <img class="imagen_entidades" src="{{URL::asset($objinstituciones->urlimagen)}}">
        </div>

        <h2 class="subtitle_entidades">{{$objinstituciones->nombretipo}}</h2>
        <p class="texto_entidades">{{$objinstituciones->descripcioninstitucion}}</p>

        <div class="section_btn_entidades">
          <a class="content_btn_entidades" href="{{url('Instituciones/'.$objinstituciones->slug)}}">
            <button type="submit" value="" class="btnVer_entidades"> Ver instituciones 
              <img class="icon_arrow_entidades" src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" alt="">
            </button>
          </a>
        </div>
      </div>
    @endforeach
  </div>

  <!--carousel universidades-->
  <section class="seccion_carrusel_inferior">   <!-- Funcionalidad del carrusel alojada en el archivo home.js -->
    <h2 class="titulo_principal" style="color: #019F86">Ellos confían en nosotros</h2>

    <div class="swiper-container swiper_logos_inferior">
      <div class="swiper-wrapper">
        @foreach ($objcarruselInstituciones as $objcarruselInstituciones)
          <img class="swiper-slide" src="{{URL::asset($objcarruselInstituciones->rutaImagenVenta)}}">
        @endforeach
      </div>

      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev flecha_izquierda" style="color: #019F86"></div>
      <div class="swiper-button-next flecha_derecha" style="color: #019F86"></div>        
    </div>
  </section>
@endsection

@section('scripts')
  <script src="{{ asset('js/galeriaProfesiones.js') }}"></script>
@endsection
