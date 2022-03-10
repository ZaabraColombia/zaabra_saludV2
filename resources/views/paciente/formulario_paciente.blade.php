@extends('layouts.app-admin')

@section('styles')

@endsection

@section('content')

    {{--Datos Basicos paciente--}}
    <div class="container_module_form">
        <div class="title_main_form mt-5">
            <h5>LE DAMOS LA BIENVENIDA A ZAABRA SALUD</h5>
            <p>* &nbsp; Ingrese los datos según corresponda y finalice el proceso completamente en línea.</p>
        </div>

        <!-- 1. Personal information -->
        <div class="card_module_form">
            <h5 class="icon_text icon_basicInfo_formProf">Información básica</h5>
            <div id="mensajes-basico" class="col-12"></div>

            <form action="{{ route('paciente.formulario-basico') }}" id="form-basico-paciente" class="pb-2">
                @csrf
                <div class="row m-0 py-3 px-0">
                    <div class="col-md-3 img_user_form"> <!-- User image -->
                        <img id="imagenPrevisualizacion" src="{{ (isset($paciente->foto)) ? asset($paciente->foto) : ''}}">
                        <input id="seleccionArchivos" type="file" name="foto_paciente" onchange="ver_imagen('foto_paciente', 'img_foto_paciente')" accept="image/png, image/jpeg">
                        <p>Subir foto de perfil</p>
                    </div>

                    <div class="col-md-9 line_vertical_form"> <!-- Personal information -->
                        <div class="row m-0">
                            <div class="col-lg-6 p-0 pr-lg-1">
                                <label for="primer_nombre" class="label_txt_form">{{ __('paciente.nombres') }}</label>
                                <div class="section_input_double_form">
                                    <input id="primer_nombre" class="input_box_form mb-2 mb-md-0 mr-md-1" type="text" name="primer_nombre" value="{{ old('primer_nombre', $user->primernombre) }}"  placeholder="Primer Nombre">
                                    <input id="segundo_nombre" class="input_box_form ml-md-1" type="text" name="segundo_nombre" value="{{ old('segundo_nombre', $user->segundonombre) }}"  placeholder="Segundo Nombre">
                                </div>
                            </div>

                            <div class="col-lg-6 p-0 pl-lg-1">
                                <label for="primer_apellido" class="label_txt_form">{{ __('paciente.apellidos') }}</label>
                                <div class="section_input_double_form">
                                    <input id="primer_apellido" class="input_box_form mb-2 mb-md-0 mr-md-1" type="text" name="primer_apellido" value="{{ old('primer_apellido', $user->primerapellido) }}"  placeholder="Primer Apellido">
                                    <input id="segundo_apellido" class="input_box_form ml-md-1" type="text" name="segundo_apellido" value="{{ old('segundo_apellido', $user->segundoapellido) }}" placeholder="Segundo Apellido">
                                </div>
                            </div>

                            <div class="col-lg-6 p-0 pr-lg-1">
                                <label for="tipo_documento" class="label_txt_form">{{ __('paciente.tipo-documento') }}</label>
                                <select id="tipo_documento" class="input_box_form" name="tipo_documento">
                                    <option> Seleccione </option>
                                    <option value="1" {{ old('tipo_documento',$user->tipodocumento) == $user->tipodocumento ? 'selected' : ''}}> Cedula Ciudadania </option>
                                    <option value="2" {{ old('tipo_documento',$user->tipodocumento) == $user->tipodocumento ? 'selected' : ''}}> Cedula Extranjeria </option>
                                    <option value="3" {{ old('tipo_documento',$user->tipodocumento) == $user->tipodocumento ? 'selected' : ''}}> Nit </option>
                                </select>

                            </div>

                            <div class="col-lg-6 p-0 pl-lg-1">
                                <label for="numero_documento" class="label_txt_form">{{ __('paciente.numero-documento') }}</label>
                                <input id="numero_documento" class="input_box_form" type="text" name="numero_documento" value="{{ old('numero_documento', $user->numerodocumento) }}" />
                            </div>


                            <div class="col-lg-6 p-0 pr-lg-1">
                                <label for="correo" class="label_txt_form">{{ __('paciente.correo-electrónico') }}</label>
                                <input id="correo" class="input_box_form" type="email" name="correo" value="{{ old('correo', $user->email) }}" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section_button_form">  <!-- Save button -->
                    <button id="btn-guardar-basico-paciente" class="button_blue_form" data-text="{{ __('paciente.guardar') }}" data-text-loading="{{ __('paciente.cargando') }}..."> {{ __('paciente.guardar') }}
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 2. Contac information -->
        <div class="card_module_form">
            <h5 class="icon_text icon_infoContac_Prof">Información de contacto</h5>
            <form action="{{ route('paciente.formulario-contacto') }}" id="form-basico-contacto" class="pb-2">
                @csrf
                <div class="row m-0 py-3 px-0">
                    <div id="mensajes-contacto" class="col-12"></div>

                    <div class="col-md-6 p-0 pr-md-1">
                        <label for="celular" class="label_txt_form"> {{ __('paciente.celular') }} </label>
                        <input id="celular" class="input_box_form" type="number" placeholder="Número de celular" name="celular" value="{{ old('celular', $paciente->celular) }}">
                    </div>

                    <div class="col-md-6 p-0 pl-md-1">
                        <label for="telefono" class="label_txt_form"> {{ __('paciente.teléfono-fijo') }} </label>
                        <input id="telefono" class="input_box_form" type="number" placeholder="Número Teléfono" name="telefono" value="{{ old('telefono', $paciente->telefono) }}">
                    </div>

                    <div class="col-md-6 p-0 pr-md-1">
                        <label for="direccion" class="label_txt_form"> {{ __('paciente.direccion') }} </label>
                        <input id="direccion" class="input_box_form" type="text" placeholder="Dirección" name="direccion" value="{{ old('direccion', $paciente->direccion) }}">
                    </div>

                    <div class="col-md-6 p-0 pl-md-1">
                        <label for="pais" class="label_txt_form"> {{ __('paciente.seleccione-pais') }} </label>
                        <select id="pais" class="input_box_form" name="pais">
                            <option></option>
                            @foreach($listaPaises as $pais)
                                <option value="{{ $pais->id_pais }}"  {{ (old('pais', $paciente->id_pais) == $pais->id_pais) ? 'selected' : ''}}> {{ $pais->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 p-0 pr-md-1">
                        <label for="departamento" class="label_txt_form"> {{ __('paciente.seleccione-departamento') }} </label>
                        <select id="departamento" class="input_box_form" name="departamento">
                            @foreach($listaDepartamentos as $departamento)
                                <option value="{{ $departamento->id_departamento }}"  {{ (old('departamento', $paciente->id_departamento) == $departamento->id_departamento) ? 'selected' : ''}}> {{ $departamento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 p-0 pl-md-1">
                        <label for="provincia" class="label_txt_form"> {{ __('paciente.seleccione-provincia') }} </label>
                        <select id="provincia" class="input_box_form" name="provincia">
                            @foreach($listaProvincias as $provincia)
                                <option value="{{ $provincia->id_provincia }}"  {{ (old('provincia', $paciente->id_provincia) == $provincia->id_provincia) ? 'selected' : ''}}> {{ $provincia->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 p-0 pr-md-1">
                        <label for="municipio" class="label_txt_form"> {{ __('paciente.seleccione-municipio') }} </label>
                        <select id="municipio" class="input_box_form" name="municipio">
                            @foreach($listaMunicipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}"  {{ (old('municipio', $paciente->id_municipio) == $municipio->id_municipio) ? 'selected' : ''}}> {{ $municipio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 p-0 pl-md-1">
                        <label for="eps" class="label_txt_form">{{ __('paciente.eps-regimen-medico') }}</label>
                        <input id="eps" class="input_box_form" type="text" name="eps" value="{{ old('eps', $paciente->eps) }}" />
                    </div>
                </div>

                <div class="section_button_form">  <!-- Save button -->
                    <button id="btn-guardar-contacto-paciente" class="button_blue_form" data-text="{{ __('paciente.guardar') }}" data-text-loading="{{ __('paciente.cargando') }}..."> {{ __('paciente.guardar') }}
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>

        <!-- 3. Recover password -->
        <div class="card_module_form">
            <h5 class="icon_text icon_basicInfo_formProf">Actualizar contraseña</h5>

            <form action="{{ route('paciente.formulario-password') }}" id="form-password-paciente" method="post" class="pb-2">
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
                    <button class="button_blue_form" id="btn-guardar-password-paciente" data-text="{{ __('paciente.guardar') }}" data-text-loading="{{ __('paciente.cargando') }}..."> {{ __('paciente.guardar') }}
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/formulario-paciente.js') }}"></script>
    <script src="{{ asset('js/cargaFoto.js') }}"></script>
@endsection
