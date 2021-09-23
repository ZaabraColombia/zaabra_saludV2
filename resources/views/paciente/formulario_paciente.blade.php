@extends('layouts.app')

@section('styles')

@endsection

@section('content')

    {{--Datos Basicos paciente--}}
    <section class="container">
        <form action="{{ route('paciente.formulario-basico') }}" id="form-basico-paciente" class="form">
            <div class="row">
                <div class="col-12">
                    <div id="mensajes-basico" class="col-12"></div>
                    <div class="col-md-3 contain_imgUsuario-formImg">
                        <img id="img-foto_paciente" class="img-foto_paciente" src="{{ (isset($paciente->foto)) ? asset($paciente->foto) : ''}}">
                        <input type="file" class="input_imgUsuario-formInst" name="foto_paciente"  id="foto_paciente" onchange="ver_imagen('logo_institucion', 'img-foto_paciente')" accept="image/png, image/jpeg">
                        <p class="icon_subirFoto-formInst"> Subir foto de logo </p>
                    </div>

                    <div class="form-inline">
                        <label for="primer_nombre" class="col-12 col-form-label texto_label-register">{{ __('paciente.nombres') }}</label>
                        <div class="form-group col-md-6">
                            <input id="primer_nombre" type="text" class="form-control" name="primer_nombre" value="{{ old('primer_nombre', $user->primernombre) }}"  placeholder="Primer Nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <input id="segundo_nombre" type="text" class="form-control" name="segundo_nombre" value="{{ old('segundo_nombre', $user->segundonombre) }}"  placeholder="Segundo Nombre">
                        </div>
                    </div>

                    <!-- Campos de Apellidos -->
                    <div class="form-inline">
                        <label for="primer_apellido" class="col-12 col-form-label texto_label-register">{{ __('paciente.apellidos') }}</label>
                        <div class="col-md-6">
                            <input id="primer_apellido" type="text" class="form-control" name="primer_apellido" value="{{ old('primer_apellido', $user->primerapellido) }}"  placeholder="Primer Apellido">
                        </div>
                        <div class="col-md-6">
                            <input id="segundo_apellido" type="text" class="form-control" name="segundo_apellido" value="{{ old('segundo_apellido', $user->segundoapellido) }}" placeholder="Segundo Apellido">
                        </div>
                    </div>

                    <!-- Campo Tipo de documento -->
                    <div class="form-inline">
                        <div class="col-md-6 form-group">
                            <label for="tipo_documento" class="col-12 col-form-label texto_label-register">{{ __('paciente.tipo-documento') }}</label>
                            <select class="form-control" name="tipo_documento" id="tipo_documento">
                                <option> Seleccione </option>
                                <option value="1" {{ old('tipo_documento',$user->tipodocumento) == $user->tipodocumento ? 'selected' : ''}}> Cedula Ciudadania </option>
                                <option value="2" {{ old('tipo_documento',$user->tipodocumento) == $user->tipodocumento ? 'selected' : ''}}> Cedula Extranjeria </option>
                                <option value="3" {{ old('tipo_documento',$user->tipodocumento) == $user->tipodocumento ? 'selected' : ''}}> Nit </option>
                            </select>
                        </div>
                        <!-- Número de documento -->
                        <div class="form-group col-md-6">
                            <label for="numero_documento" class="col-12 col-form-label texto_label-register">{{ __('paciente.numero-documento') }}</label>
                            <input id="numero_documento" type="text" class="form-control" name="numero_documento" value="{{ old('numero_documento', $user->numerodocumento) }}" />
                        </div>
                    </div>

                    <!-- Correo electrónico -->
                    <div class="form-group col-12">
                        <label for="correo" class="col-12 col-form-label texto_label-register">{{ __('paciente.correo-electrónico') }}</label>
                        <input id="correo" type="email" class="form-control" name="correo" value="{{ old('correo', $user->email) }}" />
                    </div>

                    <!-- Celular -->
                    <div class="col-md-6 leftSection_formInst">
                        <label for="celular" class="col-12 text_label-formInst"> {{ __('paciente.celular') }} </label>
                        <input class="form-control" id="celular" placeholder="Número de celular" type="number" name="celular" value="{{ old('celular', $paciente->celular) }}">
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-6 rightSection_formInst">
                        <label for="telefono" class="col-12 text_label-formInst"> {{ __('paciente.teléfono-fijo') }} </label>
                        <input class="form-control" id="telefono" placeholder="Número Teléfono" type="number" name="telefono" value="{{ old('telefono', $paciente->telefono) }}">
                    </div>

                    <!-- Direccion -->
                    <div class="col-md-6 leftSection_formInst">
                        <label for="direccion" class="col-12 text_label-formInst"> {{ __('paciente.direccion') }} </label>
                        <input class="form-control" id="direccion" placeholder="Dirección" type="text" name="direccion" value="{{ old('direccion', $paciente->direccion) }}">
                    </div>

                    <!--menu dinamico ciudades -->
                    <div class="col-md-6 rightSection_formInst">
                        <label for="pais" class="col-12 text_label-formInst"> {{ __('paciente.seleccione-pais') }} </label>
                        <select id="pais" name="pais" class="form-control">
                            <option></option>
                            @foreach($listaPaises as $pais)
                                <option value="{{ $pais->id_pais }}"  {{ (old('pais', $paciente->id_pais) == $pais->id_pais) ? 'selected' : ''}}> {{ $pais->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 leftSection_formInst">
                        <label for="departamento" class="col-12 text_label-formInst"> {{ __('paciente.seleccione-departamento') }} </label>
                        <select name="departamento" id="departamento" class="form-control">
                            @foreach($listaDepartamentos as $departamento)
                                <option value="{{ $departamento->id_departamento }}"  {{ (old('departamento', $paciente->id_departamento) == $departamento->id_departamento) ? 'selected' : ''}}> {{ $departamento->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 rightSection_formInst">
                        <label for="provincia" class="col-12 text_label-formInst"> {{ __('paciente.seleccione-provincia') }} </label>
                        <select name="provincia" id="provincia" class="form-control">
                            @foreach($listaProvincias as $provincia)
                                <option value="{{ $provincia->id_provincia }}"  {{ (old('provincia', $paciente->id_provincia) == $provincia->id_provincia) ? 'selected' : ''}}> {{ $provincia->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 leftSection_formInst">
                        <label for="municipio" class="col-12 text_label-formInst"> {{ __('paciente.seleccione-municipio') }} </label>
                        <select name="municipio" id="municipio" class="form-control">
                            @foreach($listaMunicipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}"  {{ (old('municipio', $paciente->id_municipio) == $municipio->id_municipio) ? 'selected' : ''}}> {{ $municipio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- EPS -->
                    <div class="form-group col-12">
                        <label for="eps" class="col-12 col-form-label texto_label-register">{{ __('paciente.eps-regimen-medico') }}</label>
                        <input id="eps" type="text" class="form-control" name="eps" value="{{ old('eps', $paciente->eps) }}" />
                    </div>

                    <!-- Boton Guardar -->
                    <div class="form-group col-12">
                        <button class="btn btn-primary" id="btn-guardar-basico-paciente">
                            {{ __('paciente.guardar') }} <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    {{--Cambiar contraseña paciente--}}
    <section class="container">
        <form action="{{ route('paciente.formulario-password') }}" id="form-password-paciente" class="form" method="post">
            <div class="row">
                <div class="col-12" id="mensajes-password"></div>
                <div class="col-12">
                    <!-- contraseña actual -->
                    <div class="form-group">
                        <label for="password">{{ __('paciente.contraseña-actual') }}</label>
                        <input type="password" class="form-control" id="password" name="password" />
                    </div>
                    <!-- contraseña nueva -->
                    <div class="form-group">
                        <label for="password_new">{{ __('paciente.contraseña-nueva') }}</label>
                        <input type="password" class="form-control" id="password_new" name="password_new" />
                    </div>
                    <!-- repetir contraseña -->
                    <div class="form-group">
                        <label for="password_new_confirmation">{{ __('paciente.contraseña-repetir') }}</label>
                        <input type="password" class="form-control" id="password_new_confirmation" name="password_new_confirmation" />
                    </div>
                    <!-- Boton guardar -->
                    <div class="form-group">
                        <button class="btn btn-primary" id="btn-guardar-password-paciente">
                            {{ __('paciente.guardar') }} <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection

@section('scripts')
    <script src="{{ asset('js/formulario-paciente.js') }}"></script>
@endsection
