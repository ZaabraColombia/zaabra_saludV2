//----------------------------------Seleccion archivo primer formulario----------------------------------------------------
// Obtener referencia al input y a la imagen
const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
  $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

// Escuchar cuando cambie
$seleccionArchivos.addEventListener("change", () => {
  // Los archivos seleccionados, pueden ser muchos o uno
  const archivos = $seleccionArchivos.files;
  // Si no hay archivos salimos de la función y quitamos la imagen
  if (!archivos || !archivos.length) {
    $imagenPrevisualizacion.src = "";
    return;
  }
  // Ahora tomamos el primer archivo, el cual vamos a previsualizar
  const primerArchivo = archivos[0];
  // Lo convertimos a un objeto de tipo objectURL
  const objectURL = URL.createObjectURL(primerArchivo);
  // Y a la fuente de la imagen le ponemos el objectURL
  $imagenPrevisualizacion.src = objectURL;
});
//----------------------------------Fin Seleccion archivo primer formulario----------------------------------------------------

// Función para cargar y previsualizar las imagenes en el FORMULARIO PROFESIONALES e INSTITUCIONES
function previewImage(nb) {        
  var reader = new FileReader();         
  reader.readAsDataURL(document.getElementById('uploadImage'+nb).files[0]);         
  reader.onload = function (e) {             
    document.getElementById('uploadPreview'+nb).src = e.target.result;         
  };     
}

// Función para cargar y previsualizar las imagenes de la tarjeta profesionales del FORMULARIO INSTITUCIONES
function previewImageProf(np) {        
  var reader = new FileReader();         
  reader.readAsDataURL(document.getElementById('selecArchivos'+np).files[0]);         
  reader.onload = function (e) {             
    document.getElementById('imagenPrevi'+np).src = e.target.result;         
  };     
}
