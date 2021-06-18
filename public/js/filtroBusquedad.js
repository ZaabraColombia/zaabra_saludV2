$(function(){
    $("#filtro").autocomplete({
        autoFocus: true,
    source: function(request, response) {
        $.ajax({
        url: "search/filtro",
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
        // Set selection
        $('#filtro').val(ui.item.label); // display the selected text
        $('#employeeid').val(ui.item.id); // save selected id to input
        return false;
     }
    })
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) { 
        return $( "<li></li>" )  
            .data( "item.autocomplete", item )  
            .append( "<a href='"  + item.id + "'>" +item.label +"</a>" )   
            .appendTo( ul ); 
             
    }
});







