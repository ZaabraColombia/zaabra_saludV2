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
          <div id="slider_principal" class="swiper-slide contains_slide">
            <div class="contains_image_profesional">
              <img src="{{URL::asset($objcarruselprofesionalespremiun->fotoperfil)}}">
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
                <a href="{{route('paciente.asignar-cita-profesional', ['profesional' => $objcarruselprofesionalespremiun->slug])}}">Agende su cita
                    <i class="fas fa-arrow-right pl-2"></i>
                </a>

                <a href="{{ url('/PerfilProfesional/' .  $objcarruselprofesionalespremiun->slug) }}">Ver perfil
                    <i class="fas fa-arrow-right pl-2"></i>
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
            <a href="{{route('paciente.asignar-cita-profesional', ['profesional' => $objmedicospagonormal->slug])}}">Agendar
                <i class="fas fa-arrow-right pl-2"></i>
            </a>

            <a href="{{ url('/PerfilProfesional/' .  $objmedicospagonormal->slug) }}">Ver más
                <i class="fas fa-arrow-right pl-2"></i>
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </section>

  <!--galeria profesionales sin pago -->
  <section class="contanier_cards_generic">
    @foreach ($objmedicossinpago as $medicos_sin_pago)
      <div class="card card_generic">
        <div class="card-body">
          <a href="{{ url('/PerfilProfesional/' . $medicos_sin_pago->slug) }}">
            <h5 class="niega_uppercase">{{$medicos_sin_pago->primernombre}} {{$medicos_sin_pago->primerapellido}}</h5>
            <p>{{$medicos_sin_pago->nombreEspecialidad}}</p>
          </a>

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

  <!--carousel universidades-->
  <section class="seccion_carrusel_inferior">   <!-- Funcionalidad del carrusel alojada en el archivo home.js -->
    <h2 class="titulo_principal">Ellos confían en nosotros</h2>

    <div class="swiper-container swiper_logos_inferior">
      <div class="swiper-wrapper">
        @foreach ($objcarruselPublicidadprofesionales as $objcarruselPublicidadprofesionales)
          <img class="swiper-slide" src="{{URL::asset($objcarruselPublicidadprofesionales->rutaImagenVenta)}}">
        @endforeach
      </div>

      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev flecha_izquierda"></div>
      <div class="swiper-button-next flecha_derecha"></div>
    </div>
  </section>
@endsection

@section('scripts')
  <script src="{{ asset('js/profesionales.js') }}"></script>
@endsection
