// Funcion para ocultar y mostrar elementos en la vista CONTACTOS
function elementHidden (z){
    let myvar = z.getAttribute('data-position');
    
    let selector = document.querySelector.bind(document);
    // Condicional para el registro de usuario rol Paciente
    if (myvar == "paciente") {
        selector(".name_user-contac").style.display = "block";
        selector(".second_date-contac").style.display = "block";
        selector(".name_institution-contac").style.display = "none";
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (myvar == "doctor") {
        selector(".name_user-contac").style.display = "block";
        selector(".second_date-contac").style.display = "block";
        selector(".name_institution-contac").style.display = "none";
    }

    // Condicional para el registro de usuario rol Institución
    else if (myvar == "institucion") {
        selector(".name_institution-contac").style.display = "block";
        selector(".second_date-contac").style.display = "block";
        selector(".name_user-contac").style.display = "none";
    }
}