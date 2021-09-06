@extends('layouts.app')

@section('content')
  <h1 class="titulo_instituciones">{{$objtipoinstitucion->nombretipo}}</h1>

  <section class="contains_swiper_premium_insti">
    <div class="swiper-container swiper_premium_insti">
      <div class="swiper-wrapper">
        @foreach ($objcarruselinstitucionespremiun as $carrusel_instituciones_premiun)
          <div id="slider_principal_inst" class="swiper-slide contains_slide_insti">
            <div class="contains_image_institucion">
              <img src="{{URL::asset($carrusel_instituciones_premiun->imagen)}}">
            </div>

            <div class="contains_body_insti">
              <div class="contains_info">
                <h2>{{$carrusel_instituciones_premiun->nombreinstitucion}}</h2>
                <h5>{{$carrusel_instituciones_premiun->url}}</h5>
                <h5>{{$carrusel_instituciones_premiun->nombre}}</h5>
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
                <p>{{Str::limit($carrusel_instituciones_premiun->quienessomos,150)}}</p>
              </div>

              <div class="contains_buttons">
                <a href="">Agende su cita
                    <i class="fas fa-arrow-right arrow_mas"></i>
                </a>
                <a href="{{url('PerfilInstitucion/'.$carrusel_instituciones_premiun->slug)}}">Ver perfil
                    <i class="fas fa-arrow-right arrow_mas"></i>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <!-- If we need pagination -->
      <!-- <div class="swiper-pagination"></div> -->
    </div>
    <!--carrusel instituciones premiun-->
  </section>

  <!--galeria instituciones pago normal-->
  <section class="container_cards_normal_insti">

      @foreach ($objinstitucionespagonormal as $instituciones_pago_normal)
        <div class="card card_normal_insti">
          <img class="card-img-top" src="{{URL::asset($instituciones_pago_normal->imagen)}}">
          <div class="card-body">
            <h2>{{$instituciones_pago_normal->nombreinstitucion}}</h2>
            <h5>{{$instituciones_pago_normal->nombre}}</h5>
            <p>{{$instituciones_pago_normal->url}}</p>
            <p>{{$instituciones_pago_normal->nombretipo}}</p>
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
                  <a href="">Agendar
                      <i class="fas fa-arrow-right arrow_mas"></i>
                  </a>
                  <a href="{{url('PerfilInstitucion/'.$instituciones_pago_normal->slug)}}">Ver más
                      <i class="fas fa-arrow-right arrow_mas"></i>
                  </a>
                </div>
          </div>
        </div>
      @endforeach
  </section>

  <!--galeria instituciones sin pago -->
  <section class="container_cards_generic_insti">
    @foreach ($objinstitucionessinpago as $instituciones_sin_pago)
      <div class="card card_generic_insti">
        <div class="card-body">
            <a href="{{ url('PerfilInstitucion/' . $instituciones_sin_pago->slug) }}">
                <h5>{{$instituciones_sin_pago->nombreinstitucion}}</h5>
                <p>{{$instituciones_sin_pago->nombretipo}}</p>
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

  <!-- Carrusel de logos inferior, funcionalidad del carrusel alojada en el archivo galeriaProfesionales.js -->
  <!--carousel universidades-->
  <section class="contains_slider_logoshome">
    <h2 class="titulo_logos">Ellos confían en nosotros</h2>
    <div class="swiper-container swiper_logoshome">
        <div class="swiper-wrapper">
        @foreach ($objcarruselPublicidadinstituciones as $objcarruselPublicidadinstituciones)
          <img class="swiper-slide" src="{{URL::asset($objcarruselPublicidadinstituciones->rutaImagenVenta)}}">
        @endforeach
        </div>
    </div>

    <!-- If we need navigation buttons -->
    <div class="btn-prev"></div>
    <div class="btn-next"></div>
  </section>

@endsection

@section('scripts')
    <script src="{{ asset('js/instituciones.js') }}"></script>
    <script src="{{ asset('js/profesionales.js') }}"></script>
@endsection
