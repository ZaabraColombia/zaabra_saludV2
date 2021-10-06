/*-------------------------- Funciones ------------------------*/
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

$('.especialidades-search').select2({
    theme: "bootstrap",
    placeholder: 'Seleccione una especialidad',
    ajax: {
        url: '/buscar-especialidades',
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


/*-------------------------- Selección ubicación*/
$('#pais').change(function(){
    var id_pais = $(this).val();
    if(id_pais){
        $.ajax({
            type:"GET",
            url:"get-Departamento?id_pais="+id_pais,
            success:function(res){
                console.log(res);
                if(res){
                    $("#departamento").empty();
                    $("#departamento").append('<option value=" ">Seleccione departamento</option>');
                    $.each(res,function(key){
                        $("#departamento").append('<option value="'+res[key].id_departamento+'">'+res[key].nombre+'</option>');
                    });
                }else{
                    $("#departamento").empty();
                }
            }
        });
    }else{
        $("#departamento").empty();
    }
});

$('#departamento').on('change',function(){
    var id_departamento = $(this).val();
    if(id_departamento){
        $.ajax({
            type:"GET",
            url:"get-Provincia?id_departamento="+id_departamento,
            success:function(res){
                console.log(res);
                if(res){
                    $("#provincia").empty();
                    $("#provincia").append('<option value=" ">Seleccione provincia</option>');
                    $.each(res,function(key,value){
                        $("#provincia").append('<option value="'+res[key].id_provincia+'">'+res[key].nombre+'</option>');
                    });
                }else{
                    $("#provincia").empty();
                }
            }
        });
    }else{
        $("#provincia").empty();
    }

});

$('#provincia').on('change',function(){
    var id_provincia = $(this).val();

    if(id_provincia){
        $.ajax({
            type:"GET",
            url:"get-Ciudad?id_provincia="+id_provincia,
            success:function(res){
                console.log(res);
                if(res){
                    $("#municipio").empty();
                    $("#municipio").append('<option value=" ">Seleccione ciudad</option>');
                    $.each(res,function(key,value){
                        $("#municipio").append('<option value="'+res[key].id_municipio+'">'+res[key].nombre+'</option>');
                    });

                }else{
                    $("#municipio").empty();
                }
            }
        });
    }else{
        $("#municipio").empty();
    }

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
/*-------------------------- Formularios ----------------------*/
//Formulario 1
$('#form-basico-institucional').validate({
    rules: {
        'nombre_institucion': {
            required: true,
        },
        'fecha_inicio_institucion': {
            required: true,
        },
        'url_institucion': {
            required: true,
        },
        'tipo_institucion': {
            required: true,
        },
    },
    messages: {
        'nombre_institucion':{
            required: "Por favor ingrese el nombre de la institución",
        },
        'fecha_inicio_institucion':{
            required: "Por favor ingrese la fecha de la institución",
        },
        'url_institucion':{
            required: "Por favor ingrese la url de la institución",
        },
        'tipo_institucion':{
            required: "Por favor ingrese el tipo de la institución",
        },
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-basico-institucional';
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
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                mensaje_success('#mensajes-basico', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;

                if (event.status === 422){
                    mensaje_error('#mensajes-basico', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-basico', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
//Formulario 2
$('#form-contacto-institucional').validate({
    rules: {
        'celular': {
            required: true,
        },
        'telefono': {
            required: true,
        },
        'direccion': {
            required: true,
        },
        'pais': {
            required: true,
        },
        'departamento': {
            required: true,
        },
        'provincia': {
            required: true,
        },
        'municipio': {
            required: true,
        },
    },
    messages: {
        'celular':{
            required: "Por favor ingrese el celular de la institución",
        },
        'telefono':{
            required: "Por favor ingrese el teléfono de la institución",
        },
        'direccion':{
            required: "Por favor ingrese la dirección de la institución",
        },
        'pais':{
            required: "Por favor ingrese el pais de la institución",
        },
        'departamento':{
            required: "Por favor ingrese el departamento de la institución",
        },
        'provincia':{
            required: "Por favor ingrese la provincia de la institución",
        },
        'municipio':{
            required: "Por favor ingrese el municipio de la institución",
        },
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-contacto-institucion';
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
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                mensaje_success('#mensajes-contacto', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;
                if (event.status === 422){
                    mensaje_error('#mensajes-contacto', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-contacto', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
//Formulario 3
$('#form-descripcion-institucion').validate({
    rules: {
        'descripcion_perfil': {
            required: true,
        }
    },
    messages: {
        'descripcion_perfil':{
            required: "Por favor ingrese la descripción de la institución",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-descripcion-institucional';
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
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                mensaje_success('#mensajes-descripcion', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;
                if (event.status === 422){
                    mensaje_error('#mensajes-descripcion', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-descripcion', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
//Formulario 4
//Agregar nueva sede
var count_sedes = 0;
$('#btn-agregar-servicio-institucion').click(function () {
    count_sedes++;
    $('#sedes-servicios-institucion').append('<div class="input-group mb-3">\n' +
        '<input type="text" class="form-control input_servicios_institucion" placeholder="Nombre de la sede" id="sucursal_servicio-' + count_sedes + '" name="sucursal_servicio[' + count_sedes + ']">\n' +
        '<div class="input-group-append">\n' +
        '<button class="btn btn-outline-primary btn-eliminar-servicio-institucion" type="button"><i class="fas fa-trash"></i></button>\n' +
        '</div>\n' +
        '</div>');
});
//Eliminar sede nueva
$('#sedes-servicios-institucion').on('click', '.btn-eliminar-servicio-institucion', function () {
    var button = $(this);
    button.parent().parent().remove();
});
//Guardar servicio
$('#form-servicios-institucion').validate({
    rules: {
        'titulo_servicio': {
            required: true,
        },
        'descripcion_servicio': {
            required: true,
        },
        'sucursal_servicio[]': {
            required: true,
        }
    },
    messages: {
        'titulo_servicio':{
            required: "Por favor ingrese el celular de la institución",
        },
        'descripcion_servicio':{
            required: "Por favor ingrese el teléfono de la institución",
        },
        'sucursal_servicio[]':{
            required: "Por favor ingrese las sedes donde prestan el servicio",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-servicio-institucion';
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
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                /* agregar ficha */
                //Traer la lista
                var lista = '';
                $('.input_servicios_institucion').each(function () {
                    lista += '<li>' + $(this).val() + '</li>';
                });
                $('#lista-servicios-institucion').append('<div class="savedData_formInst">\n' +
                    '<div class="col-12 content_cierreX-formInst">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-url="' + response.url + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label for="example-date-input" class="col-12 title_infoGuardada-formProf"> Título del servicio </label>\n' +
                    '<label class="col-12 text_infoGuardada-formProf">' + $('#titulo_servicio').val() + '</label>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label for="example-date-input" class="col-12 title_infoGuardada-formProf"> Descripción </label>\n' +
                    '<label class="col-12 text_infoGuardada-formProf">' + $('#descripcion_servicio').val() + '</label>\n' +
                    '</div>\n' +
                    '<div class="option_consulta-formProf">\n' +
                    '<label for="example-date-input" class="col-12 title_infoGuardada-formProf"> Sedes en la que está el servicio </label>\n' +
                    '<ul>' + lista + '</ul>\n' +
                    '</div>\n' +
                    '</div>');

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#titulo_servicio').prop('disabled', true);
                    $('#descripcion_servicio').prop('disabled', true);
                    $('#sucursal_servicio-0').prop('disabled', true);
                    $('#btn-agregar-servicio-institucion').prop('disabled', true);
                }

                //limpiar formulario
                $('#sedes-servicios-institucion').children().each(function (index, elemte) {
                    if (index >= 2) $(this).remove();
                });
                formulario[0].reset();


                //Respuesta
                mensaje_success('#mensajes-servicios', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
               boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;
                if (event.status === 422){
                    mensaje_error('#mensajes-servicios', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-servicios', response.mensaje)
                }

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#titulo_servicio').prop('disabled', true);
                    $('#descripcion_servicio').prop('disabled', true);
                    $('#sucursal_servicio-0').prop('disabled', true);
                    $('#btn-agregar-servicio-institucion').prop('disabled', true);
                    $('#btn-guardar-servicio-institucion').prop('disabled', true);
                    //limpiar formulario
                    $('#sedes-servicios-institucion').children().each(function (index, elemte) {
                        if (index >= 2) $(this).remove();
                    });
                    formulario[0].reset();
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
//Eliminar servicio
$('#lista-servicios-institucion').on('click', '.close' , function (e) {
    var button = $(this);
    var url = $(this).data('url');

    // Pace.start();
    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  url,
        type: "get",
        dataType: 'json',
        success: function( response ) {
            //Finaliza la carga
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            mensaje_success('#mensajes-servicios', response.mensaje);

            //quitar el disabled
            $('#titulo_servicio').prop('disabled', false);
            $('#descripcion_servicio').prop('disabled', false);
            $('#sucursal_servicio-0').prop('disabled', false);
            $('#btn-agregar-servicio-institucion').prop('disabled', false);
            $('#btn-guardar-servicio-institucion').prop('disabled', false);
            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            mensaje_error('#mensajes-servicios', response.mensaje);
        }
    });

});
//Formulario 5
$('#form-quienes-somos-institucion').validate({
    rules: {
        'descripcion_quienes_somos': {
            required: true,
        }
    },
    messages: {
        'descripcion_quienes_somos':{
            required: "Por favor ingrese la descripción de quienes somos",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-quienes-somo-institucion';
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
                //Finaliza la carga
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                mensaje_success('#mensajes-quienes-somos', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;
                if (event.status === 422){
                    mensaje_error('#mensajes-quienes-somos', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-quienes-somos', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
//Formulario 6
$('#form-propuesta-valor-institucion').validate({
    rules: {
        'propuesta_valor': {
            required: true,
        }
    },
    messages: {
        'propuesta_valor':{
            required: "Por favor ingrese la descripción de quienes somos",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-propuesta-valor-institucion';
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
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                mensaje_success('#mensajes-propuesta-valor', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;
                if (event.status === 422){
                    mensaje_error('#mensajes-propuesta-valor', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-propuesta-valor', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
//Formulario 7
//Agregar convenio
$('#form-convenios-institucion').validate({
    rules: {
        'tipo_convenio': {
            required: true,
        },
        'logo_convenio': {
            required: true,
        }
    },
    messages: {
        'tipo_convenio':{
            required: "Por favor ingrese el tipo de convenio",
        },
        'logo_convenio':{
            required: "Por favor ingrese el logo del convenio",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-convenios-institucion';
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
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Agrgar tarjeta del convenio
                $('#lista-convenios-institucion').append('<div class="col-md-3 col-sm-6">\n' +
                    '<div class="col-12 content_btnX-cierre-formProf my-2">\n' +
                    '<label for="example-date-input" class="text_saved-formInst pb-0"> Convenio ' + $('#tipo_convenio option:selected').text() + '</label>\n' +
                    '<button type="button" class="close" aria-label="Close" data-url="' + response.url + '"><span aria-hidden="true">&times;</span></button>\n' +
                    '</div>\n' +
                    '<div class="option_asociacion-formProf">\n' +
                    '<img class="img_guardada-formProf" id="imagenPrevisualizacion" src="' + response.image + '">\n' +
                    '</div>\n' +
                    '</div>');

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#tipo_convenio').prop('disabled', true);
                    $('#logo_convenio').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                $('#img-logo_convenio').attr('src', '#');
                formulario[0].reset();

                //Respuesta
                mensaje_success('#mensajes-convenios', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#tipo_convenio').prop('disabled', true);
                    $('#logo_convenio').prop('disabled', true);
                    $(btn).prop('disabled', true);
                    $('#img-logo_convenio').attr('scr', '#');
                    formulario[0].reset();
                }

                if (event.status === 422){
                    mensaje_error('#mensajes-convenios', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-convenios', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
//Eliminar convenio
$('#lista-convenios-institucion').on('click', '.close' , function (e) {
    var button = $(this);
    var url = $(this).data('url');

    // Pace.start();
    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  url,
        type: "get",
        dataType: 'json',
        success: function( response ) {
            //Finaliza la carga
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            mensaje_success('#mensajes-convenios', response.mensaje);

            //quitar el disabled
            $('#tipo_convenio').prop('disabled', false);
            $('#logo_convenio').prop('disabled', false);
            $('#btn-guardar-convenios-institucion').prop('disabled', false);
            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            mensaje_error('#mensajes-convenios', response.mensaje);
        }
    });

});
//Formulario 8
//Agregar profesional
$('#form-profesionales-institucion').validate({
    rules: {
        'foto_profecional': {
            required: true,
        },
        'primer_nombre_profecional': {
            required: true,
        },
        'primer_apellido_profecional': {
            required: true,
        },
        'universidad': {
            required: true,
        },
        'especialidad': {
            required: true,
        }
    },
    messages: {
        'foto_profecional':{
            required: "Por favor ingrese la foto del profesional",
        },
        'primer_nombre_profecional':{
            required: "Por favor ingrese el primer nombre del profesional",
        },
        'primer_apellido_profecional':{
            required: "Por favor ingrese el primer apellido del profesional",
        },
        'universidad':{
            required: "Por favor ingrese la universidad del profesional",
        },
        'especialidad':{
            required: "Por favor ingrese la especialidad del profesional",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-profecionales-institucion';
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
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Agrgar tarjeta del convenio
                $('#lista-profesionales-institucion').append('<div class="col-md-3 content_loadImg-profes">\n' +
                    '<div class="col-12 p-0 contain_imgUsuario-formImg">\n' +
                    '<div class="col-12 pr-2 content_cierreX-formInst">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-url="' + response.url + '">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>\n' +
                    '<div class="col-12 col-md-10 img_save-formProf">\n' +
                    '<img class="img_usuario-formInst" src="' + response.image + '">\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '<div class="col-12 mt-3 containt_loadProfes-formInst">\n' +
                    '<div class="col-md-12 rightSection_formInst">\n' +
                    '<span>' + $('#primer_nombre_profecional').val() + ' ' + $('#segundo_nombre_profecional').val() + '</span>\n' +
                    '</div>\n' +
                    '<div class="col-md-12 rightSection_formInst">\n' +
                    '<span>' + $('#primer_apellido_profecional').val() + ' ' + $('#segundo_apellido_profecional').val() + '</span>\n' +
                    '</div>\n' +
                    '<div class="col-md-12 rightSection_formInst">\n' +
                    '<span>' + $('#universidad option:selected').text() + '</span>\n' +
                    '</div>\n' +
                    '<div class="col-md-12 rightSection_formInst">\n' +
                    '<span>' + $('#especialidad option:selected').text() + '</span>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>');

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#foto_profecional').prop('disabled', true);
                    $('#primer_nombre_profecional').prop('disabled', true);
                    $('#segundo_nombre_profecional').prop('disabled', true);
                    $('#primer_apellido_profecional').prop('disabled', true);
                    $('#segundo_apellido_profecional').prop('disabled', true);
                    $('#universidad').prop('disabled', true);
                    $('#especialidad').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                $('#img-foto_profecional').attr('src', '#');
                formulario[0].reset();

                //Respuesta
                mensaje_success('#mensajes-profesionales', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#foto_profecional').prop('disabled', true);
                    $('#primer_nombre_profecional').prop('disabled', true);
                    $('#segundo_nombre_profecional').prop('disabled', true);
                    $('#primer_apellido_profecional').prop('disabled', true);
                    $('#segundo_apellido_profecional').prop('disabled', true);
                    $('#universidad').prop('disabled', true);
                    $('#especialidad').prop('disabled', true);
                    $(btn).prop('disabled', true);
                    $('#img-foto_profecional').attr('scr', '#');
                    formulario[0].reset();
                }

                if (event.status === 422){
                    mensaje_error('#mensajes-profesionales', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-profesionales', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
//Eliminar profesional
$('#lista-profesionales-institucion').on('click', '.close' , function (e) {
    var button = $(this);
    var url = $(this).data('url');

    // Pace.start();
    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  url,
        type: "get",
        dataType: 'json',
        success: function( response ) {
            //Finaliza la carga
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            mensaje_success('#mensajes-profesionales', response.mensaje);

            //quitar el disabled
            $('#foto_profecional').prop('disabled', false);
            $('#primer_nombre_profecional').prop('disabled', false);
            $('#segundo_nombre_profecional').prop('disabled', false);
            $('#primer_apellido_profecional').prop('disabled', false);
            $('#segundo_apellido_profecional').prop('disabled', false);
            $('#universidad').prop('disabled', false);
            $('#especialidad').prop('disabled', false);
            $('#btn-guardar-profecionales-institucion').prop('disabled', false);
            //Quitar la caja
            button.parent().parent().parent().remove();
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            mensaje_error('#mensajes-profesionales', response.mensaje);
        }
    });

});
//Formulario 9
//Agregar certificaciones
$('#form-certificados-institucion').validate({
    rules: {
        'image_certificado': {
            required: true,
        },
        'fecha_certificado': {
            required: true,
        },
        'titulo_certificado': {
            required: true,
        },
        'descripcion_certificacion': {
            required: true,
        }
    },
    messages: {
        'image_certificado':{
            required: "Por favor ingrese la imagen del certificado",
        },
        'fecha_certificado':{
            required: "Por favor ingrese la fecha del certificado",
        },
        'titulo_certificado':{
            required: "Por favor ingrese el titulo del certificado",
        },
        'descripcion_certificacion':{
            required: "Por favor ingrese la descripción del certificado",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-certificado-institucion';
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
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Agrgar tarjeta del convenio
                $('#lista-certificaciones-institucion').append('<div class="col-md-6">\n' +
                    '<div class="col-12 content_btnDelet-trata-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-url="' + response.url + '">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>\n' +
                    '<div class="col-12 mt-2 p-0">\n' +
                    '<div class="img_saveCertifi-formInst">\n' +
                    '<img class="img_anexada-formInst"  src="' + response.image + '">\n' +
                    '</div>\n' +
                    '<div class="col-12 p-0 mt-2">\n' +
                    '<label class="col-12 text_fechaPremio-formProf"> ' + $('#fecha_certificado').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="col-12 text_label-formProf">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> ' + $('#titulo_certificado').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="col-12 descripcion_Premio-formProf">\n' +
                    '<label class="col-12 text_descPremio-formProf"> ' + $('#descripcion_certificacion').val() + ' </label>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>');

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#image_certificado').prop('disabled', true);
                    $('#fecha_certificado').prop('disabled', true);
                    $('#titulo_certificado').prop('disabled', true);
                    $('#descripcion_certificacion').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                $('#img-image_certificado').attr('src', '#');
                formulario[0].reset();

                //Respuesta
                mensaje_success('#mensajes-certificaciones', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#image_certificado').prop('disabled', true);
                    $('#fecha_certificado').prop('disabled', true);
                    $('#titulo_certificado').prop('disabled', true);
                    $('#descripcion_certificacion').prop('disabled', true);
                    $(btn).prop('disabled', true);
                    $('#img-image_certificado').attr('scr', '#');
                    formulario[0].reset();
                }

                if (event.status === 422){
                    mensaje_error('#mensajes-certificaciones', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-certificaciones', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
//Eliminar certificado
$('#lista-certificaciones-institucion').on('click', '.close' , function (e) {
    var button = $(this);
    var url = $(this).data('url');

    // Pace.start();
    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  url,
        type: "get",
        dataType: 'json',
        success: function( response ) {
            //Finaliza la carga
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            mensaje_success('#mensajes-certificaciones', response.mensaje);

            //quitar el disabled
            $('#image_certificado').prop('disabled', false);
            $('#fecha_certificado').prop('disabled', false);
            $('#titulo_certificado').prop('disabled', false);
            $('#descripcion_certificacion').prop('disabled', false);
            $('#btn-guardar-certificado-institucion').prop('disabled', false);
            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            mensaje_error('#mensajes-certificaciones', response.mensaje);
        }
    });
});
//Formulario 10
//Agregar sede
$('#form-sedes-institucion').validate({
    rules: {
        'img_sede': {
            required: true,
        },
        'nombre_sede': {
            required: true,
        },
        'direccion_sede': {
            required: true,
        },
        'horario_sede': {
            required: true,
        },
        'telefono_sede': {
            required: true,
        },
        'url_mapa_sede': {
            required: true,
        }
    },
    messages: {
        'img_sede':{
            required: "Por favor ingrese la imagen de la sede",
        },
        'nombre_sede':{
            required: "Por favor ingrese el nombre de la sede",
        },
        'direccion_sede':{
            required: "Por favor ingrese la dirección de la sede",
        },
        'horario_sede':{
            required: "Por favor ingrese el horario de la sede",
        },
        'telefono_sede':{
            required: "Por favor ingrese el teléfono de la sede",
        },
        'url_mapa_sede':{
            required: "Por favor ingrese la url de la ubicación de la sede",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-sede-institucion';
        boton_guardar_cargando(btn);
        var formulario = $(form);

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
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Agrgar tarjeta del convenio
                $('#lista-sedes-institucion').append('<div class="savedData_formInst">\n' +
                    '<div class="col-12 content_btnDelet-trata-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-url="' + response.url + '">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>\n' +
                    '<div class="col-12 mt-2 p-0">\n' +
                    '<div class="img_saveSede-formInst">\n' +
                    '<img class="img_anexada-formInst" src="' + response.image + '">\n' +
                    '</div>\n' +
                    '<div class="col-12 text_label-formInst">\n' +
                    '<label class="col-12 title_infoGuardada-formProf">' + $('#nombre_sede').val() + '</label>\n' +
                    '</div>\n' +
                    '<div class="col-12 texto_saved-formInst">\n' +
                    '<label class="col-12 text_descPremio-formProf">' + $('#direccion_sede').val() + '</label>\n' +
                    '</div>\n' +
                    '<div class="col-12 texto_saved-formInst">\n' +
                    '<label class="col-12 text_descPremio-formProf">' + $('#horario_sede').val() + '</label>\n' +
                    '</div>\n' +
                    '<div class="col-12 texto_saved-formInst">\n' +
                    '<label class="col-12 text_descPremio-formProf">' + $('#telefono_sede').val() + '</label>\n' +
                    '</div>\n' +
                    '<div class="col-12 texto_saved-formInst">\n' +
                    '<label class="col-12 text_descPremio-formProf">' + $('#url_mapa_sede').val() + '</label>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>');

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#img_sede').prop('disabled', true);
                    $('#nombre_sede').prop('disabled', true);
                    $('#direccion_sede').prop('disabled', true);
                    $('#horario_sede').prop('disabled', true);
                    $('#telefono_sede').prop('disabled', true);
                    $('#url_mapa_sede').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                $('#img-img_sede').attr('src', '#');
                formulario[0].reset();

                //Respuesta
                mensaje_success('#mensajes-sedes', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#img_sede').prop('disabled', true);
                    $('#nombre_sede').prop('disabled', true);
                    $('#direccion_sede').prop('disabled', true);
                    $('#horario_sede').prop('disabled', true);
                    $('#telefono_sede').prop('disabled', true);
                    $('#url_mapa_sede').prop('disabled', true);
                    $(btn).prop('disabled', true);
                    $('#img-img_sede').attr('scr', '#');
                    formulario[0].reset();
                }

                if (event.status === 422){
                    mensaje_error('#mensajes-sedes', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-sedes', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
//Eliminar sede
$('#lista-sedes-institucion').on('click', '.close' , function (e) {
    var button = $(this);
    var url = $(this).data('url');

    // Pace.start();
    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  url,
        type: "get",
        dataType: 'json',
        success: function( response ) {
            //Finaliza la carga
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            mensaje_success('#mensajes-sedes', response.mensaje);

            //quitar el disabled
            $('#img_sede').prop('disabled', false);
            $('#nombre_sede').prop('disabled', false);
            $('#direccion_sede').prop('disabled', false);
            $('#horario_sede').prop('disabled', false);
            $('#telefono_sede').prop('disabled', false);
            $('#url_mapa_sede').prop('disabled', false);
            $('#btn-guardar-sede-institucion').prop('disabled', false);
            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            mensaje_error('#mensajes-sedes', response.mensaje);
        }
    });
});
//Formulario 12
//Agregar gaelria
$('#form-galeria-institucion').validate({
    rules: {
        'img_galeria_institucion': {
            required: true,
        },
        'fecha_galeria_institucion': {
            required: true,
        },
        'nombre_galeria_institucion': {
            required: true,
        },
        'descripcion_galeria_institucion': {
            required: true,
        },
        '': {
            required: true,
        }
    },
    messages: {
        'img_galeria_institucion':{
            required: "Por favor ingrese la imagen",
        },
        'fecha_galeria_institucion':{
            required: "Por favor ingrese la fecha de la imagen",
        },
        'nombre_galeria_institucion':{
            required: "Por favor ingrese el titulo de la imagen",
        },
        'descripcion_galeria_institucion':{
            required: "Por favor ingrese la descripción de la imagen",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-galeria-institucion';
        boton_guardar_cargando(btn);
        var formulario = $(form);

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
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Agrgar tarjeta del convenio
                $('#lista-galeria-intitucion').append('<div class="savedData_formInst">\n' +
                    '<div class="col-12 content_btnDelet-trata-formProf">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-url="' + response.url + '">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>\n' +
                    '<div class="col-12 mt-2 p-0">\n' +
                    '<div class="img_saveSede-formInst">\n' +
                    '<img  class="img_anexada-formInst" src="' + response.image + '">\n' +
                    '</div>\n' +
                    '<div class="col-12 text_label-formInst">\n' +
                    '<label class="col-12 title_infoGuardada-formProf">' + $('#fecha_galeria_institucion').val() + '</label>\n' +
                    '</div>\n' +
                    '<div class="col-12 text_label-formInst">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> ' + $('#nombre_galeria_institucion').val() + '</label>\n' +
                    '</div>\n' +
                    '<div class="col-12 descripcion_Premio-formProf">\n' +
                    '<label class="col-12 text_descPremio-formProf">' + $('#descripcion_galeria_institucion').val() + '</label>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>');

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#img_galeria_institucion').prop('disabled', true);
                    $('#fecha_galeria_institucion').prop('disabled', true);
                    $('#nombre_galeria_institucion').prop('disabled', true);
                    $('#descripcion_galeria_institucion').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }

                $('#img-img_galeria_institucion').attr('src', '#');
                formulario[0].reset();

                //Respuesta
                mensaje_success('#mensajes-galeria', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#img_galeria_institucion').prop('disabled', true);
                    $('#fecha_galeria_institucion').prop('disabled', true);
                    $('#nombre_galeria_institucion').prop('disabled', true);
                    $('#descripcion_galeria_institucion').prop('disabled', true);
                    $(btn).prop('disabled', true);
                    $('#img-img_galeria_institucion').attr('scr', '#');
                    formulario[0].reset();
                }

                if (event.status === 422){
                    mensaje_error('#mensajes-galeria', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-galeria', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
//Eliminar galeria
$('#lista-galeria-intitucion').on('click', '.close' , function (e) {
    var button = $(this);
    var url = $(this).data('url');

    // Pace.start();
    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  url,
        type: "get",
        dataType: 'json',
        success: function( response ) {
            //Finaliza la carga
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            mensaje_success('#mensajes-galeria', response.mensaje);

            //quitar el disabled
            $('#img_galeria_institucion').prop('disabled', false);
            $('#fecha_galeria_institucion').prop('disabled', false);
            $('#nombre_galeria_institucion').prop('disabled', false);
            $('#descripcion_galeria_institucion').prop('disabled', false);
            $('#btn-guardar-galeria-institucion').prop('disabled', false);
            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            mensaje_error('#mensajes-galeria', response.mensaje);
        }
    });
});
//Formulario 11
$('#form-ubicaion-institucion').validate({
    rules: {
        'url_map_principal_institucion': {
            required: true,
        }
    },
    messages: {
        'url_map_principal_institucion':{
            required: "Por favor ingrese la url de la ubicación de su sede principal",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-ubicacion-institucion';
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
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Agregar la url al iframe
                var url = $('#url_map_principal_institucion').val();
                var map = $('#map_principal_institucion');
                map.attr('src', url);
                map.parent().removeClass('d-none');

                //Respuesta
                mensaje_success('#mensajes-ubicacion-institucion', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;
                if (event.status === 422){
                    mensaje_error('#mensajes-ubicacion-institucion', response.mensaje, response.error.mensajes)
                }else {
                    mensaje_error('#mensajes-ubicacion-institucion', response.mensaje)
                }

                //Si es validación por formulario
                if (response.error.ids !== undefined && response.error.ids !== null) id_invalid(response.error.ids, event.status);
            }
        });
    }
});
//Formulario 13
//Agregar video
$('#form-videos-institucion').validate({
    rules: {
        'url_video_institucion': {
            required: true,
        },
        'fecha_video_institucion': {
            required: true,
        },
        'nombre_video_institucion': {
            required: true,
        },
        'descripcion_video_institucion': {
            required: true,
        }
    },
    messages: {
        'url_video_institucion':{
            required: "Por favor ingrese la url del video",
        },
        'fecha_video_institucion':{
            required: "Por favor ingrese la fecha del video",
        },
        'nombre_video_institucion':{
            required: "Por favor ingrese el titulo del video",
        },
        'descripcion_video_institucion':{
            required: "Por favor ingrese la descripción del video",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-video-institucion';
        boton_guardar_cargando(btn);
        var formulario = $(form);

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
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Agrgar tarjeta del convenio
                $('#lista-videos-institucion').append('<div class="section_infoExper-formInst">\n' +
                    '<div class="col-12 content_cierreX-formInst">\n' +
                    '<button type="submit" class="close" aria-label="Close" data-url="' + response.url + '">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</div>\n' +
                    '<div class="col-12 my-2">\n' +
                    '<div class="col-10 img_selccionada-formProf">\n' +
                    '<iframe class="img_anexada-formProf" src="' + $('#url_video_institucion').val() + '" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>\n' +
                    '</div>\n' +
                    '<div class="col-12 p-0 mt-2">\n' +
                    '<label class="col-12 text_fechaPremio-formProf"> ' + $('#fecha_video_institucion').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="col-12 text_label-formInst">\n' +
                    '<label class="col-12 title_infoGuardada-formProf"> ' + $('#nombre_video_institucion').val() + ' </label>\n' +
                    '</div>\n' +
                    '<div class="col-12 descripcion_Premio-formProf">\n' +
                    '<p class="col-12 text_descPremio-formProf"> ' + $('#descripcion_video_institucion').val() + ' </p>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>');

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#url_video_institucion').prop('disabled', true);
                    $('#fecha_video_institucion').prop('disabled', true);
                    $('#nombre_video_institucion').prop('disabled', true);
                    $('#descripcion_video_institucion').prop('disabled', true);
                    $(btn).prop('disabled', true);
                }
                formulario[0].reset();

                //Respuesta
                mensaje_success('#mensajes-videos', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                boton_guardar(btn);

                //Respuesta
                var response = event.responseJSON;

                /* Deshabilitar formulario cuando llegue al maximo de items */
                if (response.max_items > 0) {
                    $('#url_video_institucion').prop('disabled', true);
                    $('#fecha_video_institucion').prop('disabled', true);
                    $('#nombre_video_institucion').prop('disabled', true);
                    $('#descripcion_video_institucion').prop('disabled', true);
                    $(btn).prop('disabled', true);
                    formulario[0].reset();
                }

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
//Eliminar video
$('#lista-videos-institucion').on('click', '.close' , function (e) {
    var button = $(this);
    var url = $(this).data('url');

    // Pace.start();
    $.ajaxSetup({
        /*Se anade el token al ajax para seguridad*/
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:  url,
        type: "get",
        dataType: 'json',
        success: function( response ) {
            //Finaliza la carga
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');

            mensaje_success('#mensajes-videos', response.mensaje);

            //quitar el disabled
            $('#url_video_institucion').prop('disabled', false);
            $('#fecha_video_institucion').prop('disabled', false);
            $('#nombre_video_institucion').prop('disabled', false);
            $('#descripcion_video_institucion').prop('disabled', false);
            $('#btn-guardar-video-institucion').prop('disabled', false);
            //Quitar la caja
            button.parent().parent().remove();
        },
        error: function (event) {
            // Pace.stop();
            $('.form-control').removeClass('is-invalid');
            var response = event.responseJSON;

            mensaje_error('#mensajes-videos', response.mensaje);
        }
    });
});
