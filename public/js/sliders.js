const swiper = new Swiper('.swiper-container',{
    // Optional parameters
    // If we need pagination
    loop: true,
    
    pagination: {
      el: '.swiper-pagination',
    },
  
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
  
    // And if we need scrollbar
  });
