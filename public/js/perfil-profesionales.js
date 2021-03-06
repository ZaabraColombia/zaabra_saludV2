document.addEventListener('DOMContentLoaded', function () {

  // Función para el slider de la línea de opciones de la landing page profesionales
  const swiper_profesional = new Swiper(".swiper_profesional", {
  
    //loop: false,
  
    /*autoplay: {
      delay: 4500,
      disableOnInteraction: false,
    },*/

    autoHeight: true,
    // If we need pagination
    // If we need pagination
    
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.btnNext_formProf',
      prevEl: '.btnPrev_formProf',
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
        slidesPerView: 4,
        spaceBetween: 3,
      },

      // when winddow width is => 1200px
      1200: {
        slidesPerView: 5,
        slidePerGroup: 1,
        spaceBetween: 1,
      },

      // when window width is >= 1600px
      1440: {
        slidesPerView: 5,
        slidePerGroup: 1,
        spaceBetween: 1,
      },
    }
  });
  
  const swiper_premios = new Swiper(".swiper_premios", {

    loop: true,
    resizeObserver: true,
   
    autoplay: {
      delay: 4500,
      disableOnInteraction: false,
    },
  
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.btnPrev_prem_formProf',
      prevEl: '.btnNext_prem_formProf',
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
        //spaceBetween: 5,
      },
       // when window width is >= 1024px
      1024: {
        slidesPerView: 2,
        slidesPerGroup: 1,
        //spaceBetween: 20,
      },
        // when window width is >= 1600px
      1360: {
        slidesPerView: 3,
        slidesPerGroup: 1,
        //spaceBetween: 20,
      },
    }
  });

  const swiper_galeria_prof = new Swiper(".swiper_galeria_prof", {

    loop: true,
    resizeObserver: true,
   
    autoplay: {
      delay: 4500,
      disableOnInteraction: false,
    },
  
    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },
     // Navigation arrows
     navigation: {
      nextEl: '.btnNext_gall_formProf',
      prevEl: '.btnPrev_gall_formProf',
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
        //spaceBetween: 20,
      },
       // when window width is >= 1024px
      1024: {
        slidesPerView: 2,
        slidesPerGroup: 1,
        //spaceBetween: 20,
      },
        // when window width is >= 1600px
      1360: {
        slidesPerView: 3,
        slidesPerGroup: 1,
        //spaceBetween: 20,
      },
    }
  });
    
  const menu_item = [].slice.apply(document.querySelectorAll('.item_landing'));
  const sections = [].slice.apply(document.querySelectorAll('.sections'));
  
  document.querySelector('.landingProf').addEventListener('click', el =>{
    let count;
    if (el.target.classList.contains('item_landing')) {

      let iterator = menu_item.indexOf(el.target);
      
      sections.map(seccion => seccion.classList.remove('sections_active'));
      menu_item.map(item => item.classList.remove('perfil_clicked',
      'servicio_clicked',
      'convenio_clicked',
      'tratamientos_clicked',
      'premios_clicked',
      'publicaciones_clicked',
      'galeria_clicked'));

      sections[iterator].classList.toggle('sections_active');
  
      (iterator == 0) ? menu_item[0].classList.toggle('perfil_clicked'): count++
      (iterator == 1) ? menu_item[1].classList.toggle('servicio_clicked'): count++
      (iterator == 2) ? menu_item[2].classList.toggle('convenio_clicked'): count++
      (iterator == 3) ? menu_item[3].classList.toggle('tratamientos_clicked'): count++
      (iterator == 4) ? menu_item[4].classList.toggle('premios_clicked'): count++  
      (iterator == 5) ? menu_item[5].classList.toggle('publicaciones_clicked'): count++
      (iterator == 6) ? menu_item[6].classList.toggle('galeria_clicked'): count++
  
    }
  });

  
  let favorito = document.querySelector('.fa-heart');
  favorito.onclick = function(){
    favorito.classList.toggle('background-heart');
  }
    
});