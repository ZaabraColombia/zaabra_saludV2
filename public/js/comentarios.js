var valorEstrella=null;
$(document).ready(function(){
  
    /* 1. Visualizing things on Hover - See next part for action on click */
    $('#stars li').on('mouseover', function(){
      var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
    
      // Now highlight all the stars that's not after the current hovered star
      $(this).parent().children('li.star').each(function(e){
        if (e < onStar) {
          $(this).addClass('hover');
        }
        else {
          $(this).removeClass('hover');
        }
      });
      
    }).on('mouseout', function(){
      $(this).parent().children('li.star').each(function(e){
        $(this).removeClass('hover');
      });
    });
    
    
    /* 2. Action to perform on click */
    $('#stars li').on('click', function(){
      var onStar = parseInt($(this).data('value'), 10); // The star currently selected
      
      var stars = $(this).parent().children('li.star');
    
      for (i = 0; i < stars.length; i++) {
        $(stars[i]).removeClass('selected');
      }
      
      for (i = 0; i < onStar; i++) {
        $(stars[i]).addClass('selected');
      }
      
      // JUST RESPONSE (Not needed)
      var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
      valorEstrella=ratingValue;
    });
  });
  
 

$('#comentarioFormProf').on('submit',function(e){
    e.preventDefault();
    $('#send_form_coment_prof').html('enviando...');
    $.ajax({
      url: "/comentarios",
      type:"POST",
      data:{
        "_token": $("meta[name='csrf-token']").attr("content"),
        "idperfil": $('#idperfil').val(),
        "calificacion": valorEstrella,
        "comentario": $('#comentario').val(),
      },
      success:function(response){ 
        $('#oscar').hide();
        $('#res_message').show();
        $('#res_message').html(response.msg);
        $('#msg_comentario').removeClass('d-none');
        document.getElementById("comentarioFormProf").reset(); 
        setTimeout(function(){
            $('#res_message').hide();
            $('#msg_comentario').hide();
            },3000);
         },
     });
    });