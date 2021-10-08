@extends('layouts.app')

@section('styles')

@endsection

@section('content')

    {{--Datos Basicos paciente--}}
    <section class="container">
        <div class="cabecera_forPacien">
            <h5 class="titulo_forPacien"> LE DAMOS LA BIENVENIDA A ZAABRA SALUD </h5>
            <p class="subTitulo_forPacien"> * &nbsp; Ingrese los datos según corresponda y finalice el proceso completamente en línea. </p>
        </div>

        <form action="{{ route('paciente.formulario-basico') }}" id="form-basico-paciente" class="form">
            <div class="tarjeta_datosSecun_formPaciente">
                <div id="mensajes-basico" class="col-12"></div>

                <div class="containt_img_formPacien">
                    <!-- foto perfil usuario -->
                    <div class="content_img_formPacien">
                        <img id="img_foto_paciente" class="img_paciente_formPacien" src="{{ (isset($paciente->foto)) ? asset($paciente->foto) : ''}}">
                        <input id="foto_paciente" class="input_imgUsuario-formPacien" type="file" name="foto_paciente" onchange="ver_imagen('foto_paciente', 'img_foto_paciente')" accept="image/png, image/jpeg">
                        <p class="subirFoto_formPacien"> Subir foto de logo </p>
                    </div>
                </div>

                <div class="content_datosBasic_formPacien">
                    <!-- Campos de nombres -->
                    <div class="content_options_formPacien">
                        <label for="primer_nombre" class="text_label_formPacien">{{ __('paciente.nombres') }}</label>

                        <div class="content_nombre_forPacien">
                            <input id="primer_nombre" class="form-control mr-md-2" type="text" name="primer_nombre" value="{{ old('primer_nombre', $user->primernombre) }}"  placeholder="Primer Nombre">

                            <input id="segundo_nombre" class="form-control" type="text" name="segundo_nombre" value="{{ old('segundo_nombre', $user->segundonombre) }}"  placeholder="Segundo Nombre">
                        </div>
                    </div>

                    <!-- Campos de Apellidos -->
                    <div class="content_options_formPacien">
                        <label for="primer_apellido" class="text_label_formPacien">{{ __('paciente.apellidos') }}</label>

                        <div class="content_nombre_forPacien">
                            <input id="primer_apellido" class="form-control mr-md-2" type="text" name="primer_apellido" value="{{ old('primer_apellido', $user->primerapellido) }}"  placeholder="Primer Apellido">

                            <input id="segundo_apellido" class="form-control" type="text" name="segundo_apellido" value="{{ old('segundo_apellido', $user->segundoapellido) }}" placeholder="Segundo Apellido">
                        </div>
                    </div>

                    <div class="documento_formPacien">
                        <!-- Campo Tipo de documento -->
                        <div class="content_documento_formPacien">
                            <label for="tipo_documento" class="text_label_formPacien">{{ __('paciente.tipo-documento') }}</label>

                            <div class="content_inputs_forPacien">
                                <select id="tipo_documento" class="form-control mr-md-1" name="tipo_documento">
                                    <option> Seleccione </option>
                                    <option value="1" {{ old('tipo_documento',$user->tipodocumento) == $user->tipodocumento ? 'selected' : ''}}> Cedula Ciudadania </option>
                                    <option value="2" {{ old('tipo_documento',$user->tipodocumento) == $user->tipodocumento ? 'selected' : ''}}> Cedula Extranjeria </option>
                                    <option value="3" {{ old('tipo_documento',$user->tipodocumento) == $user->tipodocumento ? 'selected' : ''}}> Nit </option>
                                </select>
                            </div>
                        </div>

                        <!-- Número de documento -->
                        <div class="content_documento_formPacien">
                            <label for="numero_documento" class="text_label_formPacien">{{ __('paciente.numero-documento') }}</label>

                            <div class="content_inputs_forPacien">
                                <input id="numero_documento" class="form-control ml-md-1" type="text" name="numero_documento" value="{{ old('numero_documento', $user->numerodocumento) }}" />
                            </div>
                        </div>
                    </div>

                    <!-- Correo electrónico -->
                    <div class="content_options_formPacien">
                        <label for="correo" class="text_label_formPacien">{{ __('paciente.correo-electrónico') }}</label>

                        <div class="content_inputs_forPacien">
                            <input id="correo" class="form-control" type="email" name="correo" value="{{ old('correo', $user->email) }}" />
                        </div>
                    </div>
                </div>
                <!-- Boton Guardar -->
                <div class="content_btnGuardar_formPacien">
                    <button id="btn-guardar-basico-paciente" class="btn btn-primary" data-text="{{ __('paciente.guardar') }}" data-text-loading="{{ __('paciente.cargando') }}...">
                        {{ __('paciente.guardar') }}
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </form>

        <form action="{{ route('paciente.formulario-contacto') }}" id="form-basico-contacto" class="form">
            <div class="tarjeta_datosSecun_formPaciente">
                <div id="mensajes-contacto" class="col-12"></div>
                <!-- Celular -->
                <div class="datosSecond_formPacien">
                    <div class="content_options_formPacien">
                        <label for="celular" class="text_label_formPacien"> {{ __('paciente.celular') }} </label>

                        <div class="content_inputs_forPacien">
                            <input id="celular" class="form-control" type="number" placeholder="Número de celular" name="celular" value="{{ old('celular', $paciente->celular) }}">
                        </div>
                    </div>

                    <!-- Teléfono -->
                    <div class="content_options_formPacien">
                        <label for="telefono" class="text_label_formPacien"> {{ __('paciente.teléfono-fijo') }} </label>

                        <div class="content_inputs_forPacien">
                            <input id="telefono" class="form-control" type="number" placeholder="Número Teléfono" name="telefono" value="{{ old('telefono', $paciente->telefono) }}">
                        </div>
                    </div>

                    <!-- Direccion -->
                    <div class="content_options_formPacien">
                        <label for="direccion" class="text_label_formPacien"> {{ __('paciente.direccion') }} </label>

                        <div class="content_inputs_forPacien">
                            <input id="direccion" class="form-control" type="text" placeholder="Dirección" name="direccion" value="{{ old('direccion', $paciente->direccion) }}">
                        </div>
                    </div>

                    <!--menu dinamico ciudades -->
                    <div class="content_options_formPacien">
                        <label for="pais" class="text_label_formPacien"> {{ __('paciente.seleccione-pais') }} </label>

                        <div class="content_inputs_forPacien">
                            <select id="pais" class="form-control" name="pais">
                                <option></option>
                                @foreach($listaPaises as $pais)
                                    <option value="{{ $pais->id_pais }}"  {{ (old('pais', $paciente->id_pais) == $pais->id_pais) ? 'selected' : ''}}> {{ $pais->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="datosSecond_formPacien">
                    <!-- Departamento -->
                    <div class="content_options_formPacien">
                        <label for="departamento" class="text_label_formPacien"> {{ __('paciente.seleccione-departamento') }} </label>

                        <div class="content_inputs_forPacien">
                            <select id="departamento" class="form-control" name="departamento">
                                @foreach($listaDepartamentos as $departamento)
                                    <option value="{{ $departamento->id_departamento }}"  {{ (old('departamento', $paciente->id_departamento) == $departamento->id_departamento) ? 'selected' : ''}}> {{ $departamento->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Provincia -->
                    <div class="content_options_formPacien">
                        <label for="provincia" class="text_label_formPacien"> {{ __('paciente.seleccione-provincia') }} </label>

                        <div class="content_inputs_forPacien">
                            <select id="provincia" class="form-control" name="provincia">
                                @foreach($listaProvincias as $provincia)
                                    <option value="{{ $provincia->id_provincia }}"  {{ (old('provincia', $paciente->id_provincia) == $provincia->id_provincia) ? 'selected' : ''}}> {{ $provincia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Municipio -->
                    <div class="content_options_formPacien">
                        <label for="municipio" class="text_label_formPacien"> {{ __('paciente.seleccione-municipio') }} </label>

                        <div class="content_inputs_forPacien">
                            <select id="municipio" class="form-control" name="municipio">
                                @foreach($listaMunicipios as $municipio)
                                    <option value="{{ $municipio->id_municipio }}"  {{ (old('municipio', $paciente->id_municipio) == $municipio->id_municipio) ? 'selected' : ''}}> {{ $municipio->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- EPS -->
                    <div class="content_options_formPacien">
                        <label for="eps" class="text_label_formPacien">{{ __('paciente.eps-regimen-medico') }}</label>

                        <div class="content_inputs_forPacien">
                            <input id="eps" class="form-control" type="text" name="eps" value="{{ old('eps', $paciente->eps) }}" />
                        </div>
                    </div>
                </div>

                <!-- Boton Guardar -->
                <div class="content_btnGuardar_formPacien">
                    <button id="btn-guardar-contacto-paciente" class="btn btn-primary" data-text="{{ __('paciente.guardar') }}" data-text-loading="{{ __('paciente.cargando') }}...">
                        {{ __('paciente.guardar') }}
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </form>

    </section>

    {{--Cambiar contraseña paciente--}}
    <section class="container">
        <form action="{{ route('paciente.formulario-password') }}" id="form-password-paciente" class="form" method="post">
            <div class="tarjeta_datosSecun_formPaciente">
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

                    <div class="content_inputs_forPacien" class="text_label_formPacien">
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
                <div class="content_btnGuardar_formPacien">
                    <button class="btn btn-primary" id="btn-guardar-password-paciente" data-text="{{ __('paciente.guardar') }}" data-text-loading="{{ __('paciente.cargando') }}...">
                        {{ __('paciente.guardar') }}
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </form>
    </section>

@endsection

@section('scripts')
    <script src="{{ asset('js/formulario-paciente.js') }}"></script>
    <script src="{{ asset('js/cargaFoto.js') }}"></script>
@endsection
