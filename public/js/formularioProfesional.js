/* Inicio Cuarta Parte del Formulario Descripcion Perfil Profesional*/
$('#formulario_descripcion').validate({
    rules: {
        descripcionPerfil: {
            required: true,
        },
    },
    messages: {
        descripcionPerfil: {
            required: "Esta descripción es muy importante para su perfil profesional. Por favor ingrese los datos",
            maxlength: 270,
        },
    },
    submitHandler: function(form) {
        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         /*Se cambia el texto al boton por enviando*/
         $('#envia_perfil').html('Enviando..');
         $.ajax({
           url:  "FormularioProfesionalSave4",
           type: "POST",
           data: $('#formulario_descripcion').serialize(),
           success: function( response ) {
               $('#envia_perfil').html('Enviar');
               $('#res_message').show();
               $('#res_message').html(response.msg);
               $('#msg_div').removeClass('d-none');
   
               document.getElementById("#formulario_descripcion").reset(); 
               setTimeout(function(){
               $('#res_message').hide();
               $('#msg_div').hide();
               },10000);
           }
         });
       }
})
/* Fin Cuarta Parte del Formulario Descripcion Perfil Profesional*/