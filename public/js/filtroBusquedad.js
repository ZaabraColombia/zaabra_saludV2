ruta='https://zaabrasalud.co/';
$(function(){
    var filtro = $("#filtro");
    filtro.autocomplete({
        autoFocus: true,
        source: function(request, response) {
            $.ajax({
                url: filtro.data('url'),
                dataType: "json",
                contentType: 'application/json',
                type: 'get',
                data: {
                    term: request.term
                },
                success: function( data ) {
                    response( data );
                }
            });
        },
        select: function (event, ui) {
            var barra = $('#barra_busqueda');
            barra.val(ui.item.id); // save selected id to input
            // Set selection
            barra.keypress(function(e){
                var keycode = (e.keyCode ? e.keyCode : e.which);
                if (keycode === '13') {
                    e.preventDefault();
                    window.location = ui.item.url;
                }
            });

        }
    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( "<a href='"  + item.url + "'><i class='" + item.icon + "'></i>" +item.label +"</a>" )
            .appendTo( ul );

    }
});


$(function(){
    var filtro = $("#filtro2");

    filtro.autocomplete({
        autoFocus: true,
        source: function(request, response) {
            $.ajax({
                url: filtro.data('url'),
                dataType: "json",
                contentType: 'application/json',
                type: 'get',
                data: {
                    term: request.term
                },
                success: function( data ) {
                    response( data );
                }
            });
        },

        select: function (event, ui) {
            $('#barra_busqueda2').val(ui.item.id); // save selected id to input
            // Set selection
            $('#barra_busqueda2').keypress(function(e){
                var keycode = (e.keyCode ? e.keyCode : e.which);
                if (keycode == '13') {
                    e.preventDefault();
                    window.location = ui.item.url;
                }
            });

        }
    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( "<a href='"  + item.url + "'>" +item.label +"</a>" )
            .appendTo( ul );

    }
});











