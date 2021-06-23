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




$('#contactForm').on('submit',function(e){
    e.preventDefault();
    $('#send_form').html('enviando...');
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