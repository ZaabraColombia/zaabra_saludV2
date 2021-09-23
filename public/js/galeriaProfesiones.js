//Carrusel superior galeriaProfesiones, Ramas de la salud, Instituciones-Medicas
const swiper_principalGaleriaProf = new Swiper('.swiper_principalGaleriaProf',{
  // Optional parameters
  // If we need pagination
  loop: false,
  effect: "fade",
  
  pagination: {
    el: '.swiper-pagination',
  },

  autoplay: {
    delay: 3500,
    disableOnInteraction: false,
  },

  // And if we need scrollbar
});

//Carrusel de logos inferior galeriaProfesiones, Rama de la salud, Entidades
const swiper_logosGaleriaProf = new Swiper(".swiper_logosGaleriaProf", {

  loop: true,
  centeredSlides: false,
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
    320: {
      slidesPerView: 5,
      slidesPerGroup: 2,
      spaceBetween: 5,
    },
    // when window width is >= 1024px
    1024: {
      slidesPerView: 10,
      slidesPerGroup: 2,
      spaceBetween: 15,
    },
    // when window width is >= 1200px
    1200: {
      slidesPerView: 10,
      slidesPerGroup: 2,
      spaceBetween: 15,
    }
  }
});

