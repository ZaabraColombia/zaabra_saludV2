@extends('layouts.app')

@section('styles')

@endsection

@section('content')

    {{--Datos Basicos paciente--}}
    <section class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('paciente.formulario-basico') }}" id="form-basico-paciente" class="form">
                    <div class="form-inline">
                        <label for="primer_nombre" class="col-12 col-form-label texto_label-register">{{ __('Nombres *') }}</label>
                        <div class="form-group col-md-6">
                            <input id="primer_nombre" type="text" class="form-control" name="primer_nombre" value="{{ old('primer_nombre', $user->primernombre) }}"  placeholder="Primer Nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <input id="segundo_nombre" type="text" class="form-control" name="segundo_nombre" value="{{ old('segundo_nombre', $user->segundonombre) }}"  placeholder="Segundo Nombre">
                        </div>
                    </div>

                    <!-- Campos de Apellidos -->
                    <div class="form-inline">
                        <label for="primer_apellido" class="col-12 col-form-label texto_label-register">{{ __('Apellidos *') }}</label>
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
                            <label for="tipo_documento" class="col-12 col-form-label texto_label-register">{{ __('Tipo Documento *') }}</label>
                            <select class="form-control" name="tipo_documento" id="tipo_documento">
                                <option> Seleccione </option>
                                <option value="1" {{ old('tipo_documento',$user->tipodocumento) == $user->tipodocumento ? 'selected' : ''}}> Cedula Ciudadania </option>
                                <option value="2" {{ old('tipo_documento',$user->tipodocumento) == $user->tipodocumento ? 'selected' : ''}}> Cedula Extranjeria </option>
                                <option value="3" {{ old('tipo_documento',$user->tipodocumento) == $user->tipodocumento ? 'selected' : ''}}> Nit </option>
                            </select>
                        </div>
                        <!-- Número de documento -->
                        <div class="form-group col-md-6">
                            <label for="numero_documento" class="col-12 col-form-label texto_label-register">{{ __('Numero Documento *') }}</label>
                            <input id="numero_documento" type="text" class="form-control" name="numero_documento" value="{{ old('numero_documento') }}" />
                        </div>
                    </div>

                    <!-- Correo electrónico -->
                    <div class="form-group col-12">
                        <label for="correo" class="col-12 col-form-label texto_label-register">{{ __('Correo electrónico *') }}</label>
                        <input id="correo" type="email" class="form-control" name="correo" value="{{ old('correo') }}" />
                    </div>

                    <!-- Correo electrónico -->
                    <div class="form-group col-12">
                        <label for="correo" class="col-12 col-form-label texto_label-register">{{ __('Correo electrónico *') }}</label>
                        <input id="correo" type="email" class="form-control" name="correo" value="{{ old('correo') }}" />
                    </div>

                    <!-- Contraseña -->
{{--                    <div class="form-inline">--}}
{{--                        <div class="col-md-6 form-group">--}}
{{--                            <label for="contraseña" class="col-md-12 px-0 col-form-label texto_label-register">{{ __('Contraseña *') }}</label>--}}
{{--                            <input id="contraseña" type="password" class="form-control" name="contraseña">--}}
{{--                        </div>--}}
{{--                        <!-- Confirmar contraseña -->--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="contraseña-confirm" class="col-md-12 pl-0 col-form-label texto_label-register">{{ __('Confirmar contraseña *') }}</label>--}}
{{--                            <input id="contraseña-confirm" type="password" class="form-control" name="contraseña_confirmation" />--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </form>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="{{ asset('') }}"></script>
@endsection
