@extends('layouts.app')
@section('content')

        <!-- seccion datos perfil profesional-->
        <section class="section_data_profesionales">
            <div class="data_profesionales">
                <div class="section_backArrow">
                    <a class="back_arrow back_text" href="#"> atras </a>

                    <div class="heart-wrapper">
                        <i class="far fa-heart"></i>
                    </div>
                </div>



                @foreach ($objprofesionallanding as $objprofesionallanding)
                <img src="{{URL::asset($objprofesionallanding->fotoperfil)}}">
                <div class="contains_info">
                    <h2>{{$objprofesionallanding->primernombre}} {{$objprofesionallanding->primerapellido}}</h2>
                    <h1>{{$objprofesionallanding->nombreEspecialidad}}</h1>
                    <h5>{{$objprofesionallanding->nombreuniversidad}}</h5>
                    <h5>N° Tarjeta profesional: {{$objprofesionallanding->numeroTarjeta}}</h5>
                    <!-- Rating Stars Box -->
                    <div class='rating-stars star_box'>
                        @if(!empty($objprofesionalComentario))
                            @foreach($objprofesionalComentario as $promedioEstrellas)
                            @endforeach
                            @for ($i=1; $i <= $promedioEstrellas->calificacionRedondeada; $i++)
                                <li class='star' title='Poor'>
                                    <i class='fa fa-star fa-fw' style="color: #E6C804;"></i>
                                </li>
                            @endfor
                            @for ($i=$promedioEstrellas->calificacionRedondeada; $i <= 4; $i++)
                                <li class='star' title='Poor'>
                                    <i class='fa fa-star fa-fw' style="color: red;"></i>
                                </li>
                            @endfor
                        @endif
                    </div>

                    <!-- <div class="contains_direccion"></div> -->
                    <h5 class="title-adress"><i></i>{{$objprofesionallanding->direccion}}</h5>
                    <h5>{{$objprofesionallanding->nombre}}</h5>
                </div>
                @endforeach
            </div>
        </section>

        <!-- seccion datos consulta perfil profesional-->
        <section class="section_data_consulta">
            <h2>Tipo de consulta</h2>
            <div class="data_consulta">
                <ul>
                    @foreach ($objprofesionallandingconsultas as $objprofesionallandingconsultas)
                        <li>
                            <p class="menu_{{$loop->iteration}}"><i></i>{{$objprofesionallandingconsultas->nombreconsulta}}</p>
                            <span><i></i>${{$objprofesionallandingconsultas->valorconsulta}}</span>
                        </li>
                    @endforeach
                </ul>
           
                <div class="contains_buttons">
                    <a href="{{url('admindPaciente/'.$objprofesionallanding->idPerfilProfesional)}}">Agende su cita
                        <i class="fas fa-arrow-right arrow_mas"></i>
                    </a>
                    <a href="">Ver agenda
                        <i class="fas fa-arrow-right arrow_mas"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- seccion datos consulta perfil profesional-->
        <section class="section_destacado">
            <div class="destacado">
                <h2><i></i>Destacado en:</h2>
                <ul>
                    @foreach ($objprofesionallandingexperto as $objprofesionallandingexperto)
                        <li>
                            <p>{{$objprofesionallandingexperto->nombreExpertoEn}}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <!-- seccion datos consulta perfil profesional-->
        <section class="contains_swiper_profesional">
            <h1>¿Por qué es un doctor de alto nivel?</h1>
            <div class="swiper-container swiper_profesional">
                <div class="swiper-wrapper landingProf">
                    <li class="swiper-slide">
                        <a class="item_landing perfil perfil_clicked"><span>Perfil profesional</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a class="item_landing tratamientos"><span>Tratamientos y procedimientos</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a class="item_landing premios"><span>Premios y reconocimientos</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a class="item_landing publicaciones"><span>Publicaciones</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a class="item_landing galeria"><span>Galería</span></a>
                    </li>
                </div>
            </div>
        </section>

        <section class="sections sections_active section_perfil_profesional">

            <div class="perfil_profesional">
                <h2><i></i>Perfil Profesional</h2>
                <p>{{$objprofesionallanding->descripcionPerfil}}</p>
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

        <section class="sections section_tratamientos_profesional">
            <div class="tratamientos_profesional">
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

        <section class="sections section_publicaciones_profesional">
            <div class="publicaciones_profesional">
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
            <div class="galeria_profesional">
                <h2><i></i>Galería</h2>
                <ul class="gallery_profesional">
                    @foreach ($objprofesionallandinggaler as $objprofesionallandinggaler)
                    <li>
                        <img src="{{URL::asset($objprofesionallandinggaler->imggaleria)}}" alt="{{$objprofesionallandinggaler->descripcion}}"> 
                    </li>       
                    <!-- <p>{{$objprofesionallandinggaler->nombrefoto}}</p>
                    <p>{{$objprofesionallandinggaler->descripcion}}</p> -->
                    @endforeach
                </ul>    
            </div>
            
            <div class="videos_profesional">
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

        <section class="container-fluid content_options-prof">
            <h2 class="icono_opiniones-prof title_opiniones"> Opiniones de pacientes </h2>

            <p class="text_cabecera-prof"> Describa su opinión y seleccione las estrellas según el puntaje que le quiera asignar al médico. </p>

            <div id="resultados">
                <div class="alert alert-success d-none mt-5" id="msg_comentario">
                    <span id="res_message"></span>
                </div>

                @if(!empty($objTipoUser))
                    @foreach ($objTipoUser as $tipo)
                    @endforeach

                    @if($tipo->idrol==1)
                        <form class="opinion_form-prof" id="comentarioFormProf" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="hidden" id="idperfil" name="idperfil" value="{{$objprofesionallanding->idPerfilProfesional}}">

                            <textarea class="txtarea_form-prof" id="comentario" placeholder="Escribe tus comentarios aquí..." name="comentario" rows="4" cols="50"></textarea>

                            <div class="content_btnStart-form">
                                <div class="rating-stars section_Starts-form">
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

                                <div class="section_btnStart-form">
                                    <button id="send_form_coment_prof" type="submit" class="button_send-form"> Agregar
                                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="icon_arrow-form" alt=""> 
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                @endif
                       
                <div class="visible_container">
                    @if(!empty($objprofesionalComentario))
                        @foreach ($objprofesionalComentario as $data)
                        <div class="section_opciones" id="oscar">
                            <div class="section_usuario-prof">
                                <div class="contains_avatar">
                                    <i class="fas fa-circle circle_opinion-prof"></i>
                                </div>
                                <div class="contains_text">
                                    <p class="name_usuario-prof">{{$data->primernombre}} {{$data->primerapellido}}</p>
                                    <p class="icono_verify verify_usuario-prof"> Paciente verificado </p>       
                                </div>

                                <div class="section_stars-prof">
                                    @for ($i=1; $i <= $data->calificacion; $i++)
                                    <i class='fa fa-star fa-fw' style="color: #E6C804;"></i>
                                    @endfor 
                                    @for ($i=$data->calificacion; $i <= 4; $i++)
                                    <i class='fa fa-star fa-fw' style="color: red;"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="section_comentario-prof">
                                <span>{{$data->comentario}}</span>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- <div class="section_masComent-prof">
                <a class="txt_comentarios-prof" href=""> Más comentarios </a>
            </div> ///-->
            <div class="section_verificado-prof">
                <h3 class="icono_verificado-prof txt_verify-bottom"> Todos los comentarios son de pacientes verificados. </h3>
            </div>
        </section>
@endsection
<!-- Script JS for perfil profesional -->
<script src="{{ asset('js/perfil-profesionales.js') }}"></script>