@extends('layouts.app')

@section('content')
      <h1 class="titulo_instituciones">Medicina Prepagada</h1>
      <section class="contains_swiper_premium_insti">
        <div class="swiper-container swiper_premium_insti">
          <div class="swiper-wrapper">
            
              @foreach ($objcarruselinstitucionespremiun as $objcarruselinstitucionespremiun)
                <div class="swiper-slide contains_slide_insti">
                  <div class="contains_image_institucion">
                    <img src="{{URL::asset($objcarruselinstitucionespremiun->imagen)}}">
                  </div>

                  <div class="contains_body_insti">
                    <div class="contains_info">
                      <h2>{{$objcarruselinstitucionespremiun->nombreinstitucion}}</h2>
                      <h4>{{$objcarruselinstitucionespremiun->url}}</h4>
                      <h5>{{$objcarruselinstitucionespremiun->nombre}}</h5>
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
                      <p>{{Str::limit($objcarruselinstitucionespremiun->quienessomos,150)}}</p>
                    </div>

                     <div class="contains_buttons">
                        <a href="">Agende su cita
                            <i class="fas fa-arrow-right arrow_mas"></i>
                        </a>
                        <a href="{{url('PerfilInstitucion/'.$objcarruselinstitucionespremiun->id)}}">Ver perfil
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
        <!--carrusel instituciones premiun-->
      </section>


        <!--galeria instituciones pago normal-->
        <section class="container_cards_normal_insti">
          
            @foreach ($objinstitucionespagonormal as $objinstitucionespagonormal)
              <div class="card card_normal_insti">
                <img class="card-img-top" src="{{URL::asset($objinstitucionespagonormal->imagen)}}">
                <div class="card-body">
                  <h2>{{$objinstitucionespagonormal->nombreinstitucion}}</h2>
                  <h5>{{$objinstitucionespagonormal->nombre}}</h5>
                  <p>{{$objinstitucionespagonormal->url}}</p>
                  <p>{{$objinstitucionespagonormal->nombretipo}}</p>
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
                        <a href="{{url('PerfilInstitucion/'.$objinstitucionespagonormal->id)}}">Ver más
                            <i class="fas fa-arrow-right arrow_mas"></i>
                        </a>
                      </div>
                </div>
              </div>
            @endforeach
        </section>

        <!--galeria instituciones sin pago -->
        <section class="container_cards_generic_insti">
          @foreach ($objinstitucionessinpago as $objinstitucionessinpago)
            <div class="card card_generic_insti">
              <div class="card-body">
                <h5>{{$objinstitucionessinpago->nombreinstitucion}}</h5>
                <p>{{$objinstitucionespagonormal->nombretipo}}</p>
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
          
        <section class="contains_slider_publiProfesionales">
            <h1 class="titulo_logos">Ellos Confian en Nosotros</h1>
            <div class="swiper-container swiper_logoshome">
                <div class="swiper-wrapper">
                    @foreach ($objcarruselPublicidadinstituciones as $objcarruselPublicidadinstituciones)
                      <img class="swiper-slide" src="{{URL::asset($objcarruselPublicidadinstituciones->rutaImagenVenta)}}">
                    @endforeach 
                </div>
            </div>
        </section>
     
@endsection