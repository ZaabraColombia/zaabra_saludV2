// Función para ocultar y mostrar el contenido de cada una de las opciones del FORMULARIO PROFESIONAL
$(document).ready(function() {
    $(".content_dato-person").show();
    $(".content_textPrincipal-formProf").show();
    $(".content_perfil-prof").hide();
    $(".content_tratam-proced").hide();
    $(".content_premio-recono").hide();
    $(".content_publicacion").hide();
    $(".content_galeria-video").hide();

    $(".dato-personal").click(function() {
        $(".content_dato-person").toggle("650","swing")
        $(".perfil-profesional").removeClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").removeClass('iconAzul_trataProced')
        $(".premio-reconocimiento").removeClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')
     
        $(".content_textPrincipal-formProf").show();
        $(".content_perfil-prof").hide();
        $(".content_tratam-proced").hide();
        $(".content_premio-recono").hide();
        $(".content_publicacion").hide();
        $(".content_galeria-video").hide();
    });

    $(".perfil-profesional").click(function() {
        $(".content_perfil-prof").toggle("650","swing")
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").removeClass('iconAzul_trataProced')
        $(".premio-reconocimiento").removeClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')

        $(".content_textPrincipal-formProf").hide();
        $(".content_dato-person").hide();
        $(".content_tratam-proced").hide();
        $(".content_premio-recono").hide();
        $(".content_publicacion").hide();
        $(".content_galeria-video").hide();
    });

    $(".tratamiento-procedimiento").click(function() {
        $(".content_tratam-proced").toggle("650","swing")
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").removeClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')

        $(".content_textPrincipal-formProf").hide();
        $(".content_dato-person").hide();
        $(".content_perfil-prof").hide();
        $(".content_premio-recono").hide();
        $(".content_publicacion").hide();
        $(".content_galeria-video").hide();
    });

    $(".premio-reconocimiento").click(function() {
        $(".content_premio-recono").toggle("650","swing")
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')

        $(".content_textPrincipal-formProf").hide();
        $(".content_dato-person").hide();
        $(".content_perfil-prof").hide();
        $(".content_tratam-proced").hide();
        $(".content_publicacion").hide();
        $(".content_galeria-video").hide();
    });

    $(".publicacion").click(function() {
        $(".content_publicacion").toggle("650","swing")
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
        $(".publicacion").addClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')

        $(".content_textPrincipal-formProf").hide();
        $(".content_dato-person").hide();
        $(".content_perfil-prof").hide();
        $(".content_tratam-proced").hide();
        $(".content_premio-recono").hide();
        $(".content_galeria-video").hide();
    });

    $(".galeria-video").click(function() {
        $(".content_galeria-video").toggle("650","swing")
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
        $(".publicacion").addClass('iconAzul_public')
        $(".galeria-video").addClass('iconAzul_galeriaVideo')

        $(".content_textPrincipal-formProf").hide();
        $(".content_dato-person").hide();
        $(".content_perfil-prof").hide();
        $(".content_tratam-proced").hide();
        $(".content_premio-recono").hide();
        $(".content_publicacion").hide();
    });
});