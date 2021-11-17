@extends('layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet" />
    <!--<link rel="stylesheet" href="{{ asset('plugins/pace/themes/blue/pace-theme-loading-bar.css') }}"/>-->
@endsection

@section('content')
    <!-- Module line -->
    <ol  class="container_line_module_form">
        <div class="section_icon_form"> <!-- clase "content_icons-formInst" para evento ocultar y mostrar contenido de la opción. Ubicado en el archivo formularios.js -->
            <li class="iconVerde_datoInst dato_institution" onclick="hideContaintOption(this)" data-position="dateInstitution"> <!-- clase "dato_institution" para activar el evento on click de la opción. Ubicado en el archivo formulario.js  -->
                <p>Datos institucionales</p>
            </li>
        </div>
        <div class="section_icon_form">
            <li class="iconGris_servProfesional serv_profesional" onclick="hideContaintOption(this)" data-position="professionalServices">
                <p>Servicios profesionales</p>
            </li>
        </div>
        <div class="section_icon_form">
            <li class="iconGris_acercaInst acerca_institution" onclick="hideContaintOption(this)" data-position="aboutInstitution">
                <p>Acerca de la institución</p>
            </li>
        </div>
        <div class="section_icon_form">
            <li class="iconGris_profesionalInst profesional_institution" onclick="hideContaintOption(this)" data-position="professionalInst">
                <p>Profesionales</p>
            </li>
        </div>
        <div class="section_icon_form">
            <li class="iconGris_certifInst certificado_institution" onclick="hideContaintOption(this)" data-position="certificationsInst">
                <p>Certificaciones</p>
            </li>
        </div>
        <div class="section_icon_form">
            <li class="iconGris_sedeInst sede_institution" onclick="hideContaintOption(this)" data-position="venuesInst">
                <p>Sedes</p>
            </li>
        </div>
        <div class="section_icon_form">
            <li class="iconGris_galeInst galeria_institution" onclick="hideContaintOption(this)" data-position="galleryInst">
                <p>Galería</p>
            </li>
        </div>
    </ol>

    <!-- 1. INSTITUTION INFORMATION -->
    <div class="container_module_form date_institution"> <!-- Clase "date_institution" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <div class="title_main_form">
            <h5 style="color: #019F86">LE DAMOS LA BIENVENIDA A ZAABRA SALUD</h5>
            <p>Ingrese los datos según corresponda y finalice el proceso completamente en línea.</p>
        </div>

        <!-- 1.1 Basic information -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoBasica_Inst"> Información básica </h5>
            <div id="mensajes-basico"></div>

            <form method="POST" action="{{ route('entidad.create1') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-basico-institucional" class="pb-2">
                @csrf
                <div class="row m-0 py-3 px-0">
                    <div class="col-md-3 img_user_form"> <!-- Institution logo -->
                        <img id="img-logoInstitucion" src="{{ (isset($objFormulario->logo)) ? asset($objFormulario->logo) : ''}}">
                        <input type="file" name="logo_institucion"  id="logo_institucion" onchange="ver_imagen('logo_institucion', 'img-logoInstitucion')" accept="image/png, image/jpeg">
                        <p style="width: 10.5em;">Subir imagen logo</p>
                    </div>

                    <div class="col-md-5 line_vertical_form">  <!-- Institution information -->
                        <div class="row m-0">
                            <div class="col-lg-12 p-0 pr-lg-1">
                                <label for="nombre_institucion" class="label_txt_form">Nombres Institución</label>
                                <input class="input_box_form" value="{{ old('nombre_institucion', $objuser->nombreinstitucion) }}" id="nombre_institucion" name="nombre_institucion">
                            </div>

                            <div class="col-lg-12 p-0 pr-lg-1">
                                <label for="fecha_inicio_institucion" class="label_txt_form">Fecha</label>
                                <input class="input_box_form" type="date" value="{{ old('fecha_inicio_institucion', $objFormulario->fechainicio) }}" id="fecha_inicio_institucion" name="fecha_inicio_institucion">
                            </div>

                            <div class="col-lg-12 p-0 pr-lg-1">
                                <label for="url_institucion" class="label_txt_form">Página web</label>
                                <input class="input_box_form" placeholder="Url" type="text" name="url_institucion" id="url_institucion" value="{{ old('url_institucion', $objFormulario->url) }}">
                            </div>

                            <div class="col-lg-12 p-0 pr-lg-1">
                                <label for="tipo_institucion" class="label_txt_form">Selecione entidad</label>
                                <select class="input_box_form" name="tipo_institucion" id="tipo_institucion">
                                    @foreach($tipoinstitucion as $tipoinstitucion)
                                        <option value="{{$tipoinstitucion->id}}" {{ ($tipoinstitucion->id == $objFormulario->idtipoInstitucion) ? 'selected' : '' }}> {{$tipoinstitucion->nombretipo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 img_sede_form">  <!-- Institution image -->
                        <img id="img-imagenInstitucion" src="{{ (isset($objFormulario->imagen)) ? asset($objFormulario->imagen) : '' }}" />
                        <input type="file" name="imagen_institucion"  id="imagen_institucion" onchange="ver_imagen('imagen_institucion', 'img-imagenInstitucion')" accept="image/png, image/jpeg">
                        <p style="width: 10.5em;"> Subir imagen sede </p>
                    </div>
                </div>

                <div class="section_button_form">  <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-basico-institucional" data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 1.2 Contac information -->
        <div class="card_module_form">
            <form method="POST" action="{{ route('entidad.create2') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-contacto-institucional" class="pb-2">
                @csrf
                <h5 class="icon_text icon_infoContac_Inst">Información de contacto</h5>
                <div id="mensajes-contacto"></div>

                <div class="row m-0 py-3 px-0">
                     <div class="col-md-6 p-0 pr-md-1">
                        <label for="celular" class="label_txt_form">Celular</label>
                        <input class="input_box_form" id="celular" placeholder="Número de celular" type="number" name="celular" value="{{ old('celular', $objFormulario->telefonouno) }}">
                    </div>

                     <div class="col-md-6 p-0 pl-md-1">
                        <label for="telefono" class="label_txt_form">Teléfono fijo</label>
                        <input class="input_box_form" id="telefono" placeholder="Número Teléfono" type="number" name="telefono" value="{{ old('telefono', $objFormulario->telefono2) }}">
                    </div>

                     <div class="col-md-6 p-0 pr-md-1">
                        <label for="direccion" class="label_txt_form">Dirección</label>
                        <input class="input_box_form" id="direccion" placeholder="Dirección" type="text" name="direccion" value="{{ old('direccion', $objFormulario->direccion) }}">
                    </div>

                     <div class="col-md-6 p-0 pl-md-1">     <!--menu dinamico ciudades -->
                        <label for="pais" class="label_txt_form">Seleccione país</label>
                        <select id="pais" name="pais" class="input_box_form">
                            <option></option>
                            @foreach($listaPaises as $pais)
                                <option value="{{ $pais->id_pais }}"  {{ (old('pais', $objFormulario->id_pais) == $pais->id_pais) ? 'selected' : ''}}> {{ $pais->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                     <div class="col-md-6 p-0 pr-md-1">
                        <label for="departamento" class="label_txt_form">Seleccione departamento</label>
                        <select name="departamento" id="departamento" class="input_box_form">
                            @foreach($listaDepartamentos as $departamento)
                                <option value="{{ $departamento->id_departamento }}"  {{ (old('departamento', $objFormulario->id_departamento) == $departamento->id_departamento) ? 'selected' : ''}}> {{ $departamento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                     <div class="col-md-6 p-0 pl-md-1">
                        <label for="provincia" class="label_txt_form">Seleccione provincia</label>
                        <select name="provincia" id="provincia" class="input_box_form">
                            @foreach($listaProvincias as $provincia)
                                <option value="{{ $provincia->id_provincia }}"  {{ (old('provincia', $objFormulario->id_provincia) == $provincia->id_provincia) ? 'selected' : ''}}> {{ $provincia->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                     <div class="col-md-6 p-0 pr-md-1">
                        <label for="municipio" class="label_txt_form">Seleccione ciudad</label>
                        <select name="municipio" id="municipio" class="input_box_form">
                            @foreach($listaMunicipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}"  {{ (old('municipio', $objFormulario->id_municipio) == $municipio->id_municipio) ? 'selected' : ''}}> {{ $municipio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="section_button_form">  <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-contacto-institucion" data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 1.3 Recover password -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoBasica_Inst">Actualizar contraseña</h5>

            <form action="{{ route('entidad.formulario-password') }}" id="form-password-institucion" method="post" class="pb-2">
                <div class="col-12" id="mensajes-password"></div>
                
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
                    <button class="button_green_form" id="btn-guardar-password-institucion" data-text="{{ __('paciente.guardar') }}" data-text-loading="{{ __('paciente.cargando') }}..."> {{ __('paciente.guardar') }}
                        <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- Next button -->
        <div class="container_button_form"> 
            <div class="section_button_form">
                <button type="submit" class="button_blue_form" onclick="hideBtnNext(this)" code-position="dateInstitution">Siguiente
                    <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                </button>
            </div>
        </div>
    </div>

    <!-- 2. PROFESSIONAL SERVICES -->
    <div class="container_module_form professional_services"> <!-- Clase "professional_services" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!-- 2.4 Professional services -->
        <div class="card_module_form">
            <h5 class="icon_text icon_servProf_Inst mb-3">Servicios profesionales</h5>
            <div id="mensajes-descripcion"></div>

            <form method="POST" action="{{ route('entidad.create3') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-descripcion-institucion" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-12 px-0">
                        <h5 for="descripcion_perfil" class="textTop_informative_form">Escriba una breve descripción de su servicio.</h5>
                        <textarea class="textarea_form" id="descripcion_perfil"  type="text" cols="30" rows="10" maxlength="270" name="descripcion_perfil" >{{ old('descripcion_perfil', $objFormulario->DescripcionGeneralServicios) }}</textarea>

                        <p class="text_informative_form">270 Caracteres</p>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-descripcion-institucional" data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 2.5 Services -->
        <div class="card_module_form">
            <h5 class="icon_text icon_servicios_Inst mb-3">Servicios</h5>

            <div class="content_information_saved_form" id="lista-servicios-institucion">
                <?php $count_servicios = 0; ?>
                @foreach($objServicio as $servicio)
                    @if(!empty($servicio->tituloServicios))
                        <?php $count_servicios++; ?>
                        <div class="card_information_saved_form">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-url="{{ route('entidad.delete4', ['id_servicio' => $servicio->id_servicio]) }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="data_saved_form border-top-0">
                                <h5>Título del servicio</h5>
                                <span>{{$servicio->tituloServicios}}</span>
                            </div>

                            <div class="data_saved_form">
                                <h5>Descripción</h5>
                                <span>{{$servicio->DescripcioServicios}}</span>
                            </div>

                            <div class="data_saved_form">
                                <h5>Sedes en la que está el servicio</h5>
                                @if( is_string($servicio->sucursalservicio) )
                                    @php  $new_array = explode(',', $servicio->sucursalservicio ); @endphp
                                @endif
                                <ul>
                                    @foreach($new_array as $info)
                                        <li>{{$info}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ route('entidad.create4') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-servicios-institucion" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-12" id="mensajes-servicios">
                        @if($count_servicios >= 6 )
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Hecho!</h4>
                                <p>Ya tienes el máximo de servicos</p>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12 p-0">
                        <label for="titulo_servicio" class="label_txt_form">Título del servicio</label>
                        <input class="input_box_form" id="titulo_servicio" placeholder="Título del servicio" type="text" name="titulo_servicio" {{ ($count_servicios >= 6) ? 'disabled' : '' }}>
                    </div>

                    <div class="col-md-12 p-0">
                        <label for="descripcion_servicio" class="label_txt_form">Descripción</label>
                        <textarea class="textarea_form" id="descripcion_servicio" placeholder="Escribir descripción..." cols="30" rows="10" maxlength="270" name="descripcion_servicio" {{ ($count_servicios >= 6) ? 'disabled' : '' }}></textarea>

                        <p class="text_informative_form">270 Caracteres</p>
                    </div>

                    <div class="col-md-12 p-0" id="sedes-servicios-institucion">
                        <label for="sucursal_servicio-0" class="label_txt_form">Sedes en la que está el servicio</label>
                        <div class="input-group">
                            <input type="text" class="form-control input_servicios_institucion" placeholder="Nombre de la sede" id="sucursal_servicio-0" name="sucursal_servicio[0]" {{ ($count_servicios >= 6) ? 'disabled' : '' }}>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" id="btn-agregar-servicio-institucion" {{ ($count_servicios >= 6) ? 'disabled' : '' }}><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-servicio-institucion" {{ ($count_servicios >= 6) ? 'disabled' : '' }} data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- Previous and next buttons -->
        <div class="container_button_form"> 
            <div class="section_button_form justify-content-between">
                <button type="submit" class="button_transparent_form" onclick="hideBtnPrevious(this)" code-position="professionalServices">
                    <img src="{{asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="pr-2"> Anterior
                </button>

                <button type="submit" class="button_blue_form" onclick="hideBtnNext(this)" code-position="professionalServices"> Siguiente
                    <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                </button>
            </div>
        </div>
    </div>

    <!-- 3. About the institution -->
    <div class="container_module_form about_institution"> <!-- Clase "about_institution" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!-- 3.6 About the institution -->
        <div class="card_module_form">
            <h5 class="icon_text icon_quienes_Inst mb-3">¿Quiénes somos?</h5>
            <div id="mensajes-quienes-somos"></div>

            <form method="POST" action="{{ route('entidad.create5') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-quienes-somos-institucion" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-12 px-0">
                        <h5 for="descripcion_quienes_somos" class="textTop_informative_form">Escriba una breve descripción de ¿Quiénes son?.</h5>
                        <textarea class="textarea_form" id="descripcion_quienes_somos" cols="30" rows="10" maxlength="270" type="text" name="descripcion_quienes_somos" >{{ old('descripcion_quienes_somos', $objFormulario->quienessomos) }}</textarea>
                        
                        <p class="text_informative_form">270 Caracteres</p>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-quienes-somo-institucion" data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 3.7 Value propusal -->
        <div class="card_module_form">
            <h5 class="icon_text icon_propuestaValor_Inst mb-3">Propuesta de valor</h5>
            <div id="mensajes-propuesta-valor"></div>
            
            <form method="POST" action="{{ route('entidad.create6') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-propuesta-valor-institucion" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-12 px-0">
                        <h5 for="propuesta_valor" class="textTop_informative_form">Escriba una breve descripción de la propuesta de valor.</h5>
                        <textarea class="textarea_form" id="propuesta_valor" type="text" cols="30" rows="10" maxlength="270" name="propuesta_valor" >{{ old('propuesta_valor', $objFormulario->propuestavalor) }}</textarea>
                        
                        <p class="text_informative_form">270 Caracteres</p>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-propuesta-valor-institucion" data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 3.8 Covenants -->
        <div class="card_module_form">
            <h5 class="icon_text icon_convenios_Inst mb-3">Convenios</h5>

            <div class="content_information_saved_form" id="lista-convenios-institucion">
                <?php $count_convenios = 0;?>
                @foreach($objConvenios as $convenio)
                    @if(!empty($convenio->url_image))
                        <?php $count_convenios++;?>
                        <div class="card_information_saved_form">
                            <div class="content_btn_close_form">
                                <button type="button" class="close" aria-label="Close" data-url="{{ route('entidad.delete7', ['id_convenio' => $convenio->id]) }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="data_saved_form border-top-0 mb-3">
                                <h5>Convenio {{ $convenio->nombre_tipo_convenio }}</h5>
                            </div>

                            <div class="image_saved_form">
                                <img id="imagenPrevisualizacion" src="{{ asset($convenio->url_image) }}">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ route('entidad.create7') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-convenios-institucion" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">                   
                    <div class="col-12" id="mensajes-convenios"></div>

                    <div class="col-md-6 px-0 align-self-end">
                        <div class="upload_file_img_form">
                            <img class="imagenPrevisualizacion" id="img-logo_convenio"/>
                            <input type='file' id="logo_convenio" name="logo_convenio" onchange="ver_imagen('logo_convenio', 'img-logo_convenio');" {{ ($count_convenios >= 9) ? 'disabled' : '' }}/>

                            <p>Subir logo entidad</p>
                        </div>

                        <p class="text_informative_form text-center">Tamaño 120px x 60px. Peso máximo 300kb</p>
                    </div>

                    <div class="col-md-6 p-0">
                        <label for="tipo_convenio" class="label_txt_form">Tipo convenio</label>
                        <select name="tipo_convenio" id="tipo_convenio" class="input_box_form" {{ ($count_convenios >= 9) ? 'disabled' : '' }}>
                            <option></option>
                            @foreach($objTipoConvenios as $item)
                                <option value="{{ $item->id }}">{{ $item->nombretipo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-convenios-institucion" {{ ($count_convenios >= 9) ? 'disabled' : '' }} data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- Previous and next buttons -->
        <div class="container_button_form"> 
            <div class="section_button_form justify-content-between">
                <button type="submit" class="button_transparent_form" onclick="hideBtnPrevious(this)" code-position="aboutInstitution">
                    <img src="{{asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="pr-2"> Anterior
                </button>
            
                <button type="submit" class="button_blue_form" onclick="hideBtnNext(this)" code-position="aboutInstitution"> Siguiente
                    <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                </button>
            </div>
        </div>
    </div>

    <!-- 4. Professionals -->
    <div class="container_module_form professional_inst"> <!-- Clase "professional_inst" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!-- 4.9 Professionals -->
        <div class="card_module_form">
            <h5 class="icon_text icon_profesionales_Inst mb-3">Profesionales</h5>

            <div class="content_information_saved_form" id="lista-profesionales-institucion">
                <?php $count_profecionales = 0; ?>
                @foreach($objProfesionalesIns as $profecional)
                    @if(!empty($profecional->foto_perfil_institucion))
                        <?php $count_profecionales++; ?>
                        <div class="card_information_saved_form">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-url="{{ route('entidad.delete8', ['id_profesional' => $profecional->id_profesional_inst]) }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="img_user_form mb-3">
                                <img src="{{ asset($profecional->foto_perfil_institucion) }}">
                            </div>

                            <div class="">
                                <div class="data_saved_form">
                                    <h5>{{ $profecional->primer_nombre }} {{ $profecional->segundo_nombre }} {{ $profecional->primer_apellido }} {{ $profecional->segundo_apellido }}</h5>
                                    <span>{{ $profecional->nombre_universidad }}</span>
                                </div>
                         
                                <div class="data_saved_form">
                                    @if(!empty($profecional->nombre_especialidad))
                                        @if(!empty($profecional->especialidades->toArray()))
                                            <ul>
                                                <li>
                                                    {!!  implode('</li><li>', array_column($profecional->especialidades->toArray(), 'nombreEspecialidad'))  !!}
                                                </li>
                                            </ul>
                                        @endif
                                    @endif
                                </div>

                                <div class="data_saved_form border-top-0">
                                    @if(!empty($profecional->cargo))
                                        <span>{{ $profecional->cargo }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form action="{{ route('entidad.create8') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="form-profesionales-institucion"  class="pb-2">
                @csrf
                <div class="col-12" id="mensajes-profesionales">
                    @if($count_profecionales >= 3 and !$is_asociacion )
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Hecho!</h4>
                            <p>Ya tienes el máximo de profesionales</p>
                        </div>
                    @endif
                </div>

                <div class="row m-0 py-3 px-0">
                    <div class="col-md-3 img_user_form"> <!-- Professionqal image -->
                        <img id="img-foto_profecional">
                        <input type="file" id="foto_profecional" name="foto_profecional" onchange="ver_imagen('foto_profecional', 'img-foto_profecional');" accept="image/png, image/jpeg">
                        <p>Subir foto de perfil</p>
                    </div>
              
                    <div class="col-md-9 line_vertical_form"> <!-- Personal information -->
                        <div class="row m-0">
                            <div class="col-lg-6 p-0 pr-lg-1">
                                <label for="example-date-input" class="label_txt_form">Nombres</label>
                                <div class="section_input_double_form">
                                    <input class="input_box_form mb-2 mb-md-0 mr-md-1" placeholder="Primer nombre" type="text" name="primer_nombre_profecional" id="primer_nombre_profecional" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}>
                                    <input class="input_box_form ml-md-1" placeholder="Segundo nombre"  type="text" name="segundo_nombre_profecional" id="segundo_nombre_profecional" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}>
                                </div>
                            </div>

                            <div class="col-lg-6 p-0 pl-lg-1">
                                <label for="example-date-input" class="label_txt_form">Apellidos</label>
                                <div class="section_input_double_form">
                                    <input class="input_box_form mb-2 mb-md-0 mr-md-1" placeholder="Primer apellido"  type="text" name="primer_apellido_profecional" id="primer_apellido_profecional" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}>
                                    <input class="input_box_form ml-md-1" placeholder="Segundo apellido"  type="text" name="segundo_apellido_profecional" id="segundo_apellido_profecional" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}>
                                </div>
                            </div>

                            <div class="col-lg-6 p-0 pr-lg-1">
                                <label for="universidad" class="label_txt_form">Universidad</label>
                                <select name="universidad" id="universidad" class="input_box_form universidades" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}>
                                    <option></option>
                                </select>
                            </div>

                            <div class="col-lg-6 p-0 pl-lg-1">
                                <label for="especialidad" class="label_txt_form">Especialidad</label>
                                <select name="especialidad[]" id="especialidad" class="input_box_form especialidades-search" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }} >
                                </select>
                            </div>

                            <div class="col-lg-6 p-0 pr-lg-1">
                                <label for="cargo_profesional" class="label_txt_form">Cargo</label>
                                <input type="text" name="cargo_profesional" id="cargo_profesional" class="input_box_form" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }} />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section_button_form">  <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-profecionales-institucion" {{ ($count_profecionales >= 3 and !$is_asociacion) ? 'disabled' : '' }}  data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2"/>
                    </button>
                </div>
            </form>
        </div>

        <!-- Previous and next buttons -->
        <div class="container_button_form"> 
            <div class="section_button_form justify-content-between">
                <button type="submit" class="button_transparent_form" onclick="hideBtnPrevious(this)" code-position="professionalInst">
                    <img src="{{asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="pr-2">Anterior
                </button>

                <button type="submit" class="button_blue_form" onclick="hideBtnNext(this)" code-position="professionalInst">Siguiente
                    <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                </button>
            </div>
        </div>
    </div>

    <!-- 5. Certifications -->
    <div class="container_module_form certifications_inst"> <!-- Clase "certifications_inst" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!-- 5.10 Certifications -->
        <div class="card_module_form">
            <h5 class="icon_text icon_certificaciones_Inst mb-3">Certificaciones</h5>
            <h5 class="textTop_informative_form">A continuación suba imágenes relacionadas con sus certificaciones, con fecha, nombre y descripción.</h5>

            <div class="content_information_saved_form" id="lista-certificaciones-institucion">
                <?php $count_certificaiones = 0; ?>
                @foreach($objCertificaciones as $certificacion)
                    @if(!empty($certificacion->imgcertificado))
                        <?php $count_certificaiones++; ?>
                        <div class="card_information_saved_form width_card_single">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-url="{{ route('entidad.delete9', ['id_certificacion' => $certificacion->id_certificacion]) }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="image_preview_form">
                                <img src="{{ asset($certificacion->imgcertificado) }}">
                            </div>

                            <div class="text_preview_form">
                                <span> {{ $certificacion->fechacertificado }} </span>
                                <h5> {{ $certificacion->titulocertificado }} </h5>
                                <p> {{ $certificacion->descrpcioncertificado }} </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ route('entidad.create9') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-certificados-institucion" class="pb-2">
                @csrf
                <div class="col-12" id="mensajes-certificaciones">
                    @if($count_certificaiones >= 4)
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Hecho!</h4>
                            <p>Ya tienes el máximo de certificaciones</p>
                        </div>
                    @endif
                </div>

                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 px-0 align-self-end">
                        <div class="upload_file_img_form">
                            <img class="imagenPrevisualizacion" id="img-image_certificado">
                            <input type='file' id="image_certificado" name="image_certificado" onchange="ver_imagen('image_certificado', 'img-image_certificado');" {{ ($count_certificaiones >= 4) ? 'disabled' : '' }}/>
                            <p style="width: 13.5em;">Subir imagen certificado</p>
                        </div>

                        <p class="text_informative_form text-center">Tamaño 356 x 326px. Peso máximo 300kb</p>
                    </div>

                    <div class="col-md-6 p-0">
                        <label for="fecha_certificado" class="label_txt_form">Fecha</label>
                        <input class="input_box_form" type="date"  id="fecha_certificado" name="fecha_certificado" {{ ($count_certificaiones >= 4) ? 'disabled' : '' }}>

                        <label for="titulo_certificado" class="label_txt_form">Título del certificado</label>
                        <input class="input_box_form" id="titulo_certificado" placeholder="Título de la imagen" type="text" name="titulo_certificado" {{ ($count_certificaiones >= 4) ? 'disabled' : '' }}>

                        <label for="descripcion_certificacion" class="label_txt_form">Descripción de la certificación</label>
                        <input class="input_box_form" name="descripcion_certificacion" id="descripcion_certificacion" maxlength="160" {{ ($count_certificaiones >= 4) ? 'disabled' : '' }}></input>

                        <p class="text_informative_form">160 Caracteres</p>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-certificado-institucion" {{ ($count_certificaiones >= 4) ? 'disabled' : '' }} data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- Previous and next buttons -->
        <div class="container_button_form"> 
            <div class="section_button_form justify-content-between">
                <button type="submit" class="button_transparent_form" onclick="hideBtnPrevious(this)" code-position="certificationsInst">
                    <img src="{{asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="pr-2">Anterior
                </button>

                <button type="submit" class="button_blue_form" onclick="hideBtnNext(this)" code-position="certificationsInst">Siguiente
                    <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                </button>
            </div>
        </div>
    </div>

    <!-- 6. Venues -->
    <div class="container_module_form venues_inst"> <!-- Clase "venues_inst" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!-- 6.11 Venues -->
        <div class="card_module_form">
            <h5 class="icon_text icon_sedes_Inst mb-3">Sedes</h5>
            <h5 class="textTop_informative_form">A continuación suba imágenes e información de las sedes que tengan de la institución.</h5>

            <div class="content_information_saved_form" id="lista-sedes-institucion">
                <?php $count_sedes = 0; ?>
                @foreach($objSedes as $sede)
                    @if(!empty($sede->imgsede))
                        <?php $count_sedes++; ?>
                        <div class="card_information_saved_form width_card_single">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-url="{{ route('entidad.delete10', ['id' => $sede->id]) }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="image_preview_form">
                                <img src="{{ asset($sede->imgsede) }}">
                            </div>

                            <div class="text_preview_form">
                                <h5>{{ $sede->nombre }}</h5>
                                <span>{{ $sede->direccion }}</span>
                                <h5>{{ $sede->horario_sede }}</h5>
                                <span style="color: #0083D6; font-weight: bold">{{ $sede->telefono }}</span>
                                <span>{{ $sede->url_map }}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ route('entidad.create10') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-sedes-institucion" class="pb-2">
                @csrf
                <div class="col-12" id="mensajes-sedes">
                    @if($count_sedes >= 6)
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Hecho!</h4>
                            <p>Ya tienes el máximo de sedes</p>
                        </div>
                    @endif
                </div>

                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 px-0 align-self-center">
                        <div class="upload_file_img_form">
                            <img class="imagenPrevisualizacion" id="img-img_sede">
                            <input type='file' id="img_sede" name="img_sede" onchange="ver_imagen('img_sede', 'img-img_sede');" {{ ($count_sedes >= 6) ? 'disabled' : '' }} />
                            <p>Subir imagen sede</p>
                        </div>

                        <p class="text_informative_form text-center">Tamaño 356 x 326px. Peso máximo 300kb</p>
                    </div>

                    <div class="col-md-6 p-0">
                            <label for="nombre_sede" class="label_txt_form">Nombre de la sede</label>
                            <input class="input_box_form" id="nombre_sede" placeholder="Nombre de la sede" type="text" name="nombre_sede" {{ ($count_sedes >= 6) ? 'disabled' : '' }} />
                    
                            <label for="direccion_sede" class="label_txt_form">Dirrección</label>
                            <input class="input_box_form" id="direccion_sede" placeholder="Dirección" type="text" name="direccion_sede" {{ ($count_sedes >= 6) ? 'disabled' : '' }} />

                            <label for="horario_sede" class="label_txt_form">Horario</label>
                            <input class="input_box_form" id="horario_sede" placeholder="Horario" type="text" name="horario_sede" {{ ($count_sedes >= 6) ? 'disabled' : '' }} />
                    
                            <label for="telefono_sede" class="label_txt_form">Teléfono</label>
                            <input class="input_box_form" id="telefono_sede" placeholder="Número de teléfono" type="text" name="telefono_sede" {{ ($count_sedes >= 6) ? 'disabled' : '' }} />
                    
                            <label for="url_mapa_sede" class="label_txt_form">Url ubicación sede (Google Map)</label>
                            <input class="input_box_form" id="url_mapa_sede" placeholder="Url" type="text" name="url_mapa_sede" {{ ($count_sedes >= 6) ? 'disabled' : '' }} />
                    
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-sede-institucion" {{ ($count_sedes >= 6) ? 'disabled' : '' }} data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 6.12 Main venues -->
        <div class="card_module_form">
            <h5 class="icon_text icon_ubiqueSede_Inst mb-3">Ubique la sede principal</h5>
            <div id="mensajes-ubicacion-institucion"></div>

            <form method="POST" action="{{ route('entidad.create11') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-ubicaion-institucion" class="pb-2">
                @csrf
                <div class="row m-0 pb-3 px-0">
                    <div class="col-12 px-0">
                        <h5 for="propuesta_valor" class="textTop_informative_form">A continuación enlace las sedes en Google Maps.</h5>
                        <input class="input_box_form" id="url_map_principal_institucion" placeholder="https://www.google.com/maps/embed?pb=....." type="text" name="url_map_principal_institucion" />
                    </div>
                </div>

                <div class="col-12 px-0 {{ empty($objFormulario->url_maps) ? 'd-none' : '' }}">
                    <iframe src="{{$objFormulario->url_maps}}" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" id="map_principal_institucion"></iframe>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-ubicacion-institucion" data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- Previous and next buttons -->
        <div class="container_button_form"> 
            <div class="section_button_form justify-content-between">
                <button type="submit" class="button_transparent_form" onclick="hideBtnPrevious(this)" code-position="venuesInst">
                    <img src="{{asset('/img/formulario-profesional/icono-flecha-gris.svg')}}" class="pr-2"> Anterior
                </button>

                <button type="submit" class="button_blue_form" onclick="hideBtnNext(this)" code-position="venuesInst"> Siguiente
                    <img src="{{asset('/img/iconos/icono-flecha-blanco.svg')}}" class="pl-2">
                </button>
            </div>
        </div>
    </div>

    <!-- 7. Gallery -->
    <div class="container_module_form gallery_inst"> <!-- Clase "gallery_inst" creada para ocultar y mostrar elementos desde la función on click en el archivo formularios.js  -->
        <!-- 7.13 Gallery -->
        <div class="card_module_form">
            <h5 class="icon_text icon_gallery_Inst mb-3">Galería</h5>
            <h5 class="textTop_informative_form">A continuación suba 8 imágenes como máximo, con su respectivo nombre y descripción.</h5>

            <div class="content_information_saved_form" id="lista-galeria-intitucion">
                <?php $count_galeria = 0; ?>
                @foreach($objGaleria as $galeria)
                    @if(!empty($galeria->nombrefoto))
                        <?php $count_galeria++; ?>
                        <div class="card_information_saved_form width_card_single">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-url="{{ route('entidad.delete12', ['id' => $galeria->id_galeria ]) }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="image_preview_form">
                                <img src="{{ asset($galeria->imggaleria) }}">
                            </div>

                            <div class="text_preview_form">
                                <span>{{ $galeria->fechagaleria }}</span>
                                <h5>{{ $galeria->nombrefoto }}</h5>
                                <p>{{ $galeria->descripcion }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <form  action="{{ route('entidad.create12') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" id="form-galeria-institucion" class="pb-2">
                @csrf
                <div id="mensajes-galeria">
                    @if($count_galeria >= 8)
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Hecho!</h4>
                            <p>Ya tienes el máximo de fotos</p>
                        </div>
                    @endif
                </div>

                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 px-0 align-self-end">
                        <div class="upload_file_img_form">
                            <img class="imagenPrevisualizacion" id="img-img_galeria_institucion">
                            <input type='file' id="img_galeria_institucion" name="img_galeria_institucion" onchange="ver_imagen('img_galeria_institucion', 'img-img_galeria_institucion');" {{ ($count_galeria >= 8) ? 'disabled' : '' }}/>
                            <p style="width: 11.5em;">Subir imagen galería</p>
                        </div>

                        <p class="text_informative_form text-center">Tamaño 400 x 400px. Peso máximo 500kb</p>
                    </div>

                    <div class="col-md-6 p-0">
                        <label for="fecha_galeria_institucion" class="label_txt_form">Fecha</label>
                        <input class="input_box_form" type="date"  id="fecha_galeria_institucion" name="fecha_galeria_institucion" {{ ($count_galeria >= 8) ? 'disabled' : '' }} />
                    
                        <label for="nombre_galeria_institucion" class="label_txt_form">Título de la imagen</label>
                        <input class="input_box_form" id="nombre_galeria_institucion" placeholder="Título de la imagen" type="text" name="nombre_galeria_institucion" {{ ($count_galeria >= 8) ? 'disabled' : '' }} />
                    
                        <label for="descripcion_galeria_institucion" class="label_txt_form">Descripción</label>
                        <input class="input_box_form" id="descripcion_galeria_institucion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion_galeria_institucion" {{ ($count_galeria >= 8) ? 'disabled' : '' }} />
                        <label class="col-12 text_infoImg-formInst"> 160 Caracteres </label>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-galeria-institucion" {{ ($count_galeria >= 8) ? 'disabled' : '' }} data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src=" {{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 7.14 Videos -->
        <div class="card_module_form">
            <h5 class="icon_text icon_video_Inst mb-3">Videos</h5>
            <h5 class="textTop_informative_form">A continuación suba el link del video, con su respectivo nombre y descripción.</h5>

            <div class="content_information_saved_form" id="lista-videos-institucion">
                <?php $count_videos = 0 ;?>
                @foreach($objVideo as $video)
                    @if(!empty($video->nombrevideo))
                        <?php $count_videos = 0 ;?>
                        <div class="card_information_saved_form width_card_single">
                            <div class="content_btn_close_form">
                                <button type="submit" class="close" aria-label="Close" data-url="{{ route('entidad.delete13', ['id' => $video->id]) }}"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="image_preview_form">
                                <iframe src="{{ $video->urlvideo }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            
                            <div class="text_preview_form">
                                <span>{{ $video->fechavideo }}</span>
                                <h5>{{ $video->nombrevideo }}</h5>
                                <p>{{ $video->descripcionvideo }}</p>
                            </div> 
                        </div>
                    @endif
                @endforeach
            </div>

            <form method="POST" action="{{ route('entidad.create13') }}" enctype="multipart/form-data" accept-charset="UTF-8" id="form-videos-institucion" class="pb-2">
                @csrf
                <div id="mensajes-videos">
                    @if($count_videos >= 4)
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Hecho!</h4>
                            <p>Ya tienes el máximo de videos</p>
                        </div>
                    @endif
                </div>

                <div class="row m-0 pb-3 px-0">
                    <div class="col-md-6 p-0 pr-md-1">
                        <label for="url_video_institucion" class="label_txt_form">Url video</label>
                        <input class="input_box_form" id="url_video_institucion"  type="text" placeholder="https://www.youtube.com/watch?v=53lHGbvu8o&ab" name="url_video_institucion" {{ ($count_videos >= 4) ? 'disabled' : '' }} />

                        <label for="fecha_video_institucion" class="label_txt_form">Fecha</label>
                        <input class="input_box_form" type="date"  id="fecha_video_institucion" name="fecha_video_institucion" {{ ($count_videos >= 4) ? 'disabled' : '' }} />
                    </div>

                    <div class="col-md-6 p-0 pl-md-1">  
                        <label for="nombre_video_institucion" class="label_txt_form">Título video</label>
                        <input class="input_box_form" id="nombre_video_institucion" placeholder="Título video" type="text" name="nombre_video_institucion" {{ ($count_videos >= 4) ? 'disabled' : '' }} />

                        <label for="descripcion_video_institucion" class="label_txt_form">Descripción video</label>
                        <input class="input_box_form" id="descripcion_video_institucion" placeholder="Escribir descripción..." type="text" maxlength="160" name="descripcion_video_institucion" {{ ($count_videos >= 4) ? 'disabled' : '' }} />
                        
                        <p class="text_informative_form">160 Caracteres</p>
                    </div>
                </div>

                <div class="section_button_form"> <!-- Save button -->
                    <button type="submit" class="button_green_form" id="btn-guardar-video-institucion" {{ ($count_videos >= 4) ? 'disabled' : '' }} data-text="{{ __('institucion.guardar') }}" data-text-loading="{{ __('institucion.cargando') }}..."> Guardar
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- Previous and next buttons -->
        <div class="container_button_form"> 
            <div class="section_button_form justify-content-between">
                <button type="submit" class="button_transparent_form" onclick="hideBtnPrevious(this)" code-position="galleryInst">
                    <img src="{{ asset('/img/formulario-profesional/icono-flecha-gris.svg') }}" class="pr-2"> Anterior
                </button>

                <a type="submit" class="button_blue_form" href="{{ route('PerfilInstitucion', ['slug' => $objFormulario->slug]) }}"> Finalizar
                    <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
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