const swiper = new Swiper('.swiper_principal',{
    // Optional parameters
    // If we need pagination
    loop: true,
    effect: "fade",
    
    pagination: {
      el: '.swiper-pagination',
    },
  
    autoplay: {
      delay: 4500,
      disableOnInteraction: false,
    },
  
    // And if we need scrollbar
  });

  const swiper_especialistas = new Swiper(".swiper_especialistas", {

    slidesPerView: 4,
    slidesPerGroup: 4,
    loop: true,
    loopFillGroupWithBlank: true,
    
    autoplay: {
      delay: 5500,
      disableOnInteraction: false,
    },
    // Navigation arrows
    navigation: {
      nextEl: '.btn-next',
      prevEl: '.btn-prev',
    },
  });

  const swiper_triple = new Swiper(".swiper_triple", {

    slidesPerView: 3,
    slidesPerGroup: 3,
    spaceBetween: 5,
    
  });

  const swiper_logoshome = new Swiper(".swiper_logoshome", {

    loop: true,
    loopFillGroupWithBlank: true,
    
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
    // Navigation arrows
    navigation: {
      nextEl: '.btn-next',
      prevEl: '.btn-prev',
    },

    breakpoints: {
       // when window width is >= 1024px
      1024: {
        slidesPerView: 10,
        slidesPerGroup: 2,
        spaceBetween: 15,
      },

      1600: {
        slidesPerView: 10,
        slidesPerGroup: 2,
        spaceBetween: 5,
      },
    }
  });

