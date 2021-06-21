// Función para ocultar y mostrar el contenido de cada una de las opciones del FORMULARIO PROFESIONAL
$(document).ready(function() {
    $(".content_dato-person").show();
    $(".content_textPrincipal-formInst").show();
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
     
        $(".content_textPrincipal-formInst").show();
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

        $(".content_textPrincipal-formInst").hide();
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

        $(".content_textPrincipal-formInst").hide();
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

        $(".content_textPrincipal-formInst").hide();
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

        $(".content_textPrincipal-formInst").hide();
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

        $(".content_textPrincipal-formInst").hide();
        $(".content_dato-person").hide();
        $(".content_perfil-prof").hide();
        $(".content_tratam-proced").hide();
        $(".content_premio-recono").hide();
        $(".content_publicacion").hide();
    });
});


/* Función para ocultar y mostrar el contenido de cada una de las opciones del FORMULARIO INSTITUCIÓN
$(document).ready(function() {
    // Elementos que se muestran al cargar la vista
    $(".content_dato-Institution").show(); // Clase para mostrar la tarjeta de " DATOS DE LA INSTITUCIOÓN ".
    $(".content_textPrincipal-formInst").show(); // clase que muestra el titulo y texto en la tarjeta datos de la institución y lo oculta en las demas.

    // Elementos que se encuentran ocultos
    $(".content_servProf-institution").hide();
    $(".content_acerca-institution").hide();
    $(".content_profesional-institution").hide();
    $(".content_certif-institution").hide();
    $(".content_sede-institution").hide();
    $(".content_galeria-institution").hide();

    // Función de evento on click para ocultar y mostrar los elementos de las tarjetas del formulario
    $(".dato_institution").click(function() {   //Clase para evento on click en el icono de la linea de opciones parte superior del formulario
        $(".content_dato-Institution").toggle("650","swing")   // Despliegue del contenido de la tarjeta " DATOS INSTITUCIONALES " 

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").removeClass('iconVerde_servProfesional')
        $(".acerca_institution").removeClass('iconVerde_acercaInst')
        $(".profesional_institution").removeClass('iconVerde_profesionalInst')
        $(".certificado_institution").removeClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')
     
        // Contenidos que se muestran y se ocultan con el evento on click
        $(".content_textPrincipal-formInst").show();
        $(".content_servProf-institution").hide();
        $(".content_acerca-institution").hide();
        $(".content_profesional-institution").hide();
        $(".content_certif-institution").hide();
        $(".content_sede-institution").hide();
        $(".content_galeria-institution").hide();
    });

    $(".serv_profesional").click(function() {   //Clase para evento on click en el icono de la linea de opciones parte superior del formulario
        $(".content_servProf-institution").toggle("650","swing")   // Despliegue del contenido de la tarjeta " SERVICIOS PROFESIONALES "

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").removeClass('iconVerde_acercaInst')
        $(".profesional_institution").removeClass('iconVerde_profesionalInst')
        $(".certificado_institution").removeClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')

        // Contenidos que se ocultan con el evento on click
        $(".content_textPrincipal-formInst").hide();
        $(".content_dato-Institution").hide();
        $(".content_acerca-institution").hide();
        $(".content_profesional-institution").hide();
        $(".content_certif-institution").hide();
        $(".content_sede-institution").hide();
        $(".content_galeria-institution").hide();
    });

    $(".acerca_institution").click(function() {   //Clase para evento on click en el icono de la linea de opciones parte superior del formulario
        $(".content_acerca-institution").toggle("650","swing")   // Despliegue del contenido de la tarjeta " ACERCA DE LA INSTITUCIÓN "

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").removeClass('iconVerde_profesionalInst')
        $(".certificado_institution").removeClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')

        // Contenidos que se ocultan con el evento on click
        $(".content_textPrincipal-formInst").hide();
        $(".content_dato-Institution").hide();
        $(".content_servProf-institution").hide();
        $(".content_profesional-institution").hide();
        $(".content_certif-institution").hide();
        $(".content_sede-institution").hide();
        $(".content_galeria-institution").hide();
    });

    $(".profesional_institution").click(function() {   //Clase para evento on click en el icono de la linea de opciones parte superior del formulario
        $(".content_profesional-institution").toggle("650","swing")   // Despliegue del contenido de la tarjeta " PROFESIONALES "

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").addClass('iconVerde_profesionalInst')
        $(".certificado_institution").removeClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')

        // Contenidos que se ocultan con el evento on click
        $(".content_textPrincipal-formInst").hide();
        $(".content_dato-Institution").hide();
        $(".content_servProf-institution").hide();
        $(".content_acerca-institution").hide();
        $(".content_certif-institution").hide();
        $(".content_sede-institution").hide();
        $(".content_galeria-institution").hide();
    });

    $(".certificado_institution").click(function() {   //Clase para evento on click en el icono de la linea de opciones parte superior del formulario
        $(".content_certif-institution").toggle("650","swing")   // Despliegue del contenido de la tarjeta " CERTIFICACIONES "

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").addClass('iconVerde_profesionalInst')
        $(".certificado_institution").addClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')

        // Contenidos que se ocultan con el evento on click
        $(".content_textPrincipal-formInst").hide();
        $(".content_dato-Institution").hide();
        $(".content_servProf-institution").hide();
        $(".content_acerca-institution").hide();
        $(".content_profesional-institution").hide();
        $(".content_sede-institution").hide();
        $(".content_galeria-institution").hide();
    });

    $(".sede_institution").click(function() {   //Clase para evento on click en el icono de la linea de opciones parte superior del formulario
        $(".content_sede-institution").toggle("650","swing")   // Despliegue del contenido de la tarjeta " SEDES "

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").addClass('iconVerde_profesionalInst')
        $(".certificado_institution").addClass('iconVerde_certifInst')
        $(".sede_institution").addClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')

        // Contenidos que se ocultan con el evento on click
        $(".content_textPrincipal-formInst").hide();
        $(".content_dato-Institution").hide();
        $(".content_servProf-institution").hide();
        $(".content_acerca-institution").hide();
        $(".content_profesional-institution").hide();
        $(".content_certif-institution").hide();
        $(".content_galeria-institution").hide();
    });

    $(".galeria_institution").click(function() {   //Clase para evento on click en el icono de la linea de opciones parte superior del formulario
        $(".content_galeria-institution").toggle("650","swing")   // Despliegue del contenido de la tarjeta " GALERIAS "

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").addClass('iconVerde_profesionalInst')
        $(".certificado_institution").addClass('iconVerde_certifInst')
        $(".sede_institution").addClass('iconVerde_sedeInst')
        $(".galeria_institution").addClass('iconVerde_galeInst')

        // Contenidos que se ocultan con el evento on click
        $(".content_textPrincipal-formInst").hide();
        $(".content_dato-Institution").hide();
        $(".content_servProf-institution").hide();
        $(".content_acerca-institution").hide();
        $(".content_profesional-institution").hide();
        $(".content_certif-institution").hide();
        $(".content_sede-institution").hide();
    });
});*/



// Evento onclick para desplegar el formulario de registro y el cambio de color del icono y el texto en la vista " register "
function hideForm (z){
    let myvar = z.getAttribute('data-position');
    
    let selector = document.querySelector.bind(document);
    // Condicional para el registro de usuario rol Paciente
    if (myvar == "dateInstitution") {
        selector(".date_institution").style.display = "block";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";
        // Metodo para realizar el cambio de color de los iconos y el texto en las opciones de la vista " register ", por medio de la función hideForm
        // Opción paciente
        document.getElementById ("inpt1"). src = '/img/iconos/icono-paciente-amarillo.svg';
        document.getElementById ("txt1").style.color = "#E6C804";
        //Opción doctor
        document.getElementById ("inpt2"). src = '/img/iconos/icono-doctor.svg';
        document.getElementById ("txt2").style.color = "#3E3E3E";
        // Opción institución
        document.getElementById ("inpt3"). src = '/img/iconos/icono-institucion.svg';
        document.getElementById ("txt3").style.color = "#3E3E3E";
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (myvar == "professionalServices") {
        selector(".professional_services").style.display = "block";
        selector(".date_institution").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";
        // Metodo para realizar el cambio de color de los iconos y el texto en las opciones de la vista " register ", por medio de la función hideForm
        //Opción doctor
        document.getElementById ("inpt2"). src = '/img/iconos/icono-doctor-azul.svg';
        document.getElementById ("txt2").style.color = "#0083d6";
        // Opción paciente
        document.getElementById ("inpt1"). src = '/img/iconos/icono-paciente.svg';
        document.getElementById ("txt1").style.color = "#3E3E3E";
        // Opción institución
        document.getElementById ("inpt3"). src = '/img/iconos/icono-institucion.svg';
        document.getElementById ("txt3").style.color = "#3E3E3E";
    }

    // Condicional para el registro de usuario rol Institución
    else if (myvar == "institucion") {
        selector(".names_institution").style.display = "block";
        selector(".datos_secundarios").style.display = "block";
        selector(".names_person").style.display = "none";
        // Metodo para realizar el cambio de color de los iconos y el texto en las opciones de la vista " register ", por medio de la función hideForm
        // Opción institución
        document.getElementById ("inpt3"). src = '/img/iconos/icono-institucion-verde.svg';
        document.getElementById ("txt3").style.color = "#019F86";
        // Opción paciente
        document.getElementById ("inpt1"). src = '/img/iconos/icono-paciente.svg';
        document.getElementById ("txt1").style.color = "#3E3E3E";
        //Opción doctor
        document.getElementById ("inpt2"). src = '/img/iconos/icono-doctor.svg';
        document.getElementById ("txt2").style.color = "#3E3E3E";
    }
}