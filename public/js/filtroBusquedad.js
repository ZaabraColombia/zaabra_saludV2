$(function(){
    $("#filtro").autocomplete({
    source: function(request, response) {
        $.ajax({
        url: 'search/filtro',
        dataType: "json",
        data: {
            term: request.term
        },
        success: function( data ) {
            response( data );
        }
        });
        
    },
        select: function( event, ui ) { 
        window.location.href = ui.item.value;
        }
    })
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) { 
        
        return $( "<li></li>" )  
            .data( "item.autocomplete", item )  
            .append( "<a>" + item.label+ "</a>" )  
            .appendTo( ul );  
    };  
});