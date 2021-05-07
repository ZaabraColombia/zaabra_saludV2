///funcion para la direccion de la flecha de cada una de las opciones de las tarjetas de membresia premiunHome y premiunView jfk
function direccionFlecha (element){
    let cambioDireccion = element.getAttribute("data-rote");

    if (cambioDireccion == 0) {
        $(element).removeClass('fas fa-chevron-up'); //validacion flecha con direccion hacia la derecha jfk
        $(element).addClass('fas fa-chevron-down');
        $(element).attr('data-rote',1)
    }
    else{
        $(element).removeClass('fas fa-chevron-down');  //validacion flecha con direccion hacia abajo
        $(element).addClass('fas fa-chevron-up');
        $(element).attr('data-rote',0)
    }
}