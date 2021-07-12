@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <section class="section_principal-institucion">
    <h5 class="titulo_principal-institucion"> ESCOJA SU PLAN </h5>
    <p class="texto_superior-institucion"> Escoja el que se ajuste a sus necesidades. </p>

    <!-- Seccion opciones paara Registrarse -->
    <div class="row section_inputs-option-institucion">
      <div class="col-4 col-lg-3 col-xl-2 form-check input_option-institucion">
          <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
          <a class="ruta_membresiaProf" href="{{ route('membresiaProfesional') }}">
            <input class="form-check-input input_img-option-institucion" onclick="hideForm(this)" type="image" src="/img/iconos/icono-doctor.svg" name="idrol" value="2" data-position="doctor">
            <label class="form-check-label texto_input-doctor-institucion" for="idrol"> Doctor/a </label>
          </a>
      </div>

      <div class="col-4 col-lg-3 col-xl-2 form-check input_option-institucion"> 
          <!-- Evento onclick para desplegar los elementos de registro la funcion se encuentra en el archivo register.js -->
          <input class="form-check-input input_img-option-institucion" onclick="hideForm(this)" type="image" src="/img/iconos/icono-institucion-verde.svg" name="idrol" value="3" data-position="institucion">
          <label class="form-check-label texto_input-instituto-institucion" for="idrol"> Consultorios médicos/ Odontológicos </label>
      </div>
    </div>

    <!-- Acordion 1 -->
    <!--///   Evento cambio de color y dejar un solo item desplegado en las opciones de la tarjeta membresiaInstitucion, función ubicada en el archivo footer.js
              por medio de la clase "evento_acordion" anclada en el div principal donde esta contenido el acordion número 1   ///-->
    <div class="evento_acordion contain_accordion-institucion" id="accordion1">
      <h5 class="titulo_tarjeta-institucion"> Plan Gratuito </h5>
      <p class="texto_superior-institucion"> Inícielo gratis hoy y después conviértase al Premium. </p>
      <p class="texto_tiempo-institucion"> Tiempo de vigencia: 15 días </p>

      <!-- Sección opcion tarjeta PLAN GRAATUITO -->
      <div class="card containt_options-collapse-institucion">
        <div id="headingOne">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Tarjeta medica </button>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion1">
          <div class="card-body text_interno-toggle-institucion">
            <p>
              Podrá previsualizar su información en una tarjeta ubicada en la galería de Instituciones. Vigencia 15 días.
            </p>
          </div>
        </div>
      </div>

      <!-- Botón Registrar -->
      <div class="col-10 content_btn-ingresar-institucion">
        <a href="{{route('register')}}">
          <button type="submit" class="btn_Ingreso-institucion"> {{ __('Registro') }}
            <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-institucion" alt=""> 
          </button>
        </a>
      </div>
    </div>

    <!-- Acordion 2 -->
    <!--///   Evento cambio de color y dejar un solo item desplegado en las opciones de la tarjeta membresiaInstitucion, función ubicada en el archivo footer.js
              por medio de la clase "evento_acordion" anclada en el div principal donde esta contenido el acordion número 2   ///-->
    <div class="evento_acordion contain_accordion-institucion" id="accordion">
      <h5 class="titulo_tarjeta-institucion"> Plan Premiun </h5>

      <!-- Botón Registrar -->    
      <div class="col-12 content_btn-ingresar-institucion">
        <button type="submit" class="btn_precio-tarjeta-institucion" data-toggle="modal" data-target="#exampleModal"> 
          <h5 class="precio_tarjeta-institucion"> $179.900 </h5>
          <h5 class="texto_precio-institucion"> Mensual* </h5>
        </button>
      </div>

      <!-- Sección opciones de la tarjeta institucion -->
      <div class="card containt_options-collapse-institucion">
        <div id="headingTwo">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> Página web </button>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            <p>
              Zaabra Salud le permite construir el perfil de su institución.
            </p>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-institucion">
        <div id="headingThree">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Galería </button>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            <P>
              Los usuarios de Zaabra Salud podrán observar en la galería de su landing page institucional, imágenes de los tratamientos, cirugías o procedimientos realizados por la entidad y sus profesionales.
            </P>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-institucion">
        <div id="headingFour">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> Opiniones de pacientes </button>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            <P>
              Zaabra Salud permite a todos sus usuarios realizar comentarios y calificaciones por medio de estrellas. Así entre mejores calificaciones obtenga, tendrá un mejor posicionamiento. Tranquilo, todos los comentarios son verificados por Zaabra Salud.
            </P>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-institucion">
        <div id="headingFive">
            <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive"> Servicios ofrecidos por la institución </button>
        </div>

        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            <p>
              Muestre su portafolio de servicios, profesionales adscritos, sedes, horarios, tipos de consulta y mas. Todo en un solo lugar.
            </p>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-institucion">
        <div id="headingSix">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix"> Acerca de la institución </button>
        </div>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            <P>
              Su experiencia, trayectoria y crecimiento desde el inicio.
            </P>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-institucion">
        <div id="headingSeven">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven"> Certificaciones </button>
        </div>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            Publique sus premios y reconocimientos, que gracias a su trabajo y el tiempo ha obtenido.
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-institucion">
        <div id="headingEight">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight"> Registro de usuarios </button>
        </div>

        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            <p>
              Cada usuario posee unas credenciales de acceso. Con estos podrá acceder al sitio 24/7. Garantizamos alta disponibilidad y acceso en múltiples dispositivos: Computadores, móviles y tablets.
            </p>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-institucion">
        <div id="headingNine">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine"> Análisis y métricas del perfil </button>
        </div>
        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            <P>
              Consulte sus métricas de desempeño: Clics recibidos, consultas agendadas, consultas efectivas, consultas canceladas, servicios más consultados y mucho más.
            </P>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-institucion">
        <div id="headingTen">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen"> Asesoramiento y soporte técnico </button>
        </div>
        <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            Trabajamos para usted, por eso siempre tiene canales de comunicación directa para responder a todas sus inquietudes.
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-institucion">
        <div id="headingEleven">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven"> Marketing digital y publicidad </button>
        </div>

        <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            <p>
              Su reputación la ha construído con su trabajo. La reputación digital exige un trabajo adicional.
              Impulse su perfil en Zaabra Salud. Nuestro sitio web y nuestras redes sociales amplificarán su alcance. Nuestro equipo de marketing lo hará por usted.
            </p>
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-institucion">
        <div id="headingTwelve">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve"> Posicionamiento web </button>
        </div>
        <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            Nos enfocamos en lograr que los profesionales y las instituciones sean reconocidos, posicionamos su perfil en la búsqueda de los usuarios.
          </div>
        </div>
      </div>

      <div class="card containt_options-collapse-institucion">
        <div id="headingThirteen">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen"> Cambios y actualizaciones </button>
        </div>
        <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            <P>
              Ingrese a su perfil, edite su información, actualice su portafolio de servicios, sedes, horarios y mucho más. La nueva información está sujeta a verificación.
            </P>
          </div>
        </div>
      </div>





      <div class="card containt_options-collapse-institucion">
        <div id="headingFourteen">
          <button class="boton_collapse-off-institucion" onclick="colorBtnToggle(this)" data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="true" aria-controls="collapseFourteen"> Reportes </button>
        </div>

        <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen" data-parent="#accordion">
          <div class="card-body text_interno-toggle-institucion">
            <p>
              Reportes y gráficas en tiempo real de usuarios que navegan y visitan la landing page de su institución.
            </p>
          </div>
        </div>
      </div>

      <p class="texto_inferior-institucion"> Puede complementar y personalizar su plan con recursos publicitarios adicionales. <a class="contac_institucion" href="{{route('contacto')}}" target="blank"> Contáctenos </a> para ser atendido por un representante. *Vigencia anual. </p>

      <!-- Botón Empezar -->
      <div class="col-10 content_btn-ingresar-institucion">
        <button type="submit" class="btn_Ingreso-institucion" data-toggle="modal" data-target="#exampleModal"> {{ __('Empezar') }}
          <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_ingreso-institucion" alt=""> 
        </button>
      </div>
    </div>

    <!-- Seccion texto de la linea de ateción -->
    <div class="contain_accordion-institucion" id="accordion1">
      <p class="texto_lineaAtencion-institucion"> 
        Instituciones como clínicas, centros médicos, hospitales, laboratorio clínico, laboratorio odontológico, IPS, EPS y clínicas veterinarias. 
        Comunicarse con nuestros medical software managers o directamente con nuestra línea de atención 7123945 - 3212449869. 
      </p>
    </div>
  </section>
</div>

@endsection