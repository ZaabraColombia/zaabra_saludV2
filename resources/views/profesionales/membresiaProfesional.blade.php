@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <section class="section_principal-membresia">
    <!-- Titulo principal y texto superiror -->
    <h5 class="titulo_principal-membresia"> ESCOJA SU PLAN </h5>
    <p class="texto_superior-membresia"> Escoja el que se ajuste a sus necesidades. </p>

    <!-- Seccion opciones paara Registrarse -->
    <div class="row section_inputs-option-membresia">
      <div class="col-4 col-lg-3 col-xl-2 form-check input_option-membresia">
          <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
          <input class="form-check-input input_img-option-membresia" onclick="hideForm(this)" type="image" src="/img/iconos/icono-doctor-azul.svg" name="idrol" value="2" data-position="doctor">
          <label class="form-check-label texto_input-doctor-membresia" for="idrol"> Doctor/a </label>
      </div>

      <div class="col-4 col-lg-3 col-xl-2 form-check input_option-membresia"> 
          <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
          <a class="ruta_membresiaInst" href="{{ route('membresiaInstitucion') }}"> 
            <input class="form-check-input input_img-option-membresia" onclick="hideForm(this)" type="image" src="/img/iconos/icono-institucion.svg" name="idrol" value="3" data-position="institucion"> 
              <label class="form-check-label texto_input-instituto-membresia" for="idrol"> Consultorios médicos/ Odontológicos </label>
            </input>
          </a>
      </div>
    </div>

    <!-- Acordion 1 -->
    <!--///   Evento cambio de color y dejar un solo item desplegado en las opciones de la tarjeta membresiaProfesional, función ubicada en el archivo footer.js
              por medio de la clase "evento_acordion" anclada en el div principal donde esta contenido el acordion número 1  ///-->
    <div class="evento_acordion contain_accordion-membresia" id="accordion1">
      <h5 class="titulo_tarjeta-membresia"> Plan Gratuito </h5>
      <p class="texto_superior-membresia"> Inícielo gratis hoy y después conviértase al Premium. </p>
      <p class="texto_tiempo-membresia"> Tiempo de vigencia: 15 días </p>

      <!-- Sección opcion tarjeta PLAN GRAATUITO -->
      <div class="card containt_options-collapse-membresia">
        <div id="headingOne">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Tarjeta medica </button>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion1">
          <div class="card-body text_interno-toggle-membresia">
            <p>
              Podrá previsualizar su información en una tarjeta ubicada en la galería de Especialistas. Vigencia 15 días.
            </p>
          </div>
        </div>
      </div>

      <!-- Botón Registrar -->
      <div class="col-10 content_btn-ingresar-membresia">
        <a href="{{route('register')}}">
          <button type="submit" class="btn_Ingreso-membresia"> {{ __('Registro') }}
            <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
          </button>
        </a>
      </div>
    </div>

    <!-- Acordion 2 -->
    <!--///   Evento cambio de color y dejar un solo item desplegado en las opciones de la tarjeta membresiaProfesional, función ubicada en el archivo footer.js
              por medio de la clase "evento_acordion" anclada en el div principal donde esta contenido el acordion número 2  ///-->
    <div class="evento_acordion contain_accordion-membresia" id="accordion">
      <!-- Titulo tarjeta membresia -->
      <h5 class="titulo_tarjeta-membresia"> Plan Premiun </h5>

      <!-- Botón Registrar -->    
      <div class="col-12 content_btn-ingresar-membresia">
        <button type="submit" class="btn_precio-tarjeta-membresia" data-toggle="modal" data-target="#exampleModal"> 
          <h5 class="precio_tarjeta-membresia"> $119.900 </h5>
          <h5 class="texto_precio-membresia"> Mensual* </h5>
        </button>
      </div>

      <!-- Sección opciones desplegables de la tarjeta MEMBRESIA PROFESIONAL -->
      <div class="card containt_options-collapse-membresia">
      <div id="headingTwo">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> Página web </button>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            <p>
              Zaabra Salud le permite contruir su perfil profesional, muestre su información de contacto, profesión y especialidad, 
              tipos de consulta, redes sociales, formación académica, certificados, procedimientos y más. Todo en un solo lugar.
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
            <p>
              Aquí podrá encontrar agendamiento online, disponibilidad del profesional, podrá gestionar sus citas, 
              encontrará las alertas y notificaciones y podrá administrarlas por medio de WhatsApp, correo electrónico o mensajes de texto.
            </p>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingFour">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> Historia clinica </button>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            <p>
              Una consulta personalizada para cada usuario o paciente que agenda su consulta a través de Zaabra Salud.
            </p>
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
              Presente sus estudios, exalte  susconocimientos, habilidades y su preparación profesional.
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
            <p>
              Presente el paso a paso de cada procedimiento o tratamiento. Permita que sus pacientes vean la transformación de cada proceso.
            </p>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingSeven">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven"> Premios y reconocimientos </button>
        </div>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
           <P>
            Publique sus premios y reconocimientos, que gracias a su trabajo y el tiempo ha obtenido.
           </P>
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
              Consulte sus métricas de desempeño: Clics recibidos, consultas agendadas, consultas efectivas, consultas canceladas y mucho más.
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
            <P>
              Su reputación la ha construído con su trabajo. La reputación digital exige un trabajo adicional.
              Impulse su perfil en Zaabra Salud. Nuestro sitio web y nuestras redes sociales amplificarán su alcance. Nuestro equipo de marketing lo hará por usted.
            </P>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingTen">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen"> Posicionamiento web </button>
        </div>
        <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            <P>
              Nos enfocamos en lograr que los profesionales y las instituciones sean reconocidos, posicionamos su perfil en la búsqueda de los usuarios.
            </P>
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
              Ingrese a su perfil, edite su información, actualice sus estudios, experiencia y mucho más. La nueva información está sujeta a verificación.
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
            <P>
              Cada usuario posee unas credenciales de acceso. Con estos podrá acceder al sitio 24/7. Garantizamos alta disponibilidad y acceso en múltiples dispositivos: Computadores, móviles y tablets.
            </P>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingThirteen">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen"> Asesoramiento y soporte técnico </button>
        </div>
        <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            <P>
              Trabajamos para usted, por eso siempre tiene canales de comunicación directa para responder a todas sus inquietudes.
            </P>
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
              Los usuarios finales o pacientes podrán observar en la galería de su Landing page imágenes de las cirugías o tratamientos de cada profesional, se podrá observar paso a paso toda la transformación del antes y después.
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
            <P>
              Zaabra profesional tiene al servicio de los usuarios y de los profesionales comentarios, testimonios y calificación por medio de estrellas, 
              estos comentarios son verificados por Zaabra profesional, si tiene una buena calificación, su perfil profesional será más visible.
            </P>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-membresia">
        <div id="headingSixteen">
          <button class="boton_collapse-off-membresia" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen"> Reportes y RIPs </button>
        </div>
        <div id="collapseSixteen" class="collapse" aria-labelledby="headingSixteen" data-parent="#accordion">
          <div class="card-body text_interno-toggle-membresia">
            <P>
              Reportes y gráficas en tiempo real de pacientes, citas, historias clínicas, diagnósticos, comprobantes diarios, histórico, generación de RIPs.
            </P>
          </div>
        </div>
      </div>

      <p class="texto_inferior-membresia"> Puede complementar y personalizar su plan con recursos publicitarios adicionales. <a class="contac_membresia" href="{{route('contacto')}}" target="blank"> Contáctenos </a> para ser atendido por un representante. *Vigencia anual. </p>

      <!-- Botón Empezar -->
      <div class="col-10 content_btn-ingresar-membresia">
        <button type="submit" class="btn_Ingreso-membresia" data-toggle="modal" data-target="#exampleModal"> {{ __('Empezar') }} 
          <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-membresia" alt=""> 
        </button>
      </div>
    </div>
  </section>
</div>

@endsection