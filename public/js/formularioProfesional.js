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

/*-------------------------- Inicio Segunda Parte del Formulario Perfil Profesional------------------------------*/
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
                    '<button type="submit" class="close" aria-label="Close" data-id="' + response.id + '"><span aria-hidden="true">&times;</span></button>\n' +
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
            $('#mensaje-estudios').html('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
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
            $('#mensaje-estudios').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
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
        'nombre_empresa': {
            required: true,
        },
        'descripcion_experiencia': {
            required: true,
        },
        'inicio_experiencia': {
            required: true,
        },
        'fin_experiencia': {
            required: true,
        },
    },
    messages: {
        'nombre_empresa':{
            required: "Por favor ingrese el nombre de la empresa",
        },
        'descripcion_experiencia':{
            required: "Por favor ingrese la descripción de la experiencia",
        },
        'inicio_experiencia':{
            required: "Por favor ingrese la fecha de inicio de la experiencia",
        },
        'fin_experiencia':{
            required: "Por favor ingrese la fecha de finalización de la experiencia",
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
            url:  "FormularioProfesionalSave6",
            type: "POST",
            data: $('#formulario_experiencia').serialize(),
            success: function( response ) {
                $('#mensaje-experiencia').append('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');

                if (response.items_max)
                {
                    $('#nombre_empresa').attr('disabled', 'disabled');
                    $('#descripcion_experiencia').attr('disabled', 'disabled');
                    $('#inicio_experiencia').attr('disabled', 'disabled');
                    $('#fin_experiencia').attr('disabled', 'disabled');
                    $('#boton-guardar-experiencia').attr('disabled', 'disabled');
                }

                $('#experiencia-lista').append('<div class="section_infoExper-formProf">\n' +
                    '<div class="col-12 content_btnX-cierre-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="' + response.id + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> Nombre de la empresa </label>\n' +
                    '<label class="col-12 text_infoGuardada-formProf">' + $('#nombre_empresa').val() + '</label>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> Descripción de la experiencia </label>\n' +
                    '<label class="col-12 text_infoGuardada-formProf">' + $('#descripcion_experiencia').val() + '</label>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> Fecha de inicio experiencia </label>\n' +
                    '<label class="col-12 text_infoGuardada-formProf">' + $('#inicio_experiencia').val() + '</label>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> Fecha de finalización experiencia </label>\n' +
                    '<label class="col-12 text_infoGuardada-formProf">' + $('#fin_experiencia').val() + '</label>\n' +
                    '</div>\n' +
                    '</div>');

                document.getElementById("formulario_experiencia").reset();
            },
            error: function (event) {
                var response = event.responseJSON;
                $('#mensaje-experiencia').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
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
                    $('#nombre_empresa').attr('disabled', 'disabled');
                    $('#descripcion_experiencia').attr('disabled', 'disabled');
                    $('#inicio_experiencia').attr('disabled', 'disabled');
                    $('#fin_experiencia').attr('disabled', 'disabled');
                    $('#boton-guardar-experiencia').attr('disabled', 'disabled');
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
        url:  "FormularioProfesionaldelete6",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            $('#mensaje-experiencia').html('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');

            //quitar el disabled
            $('#nombre_empresa').removeAttr('disabled');
            $('#descripcion_experiencia').removeAttr('disabled');
            $('#inicio_experiencia').removeAttr('disabled');
            $('#fin_experiencia').removeAttr('disabled');
            $('#boton-guardar-experiencia').removeAttr('disabled');

            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            var response = event.responseJSON;
            $('#mensaje-experiencia').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');
        }
    });

});

$('#formulario_idioma').validate({
    rules: {
        'idioma': {
            required: true,
        }
    },
    messages: {
        'idioma':{
            required: "Seleccione el idioma",
        }
    },
    submitHandler: function(form) {
        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:  "FormularioProfesionalSave8",
            type: "POST",
            data: $('#formulario_idioma').serialize(),
            success: function( response ) {
                $('#mensaje-idioma').append('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');

                if (response.items_max)
                {
                    $('#idioma').attr('disabled', 'disabled');
                    $('#boton-guardar-idioma').attr('disabled', 'disabled');
                }

                $('#lista-idioma').append('<div class="section_infoAsocia-formProf">\n' +
                    '<div class="col-12 content_btnX-cierre-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="' + response.id + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="">\n' +
                    '<img id="imagenPrevisualizacion" class="img_bandera-forProf" src="' + response.image + '">\n' +
                    '<label for="example-date-input" class="text_idioma-formProf">' + response.idioma + '</label>\n' +
                    '</div>\n' +
                    '</div>');

                document.getElementById("formulario_idioma").reset();
            },
            error: function (event) {
                var response = event.responseJSON;
                $('#mensaje-idioma').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
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
                    $('#idioma').attr('disabled', 'disabled');
                    $('#boton-guardar-idioma').attr('disabled', 'disabled');
                }
            }
        });
    }
});

$('#lista-idioma').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "FormularioProfesionaldelete8",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            $('#mensaje-idioma').html('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');

            //quitar el disabled
            $('#idioma').removeAttr('disabled');
            $('#boton-guardar-idioma').removeAttr('disabled');

            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            var response = event.responseJSON;
            $('#mensaje-idioma').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');
        }
    });

});


/*--------------------------- Fin Segunda Parte del Formulario Perfil Profesional-------------------------------*/

/*-------------------------- Inicio Tercera Parte del Formulario Perfil Profesional------------------------------*/
$('#formulario_tratamiento').validate({
    rules: {
        'imgTratamientoAntes': {
            required: true,
            //extension: "jpg|png"
        },
        'tituloTrataminetoAntes': {
            required: true,
        },
        'descripcionTratamientoAntes': {
            required: true,
            minlength: 0,
            maxlength: 160,
        },
        'imgTratamientodespues': {
            required: true,
            //extension: "jpg|png"
        },
        'tituloTrataminetoDespues': {
            required: true,
        },
        'descripcionTratamientoDespues': {
            required: true,
            minlength: 0,
            maxlength: 160,
        },
    },
    messages: {
        'imgTratamientoAntes':{
            required: "Ingrese la imagen del tratamiento de antes",
            //extension: "Solo se acepta imagenes jpg y png"
        },
        'tituloTrataminetoAntes':{
            required: "Ingrese el titulo de antes del tratamiento",
        },
        'descripcionTratamientoAntes':{
            required: "Ingrese la descripción de antes del tratamiento",
            minlength: "Ingrese La cantidad minima de caracteres",
            maxlength: "la cantidad maxima de caracteres es de 160."
        },
        'imgTratamientodespues':{
            required: "Ingrese la imagen del tratamiento de después",
            //extension: "Solo se acepta imagenes jpg y png"
        },
        'tituloTrataminetoDespues':{
            required: "Ingrese el titulo de después del tratamiento",
        },
        'descripcionTratamientoDespues':{
            required: "Ingrese la descripción de después del tratamiento",
            minlength: "Ingrese La cantidad minima de caracteres",
            maxlength: "la cantidad maxima de caracteres es de 160."
        },
    },
    submitHandler: function(form) {


        var formulario = $('#formulario_tratamiento')[0];

        var data = new FormData(formulario);


        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            enctype: 'multipart/form-data',
            url:  "FormularioProfesionalSave9",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            success: function( response ) {
                $('#mensajes-tratamientos').append('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');

                if (response.items_max)
                {
                    $('#imgTratamientoAntes').attr('disabled', 'disabled');
                    $('#tituloTrataminetoAntes').attr('disabled', 'disabled');
                    $('#descripcionTratamientoAntes').attr('disabled', 'disabled');
                    $('#imgTratamientodespues').attr('disabled', 'disabled');
                    $('#tituloTrataminetoDespues').attr('disabled', 'disabled');
                    $('#descripcionTratamientoDespues').attr('disabled', 'disabled');
                    $('#boton-guardar-tratamiento').attr('disabled', 'disabled');
                }

                $('#lista-tratamientos').append('<div class="traProce_guardada-formProf">\n' +
                    '<div class="col-12 content_btnDelet-trata-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="' + response.id + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="col-12 col-md-6">\n' +
                    '<label class="col-12 title_trata-formProf"> Antes </label>\n' +
                    '<div class="col-12 img_selccionada-formProf">\n' +
                    '<img class="img_traProced-formProf" src="' + response.imagen_antes + '">\n' +
                    '</div>\n' +
                    '<div class="col-12 mt-2 text_label-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> ' + $('#tituloTrataminetoAntes').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="col-12 descripcion_Premio-formProf">\n' +
                    ' <label class="col-12 text_infoGuardada-formProf"> ' + $('#descripcionTratamientoAntes').val() + ' </label>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '<div class="col-12 col-md-6 after_formProf">\n' +
                    '<label class="col-12 title_trata-formProf"> Después </label>\n' +
                    '<div class="col-12 img_selccionada-formProf">\n' +
                    '<img class="img_traProced-formProf" src="' + response.imagen_despues + '">\n' +
                    '</div>\n' +
                    '<div class="col-12 mt-2 text_label-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> ' + $('#tituloTrataminetoDespues').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="col-12 descripcion_Premio-formProf">\n' +
                    '<label class="col-12 text_infoGuardada-formProf"> ' + $('#descripcionTratamientoDespues').val() + ' </label>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>');

                document.getElementById("formulario_tratamiento").reset();
                $('#imagen-tratamiento-antes').removeAttr('src');
                $('#imagen-tratamiento-despues').removeAttr('src');
            },
            error: function (event) {
                var response = event.responseJSON;
                $('#mensajes-tratamientos').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
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
                    $('#imgTratamientoAntes').attr('disabled', 'disabled');
                    $('#tituloTrataminetoAntes').attr('disabled', 'disabled');
                    $('#descripcionTratamientoAntes').attr('disabled', 'disabled');
                    $('#imgTratamientodespues').attr('disabled', 'disabled');
                    $('#tituloTrataminetoDespues').attr('disabled', 'disabled');
                    $('#descripcionTratamientoDespues').attr('disabled', 'disabled');
                    $('#boton-guardar-tratamiento').attr('disabled', 'disabled');
                }
            }
        });
    }
});

$('#lista-tratamientos').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "FormularioProfesionaldelete9",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            $('#mensajes-tratamientos').html('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');

            //quitar el disabled
            $('#imgTratamientoAntes').removeAttr('disabled');
            $('#tituloTrataminetoAntes').removeAttr('disabled');
            $('#descripcionTratamientoAntes').removeAttr('disabled');
            $('#imgTratamientodespues').removeAttr('disabled');
            $('#tituloTrataminetoDespues').removeAttr('disabled');
            $('#descripcionTratamientoDespues').removeAttr('disabled');
            $('#boton-guardar-tratamiento').removeAttr('disabled');

            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            var response = event.responseJSON;
            $('#mensajes-tratamientos').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');
        }
    });

});

/*--------------------------- Fin Tercera Parte del Formulario Perfil Profesional-------------------------------*/


/*-------------------- Inicio Cuarta Parte del Formulario Perfil Profesional----------------------------------*/
$('#formulario_premio').validate({
    rules: {
        'imgPremio': {
            required: true,
            //extension: "jpg|png"
        },
        'fechaPremio': {
            required: true,
        },
        'nombrePremio': {
            required: true,
        },
        'descripcionPremio': {
            required: true,
            minlength: 0,
            maxlength: 160,
        }
    },
    messages: {
        'imgPremio':{
            required: "Ingrese la imagen del premio",
            //extension: "Solo se acepta imagenes jpg y png"
        },
        'fechaPremio':{
            required: "Ingrese la fecha del premio",
        },
        'nombrePremio':{
            required: "Ingrese el titulo del premio",
        },
        'descripcionPremio':{
            required: "Ingrese la descripción del premio",
            minlength: "Ingrese La cantidad minima de caracteres",
            maxlength: "la cantidad maxima de caracteres es de 160."
        }
    },
    submitHandler: function(form) {

        var formulario = $('#formulario_premio')[0];

        var data = new FormData(formulario);


        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            enctype: 'multipart/form-data',
            url:  "FormularioProfesionalSave10",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            success: function( response ) {
                $('#mensajes-premios').append('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');

                if (response.items_max)
                {
                    $('#imgPremio').attr('disabled', 'disabled');
                    $('#fechaPremio').attr('disabled', 'disabled');
                    $('#nombrePremio').attr('disabled', 'disabled');
                    $('#descripcionPremio').attr('disabled', 'disabled');
                    $('#boton-guardar-premio').attr('disabled', 'disabled');
                }

                $('#lista-premios').append('<div class="section_infoExper-formProf">\n' +
                    '<div class="col-12 content_btnDelet-trata-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="' + response.id + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="col-12 mt-2 p-0">\n' +
                    '<div class="img_selccionada-formProf">\n' +
                    '<img class="img_anexada-formProf" src="' + response.imagen + '">\n' +
                    '</div>\n' +
                    '<div class="col-12 p-0 mt-2">\n' +
                    '<label class="col-12 text_fechaPremio-formProf"> ' + $('#fechaPremio').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="col-12 text_label-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> ' + $('#nombrePremio').val() + '  </label>\n' +
                    '</div>\n' +
                    '<div class="col-12 descripcion_Premio-formProf">\n' +
                    '<label class="col-12 text_descPremio-formProf"> ' + $('#descripcionPremio').val() + ' </label>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>');

                document.getElementById("formulario_premio").reset();
                $('#img-premio').removeAttr('src');
            },
            error: function (event) {
                var response = event.responseJSON;
                $('#mensajes-premios').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
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
                    $('#imgPremio').attr('disabled', 'disabled');
                    $('#fechaPremio').attr('disabled', 'disabled');
                    $('#nombrePremio').attr('disabled', 'disabled');
                    $('#descripcionPremio').attr('disabled', 'disabled');
                    $('#boton-guardar-premio').attr('disabled', 'disabled');
                }
            }
        });
    }
});

$('#lista-premios').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "FormularioProfesionaldelete10",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            $('#mensajes-premios').html('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');

            //quitar el disabled
            $('#imgPremio').removeAttr('disabled');
            $('#fechaPremio').removeAttr('disabled');
            $('#nombrePremio').removeAttr('disabled');
            $('#descripcionPremio').removeAttr('disabled');
            $('#boton-guardar-premio').removeAttr('disabled');
            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            var response = event.responseJSON;
            $('#mensajes-premios').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');
        }
    });

});
/*------------------------------ Fin Cuarta Parte del Formulario Perfil Profesional------------------------------*/

/*-------------------- Inicio Quinta Parte del Formulario Perfil Profesional----------------------------------*/

$('#formulario_publicaciones').validate({
    rules: {
        'imagePublicacion': {
            required: true,
            //extension: "jpg|png"
        },
        'nombrePublicacion': {
            required: true,
        },
        'descripcionPremio': {
            required: true,
            minlength: 0,
            maxlength: 160,
        }
    },
    messages: {
        'imagePublicacion':{
            required: "Ingrese la imagen de la publicación",
            //extension: "Solo se acepta imagenes jpg y png"
        },
        'nombrePublicacion':{
            required: "Ingrese el titulo de la publicación",
        },
        'descripcionPublicacion':{
            required: "Ingrese la descripción de la publicación",
            minlength: "Ingrese La cantidad minima de caracteres",
            maxlength: "la cantidad maxima de caracteres es de 160."
        }
    },
    submitHandler: function(form) {

        var formulario = $('#formulario_publicaciones')[0];

        var data = new FormData(formulario);


        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            enctype: 'multipart/form-data',
            url:  "FormularioProfesionalSave11",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            success: function( response ) {
                $('#mensajes-publicacion').append('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');

                if (response.items_max)
                {
                    $('#imagePublicacion').attr('disabled', 'disabled');
                    $('#nombrePublicacion').attr('disabled', 'disabled');
                    $('#descripcionPublicacion').attr('disabled', 'disabled');
                    $('#boton-guardar-publicacion').attr('disabled', 'disabled');
                }

                $('#lista-publicacion').append('<div class="section_infoExper-formProf">\n' +
                    '<div class="col-12 content_btnDelet-trata-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="' + response.id + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="col-12 my-2">\n' +
                    '<div class="img_selccionada-formProf">\n' +
                    '<img class="img_anexada-formProf" src="' + response.imagen + '">\n' +
                    '</div>\n' +
                    '<div class="col-12 mt-2 text_label-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> ' + $('#nombrePublicacion').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="col-12 descripcion_Premio-formProf">\n' +
                    '<label class="col-12 text_descPremio-formProf"> ' + $('#descripcionPublicacion').val() + ' </label>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>');

                document.getElementById("formulario_publicaciones").reset();
                $('#img-publicacion').removeAttr('src');
            },
            error: function (event) {
                var response = event.responseJSON;
                $('#mensajes-publicacion').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
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
                    $('#imagePublicacion').attr('disabled', 'disabled');
                    $('#nombrePublicacion').attr('disabled', 'disabled');
                    $('#descripcionPublicacion').attr('disabled', 'disabled');
                    $('#boton-guardar-publicacion').attr('disabled', 'disabled');
                }
            }
        });
    }
});

$('#lista-publicacion').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "FormularioProfesionaldelete11",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            $('#mensajes-publicacion').html('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');

            //quitar el disabled
            $('#imagePublicacion').removeAttr('disabled');
            $('#nombrePublicacion').removeAttr('disabled');
            $('#descripcionPublicacion').removeAttr('disabled');
            $('#boton-guardar-publicacion').removeAttr('disabled');
            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            var response = event.responseJSON;
            $('#mensajes-publicacion').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');
        }
    });

});

/*------------------------------ Fin Quinta Parte del Formulario Perfil Profesional------------------------------*/
/*-------------------- Inicio Sexta Parte del Formulario Perfil Profesional----------------------------------*/
$('#formulario_fotos').validate({
    rules: {
        'imgFoto': {
            required: true,
            //extension: "jpg|png"
        },
        'fechaFoto': {
            required: true,
        },
        'nombreFoto': {
            required: true,
        },
        'descripcionFoto': {
            required: true,
            minlength: 0,
            maxlength: 160,
        }
    },
    messages: {
        'imgFoto':{
            required: "Ingrese la imagen del premio",
            //extension: "Solo se acepta imagenes jpg y png"
        },
        'fechaFoto':{
            required: "Ingrese la fecha del premio",
        },
        'nombreFoto':{
            required: "Ingrese el titulo del premio",
        },
        'descripcionFoto':{
            required: "Ingrese la descripción del premio",
            minlength: "Ingrese La cantidad minima de caracteres",
            maxlength: "la cantidad maxima de caracteres es de 160."
        }
    },
    submitHandler: function(form) {

        var formulario = $('#formulario_fotos')[0];

        var data = new FormData(formulario);


        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            enctype: 'multipart/form-data',
            url:  "FormularioProfesionalSave12",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            success: function( response ) {
                $('#mensajes-fotos').append('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                    response.mensaje +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');

                if (response.items_max)
                {
                    $('#imgFoto').attr('disabled', 'disabled');
                    $('#fechaFoto').attr('disabled', 'disabled');
                    $('#nombreFoto').attr('disabled', 'disabled');
                    $('#descripcionFoto').attr('disabled', 'disabled');
                    $('#boton-guardar-foto').attr('disabled', 'disabled');
                }

                $('#lista-fotos').append('<div class="section_infoExper-formProf">\n' +
                    '<div class="col-12 content_btnDelet-trata-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="' + response.id + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="col-12 my-2 p-0">\n' +
                    '<div class="img_selccionada-formProf">\n' +
                    '<img  class="img_anexada-formProf" src="' + response.imagen + '">\n' +
                    '</div>\n' +
                    '<div class="col-12 mt-2 text_label-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> ' + $('#nombreFoto').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="col-12 descripcion_Premio-formProf">\n' +
                    '<label class="col-12 text_descPremio-formProf"> ' + $('#descripcionFoto').val() + ' </label>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>');

                document.getElementById("formulario_fotos").reset();
                $('#img-foto').removeAttr('src');
            },
            error: function (event) {
                var response = event.responseJSON;
                $('#mensajes-fotos').append('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
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
                    $('#imgFoto').attr('disabled', 'disabled');
                    $('#fechaFoto').attr('disabled', 'disabled');
                    $('#nombreFoto').attr('disabled', 'disabled');
                    $('#descripcionFoto').attr('disabled', 'disabled');
                    $('#boton-guardar-foto').attr('disabled', 'disabled');
                }
            }
        });
    }
});

$('#lista-fotos').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "FormularioProfesionaldelete12",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            $('#mensajes-fotos').html('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');

            //quitar el disabled
            $('#imgFoto').removeAttr('disabled');
            $('#fechaFoto').removeAttr('disabled');
            $('#nombreFoto').removeAttr('disabled');
            $('#descripcionFoto').removeAttr('disabled');
            $('#boton-guardar-foto').removeAttr('disabled');
            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            var response = event.responseJSON;
            $('#mensajes-fotos').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                response.mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>');
        }
    });

});


/*------------------------------ Fin Sexta Parte del Formulario Perfil Profesional------------------------------*/
