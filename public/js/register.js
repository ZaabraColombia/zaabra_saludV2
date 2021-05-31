// Funcion para ocultar y mostrar elementos en la vista de Register
function hideForm (z){
    let myvar = z.getAttribute('data-position');
    
    let selector = document.querySelector.bind(document);
    // Condicional para el registro de usuario rol Paciente
    if (myvar == "paciente") {
        selector(".names_person").style.display = "block";
        selector(".datos_secundarios").style.display = "block";
        selector(".names_institution").style.display = "none";
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (myvar == "doctor") {
        selector(".names_person").style.display = "block";
        selector(".datos_secundarios").style.display = "block";
        selector(".names_institution").style.display = "none";
    }

    // Condicional para el registro de usuario rol Institución
    else if (myvar == "institucion") {
        selector(".names_institution").style.display = "block";
        selector(".datos_secundarios").style.display = "block";
        selector(".names_person").style.display = "none";
    }
}

// Funcion para ocultar y mostrar elementos en la vista CONTACTOS
function hideForm (z){
    let myvar = z.getAttribute('data-position');
    
    let selector = document.querySelector.bind(document);
    // Condicional para el registro de usuario rol Paciente
    if (myvar == "paciente") {
        selector(".names_person-contac").style.display = "block";
        selector(".datos_secundarios-contac").style.display = "block";
        selector(".names_institution-contac").style.display = "none";
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (myvar == "doctor") {
        selector(".names_person-contac").style.display = "block";
        selector(".datos_secundarios-contac").style.display = "block";
        selector(".names_institution-contac").style.display = "none";
    }

    // Condicional para el registro de usuario rol Institución
    else if (myvar == "institucion") {
        selector(".names_institution-contac").style.display = "block";
        selector(".datos_secundarios-contac").style.display = "block";
        selector(".names_person-contac").style.display = "none";
    }
}