# 📘 El DOM desde Cero — Guía para Alumnos

> Esta guía acompaña la Clase 2 (Manejo del DOM). Está pensada para leerla **antes o después** de la clase, con calma, explicando cada concepto desde cero. Si en clase vas rápido con algo, volvé acá.

---

## 0. ¿Por qué esto importa?

Hasta ahora, tu código de Javascript vivía "aislado": variables, funciones, arrays, todo dentro de la Consola o de un `console.log`. Hoy tu código empieza a **tocar la página de verdad**: cambiar un texto, cambiar un color, reaccionar cuando alguien escribe. Eso es exactamente lo que hace posible cualquier página interactiva que usás todos los días (un formulario que valida en vivo, un menú que se despliega, un contador de "me gusta").

Todo eso se apoya en **una sola idea**: el DOM.

---

## 1. ¿Qué es el DOM?

**DOM** significa *Document Object Model* (Modelo de Objetos del Documento). Es la forma en que el navegador **representa tu página HTML como una estructura de objetos** que Javascript puede leer y modificar.

### La idea clave

Cuando el navegador carga un archivo `.html`, **no se queda con el texto del archivo**. Lo lee, lo interpreta, y arma en memoria un **árbol de objetos**: cada etiqueta (`<body>`, `<p>`, `<input>`, `<button>`...) se convierte en un "nodo" de ese árbol, con propiedades y métodos propios.

```
document
└── html
    └── body
        ├── h1
        ├── p
        │   └── (texto)
        └── input
```

Javascript **no edita el archivo `.html`**. Edita ese árbol en memoria. Por eso:

- Los cambios se ven **al instante**, sin recargar.
- Los cambios se **pierden** si recargás la página (porque el navegador vuelve a leer el `.html` original y arma el árbol de nuevo).

> 💡 **Analogía:** el archivo HTML es el **plano de una casa**. El DOM es la **casa ya construida**, con paredes y muebles reales que se pueden tocar. Javascript es el **albañil** que entra a mover cosas. Si "recargás" (volvés a construir desde el plano), la casa vuelve a su estado original y se pierde lo que movió el albañil.

### `window` y `document`

Todo en el navegador cuelga de un objeto gigante llamado `window` — representa la ventana o pestaña del navegador. Una de sus propiedades es `document`, que es justamente ese árbol de la página:

```js
window.document   // el árbol completo de la página
document           // Javascript entiende "window" aunque no lo escribas
```

Por eso en la práctica siempre escribimos `document.algo`, nunca `window.document.algo` — es más corto y significa exactamente lo mismo.

> ✍️ **Probá vos:** abrí cualquier página, apretá `F12` → pestaña **Console**, y escribí `document`. Vas a ver el árbol completo de esa página, no un texto — es un objeto de verdad.

---

## 2. Antes de tocar nada: `DOMContentLoaded`

El navegador lee el HTML **de arriba hacia abajo**. Si tu `<script>` intenta buscar un `<input>` que todavía no fue leído (porque está más abajo en el archivo), Javascript no lo va a encontrar.

Para evitar ese problema, envolvemos todo nuestro código así:

```js
document.addEventListener("DOMContentLoaded", function () {
  // acá adentro va TODO el código que toca el DOM
});
```

Esto le dice al navegador: *"esperá a que el HTML esté completamente cargado, y recién ahí ejecutá esta función"*. Es un hábito que vas a repetir en cada archivo, siempre.

---

## 3. Selectores: cómo encontrar un elemento

Antes de poder leer o cambiar algo, necesitás **encontrarlo** dentro del árbol. Para eso existen varios métodos. Todos se usan sobre `document`.

### `getElementById`

```js
document.getElementById("miId")
```

- Busca por el atributo `id` de un elemento (`<p id="miId">`).
- Se escribe **sin** el `#`.
- Devuelve **un único elemento**, o `null` si no existe.

### `querySelector`

```js
document.querySelector("#miId")     // por id
document.querySelector(".miClase")  // por clase
document.querySelector("button")    // por etiqueta
```

- Usa **la misma sintaxis que CSS**: `#` para id, `.` para clase, el nombre solo para la etiqueta.
- Devuelve el **primer** elemento que coincide, o `null` si no hay ninguno.
- Es más flexible que `getElementById` porque acepta cualquier selector CSS, no sólo un id.

### `querySelectorAll`

```js
document.querySelectorAll(".item")
```

- Igual que `querySelector`, pero devuelve **todos** los elementos que coinciden, no sólo el primero.

### `getElementsByClassName` y `getElementsByTagName`

```js
document.getElementsByClassName("item")  // por clase, sin el "."
document.getElementsByTagName("li")      // por etiqueta
```

- Formas más viejas, anteriores a `querySelector`. Todavía aparecen en código existente — hay que saber reconocerlas.

### Tabla comparativa

| Método | Busca por | Devuelve |
| :--- | :--- | :--- |
| `getElementById("x")` | id, sin `#` | un elemento (o `null`) |
| `querySelector(".x")` | cualquier selector CSS | el primer elemento que coincide (o `null`) |
| `querySelectorAll(".x")` | cualquier selector CSS | **todos** los elementos que coinciden |
| `getElementsByClassName("x")` | clase, sin `.` | **todos** los elementos con esa clase |
| `getElementsByTagName("x")` | etiqueta | **todos** los elementos con esa etiqueta |

> 🏆 **Regla práctica para esta cursada:** usá `querySelector` (uno) y `querySelectorAll` (varios) siempre que puedas. Cubren todos los casos y son más fáciles de recordar que el resto.

---

## 4. `NodeList` vs `HTMLCollection` — la diferencia que confunde a todos

Cuando pedís **varios** elementos a la vez (no uno solo), el resultado no es un array común — es una de estas dos cosas, según qué método usaste:

| Lo devuelve | Tipo de resultado | ¿Tiene `.forEach()`? | ¿Se actualiza sola si cambia el DOM? |
| :--- | :--- | :--- | :--- |
| `querySelectorAll(...)` | **NodeList** | ✅ Sí | ❌ No — es una "foto" del momento en que se ejecutó |
| `getElementsByClassName(...)` / `getElementsByTagName(...)` | **HTMLCollection** | ❌ No | ✅ Sí — se actualiza automáticamente |

### ¿Por qué importa?

```js
var lista = document.querySelectorAll(".item"); // NodeList
lista.forEach(function (el) {
  console.log(el);
}); // funciona directo ✅

var lista2 = document.getElementsByClassName("item"); // HTMLCollection
lista2.forEach(function (el) {
  console.log(el);
}); // ❌ Error: lista2.forEach is not a function
```

Para recorrer una `HTMLCollection` con `forEach`, primero hay que convertirla a array:

```js
Array.from(lista2).forEach(function (el) {
  console.log(el);
});
```

> ⚠️ **El error clásico:** copiar y pegar código que usaba `querySelectorAll` (NodeList) pero cambiar el método a `getElementsByClassName` (HTMLCollection) sin darse cuenta — y que `.forEach` deje de funcionar. Si ven ese error, lo primero que hay que revisar es **qué método devolvió esa variable**.

> 💡 Por eso, otra ventaja de usar siempre `querySelectorAll`: te ahorrás tener que acordarte de esta diferencia.

---

## 5. Leer y escribir contenido

Una vez que tenés el elemento guardado en una variable, ¿cómo lo leés o lo cambiás?

| Propiedad | Se usa en... | Qué hace |
| :--- | :--- | :--- |
| `.value` | `<input>`, `<select>`, `<textarea>` | lo que el usuario escribió o eligió |
| `.textContent` | `<p>`, `<div>`, `<span>`, `<h1>`... | el texto que se muestra adentro (no interpreta HTML) |
| `.innerHTML` | contenedores en general | lo mismo que `.textContent`, pero **interpreta** etiquetas HTML |
| `.style.propiedad` | cualquier elemento | un estilo CSS puntual, en `camelCase` |

```js
var input = document.querySelector("#nombre");
console.log(input.value);          // lo que el usuario escribió

var parrafo = document.querySelector("#saludo");
parrafo.textContent = "¡Hola!";     // texto plano
parrafo.innerHTML = "<b>¡Hola!</b>"; // interpreta el <b>

parrafo.style.color = "red";
parrafo.style.fontSize = "20px";    // "font-size" en CSS es "fontSize" en JS, con unidad
```

> 🏆 **Regla de oro:** si el usuario **escribe** ahí, es `.value`. Si vos **mostrás** algo ahí, es `.textContent` (o `.innerHTML` si necesitás que interprete etiquetas). Confundirlos es el error más común de esta unidad — un `<input>` no tiene `.textContent` útil, y un `<p>` no tiene `.value`.

> ⚠️ **Cuidado con `.innerHTML`:** si el contenido viene de lo que escribió un usuario, usar `.innerHTML` puede interpretar código malicioso (inyección de HTML/scripts). Para texto de usuario, siempre `.textContent`.

---

## 6. ¿Qué es un evento?

Un **evento** es algo que pasa en la página: un click, una tecla presionada, un campo que cambió de valor, la página que terminó de cargar. El navegador está todo el tiempo "avisando" estas cosas — nosotros elegimos cuáles nos interesan y qué hacer cuando pasan.

### Eventos más comunes

| Evento | Se dispara cuando... |
| :--- | :--- |
| `click` | se hace clic sobre un elemento |
| `input` | el valor de un campo cambia, **en cada tecla** (o al elegir un color, etc.) |
| `change` | el valor de un campo cambia, pero recién cuando **pierde el foco** |
| `keydown` / `keyup` | se presiona / se suelta una tecla |
| `focus` / `blur` | un elemento gana / pierde el foco |
| `submit` | se envía un formulario |
| `load` | la página (o una imagen) terminó de cargar |

> 💡 **`input` vs `change`:** son los que más se confunden. `input` reacciona **al instante**, tecla por tecla — ideal para algo "en vivo" (como el proyecto de esta clase). `change` espera a que el usuario termine y haga clic en otro lado — útil cuando no necesitás reaccionar hasta que el usuario "confirme" el valor.

---

## 7. `addEventListener` — escuchar un evento

Para reaccionar a un evento, se lo "escucha" con `addEventListener`:

```js
elemento.addEventListener("nombreDelEvento", funcionQueSeEjecuta);
```

Ejemplo real:

```js
var boton = document.querySelector("#miBoton");

function saludar() {
  console.log("¡Hiciste click!");
}

boton.addEventListener("click", saludar);
```

### ¿Por qué no usar `onclick="..."` directo en el HTML?

Vas a ver código viejo que hace esto:

```html
<button onclick="saludar()">Click acá</button>
```

Funciona, pero tiene dos problemas: mezcla HTML con lógica de Javascript, y sólo permite **un** manejador por evento. `addEventListener` separa las responsabilidades (HTML por un lado, comportamiento por otro) y permite agregar **varios** listeners al mismo elemento y al mismo evento.

### ⚠️ El error #1 de `addEventListener`

```js
boton.addEventListener("click", saludar());  // ❌ MAL
boton.addEventListener("click", saludar);     // ✅ BIEN
```

Con `saludar()` (con paréntesis), Javascript **ejecuta la función ya mismo** y le pasa a `addEventListener` lo que esa función devuelve (normalmente `undefined`) — no lo que querías. Sin paréntesis, le estás pasando la **función en sí**, para que se ejecute más adelante, cuando el evento realmente ocurra.

> 🏆 **Regla de oro:** en `addEventListener`, el segundo argumento **nunca lleva paréntesis**.

### Un mismo elemento puede tener varios listeners

```js
input.addEventListener("input", actualizarTexto);
input.addEventListener("input", actualizarContador);
```

Las dos funciones se van a ejecutar, en orden, cada vez que el usuario escriba. No hace falta juntar todo en una sola función gigante.

---

## 8. Todo junto: un mini ejemplo

Uniendo todo lo de esta guía — DOM, `DOMContentLoaded`, `querySelector`, `.value`/`.textContent`, eventos y `addEventListener` — así se ve un ejemplo mínimo, completo y funcional:

```html
<input type="text" id="nombre" placeholder="Escribí tu nombre">
<p id="saludo"></p>
```

```js
document.addEventListener("DOMContentLoaded", function () {
  var input = document.querySelector("#nombre");
  var saludo = document.querySelector("#saludo");

  function actualizarSaludo() {
    saludo.textContent = "¡Hola, " + input.value + "!";
  }

  input.addEventListener("input", actualizarSaludo);
});
```

Leyéndolo en voz alta: *"cuando el HTML termine de cargar, buscá el input y el párrafo; cada vez que el input reciba un evento `input` (o sea, cada tecla), actualizá el texto del párrafo con lo que hay escrito"*.

Esa es, literalmente, la fórmula que vas a usar en el proyecto de la clase (`material-base-dom/`) — ahí la vas a repetir varias veces, para el color, el tamaño de letra, y los dos fondos.

---

## 9. Glosario rápido

| Término | Qué es |
| :--- | :--- |
| **DOM** | el árbol de objetos que el navegador arma en memoria a partir del HTML |
| **`window`** | el objeto que representa la ventana del navegador; todo cuelga de acá |
| **`document`** | la propiedad de `window` que representa la página actual |
| **nodo** | cada elemento del árbol del DOM (una etiqueta, un texto, etc.) |
| **selector** | el "criterio de búsqueda" para encontrar un elemento (`#id`, `.clase`, `tag`) |
| **evento** | algo que pasa en la página (click, tecla, carga) que se puede "escuchar" |
| **listener** | la función que se ejecuta cuando ocurre un evento |
| **`NodeList`** | resultado de `querySelectorAll`; tiene `.forEach`, no se actualiza sola |
| **`HTMLCollection`** | resultado de `getElementsByClassName`/`getElementsByTagName`; no tiene `.forEach`, se actualiza sola |

---

## 10. Para practicar

1. Abrí `material-base-dom/pasos/index.html` y resolvé, en orden, los 5 pasos guiados (cada uno tiene su consigna escrita como comentario al principio del archivo).
2. Si algo no anda, `F12` → Console: ahí van a aparecer los errores reales del navegador — leerlos es parte del aprendizaje, no un obstáculo.
3. Cuando termines, mirá `material-resuelto-dom/script.js` para comparar tu solución con la del profesor (está comentada línea por línea).
