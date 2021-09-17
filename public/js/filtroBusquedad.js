ruta='https://zaabrasalud.co/';
$(function(){
    var filtro = $("#filtro");
    filtro.click(function (e){
        var filtro = $(this);
        filtro.autocomplete( "search", filtro.val() );
    }).autocomplete({
        autoFocus: true,
        minLength: 0,
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
        var btn = "<a href='"  + item.url + "'><i class='" + item.icon + " my-auto'></i>" +item.label +"</a>";

        if (item.type)
        {
            btn = "<a href='"  + item.url + "'><i class='" + item.icon + " my-auto'></i>" +item.label +" <br> <span>" +item.type +"</span></a>";
        }
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( btn )
            .appendTo( ul );

    }
});


$(function(){
    var filtro = $("#filtro2");

    filtro.click(function (e){
        var filtro = $(this);
        filtro.autocomplete( "search", filtro.val() );
    }).autocomplete({
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
        var btn = "<a href='"  + item.url + "'><i class='" + item.icon + "'></i>" +item.label +"</a>";

        if (item.type)
        {
            btn = "<a href='"  + item.url + "'><i class='" + item.icon + "'></i>" +item.label +" <br> <span>" +item.type +"</span></a>";
        }
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( "<a href='"  + item.url + "'><i class='" + item.icon + "'></i>" +item.label +"</a>" )
            .appendTo( ul );

    }
});











