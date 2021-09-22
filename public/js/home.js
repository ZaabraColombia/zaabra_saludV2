const swiper_principal = new Swiper('.swiper_principal',{
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

  breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 1,
      slidesPerGroup: 1,
    },
      // when window width is >= 768px
      768: {
      slidesPerView: 2,
      slidesPerGroup: 1,
      spaceBetween: 15,
    },
    // when window width is >= 1024px
    1024: {
    slidesPerView: 3,
    slidesPerGroup: 1,
    spaceBetween: 10,
    },
    // when window width is >= 1360px
    1360: {
      slidesPerView: 4,
      slidesPerGroup: 1,
      spaceBetween: 10,
    },
    // when window width is >= 1920px
    1920: {
      slidesPerView: 4,
      slidesPerGroup: 1,
      spaceBetween: 10,
    },
  }
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
      // when window width is >= 320px
    320: {
      slidesPerView: 4,
      slidesPerGroup: 1,
      spaceBetween: 7,
    },
      // when window width is >= 1024px
    1024: {
      slidesPerView: 8,
      slidesPerGroup: 1,
      spaceBetween: 15,
    },
      // when window width is >= 1440px
    1440: {
      slidesPerView: 8,
      slidesPerGroup: 1,
      spaceBetween: 15,
    },
  }
});

var swiper = new Swiper(".mySwiper", {
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    renderBullet: function (index, className) {
      return '<span class="' + className + '">' + (index + 1) + "</span>";
    },
  },
});