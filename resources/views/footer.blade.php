<!-- Footer -->
<footer>
    <!-- Footer -->
    <div class="container-fluid p-0">
        <!-- Row newzletter-->
        <div class="row footer_newsletter">
            <!-- Column titulo-->
            <div class="col-lg-10 newsletter_contenido">
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
            <form class="row col-10 for_suscribirme-cel d-block d-lg-none" action="" id="" method="get">
                <input class="input-suscribirme-cel" type="email" id="txtNewLeeter" name="txtNewLeeter" placeholder="zaabra@gmail.com">
                <div class="col-12 section-checkBox-footerCel">
                    <input type="checkbox" class="btn-checkBox-footerCel" id="aceptoTerminosNewLetter-cell"> 
                    <span class="textInfo-checkBox-footerCel">Acepto <b><u>términos y condiciones</u></b>
                        y autorizo el <b><u>tratamiento de mis datos personales</u></b>
                    </span>
                </div>
                <button type="submit" value="Suscribirme" class="col-6 col-md-4 btn-input-enviar-footerCel" >
                <span> Suscribirme </span>
                <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="icon-flecha-btn-footerCel" alt=""> 
            </form>
            <!--******************************     Column end form suscribirme version MOBILE      *********************************-->
        </div>
        <!-- Row end newsletter -->

        <!-- Row informacion Zaabrasalud-->
        <div class="row footer_info-zaabrasalud">
            <!-- Column contenido contactanos-->
            <div class="col-lg-4 contactanos_contenido">
                <!-- Column logo zaabra contactanos -->
                <div class="col-lg-8 logo_contactanos">
                    <img class="imagen_logo" src="{{URL::asset('/img/logos/Logo-zaabra-blanco.png')}}">
                </div>
                <!-- Column end logo zaabra contactanos -->

                <!-- Column informacion contactanos -->
                <div class="col-md-8 titulo_seccion-info">
                    <span> CONTÁCTANOS </span> 
                </div>
                <!-- Column end informacion contactanos -->

                <!-- Column iconos redes sociales contactanos -->
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
                <div class="col-lg-8 correo_contactanos">
                    <span> servicioalcliente@zaabra.com.co </span>
                </div>
                <!-- Column correo zaabra contactanos -->
            </div>
            <!-- Column end contenido contactanos -->

            <!-- Column contenido acerca zaabra-->
            <div class="col-lg-3 infoZaabra_contenido">
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
            <div class="col-lg-3 infoZaabra_contenido">
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
        </div>
        <!-- Row end informacion Zaabrasalud-->

        <!-- Row iconos gobierno de Colombia -->
        <div class="row col-12 col-md-11 col-lg-9 footer_iconos-colombia">
            <!-- Column icono gobierno de Colombia -->
            <div class="col-5 col-md-4 col-lg-4 icon_gob-colombia">
                <img class="imagen_icono-colombia" src="{{URL::asset('/img/logos/logo-gobierno-de-colombia.png')}}"> 
            </div>
            <!-- Column end icono gobierno de Colombia -->

            <!-- Colimn icono hecho en Colombia -->
            <div class="col-5 col-md-4 col-lg-4 icon_hecho-colombia">
                <img class="imagen_icono-colombia" src="{{URL::asset('/img/logos/logo_hecho_en_colombia.png')}}"> 
            </div>
            <!-- Column end icono hecho en Colombia -->

            <!-- Column icono ssl Colombia-->
            <div class="col-2 col-md-3 col-lg-3 icon_ssl-colombia">
                <img class="imagen_icono-colombia" src="{{URL::asset('/img/logos/logo_ssl_secure_connection.png')}}"> 
            </div>
            <!-- Column end icono ssl Colombia -->
        </div>
        <!-- Row end iconos gobierno de Colombia -->
    </div>
    <!-- Footer -->

    <!-- Copyright -->
    <div class="col-12 footer_copy-right">
      <span class="texto_copy-right">&copy; Zaabra 2021 </span>  
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->


