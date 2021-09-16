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

$('#form-basico-paciente').validate({
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
