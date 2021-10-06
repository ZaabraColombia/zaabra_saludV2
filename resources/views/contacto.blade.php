@extends('layouts.app')

@section('content')

<!-- contenedor principal -->
<div class="container-fluid">
    <!-- Banner principal de contacto -->
    <section class="row">
        <h1 class="title_banner_infoZaabra"> CONTÁCTENOS </h1>
        <img class="img_banner_infoZaabra" src="{{URL::asset('/img/contacto/banner-contactenos.jpeg')}}">
    </section>

    <div class="cabecera_contacto">
        <!-- Titulo y texto superior principal -->
        <h2 class="titulo_infoZaabra"> ¡Hola! ¿Desea contactarse con Zaabra Salud? </h2>

        <p class="subTitulo_infoZaabra">
            Queremos que se ponga en contacto con nosotros para compartir sus comentarios,
            opiniones y necesidades o para recibir una asesoría completa sobre un producto o servicios de su interés.
        </p>

        <!-- Información contacto Zaabra -->
        <div class="infoZaabra_contacto">
            <div class="ubicacion-contacto">
                <h5 class="titulo_infoZaabra_contacto"> Ubicación </h5>
                <p class="txt_infoZaabra_contacto"> Carrera 64 67b 89 interior 2 - Bogotá D.C.</p>
            </div>

            <div class="telefono_contacto">
                <h5 class="titulo_infoZaabra_contacto"> Teléfono </h5>
                <p class="txt_infoZaabra_contacto"> (1) 7123945 - 321 244 9869</p>
            </div>

            <div class="email_contacto">
                <h5 class="titulo_infoZaabra_contacto"> E-mail </h5>
                <p class="txt_infoZaabra_contacto"> servicioalcliente@zaabrasalud.co </p>
            </div>
        </div>
    </div>

    <!-- fila contenido opciones y formulario contacto -->
    <div class="row options_users_contacto">
        <div class="body_contacto">
            <h1 class="titulo_users_contacto"> Ponerse en contacto </h1>

            <p class="Subtext_interno-contac"> Seleccione el perfil con el que se identifica, complete el siguiente formulario y haga clic en enviar. </p>

            <!-- contenedor de elementos contacto -->
            <div class="card tipos_users_contacto">
                <!-- seccion body contacto -->
            
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="contactForm" method="post" action="javascript:void(0)">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @if(!empty($objuser))
                            <div id="persona">
                                <!-- Seccion opciones paara Registrarse -->
                                <div class="section_input-option-contac">
                                    <div class="form-check input_option-contac">
                                        <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
                                        <input id="inpt4" class="form-check-input input_img-option-contac" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-paciente.svg" name="idrol" value="1" data-position="paciente" checked>
                                        <label id="txt4" class="form-check-label texto_option-input-contac" for="idrol"> Paciente </label>
                                    </div>

                                    <div class="form-check input_option-contac">
                                        <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
                                        <input id="inpt5" class="form-check-input input_img-option-contac" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-doctor.svg" name="idrol" value="2" data-position="doctor">
                                        <label id="txt5" class="form-check-label texto_option-input-contac" for="idrol"> Doctor/a </label>
                                    </div>

                                    <div class="form-check input_option-contac">
                                        <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
                                        <input id="inpt6" class="form-check-input input_img-option-contac" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-institucion.svg" name="idrol" value="3" data-position="institucion">
                                        <label id="txt6" class="form-check-label texto_option-input-contac" for="idrol"> Institución </label>
                                    </div>
                                </div>

                                <input type="hidden" name="idrol"  id="valor_tipo1">
                                <!-- Sección campos de validación Nombres y Apellidos -->
                                <div class="name_user-contac">
                                    <!-- Campos de Nombres -->
                                    <div class="form-group row mb-0">
                                        <label for="primernombre" class="col-md-12 col-form-label texto_label-contac">{{ __('Nombres') }}</label>

                                        <div class="col-md-6 mb-3 mb-md-0">
                                        @foreach($objuser as $objuser)
                                            <input id="primernombre" type="text" class="form-control input_height-fullhd-contac" name="primernombre" value="{{$objuser->primernombre}}">
                                        @endforeach
                                            @error('primernombre')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <input id="segundonombre" type="text" class="form-control input_height-fullhd-contac" name="segundonombre" value="{{$objuser->segundonombre}}">
                                        </div>
                                    </div>

                                    <!-- Campos de Apellidos -->
                                    <div class="form-group row mb-0">
                                        <label for="primerapellido" class="col-md-12 col-form-label texto_label-contac">{{ __('Apellidos') }}</label>

                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <input id="primerapellido" type="text" class="form-control input_height-fullhd-contac" name="primerapellido" value="{{$objuser->primerapellido}}">

                                            @error('primerapellido')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <input id="segundoapellido" type="text" class="form-control input_height-fullhd-contac" name="segundoapellido" value="{{$objuser->segundoapellido}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de instituciones -->
                            <div id="institucion" class="name_institution-contac">
                                <!-- Campo de nombre de la institución -->
                                <div class="form-group row mb-0">
                                    <label for="nombreinstitucion" class="col-md-12 col-form-label texto_label-contac">{{ __('Nombre Institución') }}</label>

                                    <div class="col-md-12">
                                        <input id="nombreinstitucion" type="text" class="form-control input_height-fullhd-contac" name="nombreinstitucion" value="{{$objuser->nombreinstitucion}}">
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de datos secundarios contacto -->
                            <div class="second_date-contac">

                                <!-- Correo electrónico -->
                                <div class="form-group col-12 p-0 m-0">
                                    <label for="email" class="col-md-12 pl-0 col-form-label texto_label-contac">{{ __('Correo electrónico') }}</label>

                                    <div class="col-12 p-0">
                                        <input id="email" type="email" class="form-control input_height-fullhd-contac" name="email" value="{{$objuser->email}}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Asunto -->
                                <div class="form-group col-12 p-0">
                                    <label for="email" class="col-md-12 pl-0 col-form-label texto_label-contac">{{ __('Asunto') }}</label>

                                    <div class="col-12 p-0">
                                        <textarea class="form-control input_height-fullhd-contac" name="asunto" id="asunto" required placeholder="Escribe Aqui"></textarea>
                                    </div>
                                </div>

                                <div class="content_terminos_contac">
                                    <input class="check_terminos_contac" type="checkbox" id="">
                                    <h4 class="txt_terminos_contac"> Acepto
                                        <a href="{{url('politicas')}}" target="blank"> términos y condiciones </a> y autorizo el <a href="{{url('politicas')}}" target="blank">tratamiento de mis datos personales</a>.
                                    </h4>
                                </div>
                            </div>
                        @else
                            <div id="persona">
                                <!-- Seccion opciones paara Registrarse -->
                                <div class="section_input-option-contac">
                                    <div class="form-check input_option-contac">
                                        <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
                                        <input id="inpt4" class="form-check-input input_img-option-contac" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-paciente.svg" name="idrol" value="1" data-position="paciente" checked>
                                        <label id="txt4"  class="form-check-label texto_option-input-contac" for="idrol"> Paciente </label>
                                    </div>

                                    <div class="form-check input_option-contac">
                                        <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
                                        <input id="inpt5" class="form-check-input input_img-option-contac" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-doctor.svg" name="idrol" value="2" data-position="doctor">
                                        <label id="txt5"  class="form-check-label texto_option-input-contac" for="idrol"> Doctor/a </label>
                                    </div>

                                    <div class="form-check input_option-contac">
                                        <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
                                        <input id="inpt6" class="form-check-input input_img-option-contac" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-institucion.svg" name="idrol" value="3" data-position="institucion">
                                        <label id="txt6"  class="form-check-label texto_option-input-contac" for="idrol"> Institución </label>
                                    </div>
                                </div>

                                <input type="hidden" name="idrol"  id="valor_tipo1">
                                <!-- Sección campos de validación Nombres y Apellidos -->
                                <div class="name_user-contac">
                                    <!-- Campos de Nombres -->
                                    <div class="form-group row mb-0">
                                        <label for="primernombre" class="col-md-12 col-form-label texto_label-contac">{{ __('Nombres') }}</label>

                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <input id="primernombre" type="text" class="form-control input_height-fullhd-contac @error('primernombre') is-invalid @enderror" name="primernombre" value="{{ old('primernombre') }}"  autocomplete="primernombre"  placeholder="Primer Nombre">

                                            @error('primernombre')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <input id="segundonombre" type="text" class="form-control input_height-fullhd-contac @error('segundonombre') is-invalid @enderror" name="segundonombre" value="{{ old('segundonombre') }}"   placeholder="Segundo Nombre">
                                        </div>
                                    </div>

                                    <!-- Campos de Apellidos -->
                                    <div class="form-group row mb-0">
                                        <label for="primerapellido" class="col-md-12 col-form-label texto_label-contac">{{ __('Apellidos') }}</label>

                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <input id="primerapellido" type="text" class="form-control input_height-fullhd-contac @error('primerapellido') is-invalid @enderror" name="primerapellido" value="{{ old('primerapellido') }}" autocomplete="primerapellido"  placeholder="Primer Apellido">

                                            @error('primerapellido')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <input id="segundoapellido" type="text" class="form-control input_height-fullhd-contac @error('segundoapellido') is-invalid @enderror" name="segundoapellido" value="{{ old('segundoapellido') }}"  placeholder="Segundo Apellido">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de instituciones -->
                            <div id="institucion" class="name_institution-contac">
                                <!-- Campo de nombre de la institución -->
                                <div class="form-group row mb-0">
                                    <label for="nombreinstitucion" class="col-md-12 col-form-label texto_label-contac">{{ __('Nombre Institución') }}</label>

                                    <div class="col-md-12">
                                        <input id="nombreinstitucion" type="text" class="form-control input_height-fullhd-contac" name="nombreinstitucion" value="{{ old('nombreinstitucion') }}"  placeholder="Nombre Institucion">
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de datos secundarios contacto -->
                            <div class="second_date-contac">

                                <!-- Correo electrónico -->
                                <div class="form-group col-12 p-0 m-0">
                                    <label for="email" class="col-md-12 pl-0 col-form-label texto_label-contac">{{ __('Correo electrónico') }}</label>

                                    <div class="col-12 p-0">
                                        <input id="email" type="email" class="form-control input_height-fullhd-contac" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="servicioalcliente@zaabrasalud.co">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Asunto -->
                                <div class="form-group col-12 p-0">
                                    <label for="email" class="col-md-12 pl-0 col-form-label texto_label-contac">{{ __('Asunto') }}</label>

                                    <div class="col-12 p-0">
                                        <textarea class="form-control input_height-fullhd-contac" name="asunto" id="asunto" placeholder="Escribe Aqui"></textarea>
                                    </div>
                                </div>

                                <div class="content_terminos_contac">
                                    <input class="check_terminos_contac" type="checkbox" id="">
                                    <h4 class="txt_terminos_contac"> Acepto
                                        <a href="{{url('politicas')}}" target="blank"> términos y condiciones </a> y autorizo el <a href="{{url('politicas')}}" target="blank"> tratamiento de mis datos personales </a>
                                    </h4>
                                </div>
                            </div>
                        @endif
                        <!-- Botón enviar -->
                        
                        <div class="content_btn-enviar-contac">
                            <button id="send_form" type="submit" class="btn_enviar-contac"> {{ __('Enviar') }}
                                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_envio-contac" alt="">
                            </button>
                        </div>
                
                        <div class="alert alert-success d-none mt-5" id="msg_div">
                                <span id="res_message"></span>
                        </div>
                    </form>
                
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    <script src="{{ asset('js/contacto.js') }}"></script>
@endsection
