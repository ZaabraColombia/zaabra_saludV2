@extends('layouts.app')

@section('content')
<!-- contenedor principal -->
<div class="container-fluid contenedorPrin_Register">
    <!-- fila principal -->
    <div class="row justify-content-center">
        <!-- titulo principal -->
        <p class="titulo_principal-register"> Acceda a nuestro portal de Zaabra Salud o regístrese. </p>
        <!-- contenedor de elementos login -->
        <div class="card col-11 col-md-10 col-lg-8 section_principal-register">
            <!-- seccion body login -->
            <div class="card-body section_body-register">
                <form method="POST" action="{{ route('register') }}" onsubmit="return validateform()" name="formularioRegistro">
                @csrf
                    <!-- seccion iniciar sesion, creaar cuenta y titulo interno -->
                    <div class="row card-header content_iniciar-crear">
                        <div class="col-6 section_texto-inicio">
                            <a href="{{ route('login') }}" class="texto_iniciar-register"> Iniciar Sesión </a>
                        </div>

                        <div class="col-6 section_texto-registro">
                            <a> Crear Cuenta </a>
                        </div>
                        <p class="texto_superior-tarjeta-register"> Registrarme como </p>
                    </div>
          
                    <div id="persona">
                        <!-- Seccion opciones paara Registrarse -->
                        <div class="row section_input-option-register">
                            <div class="col-3 form-check input_option-register"> 
                                <!-- Evento onclick para desplegar el formulario de registro y el cambio de color del icono y el texto. La función " hedeForm " se encuentra en el archivo register.js -->
                                <!-- Opción paciente -->
                                <input id="inpt1" class="form-check-input input_img-option icon_pac" onclick="hideForm(this)" type="image" src="/img/iconos/icono-paciente.svg" value="1"  data-position="paciente">
                                <label id="txt1" class="form-check-label texto_option-input" for="idrol"> Paciente </label>
                            </div>

                            <div class="col-3 form-check input_option-register">
                                <!-- Evento onclick para desplegar el formulario de registro y el cambio de color del icono y el texto. La función " hedeForm " se encuentra en el archivo register.js -->
                                <!-- Opción doctor -->
                                <input id="inpt2" class="form-check-input input_img-option" onclick="hideForm(this)" type="image" src="/img/iconos/icono-doctor.svg"  value="2"  data-position="doctor">
                                <label id="txt2" class="form-check-label texto_option-input" for="idrol"> Doctor/a </label>
                            </div>

                            <div class="col-3 form-check input_option-register"> 
                                <!-- Evento onclick para desplegar el formulario de registro y el cambio de color del icono y el texto. La función " hedeForm " se encuentra en el archivo register.js -->
                                <!-- Opción institución -->
                                <input id="inpt3" class="form-check-input input_img-option" onclick="hideForm(this)" type="image" src="/img/iconos/icono-institucion.svg"  value="3"  data-position="institucion">
                                <label id="txt3" class="form-check-label texto_option-input" for="idrol"> Institución </label>
                            </div>
                        </div>
                        
                        <input type="hidden" name="idrol"  id="valor_tipo">
                        <!-- Sección campos de validación Nombres y Apellidos -->
                        <div class="names_person">
                            <!-- Campos de Nombres -->
                            <div class="form-group row mb-0">
                                <label for="primernombre" class="col-md-12 col-form-label texto_label-register">{{ __('Nombres *') }}</label>

                                <div class="col-md-6 mb-3 mb-md-0">
                                    <input id="primernombre" type="text" class="form-control input_height-fullhd-register" name="primernombre" value="{{ old('primernombre') }}"  autocomplete="primernombre" autofocus placeholder="Primer Nombre">

                                    @error('primernombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input id="segundonombre" type="text" class="form-control input_height-fullhd-register @error('segundonombre') is-invalid @enderror" name="segundonombre" value="{{ old('segundonombre') }}"  autofocus placeholder="Segundo Nombre">
                                </div>
                            </div>

                            <!-- Campos de Apellidos -->
                            <div class="form-group row mb-0">
                                <label for="primerapellido" class="col-md-12 col-form-label texto_label-register">{{ __('Apellidos *') }}</label>

                                <div class="col-md-6 mb-3 mb-md-0">
                                    <input id="primerapellido" type="text" class="form-control input_height-fullhd-register @error('primerapellido') is-invalid @enderror" name="primerapellido" value="{{ old('primerapellido') }}"  autocomplete="primerapellido" autofocus placeholder="Primer Apellido">

                                    @error('primerapellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input id="segundoapellido" type="text" class="form-control input_height-fullhd-register @error('segundoapellido') is-invalid @enderror" name="segundoapellido" value="{{ old('segundoapellido') }}" autofocus placeholder="Segundo Apellido">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de instituciones -->
                    <div id="institucion" class="names_institution">
                        <!-- Campo de nombre de la institución -->
                        <div class="form-group row name_institution m-0">
                            <label for="nombreinstitucion" class="col-md-12 px-0 col-form-label texto_label-register">{{ __('Nombre Institución *') }}</label>

                            <div class="col-md-12 px-0">
                                <input id="nombreinstitucion" type="text" class="form-control input_height-fullhd-register @error('nombreinstitucion') is-invalid @enderror" name="nombreinstitucion" value="{{ old('nombreinstitucion') }}" autofocus placeholder="Nombre Institucion">
                            </div>
                        </div>
                    </div>

                    <!-- Sección de datos secundarios para Registrarse -->
                    <div class="datos_secundarios">
                        <!-- Campos de tipo de documento y Número de documento -->
                        <div class="row">
                            <!-- Campo Tipo de documento -->
                            <div class="form-group col-12 col-md-6 m-0">
                                <label for="tipodocumento" class="col-md-12 px-0 col-form-label texto_label-register">{{ __('Tipo Documento *') }}</label>
                                
                                <select class="form-select col-12 form-control input_height-fullhd-register @error('tipodocumento') is-invalid @enderror" name="tipodocumento" required>
                                    <option value="" selected> Seleccione </option>
                                    <option value="1"> Cedula Ciudadania </option>
                                    <option value="2"> Cedula Extranjeria </option>
                                    <option value="3"> Nit </option>
                                </select>      
                            </div>

                            <!-- Número de documento -->
                            <div class="form-group col-md-6 m-0">
                                <label for="numerodocumento" class="col-md-12 pl-0 col-form-label texto_label-register">{{ __('Numero Documento *') }}</label>
                                <div class="col-md-12 p-0">
                                    <input id="numerodocumento" type="number" class="form-control input_height-fullhd-register" name="numerodocumento" value="{{ old('numerodocumento') }}" autocomplete="numerodocumento" autofocus>
                                    @error('numerodocumento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Correo electrónico -->
                        <div class="form-group col-12 p-0 m-0">
                            <label for="email" class="col-md-12 pl-0 col-form-label texto_label-register">{{ __('Correo electrónico *') }}</label>

                            <div class="col-12 p-0">
                                <input id="email" type="email" class="form-control input_height-fullhd-register" name="email" value="{{ old('email') }}" autocomplete="email" required placeholder="servicioalcliente@zaabrasalud.co">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campos de contraseña y confirmar contraseña -->
                        <div class="row mb-md-4">

                            <!-- Contraseña -->
                            <div class="form-group col-md-6 m-0">
                                <label for="password" class="col-md-12 px-0 col-form-label texto_label-register">{{ __('Contraseña *') }}</label>

                                <div class="col-md-12 px-0">
                                    <input id="password" type="password" class="form-control input_height-fullhd-register @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña"> 
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirmar contraseña -->
                            <div class="form-group col-md-6">
                                <label for="password-confirm" class="col-md-12 pl-0 col-form-label texto_label-register">{{ __('Confirmar contraseña *') }}</label>

                                <div class="col-md-12 px-0">
                                    <input id="password-confirm" type="password" class="form-control input_height-fullhd-register" name="password_confirmation" required autocomplete="new-password" placeholder="Contraseña">
                                </div>
                            </div>
                        </div>

                        <!-- Check Políticas y terminos -->
                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <input type="checkbox" class="check_option-register" id="aceptoTerminos" name="aceptoTerminos" value="1"  required> 
                                <div class="col-12 section_terminos-register">
                                    <h4 class="texto_inferior-tarjeta-register"> Declaro que he leído y acepto la  
                                        <a class="text_link-register" href="{{url('politicas')}}" target="blank"> política de privacidad</a>  y los  
                                        <a class="text_link-register" href="{{url('politicas')}}" target="blank"> términos y condiciones</a>  de Zaabrasalud. 
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <!-- Check de Promociones -->
                        <div class="form-group row mb-0">
                            <div class="col-12 section_option-promo-register">
                                <input type="checkbox" class="check_option-register" id=""> 
                                <div class="col-12 section_terminos-register">
                                    <span class="texto_inferior-tarjeta-register"> Me gustaría recibir comunicaciones promocionales. </span>
                                </div>        
                            </div>
                        </div>

                        <!-- Confirmación de e-mail -->
                        <div class="form-group col-12 section_terminos-register">
                            <p class="texto_inferior-tarjeta-register mt-1 mb-3 mb-md-4 mt-lg-3"> Recibirá un e-mail de confirmación. </p>
                        </div>

                        <!-- Botón Ingresar -->
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