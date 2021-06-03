
    const swiper_profesional = new Swiper(".swiper_profesional", {
  
      loop: true,
      loopFillGroupWithBlank: true,
    
      /*autoplay: {
        delay: 4500,
        disableOnInteraction: false,
      },*/
    
      // If we need pagination
      pagination: {
          el: '.swiper-pagination',
      },
    
      breakpoints: {
         // when window width is >= 320px
        320: {
          slidesPerView: 3,
          slidesPerGroup: 1,
        },
         // when window width is >= 1024px
        1024: {
          slidesPerView: 5,
          slidesPerGroup: 1,
        },
          // when window width is >= 1600px
        1600: {
          slidesPerView: 5,
          slidesPerGroup: 1,
          spaceBetween: 5,
        },
      }
    });

    const swiper_premios = new Swiper(".swiper_premios", {
  
      loop: true,
      loopFillGroupWithBlank: true,
    
      /*autoplay: {
        delay: 4500,
        disableOnInteraction: false,
      },*/
    
      // If we need pagination
      pagination: {
          el: '.swiper-pagination',
      },
    
      breakpoints: {
         // when window width is >= 320px
        320: {
          slidesPerView: 1,
          slidesPerGroup: 1,
        },
         // when window width is >= 1024px
        1024: {
          slidesPerView: 1,
          slidesPerGroup: 1,
        },
          // when window width is >= 1600px
        1600: {
          slidesPerView: 1,
          slidesPerGroup: 1,
          spaceBetween: 5,
        },
      }
    });

    const gallery = new Viewer(document.getElementById('galery_profesional'));