// Funcion para ocultar y mostrar elementos en la vista CONTACTOS
function elementHidden (z){
    let myvar = z.getAttribute('data-position');

    let selector = document.querySelector.bind(document);
    // Condicional para el registro de usuario rol Paciente
    if (myvar == "paciente") {
        selector(".name_user-contac").style.display = "block";
        selector(".second_date-contac").style.display = "block";
        selector(".name_institution-contac").style.display = "none";
        // Metodo para realizar el cambio de color de los iconos y el texto en las opciones de la vista " register ", por medio de la función hideForm
        // Opción institución
        document.getElementById ("inpt4"). src = '/img/iconos/icono-paciente-amarillo.svg';
        document.getElementById ("txt4").style.color = "#E6C804";
        //Opción doctor
        document.getElementById ("inpt5"). src = '/img/iconos/icono-doctor.svg';
        document.getElementById ("txt5").style.color = "#3E3E3E";
        // Opción institución
        document.getElementById ("inpt6"). src = '/img/iconos/icono-institucion.svg';
        document.getElementById ("txt6").style.color = "#3E3E3E";

        document.getElementById("valor_tipo1").value = document.getElementById("inpt4").value;
        document.getElementById('tipo_contacto').value = 'Paciente';
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (myvar == "doctor") {
        selector(".name_user-contac").style.display = "block";
        selector(".second_date-contac").style.display = "block";
        selector(".name_institution-contac").style.display = "none";
        // Metodo para realizar el cambio de color de los iconos y el texto en las opciones de la vista " register ", por medio de la función hideForm
        //Opción doctor
        document.getElementById ("inpt5"). src = '/img/iconos/icono-doctor-azul.svg';
        document.getElementById ("txt5").style.color = "#0083d6";
        // Opción paciente
        document.getElementById ("inpt4"). src = '/img/iconos/icono-paciente.svg';
        document.getElementById ("txt4").style.color = "#3E3E3E";
        // Opción institución
        document.getElementById ("inpt6"). src = '/img/iconos/icono-institucion.svg';
        document.getElementById ("txt6").style.color = "#3E3E3E";

        document.getElementById("valor_tipo1").value = document.getElementById("inpt5").value;
        document.getElementById('tipo_contacto').value = 'Profesional';
    }

    // Condicional para el registro de usuario rol Institución
    else if (myvar == "institucion") {
        selector(".name_institution-contac").style.display = "block";
        selector(".second_date-contac").style.display = "block";
        selector(".name_user-contac").style.display = "none";
        // Metodo para realizar el cambio de color de los iconos y el texto en las opciones de la vista " register ", por medio de la función hideForm
        // Opción institución
        document.getElementById ("inpt6"). src = '/img/iconos/icono-institucion-verde.svg';
        document.getElementById ("txt6").style.color = "#019F86";
        // Opción paciente
        document.getElementById ("inpt4"). src = '/img/iconos/icono-paciente.svg';
        document.getElementById ("txt4").style.color = "#3E3E3E";
        //Opción doctor
        document.getElementById ("inpt5"). src = '/img/iconos/icono-doctor.svg';
        document.getElementById ("txt5").style.color = "#3E3E3E";

        document.getElementById("valor_tipo1").value = document.getElementById("inpt6").value;
        document.getElementById('tipo_contacto').value = 'Institución';
    }
}




$('#contactForm').on('submit',function(e){
    e.preventDefault();
    //$('#send_form').html('enviando...');
    $('#send_form').prop('disabled', true)
        .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;' + 'enviando');
    $.ajax({
        url: "contacto",
        type:"POST",
        data:{
            "_token": $("meta[name='csrf-token']").attr("content"),
            "primernombre": $('#primernombre').val(),
            "segundonombre": $('#segundonombre').val(),
            "primerapellido": $('#primerapellido').val(),
            "segundoapellido": $('#segundoapellido').val(),
            "nombreinstitucion": $('#nombreinstitucion').val(),
            "email": $('#email').val(),
            "tipo_contacto": $('#tipo_contacto').val(),
            "asunto": $('#asunto').val(),
        },
        success:function(response){

            $('#send_form').prop('disabled', false).html('Enviar <i class="fas fa-arrow-right"></i>');
            $('#res_message').html(response.msg).show();
            $('#msg_div').addClass('alert-success').show();
            document.getElementById("contactForm").reset();
            setTimeout(function(){
                $('#res_message').hide();
                $('#msg_div').removeClass('alert-success').hide();
            },3000);
        },
        error: function (error) {
            $('#send_form').prop('disabled', false).html('Enviar <i class="fas fa-arrow-right"></i>');
            $('#res_message').html('error');
            $('#msg_div').show().addClass('alert-danger');
            //document.getElementById("contactForm").reset();
            setTimeout(function(){
                $('#res_message').hide();
                $('#msg_div').removeClass('alert-danger').hide();
            },3000);
        }
    });
});
