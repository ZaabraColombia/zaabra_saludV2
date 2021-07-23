<!-- Footer -->
<footer>
    <!-- Contenedor principal del footer -->
    <div class="container-fluid p-0">
        <!-- Row newzletter-->
        <div class="row footer_newsletter">
            <!-- Column titulo-->
            <div class="col-lg-10 mt-2 mt-lg-0 newsletter_contenido">
                <h1 class="newsletter_titulo">¡Suscríbase a nuestro newsletter!</h1>
                <p class="newsletter_texto"> Manténgase al día de todas nuestras novedades </p>
            </div>

            <!-- Column form suscribirme -->
            <div class="col-lg-7 suscribirme_contenido d-none d-lg-block">
                <form id="newsletter" method="post" action="javascript:void(0)" class="row form_suscribirme">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                    <input class="col-lg-8 col-xl-7 input_suscribirme" type="email" id="correo_newsletter" name="correo_newsletter" placeholder="servicioalcliente@zaabrasalud.co">

                    <button class="col-lg-3 col-xl-2 boton_suscribirme" id="send_form" type="submit">
                        <span class="text_sucrib-foot"> Suscribirme </span>
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="boton_icon-flecha" alt=""> 
                    </button>

                    <div class="col-lg-10 terminos_contenido d-none d-lg-flex">
                        <input class="checkBox_terminos" type="checkbox" id="">
                        <h4 class="texto_terminos"> Acepto 
                            <a href="{{url('politicas')}}" target="blank"> términos y condiciones </a> y autorizo el <a href="{{url('politicas')}}" target="blank"> tratamiento de mis datos personales </a>
                        </h4>
                    </div>
                </form>
                <div class="alert_Newsletter d-none" id="msg_div">
                    <span id="res_message"></span>
                </div>
            </div>

            <!-- Column terminos -->

            <!--******************************     Column form suscribirme version MOBILE      *********************************--> 
            <form id="newsletter2" method="post" action="javascript:void(0)" class="row col-10 col-md-9 p-0 m-auto d-block d-lg-none">
               <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                <input class="input_suscribirme-cel" type="email" id="correo_newsletter2" name="correo_newsletter" placeholder="servicioalcliente@zaabrasalud.co">
                <div class="col-12 check_terminos-cel">
                    <input type="checkbox" class="boton_check-terminos-cel" id=""> 
                    <span class="texto_terminos-cel">Acepto 
                        <a href="{{url('politicas')}}" target="blank"> términos y condiciones </a> y autorizo el <a href="{{url('politicas')}}" target="blank"> tratamiento de mis datos personales </a>
                    </span>
                </div>
                <button id="send_form2" type="submit" class="col-5 col-md-4 mb-2 boton_suscribirme-cel">
                    <span> Suscribirme </span>
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="icono_flecha-suscribirme-cel" alt=""> 
                </button>
            </form>

            <div class="alert_Newsletter2 d-none" id="msg_div2">
                <span id="res_message2"></span>
            </div>
          
            <!--******************************     Column end form suscribirme version MOBILE      *********************************-->
        </div>

        <!-- Row informacion Zaabrasalud-->
        <div class="row footer_info-zaabrasalud">
            <!-- Column contenido contactanos-->
            <div class="col-lg-4 contactanos_contenido d-none d-lg-flex">
                <div class="col-lg-9 logo_contactanos">
                    <a href="{{ url('/') }}">
                        <img class="logo_header-footer" src="{{URL::asset('/img/header/logo-zaabra-salud.png')}}">
                    </a>
                </div>

                <div class="col-lg-9 d-flex p-0">
                    <span class="titulo_seccion-info"> CONTÁCTENOS </span> 
                </div>

                <div class="col-lg-8 iconos_redes-sociales">
                    <div class="col-lg-1 mr-lg-2 mr-xl-0 p-0">
                        <a href="https://www.facebook.com/ZaabraCol/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-facebook-blanco.svg')}}"> 
                        </a>
                    </div>

                    <div class="col-lg-1 mr-lg-2 mr-xl-0 p-0">
                        <a href="https://www.instagram.com/zaabracol/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-instagram-blanco.svg')}}"> 
                        </a>
                    </div>

                    <!-- <div class="col-lg-1 mr-lg-2 mr-xl-0 p-0">
                        <a href="https://twitter.com/ZaabraCol" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-twitter-blanco.svg')}}"> 
                        </a>
                    </div>
                    <div class="col-lg-1 mr-lg-2 mr-xl-0 p-0">
                        <a href="https://www.youtube.com/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-youtube-blanco.svg')}}"> 
                        </a>
                    </div> -->

                    <div class="col-lg-1 mr-lg-2 mr-xl-0 p-0">
                        <a href="https://www.whatsapp.com/ZaabraCol/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-whatsapp-blanco.svg')}}"> 
                        </a>
                    </div>

                    <!-- <div class="col-lg-1 mr-lg-2 mr-xl-0 p-0">
                        <a href="https://co.pinterest.com/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-gmail-blanco.svg')}}"> 
                        </a> 
                    </div> -->
                </div>

                <div class="col-lg-9 d-flex p-0">
                    <span class="correo_contactanos"> servicioalcliente@zaabrasalud.co </span>
                </div>
            </div>

            <!-- Column contenido acerca zaabra-->
            <div class="col-lg-3 infoZaabra_contenido d-none d-lg-flex">
                <div class="col-lg-9 d-flex p-0">
                    <span class="titulo_seccion-info"> ACERCA DE ZAABRA </span>
                </div>

                <div class="col-lg-9 p-0">
                    <a href="{{route('acerca')}}">
                        <span class="texto_info-Zaabra">¿Quiénes somos?</span>
                    </a>
                </div> 

                <div class="col-lg-9 p-0">
                    <a href="{{url('acerca')}}">
                        <span class="texto_info-Zaabra">¿Cómo funciona Zaabra Salud?</span>
                    </a>
                </div>

                <div class="col-lg-9 p-0">
                    <a href="{{url('acerca')}}">
                        <span class="texto_info-Zaabra">Responsabilidad social</span>
                    </a>  
                </div>

                <div class="col-lg-9 p-0">
                    <a href="{{url('preguntas')}}">
                        <span class="texto_info-Zaabra">Preguntas frecuentes</span>
                    </a> 
                </div>
                <!-- <div class="col-lg-9 p-0">
                    <a href="{{url('politicas#preguntas')}}">
                        <span class="texto_info-Zaabra">Servicios profesionales</span>
                    </a>  
                </div> -->
            </div>

            <!-- Column contenido politicas de uso -->
            <div class="col-lg-3 infoZaabra_contenido d-none d-lg-flex">
                <div class="col-lg-10 col-xl-9 d-flex p-0">
                    <span class="titulo_seccion-info"> POLÍTICAS DE USO </span> 
                </div>

                <div class="col-lg-10 col-xl-9 p-0">
                    <a href="{{url('politicas')}}">
                        <span class="texto_info-Zaabra">Políticas de cookies</span>
                    </a> 
                </div>

                <div class="col-lg-10 col-xl-9 p-0">
                    <a href="{{url('politicas')}}">
                        <span class="texto_info-Zaabra">Políticas de privacidad</span>
                    </a> 
                </div>

                <div class="col-lg-10 col-xl-9 p-0">
                    <a href="{{url('politicas')}}">
                        <span class="texto_info-Zaabra">Términos y condiciones de Zaabra Salud</span>
                    </a> 
                </div>

                <div class="col-lg-10 col-xl-9 p-0">
                    <a href="{{url('politicas')}}">
                        <span class="texto_info-Zaabra">Términos y condiciones del servicio </span>
                    </a> 
                </div>
            </div>

            <!--******************************     Columns contactenos acerca y políticas de uso Zaabra versión MOBILE      *********************************-->
            <!-- Column contenido contactanos-->
            <div class="col-10 col-md-8 contactanos_contenido d-block d-lg-none">
                <div class="contenido_contactanos-cel">
                    <a class="containt_logo-footer" href="{{ url('/') }}">
                        <img class="logo_header-footer" src="{{URL::asset('/img/header/logo-zaabra-salud.png')}}">
                    </a>
                    <span class="titulo_contactanos-cel"> CONTÁCTENOS </span>
                    <span class="correo_contactanos-cel">servicioalcliente@zaabrasalud.co</span>
                </div>

                <div class="iconos_redes-sociales-cel">
                    <div class="col-2 icono_red-social-cel">
                        <a href="https://www.facebook.com/ZaabraCol/" target="_blank">
                            <img class="imagen_red-social-cel" src="{{URL::asset('/img/iconos/icono-facebook-blanco.svg')}}"> 
                        </a>
                    </div>

                    <div class="col-2 icono_red-social-cel">
                        <a href="https://www.instagram.com/zaabracol/" target="_blank">
                            <img class="imagen_red-social-cel" src="{{URL::asset('/img/iconos/icono-instagram-blanco.svg')}}"> 
                        </a>
                    </div>

                    <!-- <div class="col-2 icono_red-social-cel">
                        <a href="https://twitter.com/ZaabraCol" target="_blank">
                            <img class="imagen_red-social-cel" src="{{URL::asset('/img/iconos/icono-twitter-blanco.svg')}}"> 
                        </a>
                    </div>
                    <div class="col-2 icono_red-social-cel">
                        <a href="https://www.youtube.com/" target="_blank">
                            <img class="imagen_red-social-cel" src="{{URL::asset('/img/iconos/icono-youtube-blanco.svg')}}"> 
                        </a>
                    </div> -->

                    <div class="col-2 icono_red-social-cel">
                        <a href="https://www.whatsapp.com/ZaabraCol/" target="_blank">
                            <img class="imagen_red-social-cel" src="{{URL::asset('/img/iconos/icono-whatsapp-blanco.svg')}}"> 
                        </a>
                    </div>

                    <!-- <div class="col-2 icono_red-social-cel">
                        <a href="https://co.pinterest.com/" target="_blank">
                            <img class="imagen_red-social-cel" src="{{URL::asset('/img/iconos/icono-gmail-blanco.svg')}}"> 
                        </a> 
                    </div> -->
                </div>
            </div>

            <!-- Column contenido acerca zaabra-->
            <div class="col-11 infoZaabra_contenido-cel d-block d-lg-none">
                <div class="col-11 contenido_desplegable-cel">
                    <button class="boton_infoZaabra-cel rotacionBtn" type="button" data-toggle="collapse" 
                        data-target="#acercaZaabra" aria-expanded="false" aria-controls="acercaZaabra">
                        <i onclick="direccionFlecha(this)"  data-rote="0" class="fas fa-chevron-down icono_flecha-boton-cel">
                            <h6 class="titulo_infoZaabra-cel"> ACERCA DE ZAABRA </h6>
                        </i>
                    </button>
                </div>

                <div class="col-11 collapse infoZaabra_desplegable-cel" id="acercaZaabra">
                    <div class="col-12 card card-body desplegable_infoZaabra-cel">
                        <div class="col-12">
                            <a href="{{route('acerca')}}">
                                <span class="texto_infoZaabra-cel"> ¿Quiénes somos?</span>
                            </a>    
                        </div>

                        <div class="col-12">
                            <a href="{{route('acerca')}}">
                                <span class="texto_infoZaabra-cel"> ¿Como funciona Zaabra Salud</span>
                            </a>
                        </div>

                        <div class="col-12">
                            <a href="{{route('acerca')}}">
                                <span class="texto_infoZaabra-cel"> Responsabilidad social </span>
                            </a>
                        </div>

                        <div class="col-12">
                            <a href="{{route('preguntas')}}">
                                <span class="texto_infoZaabra-cel"> Preguntas frecuentes</span>
                            </a>
                        </div>
                        <!-- <div class="col-12">
                            <a href="">
                                <span class="">- Stexto_infoZaabra-celervicios profesionales </span>
                            </a>
                        </div> -->
                    </div>
                </div> 
            </div>

            <!-- Linea que divide las secciones acerca de zaabra y políticas de uso -->
            <div class="col-10 contenido_linea-blanca-cel d-block d-lg-none">
                <hr class="division_linea-blanca-cel">
            </div> 

            <!-- Column contenido politicas de uso -->
            <div class="col-11 infoZaabra_contenido-cel d-block d-lg-none">
                <div class="col-11 contenido_desplegable-cel">
                    <button class="boton_infoZaabra-cel rotacionBtn" type="button" data-toggle="collapse" 
                            data-target="#politicasUse" aria-expanded="false" aria-controls="politicasUse">
                        <i onclick="direccionFlecha(this)"  data-rote="0" class="fas fa-chevron-down icono_flecha-boton-cel"> 
                            <h6 class="titulo_infoZaabra-cel"> POLÍTICAS DE USO </h6>
                        </i>
                    </button>
                </div>

                <div class="col-11 collapse infoZaabra_desplegable-cel" id="politicasUse">
                    <div class="col-12 card card-body desplegable_infoZaabra-cel">
                        <div class="col-12">
                            <a href="{{url('politicas')}}">
                                <span class="texto_infoZaabra-cel"> Políticas de cookies</span>
                            </a>
                        </div>

                        <div class="col-12">
                            <a href="{{url('politicas')}}">
                                <span class="texto_infoZaabra-cel"> Políticas de privacidad</span>
                            </a>
                        </div>

                        <div class="col-12">
                            <a href="{{url('politicas')}}">
                                <span class="texto_infoZaabra-cel"> Términos y condiciones de Zaabra Salud </span>
                            </a>
                        </div>

                        <div class="col-12">
                            <a href="{{url('politicas')}}">
                                <span class="texto_infoZaabra-cel"> Términos y condiciones del servicio </span>
                            </a>
                        </div>

                        <div class="col-12 h-lg-10">
                            <!-- <a href="">
                                <span class="texto_infoZaabra-cel">- Servicios profesionales </span>
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
            <!--******************************     Column end form suscribirme version MOBILE      *********************************-->
        </div>

        <!-- Row iconos gobierno de Colombia -->
        <div class="row footer_iconos-colombia">
            <div class="col-12 col-md-10 col-lg-10 col-xl-7 d-flex m-auto p-0">
                <div class="col-4 col-md-4 col-lg-5 col-xl-4 icon_gob-colombia">
                    <img class="imagen_icono-gobierno" src="{{URL::asset('/img/logos/logo-gobierno-de-colombia.png')}}"> 
                </div>

                <div class="col-5 col-md-5 col-lg-4 col-xl-4 icon_hecho-colombia">
                    <img class="imagen_icono-colombia" src="{{URL::asset('/img/logos/logo_hecho_en_colombia.png')}}"> 
                </div>

                <div class="col-3 col-md-3 col-lg-3 col-xl-4 icon_ssl-colombia">
                    <img class="imagen_icono-ssl" src="{{URL::asset('/img/logos/logo_ssl_secure_connection.png')}}"> 
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="col-12 footer_copy-right">
      <span class="texto_copy-right">&copy; Zaabrasalud 2021 </span>  
    </div>
</footer>