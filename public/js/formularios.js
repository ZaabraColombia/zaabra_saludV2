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


// Función para ocultar y mostrar el contenido de cada una de las opciones del FORMULARIO INSTITUCIÓN
$(document).ready(function() {
    $(".content_dato-Institution").show();
    $(".content_textPrincipal-formProf").show();
    $(".content_serv-prof").hide();
    $(".content_acerca-institution").hide();
    $(".content_profesional-inst").hide();
    $(".content_certif-institution").hide();
    $(".content_sede-institution").hide();
    $(".content_galeria-institution").hide();

    $(".dato-personal").click(function() {
        $(".content_dato-Institution").toggle("650","swing")
        $(".perfil-profesional").removeClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").removeClass('iconAzul_trataProced')
        $(".premio-reconocimiento").removeClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')
     
        $(".content_textPrincipal-formProf").show();
        $(".content_serv-prof").hide();
        $(".content_acerca-institution").hide();
        $(".content_profesional-inst").hide();
        $(".content_certif-institution").hide();
        $(".content_sede-institution").hide();
        $(".content_galeria-institution").hide();
    });

    $(".perfil-profesional").click(function() {
        $(".content_serv-prof").toggle("650","swing")
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").removeClass('iconAzul_trataProced')
        $(".premio-reconocimiento").removeClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')

        $(".content_textPrincipal-formProf").hide();
        $(".content_dato-Institution").hide();
        $(".content_acerca-institution").hide();
        $(".content_profesional-inst").hide();
        $(".content_certif-institution").hide();
        $(".content_sede-institution").hide();
        $(".content_galeria-institution").hide();
    });

    $(".tratamiento-procedimiento").click(function() {
        $(".content_acerca-institution").toggle("650","swing")
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").removeClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')

        $(".content_textPrincipal-formProf").hide();
        $(".content_dato-Institution").hide();
        $(".content_serv-prof").hide();
        $(".content_profesional-inst").hide();
        $(".content_certif-institution").hide();
        $(".content_sede-institution").hide();
        $(".content_galeria-institution").hide();
    });

    $(".profesional-institution").click(function() {                     /// opcion nueva de profesionales para modificar
        $(".content_profesional-inst").toggle("650","swing")
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')

        $(".content_textPrincipal-formProf").hide();
        $(".content_dato-Institution").hide();
        $(".content_serv-prof").hide();
        $(".content_acerca-institution").hide();
        $(".content_certif-institution").hide();
        $(".content_sede-institution").hide();
        $(".content_galeria-institution").hide();
    });

    $(".premio-reconocimiento").click(function() {
        $(".content_certif-institution").toggle("650","swing")
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
        $(".publicacion").addClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')

        $(".content_textPrincipal-formProf").hide();
        $(".content_dato-Institution").hide();
        $(".content_serv-prof").hide();
        $(".content_acerca-institution").hide();
        $(".content_profesional-inst").hide();
        $(".content_sede-institution").hide();
        $(".content_galeria-institution").hide();
    });

    $(".publicacion").click(function() {
        $(".content_sede-institution").toggle("650","swing")
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')

        $(".content_textPrincipal-formProf").hide();
        $(".content_dato-Institution").hide();
        $(".content_serv-prof").hide();
        $(".content_acerca-institution").hide();
        $(".content_profesional-inst").hide();
        $(".content_certif-institution").hide();
        $(".content_galeria-institution").hide();
    });

    $(".galeria-video").click(function() {
        $(".content_galeria-institution").toggle("650","swing")
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
        $(".publicacion").addClass('iconAzul_public')
        $(".galeria-video").addClass('iconAzul_galeriaVideo')

        $(".content_textPrincipal-formProf").hide();
        $(".content_dato-Institution").hide();
        $(".content_serv-prof").hide();
        $(".content_acerca-institution").hide();
        $(".content_profesional-inst").hide();
        $(".content_certif-institution").hide();
        $(".content_sede-institution").hide();
    });
});