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

                        <p class="texto_superior-tarjeta-register"> Registrarme como. </p>
                    </div>

                    @csrf
                    <div id="persona">
                        <div class="row section_input-option-register">
                            <div class="col-3 form-check input_option-register"> 
                                <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
                                <input class="form-check-input input_img-option" onclick="hideForm(this)" type="image" src="/img/iconos/icono-paciente.svg" name="idrol" value="1" data-position="paciente" checked>
                                <label class="form-check-label texto_option-input" for="idrol"> Paciente </label>
                            </div>

                            <div class="col-3 form-check input_option-register">
                                <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
                                <input class="form-check-input input_img-option" onclick="hideForm(this)" type="image" src="/img/iconos/icono-doctor.svg" name="idrol" value="2" data-position="doctor">
                                <label class="form-check-label texto_option-input" for="idrol"> Doctor/a </label>
                            </div>

                            <div class="col-3 form-check input_option-register"> 
                                <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
                                <input class="form-check-input input_img-option" onclick="hideForm(this)" type="image" src="/img/iconos/icono-institucion.svg" name="idrol" value="3" data-position="institucion">
                                <label class="form-check-label texto_option-input" for="idrol"> Institución </label>
                            </div>
                        </div>
                        <div class="names_person">
                            <div class="form-group row mb-md-0">
                                <label for="primernombre" class="col-md-12 col-form-label texto_label-register">{{ __('Nombres') }}</label>

                                <div class="col-md-6 mb-3 mb-md-0">
                                    <input id="primernombre" type="text" class="form-control @error('primernombre') is-invalid @enderror" name="primernombre" value="{{ old('primernombre') }}" required autocomplete="primernombre" autofocus placeholder="Primer Nombre">

                                    @error('primernombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- <label for="segundonombre" class="col-4 col-form-label">{{ __() }}</label> -->
                                <div class="col-md-6">
                                    <input id="segundonombre" type="text" class="form-control @error('segundonombre') is-invalid @enderror" name="segundonombre" value="{{ old('segundonombre') }}"  autofocus placeholder="Segundo Nombre">
                                </div>
                            </div>

                            <div class="form-group row mb-md-0">
                                <label for="primerapellido" class="col-md-12 col-form-label texto_label-register">{{ __('Apellidos') }}</label>

                                <div class="col-md-6 mb-3 mb-md-0">
                                    <input id="primerapellido" type="text" class="form-control @error('primerapellido') is-invalid @enderror" name="primerapellido" value="{{ old('primerapellido') }}" required autocomplete="primerapellido" autofocus placeholder="Primer Apellido">

                                    @error('primerapellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- <label for="segundoapellido" class="col-4 col-form-label">{{ __() }}</label> -->
                                <div class="col-md-6">
                                    <input id="segundoapellido" type="text" class="form-control @error('segundoapellido') is-invalid @enderror" name="segundoapellido" value="{{ old('segundoapellido') }}" autofocus placeholder="Segundo Apellido">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="institucion" class="names_institution">
                        <div class="form-group row name_institution">
                            <label for="nombreinstitucion" class="col-md-12 col-form-label texto_label-register">{{ __('Nombre Institución') }}</label>

                            <div class="col-md-12">
                                <input id="nombreinstitucion" type="text" class="form-control @error('nombreinstitucion') is-invalid @enderror" name="nombreinstitucion" value="{{ old('nombreinstitucion') }}" autofocus placeholder="Nombre Institucion">
                            </div>
                        </div>
                    </div>


                    <div class="datos_secundarios">
                        <div class="row">
                            <div class="form-group col-12 col-md-6 m-md-0">
                                <label for="tipodocumento" class="col-md-12 px-0 col-form-label texto_label-register">{{ __('Tipo Documento') }}</label>
                                
                                <select class="form-select col-12 form-control" name="tipodocumento" required>
                                    <option selected>Seleccione</option>
                                    <option value="1">Cedula Ciudadania</option>
                                    <option value="2">Cedula Extranjeria </option>
                                    <option value="3">Cedula Extranjeria </option>
                                    <option value="4">Nit </option>
                                </select>      
                            </div>

                            <div class="form-group col-md-6 m-md-0">
                                <label for="numerodocumento" class="col-md-12 pl-0 col-form-label texto_label-register">{{ __('Numero Documento') }}</label>
                                <div class="col-md-12 p-0">
                                    <input id="numerodocumento" type="number" class="form-control @error('numerodocumento') is-invalid @enderror" name="numerodocumento" value="{{ old('numerodocumento') }}" required autocomplete="numerodocumento" autofocus>
                                    @error('numerodocumento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
 
                        <div class="form-group col-12 p-0 m-md-0">
                            <label for="email" class="col-md-12 pl-0 col-form-label texto_label-register">{{ __('Correo electrónico') }}</label>

                            <div class="col-12 p-0">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Ejemplo: (mail@gmail.com)">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password" class="col-md-12 px-0 col-form-label texto_label-register">{{ __('Contraseña') }}</label>

                                <div class="col-md-12 px-0">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña"> 
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="password-confirm" class="col-md-12 pl-0 col-form-label texto_label-register">{{ __('Confirmar contraseña') }}</label>

                                <div class="col-md-12 px-0">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Contraseña">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <input type="checkbox" class="check_option-register" id=""> 
                                <div class="col-12 section_terminos-register">
                                    <span class="texto_inferior-tarjeta-register"> Declaro que he leído y acepto la <a href="#" class="text_link-register">Política de Privacidad</a> y los <a href="#" class="text_link-register">Términos y condiciones</a> de Zaabra Salud. </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12 section_option-promo-register">
                                <input type="checkbox" class="check_option-register" id=""> 
                                <div class="col-12 section_terminos-register">
                                    <span class="texto_inferior-tarjeta-register"> Me gustaría recibir comunicaciones promocionales. </span>
                                </div>        
                            </div>
                        </div>

                        <div class="form-group col-12 section_terminos-register">
                            <p class="texto_inferior-tarjeta-register"> Recibirá un e-mail de confirmación. </p>
                        </div>

                        <div class="form-group row mb-2 mb-md-0">
                            <div class="col-12 content_btn-ingresar-register">
                                <button type="submit" class="btn_Ingreso-register"> {{ __('Ingresar') }}
                                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-register" alt=""> 
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
