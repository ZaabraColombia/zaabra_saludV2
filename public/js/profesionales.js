document.addEventListener('DOMContentLoaded', function () {
  const swiper_premium = new Swiper(".swiper_premium", {

    loop: true,
    effect: "flip",
    grabCursor: true,
    loopFillGroupWithBlank: true,
  
    /*autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },*/
  
    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },
  
    /*breakpoints: {
       // when window width is >= 320px
      320: {
        slidesPerView: 1,
        slidesPerGroup: 1,
      },
       // when window width is >= 1024px
      1024: {
        slidesPerView: 10,
        slidesPerGroup: 1,
        spaceBetween: 15,
      },
        // when window width is >= 1600px
      1600: {
        slidesPerView: 10,
        slidesPerGroup: 1,
        spaceBetween: 5,
      },
    }*/
  });
});

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
    
  });
  
  
});

