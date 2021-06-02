@extends('layouts.app')

@section('content')

<!-- contenedor principal -->
<div class="container-fluid">
    <!-- Banner principal de contacto -->
    <section class="row">
        <img class="imagen_bannerPrin-contac" src="{{URL::asset('/img/contacto/banner-contactenos-texto.jpeg')}}">
    </section>

    <!-- Titulo y texto superior principal -->
    <h2 class="titulo_principal-contac"> ¡Hola! ¿Desea contactarse con Zaabra Salud? </h2>

    <p class="texto_superior-contac"> 
        Queremos que se ponga en contacto con nosotros para compartir sus comentarios, 
        opiniones y necesidades o para recibir una asesoría completa sobre un producto o servicios de su interés. 
    </p>
   
    <!-- Información contacto Zaabra -->
    <div class="row containt_contacZaabra-contac">
        <div class=" icon_ubicacion-contac">
            <span class="titulo_opcion-contac"> Ubicación </span>
            <p class="text_opcion-contac"> Carrera 64 67b 89 interior 2 </p>
        </div>

        <div class=" icon_telefono-contac">
            <span class="titulo_opcion-contac"> Teléfono </span>
            <p class="text_opcion-contac"> 7123945 </p>
        </div>

        <div class=" icon_email-contac">
            <span class="titulo_opcion-contac"> E-mail </span>
            <p class="text_opcion-contac"> servicioalcleinte@zaabrasalud.com.co </p>
        </div>
    </div>

    <!-- fila contenido opciones y formulario contacto -->
    <div class="row fila_containt-options-contac">

        <h2 class="Subtitulo_interno-contac"> Ponerse en contacto </h2>

        <p class="Subtext_interno-contac"> Seleccione el perfil con el que se identifica, complete el siguiente formulario y haga clic en enviar. </p>

        <!-- contenedor de elementos contacto -->
        <div class="card col-11 col-md-10 col-lg-8 section_principal-contac">
            <!-- seccion body contacto -->
            <div class="card-body section_body-contac">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div id="persona">
                        <!-- Seccion opciones paara Registrarse -->
                        <div class="row section_input-option-contac">
                            <div class="col-3 form-check input_option-contac"> 
                                <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
                                <input class="form-check-input input_img-option-contac" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-paciente.svg" name="idrol" value="1" data-position="paciente" checked>
                                <label class="form-check-label texto_option-input-contac" for="idrol"> Paciente </label>
                            </div>

                            <div class="col-3 form-check input_option-contac">
                                <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
                                <input class="form-check-input input_img-option-contac" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-doctor.svg" name="idrol" value="2" data-position="doctor">
                                <label class="form-check-label texto_option-input-contac" for="idrol"> Doctor/a </label>
                            </div>

                            <div class="col-3 form-check input_option-contac"> 
                                <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
                                <input class="form-check-input input_img-option-contac" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-institucion.svg" name="idrol" value="3" data-position="institucion">
                                <label class="form-check-label texto_option-input-contac" for="idrol"> Institución </label>
                            </div>
                        </div>

                        <!-- Sección campos de validación Nombres y Apellidos -->
                        <div class="name_user-contac">
                            <!-- Campos de Nombres -->
                            <div class="form-group row mb-0">
                                <label for="primernombre" class="col-md-12 col-form-label texto_label-contac">{{ __('Nombres') }}</label>

                                <div class="col-md-6 mb-3 mb-md-0">
                                    <input id="primernombre" type="text" class="form-control input_height-fullhd-contac @error('primernombre') is-invalid @enderror" name="primernombre" value="{{ old('primernombre') }}" required autocomplete="primernombre" autofocus placeholder="Primer Nombre">

                                    @error('primernombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input id="segundonombre" type="text" class="form-control input_height-fullhd-contac @error('segundonombre') is-invalid @enderror" name="segundonombre" value="{{ old('segundonombre') }}"  autofocus placeholder="Segundo Nombre">
                                </div>
                            </div>

                            <!-- Campos de Apellidos -->
                            <div class="form-group row mb-0">
                                <label for="primerapellido" class="col-md-12 col-form-label texto_label-contac">{{ __('Apellidos') }}</label>

                                <div class="col-md-6 mb-3 mb-md-0">
                                    <input id="primerapellido" type="text" class="form-control input_height-fullhd-contac @error('primerapellido') is-invalid @enderror" name="primerapellido" value="{{ old('primerapellido') }}" required autocomplete="primerapellido" autofocus placeholder="Primer Apellido">

                                    @error('primerapellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input id="segundoapellido" type="text" class="form-control input_height-fullhd-contac @error('segundoapellido') is-invalid @enderror" name="segundoapellido" value="{{ old('segundoapellido') }}" autofocus placeholder="Segundo Apellido">
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
                                <input id="nombreinstitucion" type="text" class="form-control input_height-fullhd-contac @error('nombreinstitucion') is-invalid @enderror" name="nombreinstitucion" value="{{ old('nombreinstitucion') }}" autofocus placeholder="Nombre Institucion">
                            </div>
                        </div>
                    </div>

                    <!-- Sección de datos secundarios contacto -->
                    <div class="second_date-contac">
 
                        <!-- Correo electrónico -->
                        <div class="form-group col-12 p-0 m-0">
                            <label for="email" class="col-md-12 pl-0 col-form-label texto_label-contac">{{ __('Correo electrónico') }}</label>

                            <div class="col-12 p-0">
                                <input id="email" type="email" class="form-control input_height-fullhd-contac @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="zaabra@gmail.com">
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
                                <textarea class="form-control input_height-fullhd-contac" name="txtComentario" id="txtComentario" required placeholder="Escribe Aqui"></textarea>
                            </div>
                        </div>

                        <!-- Botón enviar -->
                        <div class="form-group row mb-2 mb-md-0">
                            <div class="col-12 content_btn-enviar-contac">
                                <button type="submit" class="btn_enviar-contac"> {{ __('Enviar') }}
                                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_envio-contac" alt=""> 
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