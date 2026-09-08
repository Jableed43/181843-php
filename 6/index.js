// Js tambien tiene selectores

document.addEventListener("DOMContentLoaded", function () {
  // Selectores de los elementos
  let body = document.querySelector("body");
  let textInput = document.querySelector("#textInput");
  let colorInput = document.querySelector("#colorInput");
  let fontSize = document.querySelector("#fontSize");
  let bgColorTexto = document.querySelector("#bgColorTexto");
  let bgColor = document.querySelector("#bgColor");
  let resultado = document.querySelector("#resultado");
  let reiniciar = document.querySelector("#reiniciar");

  // Funciones
  // Actualizar texto
  textInput.addEventListener("input", function () {
    resultado.textContent = textInput.value;
  });

  // Actualizar color de letra
  function actualizarColor() {
    // los estilos se escriben en camelCasel
    // font-size -> fontSize
    resultado.style.color = colorInput.value;
  }

  colorInput.addEventListener("input", actualizarColor);

  // colorInput.addEventListener("input", function() {
  //     // los estilos se escriben en camelCasel
  //     // font-size -> fontSize
  //     resultado.style.color = colorInput.value
  // })

  // Tamaño de letra
  fontSize.addEventListener("input", function () {
    resultado.style.fontSize = fontSize.value + "px";
    // alt + 96 -> backsticks
    // resultado.style.fontSize = `${fontSize.value}px`
    console.log(resultado.style.fontSize);
  });

  bgColorTexto.addEventListener("input", function () {
    resultado.style.backgroundColor = bgColorTexto.value;
  });

  bgColor.addEventListener("input", function () {
    body.style.backgroundColor = bgColor.value;
  });

//   function reiniciar() {
//     textInput.value = "";
//     colorInput.value = "#000000";
//     fontSize.value = 16;
//     bgColorTexto.value = "#ffffff";
//     bgColor.value = "#ffffff";

//     resultado.textContent = "Así se va a ver tu texto";
//     resultado.style.color = "";
//     resultado.style.fontSize = "";
//     resultado.style.backgroundColor = "";
//     body.style.backgroundColor = "";

//     contador.textContent = "0";
//   }

//   reiniciar.addEventListener("click", reiniciar);
});
