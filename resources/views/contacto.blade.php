@extends('layouts.app')

@section('content')

<div class="main_container_infoZaabra p-0">
    <section class="section_banner_infoZaabra">
        <img class="img_banner_infoZaabra" src="{{URL::asset('/img/contacto/banner-contactenos.jpeg')}}">
        <h1 class="title_banner_infoZaabra">CONTÁCTENOS</h1>
    </section>

    <div class="content_subTitle">
        <h2 class="title_body_infoZaabra">¡Hola! ¿Desea contactarse con Zaabra Salud?</h2>
        <h2 class="text_info_infoZaabra">Queremos que se ponga en contacto con nosotros para compartir sus comentarios, opiniones y necesidades o para recibir una asesoría completa sobre un producto o servicios de su interés.</h2>
    </div>

    <div class="section_contacto_infoZaabra">
        <div class="content_icon_infoZaabra icon_location">
            <h5 class="title_toggle_info m-0"> Ubicación </h5>
            <p class="txt_toggle_info"> Carrera 64 67b 89 interior 2 - Bogotá D.C.</p>
        </div>

        <div class="content_icon_infoZaabra icon_phone">
            <h5 class="title_toggle_info m-0"> Teléfono </h5>
            <p class="txt_toggle_info"> (1) 7123945 - 321 244 9869</p>
        </div>

        <div class="content_icon_infoZaabra icon_email">
            <h5 class="title_toggle_info m-0"> E-mail </h5>
            <p class="txt_toggle_info"> servicioalcliente@zaabrasalud.co </p>
        </div>
    </div>

    <!-- fila contenido opciones y formulario contacto -->
    <div class="container_form_infoZaabra pb-5">
        <div class="content_subTitle">
            <h2 class="title_body_infoZaabra"> Ponerse en contacto </h2>
            <h2 class="text_info_infoZaabra">Seleccione el perfil con el que se identifica, complete el siguiente formulario y haga clic en enviar.</h2>
        </div>

        <div class="card card_form_infoZaabra">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form id="contactForm" method="post" action="javascript:void(0)" class="px-3 px-md-5">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="tipo_contacto" name="tipo_contacto">
                @if(!empty($objuser))
                    <div id="persona">
                        <div class="section_type_user"> <!-- Usuarios paciente, doctor e institución -->
                            <div class="content_type_user"> <!-- Eventyo on click en archivo contacto.js -->
                                <input id="inpt4" class="input_type_user" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-paciente.svg" name="idrol" value="1" data-position="paciente" checked> <!-- Evento onclick en archivo register.js -->
                                <label id="txt4" class="text_type_user" for="idrol"> Paciente </label>
                            </div>

                            <div class="content_type_user">
                                <input id="inpt5" class="input_type_user" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-doctor.svg" name="idrol" value="2" data-position="doctor"> <!-- Evento onclick en archivo register.js -->
                                <label id="txt5" class="text_type_user" for="idrol"> Doctor/a </label>
                            </div>

                            <div class="content_type_user">
                                <input id="inpt6" class="input_type_user" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-institucion.svg" name="idrol" value="3" data-position="institucion"> <!-- Evento onclick en archivo register.js -->
                                <label id="txt6" class="text_type_user" for="idrol"> Institución </label>
                            </div>
                        </div>

                        <input type="hidden" name="idrol"  id="valor_tipo1">
                        <div class="name_user-contac"> <!-- Clase para ocultar campos del formulario según usuario -->
                            <div class="row mb-0">
                                <div class="col-lg-6 col-lg-12 p-0 pr-md-1 pr-lg-0"> <!-- Nombres -->
                                    <label for="primernombre" class="label_txt_form">{{ __('Nombres') }}</label>
                                    <div class="section_input_double_form">
                                        @foreach($objuser as $objuser)
                                            <input id="primernombre" type="text" class="input_box_form mb-2 mb-md-0 mr-md-1" name="primernombre" value="{{$objuser->primernombre}}">
                                        @endforeach
                                        @error('primernombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input id="segundonombre" type="text" class="input_box_form ml-md-1" name="segundonombre" value="{{$objuser->segundonombre}}">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-lg-12 p-0 pl-md-1 pl-lg-0"> <!-- Apellidos -->
                                    <label for="primerapellido" class="label_txt_form">{{ __('Apellidos') }}</label>
                                    <div class="section_input_double_form">
                                        <input id="primerapellido" type="text" class="input_box_form mb-2 mb-md-0 mr-md-1" name="primerapellido" value="{{$objuser->primerapellido}}">
                                        @error('primerapellido')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input id="segundoapellido" type="text" class="input_box_form ml-md-1" name="segundoapellido" value="{{$objuser->segundoapellido}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de instituciones -->
                    <div id="institucion" class="name_institution-contac">
                        <div class="col-12 px-0"> <!-- Campo de nombre de la institución -->
                            <label for="nombreinstitucion" class="label_txt_form">{{ __('Nombre Institución') }}</label>
                            <input id="nombreinstitucion" type="text" class="input_box_form" name="nombreinstitucion" value="{{$objuser->nombreinstitucion}}">
                        </div>
                    </div>

                    <!-- Sección de datos secundarios contacto -->
                    <div class="second_date-contac">
                        <div class="col-12 px-0">  <!-- Correo electrónico -->
                            <label for="email" class="label_txt_form">{{ __('Correo electrónico') }}</label>
                            <input id="email" type="email" class="input_box_form" name="email" value="{{$objuser->email}}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 px-0"> <!-- Asunto -->
                            <label for="email" class="label_txt_form">{{ __('Asunto') }}</label>
                            <textarea class="input_box_form" name="asunto" id="asunto" required placeholder="Escribe Aqui"></textarea>
                        </div>

                        <div class="content_check_box">
                            <input class="input_check_box" type="checkbox" id="">
                            <h4 class="txt_input_check_box"> Acepto
                                <a href="{{url('politicas')}}" target="blank"> términos y condiciones </a> y autorizo el <a href="{{url('politicas')}}" target="blank">tratamiento de mis datos personales</a>.
                            </h4>
                        </div>
                    </div>

                @else
                    <div id="persona">
                        <div class="section_type_user"> <!-- Usuarios paciente, doctor e institución -->
                            <div class="content_type_user"><!-- Eventyo on click en archivo contacto.js -->
                                <input id="inpt4" class="input_type_user" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-paciente.svg" name="idrol" value="1" data-position="paciente" checked> <!-- Evento onclick en archivo register.js -->
                                <label id="txt4"  class="text_type_user" for="idrol"> Paciente </label>
                            </div>

                            <div class="content_type_user">
                                <input id="inpt5" class="input_type_user" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-doctor.svg" name="idrol" value="2" data-position="doctor"> <!-- Evento onclick en archivo register.js -->
                                <label id="txt5"  class="text_type_user" for="idrol"> Doctor/a </label>
                            </div>

                            <div class="content_type_user">
                                <input id="inpt6" class="input_type_user" onclick="elementHidden(this)" type="image" src="/img/iconos/icono-institucion.svg" name="idrol" value="3" data-position="institucion"> <!-- Evento onclick en archivo register.js -->
                                <label id="txt6"  class="text_type_user" for="idrol"> Institución </label>
                            </div>
                        </div>

                        <input type="hidden" name="idrol"  id="valor_tipo1">
                        <div class="name_user-contac"> <!-- Clase para ocultar campos del formulario según usuario -->
                            <div class="row m-0">
                                <div class="col-lg-6 col-lg-12 p-0 pr-md-1 pr-lg-0"> <!-- Nombres -->
                                    <label for="primernombre" class="label_txt_form">{{ __('Nombres') }}</label>
                                    <div class="section_input_double_form">
                                        <input id="primernombre" type="text" class="input_box_form mb-2 mb-md-0 mr-md-1 @error('primernombre') is-invalid @enderror" name="primernombre" value="{{ old('primernombre') }}"  autocomplete="primernombre"  placeholder="Primer Nombre">
                                        @error('primernombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input id="segundonombre" type="text" class="input_box_form ml-md-1 @error('segundonombre') is-invalid @enderror" name="segundonombre" value="{{ old('segundonombre') }}"   placeholder="Segundo Nombre">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-lg-12 p-0 pl-md-1 pl-lg-0"> <!-- Apellidos -->
                                    <label for="primerapellido" class="label_txt_form">{{ __('Apellidos') }}</label>
                                    <div class="section_input_double_form">
                                        <input id="primerapellido" type="text" class="input_box_form mb-2 mb-md-0 mr-md-1 @error('primerapellido') is-invalid @enderror" name="primerapellido" value="{{ old('primerapellido') }}" autocomplete="primerapellido"  placeholder="Primer Apellido">
                                        @error('primerapellido')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input id="segundoapellido" type="text" class="input_box_form ml-md-1 @error('segundoapellido') is-invalid @enderror" name="segundoapellido" value="{{ old('segundoapellido') }}"  placeholder="Segundo Apellido">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="institucion" class="name_institution-contac">
                        <div class="col-12 px-0"> <!-- Campo de nombre de la institución -->
                            <label for="nombreinstitucion" class="label_txt_form">{{ __('Nombre Institución') }}</label>
                            <input id="nombreinstitucion" type="text" class="input_box_form" name="nombreinstitucion" value="{{ old('nombreinstitucion') }}"  placeholder="Nombre Institucion">
                        </div>
                    </div>

                    <div class="second_date-contac">
                        <div class="col-12 px-0">  <!-- Correo electrónico -->
                            <label for="email" class="label_txt_form">{{ __('Correo electrónico') }}</label>
                            <input id="email" type="email" class="input_box_form" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="servicioalcliente@zaabrasalud.co">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 px-0"> <!-- Asunto -->
                            <label for="email" class="label_txt_form">{{ __('Asunto') }}</label>
                            <textarea class="textarea_form" name="asunto" id="asunto" placeholder="Escribe Aqui"></textarea>
                        </div>

                        <div class="content_check_box">
                            <input class="input_check_box" type="checkbox" id="">
                            <span class="txt_input_check_box"> Acepto
                                <a href="{{url('politicas')}}" target="blank">Términos y condiciones </a>
                                y autorizo el
                                <a href="{{url('politicas')}}" target="blank">
                                    tratamiento de mis datos personales
                                </a>
                            </span>
                        </div>
                    </div>
                @endif

                <div class="section_button_infoZaabra"> <!-- Send button -->
                    <button id="send_form" type="submit" class="button_blue_infoZaabra">
                        {{ __('Enviar') }}&nbsp;<i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                <div class="alert mt-5" id="msg_div" style="display: none;">
                    <span id="res_message"></span>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection


@section('scripts')
    <script src="{{ asset('js/contacto.js') }}"></script>
@endsection
