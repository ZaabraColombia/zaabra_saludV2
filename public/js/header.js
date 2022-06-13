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

// funcionalidad para ocultar el login al momento de hacer click fuera del menú desplegado
$(document).click(function(e) {
   var element = $('#collap').find(e.target).length;
   //  console.log(element);
   if (element === 0) {
      $('#collap').collapse('hide');	   
   }
});

// $(document).click(function(e) {
   // var menu = $('#sid').find(e.target).length;
   // if (menu === 0 && $(e.target) != $('#nav_toggle')) {
   //    $('#nav_toggle').prop('checked', false);
   // }
// });


// Code to show and hide sidebar on mobile, vertical scrolling of main body. View (layout.blade.php (instituciones/admin/layouts)),
// and style file (dashboard.scss (agenda/dashboard.scss))
const openEls = document.querySelectorAll("[data-open]");
const closeEls = document.querySelectorAll("[data-close]");
const isVisible = "is-visible";

for (const el of openEls) {
  el.addEventListener("click", function() {
    const sideBarId = this.dataset.open;
    document.getElementById(sideBarId).classList.add(isVisible);
    $('#body').addClass('scroll_body');
  });
}

for (const el of closeEls) {
  el.addEventListener("click", function() {
    this.parentElement.parentElement.parentElement.classList.remove(isVisible);
  });
  $('#body').removeClass('scroll_body');
}

document.addEventListener("click", e => {
  if (e.target == document.querySelector(".sideBar.is-visible")) {
    document.querySelector(".sideBar.is-visible").classList.remove(isVisible);
    $('#body').removeClass('scroll_body');
  }
});

document.addEventListener("keyup", e => {
  // if we press the ESC
  if (e.key == "Escape" && document.querySelector(".sideBar.is-visible")) {
    document.querySelector(".sideBar.is-visible").classList.remove(isVisible);
  }
});
// End code