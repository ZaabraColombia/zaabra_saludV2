@extends('layouts.app')

@section('content')

<!-- Carrusel Banner principal, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
<section class="swiper-container swiper_principalGaleriaProf">
  <div class="swiper-wrapper">
  @foreach ($objbannersprincipalInstituciones as $objbannersprincipalInstituciones)
      <img class="swiper-slide imagen_bannerPrin-entid" src="{{URL::asset($objbannersprincipalInstituciones->rutaImagenVenta)}}">
    @endforeach
  </div>
</section>

<!-- Titulo principal de la vista -->
<section >
  <h1 class="title_entidades"> Entidades </h1>
</section>

<!-- Contenedor de las tarjetas de las profesiones -->
<div class="row col-12 col-lg-10 col-xl-8 container_entidades">
  @foreach ($objinstituciones as $objinstituciones)
    <div class="col-5 col-lg-3 section_entidades">
      <div class="content_img_entidades">
        <img class="imagen_entidades" src="{{URL::asset($objinstituciones->urlimagen)}}">
      </div>

      <h2 class="subtitle_entidades">{{$objinstituciones->nombretipo}}</h2>

      <p class="texto_entidades">{{$objinstituciones->descripcioninstitucion}}</p>

      <div class="section_btn_entidades">
        <a class="content_btn_entidades" href="{{url('Instituciones/'.$objinstituciones->id)}}">
          <button type="submit" value="" class="btnVer_entidades"> Ver especialidades
            <img class="icon_arrow_entidades" src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" alt=""> 
          </button>
        </a>
      </div>
    </div>
  @endforeach
</div>

<!-- Carrusel de logos inferior, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
<!--carousel universidades--> 
<section class="contains_slider_logoshome">
  <h1 class="titulo_logos">Ellos confían en nosotros</h1>
  <div class="swiper-container swiper_logoshome">
      <div class="swiper-wrapper">
        @foreach ($objcarruselInstituciones as $objcarruselInstituciones)
          <img class="swiper-slide" src="{{URL::asset($objcarruselInstituciones->rutaImagenVenta)}}">
        @endforeach
      </div>
  </div>

  <!-- If we need navigation buttons -->
  <div class="btn-prev"></div>
  <div class="btn-next"></div>
</section>

@endsection