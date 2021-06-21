// Función para ocultar y mostrar el contenido de cada una de las opciones del FORMULARIO PROFESIONAL
$(document).ready(function() {
    $(".personal_data").show();
    $(".professional_profile").hide();
    $(".treatments_procedures").hide();
    $(".Awards_honours").hide();
    $(".publications_formInst").hide();
    $(".gallery_formInst").hide();
});

// Evento onclick para desplegar las tarjetas del formulario de registro y el cambio de color del icono en la linea de opciones FORMULARIO PROFESIONALES
function containtHideOption (t){
    let myvar = t.getAttribute('data-position');
    
    let selector = document.querySelector.bind(document);
    
    // Condicional para el despliegue de elementos opción DATOS PERSONALES
    if (myvar == "personalData") {
        selector(".personal_data").style.display = "block";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".perfil-profesional").removeClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").removeClass('iconAzul_trataProced')
        $(".premio-reconocimiento").removeClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')
    }

    // Condicional para el despliegue de elementos opción PERFIL PROFESIONAL
    else if (myvar == "professionalProfile") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "block";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "none";
 
        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").removeClass('iconAzul_trataProced')
        $(".premio-reconocimiento").removeClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')

    }

    // Condicional para el despliegue de elementos opción TRATAMIENTOS Y PROCEDIMIENTOS
    else if (myvar == "treatmentsProcedures") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "block";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").removeClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')
    }

    // Condicional para el despliegue de elementos opción PREMIOS Y RECONOCIMIENTOS
    else if (myvar == "AwardsHonours") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "block";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')
    }

    // Condicional para el despliegue de elementos opción PUBLICACIONES
    else if (myvar == "publicationsFormProf") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "block";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
        $(".publicacion").addClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')
    }

    // Condicional para el despliegue de elementos opción GALERIA Y VIDEOS
    else if (myvar == "galleryFormProf") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "block";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
        $(".publicacion").addClass('iconAzul_public')
        $(".galeria-video").addClass('iconAzul_galeriaVideo')
    }
}

// Evento onclick para desplegar el formulario de registro y el cambio de color del icono y el texto en la vista " register "
function btnHideNext (u){
    let varBtnFormProf = u.getAttribute('code-position')
    
    let selector = document.querySelector.bind(document);
    
    // Condicional para el registro de usuario rol Paciente
    if (varBtnFormProf == "personalData") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "block";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".perfil-profesional").addClass('iconAzul_perfProf')
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (varBtnFormProf == "professionalProfile") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "block";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (varBtnFormProf == "treatmentsProcedures") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "block";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (varBtnFormProf == "AwardsHonours") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "block";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
        $(".publicacion").addClass('iconAzul_public')
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (varBtnFormProf == "publicationsFormInst") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "block";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".perfil-profesional").addClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").addClass('iconAzul_trataProced')
        $(".premio-reconocimiento").addClass('iconAzul_premioRecon')
        $(".publicacion").addClass('iconAzul_public')
        $(".galeria-video").addClass('iconAzul_galeriaVideo')
    }
}

// Evento onclick para desplegar el formulario de registro y el cambio de color del icono y el texto en la vista " register "
function btnHidePrevious (v){
    let varBtnPrevious = v.getAttribute('code-position')
    
    let selector = document.querySelector.bind(document);
    // Condicional para el registro de usuario rol Paciente
    if (varBtnPrevious == "galleryFormProf") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "block";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')
    }

    // Condicional para el registro de usuario rol Paciente
    if (varBtnPrevious == "publicationsFormProf") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "block";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')
    }

    // Condicional para el registro de usuario rol Paciente
    if (varBtnPrevious == "AwardsHonours") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "block";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".premio-reconocimiento").removeClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')
    }

    // Condicional para el registro de usuario rol Paciente
    if (varBtnPrevious == "treatmentsProcedures") {
        selector(".personal_data").style.display = "none";
        selector(".professional_profile").style.display = "block";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".tratamiento-procedimiento").removeClass('iconAzul_trataProced')
        $(".premio-reconocimiento").removeClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')
    }

    // Condicional para el registro de usuario rol Paciente
    if (varBtnPrevious == "professionalProfile") {
        selector(".personal_data").style.display = "block";
        selector(".professional_profile").style.display = "none";
        selector(".treatments_procedures").style.display = "none";
        selector(".Awards_honours").style.display = "none";
        selector(".publications_formInst").style.display = "none";
        selector(".gallery_formInst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".perfil-profesional").removeClass('iconAzul_perfProf')
        $(".tratamiento-procedimiento").removeClass('iconAzul_trataProced')
        $(".premio-reconocimiento").removeClass('iconAzul_premioRecon')
        $(".publicacion").removeClass('iconAzul_public')
        $(".galeria-video").removeClass('iconAzul_galeriaVideo')
    }

}
























// Función para ocultar y mostrar el contenido de cada una de las opciones del FORMULARIO INSTITUCIÓN
$(document).ready(function() {
    // Elementos que se muestran al cargar la vista
    $(".date_institution").show(); // Clase para mostrar la tarjeta de " DATOS DE LA INSTITUCIOÓN ".

    // Elementos que se encuentran ocultos
    $(".professional_services").hide();
    $(".about_institution").hide();
    $(".professional_inst").hide();
    $(".certifications_inst").hide();
    $(".venues_inst").hide();
    $(".gallery_inst").hide();
});

// Evento onclick para desplegar las tarjetas del formulario de registro y el cambio de color del icono en la linea de opciones FORMULARIO INSTITUCIONES
function hideContaintOption (w){
    let myvar = w.getAttribute('data-position');
    
    let selector = document.querySelector.bind(document);
    
    // Condicional para el despliegue de elementos opción DATOS INSTITUCIONALES
    if (myvar == "dateInstitution") {
        selector(".date_institution").style.display = "block";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").removeClass('iconVerde_servProfesional')
        $(".acerca_institution").removeClass('iconVerde_acercaInst')
        $(".profesional_institution").removeClass('iconVerde_profesionalInst')
        $(".certificado_institution").removeClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')
    }

    // Condicional para el despliegue de elementos opción SERVICIOS PROFESIONALES
    else if (myvar == "professionalServices") {
        selector(".professional_services").style.display = "block";
        selector(".date_institution").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";
 
        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").removeClass('iconVerde_acercaInst')
        $(".profesional_institution").removeClass('iconVerde_profesionalInst')
        $(".certificado_institution").removeClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')

    }

    // Condicional para el despliegue de elementos opción ACERCA DE LA INSTITUCIÓN
    else if (myvar == "aboutInstitution") {
        selector(".about_institution").style.display = "block";
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").removeClass('iconVerde_profesionalInst')
        $(".certificado_institution").removeClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')
    }

    // Condicional para el despliegue de elementos opción PROFESIONALES
    else if (myvar == "professionalInst") {
        selector(".professional_inst").style.display = "block";
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").addClass('iconVerde_profesionalInst')
        $(".certificado_institution").removeClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')
    }

    // Condicional para el despliegue de elementos opción CERTIFICACIONES
    else if (myvar == "certificationsInst") {
        selector(".certifications_inst").style.display = "block";
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").addClass('iconVerde_profesionalInst')
        $(".certificado_institution").addClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')
    }

    // Condicional para el despliegue de elementos opción SEDES
    else if (myvar == "venuesInst") {
        selector(".venues_inst").style.display = "block";
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").addClass('iconVerde_profesionalInst')
        $(".certificado_institution").addClass('iconVerde_certifInst')
        $(".sede_institution").addClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')
    }

    // Condicional para el despliegue de elementos opción GALERIA
    else if (myvar == "galleryInst") {
        selector(".gallery_inst").style.display = "block";
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").addClass('iconVerde_profesionalInst')
        $(".certificado_institution").addClass('iconVerde_certifInst')
        $(".sede_institution").addClass('iconVerde_sedeInst')
        $(".galeria_institution").addClass('iconVerde_galeInst')
    }   

}

// Evento onclick para desplegar el formulario de registro y el cambio de color del icono y el texto en la vista " register "
function hideBtnNext (x){
    let varBtn = x.getAttribute('code-position')
    
    let selector = document.querySelector.bind(document);
    
    // Condicional para el registro de usuario rol Paciente
    if (varBtn == "dateInstitution") {
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "block";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (varBtn == "professionalServices") {
        selector(".about_institution").style.display = "block";
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (varBtn == "aboutInstitution") {
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "block";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").addClass('iconVerde_profesionalInst')
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (varBtn == "professionalInst") {
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "block";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").addClass('iconVerde_profesionalInst')
        $(".certificado_institution").addClass('iconVerde_certifInst')
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (varBtn == "certificationsInst") {
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "block";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").addClass('iconVerde_profesionalInst')
        $(".certificado_institution").addClass('iconVerde_certifInst')
        $(".sede_institution").addClass('iconVerde_sedeInst')
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (varBtn == "venuesInst") {
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "block";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").addClass('iconVerde_servProfesional')
        $(".acerca_institution").addClass('iconVerde_acercaInst')
        $(".profesional_institution").addClass('iconVerde_profesionalInst')
        $(".certificado_institution").addClass('iconVerde_certifInst')
        $(".sede_institution").addClass('iconVerde_sedeInst')
        $(".galeria_institution").addClass('iconVerde_galeInst')
    }
}

// Evento onclick para desplegar el formulario de registro y el cambio de color del icono y el texto en la vista " register "
function hideBtnPrevious (y){
    let varBtnPrevious = y.getAttribute('code-position')
    
    let selector = document.querySelector.bind(document);
    // Condicional para el registro de usuario rol Paciente
    if (varBtnPrevious == "galleryInst") {
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "block";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".galeria_institution").removeClass('iconVerde_galeInst')
    }

    // Condicional para el registro de usuario rol Paciente
    if (varBtnPrevious == "venuesInst") {
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "block";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')
    }

    // Condicional para el registro de usuario rol Paciente
    if (varBtnPrevious == "certificationsInst") {
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "block";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".certificado_institution").removeClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')
    }

    // Condicional para el registro de usuario rol Paciente
    if (varBtnPrevious == "professionalInst") {
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "block";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".profesional_institution").removeClass('iconVerde_profesionalInst')
        $(".certificado_institution").removeClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')
    }

    // Condicional para el registro de usuario rol Paciente
    if (varBtnPrevious == "aboutInstitution") {
        selector(".date_institution").style.display = "none";
        selector(".professional_services").style.display = "block";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".acerca_institution").removeClass('iconVerde_acercaInst')
        $(".profesional_institution").removeClass('iconVerde_profesionalInst')
        $(".certificado_institution").removeClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')
    }

    // Condicional para el registro de usuario rol Paciente
    if (varBtnPrevious == "professionalServices") {
        selector(".date_institution").style.display = "block";
        selector(".professional_services").style.display = "none";
        selector(".about_institution").style.display = "none";
        selector(".professional_inst").style.display = "none";
        selector(".certifications_inst").style.display = "none";
        selector(".venues_inst").style.display = "none";
        selector(".gallery_inst").style.display = "none";

        // Iconos verdes que se remueven de la linea de opciones con el evento on  click 
        $(".serv_profesional").removeClass('iconVerde_servProfesional')
        $(".acerca_institution").removeClass('iconVerde_acercaInst')
        $(".profesional_institution").removeClass('iconVerde_profesionalInst')
        $(".certificado_institution").removeClass('iconVerde_certifInst')
        $(".sede_institution").removeClass('iconVerde_sedeInst')
        $(".galeria_institution").removeClass('iconVerde_galeInst')
    }
}