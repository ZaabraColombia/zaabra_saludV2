@extends('layouts.app')

@section('content')
<!-- contenedor principal -->
<div class="container-fluid contenedorPrin_Register">
    <!-- fila principal -->
    <div class="row justify-content-center">
        <!-- titulo principal -->
        <p class="titulo_principal-register"> Acceda a nuestro portal de Zaabra Salud o regístrese. </p>
        <!-- contenedor de elementos login -->
        <div class="card col-11 col-lg-8 section_principal-register">
            <!-- seccion body login -->
            <div class="card-body section_body-register">
                <form method="POST" action="{{ route('register') }}">
                    <!-- seccion iniciar sesion y creaar cuenta -->
                    <div class="row card-header content_iniciar-crear">
                        <div class="col-6 section_texto-inicio">
                            <a href="{{ route('login') }}" class="texto_iniciar-register"> Iniciar Sesión </a>
                        </div>

                        <div class="col-6 section_texto-registro">
                            <span> {{ __('Crear cuenta') }} </span>
                        </div>

                        <p class="texto_-interno-register"> Registrarme como. </p>
                    </div>

                    @csrf
                    <div id="persona">
                        <div class="row section_input-option-register">
                            <div class="form-check input_option-register"> 
                                <input class="form-check-input input_img-option" onclick="hideForm(this)" type="image" src="/img/iconos/icono-paciente.svg" name="idrol1" id="idrol1" value="1" data-position="paciente" checked>
                                <label class="form-check-label texto_option-input" for="idrol"> Paciente </label>
                            </div>

                            <div class="form-check input_option-register">
                                <input class="form-check-input input_img-option" onclick="hideForm(this)" type="image" src="/img/iconos/icono-doctor.svg" name="idrol2" id="idrol2" value="2" data-position="doctor">
                                <label class="form-check-label texto_option-input" for="idrol"> Doctor/a </label>
                            </div>

                            <div class="form-check input_option-register"> 
                                <input class="form-check-input input_img-inst-option" onclick="hideForm(this)" type="image" src="/img/iconos/icono-institucion.svg" name="idrol3" id="idrol3" value="3" data-position="institucion">
                                <label class="form-check-label texto_option-input" for="idrol"> Institución </label>
                            </div>
                        </div>
                        <div class="names_person">
                            <div class="form-group row">
                                <label for="primernombre" class="col-md-4 col-form-label texto_label-register">{{ __('Nombres') }}</label>

                                <div class="col-md-6">
                                    <input id="primernombre" type="text" class="form-control @error('primernombre') is-invalid @enderror" name="primernombre" value="{{ old('primernombre') }}" required autocomplete="primernombre" autofocus placeholder="Primer Nombre">

                                    @error('primernombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="segundonombre" class="col-md-4 col-form-label">{{ __() }}</label>

                                <div class="col-md-6">
                                    <input id="segundonombre" type="text" class="form-control @error('segundonombre') is-invalid @enderror" name="segundonombre" value="{{ old('segundonombre') }}"  autofocus placeholder="Segundo Nombre">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="primerapellido" class="col-md-4 col-form-label texto_label-register">{{ __('Apellidos') }}</label>

                                <div class="col-md-6">
                                    <input id="primerapellido" type="text" class="form-control @error('primerapellido') is-invalid @enderror" name="primerapellido" value="{{ old('primerapellido') }}" required autocomplete="primerapellido" autofocus placeholder="Primer Apellido">

                                    @error('primerapellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="segundoapellido" class="col-md-4 col-form-label">{{ __() }}</label>

                                <div class="col-md-6">
                                    <input id="segundoapellido" type="text" class="form-control @error('segundoapellido') is-invalid @enderror" name="segundoapellido" value="{{ old('segundoapellido') }}" autofocus placeholder="Segundo Apellido">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="institucion" class="names_institution">
                        <div class="form-group row name_institution">
                            <label for="nombreinstitucion" class="col-md-4 col-form-label texto_label-register">{{ __('Nombre Institución') }}</label>

                            <div class="col-md-6">
                                <input id="nombreinstitucion" type="text" class="form-control @error('nombreinstitucion') is-invalid @enderror" name="nombreinstitucion" value="{{ old('nombreinstitucion') }}" autofocus placeholder="Nombre Institucion">
                            </div>
                        </div>
                    </div>


                    <div class="datos_secundarios">
                        <div class="form-group">
                            <label for="tipodocumento" class="col-md-4 px-0 col-form-label texto_label-register">{{ __('Tipo Documento') }}</label>
                            
                            <select class="form-select col-12 form-control" name="tipodocumento" required>
                                <option selected>Seleccione</option>
                                <option value="1">Cedula Ciudadania</option>
                                <option value="2">Cedula Extranjeria </option>
                                <option value="3">Cedula Extranjeria </option>
                                <option value="4">Nit </option>
                            </select>      
                        </div>

                        <div class="form-group row">
                            <label for="numerodocumento" class="col-md-4 col-form-label texto_label-register">{{ __('Numero Documento') }}</label>
                            <div class="col-md-6">
                                <input id="numerodocumento" type="number" class="form-control @error('numerodocumento') is-invalid @enderror" name="numerodocumento" value="{{ old('numerodocumento') }}" required autocomplete="numerodocumento" autofocus>
                                @error('numerodocumento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label texto_label-register">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Ejemplo: (mail@gmail.com)">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label texto_label-register">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña"> 
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label texto_label-register">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Contraseña">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <input type="checkbox" class="btn-checkBox-footerCel" id="aceptoTerminosNewLetter-cell"> 
                                <span class="texto_-interno-register"> Declaro que he leído y acepto la <a href="#" class="text_link-register">Política de Privacidad</a> y los <a href="#" class="text_link-register">Términos y condiciones</a> de Zaabra Salud. </span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <input type="checkbox" class="btn-checkBox-footerCel texto_-interno-register" id="aceptoTerminosNewLetter-cell"> 
                                <span class="texto_-interno-register"> Me gustaría recibir comunicaciones promocionales. </span>
                            </div>
                        </div>

                        <p class="mt-2"> Recibirá un e-mail de confirmación. </p>

                        <div class="form-group row my-2">
                            <div class="col-12 content_btn-ingresar-login">
                                <button type="submit" class="btn_Ingreso-login"> {{ __('Ingresar') }}
                                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-login" alt=""> 
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
