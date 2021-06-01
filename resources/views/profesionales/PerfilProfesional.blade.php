@extends('layouts.app')
@section('content')
        <!-- seccion datos perfil profesional-->
        <section class="section_data_profesionales">
            <div class="data_profesionales">
                @foreach ($objprofesionallanding as $objprofesionallanding)
                <img src="{{URL::asset($objprofesionallanding->fotoperfil)}}">
                <div class="contains_info">
                    <h2>{{$objprofesionallanding->primernombre}} {{$objprofesionallanding->primerapellido}}</h2>
                    <h1>{{$objprofesionallanding->nombreEspecialidad}}</h1>
                    <h5>{{$objprofesionallanding->nombreuniversidad}}</h5>
                    <h5>N° Tarjeta profesional: {{$objprofesionallanding->numeroTarjeta}}</h5>
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
            <div class="swiper-container swiper_profesional">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="profesional_menu perfil">
                            <i></i>
                            <p>Perfil profesional</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="profesional_menu tratamientos">
                            <i></i>
                            <p>Tratamientos y procedimientos</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="profesional_menu premios">
                            <i></i>
                            <p>Premios y reconocimientos</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="profesional_menu publicaciones">
                            <i></i>
                            <p>Publicaciones</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="profesional_menu galeria">
                            <i></i>
                            <p>Galería</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="perfil_profesional">
            <div class="col-12" style="background: brown;">
                <p>{{$objprofesionallanding->descripcionPerfil}}</p>
            </div>

            <div class="col-12" style="background: cadetblue;">
                @foreach ($objprofesionallandingestudios as $objprofesionallandingestudios)
                    <p>{{$objprofesionallandingestudios->nombreestudio}}</p>
                    <p>{{$objprofesionallandingestudios->nombreuniversidad}}</p>
                    <p>{{$objprofesionallandingestudios->fechaestudio}}</p>
                @endforeach
            </div>

            <div class="col-12" style="background: chartreuse;">
                @foreach ($objprofesionallandingexperi as $objprofesionallandingexperi)
                    <p>{{$objprofesionallandingexperi->nombreEmpresaExperiencia}}</p>
                    <p>{{$objprofesionallandingexperi->descripcionExperiencia}}</p>
                    <p>{{$objprofesionallandingexperi->fechaInicioExperiencia}}</p>
                    <p>{{$objprofesionallandingexperi->fechaFinExperiencia}}</p>
                    <img src="{{URL::asset($objprofesionallandingexperi->imgexperiencia)}}">
                @endforeach
            </div>

            <div class="col-12" style="background: chocolate;">
                @foreach ($objprofesionallandingasocia as $objprofesionallandingasocia)
                    <img src="{{URL::asset($objprofesionallandingasocia->imgasociacion)}}">
                @endforeach
            </div>

            <div class="col-12" style="background: cornflowerblue;">
                @foreach ($objprofesionallandingidioma as $objprofesionallandingidioma)
                    <p>{{$objprofesionallandingidioma->nombreidioma}}</p>
                    <img src="{{URL::asset($objprofesionallandingidioma->imgidioma)}}">
                @endforeach
            </div>
        </section>

        <div class="col-12" style="background: crimson;">
            @foreach ($objprofesionallandingtratam as $objprofesionallandingtratam)
                <div class="col-12">
                    <img src="{{URL::asset($objprofesionallandingtratam->imgTratamientoAntes)}}">
                    <p>{{$objprofesionallandingtratam->tituloTrataminetoAntes}}</p>
                    <p>{{$objprofesionallandingtratam->descripcionTratamientoAntes}}</p>
                </div>
                <div class="col-12">
                    <img src="{{URL::asset($objprofesionallandingtratam->imgTratamientodespues)}}">
                    <p>{{$objprofesionallandingtratam->tituloTrataminetoDespues}}</p>
                    <p>{{$objprofesionallandingtratam->descripcionTratamientoDespues}}</p>
                </div>
            @endforeach
        </div>


        
        <div class="col-12" style="background: cornflowerblue;">
            @foreach ($objprofesionallandingpremio as $objprofesionallandingpremio)
            <img src="{{URL::asset($objprofesionallandingpremio->imgpremio)}}">
            <p>{{$objprofesionallandingpremio->fechapremio}}</p>
            <p>{{$objprofesionallandingpremio->nombrepremio}}</p>
            <p>{{$objprofesionallandingpremio->descripcionpremio}}</p>
            @endforeach
        </div>

        <div class="col-12" style="background: chocolate;">
            @foreach ($objprofesionallandingpublic as $objprofesionallandingpublic)
            <img src="{{URL::asset($objprofesionallandingpublic->imgpublicacion)}}">
            <p>{{$objprofesionallandingpublic->nombrepublicacion}}</p>
            <p>{{$objprofesionallandingpublic->descripcion}}</p>
            @endforeach
        </div>

        <div class="col-12" style="background: crimson;">
            @foreach ($objprofesionallandinggaler as $objprofesionallandinggaler)
            <img src="{{URL::asset($objprofesionallandinggaler->imggaleria)}}">
            <p>{{$objprofesionallandinggaler->nombrefoto}}</p>
            <p>{{$objprofesionallandinggaler->descripcion}}</p>
            @endforeach
        </div>

        <div class="col-12" style="background: blueviolet;">
            @foreach ($objprofesionallandingvideo as $objprofesionallandingvideo)
            <iframe src="{{$objprofesionallandingvideo->urlvideo}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            <p>{{$objprofesionallandingvideo->nombrevideo}}</p>
            <p>{{$objprofesionallandingvideo->descripcionvideo}}</p>
            @endforeach
        </div>
        
@endsection