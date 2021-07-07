document.addEventListener('DOMContentLoaded', function () {

  const swiper_profesional = new Swiper(".swiper_profesional", {
  
    //loop: false,
  
    /*autoplay: {
      delay: 4500,
      disableOnInteraction: false,
    },*/
    autoHeight: true,
    // If we need pagination
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
  
  const swiper_premios = new Swiper(".swiper_premios", {

    loop: true,
   
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
  
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
        slidesPerView: 3,
        slidesPerGroup: 1,
        spaceBetween: 20,
      },
        // when window width is >= 1600px
      1600: {
        slidesPerView: 3,
        slidesPerGroup: 1,
        spaceBetween: 20,
      },
    }
  });
  
  

  
  const select = document.querySelector.bind(document);
  const gallery = new Viewer(select('.gallery_profesional'));
  
  const menu_item = [].slice.apply(document.querySelectorAll('.item_landing'));
  const sections = [].slice.apply(document.querySelectorAll('.sections'));
  
  document.querySelector('.landingProf').addEventListener('click', el =>{
    let count;
    if (el.target.classList.contains('item_landing')) {

      let iterator = menu_item.indexOf(el.target);
      
      sections.map(seccion => seccion.classList.remove('sections_active'));
      menu_item.map(item => item.classList.remove('perfil_clicked',
      'tratamientos_clicked',
      'premios_clicked',
      'publicaciones_clicked',
      'galeria_clicked'));

      sections[iterator].classList.toggle('sections_active');
  
      (iterator == 0) ? menu_item[0].classList.toggle('perfil_clicked'): count++
      (iterator == 1) ? menu_item[1].classList.toggle('tratamientos_clicked'): count++
      (iterator == 2) ? menu_item[2].classList.toggle('premios_clicked'): count++  
      (iterator == 3) ? menu_item[3].classList.toggle('publicaciones_clicked'): count++
      (iterator == 4) ? menu_item[4].classList.toggle('galeria_clicked'): count++
  
    }
  });
    
});


