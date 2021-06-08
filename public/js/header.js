/*let menu = document.querySelector(".icon-menu");

menu.addEventListener("click", function (){
   this.classList.toggle("active");
});*/

// Función para mostrar y ocultar barra de busqueda en los tamaños Mobile y Tablet del "header", archivo ubicado en el app.blade.php
function ocultaInput(){
   let myinput = document.querySelector.bind(document);
   myinput(".contains_barra").classList.toggle("barra_busqueda-mobile")
}