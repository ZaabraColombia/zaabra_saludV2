@extends('layouts.app')
@section('content')

@php
   $new_array = array();
@endphp
        <!-- seccion datos perfil profesional-->
        <section class="section_data_instituciones">
            <div class="data_instituciones">
                @foreach ($objinstitucionlandin as $objinstitucionlandin)
                <img src="{{URL::asset($objinstitucionlandin->logo)}}">
                <div class="contains_info">
                    <h2>{{$objinstitucionlandin->nombreinstitucion}}</h2>
                    <h1>{{$objinstitucionlandin->nombretipo}}</h1>
                    <h5 class="title-url"><i></i>{{$objinstitucionlandin->url}}</h5>
                    <h5 class="title-tel"><i></i>{{$objinstitucionlandin->telefonouno}}</h5>
                    <h5 class="title-adress"><i></i>{{$objinstitucionlandin->direccion}}</h5>
                    <h5>{{$objinstitucionlandin->ciudad}} {{$objinstitucionlandin->pais}}</h5>
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
                @endforeach
                <div class="contains_buttons">
                    <a href="">Agende su cita
                        <i class="fas fa-arrow-right arrow_mas"></i>
                    </a>
                    <a href="">Ver agenda
                        <i class="fas fa-arrow-right arrow_mas"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- seccion datos consulta perfil profesional-->
        <section class="contains_swiper_institucion">
            <h1>¿Por qué es un centro médico de alto nivel?</h1>
            <div class="swiper-container swiper_institucion">
                <div class="swiper-wrapper landingProf">
                    <li class="swiper-slide">
                        <a class="item_landing perfil perfil_clicked"><span>Servicios profesionales</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a class="item_landing tratamientos"><span>Acerca de la Institución</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a class="item_landing premios"><span>Certificaciones</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a class="item_landing publicaciones"><span>Sedes</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a class="item_landing galeria"><span>Galería</span></a>
                    </li>
                </div>
            </div>
        </section>

        <section class="section_servicios_institucion">

            <div class="servicios_institucion">
                <h2><i></i>Servicios profesionales</h2>
                <p>{{$objinstitucionlandin->DescripcionGeneralServicios}}</p>
            </div>
 
            @foreach ($objinstitucionlandinservicios as $objinstitucionlandinservicios)
            <div class="desplegable_institucion" id="accordion">
                <div class="card containt_options-collapse-membresia">
                    <div class="card-header" id="heading_{{$loop->iteration}}">
                        <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapse_{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse_{{$loop->iteration}}">{{$objinstitucionlandinservicios->tituloServicios}}</button>
                    </div>

                    <div id="collapse_{{$loop->iteration}}" class="collapse" aria-labelledby="heading_{{$loop->iteration}}" data-parent="#accordion">
                        <div class="card-body text_interno-toggle-membresia">
                            <p>{{$objinstitucionlandinservicios->DescripcioServicios}}</p>
                        </div>
                        <div>
                            @if($objinstitucionlandinservicios->sucursalservicio) 
                                @php  $new_array = explode(',',$objinstitucionlandinservicios->sucursalservicio); @endphp
                            @endif
                            @foreach($new_array as $info)
                                <option>{{$info}}</option>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </section>

        <section class="sections sections_active section_acerca_institucion">

            <div class="perfil_institucion">
                <h2><i></i>¿Quiénes somos?</h2>
                <p>{{$objinstitucionlandin->quienessomos}}</p>
            </div>

            <div class="propuesta">
                <h2><i></i>Propuesta de valor</h2>
                <ul>
                    <li>
                        <p>{{$objinstitucionlandin->propuestavalor}}</p>                            
                    </li>
                </ul>
            </div>

            <div class="convenios">
                <h2><i></i>Convenios</h2>
                <ul>
                    <li>
                        @foreach ($objinstitucionlandineps as $objinstitucionlandineps)
                            <img src="{{URL::asset($objinstitucionlandineps->urlimagen)}}">
                        @endforeach
                    </li>
                    <li>
                        @foreach ($objinstitucionlandinips as $objinstitucionlandinips)
                            <img src="{{URL::asset($objinstitucionlandinips->urlimagen)}}">
                        @endforeach
                    </li>
                    <li>
                        @foreach ($objinstitucionlandinprepagada as $objinstitucionlandinprepagada)
                            <img src="{{URL::asset($objinstitucionlandinprepagada->urlimagen)}}">
                        @endforeach
                    </li>
                </ul>
            </div>
        </section>

        <section class="sections contains_swiper_certificados">
            <h2><i></i>Premios y Reconocimientos</h2>
            <div class="swiper-container swiper_certificados">
                <div class="swiper-wrapper">
                    @foreach ($objinstitucionlandinpremios as $objinstitucionlandinpremios)
                        <div class="swiper-slide">
                            <img src="{{URL::asset($objinstitucionlandinpremios->imgpremio)}}">
                            <h6>{{$objinstitucionlandinpremios->fechapremio}}</h6>
                            <h5>{{$objinstitucionlandinpremios->nombrepremio}}</h5>
                            <p>{{$objinstitucionlandinpremios->descripcionpremio}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="sections section_sedes_institucion">
            <div class="sedes_institucion">
                <h2><i></i>Sedes</h2>
                <div class="container_cards">
                    @foreach ($objinstitucionlandinSedes as $objinstitucionlandinSedes)
                        <div class="card">
                            <img class="card-img-top" src="{{URL::asset($objinstitucionlandinSedes->imgsede)}}">
                            <div class="card-body">
                                <h5>{{$objinstitucionlandinSedes->nombre}}</h5>
                                <p>{{$objinstitucionlandinSedes->direccion}}</p>
                                <p>{{$objinstitucionlandinSedes->horario_sede}}</p>
                                <p>{{$objinstitucionlandinSedes->telefono}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="sections galeriayvideo">
            <div class="galeria_institucion">
                <h2><i></i>Galería</h2>
                <ul class="gallery_institucion">
                    @foreach ($objinstitucionlandingaleria as $objinstitucionlandingaleria)
                        <li>
                            <img src="{{URL::asset($objinstitucionlandingaleria->imggaleria)}}" alt="{{$objinstitucionlandingaleria->descripcion}}"> 
                        </li>       
                    @endforeach
                </ul>    
            </div>
            
            <div class="videos_institucion">
                <h2><i></i>Videos</h2>
                <div class="container_cards">
                    @foreach ($objinstitucionlandinvideo as $objinstitucionlandinvideo)
                        <div class="card">
                            <iframe class="card-img-top" src="{{$objinstitucionlandinvideo->urlvideo}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                            <div class="card-body">
                                <h5>{{$objinstitucionlandinvideo->nombrevideo}}</h5>
                                <p>{{$objinstitucionlandinvideo->descripcionvideo}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>     
        </section>
@endsection