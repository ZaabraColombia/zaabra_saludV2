/*-----------------------------------------------------------------------------------------------------------------*/
function mensaje_error(id, mensaje, error = false) {
    var lista = '';
    if (error) {
        lista = '<br><ul>';
        $.each(error, function (key, item){
            lista += '<li>' + item + '</li>';
        });
        lista += '</ul>';
    }
    $(id).html('<div class="alert alert-danger" role="alert">\n' +
        '<h4 class="alert-heading">Cuidado!</h4>\n' +
        '<p>' + mensaje + lista +'</p>\n' +
        '</div>');
}

function mensaje_success(id, mensaje) {
    $(id).html('<div class="alert alert-success" role="alert">\n' +
        '<h4 class="alert-heading">Hecho!</h4>\n' +
        '<p>' + mensaje + '</p>\n' +
        '</div>');
}

function id_invalid(ids, status){
    console.log(ids);
    console.log(status);
    if (status === 422) {
        $.each(ids, function (index, element) {
            $('#' + element).addClass('is-invalid');
        });
    }
}

$('.universidades').select2({
    theme: "bootstrap",
    placeholder: 'Seleccione una universidad',
    ajax: {
        url: '/buscar-universidad',
        dataType: 'json',
        type: 'post',
        delay: 250,
        data: function (data) {
            return {
                searchTerm: data.term // search term
            };
        },
        processResults: function (response) {
            return {
                results:response
            };
        },
        cache: true,
    },
    minimumInputLength: 5
});

/*-------------------------- Botones para guardar ----------------------*/
function boton_guardar(id){
    var btn = $(id);

    btn.prop('disabled', false);
    btn.html(btn.data('text') + '&nbsp;<i class="fa fa-arrow-right"></i>');
}

function boton_guardar_cargando(id){
    var btn = $(id);

    btn.prop('disabled', true);
    btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;' + btn.data('text-loading'));
}

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
        // // Pace.start();
        var btn = '#envia_basico';
        boton_guardar_cargando(btn);
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
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function( response ) {
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                mensaje_success('#msg_basico', response.mensaje);
            },
            error: function (event) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;

                if (event.status === 422){
                    mensaje_error('#msg_basico', response.mensaje, response.error.mensajes);
                }else {
                    mensaje_error('#msg_basico', response.mensaje);
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
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

        // Pace.start();
        var btn = '#envia_contacto';
        boton_guardar_cargando(btn);
        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:  "FormularioProfesionalSave2",
            type: "POST",
            data: $('#formulario_contacto').serialize(),
            success: function( response ) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                mensaje_success('#msg_contacto', response.mensaje);
            },
            error:function (event) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;

                if (event.status === 422){
                    mensaje_error('#msg_contacto', response.mensaje, response.error.mensajes);
                }else {
                    mensaje_error('#msg_contacto', response.mensaje);
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);

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

        var btn = '#envia_consultas';
        boton_guardar_cargando(btn);

        $.ajax({
            url:  "FormularioProfesionalSave3",
            type: "POST",
            data: $('#formulario_consulta').serialize(),
            success: function( response ) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                if (response.items_max)
                {
                    $('#tipo_consulta').prop('disabled', true);
                    $('#valor_consulta').prop('disabled', true);
                    $(btn).prop('disabled', true);
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
                //Respuesta
                mensaje_success('#mensaje-consulta', response.mensaje);
            },
            error: function (event) {
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                var response = event.responseJSON;

                if (response.items_max)
                {
                    $('#tipo_consulta').prop('disabled', true);
                    $('#valor_consulta').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                //Respuesta
                if (event.status === 422){
                    mensaje_error('#mensaje-consulta', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensaje-consulta', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});

$('#consultas-lista').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    // Pace.start();
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
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
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
            //Respuesta
            mensaje_success('#mensaje-consulta', response.mensaje);
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;
            //Respuesta
            if (event.status === 422){
                mensaje_error('#mensaje-consulta', response.mensaje, response.error.mensajes)
            }else {
                mensaje_error('#mensaje-consulta', response.mensaje)
            }

            //Si es validación por formulario
            if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
        }
    });

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
        var btn = '#destacado_nombre_btn';
        boton_guardar_cargando(btn);

        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:  "/FormularioProfesionalAddDestacable",
            type: "POST",
            dataType: 'json',
            data: $('#formulario_destacado').serialize(),
            success: function( response ) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                $('#destacado-lista').append('<div class="alert alert-info alert-dismissible fade show" role="alert">\n' +
                    '<strong>' + response.nombre + '</strong>\n' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close" data-id=' + response.id + '>\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>');

                console.log(response.count);
                if (response.count >= 9){
                    $('#destacado_nombre').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                document.getElementById("formulario_destacado").reset();
                //Respuesta
                mensaje_success('#destacado-mensaje', response.mensaje);
            },
            error: function (event){

                boton_guardar(btn);

                var response = event.responseJSON

                //Respuesta
                if (event.status === 422){
                    mensaje_error('#destacado-mensaje', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensaje-consulta', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
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

    // Pace.start();
    $.ajax({
        url:  "/FormularioProfesionalDeleteDestacable",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            $('#destacado_nombre').prop('disabled', false);
            $('#destacado_nombre_btn').prop('disabled', false);

            //Respuesta
            mensaje_success('#destacado-mensaje', response.mensaje);

        },
        error: function (event){

            var response = event.responseJSON

            //Respuesta
            if (event.status === 422){
                mensaje_error('#destacado-mensaje', response.mensaje, response.error.mensajes)
            }else {
                mensaje_error('#mensaje-consulta', response.mensaje)
            }

            //Si es validación por formulario
            if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);

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
        // Pace.start();
        var btn = '#btn-guardar-perfil-profesional';
        boton_guardar_cargando(btn);
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
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                mensaje_success('#mensaje-perfil-profesional', response.mensaje);
            },
            error: function (event) {
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);
                var response = event.responseJSON;

                //Respuesta
                if (event.status === 422){
                    mensaje_error('#mensaje-perfil-profesional', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensaje-perfil-profesional', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});

$('#formulario_estudios').validate({
    rules: {
        'logo_universidad': {
            required: true,
        },
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
        'logo_universidad':{
            required: "Por favor ingrese el logo de la empresa",
        },
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

        var btn = '#boton-enviar-estudios';
        boton_guardar_cargando(btn);

        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formulario = $('#formulario_estudios')[0];

        var data = new FormData(formulario);
        $.ajax({
            enctype: 'multipart/form-data',
            url:  "FormularioProfesionalSave5",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            success: function( response ) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                if (response.items_max)
                {
                    $('#logo_universidad').prop('disabled', true);
                    $('#universidad_estudio').prop('disabled', true);
                    $('#fecha_estudio').prop('disabled', true);
                    $('#disciplina_estudio').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                $('#estudios-lista').append('<div class="section_infoEducacion-formProf">\n' +
                    '<div class="col-12 content_btnX-cierre-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="' + response.id + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="option_consul_img_formProf">'+
                    '<img id="imagenPrevisualizacion" class="logo_univ_LInst" src="'+ response.logo +'">'+
                    '</div>'+
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
                $('#imagen-universidad').removeAttr('src');
                //Respuesta
                mensaje_success('#mensaje-estudios', response.mensaje);

            },
            error: function (event) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);
                var response = event.responseJSON;

                if (response.items_max)
                {
                    $('#logo_universidad').prop('disabled', true);
                    $('#universidad_estudio').prop('disabled', true);
                    $('#fecha_estudio').prop('disabled', true);
                    $('#disciplina_estudio').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }
                //Respuesta
                if (event.status === 422){
                    mensaje_error('#mensaje-perfil-profesional', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensaje-perfil-profesional', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);

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

    // Pace.start();
    $.ajax({
        url:  "FormularioProfesionaldelete5",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            //quitar el disabled
            $('#logo_universidad').removeAttr('disabled');
            $('#universidad_estudio').removeAttr('disabled');
            $('#fecha_estudio').removeAttr('disabled');
            $('#disciplina_estudio').removeAttr('disabled');
            $('#boton-enviar-estudios').removeAttr('disabled');

            //Quitar la caja
            button.parent().parent().remove();
            //Respuesta
            mensaje_success('#mensaje-estudios', response.mensaje);
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            //Respuesta
            if (event.status === 422){
                mensaje_error('#mensaje-estudios', response.mensaje, response.error.mensajes)
            }else {
                mensaje_error('#mensaje-estudios', response.mensaje)
            }

            //Si es validación por formulario
            if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
        }
    });

});

$('#formulario_experiencia').validate({
    rules: {
        'logo_experiencia': {
            required: true,
        },
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
        'logo_experiencia':{
            required: "Por favor ingrese el logo de la empresa",
        },
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
        // Pace.start();
        var btn = '#boton-guardar-experiencia';
        boton_guardar_cargando(btn);

        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formulario = $('#formulario_experiencia')[0];

        var data = new FormData(formulario);
        $.ajax({
            enctype: 'multipart/form-data',
            url:  "FormularioProfesionalSave6",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            success: function( response ) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                if (response.items_max)
                {
                    $('#logo_experiencia').prop('disabled', true);
                    $('#nombre_empresa').prop('disabled', true);
                    $('#descripcion_experiencia').prop('disabled', true);
                    $('#inicio_experiencia').prop('disabled', true);
                    $('#fin_experiencia').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                $('#experiencia-lista').append('<div class="section_infoExper-formProf">\n' +
                    '<div class="col-12 content_btnX-cierre-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="' + response.id + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="option_consul_img_formProf">'+
                    '<img id="imagenPrevisualizacion" class="logo_univ_LInst" src="'+ response.logo +'">'+
                    '</div>'+
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
                $('#imagen-experiencia').removeAttr('src');
                //Respuesta
                mensaje_success('#mensaje-experiencia', response.mensaje);
            },
            error: function (event) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                var response = event.responseJSON;

                if (response.items_max)
                {
                    $('#logo_experiencia').prop('disabled', true);
                    $('#nombre_empresa').prop('disabled', true);
                    $('#descripcion_experiencia').prop('disabled', true);
                    $('#inicio_experiencia').prop('disabled', true);
                    $('#fin_experiencia').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }
                //Respuesta
                if (event.status === 422){
                    mensaje_error('#mensaje-experiencia', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensaje-experiencia', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});

$('#experiencia-lista').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    // Pace.start();
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
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            //quitar el disabled
            $('#logo_experiencia').removeAttr('disabled');
            $('#nombre_empresa').removeAttr('disabled');
            $('#descripcion_experiencia').removeAttr('disabled');
            $('#inicio_experiencia').removeAttr('disabled');
            $('#fin_experiencia').removeAttr('disabled');
            $('#boton-guardar-experiencia').removeAttr('disabled');

            //Quitar la caja
            button.parent().parent().remove();
            //Respuesta
            mensaje_success('#mensaje-experiencia', response.mensaje);
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            //Respuesta
            if (event.status === 422){
                mensaje_error('#mensaje-experiencia', response.mensaje, response.error.mensajes)
            }else {
                mensaje_error('#mensaje-experiencia', response.mensaje)
            }

            //Si es validación por formulario
            if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
        }
    });

});

$('#formulario_asociacion').validate({
    rules: {
        'imagenAsociacion': {
            required: true,
            //extension: "jpg|png"
        }
    },
    messages: {
        'imagenAsociacion':{
            required: "Ingrese la imagen de la asociación",
            //extension: "Solo se acepta imagenes jpg y png"
        }
    },
    submitHandler: function(form) {

        var btn = '#boton-guardar-asociacion';
        boton_guardar_cargando(btn);

        var formulario = $('#formulario_asociacion')[0];

        var data = new FormData(formulario);


        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            enctype: 'multipart/form-data',
            url:  "FormularioProfesionalSave7",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            success: function( response ) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                if (response.items_max)
                {
                    $('#imagenAsociacion').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                $('#lista-asociacion').append('<div class="section_infoAsocia-formProf">\n' +
                    '<div class="col-12 content_btnX-cierre-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="' + response.id + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="option_asociacion-formProf">\n' +
                    '<img class="img_guardada-formProf" id="imagenPrevisualizacion" src="' + response.imagen + '">\n' +
                    '</div>\n' +
                    '</div>');

                document.getElementById("formulario_asociacion").reset();
                $('#img-asociacion').removeAttr('src');
                //Respuesta
                mensaje_success('#mensajes-asociacion', response.mensaje);
            },
            error: function (event) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                var response = event.responseJSON;

                if (response.items_max)
                {
                    $('#imagenAsociacion').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                //Respuesta
                if (event.status === 422){
                    mensaje_error('#mensajes-asociacion', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-asociacion', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});

$('#lista-asociacion').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    // Pace.start();
    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "FormularioProfesionaldelete7",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            //quitar el disabled
            $('#imagenAsociacion').removeAttr('disabled');
            $('#boton-guardar-asociacion').removeAttr('disabled');
            //Quitar la caja
            button.parent().parent().remove();
            //Respuesta
            mensaje_success('#mensajes-asociacion', response.mensaje);
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;
            //Respuesta
            if (event.status === 422){
                mensaje_error('#mensajes-asociacion', response.mensaje, response.error.mensajes)
            }else {
                mensaje_error('#mensajes-asociacion', response.mensaje)
            }

            //Si es validación por formulario
            if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
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
        // Pace.start();
        var btn = '#boton-guardar-idioma';
        boton_guardar_cargando(btn);

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
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                if (response.items_max)
                {
                    $('#idioma').prop('disabled', true);
                    $(btn).prop('disabled', true);
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
                //Respuesta
                mensaje_success('#mensaje-idioma', response.mensaje);
            },
            error: function (event) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                var response = event.responseJSON;

                //Respuesta
                if (event.status === 422){
                    mensaje_error('#mensaje-idioma', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensaje-idioma', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});

$('#lista-idioma').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    // Pace.start();

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
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            //quitar el disabled
            $('#idioma').removeAttr('disabled');
            $('#boton-guardar-idioma').removeAttr('disabled');

            //Quitar la caja
            button.parent().parent().remove();
            //Respuesta
            mensaje_success('#mensaje-idioma', response.mensaje);
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            var response = event.responseJSON;

            //Respuesta
            if (event.status === 422){
                mensaje_error('#mensaje-idioma', response.mensaje, response.error.mensajes)
            }else {
                mensaje_error('#mensaje-idioma', response.mensaje)
            }

            //Si es validación por formulario
            if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
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

        // Pace.start();
        var btn = '#boton-guardar-tratamiento';
        boton_guardar_cargando(btn);

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
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                if (response.items_max)
                {
                    $('#imgTratamientoAntes').prop('disabled', true);
                    $('#tituloTrataminetoAntes').prop('disabled', true);
                    $('#descripcionTratamientoAntes').prop('disabled', true);
                    $('#imgTratamientodespues').prop('disabled', true);
                    $('#tituloTrataminetoDespues').prop('disabled', true);
                    $('#descripcionTratamientoDespues').prop('disabled', true);
                    $(btn).prop('disabled', true);
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
                //Respuesta
                mensaje_success('#mensajes-tratamientos', response.mensaje);
            },
            error: function (event) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                var response = event.responseJSON;

                if (response.items_max)
                {
                    $('#imgTratamientoAntes').prop('disabled', true);
                    $('#tituloTrataminetoAntes').prop('disabled', true);
                    $('#descripcionTratamientoAntes').prop('disabled', true);
                    $('#imgTratamientodespues').prop('disabled', true);
                    $('#tituloTrataminetoDespues').prop('disabled', true);
                    $('#descripcionTratamientoDespues').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }
                //Respuesta
                if (event.status === 422){
                    mensaje_error('#mensajes-tratamientos', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-tratamientos', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});

$('#lista-tratamientos').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    // Pace.start();

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
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

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
            //Respuesta
            mensaje_success('#mensajes-tratamientos', response.mensaje);
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            var response = event.responseJSON;

            //Respuesta
            if (event.status === 422){
                mensaje_error('#mensajes-tratamientos', response.mensaje, response.error.mensajes)
            }else {
                mensaje_error('#mensajes-tratamientos', response.mensaje)
            }

            //Si es validación por formulario
            if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
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

        var btn = '#boton-guardar-premio';
        boton_guardar_cargando(btn);

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
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                if (response.items_max)
                {
                    $('#imgPremio').prop('disabled', true);
                    $('#fechaPremio').prop('disabled', true);
                    $('#nombrePremio').prop('disabled', true);
                    $('#descripcionPremio').prop('disabled', true);
                    $(btn).prop('disabled', true);
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
                //Respuesta
                mensaje_success('#mensajes-premios', response.mensaje);
            },
            error: function (event) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);
                var response = event.responseJSON;

                if (response.items_max)
                {
                    $('#imgPremio').prop('disabled', true);
                    $('#fechaPremio').prop('disabled', true);
                    $('#nombrePremio').prop('disabled', true);
                    $('#descripcionPremio').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }
                //Respuesta
                if (event.status === 422){
                    mensaje_error('#mensajes-premios', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-premios', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});

$('#lista-premios').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    // Pace.start();
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
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            //quitar el disabled
            $('#imgPremio').removeAttr('disabled');
            $('#fechaPremio').removeAttr('disabled');
            $('#nombrePremio').removeAttr('disabled');
            $('#descripcionPremio').removeAttr('disabled');
            $('#boton-guardar-premio').removeAttr('disabled');
            //Quitar la caja
            button.parent().parent().remove();
            mensaje_success('#mensajes-premios', response.mensaje);
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            //Respuesta
            if (event.status === 422){
                mensaje_error('#mensajes-premios', response.mensaje, response.error.mensajes)
            }else {
                mensaje_error('#mensajes-premios', response.mensaje)
            }

            //Si es validación por formulario
            if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
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

        // Pace.start();
        var btn = '#boton-guardar-publicacion';
        boton_guardar_cargando(btn);

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
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                if (response.items_max)
                {
                    $('#imagePublicacion').prop('disabled', true);
                    $('#nombrePublicacion').prop('disabled', true);
                    $('#descripcionPublicacion').prop('disabled', true);
                    $(btn).prop('disabled', true);
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

                //Respuesta
                mensaje_success('#mensajes-publicacion', response.mensaje);
            },
            error: function (event) {
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                var response = event.responseJSON;

                if (response.items_max)
                {
                    $('#imagePublicacion').prop('disabled', true);
                    $('#nombrePublicacion').prop('disabled', true);
                    $('#descripcionPublicacion').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }
                //Respuesta
                if (event.status === 422){
                    mensaje_error('#mensajes-publicacion', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-publicacion', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});

$('#lista-publicacion').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    // Pace.start();
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
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            //quitar el disabled
            $('#imagePublicacion').removeAttr('disabled');
            $('#nombrePublicacion').removeAttr('disabled');
            $('#descripcionPublicacion').removeAttr('disabled');
            $('#boton-guardar-publicacion').removeAttr('disabled');
            //Quitar la caja
            button.parent().parent().remove();
            //Respuesta
            mensaje_success('#mensajes-publicacion', response.mensaje);
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            //Respuesta
            if (event.status === 422){
                mensaje_error('#mensajes-publicacion', response.mensaje, response.error.mensajes)
            }else {
                mensaje_error('#mensajes-publicacion', response.mensaje)
            }

            //Si es validación por formulario
            if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
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

        var btn = '#boton-guardar-foto';
        boton_guardar_cargando(btn);

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
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                if (response.items_max)
                {
                    $('#imgFoto').prop('disabled', true);
                    $('#fechaFoto').prop('disabled', true);
                    $('#nombreFoto').prop('disabled', true);
                    $('#descripcionFoto').prop('disabled', true);
                    $(btn).prop('disabled', true);
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

                //Respuesta
                mensaje_success('#mensajes-fotos', response.mensaje);
            },
            error: function (event) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                var response = event.responseJSON;

                if (response.items_max)
                {
                    $('#imgFoto').prop('disabled', true);
                    $('#fechaFoto').prop('disabled', true);
                    $('#nombreFoto').prop('disabled', true);
                    $('#descripcionFoto').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                //Respuesta
                if (event.status === 422){
                    mensaje_error('#mensajes-fotos', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-fotos', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});

$('#lista-fotos').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    // Pace.start();
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
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            //quitar el disabled
            $('#imgFoto').removeAttr('disabled');
            $('#fechaFoto').removeAttr('disabled');
            $('#nombreFoto').removeAttr('disabled');
            $('#descripcionFoto').removeAttr('disabled');
            $('#boton-guardar-foto').removeAttr('disabled');
            //Quitar la caja
            button.parent().parent().remove();
            //Respuesta
            mensaje_success('#mensajes-fotos', response.mensaje);
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            //Respuesta
            if (event.status === 422){
                mensaje_error('#mensajes-fotos', response.mensaje, response.error.mensajes)
            }else {
                mensaje_error('#mensajes-fotos', response.mensaje)
            }

            //Si es validación por formulario
            if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
        }
    });

});

$('#formulario-videos').validate({
    rules: {
        'urlVideo': {
            required: true,
        },
        'fechaVideo': {
            required: true,
        },
        'nombreVideo': {
            required: true,
        },
        'descripcionVideo': {
            required: true,
        },
    },
    messages: {
        'urlVideo':{
            required: "Por favor ingrese la url del video",
        },
        'fechaVideo':{
            required: "Por favor ingrese la fecha  del video",
        },
        'nombreVideo':{
            required: "Por favor ingrese el nombre del video",
        },
        'descripcionVideo':{
            required: "Por favor ingrese la descripción del video",
        },
    },
    submitHandler: function(form) {
        // Pace.start();
        var btn = '#boton-guardar-video';
        boton_guardar_cargando(btn);

        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:  "FormularioProfesionalSave13",
            type: "POST",
            data: $('#formulario-videos').serialize(),
            success: function( response ) {
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                if (response.items_max)
                {
                    $('#urlVideo').prop('disabled', true);
                    $('#fechaVideo').prop('disabled', true);
                    $('#nombreVideo').prop('disabled', true);
                    $('#descripcionVideo').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                $('#lista-videos').append('<div class="section_infoExper-formProf">\n' +
                    '<div class="col-12 content_btnDelet-trata-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-id="' + response.id + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="col-12 my-2">\n' +
                    '<div class="img_selccionada-formProf">\n' +
                    '<iframe class="img_anexada-formProf" src="' + $('#urlVideo').val() + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>\n' +
                    '</div>\n' +
                    '<div class="col-12 p-0 mt-2">\n' +
                    '<label class="col-12 text_fechaPremio-formProf"> ' + $('#fechaVideo').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="col-12 text_label-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> ' + $('#nombreVideo').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="col-12 descripcion_Premio-formProf">\n' +
                    '<p class="col-12 text_descPremio-formProf"> ' + $('#descripcionVideo').val() + ' </p>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>');

                document.getElementById("formulario-videos").reset();
                //Respuesta
                mensaje_success('#mensajes-videos', response.mensaje);
            },
            error: function (event) {
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                var response = event.responseJSON;

                if (response.items_max)
                {
                    $('#urlVideo').prop('disabled', true);
                    $('#fechaVideo').prop('disabled', true);
                    $('#nombreVideo').prop('disabled', true);
                    $('#descripcionVideo').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }
                //Respuesta
                if (event.status === 422){
                    mensaje_error('#mensajes-videos', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-videos', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});

$('#lista-videos').on('click', '.close' , function (e) {
    var button = $(this);
    var id = $(this).data('id');

    // Pace.start();
    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  "FormularioProfesionaldelete13",
        type: "POST",
        dataType: 'json',
        data: {id:id},
        success: function( response ) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            //quitar el disabled
            $('#urlVideo').removeAttr('disabled');
            $('#fechaVideo').removeAttr('disabled');
            $('#nombreVideo').removeAttr('disabled');
            $('#descripcionVideo').removeAttr('disabled');
            $('#boton-guardar-video').removeAttr('disabled');

            //Quitar la caja
            button.parent().parent().remove();
            //Respuesta
            mensaje_success('#mensajes-videos', response.mensaje);
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            //Respuesta
            if (event.status === 422){
                mensaje_error('#mensajes-videos', response.mensaje, response.error.mensajes)
            }else {
                mensaje_error('#mensajes-videos', response.mensaje)
            }

            //Si es validación por formulario
            if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
        }
    });

});

/*------------------------------ Fin Sexta Parte del Formulario Perfil Profesional------------------------------*/

$('#form-password-profesional').validate({
    rules: {
        'password': {
            required: true,
        },
        'password_new': {
            required: true,
        },
        'password_new_confirmation': {
            required: true,
        }
    },
    messages: {
        'password':{
            required: "Por favor ingrese la contraseña actual",
        },
        'password_new':{
            required: "Por favor ingrese la contraseña nueva",
        },
        'password_new_confirmation':{
            required: "Por favor repita la contraseña actual",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-password-profesional';
        boton_guardar_cargando(btn);
        var formulario = $(form);
        //console.log(formulario.attr('action'));
        //Ajax
        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var data = new FormData(formulario[0]);

        $.ajax({
            url:  formulario.attr('action'),
            type: "post",
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            dataType: 'json',
            success: function( response ) {

                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                mensaje_success('#mensajes-password', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;

                if (event.status === 422){
                    mensaje_error('#mensajes-password', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-password', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
