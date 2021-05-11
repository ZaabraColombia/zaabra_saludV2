@extends('layouts.app')

@section('content')

  <!--carrusel banner principal home--> 
  <div class="container-fluid p-0">
    <section class="col-12 p-0 m-0">
      @foreach ($objbannersprincipalProfesiones as $objbannersprincipalProfesiones)
        <img class="logoHeaderSProfesionales" src="{{URL::asset($objbannersprincipalProfesiones->rutaImagenVenta)}}">
      @endforeach
    </section>

    <section class="section_titulo">
      <span> Ramas de la salud </span>
    </section>

    <section class="row col-12 col-lg-10 section_tarjetas-profesionales">
      @foreach ($objprofesiones as $objprofesiones)
        <div class="col-5 col-lg-3 contenido_tarjetas-profesionales">
          <div class="imagen_profesion">
            <img class="icono_img-profesion" src="{{URL::asset('/img/iconos/icono-medicina-general-mov.svg')}}">
          </div>

          <div class="nombre_profesion">
            <span>{{$objprofesiones->nombreProfesion}}</span>
          </div>

          <div class="texto_profesion">
            <p> Realización de diagnostico y tratamiento de enfermedades más comunes.</p>
          </div>

          <div class="contenido_boton-ver">
            <button type="submit" value="" class="boton_ver-especialidad" >
            <span> Ver especialidades </span>
            <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="icono_flecha-suscribirme-cel" alt=""> 
          </div>
        </div>
      @endforeach
    </section>

    <section>
      @foreach ($objcarruselprofesiones as $objcarruselprofesiones)
        <img class="logosUniversidades" src="{{URL::asset($objcarruselprofesiones->rutaImagenVenta)}}">
      @endforeach
    </section>

  </div>
 

@endsection