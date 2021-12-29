@extends('layouts.app')
@section('content')
    @php
        $new_array = array();
    @endphp
    <!-- seccion datos perfil profesional-->
    <section class="card_head_lan">
        <div class="section_main_data">
            <div class="content_data_lan">
                <!-- <div class="section_backArrow">
                    <a class="back_arrow back_text" href="#"> atras </a>
                    <div class="heart-wrapper">
                        <i class="far fa-heart"></i>
                    </div>
                </div> -->
                @foreach ($objinstitucionlandin as $objinstitucionlandin)
                    <div class="content_logo_inst m-auto"> <!--clase sin atributos -->
                        <img class="logo_sede_lan" src="{{URL::asset($objinstitucionlandin->logo)}}">
                    </div>

                    <div class="main_data_lan">
                        <h1 class="title_color_h1">{{$objinstitucionlandin->nombreinstitucion}}</h1>
                        <h2 class="subTitle_h2">{{$objinstitucionlandin->nombretipo}}</h2>
                        <h5 class="text_h5"><i class="icon_pweb"></i>{{$objinstitucionlandin->url}}</h5>
                        <h5 class="text_h5"><i class="icon_cont"></i>{{$objinstitucionlandin->telefonouno}}</h5>
                        <h5 class="text_h5"><i class="icon_addr"></i>{{$objinstitucionlandin->direccion}}<br>{{$objinstitucionlandin->ciudad}} {{$objinstitucionlandin->pais}}</h5>
                        <!-- Rating Stars Box -->
                        <div class='rating-stars start_calification'>
                            <ul id='stars' class="my-0">
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

                    <div class="content_img_sede">
                        <img class="img_sede_lan" src="{{URL::asset($objinstitucionlandinimgsede->imagen)}}">
                    </div>
                @endforeach
            </div>

            <div class="section_btn_lan">
                <a class="btn_colorful" href="">Agende su cita
                    <i class="fas fa-arrow-right pl-2"></i>
                </a>
                <a class="btn_colorless" href="{{route('PerfilInstitucion-profesionales', ['slug' => $objinstitucionlandin->slug])}}">Ver profesional
                    <i class="fas fa-arrow-right pl-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- seccion datos consulta perfil profesional-->
    <section class="contains_swiper_institucion">
        @if($objinstitucionlandin->idtipoInstitucion == 9)
            <h1 class="title_black_h1"> !Una asociación médica de vanguardia!</h1>
        @else
            <h1 class="title_black_h1">¿Por qué es un centro médico de alto nivel?</h1>
        @endif
    
        <div class="swiper-container swiper_institucion">
            <div id="obj" class="swiper-wrapper landingInsti">
                <li class="swiper-slide">
                    <a id="serv" class="item_landing_insti serv_green" data-target="serv" onclick="showElement(this)">
                        <span>Servicios profesionales</span>
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="prof" class="item_landing_insti prof_grey" data-target="prof" onclick="showElement(this)"
                    href="{{route('PerfilInstitucion-profesionales', ['slug' => $objinstitucionlandin->slug])}}">
                        <span>Profesionales</span>
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="acer" class="item_landing_insti acer_grey" data-target="acer" onclick="showElement(this)">
                        <span>Acerca de la Institución</span>
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="cert" class="item_landing_insti cert_grey" data-target="cert" onclick="showElement(this)">
                        <span>Certificaciones</span>
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="sede" class="item_landing_insti sede_grey" data-target="sede" onclick="showElement(this)">
                        <span>Sedes</span>
                    </a>
                </li>
                <li class="swiper-slide">
                    <a id="gale" class="item_landing_insti gale_grey" data-target="gale" onclick="showElement(this)">
                        <span>Galería</span>
                    </a>
                </li>
            </div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev btnPrev_LandInst"></div>
            <div class="swiper-button-next btnNext_LandInst"></div> 
        </div>
    </section>

    <section id="serv_ins" class="section_toggle">
        <div class="servicios_instituciones">
            <h2 class="subTitle_color_h2"><i></i>Servicios profesionales</h2>

            <p class="text_p mb-3">{{$objinstitucionlandin->DescripcionGeneralServicios}}</p>
        </div>
        
        <div class="desplegable_LandInst accordion_green" id="accordion"> <!--Función del cambio de color a verde en los botones del collapse estan ubicados en el archivo "footer.js". -->
            @foreach ($objinstitucionlandinservicios as $objinstitucionlandinservicios)
                <div class="card card_acordion px-0">
                    <div id="heading_{{$loop->iteration}}">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapse_{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse_{{$loop->iteration}}">{{$objinstitucionlandinservicios->tituloServicios}}</button>
                    </div>

                    <div id="collapse_{{$loop->iteration}}" class="collapse" aria-labelledby="heading_{{$loop->iteration}}" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="text_p p-0">{{$objinstitucionlandinservicios->DescripcioServicios}}</p>
                        </div>

                        <div class="toggle_info">
                            @if($objinstitucionlandinservicios->sucursalservicio)
                                @php  $new_array = explode(',',$objinstitucionlandinservicios->sucursalservicio); @endphp
                            @endif
                            @foreach($new_array as $info)
                                <li class="text_p p-0">{{$info}}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <div class="prof_ins" class="section_toggle">
    </div>

    <section id="acer_ins" class="section_toggle">

        <div class="quienes_somos">
            <h2 class="subTitle_color_h2"><i></i>¿Quiénes somos?</h2>
            <p class="text_p mb-3">{{$objinstitucionlandin->quienessomos}}</p>
        </div>

        <div class="propuesta">
            <h2 class="subTitle_black_h2"><i></i>Propuesta de valor</h2>
            <ul>
                <li>
                    <p class="text_p p-0">{{$objinstitucionlandin->propuestavalor}}</p>
                </li>
            </ul>
        </div>

        <div class="convenios">
            <h2 class="subTitle_black_h2"><i></i>Convenios</h2>
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


    <div id="cert_ins" class="section_toggle">
        <h2 class="subTitle_color_h2"><i></i>Certificados</h2>
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


    <section id="sede_ins" class="section_toggle">
        <div class="sedes_institucion">
            <h2 class="subTitle_color_h2"><i></i>Sedes</h2>
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
            <h2 class="subTitle_black_h2"><i></i>Ubica la sede</h2>
            <p class="text_p mb-3">Conoce como llegar a la sede más cercana.</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.7670370514384!2d-74.07662168467442!3d4.635601943507973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9a2d7480bc75%3A0x893a7b8651243c29!2sMedPlus%20Medicina%20Prepagada%20Palermo%20Bogot%C3%A1!5e0!3m2!1ses!2sco!4v1625066882913!5m2!1ses!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>

    <section id="gale_ins" class="section_toggle">
        <div class="galeria_institucion">
            <h2 class="subTitle_color_h2"><i></i>Galería</h2>
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
            <h2 class="subTitle_black_h2"><i></i>Videos</h2>
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
        <h2 class="subTitle_color_h2"><i></i> Opiniones de pacientes </h2>
        <p class="text_p"> Describa su opinión y seleccione las estrellas según el puntaje que le quiera asignar al médico. </p>

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
