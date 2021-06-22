
$('#Estrellas').starrr();

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