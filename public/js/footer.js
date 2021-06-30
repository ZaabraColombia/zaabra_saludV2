// Función anonima para ocultar el NEWSLWTTER del FOOTER en las vistas Login, Register, Email
// acerca de Zaabra, políticas de uso, preguntas frecuentes, contactenos, errores
// membresiaProfesional, membresiaInstitucion, FormularioProfesional
!function() {
    let selector = document.querySelector.bind(document);
    let queryRuta = window.location.pathname;
 
    // Condicional de validación de rutas a las cuales les remueve el NEWSLETTER del FOOTER
    if (queryRuta.includes("register") || queryRuta.includes("login") || queryRuta.includes("reset") 
       || queryRuta.includes("acerca") || queryRuta.includes("politicas") || queryRuta.includes("preguntas")
       || queryRuta.includes("membresiaProfesional") || queryRuta.includes("membresiaInstitucion")
       || queryRuta.includes("/contacto")
       || queryRuta.includes("error101") || queryRuta.includes("error403")
       || queryRuta.includes("error404") || queryRuta.includes("error505")
       || queryRuta.includes("FormularioProfesional")  || queryRuta.includes("FormularioInstitucion")) {
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

// Función para cambiar de color y dejar un solo item desplegado en las opciones de las tarjetas de la vista "membresiaProfesional" y "membresiaInstitucion" 
$('.evento_acordion .containt_options-collapse-membresia').on( "click", function() {
	$(this).siblings().find(".boton_collapse-off-membresia").removeClass("boton_collapse-on-membresia");
	$(this).find(".boton_collapse-off-membresia").toggleClass("boton_collapse-on-membresia");
});


// Función para cambiar de color y dejar un solo item desplegado en las opciones de las tarjetas de la vista "membresiaProfesional" y "membresiaInstitucion" 
$('.evento_acordion .containt_options-collapse-institucion').on( "click", function() {
	$(this).siblings().find(".boton_collapse-off-institucion").removeClass("boton_collapse-on-institucion");
	$(this).find(".boton_collapse-off-institucion").toggleClass("boton_collapse-on-institucion");
});


$('#newsletter').on('submit',function(e){

    e.preventDefault();
    $('#send_form').html('enviando...');
    $.ajax({
      url: "/newsletter",
      type:"POST",
      data:{
        "_token": $("meta[name='csrf-token']").attr("content"),
        "correo_newsletter": $('#correo_newsletter').val(),
      },
      success:function(response){
        $('#send_form').hide();
        $('#res_message').show();
        $('#res_message').html(response.msg);
        $('#msg_div').removeClass('d-none');
        document.getElementById("newsletter").reset(); 
        setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },70000);
         },
     });
    });