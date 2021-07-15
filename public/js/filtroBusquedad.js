ruta='https://zaabrasalud.co';
$(function(){
    $("#filtro").autocomplete({
        autoFocus: true,
    source: function(request, response) {
        $.ajax({
        url: ruta+"search/filtro",
        dataType: "json",
        data: {
            term: request.term
        },
        success: function( data ) {
            response( data );
        }
        });  
    },
    
    select: function (event, ui) {
        $('#barra_busqueda').val(ui.item.id); // save selected id to input
        // Set selection
        $('#barra_busqueda').keypress(function(e){
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == '13') {
                e.preventDefault();
                window.location = ui.item.id;
              }
        });

     }
    })
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) { 
        return $( "<li></li>" )  
            .data( "item.autocomplete", item )  
            .append( "<a href='"  + item.id + "'>" +item.label +"</a>" )   
            .appendTo( ul ); 
             
    }
});


$(function(){
    $("#filtro2").autocomplete({
        autoFocus: true,
    source: function(request, response) {
        $.ajax({
        url: ruta+"search/filtro",
        dataType: "json",
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
                window.location = ui.item.id;
              }
        });

     }
    })
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) { 
        return $( "<li></li>" )  
            .data( "item.autocomplete", item )  
            .append( "<a href='"  + item.id + "'>" +item.label +"</a>" )   
            .appendTo( ul ); 
             
    }
});











