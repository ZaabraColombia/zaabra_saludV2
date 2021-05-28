// Función anonima para ocultar el NEWSLWTTER del FOOTER en las vistas Login, Register y Email
!function() {
    let selector = document.querySelector.bind(document);
    let queryRuta = window.location.pathname;
 
    // Condicional de validación de rutas a las cuales les remueve el NEWSLETTER del FOOTER
    if (queryRuta.includes("register") || queryRuta.includes("login") || queryRuta.includes("reset") 
       || queryRuta.includes("acerca") || queryRuta.includes("politicas") || queryRuta.includes("preguntas") ) {
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

function colorBtnToggle (element) {
    let cambioColorBtn = element.getAttribute("aria-expanded");

    if (cambioColorBtn == 'false') {
        $(element).removeClass('boton_collapse-off-acerca'); // Remueve flecha con dirección hacia abajo
        $(element).addClass('boton_collapse-on-acerca'); // Adiciona flecha con dirección hacia arriba
        $(element).attr('aria-expande', 'false') // Cambio de estado de 0 a 1
    }
    
    // Condicional para oopciones en estado activo o desplegadas
    else{
        $(element).removeClass('boton_collapse-on-acerca'); // Remueve flecha con dirección hacia arriba
        $(element).addClass('boton_collapse-off-acerca'); // Adiciona flecha con dirección hacia abajo
        $(element).attr('aria-expande', 'true') // Cambio de estado de 1 a 0
    }
}