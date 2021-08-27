@extends('layouts.app')

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
            <div class="alert alert-success d-none" id="msg_basico">
                <span id="res_message_basico">Su información se guardó correctamente</span>
            </div>
            <form id="formulario_basico" method="POST" action="javascript:void(0)" enctype="multipart/form-data" accept-charset="UTF-8" class="pb-2">
            @csrf
            <!---------------valida que ya exista informacion y la muestra en caso contrario muestra un formulario vacio--------------------->


                @if(!empty($objFormulario->idarea))
                    <div class="row fila_infoBasica-formProf">
                        <!-- Sección imagen de usuario -->
                        <div class="col-md-3 contain_imgUsuario-formProf">
                            <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{URL::asset($objFormulario->fotoperfil)}}">
                            <input type="file" class="input_imgUsuario-formProf" name="logo"  id="seleccionArchivos" accept="image/png, image/jpeg" value="{{$objFormulario->fotoperfil}}">
                            <p class="icon_subirFoto-formProf text_usuario-formProf"> Subir foto de perfil </p>
                        </div>

                        <!-- Sección datos personales -->
                        <div class="row col-md-9 datos_principales-formProf">
                            @foreach ($objuser as $user)
                                <div class="col-lg-6 section_inputRight-text-formProf">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Nombres </label>
                                    <div class="col-12 nombres_usuario-formProf">
                                        <input class="input_nomApl-formProf" value="{{$user->primernombre}}" name="primernombre"></input>

                                        <input class="input_nomApl-formProf" value="{{$user->segundonombre}}" name="segundonombre"></input>
                                    </div>
                                </div>
                                <div class="col-lg-6 section_inputRight-text-formProf">
                                    <label for="example-date-input"class="col-12 text_label-formProf"> Apellidos </label>
                                    <div class="col-12 nombres_usuario-formProf">
                                        <input class="input_nomApl-formProf" value="{{$user->primerapellido}}" name="primerapellido"></input>

                                        <input class="input_nomApl-formProf" value="{{$user->segundoapellido}}" name="segundoapellido"></input>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de nacimiento </label>
                                <input class="col-lg-12 form-control" type="date" value="{{$objFormulario->fechanacimiento}}" id="fechanacimiento" name="fechanacimiento">
                            </div>
                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Selecione área </label>
                                <select id="idarea" name="idarea" class="col-lg-12 form-control">
                                    @foreach($area as $area)
                                        <option value="{{$area->idArea}}" {{ ($area->idArea == $objFormulario->idarea) ? 'selected' : '' }}> {{$area->nombreArea}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Selecione profesión </label>
                                <select name="idprofesion" id="idprofesion" class="col-lg-12 form-control">

                                    @foreach($profesiones as $profesion)
                                        <option value="{{$profesion->idProfesion}}" {{ ($profesion->idProfesion == $objFormulario->idprofesion) ? 'selected' : '' }}> {{$profesion->nombreProfesion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione especialidad </label>
                                <select name="idespecialidad" id="idespecialidad" class="col-lg-12 form-control">
                                    @foreach($especialidades as $especialidad)
                                        <option value="{{$especialidad->idEspecialidad}}" {{ ($especialidad->idEspecialidad == $objFormulario->idEspecialidad) ? 'selected' : '' }}> {{$especialidad->nombreEspecialidad}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Selecione universidad </label>
                                <select  class="col-lg-12 form-control" name="id_universidad">
                                    <option value="{{$objFormulario->id_universidad}}">{{$objFormulario->nombreuniversidad}}</option>
                                    @foreach($universidades as $universidadesLista)
                                        <option value="{{$universidadesLista->id_universidad}}"> {{$universidadesLista->nombreuniversidad}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Tarjeta profesional </label>

                                    <input class="col-lg-12 form-control" id="tarjeta" placeholder="Número de tarjeta" type="number" name="numeroTarjeta" value="{{$objFormulario->numeroTarjeta}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!------------------ Fin campos llenos --------------------->
                @else
                <!--------------- Inicio campos vacios--------------------->
                    <div class="row fila_infoBasica-formProf">
                        <!-- Sección imagen de usuario -->
                        <div class="col-md-3 contain_imgUsuario-formProf">
                            <img class="img_usuario-formProf" id="imagenPrevisualizacion">
                            <input class="input_imgUsuario-formProf" type="file" name="logo"  id="seleccionArchivos" accept="image/png, image/jpeg" required>
                            <p class="icon_subirFoto-formProf text_usuario-formProf"> Subir foto de perfil </p>
                        </div>

                        <!-- Sección datos personales -->
                        <div class="row col-md-9 datos_principales-formProf">
                            @foreach ($objuser as $objuser)
                                <div class="col-lg-6 section_inputRight-text-formProf">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Nombres </label>
                                    <div class="col-12 nombres_usuario-formProf">
                                        <input class="input_nomApl-formProf" value="{{$objuser->primernombre}}" readonly></input>
                                        <input class="input_nomApl-formProf" value="{{$objuser->segundonombre}}" readonly></input>
                                    </div>
                                </div>
                                <div class="col-lg-6 section_inputRight-text-formProf">
                                    <label for="example-date-input" class="col-lg-12 text_label-formProf"> Apellidos </label>
                                    <div class="col-12 nombres_usuario-formProf">
                                        <input class="input_nomApl-formProf" value="{{$objuser->primerapellido}}" readonly></input>

                                        <input class="input_nomApl-formProf" value="{{$objuser->segundoapellido}}" readonly></input>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf">  Fecha de nacimiento </label>
                                <input class="col-lg-12 form-control" type="date" value="2011-08-19" id="fechanacimiento" name="fechanacimiento" required>
                            </div>
                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Selecione área </label>

                                <select id="idarea" name="idarea" class="col-lg-12 form-control" required>
                                    <option value="" selected disabled> Seleccione area</option>
                                    @foreach($area as $area)
                                        <option value="{{$area->idArea}}"> {{$area->nombreArea}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Selecione profesión </label>
                                <select name="idprofesion" id="idprofesion" class="col-lg-12 form-control" required></select>
                            </div>

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione especialidad </label>
                                <select name="idespecialidad" id="idespecialidad" class="col-lg-12 form-control" required></select>
                            </div>

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Selecione universidad </label>
                                    <select  class="col-lg-12 form-control" name="id_universidad" id="id_universidad" required>
                                        <option value="">Seleccione Universidad</option>
                                        @foreach($universidades as  $universidadesLista)
                                            <option value="{{$universidadesLista->id_universidad}}"> {{$universidadesLista->nombreuniversidad}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Tarjeta profesional </label>
                                    <input class="col-lg-12 form-control" id="numeroTarjeta" placeholder="Número de tarjeta" type="number" name="numeroTarjeta" required>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif

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
                <div class="alert alert-success d-none" id="msg_contacto">
                    <span id="res_message_contacto">Su información se guardó correctamente</span>
                </div>
                <div class="row fila_infoBasica-formProf">

                    @if(!empty($objFormulario))
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Celular </label>
                            <input class="col-12 form-control" id="celular" placeholder="{{$objFormulario->celular}}" value="{{$objFormulario->celular}}" type="number" name="celular" required >
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Teléfono </label>
                            <input class="col-12 form-control" id="telefono" placeholder="{{$objFormulario->telefono}}" value="{{$objFormulario->telefono}}" type="number" name="telefono" >
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Dirección </label>
                            <input class="col-12 form-control" id="direccion" placeholder="{{$objFormulario->direccion}}" value="{{$objFormulario->direccion}}" type="text" name="direccion" required>
                        </div>

                        <!--menu dinamico ciudades -->
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione país </label>
                            <select id="idpais" name="idpais" class="form-control">
                                <option value="{{$objFormulario->id_pais}}" selected disabled>{{$objFormulario->nombrePais}}</option>
                                @foreach($pais as $pais)
                                    <option value="{{$pais->id_pais}}"> {{$pais->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Selecione departamento </label>
                            <select name="id_departamento" id="id_departamento" class="form-control">
                                <option value="{{$objFormulario->id_departamento}}" selected disabled>{{$objFormulario->nombreDepartamento}}</option>
                            </select>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione provincia </label>
                            <select name="id_provincia" id="id_provincia" class="form-control">
                                <option value="{{$objFormulario->id_provincia}}" selected disabled>{{$objFormulario->nombreProvincia}}</option>
                            </select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione ciudad </label>
                            <select name="id_municipio" id="id_municipio" class="form-control">
                                <option value="{{$objFormulario->id_municipio}}" selected disabled>{{$objFormulario->nombreMunicipio}}</option>
                            </select>
                        </div>
                    @else
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Celular </label>

                            <input class="col-12 form-control" id="tarjeta" placeholder="Número de celular" type="number" name="celular" required >
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Teléfono </label>

                            <input class="col-12 form-control" id="telefono" placeholder="Número de teléfono" type="number" name="telefono" >
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Dirección </label>

                            <input class="col-12 form-control" id="direccion" placeholder="Direccion" type="text" name="direccion" required>
                        </div>

                        <!--menu dinamico ciudades -->
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione país </label>
                            <select id="idpais" name="idpais" class="form-control" required>
                                <option value="" selected disabled> Seleccione país </option>
                                @foreach($pais as $pais)
                                    <option value="{{$pais->id_pais}}"> {{$pais->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Selecione departamento </label>
                            <select name="id_departamento" id="id_departamento" class="form-control" required></select>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione provincia </label>
                            <select name="id_provincia" id="id_provincia" class="form-control" required></select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Seleccione ciudad </label>
                            <select name="id_municipio" id="id_municipio" class="form-control" required></select>
                        </div>
                @endif
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
                @foreach($objEducacion as $objEducacion)
                    @if(!empty($objEducacion->nombreuniversidad))
                        <?php $count_estudios++; ?>
                        <div class="section_infoEducacion-formProf">
                            <div class="col-12 content_btnX-cierre-formProf">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $objEducacion->id_universidadperfil }}"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Fecha de finalización </label>
                                <label class="col-12 text_infoGuardada-formProf"> {{$objEducacion->fechaestudio}} </label>
                            </div>
                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Universidad </label>
                                <label class="col-12 text_infoGuardada-formProf"> {{$objEducacion->nombreuniversidad}} </label>
                            </div>
                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Disciplina académica </label>
                                <label class="col-12 text_infoGuardada-formProf"> {{$objEducacion->nombreestudio}} </label>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form action="{{ url ('/FormularioProfesionalSave5') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_estudios">
                @csrf
                <div class="row p-0 m-0">
                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="universidad_estudio" class="col-12 text_label-formProf"> Selecione universidad </label>
                        <select  class="form-control" name="universidad_estudio" id="universidad_estudio" {{ ($count_estudios >= 3) ? 'disabled' : '' }}>
                            <option></option>
                            @foreach($universidades as $universidad)
                                <option value="{{$universidad->id_universidad}}"> {{$universidad->nombreuniversidad}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="fecha_estudio" class="col-12 text_label-formProf"> Fecha de finalización </label>
                        <input class="form-control" type="date" value="2011-08-19" id="fecha_estudio" name="fecha_estudio" {{ ($count_estudios >= 3) ? 'disabled' : '' }}>
                    </div>

                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <div class="form-group">
                            <label for="disciplina_estudio" class="col-12 text_label-formProf"> Disciplina académica </label>
                            <input class="form-control" id="disciplina_estudio" type="text" name="disciplina_estudio" {{ ($count_estudios >= 3) ? 'disabled' : '' }}>
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

            <!--------------muestra una lista de la experinecia ingresada--------------->
            <div class="experiencia_guardada-formProf">
                @foreach($objExperiencia as $objExperiencia)
                    @if(!empty($objExperiencia->nombreEmpresaExperiencia))
                        <div class="section_infoExper-formProf">
                            <div class="col-12 content_btnX-cierre-formProf">
                                <a href="{{url('/FormularioProfesionaldelete6/'.$objExperiencia->idexperiencias)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Nombre de la empresa </label>

                                <li class="col-12 text_infoGuardada-formProf"> {{$objExperiencia->nombreEmpresaExperiencia}} </li>
                            </div>

                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Descripción de la experiencia </label>

                                <li class="col-12 text_infoGuardada-formProf"> {{$objExperiencia->descripcionExperiencia}} </li>
                            </div>

                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Fecha de inicio experiencia </label>

                                <li class="col-12 text_infoGuardada-formProf"> {{$objExperiencia->fechaInicioExperiencia}} </li>
                            </div>

                            <div class="option_consulta-formProf">
                                <label class="col-12 title_infoGuardada-formProf"> Fecha de finalización experiencia </label>

                                <li class="col-12 text_infoGuardada-formProf"> {{$objExperiencia->fechaFinExperiencia}} </li>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave6') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_experiencia">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if($objContadorExperiencia->cantidad == 0)
                    <div class="row fila_infoBasica-formProf bottom_boder" id="listas">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Empresa </label>

                            <input class="col-lg-12 form-control" id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Cargo </label>

                            <input class="col-lg-12 form-control" id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                            <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de terminación </label>

                            <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                        </div>
                    </div>
                    <div class="row fila_infoBasica-formProf bottom_boder" id="listas">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Empresa </label>

                            <input class="col-lg-12 form-control" id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Cargo </label>

                            <input class="col-lg-12 form-control" id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                            <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de terminación </label>

                            <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                        </div>
                    </div>
                    <div class="row fila_infoBasica-formProf bottom_boder" id="listas">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Empresa </label>

                            <input class="col-lg-12 form-control" id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Cargo </label>

                            <input class="col-lg-12 form-control" id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                            <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de terminación </label>

                            <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                        </div>
                    </div>
                    <div class="row fila_infoBasica-formProf" id="listas">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Empresa </label>

                            <input class="col-lg-12 form-control" id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Cargo </label>

                            <input class="col-lg-12 form-control" id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                            <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de terminación </label>

                            <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                        </div>
                    </div>
                @elseif($objContadorExperiencia->cantidad == 1)
                    <div class="row fila_infoBasica-formProf bottom_boder" id="listas">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Empresa </label>

                            <input class="col-lg-12 form-control" id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Cargo </label>

                            <input class="col-lg-12 form-control" id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                            <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de terminación </label>

                            <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                        </div>
                    </div>
                    <div class="row fila_infoBasica-formProf bottom_boder" id="listas">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Empresa </label>

                            <input class="col-lg-12 form-control" id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Cargo </label>

                            <input class="col-lg-12 form-control" id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                            <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de terminación </label>

                            <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                        </div>
                    </div>
                    <div class="row fila_infoBasica-formProf" id="listas">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Empresa </label>

                            <input class="col-lg-12 form-control" id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Cargo </label>

                            <input class="col-lg-12 form-control" id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                            <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de terminación </label>

                            <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                        </div>
                    </div>
                @elseif($objContadorExperiencia->cantidad == 2)
                    <div class="row fila_infoBasica-formProf bottom_boder" id="listas">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Empresa </label>

                            <input class="col-lg-12 form-control" id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Cargo </label>

                            <input class="col-lg-12 form-control" id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                            <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de terminación </label>

                            <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                        </div>
                    </div>
                    <div class="row fila_infoBasica-formProf" id="listas">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Empresa </label>

                            <input class="col-lg-12 form-control" id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Cargo </label>

                            <input class="col-lg-12 form-control" id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                            <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de terminación </label>

                            <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                        </div>
                    </div>
                @elseif($objContadorExperiencia->cantidad == 3)
                    <div class="row fila_infoBasica-formProf" id="listas">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Empresa </label>

                            <input class="col-lg-12 form-control" id="nombreEmpresaExperiencia"  type="text" name="nombreEmpresaExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Cargo </label>

                            <input class="col-lg-12 form-control" id="descripcionExperiencia"  type="text" name="descripcionExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                            <input class="form-control" type="date"  id="fechaInicioExperiencia" name="fechaInicioExperiencia[]" value="">
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de terminación </label>

                            <input class="form-control" type="date"  id="fechaFinExperienci" name="fechaFinExperiencia[]" value="">
                        </div>
                    </div>
                @elseif($objContadorExperiencia->cantidad == 4)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formProf"> No se pueden agregar más experiencias. </label>
                @endif

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 6 sexta parte del formulario *** EXPERIENCIA ***      --------------------------------------------------------->

        <!--------------------------------------------      Inicio 7 septima parte del formulario *** ASOCIACIONES ***      --------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_perfil-prof infoBasica_formProf">
            <h5 class="col-12 icon_infoAsocia-formProf"> Asociaciones </h5>

            <div class="asociacion_guardada-formProf">
                @foreach($objAsociaciones as $objAsociaciones)
                    @if(!empty($objAsociaciones->imgasociacion))
                        <div class="section_infoAsocia-formProf">
                            <div class="col-12 content_btnX-cierre-formProf">
                                <a href="{{url('/FormularioProfesionaldelete7/'.$objAsociaciones->idAsociaciones)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>
                            <div class="option_asociacion-formProf">
                                <img class="img_guardada-formProf" id="imagenPrevisualizacion" src="{{URL::asset($objAsociaciones->imgasociacion)}}">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave7') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_asociacion">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @if($objContadorAsociaciones->cantidad == 0)
                <!-- Modulo ASOCIACIONES -->
                    <div class="row col-12 row_asocia-prof">
                        <!-- campo 1 -->
                        <div class="col-md-4 content_agregarImg-formProf form-group">
                            <div class="img_selccionada-formProf">
                                <img class="img_anexada-formProf" id="uploadPreview1"/>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage1" name="imgasociacion[]" onchange="previewImage(1);"/>
                            </div>

                            <div class="txt_informativo-formProf">
                                <label class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                            </div>
                        </div>

                        <!-- campo 2 -->
                        <div class="col-md-4 content_agregarImg-formProf form-group">
                            <div class="img_selccionada-formProf">
                                <img class="img_anexada-formProf" id="uploadPreview2"/>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage2" name="imgasociacion[]" onchange="previewImage(2);"/>
                            </div>

                            <div class="txt_informativo-formProf">
                                <label class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                            </div>
                        </div>

                        <!-- campo 3 -->
                        <div class="col-md-4 content_agregarImg-formProf form-group">
                            <div class="img_selccionada-formProf">
                                <img class="img_anexada-formProf" id="uploadPreview3"/>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage3" name="imgasociacion[]" onchange="previewImage(3);"/>
                            </div>

                            <div class="txt_informativo-formProf">
                                <label class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorAsociaciones->cantidad == 1)
                <!-- Modulo ASOCIACIONES -->
                    <div class="row col-12 row_asocia-prof">
                        <!-- campo 2 -->
                        <div class="col-md-4 content_agregarImg-formProf form-group">
                            <div class="img_selccionada-formProf">
                                <img class="img_anexada-formProf" id="uploadPreview2"/>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage2" name="imgasociacion[]" onchange="previewImage(2);"/>
                            </div>

                            <div class="txt_informativo-formProf">
                                <label class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                            </div>
                        </div>

                        <!-- campo 3 -->
                        <div class="col-md-4 content_agregarImg-formProf form-group">
                            <div class="img_selccionada-formProf">
                                <img class="img_anexada-formProf" id="uploadPreview3"/>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage3" name="imgasociacion[]" onchange="previewImage(3);"/>
                            </div>

                            <div class="txt_informativo-formProf">
                                <label class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorAsociaciones->cantidad == 2)
                <!-- Modulo ASOCIACIONES -->
                    <div class="row col-12 row_asocia-prof">
                        <!-- campo 3 -->
                        <div class="col-md-4 content_agregarImg-formProf form-group">
                            <div class="img_selccionada-formProf">
                                <img class="img_anexada-formProf" id="uploadPreview3"/>
                            </div>

                            <div class="agregar_archivo-formProf">
                                <input type='file' id="uploadImage3" name="imgasociacion[]" onchange="previewImage(3);"/>
                            </div>

                            <div class="txt_informativo-formProf">
                                <label class="col-12 text_infoImg-formProf"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorAsociaciones->cantidad == 3)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formProf"> No se pueden agregar más asociaciones. </label>
                @endif

                <div class="col-12 mt-2 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 7 septima parte del formulario *** ASOCIACIONES ***      ------------------------------------------------------>

        <!--------------------------------------------      Inicio 8 octava parte del formulario *** IDIOMAS ***      --------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_perfil-prof infoBasica_formProf">
            <h5 class="col-12 icon_infoIdioma-formProf"> Idiomas </h5>

            <div class="idioma_guardada-formProf">
                @foreach($objIdiomas as $objIdiomas)
                    @if(!empty($objIdiomas->imgidioma))
                        <div class="section_infoAsocia-formProf">
                            <div class="col-12 content_btnX-cierre-formProf">
                                <a href="{{url('/FormularioProfesionaldelete8/'.$objIdiomas->id_idioma)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="">
                                <img id="imagenPrevisualizacion" class="img_bandera-forProf" src="{{URL::asset($objIdiomas->imgidioma)}}">

                                <label for="example-date-input" class="text_idioma-formProf"> {{$objIdiomas->nombreidioma}}</label>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave8') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_idioma">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @if($objContadorIdiomas->cantidad == 0)
                    <div class="row p-0 m-0">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="mr-2 text_label-formProf"> Seleccione idioma </label>

                            <select  class="form-control" name="id_idioma[]">
                                <option value=" "> Seleccione </option>
                                @foreach($idiomas as $idiomas1)
                                    <option value="{{$idiomas1->id_idioma}}"> {{$idiomas1->nombreidioma}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf ">
                            <label for="example-date-input" class="mr-2 text_label-formProf"> Seleccione idioma </label>

                            <select  class="form-control" name="id_idioma[]">
                                <option value=" "> Seleccione </option>
                                @foreach($idiomas as $idiomas2)
                                    <option value="{{$idiomas2->id_idioma}}"> {{$idiomas2->nombreidioma}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 section_inputLeft-text-formProf ">
                            <label for="example-date-input" class="mr-2 text_label-formProf"> Seleccione idioma </label>

                            <select  class="form-control" name="id_idioma[]">
                                <option value=" "> Seleccione </option>
                                @foreach($idiomas as $idiomas3)
                                    <option value="{{$idiomas3->id_idioma}}"> {{$idiomas3->nombreidioma}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                @elseif($objContadorIdiomas->cantidad == 1)
                    <div class="row p-0 m-0">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="mr-2 text_label-formProf"> Seleccione idioma </label>

                            <select  class="form-control" name="id_idioma[]">
                                <option value=" "> Seleccione </option>
                                @foreach($idiomas as $idiomas1)
                                    <option value="{{$idiomas1->id_idioma}}"> {{$idiomas1->nombreidioma}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 section_inputRight-text-formProf ">
                            <label for="example-date-input" class="mr-2 text_label-formProf"> Seleccione idioma </label>

                            <select  class="form-control" name="id_idioma[]">
                                <option value=" "> Seleccione </option>
                                @foreach($idiomas as $idiomas2)
                                    <option value="{{$idiomas2->id_idioma}}"> {{$idiomas2->nombreidioma}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @elseif($objContadorIdiomas->cantidad == 2)
                    <div class="row p-0 m-0">
                        <div class="col-md-6 section_inputLeft-text-formProf">
                            <label for="example-date-input" class="mr-2 text_label-formProf"> Seleccione idioma </label>

                            <select  class="form-control" name="id_idioma[]">
                                <option value=" "> Seleccione </option>
                                @foreach($idiomas as $idiomas1)
                                    <option value="{{$idiomas1->id_idioma}}"> {{$idiomas1->nombreidioma}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @elseif($objContadorIdiomas->cantidad == 3)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formProf"> No se pueden agregar más idiomas. </label>
                @endif

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3"> Guardar
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

            <p class="text_superior-proced-formProf"> A continuación suba imágenes con respecto a los procedimientos y tratamientos, con su título y descripción. </p>

            @foreach($objTratamiento as $objTratamiento)
                @if(!empty($objTratamiento->imgTratamientoAntes))
                    <div class="traProce_guardada-formProf">
                        <div class="col-12 content_btnDelet-trata-formProf">
                            <a href="{{url('/FormularioProfesionaldelete9/'.$objTratamiento->id_tratamiento)}}">
                                <button type="submit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </a>
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

            <form method="POST" action="{{ url ('/FormularioProfesionalSave9') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_tratamientos">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @if($objContadorTratamiento->cantidad == 0)
                <!-- Modulos de los contenidos ANTES y DESPUÉS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido ANTES -->
                        <div class="col-md-6 antes content_antes-formProf section_inputLeft-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Antes </label>

                                <div class="img_selccionada-formProf">
                                    <img class="img_traProced-formProf" id="uploadPreview5"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage5" name="imgTratamientoAntes[]" onchange="previewImage(5);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen antes </label>

                                <input class="form-control" id="descripcionExperiencia" placeholder="Título de la imagen" type="text" name="tituloTrataminetoAntes[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción antes </label>

                                    <input class="form-control" id="descripcionExperiencia" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionTratamientoAntes[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DESPUÉS -->
                        <div class="col-md-6 despues content_despues-formProf section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Después </label>

                                <div class="img_selccionada-formProf">
                                    <img class="img_traProced-formProf" id="uploadPreview6"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage6" name="imgTratamientodespues[]" onchange="previewImage(6);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen después </label>

                                <input class="form-control" id="descripcionExperiencia" placeholder="Título de la imagen" type="text" name="tituloTrataminetoDespues[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción después </label>

                                    <input class="form-control" id="descripcionExperiencia" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionTratamientoDespues[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos de los contenidos ANTES y DESPUÉS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido ANTES -->
                        <div class="col-md-6 antes content_antes-formProf section_inputLeft-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Antes </label>

                                <div class="img_selccionada-formProf">
                                    <img class="img_traProced-formProf" id="uploadPreview7"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage7" name="imgTratamientoAntes[]" onchange="previewImage(7);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen antes </label>

                                <input class="form-control" id="descripcionExperiencia" placeholder="Título de la imagen" type="text" name="tituloTrataminetoAntes[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción antes </label>

                                    <input class="form-control" id="descripcionExperiencia" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionTratamientoAntes[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DESPUÉS -->
                        <div class="col-md-6 despues content_despues-formProf section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Después </label>

                                <div class="img_selccionada-formProf">
                                    <img class="img_traProced-formProf" id="uploadPreview8"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage8" name="imgTratamientodespues[]" onchange="previewImage(8);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen después </label>

                                <input class="form-control" id="descripcionExperiencia" placeholder="Título de la imagen" type="text" name="tituloTrataminetoDespues[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción después </label>

                                    <input class="form-control" id="descripcionExperiencia" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionTratamientoDespues[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorTratamiento->cantidad == 1)
                <!-- Modulos de los contenidos ANTES y DESPUÉS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido ANTES -->
                        <div class="col-md-6 antes content_antes-formProf section_inputLeft-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Antes </label>

                                <div class="img_selccionada-formProf">
                                    <img class="img_traProced-formProf" id="uploadPreview7"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage7" name="imgTratamientoAntes[]" onchange="previewImage(7);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen antes </label>

                                <input class="form-control" id="descripcionExperiencia" placeholder="Título de la imagen" type="text" name="tituloTrataminetoAntes[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción antes </label>

                                    <input class="form-control" id="descripcionExperiencia" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionTratamientoAntes[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DESPUÉS -->
                        <div class="col-md-6 despues content_despues-formProf section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Después </label>

                                <div class="img_selccionada-formProf">
                                    <img class="img_traProced-formProf" id="uploadPreview8"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage8" name="imgTratamientodespues[]" onchange="previewImage(8);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 225px x 225px. Peso máximo 400kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen después </label>

                                <input class="form-control" id="descripcionExperiencia" placeholder="Título de la imagen" type="text" name="tituloTrataminetoDespues[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción después </label>

                                    <input class="form-control" id="descripcionExperiencia" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionTratamientoDespues[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorTratamiento->cantidad == 2)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formProf"> No se pueden agregar más tratamientos y procedimientos. </label>
                @endif

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

            <!-- Modulo de los PREMIOS con información -->
            <div class="premios_guardada-formProf">
            @foreach($objPremios as $objPremios)
                @if(!empty($objPremios->nombrepremio))
                    <!-- Contenido PREMIO -->
                        <div class="section_infoExper-formProf">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <a href="{{url('/FormularioProfesionaldelete10/'.$objPremios->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="col-12 mt-2 p-0">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" src="{{URL::asset($objPremios->imgpremio)}}">
                                </div>

                                <div class="col-12 p-0 mt-2">
                                    <label class="col-12 text_fechaPremio-formProf"> {{$objPremios->fechapremio}} </label>
                                </div>

                                <div class="col-12 text_label-formProf">
                                    <label class="col-12 title_infoGuardada-formProf"> {{$objPremios->nombrepremio}}  </label>
                                </div>

                                <div class="col-12 descripcion_Premio-formProf">
                                    <label class="col-12 text_descPremio-formProf"> {{$objPremios->descripcionpremio}} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave10') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_premio">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @if($objContadorPremios->cantidad == 0)
                <!-- Modulo de los PREMIOS sin información-->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview9"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage9" name="imgpremio[]" onchange="previewImage(9);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                                <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 1 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrepremio[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción del premio </label>

                                    <input class="form-control" id="descripcionpremio" placeholder="Escribir descripción..." type="text"  maxlength="160" name="descripcionpremio[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido PREMIO derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview10"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage10" name="imgpremio[]" onchange="previewImage(10);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                                <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 2 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrepremio[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción del premio </label>

                                    <input class="form-control" id="descripcionpremio" placeholder="Escribir descripción..." type="text"  maxlength="160" name="descripcionpremio[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo de los PREMIOS sin información-->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo3  section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview11"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage11" name="imgpremio[]" onchange="previewImage(11);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                                <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 3 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrepremio[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción del premio </label>

                                    <input class="form-control" id="descripcionpremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionpremio[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido PREMIO derecho -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview12"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage12" name="imgpremio[]" onchange="previewImage(12);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                                <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 4 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrepremio[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción del premio </label>

                                    <input class="form-control" id="descripcionpremio" placeholder="Escribir descripción..." type="text"  maxlength="160" name="descripcionpremio[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

            @elseif($objContadorPremios->cantidad == 1)
                <!-- Modulo de los PREMIOS sin información-->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido PREMIO derecho -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview10"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage10" name="imgpremio[]" onchange="previewImage(10);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                                <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 2 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrepremio[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción del premio </label>

                                    <input class="form-control" id="descripcionpremio" placeholder="Escribir descripción..." type="text"  maxlength="160" name="descripcionpremio[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulo de los PREMIOS sin información-->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo3  section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview11"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage11" name="imgpremio[]" onchange="previewImage(11);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                                <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 3 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrepremio[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción del premio </label>

                                    <input class="form-control" id="descripcionpremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionpremio[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido PREMIO derecho -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview12"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage12" name="imgpremio[]" onchange="previewImage(12);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                                <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 4 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrepremio[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción del premio </label>

                                    <input class="form-control" id="descripcionpremio" placeholder="Escribir descripción..." type="text"  maxlength="160" name="descripcionpremio[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

            @elseif($objContadorPremios->cantidad == 2)
                <!-- Modulo de los PREMIOS sin información-->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido PREMIO izquierdo -->
                        <div class="col-md-6 photo3  section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview11"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage11" name="imgpremio[]" onchange="previewImage(11);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                                <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 3 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrepremio[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción del premio </label>

                                    <input class="form-control" id="descripcionpremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionpremio[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido PREMIO derecho -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview12"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage12" name="imgpremio[]" onchange="previewImage(12);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                                <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 4 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrepremio[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción del premio </label>

                                    <input class="form-control" id="descripcionpremio" placeholder="Escribir descripción..." type="text"  maxlength="160" name="descripcionpremio[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

            @elseif($objContadorPremios->cantidad == 3)
                <!-- Modulo de los PREMIOS sin información-->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido PREMIO derecho -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview12"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage12" name="imgpremio[]" onchange="previewImage(12);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha de inicio </label>

                                <input class="form-control" type="date"  id="fechapremio" name="fechapremio[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 4 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrepremio[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción del premio </label>

                                    <input class="form-control" id="descripcionpremio" placeholder="Escribir descripción..." type="text"  maxlength="160" name="descripcionpremio[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorPremios->cantidad == 4)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formProf"> No se pueden agregar más premios y reconocimientos. </label>
                @endif

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
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

            <!-- Modulo de las PUBLICAIONES con información -->
            <div class="premios_guardada-formProf">
            @foreach($Publicaciones as $Publicaciones)
                @if(!empty($Publicaciones->nombrepublicacion))
                    <!-- Contenido PUBLICACIÓN -->
                        <div class="section_infoExper-formProf">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <a href="{{url('/FormularioProfesionaldelete11/'.$Publicaciones->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="col-12 my-2">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" src="{{URL::asset($Publicaciones->imgpublicacion)}}">
                                </div>

                                <div class="col-12 mt-2 text_label-formProf">
                                    <label class="col-12 title_infoGuardada-formProf"> {{$Publicaciones->nombrepublicacion}} </label>
                                </div>

                                <div class="col-12 descripcion_Premio-formProf">
                                    <label class="col-12 text_descPremio-formProf"> {{$Publicaciones->descripcion}} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave11') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_publicaciones">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @if($objContadorPublicaciones->cantidad == 0)
                <!-- Modulos del contenido PUBLICACIONES -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido publicación left -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview13"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage13" name="imgpublicacion[]" onchange="previewImage(13);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la publicación </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la publicación" type="text" name="nombrepublicacion[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" maxlength="160" placeholder="Escribir descripción..." type="text" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido publicación right -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview14"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage14" name="imgpublicacion[]" onchange="previewImage(14);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la publicación </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la publicación" type="text" name="nombrepublicacion[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido PUBLICACIONES -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido publicación left -->
                        <div class="col-md-6 photo3 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview15"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage15" name="imgpublicacion[]" onchange="previewImage(15);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la publicación </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la publicación" type="text" name="nombrepublicacion[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" maxlength="160" placeholder="Escribir descripción..." type="text" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido publicación right -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview16"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage16" name="imgpublicacion[]" onchange="previewImage(16);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la publicación </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la publicación" type="text" name="nombrepublicacion[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorPublicaciones->cantidad == 1)
                <!-- Modulos del contenido PUBLICACIONES -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido publicación right -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview14"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage14" name="imgpublicacion[]" onchange="previewImage(14);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la publicación </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la publicación" type="text" name="nombrepublicacion[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido PUBLICACIONES -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido publicación left -->
                        <div class="col-md-6 photo3 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview15"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage15" name="imgpublicacion[]" onchange="previewImage(15);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la publicación </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la publicación" type="text" name="nombrepublicacion[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" maxlength="160" placeholder="Escribir descripción..." type="text" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido publicación right -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview16"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage16" name="imgpublicacion[]" onchange="previewImage(16);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la publicación </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la publicación" type="text" name="nombrepublicacion[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorPublicaciones->cantidad == 2)
                <!-- Modulos del contenido PUBLICACIONES -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido publicación left -->
                        <div class="col-md-6 photo3 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview15"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage15" name="imgpublicacion[]" onchange="previewImage(15);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la publicación </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la publicación" type="text" name="nombrepublicacion[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" maxlength="160" placeholder="Escribir descripción..." type="text" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido publicación right -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview16"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage16" name="imgpublicacion[]" onchange="previewImage(16);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la publicación </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la publicación" type="text" name="nombrepublicacion[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorPublicaciones->cantidad == 3)
                <!-- Modulos del contenido PUBLICACIONES -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido publicación right -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview16"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage16" name="imgpublicacion[]" onchange="previewImage(16);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 800 x 800px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la publicación </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la publicación" type="text" name="nombrepublicacion[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción publicación </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorPublicaciones->cantidad == 4)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formProf"> No se pueden agregar más publicaciones. </label>
                @endif

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3"> Guardar
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

            <!-- Modulo de la GALERIA con información -->
            <div class="premios_guardada-formProf">
            @foreach($objGaleria as $objGaleria)
                @if(!empty($objGaleria->nombrefoto))
                    <!-- Contenido GALERIA -->
                        <div class="section_infoExper-formProf">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <a href="{{url('/FormularioProfesionaldelete12/'.$objGaleria->id_galeria)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>

                            <div class="col-12 my-2 p-0">
                                <div class="img_selccionada-formProf">
                                    <img  class="img_anexada-formProf" src="{{URL::asset($objGaleria->imggaleria)}}">
                                </div>

                                <div class="col-12 mt-2 text_label-formProf">
                                    <label class="col-12 title_infoGuardada-formProf"> {{$objGaleria->nombrefoto}} </label>
                                </div>

                                <div class="col-12 descripcion_Premio-formProf">
                                    <label class="col-12 text_descPremio-formProf"> {{$objGaleria->descripcion}} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave12') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_galeria">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @if($objContadorGaleria->cantidad == 0)
                <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo1 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview17"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage17" name="imggaleria[]" onchange="previewImage(17);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 1 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview18"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage18" name="imggaleria[]" onchange="previewImage(18);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 2 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo3 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview19"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage19" name="imggaleria[]" onchange="previewImage(19);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 3 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview20"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage20" name="imggaleria[]" onchange="previewImage(20);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 4 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo5 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview21"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage21" name="imggaleria[]" onchange="previewImage(21);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 5 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo6 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview22"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage22" name="imggaleria[]" onchange="previewImage(22);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 6 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo7 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview23"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo8 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview24"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

            @elseif($objContadorGaleria->cantidad == 1)
                <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo2 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview18"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage18" name="imggaleria[]" onchange="previewImage(18);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 2 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo3 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview19"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage19" name="imggaleria[]" onchange="previewImage(19);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 3 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview20"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage20" name="imggaleria[]" onchange="previewImage(20);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 4 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo5 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview21"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage21" name="imggaleria[]" onchange="previewImage(21);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 5 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo6 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview22"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage22" name="imggaleria[]" onchange="previewImage(22);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 6 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo7 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview23"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo8 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview24"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorGaleria->cantidad == 2)
                <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo3 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview19"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage19" name="imggaleria[]" onchange="previewImage(19);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 3 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview20"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage20" name="imggaleria[]" onchange="previewImage(20);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 4 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo5 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview21"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage21" name="imggaleria[]" onchange="previewImage(21);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 5 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo6 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview22"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage22" name="imggaleria[]" onchange="previewImage(22);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 6 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo7 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview23"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo8 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview24"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorGaleria->cantidad == 3)
                <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo4 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview20"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage20" name="imggaleria[]" onchange="previewImage(20);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 4 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo5 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview21"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage21" name="imggaleria[]" onchange="previewImage(21);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 5 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo6 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview22"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage22" name="imggaleria[]" onchange="previewImage(22);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 6 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo7 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview23"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo8 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview24"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorGaleria->cantidad == 4)
                <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo5 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview21"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage21" name="imggaleria[]" onchange="previewImage(21);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 5 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo6 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview22"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage22" name="imggaleria[]" onchange="previewImage(22);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 6 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo7 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview23"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo8 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview24"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorGaleria->cantidad == 5)
                <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo6 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview22"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage22" name="imggaleria[]" onchange="previewImage(22);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 6 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo7 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview23"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo8 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview24"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorGaleria->cantidad == 6)
                <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 photo7 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview23"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage23" name="imggaleria[]" onchange="previewImage(23);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date" id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 7 </label>

                                <input class="form-control" id="nombrefoto" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="descripcion" placeholder="Escribir descripción..." type="text" maxlength="160" maxlength="200" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo8 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview24"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorGaleria->cantidad == 7)
                <!-- Modulos del contenido GALERIA -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 photo8 section_inputRight-text-formProf">
                            <div class="col-12 content_agregarImg-formProf form-group">
                                <div class="img_selccionada-formProf">
                                    <img class="img_anexada-formProf" id="uploadPreview24"/>
                                </div>

                                <div class="agregar_archivo-formProf">
                                    <input type='file' id="uploadImage24" name="imggaleria[]" onchange="previewImage(24);"/>
                                </div>

                                <div class="txt_informativo-formProf">
                                    <label class="col-12 text_infoImg-formProf"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                                </div>
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechagaleria" name="fechagaleria[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título de la imagen 8 </label>

                                <input class="form-control" id="nombrepremio" placeholder="Título de la imagen" type="text" name="nombrefoto[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción </label>

                                    <input class="form-control" id="nombrepremio" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorGaleria->cantidad == 8)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formProf"> No se pueden agregar más imágenes. </label>
                @endif

                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3"> Guardar
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

            <!-- Modulos de los VIDEOS -->
            <div class="premios_guardada-formProf">
            @foreach($objVideo as $objVideo)
                @if(!empty($objVideo->nombrevideo))
                    <!-- Contenido VIDEOS -->
                        <div class="section_infoExper-formProf">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <a href="{{url('/FormularioProfesionaldelete13/'.$objVideo->id)}}">
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </a>
                            </div>


                            <div class="col-12 my-2">
                                <div class="img_selccionada-formProf">
                                    <iframe class="img_anexada-formProf" src="{{$objVideo->urlvideo}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>

                                <div class="col-12 p-0 mt-2">
                                    <label class="col-12 text_fechaPremio-formProf"> {{$objVideo->fechavideo}} </label>
                                </div>

                                <div class="col-12 text_label-formProf">
                                    <label class="col-12 title_infoGuardada-formProf"> {{$objVideo->nombrevideo}} </label>
                                </div>

                                <div class="col-12 descripcion_Premio-formProf">
                                    <p class="col-12 text_descPremio-formProf"> {{$objVideo->descripcionvideo}} </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave13') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @if($objContadorVideo->cantidad == 0)
                <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Url video 1 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Url video 2 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Url video 3 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Url video 4 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

            @elseif($objContadorVideo->cantidad == 1)
                <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Url video 2 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Url video 3 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Url video 4 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>

            @elseif($objContadorVideo->cantidad == 2)
                <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido IZQUIERDO -->
                        <div class="col-md-6 section_inputLeft-text-formProf content_antes-formProf">
                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Url video 3 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 section_inputLeft-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>

                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Url video 4 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
            @elseif($objContadorVideo->cantidad == 3)
                <!-- Modulos de los VIDEOS -->
                    <div class="row content_antDesp-formProf">
                        <!-- Contenido DERECHO -->
                        <div class="col-md-6 section_inputRight-text-formProf">
                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Url video 4 </label>

                                <input class="form-control" id="urlvideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlvideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Fecha </label>

                                <input class="form-control" type="date"  id="fechavideo" name="fechavideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <label for="example-date-input" class="col-12 text_label-formProf"> Título video </label>

                                <input class="form-control" id="nombrevideo" placeholder="Título video" type="text" name="nombrevideo[]" value="">
                            </div>

                            <div class="col-12 section_inputRight-text-formProf">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-12 text_label-formProf"> Descripción video </label>

                                    <input class="form-control" id="descripcionvideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionvideo[]" value="">

                                    <label class="col-12 text_infoImg-formProf"> 160 Caracteres </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($objContadorVideo->cantidad == 4)
                    <label for="example-date-input" class="col-12 txtInfo_limitante-formProf"> No se pueden agregar más videos. </label>
                @endif



                <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
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
