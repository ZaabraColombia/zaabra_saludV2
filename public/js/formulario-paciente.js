/*-------------------------- Funciones ------------------------*/
function mensaje_error(id, mensaje, error) {
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
            url:"/get-Departamento?id_pais="+id_pais,
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
            url:"/get-Provincia?id_departamento="+id_departamento,
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
            url:"/get-Ciudad?id_provincia="+id_provincia,
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

$('#form-basico-paciente').validate({
    rules: {
        'primer_nombre': {
            required: true,
        },
        'primer_apellido': {
            required: true,
        },
        'tipo_documento': {
            required: true,
        },
        'numero_documento': {
            required: true,
        }
    },
    messages: {
        'primer_nombre':{
            required: "Por favor ingrese el primer nombre",
        },
        'primer_apellido':{
            required: "Por favor ingrese el primer apellido",
        },
        'tipo_documento':{
            required: "Por favor ingrese el tipo de identificación",
        },
        'numero_documento':{
            required: "Por favor ingrese el número de identificación",
        }
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-basico-paciente';
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
                mensaje_success('#mensajes-basico', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
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

$('#form-basico-contacto').validate({
    rules: {
        'celular': {
            required: true,
        },
        'telefono': {
            required: true,
        },
        'departamento': {
            required: true,
        },
        'municipio': {
            required: true,
        },
        'eps': {
            required: true,
        }
    },
    messages: {
        'celular':{
            required: "Por favor ingrese el número celular",
        },
        'telefono':{
            required: "Por favor ingrese el número del teléfono fijo",
        },
        'pais':{
            required: "Por favor ingrese el país",
        },
        'departamento':{
            required: "Por favor ingrese el departamento",
        },
        'provincia':{
            required: "Por favor ingrese la provincia",
        },
        'municipio':{
            required: "Por favor ingrese el municipio",
        },
        'eps':{
            required: "Por favor ingrese la eps o regimen médico",
        },
    },
    submitHandler: function(form) {
        //Elementos
        var btn = '#btn-guardar-contacto-paciente';
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
                mensaje_success('#mensajes-contacto', response.mensaje)
            },
            error: function (event) {
                //Finaliza la carga
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

$('#form-password-paciente').validate({
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
        var btn = '#btn-guardar-password-paciente';
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
