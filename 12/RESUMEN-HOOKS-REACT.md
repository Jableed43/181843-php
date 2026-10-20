# Resumen — Hooks en React

> Salida de la clase. Sirve para repasar solo, sin el profe al lado. Los ejemplos son del proyecto de
> hoy (`base/` → `final/`): un contador de hechizos, un indicador de conexión y la Copa de las Casas de
> Hogwarts — más el `useFetch` que armamos sobre el proyecto de personajes.

## Índice

0. [Levantar el proyecto](#0-levantar-el-proyecto)
1. [¿Qué es un hook? Las 2 reglas](#1-qué-es-un-hook-las-2-reglas)
2. [`useState`](#2-usestate)
3. [`useEffect`](#3-useeffect)
4. [Custom Hooks](#4-custom-hooks)
5. [Ejemplo real: `useFetch`](#5-ejemplo-real-usefetch)
6. [`useReducer`](#6-usereducer)
7. [Reglas de oro](#7-reglas-de-oro)
8. [Diccionario de errores](#8-diccionario-de-errores)
9. [Chuleta final](#9-chuleta-final)
10. [Cierre del curso: el mapa completo](#10-cierre-del-curso-el-mapa-completo)

---

## 0. Levantar el proyecto

**Si todavía no clonaste el repositorio:**

```bash
git clone https://github.com/Jableed43/181843-php.git
cd 181843-php/12/base
```

**Si ya lo clonaste en una clase anterior**, no hace falta clonar de nuevo: entrá a la carpeta del
repo y traé lo nuevo:

```bash
cd 181843-php
git pull
cd 12/base
```

Después, parado en `12/base` (tiene que haber un `package.json` ahí):

```bash
npm install      # una sola vez: descarga lo que el proyecto necesita
npm run dev      # levanta el servidor; abrí la dirección que muestra (normalmente http://localhost:5173)
```

Si `git` no se reconoce como comando, hay que instalarlo desde `https://git-scm.com/downloads`.
Para parar el servidor: `Ctrl + C`. Para probar el modo "sin conexión" de esta clase: en Chrome/Edge,
`F12` → pestaña **Network** → selector **Offline**.

---

## 1. ¿Qué es un hook? Las 2 reglas

Un **hook** es una función de React (su nombre siempre empieza con `use`) que te deja usar estado y
otras funciones de React **sin escribir una clase**. Existen desde React 16.8.

**Las 2 reglas:**
1. Los hooks se llaman **solo en el nivel superior** del componente: nunca dentro de un `if`, un
   `for` o una función anidada. React los identifica por el **orden** en que se llaman.
2. Solo se llaman desde **componentes de función** o desde **otros hooks propios**.

**Clases vs. hooks:**

| Con clase | Con hooks |
| :--- | :--- |
| `this.state = { count: 0 }` + `this.setState(...)` | `const [count, setCount] = useState(0)` |
| `componentDidMount` + `componentDidUpdate` (duplicados) | **un solo** `useEffect` |
| `componentWillUnmount` | el `return` de ese mismo `useEffect` |

---

## 2. `useState`

```jsx
const [hechizos, setHechizos] = useState(0);
```

* Devuelve **un par**: el valor actual y la función para cambiarlo. Esa sintaxis se llama
  **desestructuración de arrays**; los nombres los elegís vos (por convención `algo` y `setAlgo`).
* El argumento (`0`) es el valor **inicial** y solo se usa en el primer render.
* El estado no tiene que ser un objeto: puede ser un número, un string, un booleano, un array.
* Podés usar `useState` varias veces en un mismo componente, una por cada dato independiente.
* 🔑 **Actualizar el estado lo REEMPLAZA, no lo combina.** Si el estado es un objeto y hacés
  `setPerfil({ edad: 30 })`, el resto de las propiedades desaparece. Hay que copiarlas:
  `setPerfil({ ...perfil, edad: 30 })`.
* Cuando el próximo valor **depende del anterior**, usá la forma funcional:
  `setHechizos((h) => h + 1)`. Con `setHechizos(hechizos + 1)` llamado dos veces seguidas en el mismo
  handler, ambas leen el mismo valor viejo y suma solo 1.

---

## 3. `useEffect`

Un **efecto secundario** es cualquier cosa que el componente hace "hacia afuera" de dibujar JSX:
cambiar el título de la pestaña, pedir datos a una API, escuchar un evento, arrancar un temporizador.

```jsx
useEffect(() => {
  document.title = `Hechizos lanzados: ${hechizos}`;
}, [hechizos]);
```

React ejecuta el efecto **después** de dibujar en pantalla. El **array de dependencias** controla
**cuándo** se vuelve a ejecutar:

| Código | Cuándo corre | En clases |
| :--- | :--- | :--- |
| `useEffect(() => {...})` *(sin array)* | En **cada** render | `componentDidMount` + `componentDidUpdate` |
| `useEffect(() => {...}, [])` | **Una sola vez**, al montar | `componentDidMount` |
| `useEffect(() => {...}, [a, b])` | Al montar y cada vez que `a` o `b` cambian | `componentDidUpdate` |
| `return () => {...}` adentro del efecto | Al **desmontar** | `componentWillUnmount` |

**La limpieza.** Todo lo que se abre en un `useEffect` se cierra en su `return`:

```jsx
useEffect(() => {
  window.addEventListener("online", handleOnline);

  return () => {
    window.removeEventListener("online", handleOnline);   // limpieza
  };
}, []);
```

Si no se limpia, el listener (o el temporizador, o la suscripción) sigue vivo aunque el componente
ya no exista.

**Detalle de `StrictMode`:** en desarrollo, React ejecuta cada efecto **dos veces** al montar
(monta → desmonta → monta), a propósito, para ayudarte a detectar limpiezas que faltan. En
producción no pasa. No es un bug.

---

## 4. Custom Hooks

Un **Custom Hook** es una función común, cuyo nombre empieza con `use`, que adentro usa otros hooks.
Sirve para **reutilizar lógica** entre componentes.

El problema: `IndicadorConexion` (el punto del header) y `BannerConexion` (el aviso amarillo) necesitan
saber si hay internet. Sin hook propio, los dos copiarían el mismo bloque de `useState` + `useEffect`.
La solución: extraerlo.

```jsx
// hooks/useEstadoConexion.js
import { useState, useEffect } from "react";

function useEstadoConexion() {
  const [enLinea, setEnLinea] = useState(navigator.onLine);

  useEffect(() => {
    const handleOnline = () => setEnLinea(true);
    const handleOffline = () => setEnLinea(false);

    window.addEventListener("online", handleOnline);
    window.addEventListener("offline", handleOffline);

    return () => {
      window.removeEventListener("online", handleOnline);
      window.removeEventListener("offline", handleOffline);
    };
  }, []);

  return enLinea;
}

export default useEstadoConexion;
```

```jsx
// En cualquier componente que lo necesite, una línea:
const enLinea = useEstadoConexion();
```

**Tres preguntas frecuentes:**
* **¿Tengo que nombrarlo con `use`?** Sí. React y el linter usan ese prefijo para saber que adentro
  hay hooks y poder verificar las 2 reglas.
* **¿Dos componentes que usan el mismo hook comparten estado?** **No.** Se comparte la **lógica**,
  no los **datos**: cada llamada al hook crea su propio `useState` y su propio `useEffect`.
* **¿Entonces por qué cambian los dos a la vez al apagar internet?** Porque cada uno recibe el
  evento `offline` del navegador por su cuenta.

---

## 5. Ejemplo real: `useFetch`

En el proyecto de personajes, `ListaPersonajes` y `DetallesPersonaje` repetían la misma lógica:
un `useState` para los datos, otro para `loading`, un `useEffect` con `async/await` y `try/catch`.
Es el mismo caso: se extrae a un Custom Hook que recibe la **URL** y devuelve `{ data, loading, error }`.

```jsx
// hooks/useFetch.js
import { useState, useEffect } from "react";

function useFetch(url) {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    let cancelado = false;            // ignora respuestas viejas
    setLoading(true);
    setError(null);

    fetch(url)
      .then((res) => {
        if (!res.ok) throw new Error(`Error ${res.status}`);
        return res.json();
      })
      .then((json) => { if (!cancelado) setData(json); })
      .catch((err) => { if (!cancelado) setError(err.message); })
      .finally(() => { if (!cancelado) setLoading(false); });

    return () => { cancelado = true; };   // limpieza
  }, [url]);                              // vuelve a pedir si cambia la URL

  return { data, loading, error };
}
```

Y los componentes quedan así:

```jsx
// Lista: antes eran 2 useState + useEffect + try/catch
const { data: personajes, loading, error } = useFetch("https://hp-api.onrender.com/api/characters");
if (loading) return <p>Cargando personajes...</p>;
if (error)   return <p>No se pudieron cargar los personajes: {error}</p>;

// Detalle: el id viene de la URL de la ruta
const { id } = useParams();
const { data, loading, error } = useFetch(`https://hp-api.onrender.com/api/character/${id}`);
const personaje = data?.[0];
```

* Es la dependencia **`[url]`** la que hace que, al pasar de un personaje a otro (cambia el `id`),
  se vuelva a pedir el dato solo.
* El `cancelado` + el `return` del efecto evitan guardar una respuesta **vieja** si el usuario ya
  se fue o cambió de personaje.
* Siempre revisar `loading` **antes** de usar `data`: mientras carga, `data` es `null`.
* La URL puede ser de cualquier API: la de internet o una **local** (un `json-server` en `http://localhost:3001`). El hook no cambia, solo la URL que le pasás.

---

## 6. `useReducer`

`useReducer` conviene en lugar de `useState` cuando:
* el estado tiene **varios valores que cambian juntos**, o
* el **próximo estado depende del anterior**.

En el marcador de cada casa, cada acción cambia los **puntos** y los **movimientos** a la vez.

**Las tres piezas:**

| Pieza | Qué es | En el proyecto |
| :--- | :--- | :--- |
| **Estado** | Un objeto con todo lo que cambia junto | `{ puntos: 0, movimientos: 0 }` |
| **Reducer** | Función `(estado, acción) => nuevoEstado` que decide cómo cambia | `marcadorReducer` |
| **`dispatch`** | Función que "manda" una acción al reducer | `dispatch({ type: "sumar", cantidad: 10 })` |

```jsx
// marcadorReducer.js
export const estadoInicial = { puntos: 0, movimientos: 0 };

export function marcadorReducer(state, action) {
  switch (action.type) {
    case "sumar":
      return { puntos: state.puntos + action.cantidad, movimientos: state.movimientos + 1 };
    case "restar":
      return { puntos: state.puntos - action.cantidad, movimientos: state.movimientos + 1 };
    case "reiniciar":
      return estadoInicial;
    default:
      throw new Error(`Acción desconocida: ${action.type}`);
  }
}
```

```jsx
// Marcador.jsx
const [state, dispatch] = useReducer(marcadorReducer, estadoInicial);

<button onClick={() => dispatch({ type: "sumar", cantidad: 10 })}>+10</button>
```

* La acción es **un objeto cualquiera**: acá lleva `type` y `cantidad`, pero puede llevar lo que haga falta.
* El reducer **nunca modifica `state`**: devuelve un objeto **nuevo**.
* El `default` con `throw` hace que, si escribís mal el `type`, el error se vea de inmediato.
* Cada `Marcador` tiene **su propio** `useReducer`: sumarle puntos a Gryffindor no toca a las demás
  casas. Igual que con el Custom Hook: se comparte el código, no el estado.

---

## 7. Reglas de oro

1. **Los hooks se llaman siempre en el nivel superior**, en el mismo orden en cada render.
2. **Actualizar el estado lo REEMPLAZA.** Con objetos, copiá lo que querés conservar (`...perfil`).
3. **El array de `useEffect` decide cuándo corre:** sin array = siempre · `[]` = una vez · `[a]` = cuando `a` cambia.
4. **Lo que se abre en un efecto se cierra en su `return`:** listeners, temporizadores, suscripciones.
5. **Un Custom Hook comparte lógica, no estado.** Cada llamada tiene el suyo.
6. **Un reducer nunca muta `state`:** siempre devuelve un objeto nuevo.

---

## 8. Diccionario de errores

| Síntoma | Causa típica |
| :--- | :--- |
| `Identifier 'hechizos' has already been declared` | Dejaste las líneas de ejemplo **y** agregaste el `useState`. Hay que **reemplazarlas**, no sumar |
| `React Hook ... is called conditionally` / `Rendered more hooks than during the previous render` | Un hook quedó dentro de un `if`, o después de un `return` anticipado |
| Hacés click dos veces seguidas y suma solo 1 | `setX(x + 1)` dos veces en el mismo handler. Usá `setX((v) => v + 1)` |
| Al guardar un objeto en el estado, desaparecen propiedades | Actualizar **reemplaza**. Copiá el resto: `{ ...objeto, campo: nuevo }` |
| El navegador se cuelga / bucle infinito | `useEffect` **sin array** que cambia un estado adentro: cambia → re-render → corre → cambia… |
| Los efectos corren dos veces en la consola | `StrictMode` en desarrollo. En producción no pasa |
| El hook "no anda" y no hay error | El nombre no empieza con `use`, o se importó mal (con o sin llaves) |
| `Acción desconocida: ...` | El `type` del `dispatch` no coincide, letra por letra, con ningún `case` |
| `Cannot read properties of null (reading 'map')` con `useFetch` | Usaste `data` antes de que cargue. Primero `if (loading) return ...` |
| El estado no cambia en pantalla y no hay error | Asignaste directo (`favorita = x`) en vez de usar la función `set...` |

---

## 9. Chuleta final

```jsx
// useState — dato que cambia
const [valor, setValor] = useState(inicial);
setValor((v) => v + 1);                       // si depende del anterior

// useEffect — efectos, y su limpieza
useEffect(() => {
  // corre al montar (y cuando cambie algo de [])
  return () => { /* limpieza: corre al desmontar */ };
}, []);                                       // [] = una vez · [a] = cuando a cambia · sin array = siempre

// Custom Hook — lógica reutilizable (siempre empieza con "use")
function useAlgo() {
  const [x, setX] = useState(null);
  useEffect(() => { /* ... */ }, []);
  return x;
}
const x = useAlgo();                          // cada llamada = su propio estado

// useReducer — estado con varios valores que cambian juntos
const [state, dispatch] = useReducer(reducer, estadoInicial);
dispatch({ type: "sumar", cantidad: 10 });
// reducer: (state, action) => nuevoEstado   (nunca muta state)
```

---

## 10. Cierre del curso: el mapa completo

Para repasar antes de la Evaluación Final Integradora:

| Módulo | Qué aprendimos | Idea que lo atraviesa |
| :--- | :--- | :--- |
| **1 · PHP** | POO (clases, objetos, herencia, encapsulamiento) y CodeIgniter 3 (MVC, rutas, formularios, validación) | **Separar responsabilidades**: modelo, vista y controlador |
| **2 · JavaScript** | DOM, ES6 (`let`/`const`, arrow functions, módulos, clases), asincronismo y AJAX | **Pedir datos al servidor sin recargar la página** |
| **3 · React** | Componentes y props → estado y ciclo de vida → rutas → hooks | **Componentes chicos y reutilizables** |

**El hilo que une los tres módulos:** dividir en piezas chicas con una responsabilidad clara y
reutilizarlas. Un controlador no hace lo que hace un modelo; un componente no hace lo que hace otro;
un Custom Hook extrae lo que se repite.

**Cómo se conectan entre sí:**
* El `useFetch` de esta clase es **AJAX del Módulo 2** hecho hook: pide datos a una URL y los
  entrega al componente.
* Esa URL puede ser cualquier API, incluso un backend hecho en **CodeIgniter** (Módulo 1) que
  devuelva JSON.
* Las rutas de React Router (`/casas/:id`) cumplen el mismo rol que las rutas de CodeIgniter
  (`productos/ver/2`): una URL decide qué se muestra.

**Cómo repasar:** abrí el `final/` de cada clase y el `RESUMEN-…` correspondiente; el diccionario de
errores de cada uno reúne los errores más comunes de esa unidad.
