@extends('layouts.app')

@section('content')

<div class="container-fluid contenedor_infoZaabra">
    
    <section class="row">
        <h1 class="title_banner_infoZaabra"> ACERCA DE ZAABRA </h1>
        <img class="img_banner_infoZaabra" src="{{URL::asset('/img/banners/bannerquienessomos/banner-acerca-de-zaabra.jpeg')}}">
    </section>

    <section class="section_infoZaabra">
        <p class="subTitulo_infoZaabra">Zaabra Salud, es el sitio donde están, los mejores especialistas e instituciones medicas de todas partes del país al alcance de sus manos y con tan solo un click.</p>

        <div class="mb-3 mb-md-5 evento_acordion accordion_infoZaabra" id="accordion">
            <div class="card options_collapse_infoZaabra">
                <div id="headingOne"> <!-- Función del desplegable con cambio de color se encuentra ubicado en el archivo footer.js -->
                    <button class="btn_collapse_off_infoZaabra" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> ¿Quiénes somos? </button>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body toggle_infoZaabra">
                        <p class="txt_toggle_infoZaabra">
                            Zaabra es una empresa de desarrollo de productos digitales, con soluciones alrededor del e-commerce y plataformas especializadas en potenciar a profesionales y empresarios colombianos. 
                            Creamos soluciones digitales integrales, hechas a la medida de las necesidades del mercado.
                        </p>
                        <p class="txt_toggle_infoZaabra">
                            Potenciamos la comercialización de productos y servicios, incrementamos el alcance de los profesionales en el entorno digital y propiciamos su apertura a nuevos nichos de mercado.
                        </p>
                        
                        <h5 class="title_toggle_infoZaabra"> Nos caracteriza: </h5>
                        <ul class="option_toggle_infoZaabra">
                            <li> Productos digitales a la medida de las necesidades del mercado. </li>
                            <li> Seguridad y confianza. </li>
                            <li> Competitividad en el mercado. </li>
                            <li> Un equipo idóneo. </li>
                            <li> Garantía y compromiso. </li>
                        </ul>
            
                        <h5 class="title_toggle_infoZaabra"> Nuestra Misión: </h5>
                        <p class="txt_toggle_infoZaabra mb-0">
                            En Zaabra tenemos la misión de generar bienestar mediante el desarrollo y la innovación tecnológica, fortaleciendo la economía nacional con buenas prácticas y relaciones transparentes con nuestro entorno. <br><br>
                        </p>
                    
                        <h5 class="title_toggle_infoZaabra"> Nuestra Visión: </h5>
                        <p class="txt_toggle_infoZaabra">
                            Zaabra, como compañía, se proyecta para ser un referente de soluciones digitales a nivel nacional en el año 2021, incursionando también en mercados internacionales.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card options_collapse_infoZaabra">
                <div id="headingTwo">
                    <button class="btn_collapse_off_infoZaabra" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> ¿Cómo funciona Zaabra Salud? </button>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body toggle_infoZaabra">
                        <p class="txt_toggle_infoZaabra">
                            Zaabra Salud es una plataforma digital que facilita la búsqueda y el contacto entre usuarios y profesionales e instituciones de la salud.
                        </p>
                        <p class="txt_toggle_infoZaabra">
                            Todas las especialidades y las mejores instituciones médicas al alcance de millones de usuarios.
                        </p>
                        <p class="txt_toggle_infoZaabra">
                            Todo esto con el fin de obtener un rápido y fácil acceso a citas y consultas médicas con todas las especialidades, citas y servicios
                            odontológicos, centros de toma de exámenes e imágenes diagnósticas y muchos servicios más.
                        </p>
                        <p class="txt_toggle_infoZaabra mb-1">
                            5 pasos para agendar su cita o servicio médico:
                        </p>
                        <ul class="option_toggle_infoZaabra">
                            <li> Seleccione el servicio que busca. </li>
                            <li> Acceda al catálogo de profesionales y servicios. </li>
                            <li> Seleccione el profesional o institución de la salud que se ajuste a sus necesidades. </li> 
                            <li> Agende y pague su cita. </li> 
                            <li> Disfrute de un excelente servicio avalado por cientos de usuarios. </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card options_collapse_infoZaabra">
                <div id="headingThree">
                    <button class="btn_collapse_off_infoZaabra" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Responsabilidad social </button>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body toggle_infoZaabra">
                        <p class="txt_toggle_infoZaabra">
                            Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection