@extends('layouts.app')

@section('styles')
    <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->
    <!--<link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet" />-->
    <!--<link rel="stylesheet" href="{{ asset('plugins/pace/themes/blue/pace-theme-loading-bar.css') }}"/>-->

    <style>
        /*.pace-running > *:not(.pace) {
            opacity:0.1;
        }
        #page_overlay {
            position: fixed;
            z-index: 2000;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
        }*/
    </style>
@endsection

@section('content')
    <!--     Sección lista de opciones     -->
    <ol  class="optionList_formInst">
        <div class="content_icons-formInst"> <!-- clase "content_icons-formInst" para evento ocultar y mostrar contenido de la opción. Ubicado en el archivo formularios.js -->
            <li class="iconVerde_datoInst dato_institution" onclick="hideContaintOption(this)" data-position="dateInstitution"> <!-- clase "dato_institution" para activar el evento on click de la opción. Ubicado en el archivo formulario.js  -->
                <p class="text_opcion-formInst" > Datos institucionales </p>
            </li>
        </div>

        <div class="content_icons-formInst">
            <li class="iconGris_servProfesional serv_profesional" onclick="hideContaintOption(this)" data-position="professionalServices">
                <p class="text_opcion-formInst" > Servicios profesionales </p>
            </li>
        </div>

        <div class="content_icons-formInst">
            <li class="iconGris_acercaInst acerca_institution" onclick="hideContaintOption(this)" data-position="aboutInstitution">
                <p class="text_opcion-formInst" > Acerca de la institución </p>
            </li>
        </div>

        <div class="content_icons-formInst">
            <li class="iconGris_profesionalInst profesional_institution" onclick="hideContaintOption(this)" data-position="professionalInst">
                <p class="text_opcion-formInst" > Profesionales </p>
            </li>
        </div>

        <div class="content_icons-formInst">
            <li class="iconGris_certifInst certificado_institution" onclick="hideContaintOption(this)" data-position="certificationsInst">
                <p class="text_opcion-formInst" > Certificaciones </p>
            </li>
        </div>

        <div class="content_icons-formInst">
            <li class="iconGris_sedeInst sede_institution" onclick="hideContaintOption(this)" data-position="venuesInst">
                <p class="text_opcion-formInst" > Sedes </p>
            </li>
        </div>

        <div class="content_icons-formInst">
            <li class="iconGris_galeInst galeria_institution" onclick="hideContaintOption(this)" data-position="galleryInst">
                <p class="text_opcion-formInst" > Galería </p>
            </li>
        </div>
    </ol>

    <!-- 1* Contenedor principal de la opción DATOS INSTITUCIONALES -->
    <div class="container-fluid date_institution content_principal-formInst"> <!-- Clase "date_institution" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!-- Titulo y texto superior -->
        <div class="col-lg-10 col-xl-8 content_textPrincipal-formInst">
            <h1 class="titulo_principal-formInst"> LE DAMOS LA BIENVENIDA A ZAABRA SALUD </h1>

            <p class="texto_superior-formInst"> Ingrese los datos según corresponda y finalice el proceso completamente en línea. </p>
        </div>

        <!--------------------------------------------      Inicio 1 primera parte del formulario *** INFORMACIÓN BÁSICA ***      --------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-12 icon_infoBasica-formInst"> Información básica </h5>
            <div id="mensajes-basico"></div>
            <form method="POST" action="{{ route('entidad.create1') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-basico-institucional">
                @csrf
                <div class="row fila_infoUser-formInst">
                    <!-- Sección logo datos institución -->
                    <div class="col-md-3 contain_imgUsuario-formImg">
                        <img id="img-logoInstitucion" class="img_usuario-formInst" src="{{ (isset($objFormulario->logo)) ? asset($objFormulario->logo) : ''}}">
                        <input type="file" class="input_imgUsuario-formInst" name="logo_institucion"  id="logo_institucion" onchange="ver_imagen('logo_institucion', 'img-logoInstitucion')" accept="image/png, image/jpeg">
                        <p class="icon_subirFoto-formInst"> Subir foto de logo </p>
                    </div>
                    <!-- Sección datos institución -->
                    <div class="col-md-4 col-xl-5 datos_principales-formInst">
                        <div class="col-12 rightSection_formInst">
                            <label for="nombre_institucion" class="col-12 text_label-formInst"> Nombres Institución</label>
                            <input class="col-12 input_nomApl-formInst" value="{{ old('nombre_institucion', $objuser->nombreinstitucion) }}" id="nombre_institucion" name="nombre_institucion">
                        </div>
                        <div class="col-12 rightSection_formInst">
                            <label for="fecha_inicio_institucion" class="col-12 text_label-formInst">  Fecha  </label>
                            <input class="col-12 form-control" type="date" value="{{ old('fecha_inicio_institucion', $objFormulario->fechainicio) }}" id="fecha_inicio_institucion" name="fecha_inicio_institucion">
                        </div>
                        <div class="col-12 rightSection_formInst">
                            <label for="url_institucion" class="col-12 text_label-formInst"> Página web </label>
                            <input class="col-12 form-control" placeholder="Url" type="text" name="url_institucion" id="url_institucion" value="{{ old('url_institucion', $objFormulario->url) }}">
                        </div>
                        <div class="col-12 rightSection_formInst">
                            <label for="tipo_institucion" class="col-12 text_label-formInst"> Selecione entidad </label>
                            <select class="col-lg-12 form-control" name="tipo_institucion" id="tipo_institucion">
                                @foreach($tipoinstitucion as $tipoinstitucion)
                                    <option value="{{$tipoinstitucion->id}}" {{ ($tipoinstitucion->id == $objFormulario->idtipoInstitucion) ? 'selected' : '' }}> {{$tipoinstitucion->nombretipo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Sección imagen datos institución -->
                    <div class="col-md-5 col-xl-4 datos_principales2-formInst">
                        <div class="col-12 contain_imgInst-formInst">
                            <img class="img_institucion-formInst" id="img-imagenInstitucion" src="{{ (isset($objFormulario->imagen)) ? asset($objFormulario->imagen) : '' }}" />
                            <input type="file" class="input_imgUsuario-formInst" name="imagen_institucion"  id="imagen_institucion" onchange="ver_imagen('imagen_institucion', 'img-imagenInstitucion')" accept="image/png, image/jpeg">
                            <p class="icon_subirFoto-formInst"> Subir foto de la sede </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 content_btnEnviar-formInst">
                    <button type="submit" class="btn_guardar-formInst" id="btn-guardar-basico-institucional"> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
                <!--------------- Fin campos vacios--------------------->
            </form>
        </div>
        <!--------------------------------------------      Fin 1 primera parte del formulario *** INFORMACIÓN BÁSICA ***      ------------------------------------------------>

        <!--------------------------------------------      Inicio 2 segunda parte del formulario *** INFORMACIÓN CONTACTO ***      ------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <form method="POST" action="{{ url ('/FormularioInstitucionSave2') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <h5 class="col-12 icon_infoContac-formInst"> Información de contacto </h5>

                <div class="row fila_infoUser-formInst">
                    @if(!empty($objFormulario->telefonouno))
                        <div class="col-md-6 leftSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Celular </label>

                            <input class="col-12 form-control" id="tarjeta" placeholder="Número de celular" type="number" name="telefonouno" value="{{$objFormulario->telefonouno}}">
                        </div>

                        <div class="col-md-6 rightSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono fijo </label>

                            <input class="col-12 form-control" id="telefono" placeholder="Número Teléfono" type="number" name="telefono2" value="{{$objFormulario->telefono2}}">
                        </div>

                        <div class="col-md-6 leftSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Dirección </label>

                            <input class="col-12 form-control" id="direccion" placeholder="Dirección" type="text" name="direccion" value="{{$objFormulario->direccion}}">
                        </div>

                        <!--menu dinamico ciudades -->
                        <div class="col-md-6 rightSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Seleccione país </label>

                            <select id="idpais" name="idpais" class="col-12 form-control">
                                <option></option>
                                @foreach($listaPaises as $pais)
                                    <option value="{{ $pais->id_pais }}"  {{ (isset($objFormulario->id_pais) && $objFormulario->id_pais == $pais->id_pais) ? 'selected' : ''}}> {{ $pais->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 leftSection_formInst">
                            <label for="id_departamento" class="col-12 text_label-formInst"> Seleccione departamento </label>
                            <select name="id_departamento" id="id_departamento" class="col-12 form-control">
                                @foreach($listaDepartamentos as $departamento)
                                    <option value="{{ $departamento->id_departamento }}"  {{ (isset($objFormulario->id_departamento) && $objFormulario->id_departamento == $departamento->id_departamento) ? 'selected' : ''}}> {{ $departamento->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 rightSection_formInst">
                            <label for="id_provincia" class="col-12 text_label-formInst"> Seleccione provincia </label>
                            <select name="id_provincia" id="id_provincia" class="col-12 form-control">
                                @foreach($listaProvincias as $provincia)
                                    <option value="{{ $provincia->id_provincia }}"  {{ (isset($objFormulario->id_provincia) && $objFormulario->id_provincia == $provincia->id_provincia) ? 'selected' : ''}}> {{ $provincia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 leftSection_formInst">
                            <label for="id_municipio" class="col-12 text_label-formInst"> Seleccione ciudad </label>
                            <select name="id_municipio" id="id_municipio" class="col-12 form-control">
                                @foreach($listaMunicipios as $municipio)
                                    <option value="{{ $municipio->id_municipio }}"  {{ (isset($objFormulario->id_municipio) && $objFormulario->id_municipio == $municipio->id_municipio) ? 'selected' : ''}}> {{ $municipio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botón guardar información -->
                        <div class="col-12 content_btnEnviar-formInst">
                            <button type="submit" class="btn2_enviar-formInst"> Guardar
                                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                            </button>
                        </div>

                    @else
                        <div class="col-md-6 leftSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Celular </label>

                            <input class="col-12 form-control" id="tarjeta" placeholder="Número de celular" type="number" name="telefonouno" >
                        </div>

                        <div class="col-md-6 rightSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono fijo </label>

                            <input class="col-12 form-control" id="telefono" placeholder="Número de teléfono" type="number" name="telefono2" >
                        </div>

                        <div class="col-md-6 leftSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Dirección </label>

                            <input class="col-12 form-control" id="direccion" placeholder="Dirección" type="text" name="direccion" >
                        </div>

                        <!--menu dinamico ciudades -->
                        <div class="col-md-6 rightSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Seleccione país </label>

                            <select id="idpais" name="idpais" class="form-control">
                                <option value="" selected disabled> Seleccione país </option>

                                @foreach($pais as $pais)
                                    <option value="{{$pais->id_pais}}"> {{$pais->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 leftSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Seleccione departamento </label>

                            <select name="id_departamento" id="id_departamento" class="form-control"></select>
                        </div>

                        <div class="col-md-6 rightSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Seleccione provincia </label>

                            <select name="id_provincia" id="id_provincia" class="form-control"></select>
                        </div>

                        <div class="col-md-6 leftSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Seleccione ciudad </label>

                            <select name="id_municipio" id="id_municipio" class="form-control"> </select>
                        </div>

                        <!-- Botón guardar información -->
                        <div class="col-12 content_btnEnviar-formInst">
                            <button type="submit" class="btn2_enviar-formInst"> Guardar
                                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                            </button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 2 segunda parte del formulario *** INFORMACIÓN CONTACTO ***      ---------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonInferior-next-formInst">
            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst btn-next-320-formInst" onclick="hideBtnNext(this)" code-position="dateInstitution"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 2* Contenedor principal de la opción SERVICIOS PROFESIONALES -->
    <div class="container-fluid professional_services content_principal-formInst"> <!-- Clase "professional_services" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 3 tercera parte del formulario *** SERVICIO PROFESIONAL ***      ------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-12 icon_servProf-formInst"> Servicios profesionales </h5>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave3') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @if(!empty($objFormulario->DescripcionGeneralServicios))
                    <div class="col-12 px-0">
                        <p for="example-date-input" class="text_superior-proced-formInst"> Escriba una breve descripción de su servicio. </p>

                        <textarea class="form-control" id="descripcionPerfil"  type="text" name="DescripcionGeneralServicios" >{{$objFormulario->DescripcionGeneralServicios}}</textarea>
                    </div>
                @else
                    <div class="col-12 px-0">
                        <p for="example-date-input" class="text_superior-proced-formInst"> Escriba una breve descripción de su servicio. </p>

                        <textarea class="form-control" id="descripcionPerfil" placeholder="Escribir descripción..." type="text" maxlength="270" name="DescripcionGeneralServicios" ></textarea>

                        <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                    </div>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 3 tercera parte del formulario *** SERVICIO PROFESIONAL ***      ---------------------------------------------->

        <!--------------------------------------------      Inicio 4 cuarta parte del formulario *** SERVICIO ***      -------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_servicios-formInst"> Servicios </h5>
            <!-- Modulo contenido SERVICIOS -->
            <div class="experiencia_guardada-formProf">
                @foreach($objServicio as $objServicio)
                    @if(!empty($objServicio->tituloServicios))
                        <div class="savedData_formInst">
                            <div class="col-12 content_cierreX-formInst">
                                <a href="{{url('/FormularioInstituciondelete4/'.$objServicio->id_servicio)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="option_consulta-formProf">
                                <label for="example-date-input" class="col-12 title_infoGuardada-formProf"> Título del servicio </label>

                                <label class="col-12 text_infoGuardada-formProf"> {{$objServicio->tituloServicios}} </label>
                            </div>

                            <div class="option_consulta-formProf">
                                <label for="example-date-input" class="col-12 title_infoGuardada-formProf"> Descrpción </label>

                                <label class="col-12 text_infoGuardada-formProf"> {{$objServicio->DescripcioServicios}} </label>
                            </div>

                            <div class="option_consulta-formProf">
                                <label for="example-date-input" class="col-12 title_infoGuardada-formProf"> Sedes en la que está el servicio </label>
                                @if($objServicio->sucursalservicio)
                                    @php  $new_array = explode(',',$objServicio->sucursalservicio); @endphp
                                @endif
                                @foreach($new_array as $info)
                                    <li class="col-12 text_infoGuardada-formProf"> {{$info}} </li>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            @if (
                    $errors->has('tituloServicios.*') or
                    $errors->has('DescripcioServicios.*') or
                    $errors->has('sucursalservicio.*')
                )
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Error!</h4>
                    <p>Llene todos los formualrios que necesita.</p>
                </div>
            </div>
            @endif


            <form method="POST" action="{{ url ('/FormularioInstitucionSave4') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @if($objContadorServicio->cantidad == 0)
                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                            <div class="col-12 leftSection_formInst form-group">
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 rightSection_formInst downLine_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>
                            <div class="col-12 leftSection_formInst">
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 rightSection_formInst downLine_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>
                            <div class="col-12 leftSection_formInst">
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 rightSection_formInst downLine_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>
                @elseif($objContadorServicio->cantidad == 1)
                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>
                            <div class="col-12 leftSection_formInst">
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 rightSection_formInst downLine_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>
                            <div class="col-12 leftSection_formInst">
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 rightSection_formInst downLine_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>
                @elseif($objContadorServicio->cantidad == 2)
                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>
                            <div class="col-12 leftSection_formInst">
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 rightSection_formInst downLine_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>
                            <div class="col-12 leftSection_formInst">
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 rightSection_formInst downLine_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>
                @elseif($objContadorServicio->cantidad == 3)
                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>
                            <div class="col-12 leftSection_formInst">
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 rightSection_formInst downLine_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>
                @elseif($objContadorServicio->cantidad == 4)
                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>
                            <div class="col-12 leftSection_formInst">
                                <input class="col-12 form-control" data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 rightSection_formInst downLine_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>
                @elseif($objContadorServicio->cantidad == 5)
                    <!-- Modulo contenido SERVICIOS -->
                    <div class="row fila_infoBasica-formInst">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título del servicio </label>

                                <input class="form-control" id="tituloServicios" placeholder="Título del servicio" type="text" name="tituloServicios[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                <textarea class="form-control" id="DescripcioServicios" placeholder="Escribir descripción..." maxlength="270" name="DescripcioServicios[]" value=""></textarea>

                                <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>

                                <input class="col-12 form-control"  data-role="tagsinput" placeholder="Nombre de la sede" type="text" name="sucursalservicio[]" value="">
                            </div>
                        </div>
                    </div>
                @elseif($objContadorServicio->cantidad == 6)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formInst"> No se pueden agregar más servicios </label>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 4 cuarta parte del formulario *** SERVICIO ***      ----------------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="professionalServices">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="professionalServices"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 3* Contenedor principal de la opción ACERCA DE LA INSTITUCIÓN -->
    <div class="container-fluid about_institution content_principal-formInst"> <!-- Clase "about_institution" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 5 quinta parte del formulario *** QUIENES SOMOS ***      ------------------------------------------------------>
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_quienes-formInst"> ¿Quiénes somos? </h5>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave5') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @if(!empty($objFormulario->quienessomos))
                    <div class="col-12 px-0">
                        <p for="example-date-input" class="text_superior-proced-formInst"> Escriba una breve descripción de ¿Quiénes son?. </p>

                        <textarea class="form-control" id="descripcionPerfil"  type="text" name="quienessomos" >{{$objFormulario->quienessomos}}</textarea>
                    </div>
                @else
                    <div class="col-12 px-0">
                        <p for="example-date-input" class="text_superior-proced-formInst"> Escriba una breve descripción de ¿Quiénes son?. </p>

                        <textarea class="form-control" id="descripcionPerfil" placeholder="Escribir descripción..." type="text"  maxlength="500" name="quienessomos" ></textarea>

                        <label class="col-12 text_infoImg-formInst"> 500 Caracteres </label>
                    </div>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 5 quinta parte del formulario *** QUIENES SOMOS ***      ------------------------------------------------------>

        <!--------------------------------------------      Inicio 6 sexta parte del formulario *** PROPUESTA DE VALOR ***      ----------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_propuestaValor-formInst"> Propuesta de valor </h5>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave6') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @if(!empty($objFormulario->propuestavalor))
                    <div class="col-12 px-0">
                        <p for="example-date-input" class="text_superior-proced-formInst"> Escriba una breve descripción de la propuesta de valor. </p>

                        <textarea class="form-control" id="descripcionPerfil"  type="text" name="propuestavalor" >{{$objFormulario->propuestavalor}}</textarea>
                    </div>
                @else
                    <div class="col-12 px-0">
                        <p for="example-date-input" class="text_superior-proced-formInst">  Escriba una breve descripción de la propuesta de valor. </p>

                        <textarea class="form-control" id="descripcionPerfil" placeholder="Escribir descripción..." type="text" maxlength="300" name="propuestavalor" ></textarea>

                        <label class="col-12 text_infoImg-formInst"> 300 Caracteres </label>
                    </div>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 6 sexta parte del formulario *** PROPUESTA DE VALOR ***      -------------------------------------------------->

        <!--------------------------------------------      Inicio 7 septima parte del formulario *** CONVENIOS ***      ------------------------------------------------------>
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_convenios-formInst"> Convenios </h5>

            <div class="asociacion_guardada-formProf">
                @foreach($objEps as $objEps)
                    @if(!empty($objEps->urlimagen))
                        <div class="section_infoAsocia-formInst">
                            <div class="col-12 content_btnX-cierre-formProf my-2">
                                <label for="example-date-input" class="text_saved-formInst pb-0"> Convenio EPS </label>

                                <a href="{{url('/FormularioInstituciondelete5/'.$objEps->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>



                            <div class="option_asociacion-formProf">
                                <img class="img_guardada-formProf" id="imagenPrevisualizacion" src="{{URL::asset($objEps->urlimagen)}}">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="asociacion_guardada-formProf">
                @foreach($objIps as $objIps)
                    @if(!empty($objIps->urlimagen))
                        <div class="section_infoAsocia-formInst">
                            <div class="col-12 content_btnX-cierre-formProf my-2">
                                <label for="example-date-input" class="text_saved-formInst pb-0"> Convenio IPS </label>

                                <a href="{{url('/FormularioInstituciondelete6/'.$objIps->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="option_asociacion-formProf">
                                <img class="img_guardada-formProf" id="imagenPrevisualizacion" src="{{URL::asset($objIps->urlimagen)}}">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="asociacion_guardada-formProf">
                @foreach($objPrepa as $objPrepa)
                    @if(!empty($objPrepa->urlimagen))
                        <div class="section_infoAsocia-formInst">
                            <div class="col-12 content_btnX-cierre-formProf my-2">
                                <label for="example-date-input" class="text_saved-formInst pb-0"> Convenio medicina prepagada </label>

                                <a href="{{url('/FormularioInstituciondelete7/'.$objPrepa->id_prepagada)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="option_asociacion-formProf">
                                <img class="img_guardada-formProf" id="imagenPrevisualizacion" src="{{URL::asset($objPrepa->urlimagen)}}">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave7') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row col-12 row_convenio-form">
                    <!-- **************************************************************** FORMULARIO EPS ************************************************************** -->
                    @if($objContadorEps->cantidad == 0)
                        <div class="row col-12 p-0 m-0">
                            <p for="example-date-input" class="text_superior-proced-formInst"> Suba imágenes con respecto a los convenios que tengan con las EPS. </p>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview2"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage2" name="urlimagenEps[]" onchange="previewImage(2);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview3"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage3" name="urlimagenEps[]" onchange="previewImage(3);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview4"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage4" name="urlimagenEps[]" onchange="previewImage(4);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>
                        </div>

                    @elseif($objContadorEps->cantidad == 1)
                    <div class="row col-12 p-0 m-0">
                            <p for="example-date-input" class="text_superior-proced-formInst"> Suba imágenes con respecto a los convenios que tengan con las EPS. </p>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview3"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage3" name="urlimagenEps[]" onchange="previewImage(3);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview4"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage4" name="urlimagenEps[]" onchange="previewImage(4);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>
                        </div>
                    @elseif($objContadorEps->cantidad == 2)
                    <div class="row col-12 p-0 m-0">
                            <p for="example-date-input" class="text_superior-proced-formInst"> Suba imágenes con respecto a los convenios que tengan con las EPS. </p>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview4"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage4" name="urlimagenEps[]" onchange="previewImage(4);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>
                        </div>

                    @elseif($objContadorEps->cantidad == 3)
                        <label for="example-date-input" class="col-12 txtInfo_limitante-formInst"> No se pueden agregar más convenios de EPS </label>
                    @endif

                    <!-- **************************************************************** FORMULARIO IPS ************************************************************** -->
                    @if($objContadorIps->cantidad == 0)
                        <div class="row col-12 p-0 m-0">
                            <p for="example-date-input" class="text_superior-proced-formInst"> Suba imágenes con respecto a los convenios que tengan con las IPS. </p>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview6"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage6" name="urlimagenIps[]" onchange="previewImage(6);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview7"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage7" name="urlimagenIps[]" onchange="previewImage(7);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview8"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage8" name="urlimagenIps[]" onchange="previewImage(8);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>
                        </div>

                    @elseif($objContadorIps->cantidad == 1)
                    <div class="row col-12 p-0 m-0">
                            <p for="example-date-input" class="text_superior-proced-formInst"> Suba imágenes con respecto a los convenios que tengan con las IPS. </p>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview7"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage7" name="urlimagenIps[]" onchange="previewImage(7);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview8"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage8" name="urlimagenIps[]" onchange="previewImage(8);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>
                        </div>

                    @elseif($objContadorIps->cantidad == 2)
                    <div class="row col-12 p-0 m-0">
                            <p for="example-date-input" class="text_superior-proced-formInst"> Suba imágenes con respecto a los convenios que tengan con las IPS. </p>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview8"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage8" name="urlimagenIps[]" onchange="previewImage(8);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>
                        </div>

                    @elseif($objContadorIps->cantidad == 3)
                        <label for="example-date-input" class="col-12 txtInfo_limitante-formInst"> No se pueden agregar más convenios de IPS </label>
                    @endif

                    <!-- **************************************************************** FORMULARIO PREPAGADA ************************************************************** -->
                    @if($objContadorPrepa->cantidad == 0)
                        <div class="row col-12 p-0 m-0">
                            <p for="example-date-input" class="text_superior-proced-formInst"> Suba imágenes con respecto a los convenios que tengan con medicina prepagada. </p>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview10"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage10" name="urlimagenPre[]" onchange="previewImage(10);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview11"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage11" name="urlimagenPre[]" onchange="previewImage(11);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview12"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage12" name="urlimagenPre[]" onchange="previewImage(12);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>
                        </div>

                    @elseif($objContadorPrepa->cantidad == 1)
                    <div class="row col-12 p-0 m-0">
                            <p for="example-date-input" class="text_superior-proced-formInst"> Suba imágenes con respecto a los convenios que tengan con medicina prepagada. </p>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview11"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage11" name="urlimagenPre[]" onchange="previewImage(11);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview12"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage12" name="urlimagenPre[]" onchange="previewImage(12);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>
                        </div>

                    @elseif($objContadorPrepa->cantidad == 2)
                    <div class="row col-12 p-0 m-0">
                            <p for="example-date-input" class="text_superior-proced-formInst"> Suba imágenes con respecto a los convenios que tengan con medicina prepagada. </p>

                            <div class="col-md-4 content_agregarImg-formInst form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview12"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage12" name="urlimagenPre[]" onchange="previewImage(12);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                                </div>
                            </div>
                        </div>

                    @elseif($objContadorPrepa->cantidad == 3)
                        <label for="example-date-input" class="col-12 txtInfo_limitante-formInst"> No se pueden agregar más convenios de medicina prepagada </label>
                    @endif

                </div>

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst mt-0 mt-md-3"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 7 septima parte del formulario *** CONVENIOS ***      --------------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="aboutInstitution">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="aboutInstitution"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 4* Contenedor principal de la opción PROFESIONALES -->
    <div class="container-fluid professional_inst content_principal-formInst"> <!-- Clase "professional_inst" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 8 octava parte del formulario *** PROFESIONALES ***      --------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_profesionales-formInst"> Profesionales </h5>

            <div class="col-11 col-md-12 row containt_profGuardado-formInst">
                @foreach($objProfeInsti as $objProfeInsti)
                    @if(!empty($objProfeInsti->foto_perfil_institucion))
                        <div class="col-md-3 content_loadImg-profes">
                            <div class="col-12 p-0 contain_imgUsuario-formImg">
                                <div class="col-12 pr-2 content_cierreX-formInst">
                                    <a href="{{url('/FormularioInstituciondelete8/'.$objProfeInsti->id_profesional_inst)}}">
                                        <button type="submit" class="close" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </a>
                                </div>

                                <div class="col-12 col-md-10 img_save-formProf">
                                    <img class="img_usuario-formInst" src="{{URL::asset($objProfeInsti->foto_perfil_institucion)}}">
                                </div>
                            </div>

                            <div class="col-12 mt-3 containt_loadProfes-formInst">
                                <div class="col-md-12 rightSection_formInst">
                                    <span>{{$objProfeInsti->primer_nombre}} {{$objProfeInsti->segundo_nombre}}</span>
                                </div>

                                <div class="col-md-12 rightSection_formInst">
                                    <span>{{$objProfeInsti->primer_apellido}} {{$objProfeInsti->segundo_apellido}}</span>
                                </div>

                                <div class="col-md-12 rightSection_formInst">
                                    <span>{{$objProfeInsti->especialidad_uno}}</span>
                                </div>

                                <div class="col-md-12 rightSection_formInst">
                                    <span> {{$objProfeInsti->especialidad_dos}}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @if (
                    $errors->has('foto_perfil_institucion.*') or
                    $errors->has('primer_nombre.*') or
                    $errors->has('segundo_nombre.*') or
                    $errors->has('primer_apellido.*') or
                    $errors->has('segundo_apellido.*') or
                    $errors->has('especialidad_uno.*') or
                    $errors->has('especialidad_dos.*')
                )
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Error!</h4>
                        <p>Llene todos los formualrios que necesita.</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ url ('/FormularioInstitucionSave8') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div data-info="{{$objContadorProfeInsti->cantidad}}" class="div-count"></div>

                @if($objContadorProfeInsti->cantidad == 0)
                    <!-- Profesional numero 1 -->
                    <div class="row fila_infoBasica-formInst mb-4">
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            <img class="img_usuario-formInst" id="imagenPrevi1">

                            <input class="input_imgUsuario-formInst" type="file" id="selecArchivos1" name="foto_perfil_institucion[]" onchange="previewImageProf(1);" accept="image/png, image/jpeg">

                            <p class="icon_subirFoto-formInst"> Subir foto de perfil </p>
                        </div>

                        <div class="row col-md-9 datos_principales-formInst">
                            <div class="col-md-6 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" placeholder="Primer nombre" type="text" name="primer_nombre[]" value="">

                                    <input class="input_nomApl-prefes-formProf" placeholder="Segundo nombre"  type="text" name="segundo_nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-md-6 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" placeholder="Primer apellido"  type="text" name="primer_apellido[]" value="">

                                    <input class="input_nomApl-prefes-formProf" placeholder="Segundo apellido"  type="text" name="segundo_apellido[]" value="">
                                </div>
                            </div>

                            <div class="col-md-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Universidad </label>

                                <input class="col-12 form-control" placeholder="Nombre de la universidad"  type="text" name="especialidad_uno[]" value="">

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control" placeholder="Nombre de la especialidad"  type="text" name="especialidad_dos[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profesional numero 2 -->
                    <div class="row fila_infoBasica-formInst mb-4">
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            <img class="img_usuario-formInst" id="imagenPrevi2">

                            <input class="input_imgUsuario-formInst" type="file" id="selecArchivos2" name="foto_perfil_institucion[]" onchange="previewImageProf(2);" accept="image/png, image/jpeg">

                            <p class="icon_subirFoto-formInst"> Subir foto de perfil </p>
                        </div>

                        <div class="row col-md-9 datos_principales-formInst">
                            <div class="col-md-6 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" placeholder="Primer nombre" type="text" name="primer_nombre[]" value="">

                                    <input class="input_nomApl-prefes-formProf" placeholder="Segundo nombre"  type="text" name="segundo_nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-md-6 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" placeholder="Primer apellido"  type="text" name="primer_apellido[]" value="">

                                    <input class="input_nomApl-prefes-formProf" placeholder="Segundo apellido"  type="text" name="segundo_apellido[]" value="">
                                </div>
                            </div>

                            <div class="col-md-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Universidad </label>

                                <input class="col-12 form-control" placeholder="Nombre de la universidad"  type="text" name="especialidad_uno[]" value="">

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control" placeholder="Nombre de la especialidad"  type="text" name="especialidad_dos[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profesional numero 3 -->
                    <div class="row fila_infoBasica-formInst">
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            <img class="img_usuario-formInst" id="imagenPrevi3">

                            <input class="input_imgUsuario-formInst" type="file" id="selecArchivos3" name="foto_perfil_institucion[]" onchange="previewImageProf(3);" accept="image/png, image/jpeg">

                            <p class="icon_subirFoto-formInst"> Subir foto de perfil </p>
                        </div>

                        <div class="row col-md-9 datos_principales-formInst">
                            <div class="col-md-6 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" placeholder="Primer nombre" type="text" name="primer_nombre[]" value="">

                                    <input class="input_nomApl-prefes-formProf" placeholder="Segundo nombre"  type="text" name="segundo_nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-md-6 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" placeholder="Primer apellido"  type="text" name="primer_apellido[]" value="">

                                    <input class="input_nomApl-prefes-formProf" placeholder="Segundo apellido"  type="text" name="segundo_apellido[]" value="">
                                </div>
                            </div>

                            <div class="col-md-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Universidad </label>

                                <input class="col-12 form-control" placeholder="Nombre de la universidad"  type="text" name="especialidad_uno[]" value="">

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control" placeholder="Nombre de la especialidad"  type="text" name="especialidad_dos[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorProfeInsti->cantidad == 1)
                    <!-- Profesional numero 2 -->
                    <div class="row fila_infoBasica-formInst mb-4">
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            <img class="img_usuario-formInst" id="imagenPrevi2">

                            <input class="input_imgUsuario-formInst" type="file" id="selecArchivos2" name="foto_perfil_institucion[]" onchange="previewImageProf(2);" accept="image/png, image/jpeg">

                            <p class="icon_subirFoto-formInst"> Subir foto de perfil </p>
                        </div>

                        <div class="row col-md-9 datos_principales-formInst">
                            <div class="col-md-6 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" placeholder="Primer nombre" type="text" name="primer_nombre[]" value="">

                                    <input class="input_nomApl-prefes-formProf" placeholder="Segundo nombre"  type="text" name="segundo_nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-md-6 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" placeholder="Primer apellido"  type="text" name="primer_apellido[]" value="">

                                    <input class="input_nomApl-prefes-formProf" placeholder="Segundo apellido"  type="text" name="segundo_apellido[]" value="">
                                </div>
                            </div>

                            <div class="col-md-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Universidad </label>

                                <input class="col-12 form-control" placeholder="Nombre de la universidad"  type="text" name="especialidad_uno[]" value="">

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control" placeholder="Nombre de la especialidad"  type="text" name="especialidad_dos[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profesional numero 3 -->
                    <div class="row fila_infoBasica-formInst">
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            <img class="img_usuario-formInst" id="imagenPrevi3">

                            <input class="input_imgUsuario-formInst" type="file" id="selecArchivos3" name="foto_perfil_institucion[]" onchange="previewImageProf(3);" accept="image/png, image/jpeg">

                            <p class="icon_subirFoto-formInst"> Subir foto de perfil </p>
                        </div>

                        <div class="row col-md-9 datos_principales-formInst">
                            <div class="col-md-6 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" placeholder="Primer nombre" type="text" name="primer_nombre[]" value="">

                                    <input class="input_nomApl-prefes-formProf" placeholder="Segundo nombre"  type="text" name="segundo_nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-md-6 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" placeholder="Primer apellido"  type="text" name="primer_apellido[]" value="">

                                    <input class="input_nomApl-prefes-formProf" placeholder="Segundo apellido"  type="text" name="segundo_apellido[]" value="">
                                </div>
                            </div>

                            <div class="col-md-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Universidad </label>

                                <input class="col-12 form-control" placeholder="Nombre de la universidad"  type="text" name="especialidad_uno[]" value="">

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control" placeholder="Nombre de la especialidad"  type="text" name="especialidad_dos[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorProfeInsti->cantidad == 2)
                    <!-- Profesional numero 3 -->
                    <div class="row fila_infoBasica-formInst">
                        <div class="col-md-3 contain_imgUsuario-formImg">
                            <img class="img_usuario-formInst" id="imagenPrevi3">

                            <input class="input_imgUsuario-formInst" type="file" id="selecArchivos3" name="foto_perfil_institucion[]" onchange="previewImageProf(3);" accept="image/png, image/jpeg">

                            <p class="icon_subirFoto-formInst"> Subir foto de perfil </p>
                        </div>

                        <div class="row col-md-9 datos_principales-formInst">
                            <div class="col-md-6 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" placeholder="Primer nombre" type="text" name="primer_nombre[]" value="">

                                    <input class="input_nomApl-prefes-formProf" placeholder="Segundo nombre"  type="text" name="segundo_nombre[]" value="">
                                </div>
                            </div>

                            <div class="col-md-6 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>

                                <div class="col-12 nombres_usuario-formInst">
                                    <input class="input_nomApl-prefes-formProf" placeholder="Primer apellido"  type="text" name="primer_apellido[]" value="">

                                    <input class="input_nomApl-prefes-formProf" placeholder="Segundo apellido"  type="text" name="segundo_apellido[]" value="">
                                </div>
                            </div>

                            <div class="col-md-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Universidad </label>

                                <input class="col-12 form-control" placeholder="Nombre de la universidad"  type="text" name="especialidad_uno[]" value="">

                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Especialidades </label>

                                    <input class="col-12 form-control" placeholder="Nombre de la especialidad"  type="text" name="especialidad_dos[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorProfeInsti->cantidad == 3)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formInst"> No se peden agregar más profesionales </label>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst mt-0"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 8 octava parte del formulario *** PROFESIONALES ***      ------------------------------------------------------>

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="professionalInst">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="professionalInst"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 5* Contenedor principal de la opción CERTIFICACIONES -->
    <div class="container-fluid certifications_inst content_principal-formInst"> <!-- Clase "certifications_inst" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 9 novena parte del formulario *** CERTIFICACIONES ***      ------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_certificaciones-formInst"> Certificaciones </h5>

            <p class="text_superior-proced-formInst"> A continuación suba imágenes relacionadas con sus certificaciones, con fecha, nombre y descripción. </p>

            <!-- Modulo de los Certificaciones con información -->
            <div class="premios_guardada-formProf">
                @foreach($objCertificaciones as $objCertificaciones)
                    @if(!empty($objCertificaciones->imgcertificado))
                        <!-- Contenido Certificaciones -->
                        <div class="savedData_formInst">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <a href="{{url('/FormularioInstituciondelete9/'.$objCertificaciones->id_certificacion)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="col-12 mt-2 p-0">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst"  src="{{URL::asset($objCertificaciones->imgcertificado)}}">
                                </div>

                                <div class="col-12 p-0 mt-2">
                                    <label class="col-12 text_fechaPremio-formProf"> {{$objCertificaciones->fechacertificado}} </label>
                                </div>

                                <div class="col-12 text_label-formProf">
                                    <label class="col-12 title_infoGuardada-formProf"> {{$objCertificaciones->titulocertificado}} </label>
                                </div>

                                <div class="col-12 descripcion_Premio-formProf">
                                    <label class="col-12 text_descPremio-formProf"> {{$objCertificaciones->descrpcioncertificado}} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave9') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (
                                    $errors->has('imgcertificado.*') or
                                    $errors->has('titulocertificado.*') or
                                    $errors->has('fechacertificado.*') or
                                    $errors->has('descrpcioncertificado.*')
                                )
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Error!</h4>
                            <p>Llene todos los formualrios que necesita.</p>
                        </div>
                    </div>
                @endif
                @if($objContadorCertificaciones->cantidad == 0)
                    <!-- Modulo CERTIFICACIONES-->
                    <div class="row content_antDesp-formInst">
                        <!-- CERTIFICACIÓN izquierda -->
                        <div class="col-md-6 photo1 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview13">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage13" name="imgcertificado[]" onchange="previewImage(13);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst mb-0"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                <input class="form-control" id="titulocertificado" placeholder="Título de la imagen" type="text" name="titulocertificado[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado" placeholder="Escribir descripción..." type="text" maxlength="160" name="descrpcioncertificado[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- CERTIFICACIÓN derecha -->
                        <div class="col-md-6 photo2 rightSection_formInst">
                            <div class="col-12 rightSection_formInst  form-group">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview14">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage14" name="imgcertificado[]" onchange="previewImage(14);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 2 </label>

                                <input class="form-control" id="titulocertificado" placeholder="Título de la imagen" type="text" name="titulocertificado[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado" placeholder="Escribir descripción..." type="text" maxlength="160" name="descrpcioncertificado[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo CERTIFICACIONES-->
                    <div class="row content_antDesp-formInst">
                        <!-- CERTIFICACIÓN izquierda -->
                        <div class="col-md-6 photo3 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview15">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage15" name="imgcertificado[]" onchange="previewImage(15);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst mb-0"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 3 </label>

                                <input class="form-control" id="titulocertificado" placeholder="Título de la imagen" type="text" name="titulocertificado[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado" placeholder="Escribir descripción..." type="text" maxlength="160" name="descrpcioncertificado[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- CERTIFICACIÓN derecha -->
                        <div class="col-md-6 photo4 rightSection_formInst">
                            <div class="col-12 rightSection_formInst  form-group">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview16">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage16" name="imgcertificado[]" onchange="previewImage(16);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 4 </label>

                                <input class="form-control" id="titulocertificado" placeholder="Título de la imagen" type="text" name="titulocertificado[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado" placeholder="Escribir descripción..." type="text" maxlength="160" name="descrpcioncertificado[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorCertificaciones->cantidad == 1)
                    <!-- Modulo CERTIFICACIONES-->
                    <div class="row content_antDesp-formInst">
                        <!-- CERTIFICACIÓN izquierda -->
                        <div class="col-md-6 photo2 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview14">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage14" name="imgcertificado[]" onchange="previewImage(14);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst mb-0"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 2 </label>

                                <input class="form-control" id="titulocertificado" placeholder="Título de la imagen" type="text" name="titulocertificado[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado" placeholder="Escribir descripción..." type="text" maxlength="160" name="descrpcioncertificado[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo CERTIFICACIONES-->
                    <div class="row content_antDesp-formInst">
                        <!-- CERTIFICACIÓN izquierda -->
                        <div class="col-md-6 photo3 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview15">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage15" name="imgcertificado[]" onchange="previewImage(15);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst mb-0"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 3 </label>

                                <input class="form-control" id="titulocertificado" placeholder="Título de la imagen" type="text" name="titulocertificado[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado" placeholder="Escribir descripción..." type="text" maxlength="160" name="descrpcioncertificado[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- CERTIFICACIÓN derecha -->
                        <div class="col-md-6 photo4 rightSection_formInst">
                            <div class="col-12 rightSection_formInst  form-group">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview16">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage16" name="imgcertificado[]" onchange="previewImage(16);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 4 </label>

                                <input class="form-control" id="titulocertificado" placeholder="Título de la imagen" type="text" name="titulocertificado[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado" placeholder="Escribir descripción..." type="text" maxlength="160" name="descrpcioncertificado[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorCertificaciones->cantidad == 2)
                    <!-- Modulo CERTIFICACIONES-->
                    <div class="row content_antDesp-formInst">
                        <!-- CERTIFICACIÓN izquierda -->
                        <div class="col-md-6 photo3 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview15">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage15" name="imgcertificado[]" onchange="previewImage(15);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst mb-0"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 3 </label>

                                <input class="form-control" id="titulocertificado" placeholder="Título de la imagen" type="text" name="titulocertificado[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado" placeholder="Escribir descripción..." type="text" maxlength="160" name="descrpcioncertificado[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- CERTIFICACIÓN derecha -->
                        <div class="col-md-6 photo4 rightSection_formInst">
                            <div class="col-12 rightSection_formInst  form-group">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview16">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage16" name="imgcertificado[]" onchange="previewImage(16);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 4 </label>

                                <input class="form-control" id="titulocertificado" placeholder="Título de la imagen" type="text" name="titulocertificado[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado" placeholder="Escribir descripción..." type="text" maxlength="160" name="descrpcioncertificado[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorCertificaciones->cantidad == 3)
                    <div class="row content_antDesp-formInst">
                        <!-- CERTIFICACIÓN izquierda -->
                        <div class="col-md-6 photo4 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview16">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage16" name="imgcertificado[]" onchange="previewImage(16);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst mb-0"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechacertificado" name="fechacertificado[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 4 </label>

                                <input class="form-control" id="titulocertificado" placeholder="Título de la imagen" type="text" name="titulocertificado[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción de la certificación </label>

                                    <input class="form-control" id="descrpcioncertificado" placeholder="Escribir descripción..." type="text" maxlength="160" name="descrpcioncertificado[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorCertificaciones->cantidad == 4)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formInst"> No se pueden agregar más certificados </label>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst mt-0"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 9 novena parte del formulario *** CERTIFICACIONES ***      ---------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="certificationsInst">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="certificationsInst"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 6* Contenedor principal de la opción SEDES -->
    <div class="container-fluid venues_inst content_principal-formInst"> <!-- Clase "venues_inst" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 10 decima parte del formulario *** SEDES ***      ---------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_sedes-formInst"> Sedes </h5>

            <p class="text_superior-proced-formInst"> A continuación suba imágenes e información de las sedes que tengan de la institución. </p>

            <!-- Modulo de los Sedes con información -->
            <div class="premios_guardada-formProf">
                @foreach($objSedes as $objSedes)
                    @if(!empty($objSedes->imgsede))
                        <!-- Contenido Certificaciones -->
                        <div class="savedData_formInst">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <a href="{{url('/FormularioInstituciondelete10/'.$objSedes->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="col-12 mt-2 p-0">
                                <div class="img_saveSede-formInst">
                                    <img class="img_anexada-formInst" src="{{URL::asset($objSedes->imgsede)}}">
                                </div>

                                <div class="col-12 text_label-formInst">
                                    <label class="col-12 title_infoGuardada-formProf">{{$objSedes->nombre}} </label>
                                </div>

                                <div class="col-12 texto_saved-formInst">
                                    <label class="col-12 text_descPremio-formProf"> {{$objSedes->direccion}} </label>
                                </div>

                                <div class="col-12 texto_saved-formInst">
                                    <label class="col-12 text_descPremio-formProf"> {{$objSedes->horario_sede}} </label>
                                </div>

                                <div class="col-12 texto_saved-formInst">
                                    <label class="col-12 text_descPremio-formProf">{{$objSedes->telefono}} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave10') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (
                                                    $errors->has('imgsede.*') or
                                                    $errors->has('nombre.*') or
                                                    $errors->has('direccion.*') or
                                                    $errors->has('horario_sede.*') or
                                                    $errors->has('telefono.*')
                                                )
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Error!</h4>
                            <p>Llene todos los formualrios que necesita.</p>
                        </div>
                    </div>
                @endif
                @if($objContadorSedes->cantidad == 0)
                    <!-- Modulo SEDES-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido SEDES izquierdo -->
                        <div class="col-md-6 photo1 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview17">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage17" name="imgsede[]" onchange="previewImage(17);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido SEDES derecho -->
                        <div class="col-md-6 photo2 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview18">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage18" name="imgsede[]" onchange="previewImage(18);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo SEDES-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido SEDES izquierdo -->
                        <div class="col-md-6 photo3 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview19">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage19" name="imgsede[]" onchange="previewImage(19);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido SEDES derecho -->
                        <div class="col-md-6 photo4 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview20">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage20" name="imgsede[]" onchange="previewImage(20);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo SEDES-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido SEDES izquierdo -->
                        <div class="col-md-6 photo5 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview21">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage21" name="imgsede[]" onchange="previewImage(21);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido SEDES derecho -->
                        <div class="col-md-6 photo6 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview22">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage22" name="imgsede[]" onchange="previewImage(22);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorSedes->cantidad == 1)
                    <!-- Modulo SEDES-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido SEDES izquierdo -->
                        <div class="col-md-6 photo2 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview18">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage18" name="imgsede[]" onchange="previewImage(18);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo SEDES-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido SEDES izquierdo -->
                        <div class="col-md-6 photo3 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview19">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage19" name="imgsede[]" onchange="previewImage(19);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido SEDES derecho -->
                        <div class="col-md-6 photo4 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview20">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage20" name="imgsede[]" onchange="previewImage(20);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo SEDES-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido SEDES izquierdo -->
                        <div class="col-md-6 photo5 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview21">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage21" name="imgsede[]" onchange="previewImage(21);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido SEDES derecho -->
                        <div class="col-md-6 photo6 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview22">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage22" name="imgsede[]" onchange="previewImage(22);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorSedes->cantidad == 2)
                    <!-- Modulo SEDES-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido SEDES izquierdo -->
                        <div class="col-md-6 photo3 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview19">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage19" name="imgsede[]" onchange="previewImage(19);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido SEDES derecho -->
                        <div class="col-md-6 photo4 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview20">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage20" name="imgsede[]" onchange="previewImage(20);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo SEDES-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido SEDES izquierdo -->
                        <div class="col-md-6 photo5 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview21">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage21" name="imgsede[]" onchange="previewImage(21);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido SEDES derecho -->
                        <div class="col-md-6 photo6 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview22">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage22" name="imgsede[]" onchange="previewImage(22);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorSedes->cantidad == 3)
                    <!-- Modulo SEDES-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido SEDES izquierdo -->
                        <div class="col-md-6 photo4 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview20">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage20" name="imgsede[]" onchange="previewImage(20);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo SEDES-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido SEDES izquierdo -->
                        <div class="col-md-6 photo5 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview21">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage21" name="imgsede[]" onchange="previewImage(21);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido SEDES derecho -->
                        <div class="col-md-6 photo6 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview22">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage22" name="imgsede[]" onchange="previewImage(22);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorSedes->cantidad == 4)
                    <!-- Modulo SEDES-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido SEDES izquierdo -->
                        <div class="col-md-6 photo5 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview21">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage21" name="imgsede[]" onchange="previewImage(21);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Contenido SEDES derecho -->
                        <div class="col-md-6 photo6 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview22">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage22" name="imgsede[]" onchange="previewImage(22);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorSedes->cantidad == 5)
                    <!-- Modulo SEDES-->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido SEDES izquierdo -->
                        <div class="col-md-6 photo6 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview22">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage22" name="imgsede[]" onchange="previewImage(22);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Nombre de la sede </label>

                                <input class="form-control" id="nombre" placeholder="Nombre de la sede" type="text" name="nombre[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Dirrección </label>

                                <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Horario </label>

                                <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Teléfono </label>

                                    <input class="form-control" id="telefono" placeholder="Número de teléfono" type="text" name="telefono[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorSedes->cantidad == 6)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formInst"> No se pueden agregar más sedes </label>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst mt-0"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 10 decima parte del formulario *** SEDES ***      ------------------------------------------------------------->

        <!--------------------------------------------      Inicio 11 onceava parte del formulario *** UBIQUE LA SEDE ***      -------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_ubiqueSede-formInst"> Ubique la sede </h5>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave11') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @if(!empty($objFormulario->url_maps))
                    <div class="col-12 px-0">
                        <p for="example-date-input" class="text_superior-proced-formInst"> A continuación enlace las sedes en Google Maps. </p>

                        <iframe src="{{$objFormulario->url_maps}}" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                @else
                    <div class="col-12 px-0">
                        <p for="example-date-input" class="text_superior-proced-formInst"> A continuación enlace las sedes en Google Maps. </p>

                        <input class="form-control" id="descripcionPerfil" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" type="text" name="url_maps" >
                    </div>
                @endif
                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 11 onceava parte del formulario *** UBIQUE LA SEDE ***      --------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="venuesInst">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="venuesInst"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 7* Contenedor principal de la opción GALERIA -->
    <div class="container-fluid gallery_inst content_principal-formInst"> <!-- Clase "gallery_inst" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 12 doceava parte del formulario *** GALERIA ***      ------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_galeriaInst-formInst"> Galería </h5>

            <p class="text_superior-proced-formInst"> A continuación suba 8 imágenes como máximo, con su respectivo nombre y descripción. </p>

            <!-- Modulo de la GALERIA con información -->
            <div class="premios_guardada-formProf">
                @foreach($objGaleria as $objGaleria)
                    @if(!empty($objGaleria->nombrefoto))
                        <!-- Contenido GALERIA -->
                        <div class="savedData_formInst">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <a href="{{url('/FormularioInstituciondelete12/'.$objGaleria->id_galeria)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="col-12 mt-2 p-0">
                                <div class="img_saveSede-formInst">
                                    <img  class="img_anexada-formInst" src="{{URL::asset($objGaleria->imggaleria)}}">
                                </div>

                                <div class="col-12 text_label-formInst">
                                    <label class="col-12 title_infoGuardada-formProf"> {{$objGaleria->nombrefoto}} </label>
                                </div>

                                <div class="col-12 descripcion_Premio-formProf">
                                    <label class="col-12 text_descPremio-formProf">{{$objGaleria->descripcion}} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave12') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (
                        $errors->has('imggaleria.*') or
                        $errors->has('nombrefoto.*') or
                        $errors->has('descripcion.*') or
                        $errors->has('fechagaleria.*')
                     )
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Error!</h4>
                            <p>Llene todos los formualrios que necesita.</p>
                        </div>
                    </div>
                @endif
                @if($objContadorGaleria->cantidad == 0)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo1 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview23">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 1 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo2 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview24">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 2 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo3 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview25">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage25" name="imggaleria[]" onchange="previewImage(25);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 3 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo4 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview26">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage26" name="imggaleria[]" onchange="previewImage(26);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 4 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo5 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview27">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage27" name="imggaleria[]" onchange="previewImage(27);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 5 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo6 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview28">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage28" name="imggaleria[]" onchange="previewImage(28);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 6 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo7 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview29">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage29" name="imggaleria[]" onchange="previewImage(29);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo8 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview30">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage30" name="imggaleria[]" onchange="previewImage(30);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 1)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo2 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview24">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 2 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo3 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview25">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage25" name="imggaleria[]" onchange="previewImage(25);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 3 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo4 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview26">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage26" name="imggaleria[]" onchange="previewImage(26);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 4 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo5 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview27">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage27" name="imggaleria[]" onchange="previewImage(27);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 5 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo6 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview28">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage28" name="imggaleria[]" onchange="previewImage(28);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 6 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo7 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview29">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage29" name="imggaleria[]" onchange="previewImage(29);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo8 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview30">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage30" name="imggaleria[]" onchange="previewImage(30);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 2)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo3 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview25">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage25" name="imggaleria[]" onchange="previewImage(25);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 3 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo4 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview26">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage26" name="imggaleria[]" onchange="previewImage(26);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 4 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo5 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview27">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage27" name="imggaleria[]" onchange="previewImage(27);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 5 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo6 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview28">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage28" name="imggaleria[]" onchange="previewImage(28);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 6 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo7 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview29">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage29" name="imggaleria[]" onchange="previewImage(29);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo8 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview30">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage30" name="imggaleria[]" onchange="previewImage(30);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 3)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo4 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview26">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage26" name="imggaleria[]" onchange="previewImage(26);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 4 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo5 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview27">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage27" name="imggaleria[]" onchange="previewImage(27);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 5 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo6 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview28">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage28" name="imggaleria[]" onchange="previewImage(28);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 6 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo7 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview29">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage29" name="imggaleria[]" onchange="previewImage(29);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo8 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview30">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage30" name="imggaleria[]" onchange="previewImage(30);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorGaleria->cantidad == 4)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo5 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview27">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage27" name="imggaleria[]" onchange="previewImage(27);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 5 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo6 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview28">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage28" name="imggaleria[]" onchange="previewImage(28);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 6 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo7 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview29">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage29" name="imggaleria[]" onchange="previewImage(29);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo8 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview30">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage30" name="imggaleria[]" onchange="previewImage(30);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 5)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo6 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview28">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage28" name="imggaleria[]" onchange="previewImage(28);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 6 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo7 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview29">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage29" name="imggaleria[]" onchange="previewImage(29);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo8 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview30">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage30" name="imggaleria[]" onchange="previewImage(30);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 6)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo7 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview29">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage29" name="imggaleria[]" onchange="previewImage(29);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido GALERIA derecha -->
                        <div class="col-md-6 photo8 rightSection_formInst">
                            <div class="col-12">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview30">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage30" name="imggaleria[]" onchange="previewImage(30);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 7)
                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido GALERIA izquierda -->
                        <div class="col-md-6 photo8 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst" id="uploadPreview30">
                                </div>

                                <div class="agregar_archivo-formInst">
                                    <input type='file' id="uploadImage30" name="imggaleria[]" onchange="previewImage(30);"/>
                                </div>

                                <div class="txt_informativo-formInst">
                                    <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($objContadorGaleria->cantidad == 8)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formInst"> No se pueden agregar más imágenes en la galería </label>
                @endif

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst mt-0"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 12 doceava parte del formulario *** GALERIA ***      ---------------------------------------------------------->

        <!--------------------------------------------      Inicio 13 treceava parte del formulario *** VIDEOS ***      ------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-12 icon_infoVideo-formInst"> Videos </h5>

            <p class="text_superior-proced-formInst mb-0"> A continuación suba el link del video, con su respectivo nombre y descripción. </p>

            <!-- Modulos de los VIDEOS -->
            <div class="col-12 p-0 m-0">
                @foreach($objVideo as $video)
                    @if(!empty($video->nombrevideo))
                        <!-- Contenido VIDEOS -->
                        <div class="section_infoExper-formInst">
                            <div class="col-12 content_cierreX-formInst">
                                <a href="{{url('/FormularioInstituciondelete13/'.$video->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>


                            <div class="col-12 my-2">
                                <div class="col-10 img_selccionada-formProf">
                                    <iframe class="img_anexada-formProf" src="{{$video->urlvideo}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>

                                <div class="col-12 p-0 mt-2">
                                    <label class="col-12 text_fechaPremio-formProf"> {{$video->fechavideo}} </label>
                                </div>

                                <div class="col-12 text_label-formInst">
                                    <label class="col-12 title_infoGuardada-formProf"> {{$video->nombrevideo}} </label>
                                </div>

                                <div class="col-12 descripcion_Premio-formProf">
                                    <p class="col-12 text_descPremio-formProf"> {{$video->descripcionvideo}} </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioInstitucionSave13') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if (
                                        $errors->has('nombrevideo.*') or
                                        $errors->has('descripcionvideo.*') or
                                        $errors->has('urlvideo.*') or
                                        $errors->has('fechavideo.*')
                                     )
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Error!</h4>
                            <p>Llene todos los formualrios que necesita.</p>
                        </div>
                    </div>
                @endif
                @if($objContadorVideo->cantidad == 0)
                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formInst mt-0">
                        <!-- Contenido VIDEOS izquierda -->
                        <div class="col-md-6 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Url video 1 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Url video 2 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido VIDEOS izquierda -->
                        <div class="col-md-6 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Url video 3 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Url video 4 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorVideo->cantidad == 1)
                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 video2 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Url video 2 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título Video </label>

                                    <input class="form-control" id="nombrevideo"  type="text" name="nombrevideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción Video </label>

                                    <input class="form-control" id="descripcionvideo"  type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido VIDEOS izquierda -->
                        <div class="col-md-6 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Url video 3 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título Video </label>

                                    <input class="form-control" id="nombrevideo"  type="text" name="nombrevideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción Video </label>

                                    <input class="form-control" id="descripcionvideo"  type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 video2 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Url video 4 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título Video </label>

                                    <input class="form-control" id="nombrevideo"  type="text" name="nombrevideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción Video </label>

                                    <input class="form-control" id="descripcionvideo"  type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorVideo->cantidad == 2)
                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido VIDEOS izquierda -->
                        <div class="col-md-6 leftSection_formInst content_antes-formInst">
                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Url video 3 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título Video </label>

                                    <input class="form-control" id="nombrevideo"  type="text" name="nombrevideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 leftSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción Video </label>

                                    <input class="form-control" id="descripcionvideo"  type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 video2 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Url video 4 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título Video </label>

                                    <input class="form-control" id="nombrevideo"  type="text" name="nombrevideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción Video </label>

                                    <input class="form-control" id="descripcionvideo"  type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorVideo->cantidad == 3)
                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formInst">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 video2 rightSection_formInst">
                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Url video 4 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <label for="example-date-input" class="col-12 text_label-formInst"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Título Video </label>

                                    <input class="form-control" id="nombrevideo"  type="text" name="nombrevideo[]" value="">
                                </div>
                            </div>

                            <div class="col-12 rightSection_formInst">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formInst"> Descripción Video </label>

                                    <input class="form-control" id="descripcionvideo"  type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorVideo->cantidad == 4)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formInst"> No se pueden agregar más videos </label>
                @endif

                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst mt-0"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 13 treceava parte del formulario *** VIDEOS ***      ---------------------------------------------------------->

        <!-- Secciones de los botones anterior y finalizar -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="galleryInst">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <a type="submit" class="boton_inferior-finalizar-formInst" href="{{ route('contacto') }}"> Finalizar
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_finalizar-formInst" alt="">
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    <!--<script data-pace-options='{ "ajax": false, "document": true, "eventLag": false, "elements": false}' src="{{ asset('plugins/pace/pace.min.js') }}"></script> -->

    <script src="{{ asset('js/formulario-intitucional.js') }}"></script>

    <script src="{{ asset('js/selectareas.js') }}"></script>
    <script src="{{ asset('js/selectpais.js') }}"></script>
    <script src="{{ asset('js/cargaFoto.js') }}"></script>

    <script>
        // Pace.on("done", function() {
        //     $('#page_overlay').delay(300).fadeOut(600);
        // });
    </script>
@endsection
