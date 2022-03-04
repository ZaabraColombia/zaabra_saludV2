@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1 class="title_membresia mt-4 mt-lg-5">ESCOJA SU PLAN</h1>
        <h2 class="subTitle_infoZaabra">Escoja el que se ajuste a sus necesidades</h2>

        <!-- Tipo usuario -->
        <div class="section_type_plan my-5">
            <div class="content_type_plan">
                <input class="input_type_plan" type="image" src="/img/iconos/icono-doctor-azul.svg" name="idrol" value="2" data-position="doctor">
                <label class="text_type_user mt-2" style="color: #0083D6" for="idrol"> Doctor/a </label>
            </div>
            
            <a class="content_type_plan" href="{{ route('entidad.membresiaInstitucion') }}">
                <input class="input_type_plan" type="image" src="/img/iconos/icono-institucion.svg" name="idrol" value="3" data-position="institucion">
                <label class="text_type_user mt-2" for="idrol"> Consultorios médicos/ <br> Odontológicos </label>
                </input>
            </a>
        </div>

        <!-- PLAN GRATUITO -->
        <div class="card_membresia" id="accordion1">
            <h2 class="title_membresia" style="color: #232323">Plan Gratuito</h2>
            <p class="subTitle_infoZaabra">Inícielo gratis hoy y después conviértase al Premium.</p>
            <p class="text_info_infoZaabra my-2" style="color: #0083D6">Tiempo de vigencia: 8 días *</p>

            <div class="accordion">  <!-- Clase accordion para función del desplegable con cambio de color se encuentra ubicado en el archivo footer.js -->
                <div class="card card_acordion"> <!-- Tarjeta médica -->
                    <div id="headingOne">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Tarjeta médica</button>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion1">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Podrá previsualizar su información en una tarjeta ubicada en la galería de Especialistas. Vigencia 8 días.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section_button_infoZaabra mt-3"> <!-- Register button -->
                <a href="{{route('register')}}">
                    <button type="submit" class="button_blue_infoZaabra"> {{ __('Registro') }}
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </a>
            </div>
        </div>

        <!-- PLAN PREMIUN -->
        <div class="card_membresia" id="accordion">
            <h2 class="title_membresia" style="color: #232323">Plan Premiun</h2>

            <div class="section_button_infoZaabra my-3"> <!-- botón precio -->
                <button type="submit" class="button_blue_infoZaabra flex-column" data-toggle="modal" data-target="#info_pago">
                    <h5 class="title_membresia" style="color: #FFFFFF">$132.500</h5>
                    <span class="text_btn_precio">Mensual &nbsp;*</span>
                </button>
            </div>
            
            <div class="accordion"> <!-- Clase accordion para función del desplegable con cambio de color se encuentra ubicado en el archivo footer.js -->
                <div class="card card_acordion"> <!-- Agenda online -->
                    <div id="headingThree">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Agenda online</button>
                    </div>

                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Aquí podrá encontrar agendamiento online, disponibilidad del profesional, podrá gestionar sus citas,
                                encontrará las alertas y notificaciones y podrá administrarlas por medio de WhatsApp, correo electrónico o mensajes de texto.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- <div class="card card_acordion"> <!-- Historia clínica -->
                    <div id="headingFour">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Historia clínica **</button>
                    </div>

                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Una consulta personalizada para cada usuario o paciente que agenda su consulta a través de Zaabra Salud.
                            </p>
                        </div>
                    </div>
                </div> --}}

                <div class="card card_acordion"> <!-- Registro de pacientes -->
                    <div id="headingTwelve">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">Registro de pacientes</button>
                    </div>

                    <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Cada usuario posee unas credenciales de acceso. Con estos podrá acceder al sitio 24/7. Garantizamos alta disponibilidad y acceso en múltiples dispositivos: Computadores, móviles y Tablets.
                            </P>
                        </div>
                    </div>
                </div>

                <div class="card card_acordion"> <!-- Opiniones de pacientes -->
                    <div id="headingFiveteen">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseFiveteen" aria-expanded="false" aria-controls="collapseFiveteen">Opiniones de pacientes</button>
                    </div>

                    <div id="collapseFiveteen" class="collapse" aria-labelledby="headingFiveteen" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Zaabra Salud tiene al servicio de los usuarios y de los profesionales comentarios, testimonios y calificación por medio de estrellas,
                                estos comentarios son verificados por Zaabra Salud, si tiene una buena calificación, su perfil profesional será más visible.
                            </P>
                        </div>
                    </div>
                </div>

                <div class="card card_acordion"> <!-- Página web -->
                    <div id="headingTwo">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Página web</button>
                    </div>

                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Zaabra Salud le permite construir su perfil profesional, muestre su información de contacto, profesión y especialidad,
                                tipos de consulta, redes sociales, formación académica, certificados, procedimientos y más. Todo en un solo lugar.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card card_acordion"> <!-- Perfil profesional -->
                    <div id="headingFive">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">Perfil profesional</button>
                    </div>

                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Presente sus estudios, exalte  sus conocimientos, habilidades y su preparación profesional.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card card_acordion"> <!-- Portafolio de servicios -->
                    <div id="headingSix">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">Portafolio de servicios</button>
                    </div>

                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Presente el paso a paso de cada procedimiento o tratamiento. Permita que sus pacientes vean la transformación de cada proceso.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card card_acordion"> <!-- Premios y reconocimientos -->
                    <div id="headingSeven">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">Premios y reconocimientos</button>
                    </div>

                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Publique sus premios y reconocimientos, que gracias a su trabajo y el tiempo ha obtenido.
                            </P>
                        </div>
                    </div>
                </div>

                <div class="card card_acordion"> <!-- Galería -->
                    <div id="headingFourteen">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="true" aria-controls="collapseFourteen">Galería</button>
                    </div>

                    <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Los usuarios finales o pacientes podrán observar en la galería de su Landing page imágenes de las cirugías o tratamientos de cada profesional, se podrá observar paso a paso toda la transformación del antes y después.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card card_acordion"> <!-- Análisis y métricas del perfil -->
                    <div id="headingEight">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">Análisis y métricas del perfil</button>
                    </div>

                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Consulte sus métricas de desempeño: Clics recibidos, consultas agendadas, consultas efectivas, consultas canceladas y mucho más.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card card_acordion"> <!-- Marketing digital y publicidad -->
                    <div id="headingNine">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">Marketing digital y publicidad</button>
                    </div>

                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Su reputación la ha construido con su trabajo. La reputación digital exige un trabajo adicional.
                                Impulse su perfil en Zaabra Salud. Nuestro sitio web y nuestras redes sociales amplificarán su alcance. Nuestro equipo de marketing lo hará por usted.
                            </P>
                        </div>
                    </div>
                </div>

                {{-- <div class="card card_acordion"> <!-- Reportes y RIPs -->
                    <div id="headingSixteen">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">Reportes y RIPs **</button>
                    </div>

                    <div id="collapseSixteen" class="collapse" aria-labelledby="headingSixteen" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Reportes y gráficas en tiempo real de pacientes, citas, historias clínicas, diagnósticos, comprobantes diarios, histórico, generación de RIPs.
                            </P>
                        </div>
                    </div>
                </div> --}}

                <div class="card card_acordion"> <!-- Posicionamiento web -->
                    <div id="headingTen">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">Posicionamiento web</button>
                    </div>

                    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Nos enfocamos en lograr que los profesionales y las instituciones sean reconocidos, posicionamos su perfil en la búsqueda de los usuarios.
                            </P>
                        </div>
                    </div>
                </div>

                <div class="card card_acordion"> <!-- Asesoramiento y soporte técnico -->
                    <div id="headingThirteen">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">Asesoramiento y soporte técnico</button>
                    </div>

                    <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Trabajamos para usted, por eso siempre tiene canales de comunicación directa para responder a todas sus inquietudes.
                            </P>
                        </div>
                    </div>
                </div>

                <div class="card card_acordion"> <!-- Cambios y actualizaciones -->
                    <div id="headingEleven">
                        <button class="button_acordion" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">Cambios y actualizaciones</button>
                    </div>

                    <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordion">
                        <div class="card-body toggle_info">
                            <p class="txt_toggle_info">
                                Ingrese a su perfil, edite su información, actualice sus estudios, experiencia y mucho más. La nueva información está sujeta a verificación.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <p class="text_info_infoZaabra p-3"> Puede complementar y personalizar su plan con recursos publicitarios adicionales. <a class="a_underline" href="{{route('contacto')}}" target="blank"> contáctenos </a> para ser atendido por un representante. *Vigencia anual. </p>

            <div class="section_button_infoZaabra"> <!-- Register button -->
                <a href="{{route('register')}}">
                    <button type="submit" class="button_blue_infoZaabra" data-toggle="modal" data-target="#info_pago"> {{ __('Empezar') }}
                        <img src="{{ asset('/img/iconos/icono-flecha-blanco.svg') }}" class="pl-2">
                    </button>
                </a>
            </div>
        </div> 
    </div>

    <div class="modal fade" id="info_pago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" target="_blank">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h2 class="text-center mb-2"> Seleccione el medio de pago</h2>
                    <h3 class="text-center"> Seleccione el medio de pago que mejor se adapte a su necesidad. </h3>

                    <form action="{{ route('pay-openPay') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_tipo_pago" id="id_tipo_pago" value="13">
                        <div class="modal_medio_pago">
                            <div class="info_medio_pago">
                                <img id="img_tarjCred" src="{{ asset('/img/popup-pago/tarjetas-de-credito-azul.svg') }}">
                                <h3 class="text-center mb-2">Tarjetas de <br> crédito</h3>
                                <input class="Check_medio_pago" type="radio" name="metodo_pago" id="metodo_pago" value="card" />
                            </div>

                            <div class="info_medio_pago">
                                <img id="img_pagoPse" src="{{ asset('/img/popup-pago/medios-online-pse-azul.svg') }}">
                                <h3 class="text-center mb-2">Pago en línea <br> (PSE)</h3>
                                <input class="Check_medio_pago" type="radio" name="metodo_pago" id="metodo_pago" value="pse" />
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer content_btn_center">
                    <button type="submit" class="button_blue" id="btnPagarPremium2" data-toggle="modal" data-target="#modalPagoEspera" formtarget="_blank">
                        Pagar<i class="fas fa-arrow-right pl-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
