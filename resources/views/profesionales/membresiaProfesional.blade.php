@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <section class="section_principal-membresia">
    <h5 class="titulo_principal-membresia"> ESCOJA SU PLAN </h5>
    <p class="texto_superior-membresia"> Escoja el que se ajuste a sus necesidades. </p>

    <!-- Seccion opciones paara Registrarse -->
    <div class="row section_inputs-option-membresia">
      <div class="col-4 col-lg-3 col-xl-2 form-check input_option-membresia">
          <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
          <input class="form-check-input input_img-option-membresia" onclick="hideForm(this)" type="image" src="/img/iconos/icono-doctor.svg" name="idrol" value="2" data-position="doctor">
          <label class="form-check-label texto_option-input-membresia pad_inferior-texto" for="idrol"> Doctor/a </label>
      </div>

      <div class="col-4 col-lg-3 col-xl-2 form-check input_option-membresia"> 
          <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
          <input class="form-check-input input_img-option-membresia" onclick="hideForm(this)" type="image" src="/img/iconos/icono-institucion.svg" name="idrol" value="3" data-position="institucion">
          <label class="form-check-label texto_option-input-membresia" for="idrol"> Consultorios médicos/ Odontológicos </label>
      </div>
    </div>

    <!-- Acordion 1 -->

    <div class="contain_accordion-membresia" id="accordion1">
      <h5 class="titulo_tarjeta-membresia"> Plan Gratuito </h5>
      <p class="texto_superior-membresia"> Inícielo gratis hoy y después conviértase al Premium. </p>
      <p class="texto_tiempo-membresia"> Tiempo de vigencia: 15 días </p>

      <!-- Sección opcion tarjeta PLAN GRAATUITO -->
      <div class="card containt_options-collapse-membresia">
        <div id="headingOne">
          <button class="boton_collapse-on-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Tarjeta medica </button>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion1">
          <div class="card-body text_interno-toggle-membresia">
            <p>
              Zaabra es una empresa de desarrollo de productos digitales, con soluciones alrededor del e-commerce y plataformas especializadas en potenciar a profesionales y empresarios colombianos. <br><br> 
              Creamos soluciones digitales integrales, hechas a la medida de las necesidades del mercado. <br>
              Potenciamos la comercialización de productos y servicios, incrementamos el alcance de los profesionales en el entorno digital y propiciamos su apertura a nuevos nichos de mercado. <br><br>
            </p>
          </div>
        </div>
      </div>

      <!-- Botón Registrar -->
      <div class="col-10 content_btn-ingresar-membresia">
        <button type="submit" class="btn_Ingreso-membresia"> {{ __('Registro') }}
          <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
        </button>
      </div>
    </div>

    <!-- Acordion 2 -->
    <div class="contain_accordion-membresia" id="accordion">
      <h5 class="titulo_tarjeta-membresia"> Plan Premiun </h5>

      <!-- Botón Registrar -->    
      <div class="col-12 content_btn-ingresar-membresia">
        <button type="submit" class="btn_precio-tarjeta-membresia"> 
          <h5 class="precio_tarjeta-membresia"> $119.900 </h5>
          <h5 class="texto_precio-membresia"> Mensual* </h5>
        </button>
      </div>

      <!-- Sección opciones de la tarjeta MEMBRESIA -->
      <div class="card containt_options-collapse-membresia">
        <div id="headingTwo">
          <button class="boton_collapse-on-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> Página web </button>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            <p>
              Zaabra es una empresa de desarrollo de productos digitales, con soluciones alrededor del e-commerce y plataformas especializadas en potenciar a profesionales y empresarios colombianos. <br><br> 
              Creamos soluciones digitales integrales, hechas a la medida de las necesidades del mercado. <br>
              Potenciamos la comercialización de productos y servicios, incrementamos el alcance de los profesionales en el entorno digital y propiciamos su apertura a nuevos nichos de mercado. <br><br>
            </p>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingThree">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Agenda online </button>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            Zaabra Salud es una plataforma digital que facilita la búsqueda y el contacto entre usuarios y profesionales e instituciones de la salud. <br> 
            Todas las especialidades y las mejores instituciones médicas al alcance de millones de usuarios. <br><br> 
            Todo esto con el fin de obtener un rápido y fácil acceso a citas y consultas médicas con todas las especialidades, citas y servicios <br> 
            odontológicos, centros de toma de exámenes e imágenes diagnósticas y muchos servicios más. <br><br> 
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingFour">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> Historia clinica </button>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingFive">
            <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive"> Perfil profesional </button>
        </div>

        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            <p>
              Zaabra es una empresa de desarrollo de productos digitales, con soluciones alrededor del e-commerce y plataformas especializadas en potenciar a profesionales y empresarios colombianos. <br><br> 
              Creamos soluciones digitales integrales, hechas a la medida de las necesidades del mercado. <br>
              Potenciamos la comercialización de productos y servicios, incrementamos el alcance de los profesionales en el entorno digital y propiciamos su apertura a nuevos nichos de mercado. <br><br>
            </p>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingSix">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix"> Tratamientos y procedimientos </button>
        </div>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            Zaabra Salud es una plataforma digital que facilita la búsqueda y el contacto entre usuarios y profesionales e instituciones de la salud. <br> 
            Todas las especialidades y las mejores instituciones médicas al alcance de millones de usuarios. <br><br> 
            Todo esto con el fin de obtener un rápido y fácil acceso a citas y consultas médicas con todas las especialidades, citas y servicios <br> 
            odontológicos, centros de toma de exámenes e imágenes diagnósticas y muchos servicios más. <br><br> 
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingSeven">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven"> Premios y reconocimientos </button>
        </div>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingEight">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight"> Análisis y métricas del perfil </button>
        </div>

        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            <p>
              Zaabra es una empresa de desarrollo de productos digitales, con soluciones alrededor del e-commerce y plataformas especializadas en potenciar a profesionales y empresarios colombianos. <br><br> 
              Creamos soluciones digitales integrales, hechas a la medida de las necesidades del mercado. <br>
              Potenciamos la comercialización de productos y servicios, incrementamos el alcance de los profesionales en el entorno digital y propiciamos su apertura a nuevos nichos de mercado. <br><br>
            </p>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingNine">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine"> Marketing digital y publicidad </button>
        </div>
        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            Zaabra Salud es una plataforma digital que facilita la búsqueda y el contacto entre usuarios y profesionales e instituciones de la salud. <br> 
            Todas las especialidades y las mejores instituciones médicas al alcance de millones de usuarios. <br><br> 
            Todo esto con el fin de obtener un rápido y fácil acceso a citas y consultas médicas con todas las especialidades, citas y servicios <br> 
            odontológicos, centros de toma de exámenes e imágenes diagnósticas y muchos servicios más. <br><br> 
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingTen">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen"> Posicionamiento web </button>
        </div>
        <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingEleven">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven"> Cambios y actualizaciones </button>
        </div>

        <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            <p>
              Zaabra es una empresa de desarrollo de productos digitales, con soluciones alrededor del e-commerce y plataformas especializadas en potenciar a profesionales y empresarios colombianos. <br><br> 
              Creamos soluciones digitales integrales, hechas a la medida de las necesidades del mercado. <br>
              Potenciamos la comercialización de productos y servicios, incrementamos el alcance de los profesionales en el entorno digital y propiciamos su apertura a nuevos nichos de mercado. <br><br>
            </p>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingTwelve">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve"> Registro de usuarios </button>
        </div>
        <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            Zaabra Salud es una plataforma digital que facilita la búsqueda y el contacto entre usuarios y profesionales e instituciones de la salud. <br> 
            Todas las especialidades y las mejores instituciones médicas al alcance de millones de usuarios. <br><br> 
            Todo esto con el fin de obtener un rápido y fácil acceso a citas y consultas médicas con todas las especialidades, citas y servicios <br> 
            odontológicos, centros de toma de exámenes e imágenes diagnósticas y muchos servicios más. <br><br> 
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingThirteen">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen"> Asesoramiento y soporte técnico </button>
        </div>
        <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingFourteen">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="true" aria-controls="collapseFourteen"> Galería </button>
        </div>

        <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            <p>
              Zaabra es una empresa de desarrollo de productos digitales, con soluciones alrededor del e-commerce y plataformas especializadas en potenciar a profesionales y empresarios colombianos. <br><br> 
              Creamos soluciones digitales integrales, hechas a la medida de las necesidades del mercado. <br>
              Potenciamos la comercialización de productos y servicios, incrementamos el alcance de los profesionales en el entorno digital y propiciamos su apertura a nuevos nichos de mercado. <br><br>
            </p>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingFiveteen">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseFiveteen" aria-expanded="false" aria-controls="collapseFiveteen"> Opiniones de pacientes </button>
        </div>
        <div id="collapseFiveteen" class="collapse" aria-labelledby="headingFiveteen" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            Zaabra Salud es una plataforma digital que facilita la búsqueda y el contacto entre usuarios y profesionales e instituciones de la salud. <br> 
            Todas las especialidades y las mejores instituciones médicas al alcance de millones de usuarios. <br><br> 
            Todo esto con el fin de obtener un rápido y fácil acceso a citas y consultas médicas con todas las especialidades, citas y servicios <br> 
            odontológicos, centros de toma de exámenes e imágenes diagnósticas y muchos servicios más.
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingSixteen">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen"> Reportes y RIPs </button>
        </div>
        <div id="collapseSixteen" class="collapse" aria-labelledby="headingSixteen" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            Zaabra hace parte del sistema de Agencia Pública de Empleo del SENA, dando así oportunidades a personas en formación.
          </div>
        </div>
      </div>

      <p class="texto_inferior-membresia"> Puede complementar y personalizar su plan con recursos publicitarios adicionales. <a class="contac_membresia" href=""> Contáctenos </a> para ser atendido por un representante. *Vigencia anual. </p>

      <!-- Botón Empezar -->
      <div class="col-10 content_btn-ingresar-membresia">
        <button type="submit" class="btn_Ingreso-membresia"> {{ __('Empezar') }}
          <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
        </button>
      </div>
    </div>
  </section>
</div>

@endsection