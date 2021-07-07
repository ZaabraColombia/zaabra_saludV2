ruta='http://127.0.0.1:8000/';
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
            .append( "<div class='dropdown-divider m-0'></div>" ) 
            .appendTo( ul ); 
             
    }
});