@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="background: #F9F9F9">
        <div class="row justify-content-center py-4 py-md-5">
            <div class="w-100">
                <h1 class="titulo_h1"> Acceda a nuestro portal de Zaabra <br> Salud o regístrese. </h1>
            </div>
            
            <div id="tarjeta" class="card tarjeta_principal margInferior">
                <div class="card-header tarjeta_header">
                    <div class="seccion_inactiva">
                        <a href="{{ route('login') }}">
                            <h2 class="titulo_h2" style="color: #D1D1D1">Iniciar Sesión</h2>
                        </a>
                    </div>

                    <div class="seccion_activa">
                        <h2 class="titulo_h2">Crear Cuenta </h2>
                    </div>
                </div>

                <p class="texto_label text-left font-weight-light mt-4 pl-3"> Registrarme como: </p>

                <div class="card-body pt-md-4 pb-md-5">
                    <form method="POST" action="{{ route('register') }}" onsubmit="return validateform()" name="formularioRegistro">
                    @csrf
                        <div class="seccion_opcion_usuario"> <!-- Oopciones de registro -->
                            <div class=" seccion_opcion_registro">
                                <!-- Paciente: Despliegue de formulario y cambio de color opción, en archivo "register.js"-->
                                <input id="inpt1" class="input_registro" onclick="hideForm(this)" type="image" src="/img/iconos/icono-paciente.svg" value="1"  data-position="paciente">
                                <label id="txt1" class="txt_opcion_registro" for="idrol"> Paciente </label>
                            </div>

                            <div class=" seccion_opcion_registro">
                                <!-- Doctor: Despliegue de formulario y cambio de color opción, en archivo "register.js"-->
                                <input id="inpt2" class="input_registro" onclick="hideForm(this)" type="image" src="/img/iconos/icono-doctor.svg"  value="2"  data-position="doctor">
                                <label id="txt2" class="txt_opcion_registro" for="idrol"> Doctor/a </label>
                            </div>

                            <div class=" seccion_opcion_registro">
                                <!-- Institución: Despliegue de formulario y cambio de color opción, en archivo "register.js"-->
                                <input id="inpt3" class="input_registro" onclick="hideForm(this)" type="image" src="/img/iconos/icono-institucion.svg"  value="3"  data-position="institucion">
                                <label id="txt3" class="txt_opcion_registro" for="idrol"> Institución </label>
                            </div>
                        </div>

                        <div id="persona"> <!-- Nombres y apellidos persona -->
                            <input type="hidden" name="idrol"  id="valor_tipo">

                            <div class="names_person my-3"> 
                            
                                <label for="primernombre" class="texto_label">{{ __('Nombres *') }}</label>
                                <div class="d-md-flex">
                                    <input id="primernombre" type="text" class="input_form mb-2 mr-md-1 @error('primernombre') is-invalid @enderror" name="primernombre" value="{{ old('primernombre') }}"  
                                    autocomplete="primernombre" autofocus placeholder="Primer Nombre">
                                    @error('primernombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                    <input id="segundonombre" type="text" class="input_form mb-3 ml-md-1 @error('segundonombre') is-invalid @enderror" name="segundonombre" value="{{ old('segundonombre') }}"  
                                    autofocus placeholder="Segundo Nombre">
                                </div>

                            
                                <label for="primerapellido" class="texto_label">{{ __('Apellidos *') }}</label>
                                
                                <div class="d-md-flex">
                                    <input id="primerapellido" type="text" class="input_form mb-2 mr-md-1 @error('primerapellido') is-invalid @enderror" name="primerapellido" value="{{ old('primerapellido') }}"  
                                    autocomplete="primerapellido" autofocus placeholder="Primer Apellido">
                                    @error('primerapellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                
                                    <input id="segundoapellido" type="text" class="input_form ml-md-1 @error('segundoapellido') is-invalid @enderror" name="segundoapellido" 
                                    value="{{ old('segundoapellido') }}" autofocus placeholder="Segundo Apellido">
                                </div> 
                            </div>
                        </div>

                        <div id="institucion" class="names_institution mt-3"> <!-- Nombre institución -->
                            <label for="nombreinstitucion" class="texto_label">{{ __('Nombre Institución *') }}</label>

                            <input id="nombreinstitucion" type="text" class="input_form mb-3 @error('nombreinstitucion') is-invalid @enderror" name="nombreinstitucion" value="{{ old('nombreinstitucion') }}" 
                            autofocus placeholder="Nombre Institucion">
                        </div>

                        <div class="datos_secundarios"> <!-- Datos secundarios --> 
                            <label for="tipodocumento" class="texto_label">{{ __('Tipo Documento *') }}</label>

                            <select class="input_form mb-3 @error('tipodocumento') is-invalid @enderror" name="tipodocumento" required>
                                <option value="" selected> Seleccione </option>
                                <option value="1"> Cedula Ciudadania </option>
                                <option value="2"> Cedula Extranjeria </option>
                                <option value="3"> Nit </option>
                            </select>
                        
                            <label for="numerodocumento" class="texto_label">{{ __('Numero Documento *') }}</label>
                            
                            <input id="numerodocumento" type="number" class="input_form mb-3 @error('numerodocumento') is-invalid @enderror" name="numerodocumento" value="{{ old('numerodocumento') }}" 
                            autocomplete="numerodocumento" autofocus>
                            @error('numerodocumento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                            <label for="email" class="texto_label">{{ __('Correo electrónico *') }}</label>

                            <input id="email" type="email" class="input_form mb-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" required placeholder="servicioalcliente@zaabrasalud.co">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                            <label for="password" class="texto_label">{{ __('Contraseña *') }}</label>

                            <input id="password" type="password" class="input_form mb-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="password-confirm" class="texto_label">{{ __('Confirmar contraseña *') }}</label>

                            <input id="password-confirm" type="password" class="input_form mb-3  @error('password-confirm') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Contraseña">

                            <div class="d-flex"> <!-- Check Políticas y terminos -->
                                <input type="checkbox" class="" id="aceptoTerminos" name="aceptoTerminos" value="1"  required>

                                <p class="txt_check"> Declaro que he leído y acepto la
                                    <a class="txt_link_check" href="{{url('politicas')}}" target="blank">política de privacidad</a>  y los
                                    <a class="txt_link_check" href="{{url('politicas')}}" target="blank">términos y condiciones</a>  de Zaabra Salud.
                                </p>
                            </div>
                        
                            <div class="d-flex mt-2"> <!-- Check de Promociones -->
                                <input type="checkbox" class="" id="">

                                <p class="txt_check">Me gustaría recibir comunicaciones promocionales.</p>
                            </div>

                            <p class="txt_check text-center mt-2 mb-3 p-0">Recibirá un e-mail de confirmación.</p> <!-- Confirmación de e-mail -->

                            <div class="seccion_btn_central m-0"> <!-- Botón Ingresar -->
                                <button type="submit" class="btn_grande_central_azul px-4"> {{ __('Ingresar') }}
                                    <i class="fas fa-arrow-right pl-1"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/register.js') }}"></script>
@endsection
