/*function slideToggle(t,e,o){0===t.clientHeight?j(t,e,o,!0):j(t,e,o)} function slideUp(t,e,o){j(t,e,o)}function slideDown(t,e,o){j(t,e,o,!0)}function j(t,e,o,i){void 0===e&&(e=400),void 0===i&&(i=!1),t.style.overflow="hidden",i&&(t.style.display="block");var p,l=window.getComputedStyle(t),n=parseFloat(l.getPropertyValue("height")),a=parseFloat(l.getPropertyValue("padding-top")),s=parseFloat(l.getPropertyValue("padding-bottom")),r=parseFloat(l.getPropertyValue("margin-top")),d=parseFloat(l.getPropertyValue("margin-bottom")),g=n/e,y=a/e,m=s/e,u=r/e,h=d/e;window.requestAnimationFrame(function l(x){void 0===p&&(p=x);var f=x-p;i?(t.style.height=g*f+"px",t.style.paddingTop=y*f+"px",t.style.paddingBottom=m*f+"px",t.style.marginTop=u*f+"px",t.style.marginBottom=h*f+"px"):(t.style.height=n-g*f+"px",t.style.paddingTop=a-y*f+"px",t.style.paddingBottom=s-m*f+"px",t.style.marginTop=r-u*f+"px",t.style.marginBottom=d-h*f+"px"),f>=e?(t.style.height="",t.style.paddingTop="",t.style.paddingBottom="",t.style.marginTop="",t.style.marginBottom="",t.style.overflow="",i||(t.style.display="none"),"function"==typeof o&&o()):window.requestAnimationFrame(l)})}

let sidebarItems = document.querySelectorAll('.sidebar-item.has-sub');
for(var i = 0; i < sidebarItems.length; i++) {
    let sidebarItem = sidebarItems[i];
	sidebarItems[i].querySelector('.sidebar-link').addEventListener('click', function(e) {
        e.preventDefault();
        
        let submenu = sidebarItem.querySelector('.submenu');
        if(submenu.style.display == 'none') submenu.classList.add('active')
        else submenu.classList.remove('active')
        
        slideToggle(submenu, 300)
    })
}

window.addEventListener('DOMContentLoaded', (event) => {
    var w = window.innerWidth;
    if(w < 1200) {
        document.getElementById('sidebar').classList.remove('active');
    }
});
window.addEventListener('resize', (event) => {
    var w = window.innerWidth;
    if(w < 1200) {
        document.getElementById('sidebar').classList.remove('active');
    }else{
        document.getElementById('sidebar').classList.add('active');
    }
});*/

// Función para ocultar y mostrar los pop-up de las tarjetas de la agenda los cuales se encuentran en la vista citas.blade.php
function elementClose (z){
    let myvar = z.getAttribute('data-position');
    
    let selector = document.querySelector.bind(document);
    // Condicional para la función del pop-up
    if (myvar == "cancelo") {
        selector(".modalB").style.display = "block";
        selector(".modalA").style.display = "none";
        jQuery(".modal-backdrop.show").css("display","none"); 
    }
}

// Función para cambiar de color el texto del menu lateral, submenu e items del menu administrativo de la agenda profesional y poaciente
!function() {
    let queryRuta = window.location.pathname;
    // Condicionales de la validación de cada una de las rutas para remover y adicionar las clases descritas.
    if (queryRuta.includes("panelPrincipal")) {

        $('#menu_panel').removeClass('actived');
        $('#menu_panel').addClass('unactived');
    }

    else if (queryRuta.includes("citas")) {

        $('#cita_padre').removeClass('actived');
        $('#cita_padre').addClass('citaPadre');

        $('#cita').removeClass('actived');
        $('#cita').addClass('unactived');
    }
    else if (queryRuta.includes("calendario")) {

        $('#cita_padre').removeClass('actived');
        $('#cita_padre').addClass('citaPadre');

        $('#calendario').removeClass('actived');
        $('#calendario').addClass('unactived');
    }
    else if (queryRuta.includes("pagos")) {

        $('#cita_padre').removeClass('actived');
        $('#cita_padre').addClass('citaPadre');

        $('#pago').removeClass('actived');
        $('#pago').addClass('unactived');
    }

    else if (queryRuta.includes("historiaClinica") || queryRuta.includes("registroPaciente") || queryRuta.includes("pacienteRegistrado")
    || queryRuta.includes("editarConsulta") || queryRuta.includes("editarPatologia")
    || queryRuta.includes("editarExpediente")) {

        $('#historia_padre').removeClass('actived');
        $('#historia_padre').addClass('citaPadre');

        $('#hist').removeClass('actived');
        $('#hist').addClass('unactived');
    }

    else if (queryRuta.includes("prescripciones")) {

        $('#historia_padre').removeClass('actived');
        $('#historia_padre').addClass('citaPadre');

        $('#formula').removeClass('actived');
        $('#formula').addClass('unactived');
    }

    else if (queryRuta.includes("diagnosticos")) {

        $('#historia_padre').removeClass('actived');
        $('#historia_padre').addClass('citaPadre');

        $('#diag').removeClass('actived');
        $('#diag').addClass('unactived');
    }

    else if (queryRuta.includes("procedimientos")) {

        $('#historia_padre').removeClass('actived');
        $('#historia_padre').addClass('citaPadre');

        $('#proced').removeClass('actived');
        $('#proced').addClass('unactived');
    }

    else if (queryRuta.includes("vademecum")) {

        $('#historia_padre').removeClass('actived');
        $('#historia_padre').addClass('citaPadre');

        $('#vademe').removeClass('actived');
        $('#vademe').addClass('unactived');
    }

    else if (queryRuta.includes("favoritos")) {

        $('#favorito_padre').removeClass('actived');
        $('#favorito_padre').addClass('citaPadre');

        $('#fav').removeClass('actived');
        $('#fav').addClass('unactived');
    }
}();