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

      // when window width is >= 700px
      700: {
        slidesPerView: 4,
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

  /*
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
  */

  $(document).ready(function() {
    $('#serv_ins').show();
    $('#acer_ins').hide();
    $('#cert_ins').hide();
    $('#sede_ins').hide();
    $('#gale_ins').hide();
  });
});

function showElement(x){
  //alert("hola mundo");
  let atributo = x.getAttribute("data-target")
  let selector = document.querySelector.bind(document)

  if (atributo == "serv") {
    selector("#serv_ins").style.display = "block";
    selector("#acer_ins").style.display = "none";
    selector("#cert_ins").style.display = "none";
    selector("#sede_ins").style.display = "none";
    selector("#gale_ins").style.display = "none";

    $('#serv').removeClass('serv_grey').addClass('serv_green')
    $('#prof').removeClass('prof_green')
    $('#acer').removeClass('acer_green')
    $('#cert').removeClass('cert_green')
    $('#sede').removeClass('sede_green')
    $('#gale').removeClass('gale_green')
  }

  else if (atributo == "prof") {
    selector("#serv_ins").style.display = "none";
    selector("#acer_ins").style.display = "none";
    selector("#cert_ins").style.display = "none";
    selector("#sede_ins").style.display = "none";
    selector("#gale_ins").style.display = "none";

    $('#serv').removeClass('serv_green').addClass('serv_grey')
    $('#prof').addClass('prof_green').show(30000)
    $('#acer').removeClass('acer_green')
    $('#cert').removeClass('cert_green')
    $('#sede').removeClass('sede_green')
    $('#gale').removeClass('gale_green')
  }

  else if (atributo == "acer") {
    selector("#serv_ins").style.display = "none";
    selector("#acer_ins").style.display = "block";
    selector("#cert_ins").style.display = "none";
    selector("#sede_ins").style.display = "none";
    selector("#gale_ins").style.display = "none";

    $('#serv').removeClass('serv_green').addClass('serv_grey')
    $('#prof').removeClass('prof_green')
    $('#acer').addClass('acer_green')
    $('#cert').removeClass('cert_green')
    $('#sede').removeClass('sede_green')
    $('#gale').removeClass('gale_green')
  }

  else if (atributo == "cert") {
    selector("#serv_ins").style.display = "none";
    selector("#acer_ins").style.display = "none";
    selector("#cert_ins").style.display = "block";
    selector("#sede_ins").style.display = "none";
    selector("#gale_ins").style.display = "none";

    $('#serv').removeClass('serv_green').addClass('serv_grey')
    $('#prof').removeClass('prof_green')
    $('#acer').removeClass('acer_green')
    $('#cert').addClass('cert_green')
    $('#sede').removeClass('sede_green')
    $('#gale').removeClass('gale_green')
  }

  else if (atributo == "sede") {
    selector("#serv_ins").style.display = "none";
    selector("#acer_ins").style.display = "none";
    selector("#cert_ins").style.display = "none";
    selector("#sede_ins").style.display = "block";
    selector("#gale_ins").style.display = "none";

    $('#serv').removeClass('serv_green').addClass('serv_grey')
    $('#prof').removeClass('prof_green')
    $('#acer').removeClass('acer_green')
    $('#cert').removeClass('cert_green')
    $('#sede').addClass('sede_green')
    $('#gale').removeClass('gale_green')
  }

  else if (atributo == "gale") {
    selector("#serv_ins").style.display = "none";
    selector("#acer_ins").style.display = "none";
    selector("#cert_ins").style.display = "none";
    selector("#sede_ins").style.display = "none";
    selector("#gale_ins").style.display = "block";

    $('#serv').removeClass('serv_green').addClass('serv_grey')
    $('#prof').removeClass('prof_green')
    $('#acer').removeClass('acer_green')
    $('#cert').removeClass('cert_green')
    $('#sede').removeClass('sede_green')
    $('#gale').addClass('gale_green')
  }
};
