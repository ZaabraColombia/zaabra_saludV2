/*let menu = document.querySelector(".icon-menu");

menu.addEventListener("click", function (){
   this.classList.toggle("active");
});*/

// Función para mostrar y ocultar barra de busqueda en los tamaños Mobile y Tablet del "header", archivo ubicado en el app.blade.php
function ocultaInput(){
   let myinput = document.querySelector.bind(document);
   myinput(".contain_buscador_mobile").classList.toggle("barra_buscador_mobile")
}

// Función para ocultar la caja de opciones desplegable del login en el header
function elementHidden (z){
   let myvar = z.getAttribute('data-position');

   var div = document.getElementById('collap');
 
   if (myvar == "burger") {
      div.classList.remove('show');
      $('#login__').attr('aria-expanded', false);
   }
}
