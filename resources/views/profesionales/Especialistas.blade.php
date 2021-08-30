@extends('layouts.app')

@section('content')

    @foreach ($objmedicossinpago as $tituloPaginaActual)
    @endforeach
      @if(!empty($objmedicossinpago))
        <h1 class="titulo_profesionales">{{$tituloPaginaActual->nombreEspecialidad}}</h1>
      @endif

      <section class="contains_swiper_premium">
        <div class="swiper-container swiper_premium">
          <div class="swiper-wrapper">
              @foreach ($objcarruselprofesionalespremiun as $objcarruselprofesionalespremiun)
                <div class="swiper-slide contains_slide">
                  <div class="contains_image_profesional">
                    <img class="image_profesional_gallery" src="{{URL::asset($objcarruselprofesionalespremiun->fotoperfil)}}">
                  </div>
                  <div class="contains_body">
                    <div class="contains_info">
                      <h2>{{$objcarruselprofesionalespremiun->primernombre}} {{$objcarruselprofesionalespremiun->primerapellido}}</h2>
                      <h5>{{$objcarruselprofesionalespremiun->nombreEspecialidad}}</h5>
                      <h5>{{$objcarruselprofesionalespremiun->nombre}}</h5>
                        <!-- Rating Stars Box -->
                        <div class='rating-stars text-center'>
                          <ul id='stars'>
                            <li class='star' title='Poor' data-value='1'>
                              <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Fair' data-value='2'>
                              <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Good' data-value='3'>
                              <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='Excellent' data-value='4'>
                              <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='WOW!!!' data-value='5'>
                              <i class='fa fa-star fa-fw'></i>
                            </li>
                          </ul>
                        </div>
                      <p>{{$objcarruselprofesionalespremiun->descripcionPerfil}}</p>
                    </div>
                     <div class="contains_buttons">
                        <a href="{{route('calendario-id-profesional', ['id' => $objcarruselprofesionalespremiun->idPerfilProfesional])}}">Agende su cita
                            <i class="fas fa-arrow-right arrow_mas"></i>
                        </a>
                        <a href="{{route('calendario')}}">Ver perfil
                            <i class="fas fa-arrow-right arrow_mas"></i>
                        </a>
                     </div>
                  </div>
                </div>
              @endforeach
          </div>
          <!-- If we need pagination -->
          <div class="swiper-pagination"></div>
        </div>
        <!--carrusel profesionales premiun-->
      </section>


        <!--galeria profesionales pago normal-->
        <section class="container_cards_normal">
            @foreach ($objmedicospagonormal as $objmedicospagonormal)
              <div class="card card_normal">
                <img class="card-img-top" src="{{URL::asset($objmedicospagonormal->fotoperfil)}}">
                <div class="card-body">
                  <h2>{{$objmedicospagonormal->nombreEspecialidad}}</h2>
                  <h5 class="niega_uppercase">{{$objmedicospagonormal->primernombre}} {{$objmedicospagonormal->primerapellido}}</h5>
                  <span>{{$objmedicospagonormal->concatNombreEspecialidad}}</span>
                  <p>{{$objmedicospagonormal->nombreuniversidad}}</p>
                  <!-- Rating Stars Box -->
                    <div class='rating-stars text-center'>
                      <ul id='stars'>
                        <li class='star' title='Poor' data-value='1'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Fair' data-value='2'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Good' data-value='3'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Excellent' data-value='4'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='WOW!!!' data-value='5'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                      </ul>
                    </div>
                      <div class="contains_buttons">
                        <a href="{{route('calendario-id-profesional', ['id' => $objmedicospagonormal->idPerfilProfesional])}}">Agendar
                            <i class="fas fa-arrow-right arrow_mas"></i>
                        </a>
                        <a href="{{route('calendario')}}">Ver más
                            <i class="fas fa-arrow-right arrow_mas"></i>
                        </a>
                      </div>
                </div>
              </div>
            @endforeach
        </section>

        <!--galeria profesionales sin pago -->
        <section class="contanier_cards_generic">
          @foreach ($objmedicossinpago as $objmedicossinpago)
            <div class="card card_generic">
              <div class="card-body">
                <h5 class="niega_uppercase">{{$objmedicossinpago->primernombre}} {{$objmedicossinpago->primerapellido}}</h5>
                <p>{{$objmedicossinpago->nombreEspecialidad}}</p>
                <!-- Rating Stars Box -->
                    <div class='rating-stars text-center'>
                      <ul id='stars'>
                        <li class='star' title='Poor' data-value='1'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Fair' data-value='2'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Good' data-value='3'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Excellent' data-value='4'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='WOW!!!' data-value='5'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                      </ul>
                    </div>
              </div>
            </div>
          @endforeach
        </section>

        <!--carrusel publicidad -->
        <!-- Carrusel de logos inferior, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
        <!--carousel universidades-->
        <section class="contains_slider_logoshome">
          <h2 class="titulo_logos">Ellos confían en nosotros</h2>
          <div class="swiper-container swiper_logoshome">
              <div class="swiper-wrapper">
                @foreach ($objcarruselPublicidadprofesionales as $objcarruselPublicidadprofesionales)
                  <img class="swiper-slide" src="{{URL::asset($objcarruselPublicidadprofesionales->rutaImagenVenta)}}">
                @endforeach
              </div>
          </div>

          <!-- If we need navigation buttons -->
          <div class="btn-prev"></div>
          <div class="btn-next"></div>
        </section>

@endsection
