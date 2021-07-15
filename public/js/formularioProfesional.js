/*-------------------------- Inicio Primera Parte del Formulario Descripcion Perfil Profesional------------------------------*/
$('#formulario_basico').validate({
    rules: {
        logo: {
            required: true,
        },
        fechanacimiento:{
            required: true,
        },
        idarea:{
            required: true,
        },
        idprofesion:{
            required: true,
        },
        idespecialidad:{
            required: true,
        },
        id_universidad:{
            required: true,
        },
        numeroTarjeta:{
            required: true,
        },
    },
    messages: {
        logo: {
            required: "Por favor debe subir una foto",
        },
        fechanacimiento:{
            required: "Por favor seleccione su fecha de nacimiento",
        },
        idarea:{
            required: "Por favor seleccione su area",
        },
        idprofesion:{
            required: "Por favor seleccione su profesión",
        },
        idespecialidad:{
            required: "Por favor seleccione su especialidad",
        },
        id_universidad:{
            required: "Por favor seleccione su universidad Principal",
        },
        numeroTarjeta:{
            required: "Por favor seleccione su numero de tarjeta profesional",
        },
    },
    submitHandler: function(form) {
        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         var formData = new FormData(form);
         /*Se cambia el texto al boton por enviando*/
         $('#envia_basico').html('Enviando..');
         $.ajax({
           url:  "/FormularioProfesionalSave",
           type: "POST",
           data: formData,
           mimeType: "multipart/form-data",
           contentType: false,
           cache: false,
           processData: false,
           success: function( response ) {
               $('#envia_basico').html('Enviar');
               $('#res_message_basico').show();
               $('#res_message_basico').html(response.msg);
               $('#msg_basico').removeClass('d-none');
   
               document.getElementById("#formulario_basico").reset(); 
               setTimeout(function(){
               $('#res_message_basico').hide();
               $('#msg_basico').hide();
               },10000);
           }
         });
       }
})
/*--------------------------- Fin Primera Parte del Formulario Descripcion Perfil Profesional-------------------------------*/

/*-------------------------- Inicio Segunda Parte del Formulario Descripcion Perfil Profesional------------------------------*/
$('#formulario_contacto').validate({
    rules: {
        celular: {
            required: true,
        },
        direccion: {
            required: true,
        },
        idpais: {
            required: true,
            minlength: 1,
        },
        id_departamento: {
            required: true,
            minlength: 1,
        },
        id_provincia: {
            required: true,
            minlength: 1,
        },
        id_municipio: {
            required: true,
            minlength: 1,
        },
    },
    messages: {
        celular: {
            required: "Por favor debe ingresar un numero celular",
            maxlength: 12,
        },
        direccion: {
            required: "Por favor debe ingresar una dirección",
            maxlength: 12,
        },
        idpais: {
            required: "Debe seleccionar una pais",
        },
        id_departamento: {
            required: "Debe seleccionar una departamento",
        },
        id_provincia: {
            required: "Debe seleccionar una provincia",
        },
        id_municipio: {
            required: "Debe seleccionar una ciudad",
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
         $('#envia_contacto').html('Enviando..');
         $.ajax({
           url:  "FormularioProfesionalSave2",
           type: "POST",
           data: $('#formulario_contacto').serialize(),
           success: function( response ) {
               $('#envia_contacto').html('Enviar');
               $('#res_message_contacto').show();
               $('#res_message_contacto').html(response.msg);
               $('#msg_contacto').removeClass('d-none');
   
               document.getElementById("#formulario_contacto").reset(); 
               setTimeout(function(){
               $('#res_message_contacto').hide();
               $('#msg_contacto').hide();
               },10000);
           }
         });
       }
})
/*--------------------------- Fin Segunda Parte del Formulario Descripcion Perfil Profesional-------------------------------*/



/*-------------------------- Inicio Tercera Parte del Formulario Descripcion Perfil Profesional------------------------------*/
$('#formulario_contacto').validate({
    rules: {
        celular: {
            required: true,
        },

    },
    messages: {
        celular: {
            required: "Por favor debe ingresar un numero celular",
            maxlength: 12,
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
         $('#envia_contacto').html('Enviando..');
         $.ajax({
           url:  "FormularioProfesionalSave2",
           type: "POST",
           data: $('#formulario_contacto').serialize(),
           success: function( response ) {
               $('#envia_contacto').html('Enviar');
               $('#res_message_contacto').show();
               $('#res_message_contacto').html(response.msg);
               $('#msg_contacto').removeClass('d-none');
   
               document.getElementById("#formulario_contacto").reset(); 
               setTimeout(function(){
               $('#res_message_contacto').hide();
               $('#msg_contacto').hide();
               },10000);
           }
         });
       }
})
/*--------------------------- Fin Tercera Parte del Formulario Descripcion Perfil Profesional-------------------------------*/


/*-------------------- Inicio Cuarta Parte del Formulario Descripcion Perfil Profesional----------------------------------*/
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
               $('#res_message_descripcion').show();
               $('#res_message_descripcion').html(response.msg);
               $('#msg_descripcion').removeClass('d-none');
   
               document.getElementById("#formulario_descripcion").reset(); 
               setTimeout(function(){
               $('#res_message_descripcion').hide();
               $('#msg_descripcion').hide();
               },10000);
           }
         });
       }
})
/*------------------------------ Fin Cuarta Parte del Formulario Descripcion Perfil Profesional------------------------------*/