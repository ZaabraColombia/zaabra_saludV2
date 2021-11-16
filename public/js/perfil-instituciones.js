document.addEventListener('DOMContentLoaded', function () {

  // Función para el slider de la línea de opciones de la landing page instituciones
  const swiper_institucion = new Swiper(".swiper_institucion", {

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
      nextEl: '.btnNext_LandInst',
      prevEl: '.btnPrev_LandInst',
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


      const swiper_galeria_prof = new Swiper(".swiper_galeria_inst", {
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
          nextEl: '.btnPrev_gal_LandInst',
          prevEl: '.btnNext_gal_LandInst',
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
            //spaceBetween: 15,
          },
           // when window width is >= 1024px
          1024: {
            slidesPerView: 2,
            slidesPerGroup: 1,
            //spaceBetween: 15,
          },
            // when window width is >= 1440px
          1360: {
            slidesPerView: 3,
            slidesPerGroup: 1,
            //spaceBetween: 15,
          },
        }
      });

 
      const swiper_certificado_LandInst = new Swiper(".swiper_certificado_LandInst", {
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
          nextEl: '.btnPrev_cert_LandInst',
          prevEl: '.btnNext_cert_LandInst',
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
            //spaceBetween: 15,
          },
           // when window width is >= 1024px
          1024: {
            slidesPerView: 2,
            slidesPerGroup: 1,
            //spaceBetween: 15,
          },
            // when window width is >= 1440px
          1360: {
            slidesPerView: 3,
            slidesPerGroup: 1,
            //spaceBetween: 15,
          },
        }
      });

      
      const menu_insti = [].slice.apply(document.querySelectorAll('.item_landing_insti'))
      const sections_insti = [].slice.apply(document.querySelectorAll('.section_insti'))
  
      document.querySelector('.landingInsti').addEventListener('click', el => {

        let count;

        if (el.target.classList.contains('item_landing_insti')) {

           let itera_insti = menu_insti.indexOf(el.target)
        
           sections_insti.map(seccionInst => seccionInst.classList.remove('section_insti_active'));
           menu_insti.map(menuInst => menuInst.classList.remove(
             'servicios_clicked',
             'profesionales_clicked',
             'acerca_clicked',
             'certificados_clicked',
             'sedes_clicked',
             'gale-inst_clicked'));

             sections_insti[itera_insti].classList.toggle('section_insti_active');
            
            (itera_insti == 0) ? menu_insti[0].classList.toggle('servicios_clicked'): count++
            (itera_insti == 1) ? menu_insti[1].classList.toggle('profesionales_clicked'): count++
            (itera_insti == 2) ? menu_insti[2].classList.toggle('acerca_clicked'): count++
            (itera_insti == 3) ? menu_insti[3].classList.toggle('certificados_clicked'): count++
            (itera_insti == 4) ? menu_insti[4].classList.toggle('sedes_clicked'): count++
            (itera_insti == 5) ? menu_insti[5].classList.toggle('gale-inst_clicked'): count++
        }
      })

});