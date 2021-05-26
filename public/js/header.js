/*let menu = document.querySelector(".icon-menu");

menu.addEventListener("click", function (){
   this.classList.toggle("active");
});*/

// Función para mostrar y ocultar barra de busqueda en los tamaños Mobile y Tablet del HEADER, ubicado en el archivo app.blade.php
function ocultaInput(){
   let myinput = document.querySelector.bind(document);
   myinput(".contains_barra").classList.toggle("barra_busqueda-mobile")
}

// Función anonima para ocultar el NEWSLWTTER del FOOTER en las vistas Login, Register y Email
!function() {
   let selector = document.querySelector.bind(document);
   let queryRuta = window.location.pathname;

   // Condicional de validación de rutas a las cuales les remueve el NEWSLETTER del FOOTER
   if (queryRuta.includes("register") || queryRuta.includes("login") || queryRuta.includes("reset") || queryRuta.includes("acerca") ) {
      selector(".footer_newsletter").style.display = "none";
   }
}();