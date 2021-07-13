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
                    <div class="card-body text_interno-toggle-pregunta">
                        <p>
                        Zaabra es una empresa de desarrollo de productos digitales, con soluciones alrededor del e-commerce y plataformas especializadas en potenciar a profesionales y empresarios colombianos. <br><br> 
                        Creamos soluciones digitales integrales, hechas a la medida de las necesidades del mercado. <br>
                        Potenciamos la comercialización de productos y servicios, incrementamos el alcance de los profesionales en el entorno digital y propiciamos su apertura a nuevos nichos de mercado. <br><br>
                        Nos caracteriza: <br><br>
                        - Productos digitales a la medida de las necesidades del mercado. <br>
                        - Seguridad y confianza. <br>
                        - Competitividad en el mercado <br>
                        - Un equipo idóneo <br>
                        - Garantía y compromiso <br><br> 
                        Nuestra Misión: <br><br>
                        En Zaabra tenemos la misión de generar bienestar mediante el desarrollo y la innovación tecnológica, fortaleciendo la economía nacional con buenas prácticas y relaciones transparentes con nuestro entorno. <br><br>
                        Nuestra Visión: <br><br>
                        Zaabra, como compañía, se proyecta para ser un referente de soluciones digitales a nivel nacional en el año 2021, incursionando también en mercados internacionales. <br><br>
                        </p>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingTwo">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> ¿Cómo funciona Zaabra Salud? </button>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body text_interno-toggle-pregunta">
                    Zaabra Salud es una plataforma digital que facilita la búsqueda y el contacto entre usuarios y profesionales e instituciones de la salud. <br> 
                    Todas las especialidades y las mejores instituciones médicas al alcance de millones de usuarios. <br><br> 
                    Todo esto con el fin de obtener un rápido y fácil acceso a citas y consultas médicas con todas las especialidades, citas y servicios <br> 
                    odontológicos, centros de toma de exámenes e imágenes diagnósticas y muchos servicios más. <br><br> 
                    5 pasos para agendar su cita o servicio médico: <br><br> 
                    - Seleccione el servicio que busca. <br>
                    - Acceda al catalogo de profesionales y servicios. <br>
                    - Seleccione el profesional o institución de la salud que se ajuste a sus necesidades. <br> 
                    - Agende y pague su cita <br> 
                    - Disfrute de un excelente servicio avalado por cientos de usuarios. <br><br>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingThree">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> ¿Quién puede utilizar Zaabra Salud? </button>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body text_interno-toggle-pregunta">
                    Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingFour">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> ¿Cómo me registro en Zaabra Salud? </button>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body text_interno-toggle-pregunta">
                    Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingFive">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"> ¿Puedo registrarme bajo más de un tipo de perfil? </button>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body text_interno-toggle-pregunta">
                    Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                    </div>
                </div>
            </div>
            
            <div class="card containt_options-collapse-acerca">
                <div id="headingSix">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix"> ¿Debo pagar para registrarme? </button>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                    <div class="card-body text_interno-toggle-pregunta">
                    Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingSeven">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven"> ¿Cuáles especialidades puedo conseguir en Zaabra Salud? </button>
                </div>
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                    <div class="card-body text_interno-toggle-pregunta">
                    Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingEight">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight"> ¿Cuáles tipos de entidades puedo conseguir en Zaabra Salud? </button>
                </div>
                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                    <div class="card-body text_interno-toggle-pregunta">
                    Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingNine">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine"> ¿Puedo tener más de una cita agendada? </button>
                </div>
                <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                    <div class="card-body text_interno-toggle-pregunta">
                    Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingTen">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen"> ¿Puedo agendar una cita para un tercero? </button>
                </div>
                <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
                    <div class="card-body text_interno-toggle-pregunta">
                    Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingEleven">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven"> Para agendar una cita, ¿Debo pagarla? </button>
                </div>
                <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordion">
                    <div class="card-body text_interno-toggle-pregunta">
                    Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingTwelve">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve"> ¿Puedo hacer modificaciones o cancelaciones sobre una cita agendada? </button>
                </div>
                <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordion">
                    <div class="card-body text_interno-toggle-pregunta">
                    Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingThirteen">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen"> ¿Zaabra Salud garantiza la seguridad y privacidad de mi información y datos personales? </button>
                </div>
                <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordion">
                    <div class="card-body text_interno-toggle-pregunta">
                    Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection