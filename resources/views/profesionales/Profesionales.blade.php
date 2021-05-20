@extends('layouts.app')

@section('content')
      <h1 class="titulo_profesionales">Traumatología</h1>
      <section class="contains_swiper_premium">
        <div class="swiper-container swiper_premium">
          <div class="swiper-wrapper">
              @foreach ($objcarruselprofesionalespremiun as $objcarruselprofesionalespremiun)
                <div class="swiper-slide contains_slide">
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
                      <a href="">Agende su cita
                          <i class="fas fa-arrow-right arrow_mas"></i>
                      </a>
                      <a href="">Ver perfil
                          <i class="fas fa-arrow-right arrow_mas"></i>
                      </a>
                  </div>
                </div>
              @endforeach
          </div>
          <!-- If we need pagination -->
          <div class="swiper-pagination"></div>
        </div>
        <!--carrusel profesionales premiun-->
      </section>


      <div style="background: blue;">
        <!--galeria profesionales pago normal-->
        <section class="container_cards_normal">
            @foreach ($objmedicospagonormal as $objmedicospagonormal)
              <div class="card card_normal">
                <img class="card-img-top" src="{{URL::asset($objmedicospagonormal->fotoperfil)}}">
                <div class="card-body">
                  <h5 class="card_title">{{$objmedicospagonormal->nombreEspecialidad}}</h5>
                  <h6 class="card_subtitle">{{$objmedicospagonormal->primernombre}} {{$objmedicospagonormal->primerapellido}}</h6>
                  <p class="card_text">{{$objmedicospagonormal->descripcionPerfil}}</p>
                  <p class="card_text">{{$objmedicospagonormal->nombreuniversidad}}</p>
                  <div class="contains_buttons">
                        <a href="">Agende su cita
                            <i class="fas fa-arrow-right arrow_mas"></i>
                        </a>
                        <a href="">Ver perfil
                            <i class="fas fa-arrow-right arrow_mas"></i>
                        </a>
                    </div>
                </div>
              </div>
            @endforeach
        </section>
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

