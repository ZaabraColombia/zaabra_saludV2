@extends('layouts.app')

@section('content')

<div class="col-12">
    @foreach ($objbannersprincipalInstituciones as $objbannersprincipalInstituciones)
          <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objbannersprincipalInstituciones->rutaImagenVenta)}}">
    @endforeach
</div>

<div class="col-12">
    @foreach ($objinstituciones as $objinstituciones)
        <div class="col-5 col-lg-3 contenido_tarjetas-profesionales">
          <div class="imagen_profesion">
            <img class="icono_img-profesion" src="{{URL::asset($objinstituciones->urlimagen)}}">
          </div>

          <div class="nombre_profesion">
            <span>{{$objinstituciones->nombretipo}}</span>
          </div>

          <div class="texto_profesion">
            <p>{{$objinstituciones->descripcioninstitucion}}</p>
          </div>

          <div class="contenido_boton-ver">
            <a href="{{url('Instituciones/'.$objinstituciones->id)}}">
              <button type="submit" value="" class="boton_ver-especialidad" >
              <span> Ver especialidades </span>
              <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="icono_flecha-ver" alt=""> 
            </a>
          </div>
        </div>
    @endforeach
</div>

     <section class="contains_slider-logos-galeriaProf">
      <div class="col-lg-10 swiper-container swiper_logosGaleriaProf">
        <div class="swiper-wrapper">
          @foreach ($objcarruselInstituciones as $objcarruselInstituciones)
            <img class="swiper-slide" src="{{URL::asset($objcarruselInstituciones->rutaImagenVenta)}}">
          @endforeach
        </div>
      </div>
    </section>

@endsection