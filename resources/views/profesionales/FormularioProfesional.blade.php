@extends('layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet" />
    <!--<link rel="stylesheet" href="{{ asset('plugins/pace/themes/blue/pace-theme-loading-bar.css') }}"/>-->
@endsection

@section('content')
    <!-- Module line -->
    <ol  class="container_line_module_form">
        <div class="section_icon_form"> <!-- clase "section_icon_form" para evento ocultar y mostrar contenido de la opción. Ubicado en el archivo formularios.js -->
            <li class="iconAzul_datoPersonal dato-personal" onclick="containtHideOption(this)" data-position="personalData">
                <p>Datos personales</p>
            </li>
        </div>
        <div class="section_icon_form">
            <li class="iconGris_perfProf perfil-profesional" onclick="containtHideOption(this)" data-position="professionalProfile">
                <p>Perfil profesional</p>
            </li>
        </div>
        <div class="section_icon_form">
            <li class="iconGris_trataProced tratamiento-procedimiento" onclick="containtHideOption(this)" data-position="treatmentsProcedures">
                <p>Tratamientos y procedimientos</p>
            </li>
        </div>
        <div class="section_icon_form">
            <li class="iconGris_premioRecon premio-reconocimiento" onclick="containtHideOption(this)" data-position="AwardsHonours">
                <p>Premios y reconocimientos</p>
            </li>
        </div>
        <div class="section_icon_form">
            <li class="iconGris_public publicacion" onclick="containtHideOption(this)" data-position="publicationsFormProf">
                <p>Publicaciones</p>
            </li>
        </div>

        <div class="section_icon_form">
            <li class="iconGris_galeriaVideo galeria-video" onclick="containtHideOption(this)" data-position="galleryFormProf">
                <p>Galería</p>
            </li>
        </div>
    </ol>

    <!-- Warning message -->
    @if(!empty($objTiempoRestante))
        @if($objTiempoRestante->dias_transcurrido <=15)
            <p class="alert-message"> Quedan {{$objTiempoRestante->dias_transcurrido}} días </p>
        @endif
    @endif

    <!-- 1. PERSONAL INFORMATION -->
    <div class="container_module_form personal_data">
        <div class="title_main_form">
            <h5>LE DAMOS LA BIENVENIDA A ZAABRA SALUD</h5>
            <p>Ingrese los datos según corresponda y finalice el proceso completamente en línea.</p>
        </div>

        <!-- 1.1 Basic information -->
        <div class="card_module_form">
            <h5 class="icon_text icon_basicInfo_formProf">Información básica</h5>
            <div id="msg_basico"></div>

            <form id="formulario_basico" method="POST" action="javascript:void(0)" enctype="multipart/form-data" accept-charset="UTF-8" class="pb-2">
                @csrf
                <div class="row m-0 py-3 px-0">
                    <div class="col-md-3 img_user_form"> <!-- User image -->
                        <img id="imagenPrevisualizacion" src="{{ (isset($objFormulario->fotoperfil)) ? asset($objFormulario->fotoperfil) : '' }}">
                        <input type="file" name="logo"  id="seleccionArchivos" accept="image/png, image/jpeg" value="{{$objFormulario->fotoperfil}}">
                        <p>Subir foto de perfil</p>
                    </div>

                    <div class="col-md-9 line_vertical_form"> <!-- Personal information -->
                        <div class="row m-0">
                            <div class="col-lg-6 p-0 pr-lg-1">
                                <label for="example-date-input" class="label_txt_form">Nombres</label>
                                <div class="section_input_double_form">
                                    <input class="input_box_form mb-2 mb-md-0 mr-md-1" value="{{ (isset($objuser->primernombre)) ? $objuser->primernombre : '' }}" name="primernombre"/>
                                    <input class="input_box_form ml-md-1" value="{{ (isset($objuser->segundonombre)) ? $objuser->segundonombre : '' }}" name="segundonombre"/>
                                </div>
                            </div>

                            <div class="col-lg-6 p-0 pl-lg-1">
                                <label for="example-date-input" class="label_txt_form">Apellidos</label>
                                <div class="section_input_double_form">
                                    <input class="input_box_form mb-2 mb-md-0 mr-md-1" value="{{ (isset($objuser->primerapellido)) ? $objuser->primerapellido : '' }}" name="primerapellido"/>
                                    <input class="input_box_form ml-md-1" value="{{ (isset($objuser->segundoapellido)) ? $objuser->segundoapellido : '' }}" name="segundoapellido"/>
                                </div>
                            </div>

                            <div class="col-md-6 p-0 pr-md-1">
                                <label for="example-date-input" class="label_txt_form">Fecha de nacimiento</label>
                                <input class="input_box_form" type="date" value="{{$objFormulario->fechanacimiento}}" id="fechanacimiento" name="fechanacimiento">
                            </div>

                            <div class="col-md-6 p-0 pl-md-1">
                                <label for="idarea" class="label_txt_form">Selecione área</label>
                                <select id="idarea" name="idarea" class="input_box_form">
                                    <option></option>
                                    @foreach($area as $a)
                                        <option value="{{ $a->idArea}}" {{ (isset($objFormulario->idarea) && $a->idArea == $objFormulario->idarea) ? 'selected' : '' }}> {{$a->nombreArea}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 p-0 pr-md-1">
                                <label for="idprofesion" class="label_txt_form">Selecione profesión</label>
                                <select id="idprofesion" name="idprofesion" class="input_box_form">
                                    @foreach($profesiones as $profesion)
                                        <option value="{{$profesion->idProfesion}}" {{ (isset($objFormulario->idprofesion) && $profesion->idProfesion == $objFormulario->idprofesion) ? 'selected' : '' }}> {{$profesion->nombreProfesion}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 p-0 pl-md-1">
                                <label for="idespecialidad" class="label_txt_form">Seleccione especialidad</label>
                                <select id="idespecialidad" name="idespecialidad" class="input_box_form">
                                    @foreach($especialidades as $especialidad)
                                        <option value="{{$especialidad->idEspecialidad}}" {{ (isset($objFormulario->idEspecialidad) && $especialidad->idEspecialidad == $objFormulario->idEspecialidad) ? 'selected' : '' }}> {{$especialidad->nombreEspecialidad}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 p-0 pr-md-1">
                                <label for="id_universidad" class="label_txt_form">Selecione universidad</label>
                                <select id="id_universidad" name="id_universidad" class="input_box_form universidades">
                                    @if(isset($objFormulario->id_universidad))
                                        <option value="{{$objFormulario->id_universidad}}" selected>{{$objFormulario->nombreuniversidad}}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-6 p-0 pl-md-1">
                                <label for="tarjeta" class="label_txt_form">Tarjeta profesional</label>
                                <input class="input_box_form" id="tarjeta" placeholder="Número de tarjeta" type="number" name="numeroTarjeta" value="{{$objFormulario->numeroTarjeta}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section_button_form">  <!-- Save button -->
                    <button type="submit" class="button_blue_form" id="envia_basico" data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}...">Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 1.2 Contac information -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoContac_Prof">Información de contacto</h5>
            <div id="msg_contacto"></div>

            <form id="formulario_contacto" method="POST" action="javascript:void(0)"  enctype="multipart/form-data" accept-charset="UTF-8" class="pb-2">
                @csrf
                <div class="row m-0 py-3 px-0">
                    <div class="col-md-6 p-0 pr-md-1">
                        <label for="celular" class="label_txt_form">Celular</label>
                        <input class="input_box_form" id="celular" value="{{ (isset($objFormulario->celular)) ? $objFormulario->celular : '' }}" type="number" name="celular" required >
                    </div>

                    <div class="col-md-6 p-0 pl-md-1">
                        <label for="telefono" class="label_txt_form">Teléfono</label>
                        <input class="input_box_form" id="telefono" value="{{ (isset($objFormulario->telefono)) ? $objFormulario->telefono : '' }}" type="number" name="telefono" >
                    </div>

                    <div class="col-md-6 p-0 pr-md-1">
                        <label for="direccion" class="label_txt_form">Dirección</label>
                        <input class="input_box_form" id="direccion" value="{{ (isset($objFormulario->direccion)) ? $objFormulario->direccion : '' }}" type="text" name="direccion" required>
                    </div>

                    <div class="col-md-6 p-0 pl-md-1"> <!--menu dinamico ciudades -->
                        <label for="idpais" class="label_txt_form">Seleccione país</label>
                        <select id="idpais" name="idpais" class="input_box_form">
                            @foreach($listaPaises as $pais)
                                <option value="{{ $pais->id_pais }}"  {{ (isset($objFormulario->id_pais) && $objFormulario->id_pais == $pais->id_pais) ? 'selected' : ''}}> {{ $pais->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 p-0 pr-md-1">
                        <label for="id_departamento" class="label_txt_form">Selecione departamento</label>
                        <select name="id_departamento" id="id_departamento" class="input_box_form">
                            @foreach($listaDepartamentos as $departamento)
                                <option value="{{ $departamento->id_departamento }}"  {{ (isset($objFormulario->id_departamento) && $objFormulario->id_departamento == $departamento->id_departamento) ? 'selected' : ''}}> {{ $departamento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 p-0 pl-md-1">
                        <label for="id_provincia" class="label_txt_form">Seleccione provincia</label>
                        <select name="id_provincia" id="id_provincia" class="input_box_form">
                            @foreach($listaProvincias as $provincia)
                                <option value="{{ $provincia->id_provincia }}"  {{ (isset($objFormulario->id_provincia) && $objFormulario->id_provincia == $provincia->id_provincia) ? 'selected' : ''}}> {{ $provincia->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 p-0 pr-md-1">
                        <label for="id_municipio" class="label_txt_form">Seleccione ciudad</label>
                        <select name="id_municipio" id="id_municipio" class="input_box_form">
                            @foreach($listaMunicipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}"  {{ (isset($objFormulario->id_municipio) && $objFormulario->id_municipio == $municipio->id_municipio) ? 'selected' : ''}}> {{ $municipio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="section_button_form">  <!-- Save button -->
                    <button type="submit" class="button_blue_form" id="envia_contacto" data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}...">Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 1.3 Medical consultation information -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoConsult_Prof mb-3">Información consulta</h5>

            <div class="content_information_saved_form" id="consultas-lista">
                <?php $count_consultas = 0; ?>
                @foreach($objConsultas as $objConsultas)
                    @if(!empty($objConsultas->nombreconsulta))
                        <?php $count_consultas++; ?>
                        <div class="card_information_saved_form">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $objConsultas->id }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="data_saved_form border-top-0">
                                <h5 class="col-12">Tipo de consulta</h5>
                                <span class="col-12">{{$objConsultas->nombreconsulta}}</span>
                            </div>

                            <div class="data_saved_form">
                                <h5 class="col-12"> Valor consulta </h5>
                                <span class="col-12">{{$objConsultas->valorconsulta}}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div id="mensaje-consulta"> <!-- Alert message -->
                @if($count_consultas >= 3 )
                    <div class="alert alert-success mb-2" role="alert">
                        <h4 class="alert-heading">Hecho!</h4>
                        <p>Ya tienes el máximo de consultas</p>
                    </div>
                @endif
            </div>

            <form id="formulario_consulta" method="POST" action="javascript:void(0)"  enctype="multipart/form-data" accept-charset="UTF-8" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 p-0 pr-md-1">
                        <label for="tipo_consulta" class="label_txt_form">Tipo consulta</label>
                        <select id="tipo_consulta" class="input_box_form" name="tipo_consulta" {{ ($count_consultas >= 3 ) ? 'disabled' : '' }}>
                            <option></option>
                            <option value="Presencial">Presencial</option>
                            <option value="Virtual">Virtual</option>
                            <option value="Control">Control</option>
                        </select>
                    </div>

                    <div class="col-md-6 p-0 pl-md-1">
                        <label for="valor_consulta" class="label_txt_form">Valor</label>
                        <input type="number" min="0" class="input_box_form" id="valor_consulta" name="valor_consulta" {{ ($count_consultas >= 3 ) ? 'disabled' : '' }}>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button id="envia_consultas" type="submit" class="button_blue_form" {{ ($count_consultas >= 3 ) ? 'disabled' : '' }} data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 1.14 Featured in -->
        <div class="card_module_form">
            <h5 class="icon_text icon_destacado_Prof">Destacado en</h5>

            <form id="formulario_destacado" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" class="pb-2" >
                @csrf
                <div class="row m-0 py-3 px-0">
                    <div class="content_dest_list" id="destacado-lista">
                        <?php $destacables_count = 0;?>
                        @foreach($destacables as $destacable)
                            <?php $destacables_count++;?>
                            <div class="section_dest_list alert alert-info alert-dismissible fade show delete-destacable" role="alert" >
                                <strong>{{ $destacable->nombreExpertoEn }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-id="{{ $destacable->id_experto_en }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-12" id="destacado-mensaje">
                        @if($destacables_count >= 9 )
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Hecho!</h4>
                                <p>Ya tienes el máximo de temas</p>
                            </div>
                        @endif
                    </div>

                    <div class="col-12 p-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Ingrese el tema" name="destacado_nombre" id="destacado_nombre" {{ ($destacables_count >= 9 ) ? 'disabled' : ''}}>
                            <button class="btn btn-primary" type="submit" id="destacado_nombre_btn" {{ ($destacables_count >= 9 ) ? 'disabled' : ''}} data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}..."> Guardar
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- 1.15 Recover password -->
        <div class="card_module_form">
          <h5 class="icon_text icon_basicInfo_formProf">Actualizar contraseña</h5>

            <form action="{{ route('profesional.formulario-password') }}" id="form-password-profesional" method="post" class="pb-2">
                <div id="mensajes-password"></div>

                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 p-0 pr-md-1"> <!-- Current password -->
                        <label for="password" class="label_txt_form">{{ __('paciente.contraseña-actual') }}</label>
                        <input id="password" class="input_box_form" type="password" name="password" />
                    </div>

                    <div class="col-md-6 p-0 pl-md-1"> <!-- New password -->
                        <label for="password_new" class="label_txt_form">{{ __('paciente.contraseña-nueva') }}</label>
                        <input id="password_new" class="input_box_form" type="password" name="password_new" />
                    </div>

                    <div class="col-md-6 p-0 pr-md-1"> <!-- Repeat password -->
                        <label for="password_new_confirmation" class="label_txt_form">{{ __('paciente.contraseña-repetir') }}</label>
                        <input id="password_new_confirmation" class="input_box_form" type="password" name="password_new_confirmation" />
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button class="button_blue_form" id="btn-guardar-password-profesional" data-text="{{ __('paciente.guardar') }}" data-text-loading="{{ __('paciente.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- Next button -->
        <div class="container_button_form">
            <div class="section_button_form">
                <button type="submit" class="button_green_form" onclick="btnHideNext(this)" code-position="personalData"> Siguiente
                    <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                </button>
            </div>
        </div>
    </div>

    <!-- 2. PROFESSIONAL PROFILE -->
    <div class="container_module_form professional_profile">
        <!-- 2.4 Professional profile -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoSubPerfil_Prof mb-3">Perfil profesional</h5>
            <div id="mensaje-perfil-profesional"></div>

            <form id="formulario_descripcion" method="post" action="javascript:void(0)" enctype="multipart/form-data" accept-charset="UTF-8" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-12 px-0">
                        <h5 for="descripcion_perfil" class="textTop_informative_form">Escriba una breve descripción de su biografía.</h5>
                        <textarea class="textarea_form" id="descripcion_perfil"  type="text" cols="30" rows="10" maxlength="270" name="descripcion_perfil">{{ (!empty($objFormulario->descripcionPerfil)) ? $objFormulario->descripcionPerfil : '' }}</textarea>

                        <p class="text_informative_form">270 Caracteres</p>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" id="btn-guardar-perfil-profesional" class="button_blue_form" data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 2.5 Education -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoEduc_Prof mb-3">Educación</h5>
            <div id="mensaje-estudios"></div>

            <div class="content_information_saved_form" id="estudios-lista">
                <?php $count_estudios = 0; ?>
                @foreach($objEducacion as $educacion)
                    @if(!empty($educacion->nombreuniversidad))
                        <?php $count_estudios++; ?>
                        <div class="card_information_saved_form">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $educacion->id_universidadperfil }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="image_saved_form">
                                <img id="imagenPrevisualizacion" src="{{URL::asset($educacion->logo_universidad)}}">
                            </div>

                            <div class="data_saved_form">
                                <h5>Fecha de finalización</h5>
                                <span>{{$educacion->fechaestudio}}</span>
                            </div>

                            <div class="data_saved_form">
                                <h5>Universidad</h5>
                                <span>{{$educacion->nombreuniversidad}}</span>
                            </div>

                            <div class="data_saved_form">
                                <h5>Disciplina académica</h5>
                                <span>{{$educacion->nombreestudio}}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form action="{{ url ('/FormularioProfesionalSave5') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_estudios" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 px-0 align-self-end">
                        <div class="upload_file_img_form">
                            <img class="imagenPrevisualizacion" id="imagen-universidad">
                            <input type="file" id="logo_universidad" name="logo_universidad" onchange="ver_imagen('logo_universidad', 'imagen-universidad');">
                            <p style="width: 12.5em;">Subir logo universidad</p>
                        </div>

                        <p class="text_informative_form text-center"> Tamaño 225px x 225px. Peso máximo 400kb </p>
                    </div>

                    <div class="col-md-6 p-0">
                        <label for="universidad_estudio" class="label_txt_form">Selecione universidad</label>
                        <select  class="input_box_form universidades" name="universidad_estudio" id="universidad_estudio" {{ ($count_estudios >= 3) ? 'disabled' : '' }}>
                            <option></option>
                        </select>

                        <label for="fecha_estudio" class="label_txt_form">Fecha de finalización</label>
                        <input class="input_box_form" type="date" value="2011-08-19" id="fecha_estudio" name="fecha_estudio" {{ ($count_estudios >= 3) ? 'disabled' : '' }}>

                        <label for="disciplina_estudio" class="label_txt_form">Disciplina académica</label>
                        <input class="input_box_form" id="disciplina_estudio" type="text" name="disciplina_estudio" {{ ($count_estudios >= 3) ? 'disabled' : '' }}>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_blue_form" id="boton-enviar-estudios" {{ ($count_estudios >= 3) ? 'disabled' : '' }} data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 2.6 Job experienses -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoExper_Prof mb-3">Experiencia Laboral</h5>
            <div id="mensaje-experiencia"></div>

            <div class="content_information_saved_form" id="experiencia-lista">
                <?php $count_experiencia = 0;?>
                @foreach($objExperiencia as $experiencia)
                    @if(!empty($experiencia->nombreEmpresaExperiencia))
                        <?php $count_experiencia++;?>
                        <div class="card_information_saved_form">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $experiencia->idexperiencias }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="image_saved_form">
                                <img id="imagenPrevisualizacion" class="logo_univ_LInst" src="{{URL::asset($experiencia->imgexperiencia)}}">
                            </div>

                            <div class="data_saved_form">
                                <h5> Nombre de la empresa </h5>
                                <span> {{$experiencia->nombreEmpresaExperiencia}} </span>
                            </div>

                            <div class="data_saved_form">
                                <h5> Descripción de la experiencia </h5>
                                <span> {{$experiencia->descripcionExperiencia}} </span>
                            </div>

                            <div class="data_saved_form">
                                <h5> Fecha de inicio experiencia </h5>
                                <span> {{$experiencia->fechaInicioExperiencia}} </span>
                            </div>

                            <div class="data_saved_form">
                                <h5> Fecha de finalización experiencia </h5>
                                <span> {{$experiencia->fechaFinExperiencia}} </span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave6') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_experiencia" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0" id="listas">
                    <div class="col-md-6 px-0 align-self-end">
                        <div class="upload_file_img_form">
                            <img class="imagenPrevisualizacion" id="imagen-experiencia">
                            <input type="file" id="logo_experiencia" name="logo_experiencia" onchange="ver_imagen('logo_experiencia', 'imagen-experiencia');">
                            <p>Subir logo entidad</p>
                        </div>

                        <p class="text_informative_form text-center"> Tamaño 225px x 225px. Peso máximo 400kb </p>
                    </div>

                    <div class="col-md-6 p-0">
                        <label for="nombre_empresa" class="label_txt_form">Empresa</label>
                        <input class="input_box_form" id="nombre_empresa"  type="text" name="nombre_empresa" {{ ($count_experiencia >= 4 ) ? 'disabled' : '' }}>

                        <label for="descripcion_experiencia" class="label_txt_form">Cargo</label>
                        <input class="input_box_form" id="descripcion_experiencia"  type="text" name="descripcion_experiencia" {{ ($count_experiencia >= 4 ) ? 'disabled' : '' }}>

                        <label for="inicio_experiencia" class="label_txt_form">Fecha de inicio</label>
                        <input class="input_box_form" type="date"  id="inicio_experiencia" name="inicio_experiencia" {{ ($count_experiencia >= 4 ) ? 'disabled' : '' }}>

                        <label for="fin_experiencia" class="label_txt_form">Fecha de terminación</label>
                        <input class="input_box_form" type="date"  id="fin_experiencia" name="fin_experiencia" {{ ($count_experiencia >= 4 ) ? 'disabled' : '' }}>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_blue_form" id="boton-guardar-experiencia" {{ ($count_experiencia >= 4 ) ? 'disabled' : '' }} data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 2.7 Associations -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoAsocia_Prof mb-3">Asociaciones</h5>
            <div id="mensajes-asociacion"></div>

            <div class="content_information_saved_form" id="lista-asociacion">
                <?php $count_asociaciones = 0;?>
                @foreach($objAsociaciones as $asociacion)
                    @if(!empty($asociacion->imgasociacion))
                        <?php $count_asociaciones++;?>
                        <div class="card_information_saved_form">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $asociacion->idAsociaciones }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="image_saved_form">
                                <img id="imagenPrevisualizacion" src="{{URL::asset($asociacion->imgasociacion)}}">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave7') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_asociacion" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 px-0">
                        <div class="upload_file_img_form">
                            <img class="imagenPrevisualizacion" id="img-asociacion"/>
                            <input type='file' id="imagenAsociacion" name="imagenAsociacion" onchange="ver_imagen('imagenAsociacion', 'img-asociacion');" {{ ($count_asociaciones >= 3 ) ? 'disabled' : '' }}/>
                            <p>Subir logo entidad</p>
                        </div>

                        <p class="text_informative_form text-center">Tamaño 120px x 60px. Peso máximo 300kb</p>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_blue_form" id="boton-guardar-asociacion" {{ ($count_asociaciones >= 3 ) ? 'disabled' : '' }} data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 2.8 Languages -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoIdioma_Prof mb-3">Idiomas</h5>
            <div id="mensaje-idioma"></div>

            <div class="content_information_saved_form" id="lista-idioma">
                <?php $count_idiomas = 0; ?>
                @foreach($objIdiomas as $idioma)
                    @if(!empty($idioma->imgidioma))
                        <?php $count_idiomas++; ?>
                        <div class="card_information_saved_form">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $idioma->idUsuarioIdiomas }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="flag_saved_form">
                                <img id="imagenPrevisualizacion" src="{{URL::asset($idioma->imgidioma)}}">
                                <label for="example-date-input" class="label_txt_form"> {{$idioma->nombreidioma}}</label>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave8') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_idioma" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 px-0">
                        <label for="idioma" class="label_txt_form"> Seleccione idioma </label>
                        <select  class="input_box_form" name="idioma" id="idioma" {{ ($count_idiomas >= 3) ? 'disabled' : '' }}>
                            <option value=" "> Seleccione </option>
                            @foreach($idiomas as $idioma)
                                <option value="{{$idioma->id_idioma}}"> {{$idioma->nombreidioma}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_blue_form" id="boton-guardar-idioma"  {{ ($count_idiomas >= 3) ? 'disabled' : '' }} data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- Previous and next buttons -->
        <div class="container_button_form">
            <div class="section_button_form justify-content-between">
                <button type="submit" class="button_transparent_form" onclick="btnHidePrevious(this)" code-position="professionalProfile">
                    <img src="{{ asset('/img/formulario-profesional/icono-flecha-gris.svg') }}" class="pr-2">Anterior
                </button>

                <button type="submit" class="button_green_form" onclick="btnHideNext(this)" code-position="professionalProfile">Siguiente
                    <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                </button>
            </div>
        </div>
    </div>

    <!-- 3. TREATMENTS AND PROCEDURES -->
    <div class="container_module_form treatments_procedures">
        <!-- 3.9 Treatments and procedures -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoTratam_Prof mb-3"> Tratamientos y procedimientos </h5>
            <h5 class="textTop_informative_form"> A continuación suba imágenes con respecto a los procedimientos y tratamientos, con su título y descripción. </h5>

            <div class="content_information_saved_form" id="lista-tratamientos">
                {{--<?php $count_tratamientos = 0; ?>--}}
                @foreach($objTratamiento as $objTratamiento)
                    @if(!empty($objTratamiento->imgTratamientoAntes))
                        {{-- <?php $count_tratamientos++; ?> --}}
                        <div class="card_contentDouble_form">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-id="{{$objTratamiento->id_tratamiento}}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="col-md-6 p-0 pr-md-3">  <!-- Content before -->
                                <h5 class="label_txt_form text-center mb-2">Antes</h5>

                                <div class="image_preview_form">
                                    <img src="{{ asset($objTratamiento->imgTratamientoAntes)}}">
                                </div>

                                <div class="text_preview_form">
                                    <h5>{{$objTratamiento->tituloTrataminetoAntes}}</h5>
                                    <p>{{$objTratamiento->descripcionTratamientoAntes}}</p>
                                </div>
                            </div>

                            <div class="col-md-6 p-0 pl-md-3 line_vertical_form"> <!-- Content after -->
                                <h5 class="label_txt_form text-center mb-2">Después</h5>

                                <div class="image_preview_form">
                                    <img src="{{ asset($objTratamiento->imgTratamientodespues)}} ">
                                </div>

                                <div class="text_preview_form">
                                    <h5>{{$objTratamiento->tituloTrataminetoDespues}}</h5>
                                    <p>{{$objTratamiento->descripcionTratamientoDespues}}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div id="mensajes-tratamientos">
{{--                @if($count_tratamientos >= 2 )--}}
{{--                    <div class="alert alert-success" role="alert">--}}
{{--                        <h4 class="alert-heading">Hecho!</h4>--}}
{{--                        <p>Ya tienes el máximo de tratamientos</p>--}}
{{--                    </div>--}}
{{--                @endif--}}
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave9') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_tratamiento" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 p-0 pr-md-3"> <!-- Content before -->
                        <h5 class="label_txt_form text-center mb-2">Antes</h5>

                        <div class="col-12 px-0">
                            <div class="upload_file_img_form">
                                <img class="imagenPrevisualizacion" id="imagen-tratamiento-antes"/>
                                <input type='file' id="imgTratamientoAntes" name="imgTratamientoAntes" onchange="ver_imagen('imgTratamientoAntes', 'imagen-tratamiento-antes');" {{-- ($count_tratamientos >= 2) ? 'disabled' : '' --}}/>
                                <p style="width: 11em;">Subir imagen antes</p>
                            </div>

                            <p class="text_informative_form text-center"> Tamaño 225px x 225px. Peso máximo 400kb </p>
                        </div>

                        <label for="tituloTrataminetoAntes" class="label_txt_form"> Título de la imagen antes </label>
                        <input class="input_box_form" id="tituloTrataminetoAntes" placeholder="Título de la imagen" type="text" name="tituloTrataminetoAntes" {{-- ($count_tratamientos >= 2) ? 'disabled' : '' --}}>

                        <label for="descripcionTratamientoAntes" class="label_txt_form"> Descripción antes </label>
                        <input class="input_box_form" id="descripcionTratamientoAntes" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionTratamientoAntes" {{-- ($count_tratamientos >= 2) ? 'disabled' : '' --}}>

                        <p class="text_informative_form">160 Caracteres</p>
                    </div>

                    <div class="col-md-6 p-0 pl-md-3 line_vertical_form"> <!-- Content after -->
                        <h5 class="label_txt_form text-center mb-2">Después</h5>
                        <div class="col-12 px-0">
                            <div class="upload_file_img_form">
                                <img class="imagenPrevisualizacion" id="imagen-tratamiento-despues"/>
                                <input type='file' id="imgTratamientodespues" name="imgTratamientodespues" onchange="ver_imagen('imgTratamientodespues', 'imagen-tratamiento-despues');" {{-- ($count_tratamientos >= 2) ? 'disabled' : '' --}}/>
                                <p style="width: 12.5em;">Subir imagen después</p>
                            </div>

                            <p class="text_informative_form text-center"> Tamaño 225px x 225px. Peso máximo 400kb </p>
                        </div>

                        <label for="tituloTrataminetoDespues" class="label_txt_form"> Título de la imagen después </label>
                        <input class="input_box_form" id="tituloTrataminetoDespues" placeholder="Título de la imagen" type="text" name="tituloTrataminetoDespues" {{-- ($count_tratamientos >= 2) ? 'disabled' : '' --}}>

                        <label for="descripcionTratamientoDespues" class="label_txt_form"> Descripción después </label>
                        <input class="input_box_form" id="descripcionTratamientoDespues" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionTratamientoDespues" {{-- ($count_tratamientos >= 2) ? 'disabled' : '' --}}>

                        <p class="text_informative_form">160 Caracteres</p>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_blue_form" id="boton-guardar-tratamiento" data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- Previous and next buttons -->
        <div class="container_button_form">
            <div class="section_button_form justify-content-between">
                <button type="submit" class="button_transparent_form" onclick="btnHidePrevious(this)" code-position="treatmentsProcedures">
                    <img src="{{ asset('/img/formulario-profesional/icono-flecha-gris.svg') }}" class="pr-2">Anterior
                </button>

                <button type="submit" class="button_green_form" onclick="btnHideNext(this)" code-position="treatmentsProcedures"> Siguiente
                    <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                </button>
            </div>
        </div>
    </div>

    <!-- 4. AWARDS AND HONOURS -->
    <div class="container_module_form Awards_honours">
        <!-- 4.10 Awards and honours -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoPremReco_Prof mb-3">Premios y reconocimientos</h5>
            <h5 class="textTop_informative_form">A continuación suba imágenes relacionadas con sus premios y reconocimientos, con nombre y descripción.</h5>

            <div class="content_information_saved_form" id="lista-premios">
                <?php $counto_premios = 0; ?>
                @foreach($objPremios as $premios)
                    @if(!empty($premios->nombrepremio))
                        <?php $counto_premios++; ?>
                        <div class="card_information_saved_form width_card_single">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $premios->id }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="image_preview_form">
                                <img src="{{URL::asset($premios->imgpremio)}}">
                            </div>

                            <div class="text_preview_form">
                                <span> {{$premios->fechapremio}} </span>
                                <h5> {{$premios->nombrepremio}}  </h5>
                                <p> {{$premios->descripcionpremio}} </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div id="mensajes-premios">
                @if($counto_premios >= 4 )
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Hecho!</h4>
                        <p>Ya tienes el máximo de premios y reconocimientos</p>
                    </div>
                @endif
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave10') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_premio" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 px-0 align-self-end">
                        <div class="upload_file_img_form">
                            <img class="imagenPrevisualizacion" id="img-premio"/>
                            <input type='file' id="imgPremio" name="imgPremio" onchange="ver_imagen('imgPremio', 'img-premio');" {{ ($counto_premios >= 4) ? 'disabled' : '' }}/>
                            <p style="width: 11.5em;">Subir imagen premio</p>
                        </div>

                        <p class="text_informative_form text-center">Tamaño 356 x 326px. Peso máximo 300kb</p>
                    </div>

                    <div class="col-md-6 p-0">
                        <label for="fechaPremio" class="label_txt_form">Fecha de inicio</label>
                        <input class="input_box_form" type="date"  id="fechaPremio" name="fechaPremio" {{ ($counto_premios >= 4) ? 'disabled' : '' }}>

                        <label for="nombrePremio" class="label_txt_form">Título de la imagen 1</label>
                        <input class="input_box_form" id="nombrePremio" placeholder="Título de la imagen" type="text" name="nombrePremio" {{ ($counto_premios >= 4) ? 'disabled' : '' }}>

                        <label for="descripcionPremio" class="label_txt_form">Descripción del premio</label>
                        <input class="input_box_form" id="descripcionPremio" placeholder="Escribir descripción..." type="text"  maxlength="160" name="descripcionPremio" {{ ($counto_premios >= 4) ? 'disabled' : '' }}>

                        <p class="text_informative_form">160 Caracteres</p>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_blue_form" id="boton-guardar-premio" data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}...">Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- Previous and next buttons -->
        <div class="container_button_form">
            <div class="section_button_form justify-content-between">
                <button type="submit" class="button_transparent_form" onclick="btnHidePrevious(this)" code-position="AwardsHonours">
                    <img src="{{ asset('/img/formulario-profesional/icono-flecha-gris.svg') }}" class="pr-2">Anterior
                </button>

                <button type="submit" class="button_green_form" onclick="btnHideNext(this)" code-position="AwardsHonours">Siguiente
                    <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                </button>
            </div>
        </div>
    </div>

    <!-- 5. PUBLICATION -->
    <div class="container_module_form publications_formInst">
        <!-- 5.11 Publication -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoPublic_Prof mb-3">Publicaciones</h5>
            <h5 class="textTop_informative_form">A continuación suba imágenes de las publicaciones que ha realizado a lo largo de su experiencia.</h5>

            <div class="content_information_saved_form" id="lista-publicacion">
                <?php $count_publicaciones = 0;?>
                @foreach($Publicaciones as $publicacion)
                    @if(!empty($publicacion->nombrepublicacion))
                        <?php $count_publicaciones++;?>
                        <div class="card_information_saved_form width_card_single">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $publicacion->id }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="image_preview_form">
                                <img src="{{URL::asset($publicacion->imgpublicacion)}}">
                            </div>

                            <div class="text_preview_form">
                                <h5>{{$publicacion->nombrepublicacion}}</h5>
                                <p>{{$publicacion->descripcion}}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div id="mensajes-publicacion">
                @if($count_publicaciones >= 4 )
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Hecho!</h4>
                        <p>Ya tienes el máximo de publicaicones</p>
                    </div>
                @endif
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave11') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_publicaciones" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 px-0 align-self-end">
                        <div class="upload_file_img_form">
                            <img class="imagenPrevisualizacion" id="img-publicacion"/>
                            <input type='file' id="imagePublicacion" name="imagePublicacion" onchange="ver_imagen('imagePublicacion', 'img-publicacion');" {{ ($count_publicaciones >= 4) ? 'disabled' : '' }}/>
                            <p style="width: 13.5em;">Subir imagen publicación</p>
                        </div>

                        <p class="text_informative_form text-center">Tamaño 800 x 800px. Peso máximo 500kb</p>
                    </div>

                    <div class="col-md-6 p-0">
                        <label for="nombrePublicacion" class="label_txt_form"> Título de la publicación </label>
                        <input class="input_box_form" id="nombrePublicacion" placeholder="Título de la publicación" type="text" name="nombrePublicacion" {{ ($count_publicaciones >= 4) ? 'disabled' : '' }}>

                        <label for="descripcionPublicacion" class="label_txt_form"> Descripción </label>
                        <input class="input_box_form" id="descripcionPublicacion" maxlength="160" placeholder="Escribir descripción..." type="text" name="descripcionPublicacion" {{ ($count_publicaciones >= 4) ? 'disabled' : '' }}>

                        <p class="text_informative_form">160 Caracteres</p>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_blue_form" id="boton-guardar-publicacion" {{ ($count_publicaciones >= 4) ? 'disabled' : '' }} data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2" alt="">
                    </button>
                </div>
            </form>
        </div>

        <!-- Previous and next buttons -->
        <div class="container_button_form">
            <div class="section_button_form justify-content-between">
                <button type="submit" class="button_transparent_form" onclick="btnHidePrevious(this)" code-position="publicationsFormProf">
                    <img src="{{ asset('/img/formulario-profesional/icono-flecha-gris.svg') }}" class="pr-2">Anterior
                </button>

                <button type="submit" class="button_green_form" onclick="btnHideNext(this)" code-position="publicationsFormInst"> Siguiente
                    <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                </button>
            </div>
        </div>
    </div>

    <!-- 6. GALLERY AND VIDEO -->
    <div class="container_module_form gallery_formInst">
        <!-- 6.12 Gallery -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoGale_Prof mb-3">Galería</h5>
            <h5 class="textTop_informative_form">A continuación suba 10 imágenes como mínimo, con su respectivo nombre y descripción.</h5>

            <div class="content_information_saved_form" id="lista-fotos">
                {{--<?php $count_foto = 0;?>--}}
                @foreach($objGaleria as $foto)
                    @if(!empty($foto->nombrefoto))
                        {{--<?php $count_foto++;?>--}}
                        <div class="card_information_saved_form width_card_single">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $foto->id_galeria }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="image_preview_form">
                                <img src="{{ asset($foto->imggaleria) }}">
                            </div>

                            <div class="text_preview_form">
                                <h5>{{$foto->nombrefoto}}</h5>
                                <p>{{$foto->descripcion}}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div id="mensajes-fotos">
{{--                @if($count_foto >= 8 )--}}
{{--                    <div class="alert alert-success" role="alert">--}}
{{--                        <h4 class="alert-heading">Hecho!</h4>--}}
{{--                        <p>Ya tienes el máximo de fotos</p>--}}
{{--                    </div>--}}
{{--                @endif--}}
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave12') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario_fotos" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 px-0 align-self-end">
                        <div class="upload_file_img_form">
                            <img class="imagenPrevisualizacion"  id="img-foto"/>
                            <input type='file' id="imgFoto" name="imgFoto" onchange="ver_imagen('imgFoto', 'img-foto');" {{-- ($-- >= 8) ? 'disabled' : '' --}}/>
                            <p style="width: 11.5em;">Subir imagen galería</p>
                        </div>

                        <p class="text_informative_form text-center">Tamaño 400 x 400px. Peso máximo 500kb</p>
                    </div>

                    <div class="col-md-6 p-0">
                        <label for="fechaFoto" class="label_txt_form">Fecha</label>
                        <input class="input_box_form" type="date" id="fechaFoto" name="fechaFoto" {{-- ($count_foto >= 8) ? 'disabled' : '' --}}>

                        <label for="nombreFoto" class="label_txt_form">Título de la imagen</label>
                        <input class="input_box_form" id="nombreFoto" placeholder="Título de la imagen" type="text" name="nombreFoto" {{-- ($count_foto >= 8) ? 'disabled' : '' --}}>

                        <label for="descripcionFoto" class="label_txt_form">Descripción</label>
                        <input class="input_box_form" id="descripcionFoto" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionFoto" {{-- ($count_foto >= 8) ? 'disabled' : '' --}}>

                        <p class="text_informative_form">160 Caracteres</p>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_blue_form" id="boton-guardar-foto" {{-- ($count_foto >= 8) ? 'disabled' : '' --}} data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 6.13 Video -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoVideo_Prof mb-3">Videos</h5>
            <h5 class="textTop_informative_form">A continuación suba el link del video, con su respectivo nombre y descripción.</h5>
            <div id="mensajes-videos"></div>

            <div class="content_information_saved_form" id="lista-videos">
                {{--<?php $count_videos = 0;?>--}}
                @foreach($objVideo as $video)
                    @if(!empty($video->nombrevideo))
                        {{--<?php $count_videos++;?>--}}
                        <div class="card_information_saved_form width_card_single">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-id="{{ $video->id }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="image_preview_form">
                                <iframe src="{{$video->urlvideo}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>

                            <div class="text_preview_form">
                                <span>{{$video->fechavideo}}</span>
                                <h5>{{$video->nombrevideo}}</h5>
                                <p>{{$video->descripcionvideo}}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div id="mensajes-fotos">
{{--                @if($count_videos >= 4 )--}}
{{--                    <div class="alert alert-success" role="alert">--}}
{{--                        <h4 class="alert-heading">Hecho!</h4>--}}
{{--                        <p>Ya tienes el máximo de videos</p>--}}
{{--                    </div>--}}
{{--                @endif--}}
            </div>

            <form method="POST" action="{{ url ('/FormularioProfesionalSave13') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="formulario-videos" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 p-0 pr-md-1">
                        <label for="urlVideo" class="label_txt_form">Url video</label>
                        <input class="input_box_form" id="urlVideo"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="urlVideo" {{-- ($count_videos >= 4) ? 'disabled' : '' --}}>

                        <label for="fechaVideo" class="label_txt_form">Fecha</label>
                        <input class="input_box_form" type="date"  id="fechaVideo" name="fechaVideo" >
                    </div>

                    <div class="col-md-6 p-0 pl-md-1">
                        <label for="nombreVideo" class="label_txt_form">Título video</label>
                        <input class="input_box_form" id="nombreVideo" placeholder="Título video" type="text" name="nombreVideo" {{-- ($count_videos >= 4) ? 'disabled' : '' --}}>

                        <label for="descripcionVideo" class="label_txt_form">Descripción video</label>
                        <input class="input_box_form" id="descripcionVideo" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcionVideo" {{-- ($count_videos >= 4) ? 'disabled' : '' --}}>

                        <p class="text_informative_form">160 Caracteres</p>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_blue_form" id="boton-guardar-video" data-text="{{ __('profesional.guardar') }}" data-text-loading="{{ __('profesional.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2" {{-- ($count_videos >= 4) ? 'disabled' : '' --}}>
                    </button>
                </div>
            </form>
        </div>

        <!-- Previous and next buttons -->
        <div class="container_button_form">
            <div class="section_button_form justify-content-between">
                <button type="submit" class="button_transparent_form" onclick="btnHidePrevious(this)" code-position="galleryFormProf">
                    <img src="{{ asset('/img/formulario-profesional/icono-flecha-gris.svg') }}" class="pr-2">Anterior
                </button>

                <a type="submit" class="button_green_form" href="{{ url('/PerfilProfesional/' . $objuser->id) }}">Finalizar
                    <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--<script data-pace-options='{ "ajax": false, "document": true, "eventLag": false, "elements": false}' src="{{ asset('plugins/pace/pace.min.js') }}"></script>-->

    <script src="{{ asset('js/formularioProfesional.js') }}"></script>
    <script src="{{ asset('js/selectareas.js') }}"></script>
    <script src="{{ asset('js/selectpais.js') }}"></script>
    <script src="{{ asset('js/cargaFoto.js') }}"></script>

    <script>
        // Pace.on("done", function() {
        //     $('#page_overlay').delay(300).fadeOut(600);
        // });
    </script>
@endsection
