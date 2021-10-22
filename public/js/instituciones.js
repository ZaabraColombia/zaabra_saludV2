document.addEventListener('DOMContentLoaded', function () {
  const swiper_premium_insti = new Swiper(".swiper_premium_insti", {

    loop: true,
    loopFillGroupWithBlank: true,
  
    autoplay: {
      delay: 4555500,
      disableOnInteraction: true,
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
  

    // Función cambio de color de los botones e iconos de pago del POP UP DE PAGOS tarjetas de las vistas "membresiaProfesional" y "membresiaInstitucion"
    !function(){
      const selector = document.querySelector.bind(document);
      let pathname = window.location.pathname;

      //Condicional paraa validar l aruta y realizar los cambios
      if (pathname.includes('/membresiaInstitucion')) {
        jQuery(".btn_close-popup").css("background","#019F86"); 
        jQuery(".btnPagar-popup").css("background","#019F86"); 
        document.getElementById ("img_tarjCred"). src = '/img/popup-pago/tarjetas-de-credito-consultorio-verde.svg';
        document.getElementById ("img_pagoPse"). src = '/img/popup-pago/medios-online-pse-consultorio-verde.svg';
      }  
    }();

 });

//Función para el banner principal de la vista institución profesionales
const swiper_principalInstProf = new Swiper('.swiper_principalInstProf',{
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