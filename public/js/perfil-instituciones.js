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

      const swiper_certificados = new Swiper(".swiper_certificados", {

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

});

 // Función para cambiar de color y dejar un solo item desplegado en las opciones de las tarjetas de la vista "membresiaProfesional" y "membresiaInstitucion" 
 $('.desplegable_institucion .containt_options-collapse-membresia').on( "click", function() {
  $(this).siblings().find(".boton_collapse-off-membresia").removeClass("boton_collapse-on-institucion");
  $(this).find(".boton_collapse-off-membresia").toggleClass("boton_collapse-on-institucion");
});