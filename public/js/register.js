// Evento onclick para desplegar el formulario de registro y el cambio de color del icono y el texto en la vista " register "
function hideForm (z){
    let myvar = z.getAttribute('data-position');

    console.log(myvar);
    let selector = document.querySelector.bind(document);
    // Condicional para el registro de usuario rol Paciente
    if (myvar === "paciente" || myvar == 1) {
        selector(".names_person").style.display = "block";
        selector(".datos_secundarios").style.display = "block";
        selector(".names_institution").style.display = "none";

        document.getElementById ("tarjeta").style.marginBottom= '50px';
        // Metodo para realizar el cambio de color de los iconos y el texto en las opciones de la vista " register ", por medio de la función hideForm
        // Opción paciente
        document.getElementById ("inpt1"). src = '/img/iconos/icono-paciente-amarillo.svg';
        document.getElementById ("txt1").style.color = "#E6C804";
        //Opción doctor
        document.getElementById ("inpt2"). src = '/img/iconos/icono-doctor.svg';
        document.getElementById ("txt2").style.color = "#3E3E3E";
        // Opción institución
        document.getElementById ("inpt3"). src = '/img/iconos/icono-institucion.svg';
        document.getElementById ("txt3").style.color = "#3E3E3E";

        document.getElementById("valor_tipo").value = document.getElementById("inpt1").value;
    }

    // Condicional para el registro de usuario rol Medico/a
    else if (myvar === "doctor" || myvar == 2) {
        selector(".names_person").style.display = "block";
        selector(".datos_secundarios").style.display = "block";
        selector(".names_institution").style.display = "none";

        document.getElementById ("tarjeta").style.marginBottom= '50px';
        // Metodo para realizar el cambio de color de los iconos y el texto en las opciones de la vista " register ", por medio de la función hideForm
        //Opción doctor
        document.getElementById ("inpt2"). src = '/img/iconos/icono-doctor-azul.svg';
        document.getElementById ("txt2").style.color = "#0083d6";
        // Opción paciente
        document.getElementById ("inpt1"). src = '/img/iconos/icono-paciente.svg';
        document.getElementById ("txt1").style.color = "#3E3E3E";
        // Opción institución
        document.getElementById ("inpt3"). src = '/img/iconos/icono-institucion.svg';
        document.getElementById ("txt3").style.color = "#3E3E3E";

        document.getElementById("valor_tipo").value = document.getElementById("inpt2").value;
    }

    // Condicional para el registro de usuario rol Institución
    else if (myvar === "institucion" || myvar == 3) {
        selector(".names_institution").style.display = "block";
        selector(".datos_secundarios").style.display = "block";
        selector(".names_person").style.display = "none";

        document.getElementById ("tarjeta").style.marginBottom= '50px';
        // Metodo para realizar el cambio de color de los iconos y el texto en las opciones de la vista " register ", por medio de la función hideForm
        // Opción institución
        document.getElementById ("inpt3"). src = '/img/iconos/icono-institucion-verde.svg';
        document.getElementById ("txt3").style.color = "#019F86";
        // Opción paciente
        document.getElementById ("inpt1"). src = '/img/iconos/icono-paciente.svg';
        document.getElementById ("txt1").style.color = "#3E3E3E";
        //Opción doctor
        document.getElementById ("inpt2"). src = '/img/iconos/icono-doctor.svg';
        document.getElementById ("txt2").style.color = "#3E3E3E";

        document.getElementById("valor_tipo").value = document.getElementById("inpt3").value;
    }
}

function validateform(){
    var idrol=document.formularioRegistro.idrol.value;
        if (idrol==1 && idrol!=null) {
            var primernombre=document.formularioRegistro.primernombre.value;
                if (primernombre == null || primernombre=="") {
                    var elem = document.getElementById('primernombre');
                    elem.style.border = "solid 1px red";
                return false;
                }
            var primerapellido=document.formularioRegistro.primerapellido.value;
                if (primerapellido == null || primerapellido=="") {
                    var elem = document.getElementById('primerapellido');
                    elem.style.border = "solid 1px red";
                return false;
                }
            var numerodocumento=document.formularioRegistro.numerodocumento.value;
                if (numerodocumento == null || numerodocumento=="") {
                    var elem = document.getElementById('numerodocumento');
                    elem.style.border = "solid 1px red";
                return false;
                }
        }else if(idrol==2 && idrol!=null){
            var primernombre=document.formularioRegistro.primernombre.value;
                if (primernombre == null || primernombre=="") {
                    var elem = document.getElementById('primernombre');
                    elem.style.border = "solid 1px red";
                return false;
            }
            var primerapellido=document.formularioRegistro.primerapellido.value;
                if (primerapellido == null || primerapellido=="") {
                    var elem = document.getElementById('primerapellido');
                    elem.style.border = "solid 1px red";
                return false;
            }
            var numerodocumento=document.formularioRegistro.numerodocumento.value;
                if (numerodocumento == null || numerodocumento=="") {
                    var elem = document.getElementById('numerodocumento');
                    elem.style.border = "solid 1px red";
                return false;
                }
        }else if(idrol==3 && idrol!=null){
            var nombreinstitucion=document.formularioRegistro.nombreinstitucion.value;
                if (nombreinstitucion == null || nombreinstitucion=="") {
                    var elem = document.getElementById('nombreinstitucion');
                    elem.style.border = "solid 1px red";
                return false;
                }
            var numerodocumento=document.formularioRegistro.numerodocumento.value;
                if (numerodocumento == null || numerodocumento=="") {
                    var elem = document.getElementById('numerodocumento');
                    elem.style.border = "solid 1px red";
                return false;
                }
        }
    return true;
}
