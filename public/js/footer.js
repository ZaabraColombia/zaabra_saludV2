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
        || queryRuta.includes("/contacto") || queryRuta.includes("PerfilInstitucion")
        || queryRuta.includes("error101") || queryRuta.includes("error403")
        || queryRuta.includes("error404") || queryRuta.includes("error505")
        || queryRuta.includes("FormularioProfesional") || queryRuta.includes("FormularioInstitucion")
        || queryRuta.includes("citas") || queryRuta.includes("pagos") || queryRuta.includes("calendario")
        || queryRuta.includes("favoritos") || queryRuta.includes("panelPrincipal")
        || queryRuta.includes("ordenesMedicas") || queryRuta.includes("prescripciones")
        || queryRuta.includes("calendarioProfesional") || queryRuta.includes("historiaClinicaProfesional")
        || queryRuta.includes("vademecumProfesional") || queryRuta.includes("procedimientosProfesional")
        || queryRuta.includes("diagnosticosProfesional") || queryRuta.includes("crearFormulaProfesional")
        || queryRuta.includes("registroPaciente") || queryRuta.includes("pacienteRegistrado")
        || queryRuta.includes("editarConsulta") || queryRuta.includes("editarPatologia")
        || queryRuta.includes("panel") || queryRuta.includes("calendario")
        || queryRuta.includes("configurar-calendario") || queryRuta.includes("citas")
        || queryRuta.includes("pagos") || queryRuta.includes("pacientes")
        || queryRuta.includes("cie10") || queryRuta.includes("cups")
        || queryRuta.includes("cums") || queryRuta.includes("favoritos")
        || queryRuta.includes("contactos")
    )
    {
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


// Evento cambio de color boton desplegable acordion items del footer, tarjeta membresia profesional
$('.accordion').on('show.bs.collapse', '.card', function () {
    var card = $(this);

    card.find('button').removeClass("button_acordion").addClass("button_show_acordion");
}).on('hide.bs.collapse', '.card', function () {
    var card = $(this);

    card.find('button').removeClass("button_show_acordion").addClass("button_acordion");
});

// Evento cambio de color boton desplegable acordion tarjeta membresia institución y landing page institución
$('.accordion_green').on('show.bs.collapse', '.card', function () {
    var card = $(this);

    card.find('button').removeClass("button_acordion").addClass("button_show_acordion_green");
}).on('hide.bs.collapse', '.card', function () {
    var card = $(this);

    card.find('button').removeClass("button_show_acordion_green").addClass("button_acordion");
});


$('#newsletter').on('submit',function(e){

    e.preventDefault();
    $('#send_form').prop('disabled', true);
    $.ajax({
        url: "/newsletter",
        type:"POST",
        typeData: "json",
        data:{
            "_token": $("meta[name='csrf-token']").attr("content"),
            "correo_newsletter": $('#correo_newsletter').val(),
        },
        success:function(response){
            $('#send_form').hide();
            $('#msg_div').html('<div class="alert_Newsletter" >\n' +
                response.mensaje +
                '</div>');
            document.getElementById("newsletter").reset();
            setTimeout(function(){
                $('#msg_div').html('');
            },4000);
        },
        error: function (response) {
            $('#send_form').prop('disabled', false);

            var res = response.responseJSON;

            var mensaje = $('<div class="alert alert-danger" >' +
                res.mensaje +
                '</div>');

            if (res.error)
            {
                $.each(res.error, function (index, item){
                    mensaje.append('<p>' + item[0] + '</p>');
                });
            }

            $('#msg_div').html(mensaje);

            document.getElementById("newsletter").reset();
            setTimeout(function(){
                $('#msg_div').html('');
            },4000);
        }
    });
});

$('#newsletter2').on('submit',function(e){

    e.preventDefault();
    $('#send_form2').html('enviando...');
    $.ajax({
        url: "/newsletter",
        type:"POST",
        data:{
            "_token": $("meta[name='csrf-token']").attr("content"),
            "correo_newsletter": $('#correo_newsletter2').val(),
        },
        success:function(response){
            $('#send_form').hide();
            $('#msg_div').html('<div class="alert_Newsletter" >\n' +
                response.mensaje +
                '</div>');
            document.getElementById("newsletter2").reset();
            setTimeout(function(){
                $('#msg_div').html('');
            },4000);
        },
        error: function (response) {
            $('#send_form').prop('disabled', false);

            var res = response.responseJSON;

            var mensaje = $('<div class="alert alert-danger" >' +
                res.mensaje +
                '</div>');

            if (res.error)
            {
                $.each(res.error, function (index, item){
                    mensaje.append('<p>' + item[0] + '</p>');
                });
            }

            $('#msg_div').html(mensaje);

            document.getElementById("newsletter").reset();
            setTimeout(function(){
                $('#msg_div').html('');
            },4000);
        }
    });
});

// From http://stackoverflow.com/a/5365036/2065702
var randomColor = "#"+((1<<24)*Math.random()|0).toString(16);

document.documentElement.style.setProperty('main-bg-color', randomColor);
