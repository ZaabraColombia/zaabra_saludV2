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
                    <h5>{{$objinstitucionlandin->url}}</h5>
                    <h5>{{$objinstitucionlandin->telefonouno}}</h5>
                    <h5>{{$objinstitucionlandin->direccion}}</h5>
                    <h5>{{$objinstitucionlandin->ciudad}} {{$objinstitucionlandin->pais}}}</h5>
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

        
        @foreach ($objinstitucionlandinservicios as $objinstitucionlandinservicios)
            <div class="card containt_options-collapse-membresia">
                <div id="headingTwo">
                    <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">{{$objinstitucionlandinservicios->tituloServicios}}<</button>
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
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
        @endforeach

        <section class="sections sections_active section_perfil_institucion">

            <div class="perfil_institucion">
                <h2><i></i>Servicios profesionales</h2>
                <p>{{$objinstitucionlandin->DescripcionGeneralServicios}}</p>
            </div>

            <div class="educacion">
                <h2><i></i>Educación</h2>
                <ul>
                    @foreach ($objprofesionallandingestudios as $objprofesionallandingestudios)
                        <li>
                            <h5>{{$objprofesionallandingestudios->nombreestudio}}</h5>
                            <p>{{$objprofesionallandingestudios->nombreuniversidad}}</p>
                            <p>{{$objprofesionallandingestudios->fechaestudio}}</p>                            
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="experiencia">
                <h2><i></i>Experiencia</h2>
                <ul>
                    @foreach ($objprofesionallandingexperi as $objprofesionallandingexperi)
                        <li>
                            <div class="contains_info">
                                <h5>{{$objprofesionallandingexperi->nombreEmpresaExperiencia}}</h5>
                                <p>{{$objprofesionallandingexperi->descripcionExperiencia}}</p>
                                <p><strong>Desde </strong>{{$objprofesionallandingexperi->fechaInicioExperiencia}}</p>
                                <p><strong>hasta </strong>{{$objprofesionallandingexperi->fechaFinExperiencia}}</p>
                            </div>
                            <div class="contains_logo">
                                <img src="{{URL::asset($objprofesionallandingexperi->imgexperiencia)}}"> 
                            </div>           
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="asociaciones">
                <h2><i></i>Asociaciones</h2>
                <ul>
                    <li>
                        @foreach ($objprofesionallandingasocia as $objprofesionallandingasocia)
                            <img src="{{URL::asset($objprofesionallandingasocia->imgasociacion)}}">
                        @endforeach
                    </li>
                </ul>
            </div>

            <div class="idiomas">
                <h2><i></i>Idiomas</h2>
                <ul>
                    <li>
                        @foreach ($objprofesionallandingidioma as $objprofesionallandingidioma)
                        <div class="contains_idioma">
                            <p>{{$objprofesionallandingidioma->nombreidioma}}</p>
                            <img src="{{URL::asset($objprofesionallandingidioma->imgidioma)}}">
                        </div>
                        @endforeach
                    </li>
                </ul>
            </div>
        </section>

        <section class="sections section_tratamientos_institucion">
            <div class="tratamientos_institucion">
                <h2><i></i>Tratamientos y procedimientos</h2>
                <div class="container_cards">
                    @foreach ($objprofesionallandingtratam as $objprofesionallandingtratam)
                        <div class="card">
                            <h4>Antes</h4>
                            <img class="card-img-top" src="{{URL::asset($objprofesionallandingtratam->imgTratamientoAntes)}}">
                            <div class="card-body">
                                <h5>{{$objprofesionallandingtratam->tituloTrataminetoAntes}}</h5>
                                <p>{{$objprofesionallandingtratam->descripcionTratamientoAntes}}</p>
                            </div>
                        </div>
                        <div class="card">
                            <h6>Después</h6>
                            <img class="card-img-top" src="{{URL::asset($objprofesionallandingtratam->imgTratamientodespues)}}">
                            <div class="card-body">
                                <h5>{{$objprofesionallandingtratam->tituloTrataminetoDespues}}</h5>
                                <p>{{$objprofesionallandingtratam->descripcionTratamientoDespues}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="sections contains_swiper_premios">
            <h2><i></i>Premios y Reconocimientos</h2>
            <div class="swiper-container swiper_premios">
                <div class="swiper-wrapper">
                    @foreach ($objprofesionallandingpremio as $objprofesionallandingpremio)
                        <div class="swiper-slide">
                            <img src="{{URL::asset($objprofesionallandingpremio->imgpremio)}}">
                            <h6>{{$objprofesionallandingpremio->fechapremio}}</h6>
                            <h5>{{$objprofesionallandingpremio->nombrepremio}}</h5>
                            <p>{{$objprofesionallandingpremio->descripcionpremio}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="sections section_publicaciones_institucion">
            <div class="publicaciones_institucion">
                <h2><i></i>Publicaciones</h2>
                <div class="container_cards">
                    @foreach ($objprofesionallandingpublic as $objprofesionallandingpublic)
                        <div class="card">
                            <img class="card-img-top" src="{{URL::asset($objprofesionallandingpublic->imgpublicacion)}}">
                            <div class="card-body">
                                <h5>{{$objprofesionallandingpublic->nombrepublicacion}}</h5>
                                <p>{{$objprofesionallandingpublic->descripcion}}</p>
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
                    @foreach ($objprofesionallandinggaler as $objprofesionallandinggaler)
                    <li>
                        <img src="{{URL::asset($objprofesionallandinggaler->imggaleria)}}" alt="{{$objprofesionallandinggaler->descripcion}}"> 
                    </li>       
                    <!-- <p>{{$objprofesionallandinggaler->nombrefoto}}</p>
                    <p>{{$objprofesionallandinggaler->descripcion}}</p> -->
                    @endforeach
                </ul>    
            </div>
            
            <div class="videos_institucion">
                <h2><i></i>Videos</h2>
                <div class="container_cards">
                    @foreach ($objprofesionallandingvideo as $objprofesionallandingvideo)
                        <div class="card">
                            <iframe class="card-img-top" src="{{$objprofesionallandingvideo->urlvideo}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                            <div class="card-body">
                                <h5>{{$objprofesionallandingvideo->nombrevideo}}</h5>
                                <p>{{$objprofesionallandingvideo->descripcionvideo}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>     
        </section>
@endsection