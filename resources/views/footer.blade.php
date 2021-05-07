<!-- Footer -->
<footer class="fixed-bottom">
    <!-- Contenedor principal del footer -->
    <div class="container-fluid p-0">
        <!-- Row newzletter-->
        <div class="row footer_newsletter">
            <!-- Column titulo-->
            <div class="col-lg-10 mt-2 mt-lg-0 newsletter_contenido">
                <h2 class="newsletter_titulo">¡Suscríbete a nuestro newsletter!</h2>
                <p class="newsletter_texto"> Mantente al día de todas nuestras novedades </p>
            </div>
            <!-- Column end titulo -->

            <!-- Column form suscribirme -->
            <div class="col-lg-7 suscribirme_contenido d-none d-lg-block">
                <form  class="row form_suscribirme" action="" id="" method="get">
                    <input class="col-lg-8 input_suscribirme" type="email" id="txtNewLeeter" name="txtNewLeeter" placeholder="zaabra@gmail.com">
                    <button class="col-lg-3 boton_suscribirme" type="submit" value="Suscribirme">
                    <span> Suscribirme </span>
                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="boton_icon-flecha" alt=""> 
                </form>
            </div>
            <!-- Column end form suscribirme -->

            <!-- Column terminos -->
            <div class="col-lg-8 terminos_contenido d-none d-lg-flex">
                <input class="checkBox_terminos" type="checkbox" id="aceptoTerminosNewLetter">
                <h4 class="texto_terminos">Acepto <b><u>términos y condiciones</u></b> y autorizo el <b><u>tratamiento de mis datos personales</u></b></h4>
            </div>
            <!-- Column end terminos -->

            <!--******************************     Column form suscribirme version MOBILE      *********************************-->
            <form class="row col-10 p-0 m-auto d-block d-lg-none" action="" id="" method="get">
                <input class="input_suscribirme-cel" type="email" id="txtNewLeeter" name="txtNewLeeter" placeholder="zaabra@gmail.com">
                <div class="col-12 check_terminos-cel">
                    <input type="checkbox" class="boton_check-terminos-cel" id="aceptoTerminosNewLetter-cell"> 
                    <span class="texto_terminos-cel">Acepto <b><u>términos y condiciones</u></b>
                        y autorizo el <b><u>tratamiento de mis datos personales</u></b>
                    </span>
                </div>
                <button type="submit" value="Suscribirme" class="col-6 mb-2 boton_suscribirme-cel" >
                <span> Suscribirme </span>
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="icono_flecha-suscribirme-cel" alt=""> 
            </form>
            <!--******************************     Column end form suscribirme version MOBILE      *********************************-->
        </div>
        <!-- Row end newsletter -->

        <!-- Row informacion Zaabrasalud-->
        <div class="row footer_info-zaabrasalud">
            <!-- Column contenido contactanos-->
            <div class="col-lg-4 contactanos_contenido d-none d-lg-flex">
                <!-- Column logo zaabra contactanos -->
                <div class="col-lg-9 logo_contactanos">
                    <img class="imagen_logo" src="{{URL::asset('/img/logos/Logo-zaabra-blanco.png')}}">
                </div>
                <!-- Column end logo zaabra contactanos -->

                <!-- Column informacion contactanos -->
                <div class="col-lg-9 titulo_seccion-info">
                    <span> CONTÁCTANOS </span> 
                </div>
                <!-- Column end informacion contactanos -->

                <!-- Column iconos redes sociales contactanos -->
                <div class="col-lg-9 iconos_redes-sociales">
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

                    <div class="col-lg-1 mr-lg-2 mr-xl-0 p-0">
                        <a href="https://twitter.com/ZaabraCol" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-twitter-blanco.svg')}}"> 
                        </a>
                    </div>

                    <div class="col-lg-1 mr-lg-2 mr-xl-0 p-0">
                        <a href="https://www.youtube.com/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-youtube-blanco.svg')}}"> 
                        </a>
                    </div>

                    <div class="col-lg-1 mr-lg-2 mr-xl-0 p-0">
                        <a href="https://www.whatsapp.com/ZaabraCol/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-whatsapp-blanco.svg')}}"> 
                        </a>
                    </div>

                    <div class="col-lg-1 mr-lg-2 mr-xl-0 p-0">
                        <a href="https://co.pinterest.com/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-gmail-blanco.svg')}}"> 
                        </a> 
                    </div>
                </div>
                <!-- Column end iconos redes sociales contactanos -->

                <!-- Column correo zaabra contactanos -->
                <div class="col-lg-9 correo_contactanos">
                    <span> servicioalcliente@zaabra.com.co </span>
                </div>
                <!-- Column correo zaabra contactanos -->
            </div>
            <!-- Column end contenido contactanos -->

            <!-- Column contenido acerca zaabra-->
            <div class="col-lg-3 infoZaabra_contenido d-none d-lg-flex">
                <div class="col-lg-9 titulo_seccion-info">
                    <span> ACERCA DE ZAABRA </span>
                </div>

                <div class="col-lg-9 p-0">
                    <a href="{{url('politicas#quienes')}}">
                        <span class="texto_info-Zaabra">¿Quiénes somos?</span>
                    </a>
                </div> 

                <div class="col-lg-9 p-0">
                    <a href="{{url('politicas#preguntas')}}">
                        <span class="texto_info-Zaabra">¿Cómo funciona Zaabra profesional?</span>
                    </a>
                </div>

                <div class="col-lg-9 p-0">
                    <a href="{{url('politicas#preguntas')}}">
                        <span class="texto_info-Zaabra">Responsabilidad social</span>
                    </a>  
                </div>

                <div class="col-lg-9 p-0">
                    <a href="{{url('politicas#preguntas')}}">
                        <span class="texto_info-Zaabra">Servicios profesionales</span>
                    </a>  
                </div>
            </div>
            <!-- Column end contenido acerca de zaabra -->

            <!-- Column contenido politicas de uso -->
            <div class="col-lg-3 infoZaabra_contenido d-none d-lg-flex">
                <div class="col-lg-9 titulo_seccion-info">
                    <span> POLÍTICAS DE USO </span> 
                </div>

                <div class="col-lg-9 p-0">
                    <a href="{{url('politicas#preguntas')}}">
                        <span class="texto_info-Zaabra">Preguntas frecuentes</span>
                    </a> 
                </div>

                <div class="col-lg-9 p-0">
                    <a href="{{url('politicas#cookies')}}">
                        <span class="texto_info-Zaabra">Políticas de cookies</span>
                    </a> 
                </div>

                <div class="col-lg-9 p-0">
                    <a href="{{url('politicas#politicas')}}">
                        <span class="texto_info-Zaabra">Políticas de privacidad</span>
                    </a> 
                </div>

                <div class="col-lg-9 p-0">
                    <a href="{{url('politicas#terminos')}}">
                        <span class="texto_info-Zaabra">Términos y condiciones</span>
                    </a> 
                </div>
            </div>
            <!-- Column end contenido politicas de uso -->



            <!--******************************     Columns acerca y politicas de uso Zaabra version MOBILE      *********************************-->
            <!-- Column contenido contactanos-->
            <div class="col-10 contactanos_contenido d-block d-lg-none">
                <!-- Column informacion contactanos -->
                <div class="contenido_contactanos-cel">
                    <img class="imagen_logo" src="{{URL::asset('/img/logos/Logo-zaabra-blanco.png')}}">
                    <span class="titulo_contactanos-cel"> CONTÁCTANOS </span>
                    <span class="correo_contactanos-cel"> seervicioalcliente@zaabra.com.co </span>
                </div>
                <!-- Column correo zaabra contactanos -->

                <!-- Column iconos redes sociales contactanos -->
                <div class="iconos_redes-sociales-cel">
                    <div class="col-md-2 icono_red-social-cel">
                        <a href="https://www.facebook.com/ZaabraCol/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-facebook-blanco.svg')}}"> 
                        </a>
                    </div>

                    <div class="col-md-2 icono_red-social-cel">
                        <a href="https://www.instagram.com/zaabracol/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-instagram-blanco.svg')}}"> 
                        </a>
                    </div>

                    <div class="col-md-2 icono_red-social-cel">
                        <a href="https://twitter.com/ZaabraCol" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-twitter-blanco.svg')}}"> 
                        </a>
                    </div>

                    <div class="col-md-2 icono_red-social-cel">
                        <a href="https://www.youtube.com/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-youtube-blanco.svg')}}"> 
                        </a>
                    </div>

                    <div class="col-md-2 icono_red-social-cel">
                        <a href="https://www.whatsapp.com/ZaabraCol/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-whatsapp-blanco.svg')}}"> 
                        </a>
                    </div>

                    <div class="col-md-2 icono_red-social-cel">
                        <a href="https://co.pinterest.com/" target="_blank">
                            <img class="" src="{{URL::asset('/img/iconos/icono-gmail-blanco.svg')}}"> 
                        </a> 
                    </div>
                </div>
                <!-- Column end iconos redes sociales contactanos -->
            </div>
            <!-- Column end contenido contactanos -->

            <!-- Column contenido acerca zaabra-->
            <div class="col-12 infoZaabra_contenido-cel d-block d-lg-none">
                <div class="col-10 contenido_desplegable-cel">
                    <button class="boton_infoZaabra-cel rotacionBtn" type="button" data-toggle="collapse" 
                        data-target="#acercaZaabra" aria-expanded="false" aria-controls="acercaZaabra">
                        <i onclick="direccionFlecha(this)"  data-rote="0" class="fas fa-chevron-up icono_flecha-boton-cel">
                            <h6 class="titulo_infoZaabra-cel"> ACERCA DE ZAABRA </h6>
                        </i>
                    </button>
                </div>

                <div class="col-10 collapse infoZaabra_desplegable-cel" id="acercaZaabra">
                    <div class="col-12 card card-body desplegable_infoZaabra-cel">
                        <div class="col-12 texto_infoZaabra-cel">
                            <a href="/quienes">
                                <span class="">- ¿Quiénes somos?</span>
                            </a>    
                        </div>

                        <div class="col-12 texto_infoZaabra-cel">
                            <a href="">
                                <span class="">- ¿Como funciona Zaabra profesional</span>
                            </a>
                        </div>

                        <div class="col-12 texto_infoZaabra-cel">
                            <a href="/quienes#politicas">
                                <span class="">- Responsabilidad social </span>
                            </a>
                        </div>

                        <div class="col-12 texto_infoZaabra-cel">
                            <a href="">
                                <span class="">- Servicios profesionales </span>
                            </a>
                        </div>
                    </div>
                </div> 
            </div>
            <!-- Column end contenido acerca de zaabra -->

            <!-- Linea que divide las secciones acerca de zaabra y políticas de uso -->
            <div class="col-10 contenido_linea-blanca-cel d-block d-lg-none">
                <hr class="division_linea-blanca-cel">
            </div> 
            <!-- Linea que divide las secciones acerca de zaabra y políticas de uso -->

            <!-- Column contenido politicas de uso -->
            <div class="col-12 infoZaabra_contenido-cel d-block d-lg-none">
                <div class="col-10 contenido_desplegable-cel">
                    <button class="boton_infoZaabra-cel rotacionBtn" type="button" data-toggle="collapse" 
                            data-target="#politicasUse" aria-expanded="false" aria-controls="politicasUse">
                        <i onclick="direccionFlecha(this)"  data-rote="0" class="fas fa-chevron-up icono_flecha-boton-cel"> 
                            <h6 class="titulo_infoZaabra-cel"> POLÍTICAS DE USO </h6>
                        </i>
                    </button>
                </div>

                <div class="col-10 collapse infoZaabra_desplegable-cel" id="politicasUse">
                    <div class="col-12 card card-body desplegable_infoZaabra-cel">
                        <div class="col-12 texto_infoZaabra-cel">
                            <a href="/quienes#preguntas">
                                <span class="">- Preguntas frecuentes</span>
                            </a>
                        </div>

                        <div class="col-12 texto_infoZaabra-cel">
                            <a href="/quienes#terminos">
                                <span class="">- Políticas de cookies</span>
                            </a>
                        </div>

                        <div class="col-12 texto_infoZaabra-cel">
                            <a href="/quienes#politicas">
                                <span class="">- Políticas de privacidad</span>
                            </a>
                        </div>

                        <div class="col-12 texto_infoZaabra-cel">
                            <a href="/quienes#terminos">
                                <span class="">- Términos y condiciones</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column end contenido politicas de uso -->
            <!--******************************     Column end form suscribirme version MOBILE      *********************************-->
        </div>
        <!-- Row end informacion Zaabrasalud-->

        <!-- Row iconos gobierno de Colombia -->
        <div class="row col-12 col-md-11 col-lg-9 footer_iconos-colombia">
            <div class="col-5 col-md-4 col-lg-4 icon_gob-colombia">
                <img class="imagen_icono-colombia" src="{{URL::asset('/img/logos/logo-gobierno-de-colombia.png')}}"> 
            </div>

            <div class="col-4 col-md-4 col-lg-4 icon_hecho-colombia">
                <img class="imagen_icono-colombia" src="{{URL::asset('/img/logos/logo_hecho_en_colombia.png')}}"> 
            </div>

            <div class="col-3 col-md-3 col-lg-3 icon_ssl-colombia">
                <img class="imagen_icono-colombia" src="{{URL::asset('/img/logos/logo_ssl_secure_connection.png')}}"> 
            </div>
        </div>
        <!-- Row end iconos gobierno de Colombia -->
    </div>
    <!-- End contenedor principal del footer -->

    <!-- Copyright -->
    <div class="col-12 footer_copy-right">
      <span class="texto_copy-right">&copy; Zaabra 2021 </span>  
    </div>
    <!-- Copyright end -->
</footer>
<!-- Footer -->


