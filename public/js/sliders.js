const swiper = new Swiper('.swiper-container', {
    // Optional parameters
    // If we need pagination
    loop: true,
    
    pagination: {
      el: '.swiper-pagination',
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    autoplay: {
      delay: 2500,
      disableOnInteraction: true,
    },
  
    // And if we need scrollbar
  });
  