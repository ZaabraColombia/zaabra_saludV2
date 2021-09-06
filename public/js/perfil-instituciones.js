document.addEventListener('DOMContentLoaded', function () {

    const swiper_institucion = new Swiper(".swiper_institucion", {
  
        //loop: false,
      
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

      /*const swiper_certificados = new Swiper(".swiper_certificados", {

        loop: true,
        loopFillGroupWithBlank: true,
       
        autoplay: {
          delay: 500,
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
          // when window width is >= 768px
          768: {
            slidesPerView: 2,
            slidesPerGroup: 1,
            spaceBetween: 20,
          },
          // when window width is >= 1024px
          1024: {
            slidesPerView: 3,
            slidesPerGroup: 1,
            spaceBetween: 20,
          },
          // when window width is >= 1440px
          1440: {
            slidesPerView: 3,
            slidesPerGroup: 1,
            spaceBetween: 20,
          },
        }
      });*/
      

      
      const menu_insti = [].slice.apply(document.querySelectorAll('.item_landing_insti'))
      const sections_insti = [].slice.apply(document.querySelectorAll('.section_insti'))
  
      document.querySelector('.landingInsti').addEventListener('click', el => {

        let count;

        if (el.target.classList.contains('item_landing_insti')) {

           let itera_insti = menu_insti.indexOf(el.target)
        
           sections_insti.map(seccionInst => seccionInst.classList.remove('section_insti_active'));
           menu_insti.map(menuInst => menuInst.classList.remove(
             'servicios_clicked',
             'acerca_clicked',
             'certificados_clicked',
             'sedes_clicked',
             'gale-inst_clicked'));

             sections_insti[itera_insti].classList.toggle('section_insti_active');
            
            (itera_insti == 0) ? menu_insti[0].classList.toggle('servicios_clicked'): count++
            (itera_insti == 1) ? menu_insti[1].classList.toggle('acerca_clicked'): count++
            (itera_insti == 2) ? menu_insti[2].classList.toggle('certificados_clicked'): count++
            (itera_insti == 3) ? menu_insti[3].classList.toggle('sedes_clicked'): count++
            (itera_insti == 4) ? menu_insti[4].classList.toggle('gale-inst_clicked'): count++
        }
      })

});

 // Función para cambiar de color y dejar un solo item desplegado en las opciones de las tarjetas de la vista "membresiaProfesional" y "membresiaInstitucion" 
 $('.desplegable_institucion .containt_options-collapse-institucion').on( "click", function() {
  $(this).siblings().find(".boton_collapse-off-institucion").removeClass("boton_collapse-on-institucion");
  $(this).find(".boton_collapse-off-institucion").toggleClass("boton_collapse-on-institucion");
});
