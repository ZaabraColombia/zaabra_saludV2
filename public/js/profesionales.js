document.addEventListener('DOMContentLoaded', function () {
  const swiper_premium = new Swiper(".swiper_premium", {

    loop: true,
    loopFillGroupWithBlank: true,
  
    autoplay: {
      delay: 5500,
      disableOnInteraction: false,
    },
  
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

