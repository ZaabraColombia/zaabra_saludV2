//Carrusel superior galeriaProfesiones, Ramas de la salud
const swiper_principalGaleriaProf = new Swiper('.swiper_principalGaleriaProf',{
  // Optional parameters
  // If we need pagination
  loop: true,
  effect: "fade",
  
  pagination: {
    el: '.swiper-pagination',
  },

  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },

  // And if we need scrollbar
});

//Carrusel inferior galeriaProfesiones, Rama de la salud
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
    1024: {
      slidesPerView: 10,
      slidesPerGroup: 3,
      spaceBetween: 5,
    },
    // when window width is >= 1200px
    1200: {
      slidesPerView: 12,
      slidesPerGroup: 7,
      spaceBetween: 5,
    }
  }
});

