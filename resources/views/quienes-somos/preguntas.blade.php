@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <section class="row">
        <img class="imagen_bannerPrin-pregunta" src="{{URL::asset('/img/banners/bannerquienessomos/banner-preguntas-frecuentes-texto.jpeg')}}">
    </section>

    <section class="section_principal-pregunta">
        <h5 class="titulo_principal-pregunta"> ¿Dudas? ¿Inquietudes? </h5>
        <p class="titulo_superior-pregunta"> En esta sección resolveremos todas las preguntas más frecuentes sobre Zaabra salud. </p>

        <div class="mb-3 mb-md-5 evento_acordion contain_accordion-pregunta" id="accordion">
            <div class="card containt_options-collapse-acerca">
                <div id="headingOne">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> ¿Qué es Zaabra Salud? </button>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot">
                            Zaabra Salud es una plataforma digital que facilita la búsqueda y el contacto entre usuarios y profesionales e instituciones de la salud.<br>
                            Todas las especialidades y las mejores instituciones médicas al alcance de millones de usuarios. 
                        </p>

                        <p class="txt_interno_toggleFoot mb-0">
                            Todo esto con el fin de obtener un rápido y fácil acceso a citas y consultas médicas con todas las especialidades, citas y servicios odontológicos, 
                            centros de toma de exámenes e imágenes diagnósticas y muchos servicios más.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingTwo">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> ¿Cómo funciona Zaabra Salud? </button>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot">
                            Pedir una consulta con un profesional o entidades es posible y muy fácil. Busque el profesional o entidad que necesita, elíjalo según su perfil y/o portafolio, 
                            disponibilidad o modalidad de atención (Presencial o tele consulta).<br>
                            Puede agendar y realizar el pago en línea.
                        </p>

                        <p class="txt_interno_toggleFoot mb-0">
                            <b>5 pasos para agendar su cita o servicio médico:</b>
                        </p>
                        <ul class="option_toggleFoot mb-0">
                            <li>Seleccione el servicio que busca.</li>
                            <li>Acceda al catálogo de profesionales y servicios.</li>
                            <li>Seleccione el profesional o institución de la salud que se ajuste a sus necesidades.</li>
                            <li>Agende y pague su cita.</li>
                            <li>Disfrute de un excelente servicio avalado por cientos de usuarios.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingThree">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> ¿Quién puede utilizar Zaabra Salud? </button>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot mb-0">
                            ¡Todas las personas!<br>
                            Cualquier persona que necesite acceso a servicios de la salud con especialistas, entidades y/o instituciones puede disfrutar de los servicios de Zaabra Salud.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingFour">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> ¿Cómo me registro en Zaabra Salud? </button>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot mb-0">
                            Puede crear su cuenta con una dirección de correo electrónico.<br>
                            Existen tres (3) tipos de perfiles en Zaabra Salud: <br>
                            <b>Paciente</b><br>
                            Cualquier persona natural que necesite servicios de las diferentes ramas de la salud.<br>
                            <b>Doctor (Profesional de la salud)</b><br>
                            Cualquier profesional de la salud que ofrezca sus servicios de forma presencial y/o telemática (virtual).<br>
                            <b>Institución</b><br>
                            Cualquier entidad y/o institución que preste servicios relacionados con la salud.<br>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingFive">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"> ¿Puedo registrarme bajo más de un tipo de perfil? </button>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot mb-0">
                            Sí, todos y todas somos usuarios de servicios de salud. De modo que un usuario podrá registrarse como paciente y como profesional de salud, en caso de que lo sea y ofrezca sus servicios. <br><br>
                            <b>Aclaración:</b> Cada perfil debe estar registrado con una dirección de correo electrónico diferente.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="card containt_options-collapse-acerca">
                <div id="headingSix">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix"> ¿Debo pagar para registrarme? </button>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot mb-0">
                            Cuando el registro corresponde al de PACIENTE, NO existen las membresías, planes o similares. Solo se pagará en el momento de agendar una cita. <br><br>
                            Cuando el registro corresponde al perfil de PROFESIONAL O ENTIDAD DE LA SALUD, si debe hacerse el pago de una Membresía. Conozca aquí toda la información 
                            <a class="ancla_toggleFoot" href="{{ route('membresiaProfesional') }}">click aquí</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingSeven">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven"> ¿Cuáles especialidades puedo conseguir en Zaabra Salud? </button>
                </div>
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot mb-0">
                            Zaabra Salud agrupa las especialidades en las siguientes ramas de la salud:
                        </p>
                        <ul class="option_toggleFoot mb-2">
                            <li> Medicina.</li>
                            <li> Odontología.</li>
                            <li> Sicología.</li>
                            <li> Fisioterapia.</li>
                            <li> Enfermería.</li>
                            <li> Medicina Veterinaria.</li>
                        </ul>

                        <p class="txt_interno_toggleFoot mb-0">
                            Cada rama tiene sus especialidades y pueden ser tan variadas y extensas como se quiera. Aun así y respondiendo a necesidades y ofertas del mercado, las más comunes son: <br>
                            Medicina general, Pediatría, Ginecología, Cirugía general, Geriatría, Medicina interna, Cirugía plástica, Cardiología, Oftalmología, Dermatología, Neurología, Ortopedia, 
                            Urología, Nefrología, Oncología, Medicina laboral ¡y muchas más!.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingEight">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight"> ¿Cuáles tipos de entidades puedo conseguir en Zaabra Salud? </button>
                </div>
                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot mb-0">
                            Zaabra Salud agrupa las entidades en las siguientes categorías:
                        </p>
                        <ul class="option_toggleFoot mb-0">
                            <li> Centros Médicos. </li>
                            <li> Ópticas. </li>
                            <li> Clínicas. </li>
                            <li> Centros Odontológicos. </li>
                            <li> Centros de Exámenes. </li>
                            <li> Empresas Promotoras de Salud (EPS). </li>
                            <li> Medicina Prepagada y Servicios Complementarios. </li>
                            <li> Clínicas Veterinarias. </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingNine">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine"> ¿Puedo tener más de una cita agendada? </button>
                </div>
                <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot mb-0">
                            Sí. En Zaabra Salud un paciente puede tener cuantas citas agendadas quiera. Lo importante es asegurarse que ninguna se coincida con otra en fecha y hora.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingTen">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen"> ¿Puedo agendar una cita para un tercero? </button>
                </div>
                <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot mb-0">
                            Sí. En Zaabra Salud puede agendar una cita a su nombre y el beneficiario puede ser usted mismo(a) o un tercero. <br>
                            Asegúrese que el beneficiario sea una persona de su círculo más cercano, pues en temas de salud debe haber la mayor confidencialidad posible.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingEleven">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven"> Para agendar una cita, ¿Debo pagarla? </button>
                </div>
                <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot mb-0">
                            Sí. El paciente debe hacer el pago de la cita justo en el proceso de la reserva. Una vez procesado el pago, recibirá la confirmación de la misma vía correo electrónico.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingTwelve">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve"> ¿Puedo hacer modificaciones o cancelaciones sobre una cita agendada? </button>
                </div>
                <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot mb-0">
                            Sí. En Zaabra Salud un paciente puede cancelar una cita agendada. Para temas de devoluciones de pagos, consulte el módulo de 
                            <a class="ancla_toggleFoot" href="{{url('politicas')}}" target="blank">Términos y Condiciones.</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingThirteen">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen"> ¿Zaabra Salud garantiza la seguridad y privacidad de mi información y datos personales? </button>
                </div>
                <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot mb-0">
                            Si, la información recogida a través de la plataforma tiene un tratamiento confidencial, de acuerdo a la ley 1581 de 2012 y el decreto 1377 de 2013. Por tal motivo Zaabra Salud se hace responsable de los 
                            datos proporcionados tanto de los pacientes como de los profesionales y las entidades de la salud.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection