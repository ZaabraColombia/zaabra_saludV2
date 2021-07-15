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
  <h2 class="section_titulo-entidades"> Entidades </h2>
</section>

<!-- Contenedor de las tarjetas de las profesiones -->
<div class="row col-12 col-lg-10 section_tarjetas-entidades">
    @foreach ($objinstituciones as $objinstituciones)
        <div class="col-5 col-lg-3 contenido_tarjetas-entidades">
          <div class="imagen_entidad">
            <img class="icono_img-entidad" src="{{URL::asset($objinstituciones->urlimagen)}}">
          </div>

          <div class="nombre_entidad">
            <span>{{$objinstituciones->nombretipo}}</span>
          </div>

          <div class="texto_entidad">
            <p>{{$objinstituciones->descripcioninstitucion}}</p>
          </div>

          <div class="contenido_boton-verEntidad">
            <a href="{{url('Instituciones/'.$objinstituciones->id)}}">
              <button type="submit" value="" class="boton_ver-entidades" >
              <span> Ver especialidades </span>
              <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="icono_flecha-ver" alt=""> 
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