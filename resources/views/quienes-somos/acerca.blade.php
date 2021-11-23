@extends('layouts.app')

@section('content')

<div class="main_container_infoZaabra">
    <section class="section_banner_infoZaabra">
        <img class="img_banner_infoZaabra" src="{{URL::asset('/img/banners/bannerquienessomos/banner-acerca-de-zaabra.jpeg')}}">
        <h1 class="title_banner_infoZaabra">ACERCA DE ZAABRA</h1>
    </section>

    <div class="content_subTitle">
        <h2 class="text_info_infoZaabra">Zaabra Salud, es el sitio donde están, los mejores especialistas e instituciones medicas de todas partes del país al alcance de sus manos y con tan solo un click.</h2>
    </div>

    <section class="section_acordion">
        <div id="accordion" class="content_accordion accordion">  <!-- Clase accordion para función del desplegable con cambio de color se encuentra ubicado en el archivo footer.js -->
            <div class="card card_acordion"> <!-- ¿Quiénes somos? -->
                <div id="headingOne"> 
                    <button id="One" class="button_acordion" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">¿Quiénes somos</button>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body toggle_info">
                        <p class="txt_toggle_info">
                            Zaabra es una empresa de desarrollo de productos digitales, con soluciones alrededor del e-commerce y plataformas especializadas en potenciar a profesionales y empresarios colombianos. 
                            Creamos soluciones digitales integrales, hechas a la medida de las necesidades del mercado.
                        </p>
                        <p class="txt_toggle_info">
                            Potenciamos la comercialización de productos y servicios, incrementamos el alcance de los profesionales en el entorno digital y propiciamos su apertura a nuevos nichos de mercado.
                        </p>
                        
                        <h5 class="title_toggle_info"> Nos caracteriza: </h5>
                        <ul class="text_li_toggle_info">
                            <li> Productos digitales a la medida de las necesidades del mercado. </li>
                            <li> Seguridad y confianza. </li>
                            <li> Competitividad en el mercado. </li>
                            <li> Un equipo idóneo. </li>
                            <li> Garantía y compromiso. </li>
                        </ul>
            
                        <h5 class="title_toggle_info"> Nuestra Misión: </h5>
                        <p class="txt_toggle_info">
                            En Zaabra tenemos la misión de generar bienestar mediante el desarrollo y la innovación tecnológica, fortaleciendo la economía nacional con buenas prácticas y relaciones transparentes con nuestro entorno.
                        </p>
                    
                        <h5 class="title_toggle_info"> Nuestra Visión: </h5>
                        <p class="txt_toggle_info">
                            Zaabra, como compañía, se proyecta para ser un referente de soluciones digitales a nivel nacional en el año 2021, incursionando también en mercados internacionales.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card card_acordion"> <!-- ¿Cómo funciona Zaabra Salud? -->
                <div id="headingTwo">
                    <button id="two" class="button_acordion" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">¿Cómo funciona Zaabra Salud?</button>
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body toggle_info">
                        <p class="txt_toggle_info">
                            Zaabra Salud es una plataforma digital que facilita la búsqueda y el contacto entre usuarios y profesionales e instituciones de la salud.
                        </p>

                        <p class="txt_toggle_info">
                            Todas las especialidades y las mejores instituciones médicas al alcance de millones de usuarios.
                        </p>

                        <p class="txt_toggle_info">
                            Todo esto con el fin de obtener un rápido y fácil acceso a citas y consultas médicas con todas las especialidades, citas y servicios
                            odontológicos, centros de toma de exámenes e imágenes diagnósticas y muchos servicios más.
                        </p>

                        <p class="txt_toggle_info mb-1">
                            5 pasos para agendar su cita o servicio médico:
                        </p>

                        <ul class="text_li_toggle_info">
                            <li> Seleccione el servicio que busca. </li>
                            <li> Acceda al catálogo de profesionales y servicios. </li>
                            <li> Seleccione el profesional o institución de la salud que se ajuste a sus necesidades. </li> 
                            <li> Agende y pague su cita. </li> 
                            <li> Disfrute de un excelente servicio avalado por cientos de usuarios. </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card card_acordion"> <!-- ¿Responsabilidad social? -->
                <div id="headingThree">
                    <button id="three" class="button_acordion" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Responsabilidad social</button>
                </div>

                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body toggle_info">
                        <p class="txt_toggle_info">
                            Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
