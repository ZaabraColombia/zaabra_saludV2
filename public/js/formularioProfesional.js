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
        //$('#envia_basico').html('Enviando..');
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
                //$('#envia_basico').hide();
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

$('#formulario_destacado').validate({
    rules: {
        destacado_nombre: {
            required: true
        }
    },
    messages: {
        destacado_nombre: {
            required: "Por favor debe llenar el campo",
        }
    },
    submitHandler: function ()
    {
        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:  "FormularioProfesionalAddDestacable",
            type: "POST",
            dataType: 'json',
            data: $('#formulario_destacado').serialize(),
            success: function( response ) {
                var mensaje;
                if (response.status)
                {
                    mensaje = $('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                        '<strong>' + response.mensaje + '</strong>\n' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                        '<span aria-hidden="true">&times;</span>\n' +
                        '</button>\n' +
                        '</div>');
                    $('#destacado-lista').append('<div class="alert alert-info alert-dismissible fade show" role="alert">\n' +
                        '<strong>' + response.nombre + '</strong>\n' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                        '<span aria-hidden="true">&times;</span>\n' +
                        '</button>\n' +
                        '</div>');

                    console.log(response.count);
                    if (response.count >= 9){
                        $('#destacado_nombre').attr('disabled', 'disabled');
                        $('#destacado_nombre_btn').attr('disabled', 'disabled');
                    }
                }else {
                    mensaje = $('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                        '<strong>' + response.mensaje + '</strong>\n' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                        '<span aria-hidden="true">&times;</span>\n' +
                        '</button>\n' +
                        '</div>');

                }

                $('#destacado-mensaje').append(mensaje);

            }
        });
    }
});

$('#destacado-lista').on('click', '.close' , function (e) {
    var id = $(this).data('id');

    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "FormularioProfesionalDeleteDestacable",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            console.log(response);
            var message;
            if (response.status)
            {
                message = $('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                    '<strong>' + response.mensaje + '</strong>\n' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');

                $('#destacado_nombre').removeAttr('disabled');
                $('#destacado_nombre_btn').removeAttr('disabled');
            }else {
                message = $('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                    '<strong>' + response.mensaje + '</strong>\n' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');
            }
            $('#destacado-mensaje').append(message);
        }
    });

});

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
});

$('#formulario_consulta').validate({
    rules: {
        'tipo_consulta': {
            required: true,
            selecttext: false,
        },
        'valor_consulta': {
            required: true,
        },
    },
    messages: {
        'tipo_consulta':{
            required: "Por favor seleccione el tipo de consulta",
        },
        'valor_consulta':{
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

        $.ajax({
            url:  "FormularioProfesionalSave3",
            type: "POST",
            data: $('#formulario_consulta').serialize(),
            success: function( response ) {
                $('#mensaje-consulta').append('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');

                if (response.items_max)
                {
                    $('#tipo_consulta').attr('disabled', 'disabled');
                    $('#valor_consulta').attr('disabled', 'disabled');
                    $('#envia_consultas').attr('disabled', 'disabled');
                }

                $('#consultas-lista').append('<div class="section_infoConsulta-formProf">\n' +
                    '<div class="col-12 content_btnX-cierre-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="' + response.id + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> Tipo de consulta </label>\n' +
                    '<span class="col-12 text_infoGuardada-formProf">' + $('#tipo_consulta').val() + '</span>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> Valor consulta </label>\n' +
                    '<span class="col-12 text_infoGuardada-formProf">' + $('#valor_consulta').val() + '</span>\n' +
                    '</div>\n' +
                    '</div>');

                document.getElementById("formulario_consulta").reset();
            },
            error: function (event) {
                var response = event.responseJSON;
                $('#mensaje-consulta').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');
                if (event.status === 422) {
                    $.each(response.error, function (index, element) {
                        $('#' + index).addClass('is-invalid');
                    });
                }
                if (response.items_max)
                {
                    $('#tipo_consulta').attr('disabled', 'disabled');
                    $('#valor_consulta').attr('disabled', 'disabled');
                    $('#envia_consultas').attr('disabled', 'disabled');
                }
            }
        });
    }
});

$('#consultas-lista').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "FormularioProfesionaldelete3",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            $('#mensaje-consulta').html('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');

            //quitar el disabled
            $('#tipo_consulta').removeAttr('disabled');
            $('#valor_consulta').removeAttr('disabled');
            $('#envia_consultas').removeAttr('disabled');

            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            var response = event.responseJSON;
            $('#mensaje-consulta').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');
        }
    });

});
/*--------------------------- Fin Primera Parte del Formulario Descripcion Perfil Profesional-------------------------------*/

/*-------------------------- Inicio Segunda Parte del Formulario Descripcion Perfil Profesional------------------------------*/
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

        $.ajax({
            url:  "FormularioProfesionalSave4",
            type: "POST",
            data: $('#formulario_descripcion').serialize(),
            success: function( response ) {
                $('#mensaje-perfil-profesional').append('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');
            },
            error: function (event) {
                var response = event.responseJSON;
                $('#mensaje-perfil-profesional').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');
            }
        });
    }
});

$('#formulario_estudios').validate({
    rules: {
        'universidad_estudio': {
            required: true,
        },
        'fecha_estudio': {
            required: true,
        },
        'disciplina_estudio': {
            required: true,
        },
    },
    messages: {
        'universidad_estudio':{
            required: "Por favor seleccione la universidad",
        },
        'fecha_estudio':{
            required: "Por favor ingrese la fecha de finalización de la carrera",
        },
        'disciplina_estudio':{
            required: "Por favor ingrese la disciplina académica",
        },
    },
    submitHandler: function(form) {
        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:  "FormularioProfesionalSave5",
            type: "POST",
            data: $('#formulario_estudios').serialize(),
            success: function( response ) {
                $('#mensaje-estudios').append('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');

                if (response.items_max)
                {
                    $('#universidad_estudio').attr('disabled', 'disabled');
                    $('#fecha_estudio').attr('disabled', 'disabled');
                    $('#disciplina_estudio').attr('disabled', 'disabled');
                    $('#boton-enviar-estudios').attr('disabled', 'disabled');
                }

                $('#estudios-lista').append('<div class="section_infoEducacion-formProf">\n' +
                    '<div class="col-12 content_btnX-cierre-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="{{ $objEducacion->id_universidadperfil }}"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> Fecha de finalización </label>\n' +
                    '<label class="col-12 text_infoGuardada-formProf"> ' + $('#fecha_estudio').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> Universidad </label>\n' +
                    '<label class="col-12 text_infoGuardada-formProf"> ' +  response.universidad + ' </label>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> Disciplina académica </label>\n' +
                    '<label class="col-12 text_infoGuardada-formProf"> ' + $('#disciplina_estudio').val() + ' </label>\n' +
                    '</div>\n' +
                    '</div>');

                document.getElementById("formulario_estudios").reset();
            },
            error: function (event) {
                var response = event.responseJSON;
                $('#mensaje-estudios').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');
                if (event.status === 422) {
                    $.each(response.error, function (index, element) {
                        $('#' + index).addClass('is-invalid');
                    });
                }
                if (response.items_max)
                {
                    $('#universidad_estudio').attr('disabled', 'disabled');
                    $('#fecha_estudio').attr('disabled', 'disabled');
                    $('#disciplina_estudio').attr('disabled', 'disabled');
                    $('#boton-enviar-estudios').attr('disabled', 'disabled');
                }
            }
        });
    }
});

$('#estudios-lista').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "FormularioProfesionaldelete5",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            $('#mensaje-consulta').html('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');

            //quitar el disabled
            $('#universidad_estudio').removeAttr('disabled');
            $('#fecha_estudio').removeAttr('disabled');
            $('#disciplina_estudio').removeAttr('disabled');
            $('#boton-enviar-estudios').removeAttr('disabled');

            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            var response = event.responseJSON;
            $('#mensaje-consulta').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');
        }
    });

});


$('#formulario_experiencia').validate({
    rules: {
        'universidad_estudio': {
            required: true,
        },
        'fecha_estudio': {
            required: true,
        },
        'disciplina_estudio': {
            required: true,
        },
    },
    messages: {
        'universidad_estudio':{
            required: "Por favor seleccione la universidad",
        },
        'fecha_estudio':{
            required: "Por favor ingrese la fecha de finalización de la carrera",
        },
        'disciplina_estudio':{
            required: "Por favor ingrese la disciplina académica",
        },
    },
    submitHandler: function(form) {
        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:  "FormularioProfesionalSave5",
            type: "POST",
            data: $('#formulario_estudios').serialize(),
            success: function( response ) {
                $('#mensaje-estudios').append('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');

                if (response.items_max)
                {
                    $('#universidad_estudio').attr('disabled', 'disabled');
                    $('#fecha_estudio').attr('disabled', 'disabled');
                    $('#disciplina_estudio').attr('disabled', 'disabled');
                    $('#boton-enviar-estudios').attr('disabled', 'disabled');
                }

                $('#estudios-lista').append('<div class="section_infoEducacion-formProf">\n' +
                    '<div class="col-12 content_btnX-cierre-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="{{ $objEducacion->id_universidadperfil }}"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> Fecha de finalización </label>\n' +
                    '<label class="col-12 text_infoGuardada-formProf"> ' + $('#fecha_estudio').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> Universidad </label>\n' +
                    '<label class="col-12 text_infoGuardada-formProf"> ' +  response.universidad + ' </label>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> Disciplina académica </label>\n' +
                    '<label class="col-12 text_infoGuardada-formProf"> ' + $('#disciplina_estudio').val() + ' </label>\n' +
                    '</div>\n' +
                    '</div>');

                document.getElementById("formulario_estudios").reset();
            },
            error: function (event) {
                var response = event.responseJSON;
                $('#mensaje-estudios').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');
                if (event.status === 422) {
                    $.each(response.error, function (index, element) {
                        $('#' + index).addClass('is-invalid');
                    });
                }
                if (response.items_max)
                {
                    $('#universidad_estudio').attr('disabled', 'disabled');
                    $('#fecha_estudio').attr('disabled', 'disabled');
                    $('#disciplina_estudio').attr('disabled', 'disabled');
                    $('#boton-enviar-estudios').attr('disabled', 'disabled');
                }
            }
        });
    }
});

$('#experiencia-lista').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "FormularioProfesionaldelete5",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            $('#mensaje-consulta').html('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');

            //quitar el disabled
            $('#universidad_estudio').removeAttr('disabled');
            $('#fecha_estudio').removeAttr('disabled');
            $('#disciplina_estudio').removeAttr('disabled');
            $('#boton-enviar-estudios').removeAttr('disabled');

            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            var response = event.responseJSON;
            $('#mensaje-consulta').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');
        }
    });

});


/*--------------------------- Fin Segunda Parte del Formulario Descripcion Perfil Profesional-------------------------------*/

/*-------------------------- Inicio Tercera Parte del Formulario Descripcion Perfil Profesional------------------------------*/
$.validator.addMethod("selecttext", function(value, element) {
    if (select == "") {
        return false;
    } else {
        return true;
    };
}, "Por favor seleccione el tipo de consulta");



/*--------------------------- Fin Tercera Parte del Formulario Descripcion Perfil Profesional-------------------------------*/


/*-------------------- Inicio Cuarta Parte del Formulario Descripcion Perfil Profesional----------------------------------*/

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
