@extends('layouts.app')
@section('content')

@php
   $new_array = array();
@endphp
        <!-- seccion datos perfil profesional-->
        <section class="section_data_instituciones">
            <div class="containt_princ_LandInst">
                <div class="data_instituciones">
                    <!-- <div class="section_backArrow">
                        <a class="back_arrow back_text" href="#"> atras </a>
                        <div class="heart-wrapper">
                            <i class="far fa-heart"></i>
                        </div>
                    </div> -->
                    @foreach ($objinstitucionlandin as $objinstitucionlandin)
                        <div class="content_logo_inst">
                            <img class="logo_sede_inst" src="{{URL::asset($objinstitucionlandin->logo)}}">
                        </div>

                        <div class="contains_info">
                            <h1>{{$objinstitucionlandin->nombreinstitucion}}</h1>
                            <h2>{{$objinstitucionlandin->nombretipo}}</h2>
                            <h5 class="title-url mb-2 mb-lg-0"><i></i>{{$objinstitucionlandin->url}}</h5>
                            <h5 class="title-tel mb-2 mb-lg-0"><i></i>{{$objinstitucionlandin->telefonouno}}</h5>
                            <h5 class="title-adress"><i></i>{{$objinstitucionlandin->direccion}}<br>{{$objinstitucionlandin->ciudad}} {{$objinstitucionlandin->pais}}</h5>
                            <!-- Rating Stars Box -->
                            <div class='rating-stars start_calification'>
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

                        <div class="content_sede_inst">
                            <img class="img_sede_inst" src="{{URL::asset($objinstitucionlandinimgsede->imagen)}}">
                        </div>
                    @endforeach

                </div>

                <div class="contains_buttons_landInst">
                    <a href="">Agende su cita
                        <i class="fas fa-arrow-right arrow_mas"></i>
                    </a>
                    <a href="{{route('PerfilInstitucion-profesionales', ['slug' => $objinstitucionlandin->slug])}}">Ver profesional
                        <i class="fas fa-arrow-right arrow_mas"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- seccion datos consulta perfil profesional-->
        <section class="contains_swiper_institucion">
            <h1>¿Por qué es un centro médico de alto nivel?</h1>
            <div class="swiper-container swiper_institucion">
                <div class="swiper-wrapper landingInsti">
                    <li class="swiper-slide">
                        <a class="item_landing_insti servicios servicios_clicked"><span>Servicios profesionales</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a href="{{route('PerfilInstitucion-profesionales', ['slug' => $objinstitucionlandin->slug])}}" class="item_landing_insti profesional"><span>Profesionales</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a class="item_landing_insti acerca"><span>Acerca de la Institución</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a class="item_landing_insti certificados"><span>Certificaciones</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a class="item_landing_insti sedes"><span>Sedes</span></a>
                    </li>
                    <li class="swiper-slide">
                        <a class="item_landing_insti galeria"><span>Galería</span></a>
                    </li>
                </div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev btnPrev_LandInst"></div>
                <div class="swiper-button-next btnNext_LandInst"></div> 
            </div>
        </section>

        <section class="section_insti section_insti_active section_servicios_institucion">

            <div class="servicios_instituciones">
                <h2><i></i>Servicios profesionales</h2>

                <p>{{$objinstitucionlandin->DescripcionGeneralServicios}}</p>
            </div>


            <!-- <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
  Tooltip on top
</button> -->



            
            <div class="desplegable_LandInst" id="accordion"> <!--Función del cambio de color a verde en los botones del collapse estan ubicados en el archivo "footer.js". -->
                @foreach ($objinstitucionlandinservicios as $objinstitucionlandinservicios)
                    <div class="card containt_collapse_LandInst">
                        <div id="heading_{{$loop->iteration}}">
                            <button class="boton_collapse-off" data-toggle="collapse" data-target="#collapse_{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse_{{$loop->iteration}}">{{$objinstitucionlandinservicios->tituloServicios}}</button>
                        </div>

                        <div id="collapse_{{$loop->iteration}}" class="collapse" aria-labelledby="heading_{{$loop->iteration}}" data-parent="#accordion">
                            <div class="card-body card_txt_LandInst">
                                <p>{{$objinstitucionlandinservicios->DescripcioServicios}}</p>
                            </div>
                            <div class="lista_sede">
                                @if($objinstitucionlandinservicios->sucursalservicio)
                                    @php  $new_array = explode(',',$objinstitucionlandinservicios->sucursalservicio); @endphp
                                @endif
                                @foreach($new_array as $info)
                                    <li>{{$info}}</li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="section_insti">
        </div>

        <section class="section_insti section_acerca_institucion">

            <div class="quienes_somos">
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
                <div class="content_conv_landInst">
                    @foreach($objConvenios as $convenio)
                        <div class="conv_imgText_LandInst">
                            <img class="img-fluid" src="{{ asset($convenio->url_image) }}" alt="{{ $convenio->nombre_convenio }}">
                            <h5>{{$convenio->nombre_convenio}}</h5>
                        </div>
                    @endforeach
                </div>
                <!-- <ul>
                    <li>
                    {{--@if(!empty($objinstitucionlandineps))--}}
                        {{--@foreach ($objinstitucionlandineps as $objinstitucionlandineps)--}}
                            {{--<img src="{{URL::asset($objinstitucionlandineps->urlimagen)}}">--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                    </li>

                    <li>
                        {{--@foreach ($objinstitucionlandinips as $objinstitucionlandinips)--}}
                            {{--<img src="{{URL::asset($objinstitucionlandinips->urlimagen)}}">--}}
                        {{--@endforeach--}}
                    </li>

                    <li>
                        {{--@foreach ($objinstitucionlandinprepagada as $objinstitucionlandinprepagada)--}}
                            {{--<img src="{{URL::asset($objinstitucionlandinprepagada->urlimagen)}}">--}}
                        {{--@endforeach--}}
                    </li>
                </ul> -->
            </div>
        </section>


        <div class="section_insti contain_swiper_certificados">
            <h2><i></i>Certificados</h2>
            <div class="swiper-container swiper_certificado_LandInst">
                <div class="swiper-wrapper">
                    @foreach ($objinstitucionlandinpremios as $objinstitucionlandinpremios)
                        <div class="swiper-slide slaider_certificado_LandInst">
                            <img src="{{URL::asset($objinstitucionlandinpremios->imgcertificado)}}">
                            <h6>{{$objinstitucionlandinpremios->fechacertificado}}</h6>
                            <h5>{{$objinstitucionlandinpremios->titulocertificado}}</h5>
                            <p>{{$objinstitucionlandinpremios->descrpcioncertificado}}</p>
                        </div>
                    @endforeach
                </div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev btnPrev_cert_LandInst"></div>
                <div class="swiper-button-next btnNext_cert_LandInst"></div> 
            </div>
        </div>


        <section class="section_insti">
            <div class="sedes_institucion">
                <h2><i></i>Sedes</h2>
                <div class="container_cards">
                    @foreach ($objinstitucionlandinSedes as $objinstitucionlandinSedes)
                        <div class="card">
                            <img class="card_imgSede_LandInst" src="{{URL::asset($objinstitucionlandinSedes->imgsede)}}">

                            <div class="card-body">
                                <h5>{{$objinstitucionlandinSedes->nombre}}</h5>
                                <p>{{$objinstitucionlandinSedes->direccion}}</p>
                                <p>{{$objinstitucionlandinSedes->horario_sede}}</p>
                                <span>{{$objinstitucionlandinSedes->telefono}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mapa">
                <h2><i></i>Ubica la sede</h2>
                <p>Conoce como llegar a la sede más cercana.</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.7670370514384!2d-74.07662168467442!3d4.635601943507973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9a2d7480bc75%3A0x893a7b8651243c29!2sMedPlus%20Medicina%20Prepagada%20Palermo%20Bogot%C3%A1!5e0!3m2!1ses!2sco!4v1625066882913!5m2!1ses!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>

        <section class="section_insti">
            <div class="galeria_institucion">
                <h2><i></i>Galería</h2>
                <div class="swiper-container swiper_galeria_inst">
                    <div class="swiper-wrapper">
                        @foreach ($objinstitucionlandingaleria as $objinstitucionlandingaleria)
                            <div class="swiper-slide slaider_galeria_LandInst">
                                <img src="{{URL::asset($objinstitucionlandingaleria->imggaleria)}}" alt="{{$objinstitucionlandingaleria->descripcion}}">
                                <h5>{{$objinstitucionlandingaleria->nombrefoto}}</h5>
                                <p>{{$objinstitucionlandingaleria->descripcion}}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev btnPrev_gal_LandInst"></div>
                    <div class="swiper-button-next btnNext_gal_LandInst"></div> 
                </div>
            </div>

            <div class="videos_institucion">
                <h2><i></i>Videos</h2>
                <div class="container_cards_video">
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

        <section class="container-fluid opiniones_LandInst">
            <h2><i></i> Opiniones de pacientes </h2>
            <p> Describa su opinión y seleccione las estrellas según el puntaje que le quiera asignar al médico. </p>

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

              
                    @if(!empty($objprofesionalComentario))
                        @foreach ($objprofesionalComentario as $data)
                        <div class="visible_container">
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
                                    <i class="far fa-star" style="color: #E6C804;"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="section_comentario-prof">
                                <span>{{$data->comentario}}</span>
                            </div>
                        </div>
                        </div>
                        @endforeach
                    @endif
      
            </div>

            <div class="opinion_verif_LandInst">
                <h3><i></i> Todos los comentarios son de pacientes verificados. </h3>
                <!-- <h2 class="icono_verificado-prof txt_verify-bottom"> Todos los comentarios son de pacientes verificados. </h2> -->
            </div>
        </section>
@endsection
<!-- Archivo JS for formulario profesional-->
<script src="{{ asset('js/perfil-instituciones.js') }}"></script>
