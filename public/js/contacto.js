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
    }
}




$('#contactForm').on('submit',function(e){
    e.preventDefault();
    //$('#send_form').html('enviando...');
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
        "asunto": $('#asunto').val(),
      },
      success:function(response){
        $('#send_form').hide();
        $('#res_message').show();
        $('#res_message').html(response.msg);
        $('#msg_div').removeClass('d-none');
        document.getElementById("contactForm").reset(); 
        setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },3000);
         },
     });
    });