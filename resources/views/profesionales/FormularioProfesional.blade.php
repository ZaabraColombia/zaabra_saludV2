@extends('layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/pace/themes/blue/pace-theme-loading-bar.css') }}"/>

    <style>
        .pace-running > *:not(.pace) {
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
        }
    </style>
@endsection

@section('content')

    <!--     Sección lista de opciones     -->
    <ol  class="lista_opciones-usuario-formProf">
        <div class="content_icons-formProf"> <!-- clase "content_icons-formProf" para evento ocultar y mostrar contenido de la opción. Ubicado en el archivo formularios.js -->
            <li class="iconAzul_datoPersonal dato-personal" onclick="containtHideOption(this)" data-position="personalData">
                <p class="text_opcion-formProfesional" > Datos personales </p>
            </li>
        </div>

        <div class="content_icons-formProf">
            <li class="iconGris_perfProf perfil-profesional" onclick="containtHideOption(this)" data-position="professionalProfile">
                <p class="text_opcion-formProfesional" > Perfil profesional </p>
            </li>
        </div>

        <div class="content_icons-formProf">
            <li class="iconGris_trataProced tratamiento-procedimiento" onclick="containtHideOption(this)" data-position="treatmentsProcedures">
                <p class="text_opcion-formProfesional" > Tratamientos y procedimientos </p>
            </li>
        </div>

        <div class="content_icons-formProf">
            <li class="iconGris_premioRecon premio-reconocimiento" onclick="containtHideOption(this)" data-position="AwardsHonours">
                <p class="text_opcion-formProfesional" > Premios y reconocimientos </p>
            </li>
        </div>
        <div class="content_icons-formProf">
            <li class="iconGris_public publicacion" onclick="containtHideOption(this)" data-position="publicationsFormProf">
                <p class="text_opcion-formProfesional" > Publicaciones </p>
            </li>
        </div>

        <div class="content_icons-formProf">
            <li class="iconGris_galeriaVideo galeria-video" onclick="containtHideOption(this)" data-position="galleryFormProf">
                <p class="text_opcion-formProfesional" > Galería </p>
            </li>
        </div>
    </ol>
    @if(!empty($objTiempoRestante))
        @if($objTiempoRestante->dias_transcurrido <=15)
            <p class="alert-message"> Quedan {{$objTiempoRestante->dias_transcurrido}} días </p>
        @endif
    @endif
    <!-- 1* Contenedor principal de la tarjeta DATOS PERSONALES -->
    <div class="container-fluid personal_data content_principal-formProf">
        <!-- Titulo y texto superior -->
        <div class="col-lg-10 col-xl-8 content_textPrincipal-formProf">
            <h5 class="titulo_principal-formProf"> LE DAMOS LA BIENVENIDA A ZAABRA SALUD </h5>

            <p class="texto_superior-formProf"> Ingrese los datos según corresponda y finalice el proceso completamente en línea. </p>
        </div>

        <!--------------------------------------------      Inicio 1 primera parte del formulario *** INFORMACIÓN BÁSICA ***      --------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_dato-person infoBasica_formProf">
            <h5 class="col-12 icon_infoBasica-formProf"> Información básica </h5>
            <div id="msg_basico"></div>
            <form id="formulario_basico" method="POST" action="javascript:void(0)" enctype="multipart/form-data" accept-charset="UTF-8" class="pb-2">
            @csrf
            <!---------------valida que ya exista informacion y la muestra en caso contrario muestra un formulario vacio--------------------->
                <div class="row fila_infoBasica-formProf">
                    <!-- Sección imagen de usuario -->
                    <div class="col-md-3 contain_imgUsuario-formProf">
                        <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{ (isset($objFormulario->fotoperfil)) ? asset($objFormulario->fotoperfil) : '' }}">
                        <input type="file" class="input_imgUsuario-formProf" name="logo"  id="seleccionArchivos" accept="image/png, image/jpeg" value="{{$objFormulario->fotoperfil}}">
                        <p class="icon_subirFoto-formProf text_usuario-formProf"> Subir foto de perfil </p>
                    </div>

                    <!-- Sección datos personales -->
                    <div class="row col-md-9 datos_principales-formProf">

                            <div class="col-lg-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Nombres </label>
                                <div class="col-12 nombres_usuario-formProf">
                                    <input class="input_nomApl-formProf" value="{{ (isset($objuser->primernombre)) ? $objuser->primernombre : '' }}" name="primernombre"/>
                                    <input class="input_nomApl-formProf" value="{{ (isset($objuser->segundonombre)) ? $objuser->segundonombre : '' }}" name="segundonombre"/>
                                </div>
                            </div>
                            <div class="col-lg-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Apellidos </label>
                                <div class="col-12 nombres_usuario-formProf">
                                    <input class="input_nomApl-formProf" value="{{ (isset($objuser->primerapellido)) ? $objuser->primerapellido : '' }}" name="primerapellido"/>
                                    <input class="input_nomApl-formProf" value="{{ (isset($objuser->segundoapellido)) ? $objuser->segundoapellido : '' }}" name="segundoapellido"/>
                                </div>
                            </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de nacimiento </label>
                            <input class="col-lg-12 form-control" type="date" value="{{$objFormulario->fechanacimiento}}" id="fechanacimiento" name="fechanacimiento">
                        </div>
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="idarea" class="col-12 text_label-formProf"> Selecione área </label>
                            <select id="idarea" name="idarea" class="col-lg-12 form-control">
                                @foreach($area as $a)
                                    <option value="{{ $a->idArea}}" {{ (isset($objFormulario->idarea) && $a->idArea == $objFormulario->idarea) ? 'selected' : '' }}> {{$a->nombreArea}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="idprofesion" class="col-12 text_label-formProf"> Selecione profesión </label>
                            <select name="idprofesion" id="idprofesion" class="col-lg-12 form-control">

                                @foreach($profesiones as $profesion)
                                    <option value="{{$profesion->idProfesion}}" {{ (isset($objFormulario->idprofesion) && $profesion->idProfesion == $objFormulario->idprofesion) ? 'selected' : '' }}> {{$profesion->nombreProfesion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="idespecialidad" class="col-12 text_label-formProf"> Seleccione especialidad </label>
                            <select name="idespecialidad" id="idespecialidad" class="col-lg-12 form-control">
                                @foreach($especialidades as $especialidad)
                                    <option value="{{$especialidad->idEspecialidad}}" {{ (isset($objFormulario->idEspecialidad) && $especialidad->idEspecialidad == $objFormulario->idEspecialidad) ? 'selected' : '' }}> {{$especialidad->nombreEspecialidad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_universidad" class="col-12 text_label-formProf"> Selecione universidad </label>
                            <select  class="col-lg-12 form-control universidades" name="id_universidad" id="id_universidad">
                                @if(isset($objFormulario->id_universidad))
                                    <option value="{{$objFormulario->id_universidad}}" selected>{{$objFormulario->nombreuniversidad}}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <div class="form-group">
                                <label for="tarjeta" class="col-12 text_label-formProf"> Tarjeta profesional </label>
                                <input class="col-lg-12 form-control" id="tarjeta" placeholder="Número de tarjeta" type="number" name="numeroTarjeta" value="{{$objFormulario->numeroTarjeta}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 content_btnEnviar-formProf mb-2">
                    <button type="submit" class="btn2_enviar-formProf" id="envia_basico"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 1 primera parte del formulario *** INFORMACIÓN BÁSICA ***      ------------------------------------------------>

        <!--------------------------------------------      Inicio 2 segunda parte del formulario *** INFORMACIÓN CONTACTO ***      ------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_dato-person infoBasica_formProf">
            <form id="formulario_contacto" method="POST" action="javascript:void(0)"  enctype="multipart/form-data" accept-charset="UTF-8">
                @csrf
                <h5 class="col-12 icon_infoContac-formProf"> Información de contacto </h5>
                <div class="col-12" id="msg_contacto"></div>
                <div class="row fila_infoBasica-formProf">
                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="celular" class="col-12 text_label-formProf"> Celular </label>
                        <input class="col-12 form-control" id="celular" value="{{ (isset($objFormulario->celular)) ? $objFormulario->celular : '' }}" type="number" name="celular" required >
                    </div>

                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="telefono" class="col-12 text_label-formProf"> Teléfono </label>
                        <input class="col-12 form-control" id="telefono" value="{{ (isset($objFormulario->telefono)) ? $objFormulario->telefono : '' }}" type="number" name="telefono" >
                    </div>

                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="direccion" class="col-12 text_label-formProf"> Dirección </label>
                        <input class="col-12 form-control" id="direccion" value="{{ (isset($objFormulario->direccion)) ? $objFormulario->direccion : '' }}" type="text" name="direccion" required>
                    </div>

                    <!--menu dinamico ciudades -->
                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="idpais" class="col-12 text_label-formProf"> Seleccione país </label>
                        <select id="idpais" name="idpais" class="form-control">
                            @foreach($listaPaises as $pais)
                                <option value="{{ $pais->id_pais }}"  {{ (isset($objFormulario->id_pais) && $objFormulario->id_pais == $pais->id_pais) ? 'selected' : ''}}> {{ $pais->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="id_departamento" class="col-12 text_label-formProf"> Selecione departamento </label>
                        <select name="id_departamento" id="id_departamento" class="form-control">
                            @foreach($listaDepartamentos as $departamento)
                                <option value="{{ $departamento->id_departamento }}"  {{ (isset($objFormulario->id_departamento) && $objFormulario->id_departamento == $departamento->id_departamento) ? 'selected' : ''}}> {{ $departamento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="id_provincia" class="col-12 text_label-formProf"> Seleccione provincia </label>
                        <select name="id_provincia" id="id_provincia" class="form-control">
                            @foreach($listaProvincias as $provincia)
                                <option value="{{ $provincia->id_provincia }}"  {{ (isset($objFormulario->id_provincia) && $objFormulario->id_provincia == $provincia->id_provincia) ? 'selected' : ''}}> {{ $provincia->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="id_municipio" class="col-12 text_label-formProf"> Seleccione ciudad </label>
                        <select name="id_municipio" id="id_municipio" class="form-control">
                            @foreach($listaMunicipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}"  {{ (isset($objFormulario->id_municipio) && $objFormulario->id_municipio == $municipio->id_municipio) ? 'selected' : ''}}> {{ $municipio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Botón guardar información -->
                    <div class="col-12 content_btnEnviar-formProf">
                        <button type="submit" class="btn2_enviar-formProf" id="envia_contacto"> Guardar
                            <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 2 segunda parte del formulario *** INFORMACIÓN CONTACTO ***      ---------------------------------------------->

        <!--------------------------------------------      Inicio 3 tercera parte del formulario *** INFORMACIÓN CONSULTA ***      ------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_dato-person infoBasica_formProf">
            <h5 class="col-12 icon_infoConsult-formProf"> Información consulta </h5>
            <div id="mensaje-consulta"></div>
            <div class="consulta_guardada-formProf" id="consultas-lista">
                <?php $count_consultas = 0; ?>
                @foreach($objConsultas as $objConsultas)
                    @if(!empty($objConsultas->nombreconsulta))
                        <?php $count_consultas++; ?>
                        <div class="section_infoConsulta-formProf">
                            <div class="col-12 content_btnX-cierre-formProf">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $objConsultas->id }}"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Tipo de consulta </label>
                                <span class="col-12 text_infoGuardada-formProf"> {{$objConsultas->nombreconsulta}} </span>
                            </div>
                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Valor consulta </label>
                                <span class="col-12 text_infoGuardada-formProf"> {{$objConsultas->valorconsulta}} </span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form id="formulario_consulta" method="POST" action="javascript:void(0)"  enctype="multipart/form-data" accept-charset="UTF-8">
                @csrf
                <div class="col-12 seccion_consulta-formProf">
                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="tipo_consulta" class="col-12 text_label-formProf"> Tipo consulta </label>
                        <select id="tipo_consulta" class="form-control" name="tipo_consulta" {{ ($count_consultas >= 3 ) ? 'disabled' : '' }}>
                            <option></option>
                            <option value="Presencial"> Presencial </option>
                            <option value="Virtual"> Virtual </option>
                            <option value="Control médico"> Control Médico </option>
                        </select>
                    </div>

                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="valor_consulta" class="col-12 text_label-formProf"> Valor </label>
                        <input type="number" min="0" max="150000" class="form-control" id="valor_consulta" name="valor_consulta" {{ ($count_consultas >= 3 ) ? 'disabled' : '' }}>
                    </div>
                </div>
                <div class="col-12 content_btnEnviar-formProf">
                    <button id="envia_consultas" type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3" {{ ($count_consultas >= 3 ) ? 'disabled' : '' }}>
                        Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 3 tercera parte del formulario *** INFORMACIÓN CONSULTA ***      ---------------------------------------------->

        <!--------------------------------------------      Inicio 14 Cartoceava parte del formulario *** INFORMACIÓN BÁSICA ***      --------------------------------------------->

        <div class="col-lg-10 col-xl-8 content_dato-person infoBasica_formProf">
            <h5 class="col-12 icon_destacado-formProf"> Destacado en </h5>
            <form id="formulario_destacado" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" class="pb-2" >
            @csrf
            <!---------------valida que ya exista informacion y la muestra en caso contrario muestra un formulario vacio--------------------->
                <div class="row fila_infoBasica-formProf">
                    <div class="col-12" id="destacado-mensaje"></div>
                    <div class="col-md-8 col-sm-12" id="destacado-lista">
                        @foreach($destacables as $destacable)
                            <div class="alert alert-info alert-dismissible fade show delete-destacable" role="alert" >
                                <strong>{{ $destacable->nombreExpertoEn }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-id="{{ $destacable->id_experto_en }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Ingrese el tema" name="destacado_nombre" id="destacado_nombre" {{ ($destacables_count >= 9 ) ? 'disabled' : ''}}>
                            <button class="btn btn-primary" type="submit" id="destacado_nombre_btn" {{ ($destacables_count >= 9 ) ? 'disabled' : ''}} ><img src="{{ asset('img/iconos/icono-agregar-especialidad-favoritos-blanco.svg') }}" alt="mas"> Agregar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 14 Cartoceava parte del formulario *** INFORMACIÓN BÁSICA ***      ------------------------------------------------>

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonInferior-next-formProf">
            <div class="col-md-3 content_btn-siguient">
                <button type="submit" class="boton_inferior-siguiente-formProf btn-next-320-formProf" onclick="btnHideNext(this)" code-position="personalData"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 2* Contenedor principal de la tarjeta PERFIL PROFESIONAL -->
    <div class="container-fluid professional_profile content_principal-formProf">
        <!--------------------------------------------      Inicio 4 cuarta parte del formulario *** PERFIL PROFESIONAL ***      ---------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_perfil-prof  infoBasica_formProf">
            <h5 class="col-12 icon_infoSubPerfil-formProf"> Perfil profesional </h5>
            <div id="mensaje-perfil-profesional"></div>
            <form id="formulario_descripcion" method="post" action="javascript:void(0)" enctype="multipart/form-data" accept-charset="UTF-8">
                @csrf
                <div class="col-12 px-0">
                    <label for="descripcion_perfil" class="text_superior-proced-formProf"> Escriba una breve descripción de su biografía </label>
                    <textarea class="form-control" id="descripcion_perfil"  type="text" maxlength="270" name="descripcion_perfil">{{ (!empty($objFormulario->descripcionPerfil)) ? $objFormulario->descripcionPerfil : '' }}</textarea>
                    <label class="col-12 text_infoImg-formProf"> 270 Caracteres </label>
                </div>
                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" id="enviar_perfil" class="btn2_enviar-formProf mt-md-3 mb-md-3"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 4 cuarta parte del formulario *** PERFIL PROFESIONAL ***      ------------------------------------------------->

        <!--------------------------------------------      Inicio 5 quinta parte del formulario *** EDUCACIÓN ***      ------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_perfil-prof infoBasica_formProf">
            <h5 class="col-12 icon_infoEduc-formProf"> Educación </h5>
            <div id="mensaje-estudios"></div>
            <div class="educacion_guardada-formProf" id="estudios-lista">
                <?php $count_estudios = 0; ?>
                @foreach($objEducacion as $educacion)
                    @if(!empty($educacion->nombreuniversidad))
                        <?php $count_estudios++; ?>
                        <div class="section_infoEducacion-formProf">
                            <div class="col-12 content_btnX-cierre-formProf">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $educacion->id_universidadperfil }}"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Fecha de finalización </label>
                                <label class="col-12 text_infoGuardada-formProf"> {{$educacion->fechaestudio}} </label>
                            </div>
                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Universidad </label>
                                <label class="col-12 text_infoGuardada-formProf"> {{$educacion->nombreuniversidad}} </label>
                            </div>
                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Disciplina académica </label>
                                <label class="col-12 text_infoGuardada-formProf"> {{$educacion->nombreestudio}} </label>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form action="{{ url ('/FormularioProfesionalSave5') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_estudios">
                @csrf
                <div class="row p-0 m-0">
                    <div class="col-md-6 pt-5">
                        <div class="img_selccionada-formExperiencia">
                            <img class="img-thumbnail" id="imagen-universidad">
                        </div>
                        <div class="agregar_archivo-formProf">
                            <input type="file" id="logo_universidad" name="logo_universidad" onchange="ver_imagen('logo_universidad', 'imagen-universidad');">
                        </div>
                        <div class="txt_informativo-formProf">
                            <label class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-12">
                            <label for="universidad_estudio" class="col-12 text_label-formProf"> Selecione universidad </label>
                            <select  class="form-control" name="universidad_estudio" id="universidad_estudio" {{ ($count_estudios >= 3) ? 'disabled' : '' }}>
                                <option></option>
                                @foreach($universidades as $universidad)
                                    <option value="{{$universidad->id_universidad}}"> {{$universidad->nombreuniversidad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="fecha_estudio" class="col-12 text_label-formProf"> Fecha de finalización </label>
                            <input class="form-control" type="date" value="2011-08-19" id="fecha_estudio" name="fecha_estudio" {{ ($count_estudios >= 3) ? 'disabled' : '' }}>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="disciplina_estudio" class="col-12 text_label-formProf"> Disciplina académica </label>
                                <input class="form-control" id="disciplina_estudio" type="text" name="disciplina_estudio" {{ ($count_estudios >= 3) ? 'disabled' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4" id="boton-enviar-estudios"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="" {{ ($count_estudios >= 3) ? 'disabled' : '' }}>
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 5 quinta parte del formulario *** EDUCACIÓN ***      ---------------------------------------------------------->

        <!--------------------------------------------      Inicio 6 sexta parte del formulario *** EXPERIENCIA ***      ------------------------------------------------------>
        <div class="col-lg-10 col-xl-8 content_perfil-prof infoBasica_formProf">
            <h5 class="col-12 icon_infoExper-formProf"> Experiencia Laboral</h5>
            <div id="mensaje-experiencia"></div>
            <!--------------muestra una lista de la experinecia ingresada--------------->
            <div class="experiencia_guardada-formProf" id="experiencia-lista">
                <?php $count_experiencia = 0;?>
                @foreach($objExperiencia as $experiencia)
                    @if(!empty($experiencia->nombreEmpresaExperiencia))
                        <?php $count_experiencia++;?>
                        <div class="section_infoExper-formProf">
                            <div class="col-12 content_btnX-cierre-formProf">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $experiencia->idexperiencias }}"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Nombre de la empresa </label>
                                <label class="col-12 text_infoGuardada-formProf"> {{$experiencia->nombreEmpresaExperiencia}} </label>
                            </div>
                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Descripción de la experiencia </label>
                                <label class="col-12 text_infoGuardada-formProf"> {{$experiencia->descripcionExperiencia}} </label>
                            </div>
                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Fecha de inicio experiencia </label>
                                <label class="col-12 text_infoGuardada-formProf"> {{$experiencia->fechaInicioExperiencia}} </label>
                            </div>
                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Fecha de finalización experiencia </label>
                                <label class="col-12 text_infoGuardada-formProf"> {{$experiencia->fechaFinExperiencia}} </label>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave6') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_experiencia">
                @csrf
                <div class="row fila_infoBasica-formProf bottom_boder justify-content-center" id="listas">
                    <div class="col-md-6 pt-5">
                        <div class="img_selccionada-formExperiencia">
                            <img class="img-thumbnail" id="imagen-experiencia">
                        </div>
                        <div class="agregar_archivo-formProf">
                            <input type="file" id="logo_experiencia" name="logo_experiencia" onchange="ver_imagen('logo_experiencia', 'imagen-experiencia');">
                        </div>
                        <div class="txt_informativo-formProf">
                            <label class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-12">
                            <label for="nombre_empresa" class="col-12 text_label-formProf"> Empresa </label>
                            <input class="col-lg-12 form-control" id="nombre_empresa"  type="text" name="nombre_empresa" {{ ($count_experiencia >= 4 ) ? 'disabled' : '' }}>
                        </div>
                        <div class="col-12">
                            <label for="descripcion_experiencia" class="col-12 text_label-formProf"> Cargo </label>
                            <input class="col-lg-12 form-control" id="descripcion_experiencia"  type="text" name="descripcion_experiencia" {{ ($count_experiencia >= 4 ) ? 'disabled' : '' }}>
                        </div>
                        <div class="col-12">
                            <label for="inicio_experiencia" class="col-12 text_label-formProf"> Fecha de inicio </label>
                            <input class="form-control" type="date"  id="inicio_experiencia" name="inicio_experiencia" {{ ($count_experiencia >= 4 ) ? 'disabled' : '' }}>
                        </div>
                        <div class="col-12">
                            <label for="fin_experiencia" class="col-12 text_label-formProf"> Fecha de terminación </label>
                            <input class="form-control" type="date"  id="fin_experiencia" name="fin_experiencia" {{ ($count_experiencia >= 4 ) ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4" id="boton-guardar-experiencia" {{ ($count_experiencia >= 4 ) ? 'disabled' : '' }}> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 6 sexta parte del formulario *** EXPERIENCIA ***      --------------------------------------------------------->

        <!--------------------------------------------      Inicio 7 septima parte del formulario *** ASOCIACIONES ***      --------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_perfil-prof infoBasica_formProf">
            <h5 class="col-12 icon_infoAsocia-formProf"> Asociaciones </h5>
            <div id="mensajes-asociacion"></div>
            <div class="asociacion_guardada-formProf" id="lista-asociacion">
                <?php $count_asociaciones = 0;?>
                @foreach($objAsociaciones as $asociacion)
                    @if(!empty($asociacion->imgasociacion))
                        <?php $count_asociaciones++;?>
                        <div class="section_infoAsocia-formProf">
                            <div class="col-12 content_btnX-cierre-formProf">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $asociacion->idAsociaciones }}"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="option_asociacion-formProf">
                                <img class="img_guardada-formProf" id="imagenPrevisualizacion" src="{{URL::asset($asociacion->imgasociacion)}}">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave7') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_asociacion">
                @csrf
                <div class="row col-12 row_asocia-prof justify-content-center">
                    <!-- campo 1 -->
                    <div class="col-md-4 content_agregarImg-formProf form-group">
                        <div class="img_selccionada-formProf">
                            <img class="img_anexada-formProf" id="img-asociacion"/>
                        </div>
                        <div class="agregar_archivo-formProf">
                            <input type='file' id="imagenAsociacion" name="imagenAsociacion" onchange="ver_imagen('imagenAsociacion', 'img-asociacion');" {{ ($count_asociaciones >= 3 ) ? 'disabled' : '' }}/>
                        </div>
                        <div class="txt_informativo-formProf">
                            <label class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-2 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4" id="boton-guardar-asociacion" {{ ($count_asociaciones >= 3 ) ? 'disabled' : '' }}> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 7 septima parte del formulario *** ASOCIACIONES ***      ------------------------------------------------------>

        <!--------------------------------------------      Inicio 8 octava parte del formulario *** IDIOMAS ***      --------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_perfil-prof infoBasica_formProf">
            <h5 class="col-12 icon_infoIdioma-formProf"> Idiomas </h5>
            <div id="mensaje-idioma"></div>
            <div class="idioma_guardada-formProf" id="lista-idioma">
                <?php $count_idiomas = 0; ?>

                @foreach($objIdiomas as $idioma)
                    @if(!empty($idioma->imgidioma))
                        <?php $count_idiomas++; ?>
                        <div class="section_infoAsocia-formProf">
                            <div class="col-12 content_btnX-cierre-formProf">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $idioma->idUsuarioIdiomas }}"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="">
                                <img id="imagenPrevisualizacion" class="img_bandera-forProf" src="{{URL::asset($idioma->imgidioma)}}">
                                <label for="example-date-input" class="text_idioma-formProf"> {{$idioma->nombreidioma}}</label>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave8') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_idioma">
                @csrf
                <div class="row p-0 m-0">
                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="idioma" class="mr-2 text_label-formProf"> Seleccione idioma </label>
                        <select  class="form-control" name="idioma" id="idioma" {{ ($count_idiomas >= 3) ? 'disabled' : '' }}>
                            <option value=" "> Seleccione </option>
                            @foreach($idiomas as $idioma)
                                <option value="{{$idioma->id_idioma}}"> {{$idioma->nombreidioma}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3" id="boton-guardar-idioma"  {{ ($count_idiomas >= 3) ? 'disabled' : '' }}> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 8 octava parte del formulario *** IDIOMAS ***      ------------------------------------------------------------>

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formProf">
            <div class="col-md-3 content_btn-anter">
                <button type="submit" class="boton_inferior-anterior-formProf" onclick="btnHidePrevious(this)" code-position="professionalProfile">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient">
                <button type="submit" class="boton_inferior-siguiente-formProf" onclick="btnHideNext(this)" code-position="professionalProfile"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 3* Contenedor principal de la tarjeta TRATAMIENTOS Y PROCEDIMIENTOS -->
    <div class="container-fluid treatments_procedures content_principal-formProf">
        <!--------------------------------------------      Inicio 9 novena parte del formulario *** TRATAMIENTOS y PROCEDIMIENTOS ***      ----------------------------------->
        <div class="col-lg-10 col-xl-8 content_tratam-proced infoBasica_formProf">
            <h5 class="col-12 icon_infoTratam-formProf"> Tratamientos y procedimientos </h5>
            <div id="mensajes-tratamientos"></div>
            <p class="text_superior-proced-formProf"> A continuación suba imágenes con respecto a los procedimientos y tratamientos, con su título y descripción. </p>
            <div id="lista-tratamientos">
                <?php $count_tratamientos = 0; ?>
                @foreach($objTratamiento as $objTratamiento)
                    @if(!empty($objTratamiento->imgTratamientoAntes))
                        <?php $count_tratamientos++; ?>
                        <div class="traProce_guardada-formProf">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <button type="submit" class="close" aria-label="Close" data-id="{{$objTratamiento->id_tratamiento}}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <!-- Contenido ANTES -->
                            <div class="col-12 col-md-6">
                                <label class="col-12 title_trata-formProf"> Antes </label>

                                <div class="col-12 img_selccionada-formProf">
                                    <img class="img_traProced-formProf" src="{{URL::asset($objTratamiento->imgTratamientoAntes)}}">
                                </div>

                                <div class="col-12 mt-2 text_label-formProf">
                                    <label class="col-12 title_infoGuardada-formProf"> {{$objTratamiento->tituloTrataminetoAntes}} </label>
                                </div>

                                <div class="col-12 descripcion_Premio-formProf">
                                    <label class="col-12 text_infoGuardada-formProf"> {{$objTratamiento->descripcionTratamientoAntes}} </label>
                                </div>
                            </div>

                            <!-- Contenido DESPUÉS -->
                            <div class="col-12 col-md-6 after_formProf">
                                <label class="col-12 title_trata-formProf"> Después </label>

                                <div class="col-12 img_selccionada-formProf">
                                    <img class="img_traProced-formProf" src="{{URL::asset($objTratamiento->imgTratamientodespues)}}">
                                </div>

                                <div class="col-12 mt-2 text_label-formProf">
                                    <label class="col-12 title_infoGuardada-formProf"> {{$objTratamiento->tituloTrataminetoDespues}} </label>
                                </div>

                                <div class="col-12 descripcion_Premio-formProf">
                                    <label class="col-12 text_infoGuardada-formProf"> {{$objTratamiento->descripcionTratamientoDespues}} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave9') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_tratamiento">
                @csrf
                <div class="row content_antDesp-formProf">
                    <!-- Contenido ANTES -->
                    <div class="col-md-6 antes content_antes-formProf section_inputLeft-text-formProf">
                        <div class="col-12 content_agregarImg-formProf form-group">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Antes </label>

                            <div class="img_selccionada-formProf">
                                <img class="img_traProced-formProf" id="imagen-tratamiento-antes"/>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imgTratamientoAntes" name="imgTratamientoAntes" onchange="ver_imagen('imgTratamientoAntes', 'imagen-tratamiento-antes');" {{ ($count_tratamientos >= 2) ? 'disabled' : '' }}/>
                            </div>

                            <div class="txt_informativo-formProf">
                                <label class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label>
                            </div>
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <label for="tituloTrataminetoAntes" class="col-12 text_label-formProf"> Título de la imagen antes </label>
                            <input class="form-control" id="tituloTrataminetoAntes" placeholder="Título de la imagen" type="text" name="tituloTrataminetoAntes" {{ ($count_tratamientos >= 2) ? 'disabled' : '' }}>
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <div class="form-group">
                                <label for="descripcionTratamientoAntes" class="col-12 text_label-formProf"> Descripción antes </label>
                                <input class="form-control" id="descripcionTratamientoAntes" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionTratamientoAntes" {{ ($count_tratamientos >= 2) ? 'disabled' : '' }}>
                                <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                            </div>
                        </div>
                    </div>

                    <!-- Contenido DESPUÉS -->
                    <div class="col-md-6 despues content_despues-formProf section_inputRight-text-formProf">
                        <div class="col-12 content_agregarImg-formProf form-group">
                            <label for="imgTratamientodespues" class="col-12 text_label-formProf"> Después </label>
                            <div class="img_selccionada-formProf">
                                <img class="img_traProced-formProf" id="imagen-tratamiento-despues"/>
                            </div>
                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imgTratamientodespues" name="imgTratamientodespues" onchange="ver_imagen('imgTratamientodespues', 'imagen-tratamiento-despues');" {{ ($count_tratamientos >= 2) ? 'disabled' : '' }}/>
                            </div>
                            <div class="txt_informativo-formProf">
                                <label class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label>
                            </div>
                        </div>
                        <div class="col-12 section_inputRight-text-formProf">
                            <label for="tituloTrataminetoDespues" class="col-12 text_label-formProf"> Título de la imagen después </label>
                            <input class="form-control" id="tituloTrataminetoDespues" placeholder="Título de la imagen" type="text" name="tituloTrataminetoDespues" {{ ($count_tratamientos >= 2) ? 'disabled' : '' }}>
                        </div>
                        <div class="col-12 section_inputRight-text-formProf">
                            <div class="form-group">
                                <label for="descripcionTratamientoDespues" class="col-12 text_label-formProf"> Descripción después </label>
                                <input class="form-control" id="descripcionTratamientoDespues" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionTratamientoDespues" {{ ($count_tratamientos >= 2) ? 'disabled' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                    </button>
                </div>
            </form>
        </div>

        <!--------------------------------------------      Fin 9 novena parte del formulario *** TRATAMIENTOS y PROCEDIMIENTOS ***      -------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formProf">
            <div class="col-md-3 content_btn-anter">
                <button type="submit" class="boton_inferior-anterior-formProf" onclick="btnHidePrevious(this)" code-position="treatmentsProcedures">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient">
                <button type="submit" class="boton_inferior-siguiente-formProf" onclick="btnHideNext(this)" code-position="treatmentsProcedures"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 4* Contenedor principal de la tarjeta PREMIOS Y RECONOCIMIENTOS -->
    <div class="container-fluid Awards_honours content_principal-formProf">
        <!--------------------------------------------      Inicio 10 decima parte del formulario *** PREMIOS y RECONOCIMIENTOS ***      -------------------------------------->
        <div class="col-lg-10 col-xl-8 content_premio-recono infoBasica_formProf">
            <h5 class="col-12 icon_infoPremReco-formProf"> Premios y reconocimientos </h5>

            <p class="text_superior-proced-formProf"> A continuación suba imágenes relacionadas con sus premios y reconocimientos, con nombre y descripción. </p>
            <div id="mensajes-premios"></div>
            <!-- Modulo de los PREMIOS con información -->
            <div class="premios_guardada-formProf" id="lista-premios">
            <?php $counto_premios = 0; ?>
            @foreach($objPremios as $premios)
                @if(!empty($premios->nombrepremio))
                    <?php $counto_premios++; ?>
                    <!-- Contenido PREMIO -->
                        <div class="section_infoExper-formProf">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $premios->id }}"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="col-12 mt-2 p-0">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" src="{{URL::asset($premios->imgpremio)}}">
                                </div>
                                <div class="col-12 p-0 mt-2">
                                    <label class="col-12 text_fechaPremio-formProf"> {{$premios->fechapremio}} </label>
                                </div>
                                <div class="col-12 text_label-formProf">
                                    <label class="col-12 title_infoGuardada-formProf"> {{$premios->nombrepremio}}  </label>
                                </div>
                                <div class="col-12 descripcion_Premio-formProf">
                                    <label class="col-12 text_descPremio-formProf"> {{$premios->descripcionpremio}} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave10') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_premio">
                @csrf

                <div class="row content_antDesp-formProf justify-content-center">
                    <!-- Contenido PREMIO izquierdo -->
                    <div class="col-md-6">
                        <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                            <div class="img_selccionada-formProf">
                                <img class="img_anexada-formProf" id="img-premio"/>
                            </div>
                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imgPremio" name="imgPremio" onchange="ver_imagen('imgPremio', 'img-premio');" {{ ($counto_premios >= 4) ? 'disabled' : '' }}/>
                            </div>
                            <div class="txt_informativo-formProf">
                                <label class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                            </div>
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <label for="fechaPremio" class="col-12 text_label-formProf"> Fecha de inicio </label>
                            <input class="form-control" type="date"  id="fechaPremio" name="fechaPremio" {{ ($counto_premios >= 4) ? 'disabled' : '' }}>
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <label for="nombrePremio" class="col-12 text_label-formProf"> Título de la imagen 1 </label>
                            <input class="form-control" id="nombrePremio" placeholder="Título de la imagen" type="text" name="nombrePremio" {{ ($counto_premios >= 4) ? 'disabled' : '' }}>
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <div class="form-group">
                                <label for="descripcionPremio" class="col-12 text_label-formProf"> Descripción del premio </label>
                                <input class="form-control" id="descripcionPremio" placeholder="Escribir descripción..." type="text"  maxlength="160" name="descripcionPremio" {{ ($counto_premios >= 4) ? 'disabled' : '' }}>
                                <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3" id="boton-guardar-premio"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 10 decima parte del formulario *** PREMIOS y RECONOCIMIENTOS ***      ----------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formProf">
            <div class="col-md-3 content_btn-anter">
                <button type="submit" class="boton_inferior-anterior-formProf" onclick="btnHidePrevious(this)" code-position="AwardsHonours">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient">
                <button type="submit" class="boton_inferior-siguiente-formProf" onclick="btnHideNext(this)" code-position="AwardsHonours"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 5* Contenedor principal de la tarjeta PUBLICACIONES -->
    <div class="container-fluid publications_formInst content_principal-formProf">
        <!--------------------------------------------      Inicio 11 onceava parte del formulario *** PUBLICACIONES ***      ------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_publicacion infoBasica_formProf">
            <h5 class="col-12 icon_infoPublic-formProf"> Publicaciones </h5>

            <p class="text_superior-proced-formProf"> A continuación suba imágenes de las publicaciones que ha realizado a lo largo de su experiencia. </p>
            <div id="mensajes-publicacion"></div>
            <!-- Modulo de las PUBLICAIONES con información -->
            <div class="premios_guardada-formProf" id="lista-publicacion">
            <?php $count_publicaciones = 0;?>
            @foreach($Publicaciones as $publicacion)
                @if(!empty($publicacion->nombrepublicacion))
                    <?php $count_publicaciones++;?>
                    <!-- Contenido PUBLICACIÓN -->
                        <div class="section_infoExper-formProf">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $publicacion->id }}"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="col-12 my-2">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" src="{{URL::asset($publicacion->imgpublicacion)}}">
                                </div>
                                <div class="col-12 mt-2 text_label-formProf">
                                    <label class="col-12 title_infoGuardada-formProf"> {{$publicacion->nombrepublicacion}} </label>
                                </div>
                                <div class="col-12 descripcion_Premio-formProf">
                                    <label class="col-12 text_descPremio-formProf"> {{$publicacion->descripcion}} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave11') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_publicaciones">
                @csrf
                <div class="row content_antDesp-formProf justify-content-center">
                    <!-- Contenido publicación left -->
                    <div class="col-md-6 photo1 section_inputLeft-text-formProf content_antes-formProf">
                        <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                            <div class="img_selccionada-formProf">
                                <img class="img_anexada-formProf" id="img-publicacion"/>
                            </div>
                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imagePublicacion" name="imagePublicacion" onchange="ver_imagen('imagePublicacion', 'img-publicacion');" {{ ($count_publicaciones >= 4) ? 'disabled' : '' }}/>
                            </div>
                            <div class="txt_informativo-formProf">
                                <label class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                            </div>
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <label for="nombrePublicacion" class="col-12 text_label-formProf"> Título de la publicación </label>
                            <input class="form-control" id="nombrePublicacion" placeholder="Título de la publicación" type="text" name="nombrePublicacion" {{ ($count_publicaciones >= 4) ? 'disabled' : '' }}>
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <div class="form-group">
                                <label for="descripcionPublicacion" class="col-12 text_label-formProf"> Descripción </label>
                                <input class="form-control" id="descripcionPublicacion" maxlength="160" placeholder="Escribir descripción..." type="text" name="descripcionPublicacion" {{ ($count_publicaciones >= 4) ? 'disabled' : '' }}>
                                <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3" id="boton-guardar-publicacion" {{ ($count_publicaciones >= 4) ? 'disabled' : '' }}> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 11 onceava parte del formulario *** PUBLICACIONES ***      ---------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formProf">
            <div class="col-md-3 content_btn-anter">
                <button type="submit" class="boton_inferior-anterior-formProf" onclick="btnHidePrevious(this)" code-position="publicationsFormProf">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient">
                <button type="submit" class="boton_inferior-siguiente-formProf" onclick="btnHideNext(this)" code-position="publicationsFormInst"> Siguiente
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 6* Contenedor principal de la tarjeta GALERIA -->
    <div class="container-fluid gallery_formInst content_principal-formProf">
        <!--------------------------------------------      Inicio 12 doceava parte del formulario *** GALERIA ***      ------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_galeria-video infoBasica_formProf">
            <h5 class="col-12 icon_infoGale-formProf"> Galeria </h5>

            <p class="text_superior-proced-formProf"> A continuación suba 10 imágenes como mínimo, con su respectivo nombre y descripción. </p>

            <div id="mensajes-fotos"></div>
            <!-- Modulo de la GALERIA con información -->
            <div class="premios_guardada-formProf" id="lista-fotos">
            <?php $count_foto = 0;?>
            @foreach($objGaleria as $foto)
                @if(!empty($foto->nombrefoto))
                    <!-- Contenido GALERIA -->
                        <?php $count_foto++;?>
                        <div class="section_infoExper-formProf">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $foto->id_galeria }}"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="col-12 my-2 p-0">
                                <div class="img_selccionada-formProf">
                                    <img  class="img_anexada-formProf" src="{{URL::asset($foto->imggaleria)}}">
                                </div>
                                <div class="col-12 mt-2 text_label-formProf">
                                    <label class="col-12 title_infoGuardada-formProf"> {{$foto->nombrefoto}} </label>
                                </div>
                                <div class="col-12 descripcion_Premio-formProf">
                                    <label class="col-12 text_descPremio-formProf"> {{$foto->descripcion}} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave12') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_fotos">
            @csrf
            <!-- Modulos del contenido GALERIA -->
                <div class="row content_antDesp-formProf justify-content-center">
                    <div class="col-md-6 photo1 section_inputLeft-text-formProf">
                        <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                            <div class="img_selccionada-formProf">
                                <img class="img_anexada-formProf" id="img-foto"/>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="imgFoto" name="imgFoto" onchange="ver_imagen('imgFoto', 'img-foto');" {{ ($count_foto >= 8) ? 'disabled' : '' }}/>
                            </div>

                            <div class="txt_informativo-formProf">
                                <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <label for="fechaFoto" class="col-12 text_label-formProf"> Fecha </label>
                            <input class="form-control" type="date" id="fechaFoto" name="fechaFoto" {{ ($count_foto >= 8) ? 'disabled' : '' }}>
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <label for="nombreFoto" class="col-12 text_label-formProf"> Título de la imagen </label>
                            <input class="form-control" id="nombreFoto" placeholder="Título de la imagen" type="text" name="nombreFoto" {{ ($count_foto >= 8) ? 'disabled' : '' }}>
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <div class="form-group">
                                <label for="descripcionFoto" class="col-12 text_label-formProf"> Descripción </label>
                                <input class="form-control" id="descripcionFoto" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionFoto" {{ ($count_foto >= 8) ? 'disabled' : '' }}>
                                <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3" id="boton-guardar-foto" {{ ($count_foto >= 8) ? 'disabled' : '' }}> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 12 doceava parte del formulario *** GALERIA ***      ---------------------------------------------------------->

        <!--------------------------------------------      Inicio 13 treceava parte del formulario *** VIDEOS ***      ------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_galeria-video infoBasica_formProf">
            <h5 class="col-12 icon_infoVideo-formProf"> Videos </h5>

            <p class="text_superior-proced-formProf"> A continuación suba el link del video, con su respectivo nombre y descripción. </p>
            <div id="mensajes-videos"></div>
            <!-- Modulos de los VIDEOS -->
            <div class="premios_guardada-formProf" id="lista-videos">
            <?php $count_videos = 0;?>
            @foreach($objVideo as $video)
                @if(!empty($video->nombrevideo))
                    <?php $count_videos++;?>
                    <!-- Contenido VIDEOS -->
                        <div class="section_infoExper-formProf">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $video->id }}"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="col-12 my-2">
                                <div class="img_selccionada-formProf">
                                    <iframe class="img_anexada-formProf" src="{{$video->urlvideo}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="col-12 p-0 mt-2">
                                    <label class="col-12 text_fechaPremio-formProf"> {{$video->fechavideo}} </label>
                                </div>
                                <div class="col-12 text_label-formProf">
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

            <form method="POST" action="{{ url ('/FormularioProfesionalSave13') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario-videos">
            @csrf
            <!-- Modulos de los VIDEOS -->
                <div class="row content_antDesp-formProf justify-content-center">
                    <!-- Contenido IZQUIERDO -->
                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <div class="col-12 section_inputLeft-text-formProf">
                            <label for="urlVideo" class="col-12 text_label-formProf"> Url video 1 </label>
                            <input class="form-control" id="urlVideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlVideo" {{ ($count_videos >= 4) ? 'disabled' : '' }}>
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <label for="fechaVideo" class="col-12 text_label-formProf"> Fecha </label>
                            <input class="form-control" type="date"  id="fechaVideo" name="fechaVideo" >
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <label for="nombreVideo" class="col-12 text_label-formProf"> Título video </label>
                            <input class="form-control" id="nombreVideo" placeholder="Título video" type="text" name="nombreVideo" {{ ($count_videos >= 4) ? 'disabled' : '' }}>
                        </div>

                        <div class="col-12 section_inputLeft-text-formProf">
                            <div class="form-group">
                                <label for="descripcionVideo" class="col-12 text_label-formProf"> Descripción video </label>
                                <input class="form-control" id="descripcionVideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionVideo" {{ ($count_videos >= 4) ? 'disabled' : '' }}>
                                <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3" id=""> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="boton-guardar-video" {{ ($count_videos >= 4) ? 'disabled' : '' }}>
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 13 treceava parte del formulario *** VIDEOS ***      ---------------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formProf">
            <div class="col-md-3 content_btn-anter">
                <button type="submit" class="boton_inferior-anterior-formProf" onclick="btnHidePrevious(this)" code-position="galleryFormProf">
                    <img src="{{URL::asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient">
                <a type="submit" class="boton_inferior-finalizar-formProf" href="{{ route('contacto') }}"> Finalizar
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_finalizar-formProf" alt="">
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script data-pace-options='{ "ajax": false, "document": true, "eventLag": false, "elements": false}' src="{{ asset('plugins/pace/pace.min.js') }}"></script>

    <script src="{{ asset('js/formularioProfesional.js') }}"></script>
    <script src="{{ asset('js/selectareas.js') }}"></script>
    <script src="{{ asset('js/selectpais.js') }}"></script>

    <script>
        Pace.on("done", function() {
            $('#page_overlay').delay(300).fadeOut(600);
        });
    </script>
@endsection
