document.addEventListener('DOMContentLoaded', function () {

    const swiper_institucion = new Swiper(".swiper_institucion", {
  
        //loop: false,
      
        /*autoplay: {
          delay: 4500,
          disableOnInteraction: false,
        },*/
      
        // If we need pagination
        pagination: {
            el: '.slide-counter',
            type: 'fraction'
        },
      
        breakpoints: {
           // when window width is >= 320px
          320: {
            slidesPerView: 3,
            slidesPerGroup: 1,
          },
           // when window width is >= 1024px
          1024: {
            //enabled: false,
            slidesPerView: 5,
            slidesPerGroup: 5,
          },
            // when window width is >= 1600px
          1600: {
            slidesPerView: 5,
            slidesPerGroup: 1,
            spaceBetween: 5,
          },
        }
      });

});