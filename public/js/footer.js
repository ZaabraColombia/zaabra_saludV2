// Función anonima para ocultar el NEWSLWTTER del FOOTER en las vistas Login, Register y Email
!function() {
    let selector = document.querySelector.bind(document);
    let queryRuta = window.location.pathname;
 
    // Condicional de validación de rutas a las cuales les remueve el NEWSLETTER del FOOTER
    if (queryRuta.includes("register") || queryRuta.includes("login") || queryRuta.includes("reset") 
       || queryRuta.includes("acerca") || queryRuta.includes("politicas") || queryRuta.includes("preguntas")
       || queryRuta.includes("membresiaProfesional") || queryRuta.includes("/contacto") ) {
       selector(".footer_newsletter").style.display = "none";
    }
}();

// Función para el cambio de dirección del icono flecha de las opciones del FOOTER
function direccionFlecha (element){
    let cambioDireccion = element.getAttribute("data-rote");

    // Condicional para opciones en estado inactivo o sin desplegar
    if (cambioDireccion == 0) {
        $(element).removeClass('fas fa-chevron-down'); // Remueve flecha con dirección hacia abajo
        $(element).addClass('fas fa-chevron-up'); // Adiciona flecha con dirección hacia arriba
        $(element).attr('data-rote',1) // Cambio de estado de 0 a 1
    }

    // Condicional para oopciones en estado activo o desplegadas
    else{
        $(element).removeClass('fas fa-chevron-up'); // Remueve flecha con dirección hacia arriba
        $(element).addClass('fas fa-chevron-down'); // Adiciona flecha con dirección hacia abajo
        $(element).attr('data-rote',0) // Cambio de estado de 1 a 0
    }
}

// Función para el cambio de background y del icono (+ y -) de las opciones de Acerca de zzaabra, politicas de uso y preguntas frecuentes del FOOTER 
// Acerca de Zaabra
function colorBtnToggle (element) {
    let cambioColorBtn = element.getAttribute("aria-expanded");

    if (cambioColorBtn == 'false') {
        $(element).removeClass('boton_collapse-off-acerca');
        $(element).addClass('boton_collapse-on-acerca');
        $(element).attr('aria-expanded', 'false')
    }
    
    // Condicional para oopciones en estado activo o desplegadas
    else{
        $(element).removeClass('boton_collapse-on-acerca');
        $(element).addClass('boton_collapse-off-acerca');
        $(element).attr('aria-expanded', 'true')
    }
}

// Políticas de uso
function colorBtnToggle (element) {
    let cambioColorBtn = element.getAttribute("aria-expanded");

    if (cambioColorBtn == 'false') {
        $(element).removeClass('boton_collapse-off-polit');
        $(element).addClass('boton_collapse-on-polit');
        $(element).attr('aria-expanded', 'false')
    }
    
    // Condicional para oopciones en estado activo o desplegadas
    else{
        $(element).removeClass('boton_collapse-on-polit');
        $(element).addClass('boton_collapse-off-polit');
        $(element).attr('aria-expanded', 'true')
    }
}

// Políticas de uso
function colorBtnToggle (element) {
    let cambioColorBtn = element.getAttribute("aria-expanded");

    if (cambioColorBtn == 'false') {
        $(element).removeClass('boton_collapse-off-pregunta');
        $(element).addClass('boton_collapse-on-pregunta');
        $(element).attr('aria-expanded', 'false')
    }
    
    // Condicional para oopciones en estado activo o desplegadas
    else{
        $(element).removeClass('boton_collapse-on-pregunta');
        $(element).addClass('boton_collapse-off-pregunta');
        $(element).attr('aria-expanded', 'true')
    }
}

// Tarjetas premium de la vista --- membresiaProfesional ---
function colorBtnToggle (element) {
    let cambioColorBtn = element.getAttribute("aria-expanded");

    if (cambioColorBtn == 'false') {
        $(element).removeClass('boton_collapse-off-membresia');
        $(element).addClass('boton_collapse-on-membresia');
        $(element).attr('aria-expanded', 'false')
    }
    
    // Condicional para oopciones en estado activo o desplegadas
    else{
        $(element).removeClass('boton_collapse-on-membresia');
        $(element).addClass('boton_collapse-off-membresia');
        $(element).attr('aria-expanded', 'true')
    }
}