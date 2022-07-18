// Carrusel opciones modulo gestión
const swiper_gestion = new Swiper(".swiper_gestion", {
    //loop: false,

    // autoplay: {
    // delay: 4500,
    // disableOnInteraction: false,
    // },

    initialSlide: $(".btn__activ").data('index') ?? 0,

    autoHeight: true,

    // If we need pagination
    pagination: {
    el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
    nextEl: '.btnNext_pag_slider',
    prevEl: '.btnPrev_pag_slider',
    },

    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 30,
        },

        // when window width is >= 700px
        700: {
            slidesPerView: 2,
            slidesPerGroup: 1,
        },

        // when window width is >= 1024px
        1024: {
            //enabled: false,
            slidesPerView: 3,
            slidesPerGroup: 1,
            spaceBetween: 5,
        },
        // when window width is >= 1920px
        1600: {
            //enabled: false,
            slidesPerView: 4,
            slidesPerGroup: 1,
        },
    }
});

// Ocultar y mostrar los filtros por (documento, rango, servicio y especialidad)
$(document).ready(function(){
    $("#document").click(function(){
        $("#filtroDoc").removeClass('d-none').addClass('d-block');
        $("#filtroRang").removeClass('d-block').addClass('d-none');
        $("#filtroServ").removeClass('d-block').addClass('d-none');
        $("#filtroEspe").removeClass('d-block').addClass('d-none');
    });

    $("#rango").click(function(){
        $("#filtroRang").removeClass('d-none').addClass('d-block');
        $("#filtroDoc").removeClass('d-block').addClass('d-none');
        $("#filtroServ").removeClass('d-block').addClass('d-none');
        $("#filtroEspe").removeClass('d-block').addClass('d-none');
    });

    $("#servicio").click(function(){
        $("#filtroServ").removeClass('d-none').addClass('d-block');
        $("#filtroDoc").removeClass('d-block').addClass('d-none');
        $("#filtroRang").removeClass('d-block').addClass('d-none');
        $("#filtroEspe").removeClass('d-block').addClass('d-none');
    });

    $("#especialidad").click(function(){
        $("#filtroEspe").removeClass('d-none').addClass('d-block');
        $("#filtroServ").removeClass('d-block').addClass('d-none');
        $("#filtroDoc").removeClass('d-block').addClass('d-none');
        $("#filtroRang").removeClass('d-block').addClass('d-none');
    });
});