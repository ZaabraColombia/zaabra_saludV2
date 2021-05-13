// Carrusel superior galeriaProfesiones, Ramas de la salud.
const swiper_especialidades = new Swiper('.swiper_profesiones', {
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

//Carrusel inferior de los logos galeriaProfesiones, Ramas de la salud
const swiper_logosProfesiones = new Swiper(".swiper_logosProfesiones", {

  slidesPerView: 10,
  slidesPerGroup: 2,
  spaceBetween: 5,
  loop: true,
  centeredSlides: true,
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

