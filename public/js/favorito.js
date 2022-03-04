// Función para mostrar y ocultar registros en cada una de las tarjetas de la vista favoritos.bla0de.php agenda pacientes
function registerShow (x){
    let myvar = x.getAttribute('data-position');

    let selector = document.querySelector.bind(document);
    // Condicional para el botón ver más de la tarjeta especialidad favorita
    if (myvar == "mas") {
        $('#vermas').addClass('d-none');
        $('#vermenos').removeClass('d-none');
        $('#tabFav').removeClass('alto_predet');
    }
    else {
        $('#vermenos').addClass('d-none');
        $('#vermas').removeClass('d-none');
        $('#tabFav').addClass('alto_predet');
    }
    // Condicional para el botón ver más de la tarjeta servicio favorito
    if (myvar == "mas_serv") {
        $('#vermas_serv').addClass('d-none');
        $('#vermenos_serv').removeClass('d-none');
        $('#tabFav_serv').removeClass('alto_predet');
    }
    else {
        $('#vermenos_serv').addClass('d-none');
        $('#vermas_serv').removeClass('d-none');
        $('#tabFav_serv').addClass('alto_predet');
    }
    //Condicional para el botón ver más de la tarjeta especialista favorito
    if (myvar == "mas_espec") {
        $('#vermas_espec').addClass('d-none');
        $('#vermenos_espec').removeClass('d-none');
        $('#tabFav_espec').removeClass('alto_predet');
    }
    else {
        $('#vermenos_espec').addClass('d-none');
        $('#vermas_espec').removeClass('d-none');
        $('#tabFav_espec').addClass('alto_predet');
    }
    // Condicional para el botón ver más de la tarjeta instituciones favorito
    if (myvar == "mas_inst") {
        $('#vermas_inst').addClass('d-none');
        $('#vermenos_inst').removeClass('d-none');
        $('#tabFav_inst').removeClass('alto_predet');
    }
    else {
        $('#vermenos_inst').addClass('d-none');
        $('#vermas_inst').removeClass('d-none');
        $('#tabFav_inst').addClass('alto_predet');
    }
}

$('#favorito_especialidad').validate({
    rules: {
        nombre_favorito_especialidad: {
            required: true,
        },
    },
    messages: {
        nombre_favorito_especialidad: {
            required: "Ingrese el nombre de la especialidad",
        },
    },
    submitHandler: function(form) {
        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var formulario = $('#favorito_especialidad');

        /*Se cambia el texto al boton por enviando*/
        $('#guardar_data').html('Guardando..');

        $.ajax({
            url:  formulario.attr('action'),
            type: "POST",
            data: formulario.serialize(),

            success: function(respons) {
                $('#guardar_data').hide();
                $('#nombre_favorito_especialidad').hide();
                $('#message_info').show();
                $('#message_info').html(respons.msg);
                $('#msg_info').removeClass('d-none');
                location.reload()
            }


        });
    }
})


/*function verMas() {
    jQuery(".table_favoritos1").css("height","100%");
    $('#vermas').addClass('d-none');
    $('#vermenos').removeClass('d-none');
}
function verMenos() {
    jQuery(".table_favoritos1").css("height","15vh");
    $('#vermenos').addClass('d-none');
    $('#vermas').removeClass('d-none');
}*/
$('#btnagregar').click (function(e) {
    $('#favorito_especialidad').removeClass('d-none');
    //$('#guardar').removeClass('d-none');

});

/* Remover o div anterior
var campos_max = 3;   //max de 10 campos
var x = 0;
$('#listas').on("click",".remover_campo",function(e) {
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
});*/

// 2. Validación del proceso de guardar registros en la tarjeta servicios favoritos, ubicado en la vista favoritos.blade.php
$('#favorito_servicio').validate({

    rules: {
        nombre_favorito_servicio: {
            required: true,
        },
    },
    messages: {
        nombre_favorito_servicio: {
            required: "Ingrese el nombre del servicio",
        },
    },
    submitHandler: function(form) {

        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formulario = $('#favorito_servicio');

        /*Se cambia el texto al boton por enviando*/
        $('#guardar_data2').html('Guardando..');

        $.ajax({
            url:  formulario.attr('action'),
            type: "POST",
            data: formulario.serialize(),

            success: function(respons) {
                $('#guardar_data2').hide();
                $('#nombre_favorito_servicio').hide();
                /*$('#message_info').show();
                $('#message_info').html(respons.msg);
                $('#msg_info').removeClass('d-none');*/
                location.reload()
            }


        });
    }
})
// Función para la funcionalidad del botón agregar más en la tarjeta servicios favoritos, ubicado en la vista favoritos.blade.php
$('#btnagregar_serv').click (function(e) {
    $('#favorito_servicio').removeClass('d-none');
});


// 3. Validación del proceso de guardar registros en la tarjeta especialidades favoritos, ubicado en la vista favoritos.blade.php
$('#favorito_especialista').validate({

    rules: {
        nombre_favorito_especialista: {
            required: true,
        },
    },
    messages: {
        nombre_favorito_especialista: {
            required: "Ingrese el nombre del especialista",
        },
    },
    submitHandler: function(form) {

        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formulario = $('#favorito_especialista');

        /*Se cambia el texto al boton por enviando*/
        $('#guardar_data3').html('Guardando..');

        $.ajax({
            url:  formulario.attr('action'),
            type: "POST",
            data: formulario.serialize(),

            success: function(respons) {
                $('#guardar_data3').hide();
                $('#nombre_favorito_especialista').hide();
                /*$('#message_info').show();
                $('#message_info').html(respons.msg);
                $('#msg_info').removeClass('d-none');*/
                location.reload()
            }
        });
    }
})

// Función para la funcionalidad del botón agregar más en la tarjeta especialidades favoritos, ubicado en la vista favoritos.blade.php
$('#btnagregar_espec').click (function(e) {
    $('#favorito_especialista').removeClass('d-none');
});

// 4. Validacion del proceso guardar registros en la tarjeta instituciones favoritas, ubicada en la vista favoritos.blade.php
$('#favorito_institucion').validate({

    rules: {
        nombre_favorito_institucion: {
            required: true,
        },
    },
    messages: {
        nombre_favorito_institucion: {
            required: "Ingrese el nombre de la institución",
        },
    },
    submitHandler: function(form) {

        $.ajaxSetup({
            /*Se anade el token al ajax para seguridad*/
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formulario = $('#favorito_institucion');

        /*Se cambia el texto al boton por enviando*/
        $('#guardar_data4').html('Guardando..');

        $.ajax({
            url:  formulario.attr('action'),
            type: "POST",
            data: formulario.serialize(),

            success: function(respons) {
                $('#guardar_data4').hide();
                $('#nombre_favorito_institucion').hide();
                /*$('#message_info').show();
                $('#message_info').html(respons.msg);
                $('#msg_info').removeClass('d-none');*/
                location.reload()
            }
        });
    }
})

// Función para la funcionalidad del botón agregar más en la tarjeta instituciones favoritas, ubicada en la vista favoritos.blade.php
$('#btnagregar_inst').click (function(e) {
    $('#favorito_institucion').removeClass('d-none');
});
