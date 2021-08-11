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

        /*Se cambia el texto al boton por enviando*/
        $('#guardar_data').html('Guardando..');

        $.ajax({
            url:  "favoritosGeneralSave",
            type: "POST",
            data: $('#favorito_especialidad').serialize(),

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

function registerShow (x){
    let myvar = x.getAttribute('data-position');
    
    let selector = document.querySelector.bind(document);

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
}
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
    $('#guardar').removeClass('d-none');
    
});

/* Remover o div anterior   
var campos_max = 3;   //max de 10 campos
var x = 0;
$('#listas').on("click",".remover_campo",function(e) {
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
});*/