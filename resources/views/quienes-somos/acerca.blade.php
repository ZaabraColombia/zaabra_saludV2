@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <section class="row">
        <img class="imagen_bannerPrin-acerca" src="{{URL::asset('/img/banners/bannerquienessomos/banner-acerca-de-zaabra-texto.jpeg')}}">
    </section>

    <section class="section_principal-acerca">
        <p class="titulo_superior-acerca">Zaabra Salud, es el sitio donde están, los mejores especialistas e instituciones medicas de todas partes del país al alcance de sus manos y con tan solo un click.</p>

        <div class="mb-3 mb-md-5 evento_acordion contain_accordion-acerca" id="accordion">
            <div class="card containt_options-collapse-acerca">
                <div id="headingOne">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> ¿Quiénes somos? </button>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot">
                            Zaabra es una empresa de desarrollo de productos digitales, con soluciones alrededor del e-commerce y plataformas especializadas en potenciar a profesionales y empresarios colombianos. 
                            Creamos soluciones digitales integrales, hechas a la medida de las necesidades del mercado.
                        </p>
                        <p class="txt_interno_toggleFoot">
                            Potenciamos la comercialización de productos y servicios, incrementamos el alcance de los profesionales en el entorno digital y propiciamos su apertura a nuevos nichos de mercado.
                        </p>
                        
                        <h5 class="title_interno_toggleFoot"> Nos caracteriza: </h5>
                        <ul class="option_toggleFoot">
                            <li> - Productos digitales a la medida de las necesidades del mercado. </li>
                            <li> - Seguridad y confianza. </li>
                            <li> - Competitividad en el mercado </li>
                            <li> - Un equipo idóneo </li>
                            <li> - Garantía y compromiso </li>
                        </ul>
            
                        <h5 class="title_interno_toggleFoot mb-0"> Nuestra Misión: </h5>
                        <p class="txt_interno_toggleFoot">
                            En Zaabra tenemos la misión de generar bienestar mediante el desarrollo y la innovación tecnológica, fortaleciendo la economía nacional con buenas prácticas y relaciones transparentes con nuestro entorno. <br><br>
                        </p>
                    
                        <h5 class="title_interno_toggleFoot"> Nuestra Visión: </h5>
                        <p class="txt_interno_toggleFoot">
                            Zaabra, como compañía, se proyecta para ser un referente de soluciones digitales a nivel nacional en el año 2021, incursionando también en mercados internacionales.
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
                            Zaabra Salud es una plataforma digital que facilita la búsqueda y el contacto entre usuarios y profesionales e instituciones de la salud.
                        </p>
                        <p class="txt_interno_toggleFoot">
                            Todas las especialidades y las mejores instituciones médicas al alcance de millones de usuarios.
                        </p>
                        <p class="txt_interno_toggleFoot">
                            Todo esto con el fin de obtener un rápido y fácil acceso a citas y consultas médicas con todas las especialidades, citas y servicios
                            odontológicos, centros de toma de exámenes e imágenes diagnósticas y muchos servicios más.
                        </p>
                        <p class="txt_interno_toggleFoot mb-1">
                            5 pasos para agendar su cita o servicio médico:
                        </p>
                        <ul class="option_toggleFoot">
                            <li>- Seleccione el servicio que busca. </li>
                            <li>- Acceda al catalogo de profesionales y servicios. </li>
                            <li>- Seleccione el profesional o institución de la salud que se ajuste a sus necesidades. </li> 
                            <li>- Agende y pague su cita </li> 
                            <li>- Disfrute de un excelente servicio avalado por cientos de usuarios. </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card containt_options-collapse-acerca">
                <div id="headingThree">
                    <button class="boton_collapse-off-acerca" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Responsabilidad social </button>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body section_toggleFoot">
                        <p class="txt_interno_toggleFoot">
                            Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection