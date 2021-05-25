function hideForm (z){
    let myvar = z.getAttribute('data-position');
    
    let selector = document.querySelector.bind(document);
    if (myvar == "paciente") {
        selector(".names_person").style.display = "block";
        selector(".datos_secundarios").style.display = "block";
        selector(".names_institution").style.display = "none";
    }

    else if (myvar == "institucion") {
        selector(".names_institution").style.display = "block";
        selector(".datos_secundarios").style.display = "block";
        selector(".names_person").style.display = "none";
    }
}
function cambiarImagenJS(){
    document.getElementById("#idrol1").style.src="/img/iconos/icono-paciente-amarillo.svg";
}