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
        $('#btn-guardar-basico-institucional').attr('disabled', 'disabled');
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
                $('#btn-guardar-basico-institucional').removeAttr('disabled');

                //Respuesta
                mensaje_success('#mensajes-basico', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                $('#btn-guardar-basico-institucional').removeAttr('disabled');

                //Respuesta
                var response = event.responseJSON;

                console.log(response);
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
        $('#btn-guardar-contacto-institucion').attr('disabled', 'disabled');
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
                $('#btn-guardar-contacto-institucion').removeAttr('disabled');

                //Respuesta
                mensaje_success('#mensajes-contacto', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                $('#btn-guardar-contacto-institucion').removeAttr('disabled');

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
        $('#btn-guardar-descripcion-institucional').attr('disabled', 'disabled');
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
                $('#btn-guardar-descripcion-institucional').removeAttr('disabled');

                //Respuesta
                mensaje_success('#mensajes-descripcion', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                $('#btn-guardar-contacto-institucion').removeAttr('disabled');

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
        $('#btn-guardar-servicio-institucion').attr('disabled', 'disabled');
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
                $('#btn-guardar-servicio-institucion').prop('disabled', false);

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
                    '<label for="example-date-input" class="col-12 title_infoGuardada-formProf"> Descrpción </label>\n' +
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
                    $('#btn-guardar-servicio-institucion').prop('disabled', true);
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
                $('#btn-guardar-servicio-institucion').prop('disabled', false);

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
        $('#btn-guardar-quienes-somo-institucion').prop('disabled', true);
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
                $('#btn-guardar-quienes-somo-institucion').prop('disabled', false);

                //Respuesta
                mensaje_success('#mensajes-quienes-somos', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
                // Pace.stop();
                $('.form-control').removeClass('is-invalid');
                $('#btn-guardar-quienes-somo-institucion').prop('disabled', false);

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
