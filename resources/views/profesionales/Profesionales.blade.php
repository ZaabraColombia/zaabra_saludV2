@extends('layouts.app')

@section('content')
      <h1 class="titulo_profesionales">Traumatología</h1>
      <div class="contains_swiper_premium" style="background: red;">
        <div class="swiper-container swiper_premium">
          <div class="swiper-wrapper">
            <div class="contains_slide">
              @foreach ($objcarruselprofesionalespremiun as $objcarruselprofesionalespremiun)
                <div class="contains_image_profesional">
                  <img src="{{URL::asset($objcarruselprofesionalespremiun->fotoperfil)}}">
                </div>

                <div class="contains_info">
                  <h2>{{$objcarruselprofesionalespremiun->primernombre}} {{$objcarruselprofesionalespremiun->primerapellido}}</h2>
                  <h5>{{$objcarruselprofesionalespremiun->nombreEspecialidad}}</h5>
                  <h5>{{$objcarruselprofesionalespremiun->nombre}}</h5>
                  <p>{{$objcarruselprofesionalespremiun->descripcionPerfil}}</p>
                </div>

                <div class="contains_buttons">
                    <a href="" class="btn-profesional hvr-sweep-to-right">Agende su cita
                        <i class="fas fa-arrow-right arrow_mas"></i>
                    </a>
                    <a href="" class="btn-profesional hvr-sweep-to-right">Ver perfil
                        <i class="fas fa-arrow-right arrow_mas"></i>
                    </a>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        <!--carrusel profesionales premiun-->
      </div>
      <div style="background: blue;">
        <!--galeria profesionales pago normal-->
        @foreach ($objmedicospagonormal as $objmedicospagonormal)
            <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objmedicospagonormal->fotoperfil)}}">
            <span>{{$objmedicospagonormal->primernombre}} {{$objmedicospagonormal->primerapellido}}</span>
            <span>{{$objmedicospagonormal->nombreEspecialidad}}</span>
            <span>{{$objmedicospagonormal->nombre}}</span>
            <span>{{$objmedicospagonormal->descripcionPerfil}}</span>
            <span>{{$objmedicospagonormal->nombreuniversidad}}</span>
        @endforeach
      </div>
      <div style="background: yellow;">
        <!--galeria profesionales sin pago -->
        @foreach ($objmedicossinpago as $objmedicossinpago)
        <span>{{$objmedicossinpago->primernombre}} {{$objmedicossinpago->primerapellido}}</span>
        <span>{{$objmedicossinpago->nombreEspecialidad}}</span>
        @endforeach
      </div>
          <!--carrusel publicidad -->
    @foreach ($objcarruselPublicidadprofesionales as $objcarruselPublicidadprofesionales)
        <img class="swiper-slide logoHeaderSProfesionales" src="{{URL::asset($objcarruselPublicidadprofesionales->rutaImagenVenta)}}">
      @endforeach 

@endsection

