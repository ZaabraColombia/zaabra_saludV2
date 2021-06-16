document.addEventListener('DOMContentLoaded', function () {

  const swiper_profesional = new Swiper(".swiper_profesional", {
  
    //loop: false,
    loopFillGroupWithBlank: false,
  
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
  
  /*swiper_profesional.on('transitionEnd', function() {
    console.log('*** swiper_profesional.realIndex', swiper_profesional.realIndex);
  });*/

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

  //const iterator = document.querySelectorAll('.profesional_menu');
  const menu_item = [].slice.apply(document.querySelectorAll('.menu_item'));
  const sections = [].slice.apply(document.querySelectorAll('.sections'));
  
  document.querySelector('.menu_profesional').addEventListener('click', el =>{
    if (el.target.classList.contains('menu_item')) {

      let iterator = menu_item.indexOf(el.target, el.target);
      console.log(iterator);
      sections.map(seccion => seccion.setAttribute("display", "none"));
      sections[iterator].classList.toggle('sections_active');
    }
  });


  //const sections = document.querySelectorAll('.sections');
    
});


