"use strict";


document.addEventListener("DOMContentLoaded", () => {

  // ============ Selectores ============
  const btnCargar = document.querySelector("#btnCargar"); // pide el mensaje real
  const btnError = document.querySelector("#btnError");   // pide algo que no existe, a propósito
  const resultado = document.querySelector("#resultado"); // acá se escribe lo que responda el servidor

  const hacerPeticion = (url) => {
    resultado.textContent = "Cargando..."

    const peticion = new XMLHttpRequest()

    peticion.onreadystatechange = () => {
      console.log("readyState", peticion.readyState)

      if(peticion.readyState === 4){ // 4 es completó la operacion
        if(peticion.status === 200) { // codigo de status 200 -> operacion salió bien
          resultado.textContent = peticion.responseText
        } else {
          resultado.textContent = `Error ${peticion.status}: ${peticion.statusText}`
        }
      }
    }
    // escuchar los cambios antes de abrir y al enviar asi no perdemos nada
    peticion.open("GET", url, true) // metodo, url, asincrono
    peticion.send(null) // enviamos null ya que get no lleva contenido porque es GET
  }

  btnCargar.addEventListener("click", () => hacerPeticion("server.php"))
  btnError.addEventListener("click", () => hacerPeticion("no-existe.php"))
});
