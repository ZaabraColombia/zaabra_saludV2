@extends('layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet" />
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
                            <label for="nombre_institucion" class="col-12 text_label-formInst"> Nombres Institución </label>
                            <input class="form-control" value="{{ old('nombre_institucion', $objuser->nombreinstitucion) }}" id="nombre_institucion" name="nombre_institucion">
                        </div>
                        <div class="col-12 rightSection_formInst">
                            <label for="fecha_inicio_institucion" class="col-12 text_label-formInst">  Fecha  </label>
                            <input class="form-control" type="date" value="{{ old('fecha_inicio_institucion', $objFormulario->fechainicio) }}" id="fecha_inicio_institucion" name="fecha_inicio_institucion">
                        </div>
                        <div class="col-12 rightSection_formInst">
                            <label for="url_institucion" class="col-12 text_label-formInst"> Página web </label>
                            <input class="form-control" placeholder="Url" type="text" name="url_institucion" id="url_institucion" value="{{ old('url_institucion', $objFormulario->url) }}">
                        </div>
                        <div class="col-12 rightSection_formInst">
                            <label for="tipo_institucion" class="col-12 text_label-formInst"> Selecione entidad </label>
                            <select class="form-control" name="tipo_institucion" id="tipo_institucion">
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
                    <button type="submit" class="btn_guardar-formInst" id="btn-guardar-basico-institucional"
                            data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                        Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
                <!--------------- Fin campos vacios--------------------->
            </form>
        </div>
        <!--------------------------------------------      Fin 1 primera parte del formulario *** INFORMACIÓN BÁSICA ***      ------------------------------------------------>

        <!--------------------------------------------      Inicio 2 segunda parte del formulario *** INFORMACIÓN CONTACTO ***      ------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <form method="POST" action="{{ route('entidad.create2') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-contacto-institucional">
                @csrf
                <h5 class="col-12 icon_infoContac-formInst"> Información de contacto </h5>
                <div id="mensajes-contacto"></div>
                <div class="row fila_infoUser-formInst">
                    <div class="col-md-6 leftSection_formInst">
                        <label for="celular" class="col-12 text_label-formInst"> Celular </label>
                        <input class="form-control" id="celular" placeholder="Número de celular" type="number" name="celular" value="{{ old('celular', $objFormulario->telefonouno) }}">
                    </div>
                    <div class="col-md-6 rightSection_formInst">
                        <label for="telefono" class="col-12 text_label-formInst"> Teléfono fijo </label>
                        <input class="form-control" id="telefono" placeholder="Número Teléfono" type="number" name="telefono" value="{{ old('telefono', $objFormulario->telefono2) }}">
                    </div>

                    <div class="col-md-6 leftSection_formInst">
                        <label for="direccion" class="col-12 text_label-formInst"> Dirección </label>
                        <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion" value="{{ old('direccion', $objFormulario->direccion) }}">
                    </div>

                    <!--menu dinamico ciudades -->
                    <div class="col-md-6 rightSection_formInst">
                        <label for="pais" class="col-12 text_label-formInst"> Seleccione país </label>
                        <select id="pais" name="pais" class="form-control">
                            <option></option>
                            @foreach($listaPaises as $pais)
                                <option value="{{ $pais->id_pais }}"  {{ (old('pais', $objFormulario->id_pais) == $pais->id_pais) ? 'selected' : ''}}> {{ $pais->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 leftSection_formInst">
                        <label for="departamento" class="col-12 text_label-formInst"> Seleccione departamento </label>
                        <select name="departamento" id="departamento" class="form-control">
                            @foreach($listaDepartamentos as $departamento)
                                <option value="{{ $departamento->id_departamento }}"  {{ (old('departamento', $objFormulario->id_departamento) == $departamento->id_departamento) ? 'selected' : ''}}> {{ $departamento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 rightSection_formInst">
                        <label for="provincia" class="col-12 text_label-formInst"> Seleccione provincia </label>
                        <select name="provincia" id="provincia" class="form-control">
                            @foreach($listaProvincias as $provincia)
                                <option value="{{ $provincia->id_provincia }}"  {{ (old('provincia', $objFormulario->id_provincia) == $provincia->id_provincia) ? 'selected' : ''}}> {{ $provincia->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 leftSection_formInst">
                        <label for="municipio" class="col-12 text_label-formInst"> Seleccione ciudad </label>
                        <select name="municipio" id="municipio" class="form-control">
                            @foreach($listaMunicipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}"  {{ (old('municipio', $objFormulario->id_municipio) == $municipio->id_municipio) ? 'selected' : ''}}> {{ $municipio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botón guardar información -->
                    <div class="col-12 content_btnEnviar-formInst">
                        <button type="submit" class="btn2_enviar-formInst" id="btn-guardar-contacto-institucion"
                                data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                            Guardar
                            <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 2 segunda parte del formulario *** INFORMACIÓN CONTACTO ***      ---------------------------------------------->

        {{--Cambiar contraseña Institución--}}
        <section class="col-lg-10 col-xl-8 infoBasica_formProf">
            <form action="{{ route('institucion.formulario-password') }}" id="form-password-institucion" class="form pt-2 pb-3" method="post">
                <div class="col-12" id="mensajes-password"></div>
                <!-- contraseña actual -->
                <div class="contraseña_inputs_formPacien">
                    <label for="password" class="text_label_formPacien">{{ __('paciente.contraseña-actual') }}</label>

                    <div class="content_inputs_forPacien">
                        <input id="password" class="form-control" type="password" name="password" />
                    </div>
                </div>

                <!-- contraseña nueva -->
                <div class="contraseña_inputs_formPacien">
                    <label for="password_new" class="text_label_formPacien">{{ __('paciente.contraseña-nueva') }}</label>

                    <div class="content_inputs_forPacien">
                        <input id="password_new" class="form-control" type="password" name="password_new" />
                    </div>
                </div>

                <!-- repetir contraseña -->
                <div class="contraseña_inputs_formPacien">
                    <label for="password_new_confirmation" class="text_label_formPacien">{{ __('paciente.contraseña-repetir') }}</label>

                    <div class="content_inputs_forPacien">
                        <input id="password_new_confirmation" class="form-control" type="password" name="password_new_confirmation" />
                    </div>
                </div>

                <!-- Boton guardar -->
                <div class="btn_password_formProf">
                    <button class="btn2_enviar-formInst" id="btn-guardar-password-institucion" data-text="{{ __('paciente.guardar') }}" data-text-loading="{{ __('paciente.cargando') }}...">
                        {{ __('paciente.guardar') }}
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </section>

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonInferior-next-formInst">
            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst btn-next-320-formInst" onclick="hideBtnNext(this)" code-position="dateInstitution"> Siguiente
                    <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 2* Contenedor principal de la opción SERVICIOS PROFESIONALES -->
    <div class="container-fluid professional_services content_principal-formInst"> <!-- Clase "professional_services" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 3 tercera parte del formulario *** SERVICIO PROFESIONAL ***      ------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-12 icon_servProf-formInst"> Servicios profesionales </h5>
            <div id="mensajes-descripcion"></div>
            <form method="POST" action="{{ route('entidad.create3') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-descripcion-institucion">
                @csrf
                <div class="col-12 px-0">
                    <label for="descripcion_perfil" class="text_superior-proced-formInst"> Escriba una breve descripción de su servicio. </label>
                    <textarea class="form-control" id="descripcion_perfil"  type="text" name="descripcion_perfil" >{{ old('descripcion_perfil', $objFormulario->DescripcionGeneralServicios) }}</textarea>
                    <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                </div>
                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst" >
                    <button type="submit" class="btn2_enviar-formInst" id="btn-guardar-descripcion-institucional"
                            data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                        Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="flechaBtn_guardar-formInst">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 3 tercera parte del formulario *** SERVICIO PROFESIONAL ***      ---------------------------------------------->

        <!--------------------------------------------      Inicio 4 cuarta parte del formulario *** SERVICIO ***      -------------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_servicios-formInst"> Servicios </h5>
            <!-- Modulo contenido SERVICIOS -->
            <div class="experiencia_guardada-formProf" id="lista-servicios-institucion">
                <?php $count_servicios = 0; ?>
                @foreach($objServicio as $servicio)
                    @if(!empty($servicio->tituloServicios))
                        <?php $count_servicios++; ?>
                        <div class="savedData_formInst">
                            <div class="col-12 content_cierreX-formInst">
                                <button type="submit" class="close" aria-label="Close" data-url="{{ route('entidad.delete4', ['id_servicio' => $servicio->id_servicio]) }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="option_consulta-formProf">
                                <label for="example-date-input" class="col-12 title_infoGuardada-formProf"> Título del servicio </label>
                                <label class="col-12 text_infoGuardada-formProf"> {{$servicio->tituloServicios}} </label>
                            </div>

                            <div class="option_consulta-formProf">
                                <label for="example-date-input" class="col-12 title_infoGuardada-formProf"> Descripción </label>
                                <label class="col-12 text_infoGuardada-formProf"> {{$servicio->DescripcioServicios}} </label>
                            </div>

                            <div class="option_consulta-formProf">
                                <label for="example-date-input" class="col-12 title_infoGuardada-formProf"> Sedes en la que está el servicio </label>
                                @if( is_string($servicio->sucursalservicio) )
                                    @php  $new_array = explode(',', $servicio->sucursalservicio ); @endphp
                                @endif
                                <ul>
                                    @foreach($new_array as $info)
                                        <li class="col-12 text_infoGuardada-formProf"> {{$info}} </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <form method="POST" action="{{ route('entidad.create4') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-servicios-institucion">
                @csrf
                <div class="row justify-content-center">
                    <!-- Contenido IZQUIERDO -->
                    <div class="col-md-6 leftSection_formInst downLine_formInst center_lineForm">
                        <div class="col-12" id="mensajes-servicios">
                            @if($count_servicios >= 6 )
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Hecho!</h4>
                                    <p>Ya tienes el máximo de servicos</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <label for="titulo_servicio" class="col-12 text_label-formInst"> Título del servicio </label>
                            <input class="form-control" id="titulo_servicio" placeholder="Título del servicio" type="text" name="titulo_servicio" {{ ($count_servicios >= 6) ? 'disabled' : '' }}>
                        </div>

                        <div class="col-12">
                            <label for="descripcion_servicio" class="col-12 text_label-formInst"> Descripción </label>
                            <textarea class="form-control" id="descripcion_servicio" placeholder="Escribir descripción..." maxlength="270" name="descripcion_servicio" {{ ($count_servicios >= 6) ? 'disabled' : '' }}></textarea>
                            <label class="col-12 text_infoImg-formInst"> 270 Caracteres </label>
                        </div>

                        <div class="col-12" id="sedes-servicios-institucion">
                            <label for="sucursal_servicio-0" class="col-12 text_label-formInst"> Sedes en la que está el servicio </label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control input_servicios_institucion" placeholder="Nombre de la sede" id="sucursal_servicio-0" name="sucursal_servicio[0]" {{ ($count_servicios >= 6) ? 'disabled' : '' }}>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="button" id="btn-agregar-servicio-institucion" {{ ($count_servicios >= 6) ? 'disabled' : '' }}><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst" id="btn-guardar-servicio-institucion" {{ ($count_servicios >= 6) ? 'disabled' : '' }}
                    data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                        Guardar
                        <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 4 cuarta parte del formulario *** SERVICIO ***      ----------------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="professionalServices">
                    <img src="{{asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="professionalServices"> Siguiente
                    <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 3* Contenedor principal de la opción ACERCA DE LA INSTITUCIÓN -->
    <div class="container-fluid about_institution content_principal-formInst"> <!-- Clase "about_institution" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 5 quinta parte del formulario *** QUIENES SOMOS ***      ------------------------------------------------------>
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_quienes-formInst"> ¿Quiénes somos? </h5>
            <div id="mensajes-quienes-somos"></div>

            <form method="POST" action="{{ route('entidad.create5') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-quienes-somos-institucion">
                @csrf
                <div class="col-12 px-0">
                    <label for="descripcion_quienes_somos" class="text_superior-proced-formInst"> Escriba una breve descripción de ¿Quiénes son?. </label>
                    <textarea class="form-control" id="descripcion_quienes_somos"  type="text" name="descripcion_quienes_somos" >{{ old('descripcion_quienes_somos', $objFormulario->quienessomos) }}</textarea>
                    <label class="col-12 text_infoImg-formInst"> 500 Caracteres </label>
                </div>

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst" id="btn-guardar-quienes-somo-institucion"
                            data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                        Guardar
                        <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 5 quinta parte del formulario *** QUIENES SOMOS ***      ------------------------------------------------------>

        <!--------------------------------------------      Inicio 6 sexta parte del formulario *** PROPUESTA DE VALOR ***      ----------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_propuestaValor-formInst"> Propuesta de valor </h5>
            <div id="mensajes-propuesta-valor"></div>
            <form method="POST" action="{{ route('entidad.create6') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-propuesta-valor-institucion">
                @csrf
                <div class="col-12 px-0">
                    <label for="propuesta_valor" class="text_superior-proced-formInst"> Escriba una breve descripción de la propuesta de valor. </label>
                    <textarea class="form-control" id="propuesta_valor"  type="text" name="propuesta_valor" >{{ old('propuesta_valor', $objFormulario->propuestavalor) }}</textarea>
                    <label class="col-12 text_infoImg-formInst"> 300 Caracteres </label>
                </div>

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst" id="btn-guardar-propuesta-valor-institucion"
                            data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                        Guardar
                        <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 6 sexta parte del formulario *** PROPUESTA DE VALOR ***      -------------------------------------------------->

        <!--------------------------------------------      Inicio 7 septima parte del formulario *** CONVENIOS ***      ------------------------------------------------------>
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_convenios-formInst"> Convenios </h5>

            <div class="row p-5" id="lista-convenios-institucion">
                <?php $count_convenios = 0;?>

                @foreach($objConvenios as $convenio)
                    @if(!empty($convenio->url_image))
                        <?php $count_convenios++;?>
                        <div class="col-md-3 col-sm-6">
                            <div class="col-12 content_btnX-cierre-formProf my-2">
                                <label for="example-date-input" class="text_saved-formInst pb-0"> Convenio {{ $convenio->nombre_tipo_convenio }} </label>
                                <button type="button" class="close" aria-label="Close" data-url="{{ route('entidad.delete7', ['id_convenio' => $convenio->id]) }}"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="option_asociacion-formProf">
                                <img class="img_guardada-formProf" id="imagenPrevisualizacion" src="{{ asset($convenio->url_image) }}">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ route('entidad.create7') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-convenios-institucion">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6 content_agregarImg-formInst form-group">
                        <div id="mensajes-convenios"></div>
                        <div class="form-group">
                            <label for="tipo_convenio">Tipo convenio</label>
                            <select name="tipo_convenio" id="tipo_convenio" class="form-control" {{ ($count_convenios >= 9) ? 'disabled' : '' }}>
                                <option></option>
                                @foreach($objTipoConvenios as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombretipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="img_selccionada-formProf">
                            <img class="img_anexada-formProf" id="img-logo_convenio"/>
                        </div>
                        <div class="agregar_archivo-formProf">
                            <input type='file' id="logo_convenio" name="logo_convenio" onchange="ver_imagen('logo_convenio', 'img-logo_convenio');" {{ ($count_convenios >= 9) ? 'disabled' : '' }}/>
                        </div>

                        <div class="txt_informativo-formInst">
                            <label class="text_infoConvenio-formInst"> Tamaño 120px x 60px. Peso máximo 300kb </label>
                        </div>
                    </div>
                </div>

                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst mt-0 mt-md-3" id="btn-guardar-convenios-institucion" {{ ($count_convenios >= 9) ? 'disabled' : '' }}
                    data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                        Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 7 septima parte del formulario *** CONVENIOS ***      --------------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="aboutInstitution">
                    <img src="{{asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="aboutInstitution"> Siguiente
                    <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                </button>
            </div>
        </div>
    </div>

    <!-- 4* Contenedor principal de la opción PROFESIONALES -->
    <div class="container-fluid professional_inst content_principal-formInst"> <!-- Clase "professional_inst" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!--------------------------------------------      Inicio 8 octava parte del formulario *** PROFESIONALES ***      --------------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_profesionales-formInst"> Profesionales </h5>
            <div class="col-11 col-md-12 row containt_profGuardado-formInst" id="lista-profesionales-institucion">
                <?php $count_profecionales = 0; ?>
                @foreach($objProfesionalesIns as $profecional)
                    @if(!empty($profecional->foto_perfil_institucion))
                        <?php $count_profecionales++; ?>
                        <div class="col-md-3 content_loadImg-profes">
                            <div class="col-12 p-0 contain_imgUsuario-formImg">
                                <div class="col-12 pr-2 content_cierreX-formInst">
                                    <button type="submit" class="close" aria-label="Close" data-url="{{ route('entidad.delete8', ['id_profesional' => $profecional->id_profesional_inst]) }}">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="col-12 col-md-10 img_save-formProf">
                                    <img class="img_usuario-formInst" src="{{ asset($profecional->foto_perfil_institucion) }}">
                                </div>
                            </div>
                            <div class="col-12 mt-3 containt_loadProfes-formInst">
                                <div class="col-md-12 rightSection_formInst">
                                    <span>{{ $profecional->primer_nombre }} {{ $profecional->segundo_nombre }}</span>
                                </div>
                                <div class="col-md-12 rightSection_formInst">
                                    <span>{{ $profecional->primer_apellido }} {{ $profecional->segundo_apellido }}</span>
                                </div>
                                <div class="col-md-12 rightSection_formInst">
                                    <span>{{ $profecional->nombre_universidad }}</span>
                                </div>
                                @if(!empty($profecional->nombre_especialidad))
                                    <div class="col-md-12 rightSection_formInst">
                                        <span>{{ $profecional->nombre_especialidad }}</span>
                                    </div>
                                @endif
                                @if(!empty($profecional->cargo))
                                    <div class="col-md-12 rightSection_formInst">
                                        <span>{{ $profecional->cargo }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form action="{{ route('entidad.create8') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="form-profesionales-institucion">
                @csrf
                <div class="col-12" id="mensajes-profesionales">
                    @if($count_profecionales >= 3 and !$is_asociacion )
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Hecho!</h4>
                            <p>Ya tienes el máximo de profesionales</p>
                        </div>
                    @endif
                </div>
                <!-- Profesional numero 1 -->
                <div class="row fila_infoBasica-formInst mb-4">
                    <div class="col-md-3 contain_imgUsuario-formImg">
                        <img class="img_usuario-formInst" id="img-foto_profecional">
                        <input class="input_imgUsuario-formInst" type="file" id="foto_profecional" name="foto_profecional" onchange="ver_imagen('foto_profecional', 'img-foto_profecional');" accept="image/png, image/jpeg">
                        <p class="icon_subirFoto-formInst"> Subir foto de perfil </p>
                    </div>

                    <div class="row col-md-9 datos_principales-formInst">
                        <div class="col-md-6 rightSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Nombres </label>
                            <div class="col-12 nombres_usuario-formInst">
                                <input class="input_nomApl-prefes-formProf" placeholder="Primer nombre" type="text" name="primer_nombre_profecional" id="primer_nombre_profecional" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}>
                                <input class="input_nomApl-prefes-formProf" placeholder="Segundo nombre"  type="text" name="segundo_nombre_profecional" id="segundo_nombre_profecional" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}>
                            </div>
                        </div>

                        <div class="col-md-6 rightSection_formInst">
                            <label for="example-date-input" class="col-12 text_label-formInst"> Apellidos </label>
                            <div class="col-12 nombres_usuario-formInst">
                                <input class="input_nomApl-prefes-formProf" placeholder="Primer apellido"  type="text" name="primer_apellido_profecional" id="primer_apellido_profecional" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}>
                                <input class="input_nomApl-prefes-formProf" placeholder="Segundo apellido"  type="text" name="segundo_apellido_profecional" id="segundo_apellido_profecional" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="universidad" class="col-12 text_label-formInst"> Universidad </label>
                            <select name="universidad" id="universidad" class="form-control universidades" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}>
                                <option></option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="especialidad" class="col-12 text_label-formInst"> Especialidad </label>
                            <select name="especialidad" id="especialidad" class="form-control especialidades-search" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}>
                                <option></option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="cargo_profesional" class="col-12 text_label-formInst"> Cargo </label>
                            <input type="text" name="cargo_profesional" id="cargo_profesional" class="form-control" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }} />
                        </div>
                    </div>
                </div>
                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst mt-0" id="btn-guardar-profecionales-institucion" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}
                    data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                        Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="flechaBtn_guardar-formInst" />
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 8 octava parte del formulario *** PROFESIONALES ***      ------------------------------------------------------>

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="professionalInst">
                    <img src="{{asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="professionalInst"> Siguiente
                    <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
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
            <div class="premios_guardada-formProf" id="lista-certificaciones-institucion">
                <?php $count_certificaiones = 0; ?>
            @foreach($objCertificaciones as $certificacion)
                @if(!empty($certificacion->imgcertificado))
                    <?php $count_certificaiones++; ?>
                    <!-- Contenido Certificaciones -->
                        <div class="col-md-6">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <button type="submit" class="close" aria-label="Close" data-url="{{ route('entidad.delete9', ['id_certificacion' => $certificacion->id_certificacion]) }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="col-12 mt-2 p-0">
                                <div class="img_saveCertifi-formInst">
                                    <img class="img_anexada-formInst"  src="{{ asset($certificacion->imgcertificado) }}">
                                </div>

                                <div class="col-12 p-0 mt-2">
                                    <label class="col-12 text_fechaPremio-formProf"> {{ $certificacion->fechacertificado }} </label>
                                </div>

                                <div class="col-12 text_label-formProf">
                                    <label class="col-12 title_infoGuardada-formProf"> {{ $certificacion->titulocertificado }} </label>
                                </div>

                                <div class="col-12 descripcion_Premio-formProf">
                                    <label class="col-12 text_descPremio-formProf"> {{ $certificacion->descrpcioncertificado }} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ route('entidad.create9') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-certificados-institucion">
                @csrf
                <div class="col-12" id="mensajes-certificaciones">
                    @if($count_certificaiones >= 4)
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Hecho!</h4>
                            <p>Ya tienes el máximo de certificaciones</p>
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 photo1 leftSection_formInst content_antes-formInst">
                        <div class="col-12 leftSection_formInst">
                            <div class="img_saveCertifi-formInst">
                                <img class="img_anexada-formInst" id="img-image_certificado">
                            </div>
                            <div class="agregar_archivo-formInst">
                                <input type='file' id="image_certificado" name="image_certificado" onchange="ver_imagen('image_certificado', 'img-image_certificado');" {{ ($count_certificaiones >= 4) ? 'disabled' : '' }}/>
                            </div>
                            <div class="txt_informativo-formInst">
                                <label class="col-12 text_infoImg-formInst mb-0"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                            </div>
                        </div>

                        <div class="col-12 leftSection_formInst">
                            <label for="fecha_certificado" class="col-12 text_label-formInst"> Fecha </label>
                            <input class="form-control" type="date"  id="fecha_certificado" name="fecha_certificado" {{ ($count_certificaiones >= 4) ? 'disabled' : '' }}>
                        </div>

                        <div class="col-12 leftSection_formInst">
                            <label for="titulo_certificado" class="col-12 text_label-formInst"> Título del certificado </label>
                            <input class="form-control" id="titulo_certificado" placeholder="Título de la imagen" type="text" name="titulo_certificado" {{ ($count_certificaiones >= 4) ? 'disabled' : '' }}>
                        </div>

                        <div class="col-12 leftSection_formInst">
                            <div class="form-group">
                                <label for="descripcion_certificacion" class="col-12 text_label-formInst"> Descripción de la certificación </label>
                                <textarea name="descripcion_certificacion" id="descripcion_certificacion" class="form-control" {{ ($count_certificaiones >= 4) ? 'disabled' : '' }}></textarea>
                                <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst mt-0" id="btn-guardar-certificado-institucion" {{ ($count_certificaiones >= 4) ? 'disabled' : '' }}
                    data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                        Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 9 novena parte del formulario *** CERTIFICACIONES ***      ---------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="certificationsInst">
                    <img src="{{asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="certificationsInst"> Siguiente
                    <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
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
            <div class="premios_guardada-formProf" id="lista-sedes-institucion">
                <?php $count_sedes = 0; ?>
            @foreach($objSedes as $sede)
                @if(!empty($sede->imgsede))
                    <?php $count_sedes++; ?>
                        <!-- Contenido Certificaciones -->
                        <div class="savedData_formInst">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <button type="submit" class="close" aria-label="Close" data-url="{{ route('entidad.delete10', ['id' => $sede->id]) }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="col-12 mt-2 p-0">
                                <div class="img_saveSede-formInst">
                                    <img class="img_anexada-formInst" src="{{ asset($sede->imgsede) }}">
                                </div>
                                <div class="col-12 text_label-formInst">
                                    <label class="col-12 title_infoGuardada-formProf">{{ $sede->nombre }} </label>
                                </div>
                                <div class="col-12 texto_saved-formInst">
                                    <label class="col-12 text_descPremio-formProf"> {{ $sede->direccion }} </label>
                                </div>
                                <div class="col-12 texto_saved-formInst">
                                    <label class="col-12 text_descPremio-formProf"> {{ $sede->horario_sede }} </label>
                                </div>
                                <div class="col-12 texto_saved-formInst">
                                    <label class="col-12 text_descPremio-formProf">{{ $sede->telefono }} </label>
                                </div>
                                <div class="col-12 texto_saved-formInst">
                                    <label class="col-12 text_descPremio-formProf">{{ $sede->url_map }} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ route('entidad.create10') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-sedes-institucion">
                @csrf
                <div class="col-12" id="mensajes-sedes">
                    @if($count_sedes >= 6)
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Hecho!</h4>
                            <p>Ya tienes el máximo de sedes</p>
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="col-12 leftSection_formInst">
                            <div class="img_saveCertifi-formInst">
                                <img class="img_anexada-formInst" id="img-img_sede">
                            </div>

                            <div class="agregar_archivo-formInst">
                                <input type='file' id="img_sede" name="img_sede" onchange="ver_imagen('img_sede', 'img-img_sede');" {{ ($count_sedes >= 6) ? 'disabled' : '' }} />
                            </div>
                            <div class="txt_informativo-formInst">
                                <label class="col-12 text_infoImg-formInst"> Tamaño 356 x 326px. Peso máximo 300kb </label>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="nombre_sede" class="col-12 text_label-formInst"> Nombre de la sede </label>
                            <input class="form-control" id="nombre_sede" placeholder="Nombre de la sede" type="text" name="nombre_sede" {{ ($count_sedes >= 6) ? 'disabled' : '' }} />
                        </div>

                        <div class="col-12">
                            <label for="direccion_sede" class="col-12 text_label-formInst"> Dirrección </label>
                            <input class="form-control" id="direccion_sede" placeholder="Dirección" type="text" name="direccion_sede" {{ ($count_sedes >= 6) ? 'disabled' : '' }} />
                        </div>

                        <div class="col-12">
                            <label for="horario_sede" class="col-12 text_label-formInst"> Horario </label>
                            <input class="form-control" id="horario_sede" placeholder="Horario" type="text" name="horario_sede" {{ ($count_sedes >= 6) ? 'disabled' : '' }} />
                        </div>
                        <div class="col-12">
                            <label for="telefono_sede" class="col-12 text_label-formInst"> Teléfono </label>
                            <input class="form-control" id="telefono_sede" placeholder="Número de teléfono" type="text" name="telefono_sede" {{ ($count_sedes >= 6) ? 'disabled' : '' }} />
                        </div>
                        <div class="col-12">
                            <label for="url_mapa_sede" class="col-12 text_label-formInst"> Url ubicación sede (Google Map) </label>
                            <input class="form-control" id="url_mapa_sede" placeholder="Url" type="text" name="url_mapa_sede" {{ ($count_sedes >= 6) ? 'disabled' : '' }} />
                        </div>
                    </div>
                </div>
                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst mt-0" id="btn-guardar-sede-institucion" {{ ($count_sedes >= 6) ? 'disabled' : '' }}
                    data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                        Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="flechaBtn_guardar-formInst">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 10 decima parte del formulario *** SEDES ***      ------------------------------------------------------------->

        <!--------------------------------------------      Inicio 11 onceava parte del formulario *** UBIQUE LA SEDE ***      -------------------------------------------->
        <div class="col-lg-10 col-xl-8 content_tarjetasInfo-formInst">
            <h5 class="col-lg-12 icon_ubiqueSede-formInst"> Ubique la sede principal</h5>
            <div id="mensajes-ubicacion-institucion"></div>
            <form method="POST" action="{{ route('entidad.create11') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-ubicaion-institucion">
                @csrf
                <div class="col-12 px-0">
                    <label for="url_map_principal_institucion" class="text_superior-proced-formInst"> A continuación enlace las sedes en Google Maps. </label>
                    <input class="form-control" id="url_map_principal_institucion" placeholder="https://www.google.com/maps/embed?pb=....." type="text" name="url_map_principal_institucion" />
                </div>
                <div class="col-12 px-0 {{ empty($objFormulario->url_maps) ? 'd-none' : '' }}">
                    <iframe src="{{$objFormulario->url_maps}}" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" id="map_principal_institucion"></iframe>
                </div>
                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst" id="btn-guardar-ubicacion-institucion"
                            data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                        Guardar
                        <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 11 onceava parte del formulario *** UBIQUE LA SEDE ***      --------------------------------------------------->

        <!-- Secciones de los botones anterior y siguiente -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="venuesInst">
                    <img src="{{asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <button type="submit" class="boton_inferior-siguiente-formInst" onclick="hideBtnNext(this)" code-position="venuesInst"> Siguiente
                    <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flechaBtn_guardar-formInst" alt="">
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
            <div class="premios_guardada-formProf" id="lista-galeria-intitucion">
                <?php $count_galeria = 0; ?>
            @foreach($objGaleria as $galeria)
                @if(!empty($galeria->nombrefoto))
                    <?php $count_galeria++; ?>
                    <!-- Contenido GALERIA -->
                        <div class="savedData_formInst">
                            <div class="col-12 content_btnDelet-trata-formProf">
                                <button type="submit" class="close" aria-label="Close" data-url="{{ route('entidad.delete12', ['id' => $galeria->id_galeria ]) }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="col-12 mt-2 p-0">
                                <div class="img_saveSede-formInst">
                                    <img  class="img_anexada-formInst" src="{{ asset($galeria->imggaleria) }}">
                                </div>
                                <div class="col-12 text_label-formInst">
                                    <label class="col-12 title_infoGuardada-formProf"> {{ $galeria->fechagaleria }} </label>
                                </div>
                                <div class="col-12 text_label-formInst">
                                    <label class="col-12 title_infoGuardada-formProf"> {{ $galeria->nombrefoto }} </label>
                                </div>
                                <div class="col-12 descripcion_Premio-formProf">
                                    <label class="col-12 text_descPremio-formProf"> {{ $galeria->descripcion }} </label>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form  action="{{ route('entidad.create12') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="form-galeria-institucion">
                @csrf
                <div id="mensajes-galeria">
                    @if($count_galeria >= 8)
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Hecho!</h4>
                            <p>Ya tienes el máximo de fotos</p>
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 photo1 leftSection_formInst content_antes-formInst">
                        <div class="col-12 leftSection_formInst">
                            <div class="img_saveCertifi-formInst">
                                <img class="img_anexada-formInst" id="img-img_galeria_institucion">
                            </div>
                            <div class="agregar_archivo-formInst">
                                <input type='file' id="img_galeria_institucion" name="img_galeria_institucion" onchange="ver_imagen('img_galeria_institucion', 'img-img_galeria_institucion');" {{ ($count_galeria >= 8) ? 'disabled' : '' }}/>
                            </div>
                            <div class="txt_informativo-formInst">
                                <label class="col-12 text_infoImg-formInst"> Tamaño 400 x 400px. Peso máximo 500kb </label>
                            </div>
                        </div>

                        <div class="col-12 leftSection_formInst">
                            <label for="fecha_galeria_institucion" class="col-12 text_label-formInst"> Fecha </label>
                            <input class="form-control" type="date"  id="fecha_galeria_institucion" name="fecha_galeria_institucion" {{ ($count_galeria >= 8) ? 'disabled' : '' }} />
                        </div>
                        <div class="col-12 leftSection_formInst">
                            <label for="nombre_galeria_institucion" class="col-12 text_label-formInst"> Título de la imagen 1 </label>
                            <input class="form-control" id="nombre_galeria_institucion" placeholder="Título de la imagen" type="text" name="nombre_galeria_institucion" {{ ($count_galeria >= 8) ? 'disabled' : '' }} />
                        </div>
                        <div class="col-12 leftSection_formInst">
                            <div class="form-group">
                                <label for="descripcion_galeria_institucion" class="col-12 text_label-formInst"> Descripción </label>
                                <input class="form-control" id="descripcion_galeria_institucion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion_galeria_institucion" {{ ($count_galeria >= 8) ? 'disabled' : '' }} />
                                <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Botón guardar información -->
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst mt-0" id="btn-guardar-galeria-institucion" {{ ($count_galeria >= 8) ? 'disabled' : '' }}
                    data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                        Guardar
                        <img src=" {{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="flechaBtn_guardar-formInst" alt="">
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
            <div class="col-12 p-0 m-0" id="lista-videos-institucion">
                <?php $count_videos = 0 ;?>
            @foreach($objVideo as $video)
                @if(!empty($video->nombrevideo))
                    <!-- Contenido VIDEOS -->
                        <?php $count_videos = 0 ;?>
                        <div class="section_infoExper-formInst">
                            <div class="col-12 content_cierreX-formInst">
                                <button type="submit" class="close" aria-label="Close" data-url="{{ route('entidad.delete13', ['id' => $video->id]) }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="col-12 my-2">
                                <div class="col-10 img_selccionada-formProf">
                                    <iframe class="img_anexada-formProf" src="{{ $video->urlvideo }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>

                                <div class="col-12 p-0 mt-2">
                                    <label class="col-12 text_fechaPremio-formProf"> {{ $video->fechavideo }} </label>
                                </div>

                                <div class="col-12 text_label-formInst">
                                    <label class="col-12 title_infoGuardada-formProf"> {{ $video->nombrevideo }} </label>
                                </div>

                                <div class="col-12 descripcion_Premio-formProf">
                                    <p class="col-12 text_descPremio-formProf"> {{ $video->descripcionvideo }} </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ route('entidad.create13') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-videos-institucion">
                @csrf
                <div id="mensajes-videos">
                    @if($count_videos >= 4)
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Hecho!</h4>
                            <p>Ya tienes el máximo de videos</p>
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 leftSection_formInst content_antes-formInst">
                        <div class="col-12 leftSection_formInst">
                            <label for="url_video_institucion" class="col-12 text_label-formInst"> Url video</label>
                            <input class="form-control" id="url_video_institucion"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="url_video_institucion" {{ ($count_videos >= 4) ? 'disabled' : '' }} />
                        </div>
                        <div class="col-12 leftSection_formInst">
                            <label for="fecha_video_institucion" class="col-12 text_label-formInst"> Fecha </label>
                            <input class="form-control" type="date"  id="fecha_video_institucion" name="fecha_video_institucion" {{ ($count_videos >= 4) ? 'disabled' : '' }} />
                        </div>
                        <div class="col-12 leftSection_formInst">
                            <label for="nombre_video_institucion" class="col-12 text_label-formInst"> Título video </label>
                            <input class="form-control" id="nombre_video_institucion" placeholder="Título video" type="text" name="nombre_video_institucion" {{ ($count_videos >= 4) ? 'disabled' : '' }} />
                        </div>
                        <div class="col-12 leftSection_formInst">
                            <div class="form-group">
                                <label for="descripcion_video_institucion" class="col-12 text_label-formInst"> Descripción video </label>
                                <input class="form-control" id="descripcion_video_institucion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion_video_institucion" {{ ($count_videos >= 4) ? 'disabled' : '' }} />
                                <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 content_btnEnviar-formInst">
                    <button type="submit" class="btn2_enviar-formInst mt-0" id="btn-guardar-video-institucion" {{ ($count_videos >= 4) ? 'disabled' : '' }}
                    data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}...">
                        Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="flechaBtn_guardar-formInst" alt="">
                    </button>
                </div>
            </form>
        </div>
        <!--------------------------------------------      Fin 13 treceava parte del formulario *** VIDEOS ***      ---------------------------------------------------------->

        <!-- Secciones de los botones anterior y finalizar -->
        <div class="col-lg-10 col-xl-8 content_botonesInferiores-formInst">
            <div class="col-md-3 content_btn-anter-formInst">
                <button type="submit" class="boton_inferior-anterior-formInst" onclick="hideBtnPrevious(this)" code-position="galleryInst">
                    <img src="{{ asset('/img/formulario-profesional/icono-flecha-gris.svg') }}" class="flechaBtn_guardar-formInst" alt="">
                    Anterior
                </button>
            </div>

            <div class="col-md-3 content_btn-siguient-formInst">
                <a type="submit" class="boton_inferior-finalizar-formInst" href="{{ route('PerfilInstitucion', ['slug' => $objFormulario->slug]) }}"> Finalizar
                    <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="flechaBtn_finalizar-formInst" alt="">
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--<script data-pace-options='{ "ajax": false, "document": true, "eventLag": false, "elements": false}' src="{{ asset('plugins/pace/pace.min.js') }}"></script> -->

    <script src="{{ asset('js/formulario-intitucional.js') }}"></script>

    <script src="{{ asset('js/selectareas.js') }}"></script>
    <script src="{{ asset('js/cargaFoto.js') }}"></script>

    <script>
        // Pace.on("done", function() {
        //     $('#page_overlay').delay(300).fadeOut(600);
        // });
    </script>
@endsection
