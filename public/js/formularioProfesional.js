/*-------------------------- Inicio Primera Parte del Formulario Descripcion Perfil Profesional------------------------------*/
$('#formulario_basico').validate({
    rules: {
        logo: {
            required: false,
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
               
            console.log(response);
               $('#envia_basico').hide();
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
});
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
               $('#envia_contacto').hide();
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
$.validator.addMethod("selecttext", function(value, element) {
    if (select == "") {
        return false;
    } else {
        return true;
    };
  }, "Por favor seleccione el tipo de consulta");

$('#formulario_consulta').validate({
    rules: {
        'nombreconsulta[]': {
            required: true,
            selecttext: false,
        },
        'valorconsulta[]': {
            required: true,
        },
    },
    messages: {
        'nombreconsulta[]':{
            required: "Por favor seleccione el tipo de consulta",
        },
        'valorconsulta[]':{
            required: "Por favor ingrese el valor de la consulta",
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
         $('#envia_consultas').html('Enviando..');
         $.ajax({
           url:  "FormularioProfesionalSave3",
           type: "POST",
           data: $('#formulario_consulta').serialize(),
           success: function( response ) {
               $('#envia_consultas').hide();
               $('#res_message_consulta').show();
               $('#res_message_consulta').html(response.msg);
               $('#msg_consulta').removeClass('d-none');
   
               document.getElementById("#formulario_consulta").reset(); 
               setTimeout(function(){
               $('#res_message_consulta').hide();
               $('#msg_consulta').hide();
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
               $('#envia_perfil').hide();
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

/*-------------------- Inicio Quinta Parte del Formulario Educacion Perfil Profesional----------------------------------*/

$('#formulario_educacion').validate({
    rules: {
        'id_universidad[]': {
            required: true,
            selecttext: false,
        },
        'fechaestudio[]': {
            required: true,
            date: true,
        },
        'nombreestudio[]': {
            required: true,
        },
    },
    messages: {
        'id_universidad[]':{
            required: "Por favor seleccione una universidad",
        },
        'fechaestudio[]':{
            required: "Por favor Seleccione la fecha en que  finalizó su estudio",
        },
        'nombreestudio[]':{
            required: "Por favor Ingrese el titulo obtenido ",
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
         $('#envia_estudios').html('Enviando..');
         $.ajax({
           url:  "FormularioProfesionalSave5",
           type: "POST",
           data: $('#formulario_educacion').serialize(),
           success: function( response ) {
               $('#envia_estudios').hide();
               $('#res_message_consulta').show();
               $('#res_message_consulta').html(response.msg);
               $('#msg_consulta').removeClass('d-none');
   
               document.getElementById("#formulario_educacion").reset(); 
               setTimeout(function(){
               $('#res_message_consulta').hide();
               $('#msg_consulta').hide();
               },10000);
           }
         });
    }
})
/*------------------------------ Fin Quinta Parte del Formulario Educacion Perfil Profesional------------------------------*/