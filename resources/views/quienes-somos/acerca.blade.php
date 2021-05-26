@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <section class="row">
        <img class="imagen_bannerPrin-prof" src="{{URL::asset('/img/banners/bannerquienessomos/banner-acerca-de-zaabra-texto.jpeg')}}">
    </section>

    <section class="section_principal-acerca">
        <p class="text_top-acerca">Zaabra Salud, es el sitio donde están, los mejores especialistas e instituciones medicas de todas partes del país al alcance de sus manos y con tan solo un click.</p>

        <div id="accordion">
            <div class="card">
                <div class="card-header p-0" id="headingOne">
                    <h5 class="mb-0">
                        <button class="oscar boton_collapse-acerca" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> ¿Quiénes somos? </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
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

            <div class="card">
                <div class="card-header p-0" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="boton_collapse-acerca" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> ¿Cómo funciona Zaabra Salud? </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header p-0" id="headingThree">
                    <h5 class="mb-0">
                        <button class="boton_collapse-acerca" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Responsabilidad social </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection