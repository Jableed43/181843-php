# 🕒 Guía de Clase: Introducción a Javascript (60 min)

> **Temas:** Qué es JS y cómo se ejecuta · Incluir JS en el HTML · Modo estricto · Comentarios · Variables (declaración y ámbito) · Operadores (cadena, aritméticos, comparación, lógicos, asignación, `typeof`) · Funciones · Arrays y `length` · `for` · `while` · `if`.
> **Se apoya en:** ningún JS previo — es la puerta de entrada al módulo. Da pie a `tema-10-javascript-variables-operadores`, `tema-11-...-condicionales-operadores-arreglos`, `tema-12-...-arrays-metodos` y `tema-13-...-funciones-ciclos`.
> **Fuente usada:** `cursada_php/material/modulo2_js/unidad_1.md` (Módulo 2 – Unidad 1, SCEU UTN-BA).
> **⚠️ Nota de ritmo:** una hora es poco para 20 temas. La clase se dicta **en vivo sólo lo tildado abajo**; el resto queda resuelto y comentado en el material entregable para estudio en casa (ver Plan B y la sección de Material Entregable, que trae mucho más código del que da el tiempo a tipear en el pizarrón).

---

## 🚀 Accesos y Herramientas Rápidas (Machete para el Profe)

| Elemento | Enlace / Comando / Recurso |
| :--- | :--- |
| **Fuente teórica** | `cursada_php/material/modulo2_js/unidad_1.md` |
| **Editor** | VS Code, sin plugins necesarios para esta clase |
| **Carpeta de la clase** | crear `clase-01-intro-js/` con `index.html` y `script.js` |
| **Consola del navegador** | `F12` → pestaña **Console** — se usa desde el minuto 1 |
| **Plan B sin internet** | todo corre local: doble clic en `index.html` |
| **Referencia de versiones** | tabla ES1–ES7 en la fuente (útil si preguntan "¿qué es ES6?") |

---

## 📅 Bloque 1: ¿Qué es Javascript? (00:00 – 00:08)

- **🧠 Concepto Principal:** JS es un lenguaje **interpretado**, mayormente usado del lado del cliente (*client-side*), embebido en el navegador para dar interactividad a una página que HTML/CSS no pueden dar por sí solos.
- **Analogía:** si el HTML es el **esqueleto** y el CSS la **ropa**, JS son los **músculos**: lo que hace que la página *reaccione* y *se mueva* en respuesta a lo que hace el usuario.
- **Tipos de ejecución (mencionar, no desarrollar):** ejecución directa (línea por línea, apenas el navegador la lee) vs. respuesta a un evento (click, tecla — se profundiza en la clase de DOM).
- **Acción (rompehielo, 2 min):** `F12` → Console → `alert("Hola Mundo")`. Preguntar: *"¿esto cambió la página de verdad, o sólo lo que ve mi navegador ahora?"*

---

## 🧹 Bloque 2: Cómo se incluye y cómo se escribe JS (00:08 – 00:18)

### 2.1 Incluir JS en el HTML

```html
<!-- Embebido -->
<script>
  alert("Hola Mundo");
</script>

<!-- En archivo aparte (recomendado) -->
<script src="script.js"></script>
```

- **⚡ Pro-Tip:** el `<script>` va al **final del `body`**. Así el HTML ya está cargado cuando el JS corre. *(Semilla para `DOMContentLoaded`, se cobra en la clase de DOM.)*
- El archivo `.js` externo **no** lleva las etiquetas `<script>` adentro, sólo código.

### 2.2 Modo estricto (`"use strict";`)

- Exige declarar **todo** con `var` antes de usarlo; sin él, la variable se crea como global "por accidente" y el error queda oculto.
- **🏆 Regla de oro:** arrancar siempre el archivo con `"use strict";`.

### 2.3 Comentarios y separación de instrucciones

```js
// una línea
/* varias
   líneas */
```

- `;` o salto de línea separan instrucciones. Convención de la cursada: **usar siempre `;`**.
- **Mención rápida (sin dinámica, por tiempo):** comentar una línea con `//` es la forma más rápida de "apagar" código al debuggear — lo van a usar todo el curso.

---

## 🎨 Bloque 3: Variables y Operadores (00:18 – 00:33)

### 3.1 Variables, nombres y ámbito

```js
var nombre = "Juan";     // global si está fuera de una función

function miFuncion() {
  var local = "sólo existe acá adentro"; // local
}
```

- Nombres: alfanuméricos + `_`, no pueden empezar con número, no pueden ser palabras reservadas (`if`, `for`, ...).
- **Analogía:** variable global = gritar en medio de la casa, todos los cuartos lo escuchan. Variable local = secreto dentro de un cuarto cerrado.
- **🏆 Regla de oro:** no abusar de variables globales.

### 3.2 Operadores — tabla de referencia rápida (mostrar y tipear 2 o 3 ejemplos, no todos)

| Familia | Ejemplo | Detalle |
| :--- | :--- | :--- |
| **Cadenas** | `"hola " + "mundo"` | `+` concatena strings |
| **Aritméticos** | `+ - * /` | igual que en matemática |
| **Comparación** | `== === != !== < > <= >=` | devuelven `true`/`false` |
| **Lógicos** | `&&` (and) · `\|\|` (or) · `!` (not) | combinan condiciones |
| **Asignación** | `= += -= *= /=` | `x += 1` es lo mismo que `x = x + 1` |
| **`typeof`** | `typeof "hola"` → `"string"` | devuelve el tipo como texto |

- **⚠️ El error #1 de la unidad — `+` es ambiguo:**
  ```js
  console.log("5" + 3);              // "53"  <- concatena, NO suma
  console.log(parseInt("5") + 3);    // 8     <- ahora sí suma
  ```
- **🏆 Regla de oro:** usar siempre `===` (comparación estricta), nunca `==`.
- **⚡ Pro-Tip:** `typeof` es la herramienta de diagnóstico: *"si un resultado te sorprende, `console.log(typeof variable)`"*.
- Todo lo que no llegue a tipearse en vivo (lógicos, asignación compuesta, comparación completa) queda **resuelto y comentado línea por línea** en el material entregable — decirlo explícitamente al grupo.

---

## 🚀 Bloque 4: Proyecto — "Ficha de Notas del Curso" (00:33 – 00:53)

> **Hilo conductor:** un mini-programa que junta variables, función, array, `for`/`while` e `if` con operadores de comparación y lógicos, sobre un caso simple: las notas de los alumnos del curso.

### 1. Datos: dos arrays en paralelo (3 min)

```js
var alumnos = ["Ana", "Luis", "Marta", "Pedro"];
var notas   = [8, 3, 10, 6];
```

- Mostrar `alumnos.length` en consola. Aclarar: la posición `i` de un array corresponde a la posición `i` del otro.

### 2. Función que decide aprobado/desaprobado (7 min)

```js
function estaAprobado(nota) {
  return nota >= 6; // operador de comparación -> devuelve true/false
}
```

- Objetivo: que vean que una función puede devolver directamente el resultado de una comparación, sin necesidad de un `if` adentro.

### 3. Recorrer ambos arrays con `for` y armar el mensaje (7 min)

```js
for (var i = 0; i < alumnos.length; i++) {
  var nombre = alumnos[i];
  var nota = notas[i];

  if (estaAprobado(nota)) {
    console.log(nombre + " aprobó con " + nota);
  } else {
    console.log(nombre + " no llegó (" + nota + ")");
  }
}
```

- Señalar las 3 partes del `for` (inicialización / condición / actualización) y por qué la condición usa `.length`, no un número fijo.

### 4. Extra en vivo si el tiempo alcanza (3 min) — si no, queda para el material

```js
// Lógicos: nota límite Y sin ausencias
var ausencias = 1;
if (estaAprobado(nota) && ausencias === 0) {
  console.log(nombre + " promociona directo");
}
```

- Con esto se muestra `&&` en contexto real, sin dar teoría aparte.

---

## 🆘 Tips de Supervivencia (Machete final)

### 🏆 Reglas de Oro

1. **El `<script>` va al final del `body`.**
2. **Declará siempre con `var`** — evita el bug de la variable global accidental.
3. **`+` concatena si hay un string de por medio.** Para sumar texto, `parseInt()` / `parseFloat()`.
4. **Usá `===`, no `==`.**
5. **En un `for`, la condición usa `.length`**, no un número fijo.
6. **No abusen de variables globales.**

### 🚩 ¿Errores o dudas frecuentes?

- **`"53"` en vez de `8`** → el clásico de `+` con strings. Revisar con `typeof` cada operando.
- **`Uncaught ReferenceError: x is not defined`** → falta `var`. Mostrar que sin modo estricto "funciona igual" y por qué eso es peligroso.
- **El `while` se cuelga** → falta el incremento dentro del bloque (no hay tiempo de vivirlo en vivo hoy — está resuelto y explicado en el material entregable).
- **"¿Por qué a veces `=` y a veces `==` o `===`?"** → `=` asigna, `==`/`===` comparan.
- **"¿Para qué sirve la Consola (F12)?"** → ahí se ve `console.log`, los errores reales, y se puede probar código suelto. Es la herramienta de debug número uno del curso.

### 🔄 Plan B (Troubleshooting)

- **La clase es muy densa para 60 minutos.** El objetivo de hoy en vivo es el Bloque 4 completo (pasos 1 a 3) funcionando; **todo** lo demás (operadores lógicos, de asignación compuesta, `while`, `typeof` a fondo) queda **resuelto y comentado** en `material-resuelto/script.js` como lectura obligatoria post-clase.
- **Si falla el proyector/la conexión:** clase sin dependencias externas, se puede dictar en el pizarrón y correr en cualquier navegador con `F12`.
- **Si el grupo va muy rápido:** pasar al punto 4 del proyecto (operadores lógicos) y mostrar el `while` equivalente del material resuelto.
- **Si va muy lento:** recortar en este orden — (1) el punto 4 del proyecto, (2) la tabla completa de operadores del Bloque 3 (dejar sólo `+` ambiguo y `===`), (3) modo estricto (queda como lectura). **No recortar nunca:** variables + `var`, `for` con arrays, `if`/`===` del proyecto.
- **Si alguien no tiene editor instalado:** que trabaje directamente en la Consola del navegador durante la clase.

---

## 🏁 Bloque 5: Cierre (00:53 – 01:00)

- **Cierre conceptual:**
  ```
  1. Declaro datos       → var / array
  2. Empaqueto lógica    → function
  3. Repito              → for / while
  4. Decido              → if / else + comparación/lógicos
  ```
  *"Con estas cuatro piezas ya pueden escribir cualquier programa. Todo lo que viene es aprender a combinarlas mejor."*
- **Tarea:** leer y ejecutar `material-resuelto/script.js` completo (trae mucho más de lo visto en clase: ámbito, operadores lógicos y de asignación, `while`, `typeof`) y subir al foro una variante propia con al menos un alumno y una nota agregados.
- **Próxima clase:** manejo del DOM en Javascript (`tema-14-javascript-dom-eventos` → ver `guia-clase-16-dom-eventos.md`).

---

## 👩‍🎓 Instrucciones para el Alumno (enviar ANTES de la clase)

**Traer listo:**

1. Un editor de código instalado (VS Code recomendado) — no es obligatorio, se puede seguir la clase desde la Consola del navegador.
2. Navegador Chrome o Firefox.
3. Leer la Presentación y los Objetivos de la Unidad 1 (`unidad_1.md`) antes de la clase.

**Durante la clase:** tener `F12` → Console abierta desde el inicio.

**Después de la clase:** el material resuelto trae más contenido del que da el tiempo a cubrir en vivo — es lectura obligatoria, no sólo referencia.

---

## 🛠️ Material Entregable (Para el alumno)

Ver los archivos completos en `material-base/` (con TODOs, para completar en clase) y `material-resuelto/` (versión completa y comentada, con **más contenido del que se llega a dictar en vivo**: demo de ámbito de variables, operadores lógicos, de asignación compuesta, `typeof`, la versión con `while` y una función adicional de estadísticas del curso).

- [`material-base/index.html`](material-base/index.html) + [`material-base/script.js`](material-base/script.js) — versión de un solo archivo, todo junto
- [`material-resuelto/index.html`](material-resuelto/index.html) + [`material-resuelto/script.js`](material-resuelto/script.js) — solución completa (docente)

### Pasos guiados (uno por alumno, uno por vez)

Para que cada alumno tenga **su propio script para correr en clase**, el mismo contenido está partido en 7 archivos independientes con consigna incluida en [`material-base/pasos/`](material-base/pasos/). Repartir esa carpeta (con su `README.md`) en vez de, o además de, el `script.js` único:

| Paso | Archivo | Tema |
| :--- | :--- | :--- |
| 1 | `paso-1-datos.js` | Arrays en paralelo, `.length` |
| 2 | `paso-2-funcion-aprobado.js` | Función + comparación (`>=`) |
| 3 | `paso-3-for.js` | Recorrer arrays con `for` |
| 4 | `paso-4-while.js` | Lo mismo con `while` |
| 5 | `paso-5-logicos.js` | Operadores lógicos (`&&`, `\|\|`, `!`) |
| 6 | `paso-6-estadisticas.js` | Función con `+=`, contar y promediar |
| 7 | `paso-7-ambito.js` | Ámbito de variables (global vs. local) |

Cada uno se corre solo (pegándolo en la Consola del navegador, o cargándolo desde `pasos/index.html`) — no dependen entre sí, cada archivo trae sus propios datos ya armados.

### Chuleta de referencia rápida

```js
// ---------- INCLUIR JS ----------
// <script>...</script>          embebido
// <script src="a.js"></script>  externo, sin <script> adentro del .js
// va al final del <body>

// ---------- MODO ESTRICTO ----------
"use strict";  // exige declarar todo con var, avisa errores silenciosos

// ---------- VARIABLES Y ÁMBITO ----------
var x = 10;              // global si está afuera de una función
function f() {
  var y = 20;             // local: sólo existe adentro de f()
}

// ---------- OPERADORES ----------
"a" + "b"          // "ab"      concatenación
"5" + 3            // "53"      ⚠️ concatena si hay un string
parseInt("5") + 3  // 8         conversión explícita
5 == "5"           // true      comparación floja (evitar)
5 === "5"          // false     comparación estricta (usar SIEMPRE)
5 > 3 && 2 < 4      // true      lógico AND
5 > 3 || 2 > 4      // true      lógico OR
!(5 > 3)            // false     lógico NOT
var total = 0;
total += 5;         // total = total + 5
typeof "hola"      // "string"

// ---------- ARRAYS ----------
var lista = ["a", "b", "c"];
lista.length     // 3
lista[0]         // "a"

// ---------- ESTRUCTURAS ----------
for (var i = 0; i < lista.length; i++) { /* ... */ }
while (condicion) { /* ... */ }
if (condicion) { /* ... */ } else { /* ... */ }

// ---------- FUNCIONES ----------
function nombre(param1, param2) {
  return param1 + param2;
}
```
