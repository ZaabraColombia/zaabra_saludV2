@extends('layouts.app')

@section('content')

  <!--carrusel banner principal home--> 
  <div class="container-fluid p-0">
    <section class="swiper-container swiper_principalGaleriaProf">
      <div class="swiper-wrapper">
        @foreach ($objbannersprincipalProfesiones as $objbannersprincipalProfesiones)
          <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objbannersprincipalProfesiones->rutaImagenVenta)}}">
        @endforeach
      </div>

      <div class="swiper-pagination pagination_margen"></div>
    </section>

    <section class="section_titulo-rama">
      <span> Ramas de la salud </span>
    </section>

    <section class="row col-12 col-lg-10 section_tarjetas-profesionales">
      @foreach ($objprofesiones as $objprofesiones)
        <div class="col-5 col-lg-3 contenido_tarjetas-profesionales">
          <div class="imagen_profesion">
            <img class="icono_img-profesion" src="{{URL::asset($objprofesiones->urlimagen)}}">
          </div>

          <div class="nombre_profesion">
            <span>{{$objprofesiones->nombreProfesion}}</span>
          </div>

          <div class="texto_profesion">
            <p>{{$objprofesiones->descripcion}}</p>
          </div>

          <div class="contenido_boton-ver">
            <a href="{{url('galeriaespecialidades/'.$objprofesiones->idProfesion)}}">
              <button type="submit" value="" class="boton_ver-especialidad" >
              <span> Ver especialidades </span>
              <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="icono_flecha-ver" alt=""> 
            </a>
          </div>
        </div>

      @endforeach
    </section>



    <section class="contains_slider-logos-galeriaProf">
      <div class="col-lg-10 swiper-container swiper_logosGaleriaProf">
        <div class="swiper-wrapper">
          @foreach ($objcarruselprofesiones as $objcarruselprofesiones)
            <img class="swiper-slide" src="{{URL::asset($objcarruselprofesiones->rutaImagenVenta)}}">
          @endforeach
        </div>
      </div>
    </section>
  </div>
@endsection