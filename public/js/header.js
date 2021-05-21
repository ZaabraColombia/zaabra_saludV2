/*let menu = document.querySelector(".icon-menu");

menu.addEventListener("click", function (){
   this.classList.toggle("active");
});*/

function ocultaInput(){
   let myinput = document.querySelector.bind(document);
   myinput(".contains_barra").classList.toggle("barra_busqueda-mobile")
}

!function() {
   let selector = document.querySelector.bind(document);
   let queryRuta = window.location.pathname;

   if (queryRuta.includes("register") || queryRuta.includes("login") ) {
      selector(".footer_newsletter").style.display = "none";
   }
}();