# Resumen — Routing en React (React Router)

> Salida de la clase. Sirve para repasar solo, sin el profe al lado. Todos los ejemplos son del
> proyecto de hoy (`base/` → `final/`): un sitio de Hogwarts con varias páginas — Inicio, Casas,
> Detalle de una casa, Registro y una página 404.

## Índice

0. [Levantar el proyecto](#0-levantar-el-proyecto)
1. [¿Qué es el routing?](#1-qué-es-el-routing)
2. [Instalación](#2-instalación)
3. [`BrowserRouter`, `Routes` y `Route`](#3-browserrouter-routes-y-route)
4. [`Link`: navegar sin recargar](#4-link-navegar-sin-recargar)
5. [`NavLink`: el link que sabe dónde estás](#5-navlink-el-link-que-sabe-dónde-estás)
6. [Parámetros por URL: `:id` y `useParams`](#6-parámetros-por-url-id-y-useparams)
7. [`useNavigate`: navegar por código](#7-usenavigate-navegar-por-código)
8. [`Navigate`: redirecciones](#8-navigate-redirecciones)
9. [Página no encontrada (404)](#9-página-no-encontrada-404)
10. [Cuidado con los tutoriales viejos (v5 vs. hoy)](#10-cuidado-con-los-tutoriales-viejos-v5-vs-hoy)
11. [Reglas de oro](#11-reglas-de-oro)
12. [Diccionario de errores](#12-diccionario-de-errores)
13. [Chuleta final](#13-chuleta-final)

---

## 0. Levantar el proyecto

Una vez que tengas la carpeta de la clase en tu compu (la que te pasó el profe, con `base/` adentro),
desde una terminal:

```bash
cd base          # entrar a la carpeta del proyecto (tiene que haber un package.json ahí)
npm install      # descarga todo lo que el proyecto necesita (react, vite, react-router-dom...)
npm run dev      # levanta el servidor de desarrollo
```

Después abrí en el navegador la dirección que muestra la terminal (normalmente
`http://localhost:5173/`). La terminal queda "colgada" mostrando el servidor: es normal. Para
pararlo, `Ctrl + C`. `npm install` se corre **una sola vez** por proyecto.

---

## 1. ¿Qué es el routing?

Una aplicación React es **una sola página HTML** (`index.html` con un `<div id="root">`). Pero el
usuario espera poder ir a `/casas`, compartir el link de `/casas/ravenclaw` o volver con el botón
"atrás" del navegador.

El **router** es lo que hace que **la URL y el componente que se muestra estén sincronizados**,
sin recargar la página. Cada "página" de la app es, en realidad, **un componente** que se muestra
según la URL.

**Analogía:** un edificio con recepción. La **URL** es el piso que pedís, **`<Routes>`** es el
ascensorista que decide a qué piso (componente) llevarte, y **`<Link>`** es el botón del
ascensor. Con un `<a>` común "salís del edificio y volvés a entrar".

---

## 2. Instalación

React Router **no viene con React**: es una librería aparte, que se instala una vez por proyecto
parado en la carpeta donde está el `package.json`:

```bash
npm install react-router-dom
```

Queda anotada en `package.json` bajo `dependencies` (el navegador del usuario final la necesita).
En el proyecto de la clase ya viene instalada: al hacer `npm install` se descarga sola.

---

## 3. `BrowserRouter`, `Routes` y `Route`

```jsx
// App.jsx
import { BrowserRouter, Routes, Route } from "react-router-dom";

function App() {
  return (
    <BrowserRouter>
      <Menu />

      <Routes>
        <Route path="/" element={<HomePage />} />
        <Route path="/casas" element={<CasasPage />} />
        <Route path="/registro" element={<RegistroPage />} />
      </Routes>
    </BrowserRouter>
  );
}
```

* **`BrowserRouter`** activa el ruteo para todo lo que tiene adentro. Cualquier `Link`, `Routes` o
  hook de React Router **solo funciona adentro de uno**. Es el paso que más se olvida.
* **`Routes`** mira la URL actual y muestra **una sola** `Route`: la que coincide.
* **`Route`** tiene dos props: **`path`** (la URL) y **`element`** (el componente a mostrar,
  escrito como JSX: `<HomePage />`, con los `< />`).
* Lo que está **fuera** de `<Routes>` (el `Menu`) se ve en **todas** las páginas. Lo que está
  **adentro** cambia según la URL.

---

## 4. `Link`: navegar sin recargar

```jsx
import { Link } from "react-router-dom";

<Link to="/casas">Casas</Link>
```

* `Link` es el reemplazo de `<a>`. La prop se llama **`to`**, no `href`.
* **La diferencia importante:** un `<a href>` le pide una página nueva **al servidor**: recarga todo
  y se pierde cualquier estado de React. Un `Link` solo cambia la URL y le avisa a React Router, que
  cambia el componente **sin recargar nada**.

También se puede armar la URL con datos, como hace `CasasPage` dentro del `.map()`:

```jsx
{casas.map((casa) => (
  <Link key={casa.id} to={`/casas/${casa.id}`}>
    <h3>{casa.nombre}</h3>
  </Link>
))}
```

---

## 5. `NavLink`: el link que sabe dónde estás

```jsx
import { NavLink } from "react-router-dom";

<NavLink to="/" end>Inicio</NavLink>
<NavLink to="/casas">Casas</NavLink>
<NavLink to="/registro">Registro</NavLink>
```

* `NavLink` es un `Link` que sabe si apunta a la página actual. Cuando es así, **le agrega solo la
  clase CSS `active`**. Alcanza con escribir el estilo:

  ```css
  .menu a.active {
    background: #ffd700;
    font-weight: bold;
  }
  ```
* **La prop `end`:** sin ella, "Inicio" (`/`) quedaría marcado como activo en *todas* las páginas,
  porque todas las URLs "empiezan con `/`". `end` dice "solo cuando sea exactamente esta".

---

## 6. Parámetros por URL: `:id` y `useParams`

La lista de casas genera links como `/casas/ravenclaw`, `/casas/slytherin`... No hace falta una
ruta por casa: **una sola ruta con parámetro** las atiende a todas.

```jsx
// En App.jsx
<Route path="/casas/:id" element={<DetallePage />} />
```

* **`:id`** (con dos puntos) es un **parámetro**: acepta cualquier valor en esa posición.

Y para leerlo, dentro del componente, el hook **`useParams`**:

```jsx
// DetallePage.jsx
import { useParams } from "react-router-dom";
import casas from "../datos/casas";

function DetallePage() {
  const { id } = useParams();
  const casa = casas.find((c) => c.id === id);
  // ...
}
```

* **El nombre tiene que coincidir** en los dos lados: `:id` en la ruta → `const { id }` en el hook.
* ⚠️ **Siempre llega como string.** Acá los ids son texto (`"ravenclaw"`), así que se comparan
  directo. Si fueran números (`1`, `2`...) habría que convertir: `Number(id)`.
* **Siempre hay que contemplar que el id no exista.** Si alguien escribe `/casas/durmstrang`,
  `find` devuelve `undefined`; por eso `DetallePage` revisa `if (!casa)` y muestra "Casa no
  encontrada" en vez de romper.

---

## 7. `useNavigate`: navegar por código

A veces hay que cambiar de página **sin que el usuario clickee un link**: después de guardar un
formulario, al terminar un login, con un botón "volver". Para eso:

```jsx
// RegistroPage.jsx
import { useNavigate } from "react-router-dom";

function RegistroPage() {
  const navigate = useNavigate();

  function irAlInicio() {
    navigate("/");     // ir a una ruta
  }

  function volver() {
    navigate(-1);      // un paso atrás en el historial (como el botón "atrás")
  }
  // ...
}
```

**Regla para decidir:**
* ¿El usuario hace click en algo que es "un link"? → `Link` / `NavLink`.
* ¿La navegación ocurre como **consecuencia de algo que hace el código**? → `useNavigate`.

---

## 8. `Navigate`: redirecciones

```jsx
import { Navigate } from "react-router-dom";

<Route path="/home" element={<Navigate to="/" replace />} />
```

* Cuando alguien entra a `/home`, el componente `Navigate` lo manda a `/`.
* **`replace`**: en vez de *sumar* una entrada nueva al historial, *reemplaza* la actual. Sin él, si
  el usuario aprieta "atrás" vuelve a `/home` y lo vuelve a redirigir: queda atrapado.
* No confundir: **`Navigate`** (con mayúscula) es un *componente* que se pone en el JSX;
  **`useNavigate`** es un *hook* que devuelve una función para usar en el código.

---

## 9. Página no encontrada (404)

```jsx
<Route path="*" element={<NotFoundPage />} />
```

* `*` significa "cualquier cosa". React Router elige la ruta **más específica** que coincide, así
  que `*` solo se usa cuando ninguna otra encaja.
* Sin esta ruta, escribir una URL inventada deja la pantalla en blanco. Se deja al final por
  claridad.

```jsx
// NotFoundPage.jsx
function NotFoundPage() {
  return (
    <section>
      <h2>404 — Página no encontrada</h2>
      <Link to="/">Volver al inicio</Link>
    </section>
  );
}
```

---

## 10. Cuidado con los tutoriales viejos (v5 vs. hoy)

Gran parte del material que vas a encontrar (apuntes, videos, respuestas de foros) está escrito
para **React Router v5**, una versión que **ya no existe**. Si copiás ese código en el proyecto
actual, da error. Esta tabla traduce lo viejo a lo actual:

| Código viejo (v5) | Hoy (v6/v7) |
| :--- | :--- |
| `import { BrowserRouter as Router }` | `import { BrowserRouter }` |
| `<Switch>` | `<Routes>` |
| `<Route path="/x"><Comp /></Route>` | `<Route path="/x" element={<Comp />} />` |
| `exact` en `Route` | *(no hace falta: el match ya es exacto)* |
| `<NavLink exact>` | `<NavLink end>` |
| `useHistory()` + `history.push("/x")` | `useNavigate()` + `navigate("/x")` |
| `history.goBack()` | `navigate(-1)` |
| `<Redirect from="/a" to="/b" />` | `<Route path="/a" element={<Navigate to="/b" replace />} />` |
| El **orden** de las rutas importaba (ganaba la primera que coincidía) | **No importa**: se elige la más específica |

---

## 11. Reglas de oro

1. **Todo lo de React Router (`Link`, `Routes`, hooks) vive adentro de un `BrowserRouter`.**
2. **`Link`/`NavLink` en vez de `<a>`, y `to` en vez de `href`.** Un `<a>` recarga la app entera.
3. **`element={<Componente />}`**, con JSX (los `< />`), no `element={Componente}`.
4. **Los parámetros se declaran con `:nombre` y se leen con `useParams()` — mismo nombre en los
   dos lados, y siempre llegan como string.**
5. **`end` en el `NavLink` de `/`**, o queda activo en todas las páginas.
6. **Siempre tener un `path="*"`** para las URLs que no existen.
7. **Si un tutorial usa `Switch`, `useHistory` o `Redirect`, está desactualizado:** usar la tabla
   de la sección 10.

---

## 12. Diccionario de errores

| Síntoma | Causa típica |
| :--- | :--- |
| `"Switch" is not exported by react-router-dom` / `useHistory is not a function` / `Redirect` | Código de la v5 pegado en un proyecto actual (ver tabla de la sección 10) |
| `useRoutes() may be used only in the context of a <Router> component` / `Cannot destructure property 'basename'...` | Hay un `Link`, `NavLink`, `Routes` o hook **fuera** de `<BrowserRouter>` (típicamente el `Menu`) |
| El link no hace nada / la URL no cambia | Se escribió `<Link href="...">` en vez de `<Link to="...">` |
| "Inicio" queda marcado como activo en todas las páginas | Falta `end` en ese `NavLink` |
| `useParams()` devuelve `{}` o `id` es `undefined` | El nombre no coincide (`path="/casas/:codigo"` pero se lee `const { id }`), o el componente está en una ruta sin parámetro |
| La página queda en blanco al ir a una URL inventada | Falta la ruta `path="*"` |
| La página parpadea / se pierde el estado al navegar | Se está usando `<a href>` en vez de `Link` |
| `"ContactoPage is not defined"` (o cualquier componente de página) | Falta el `import` de ese componente en `App.jsx` |
| Se llega a la página escribiendo la URL a mano, pero no clickeando | La ruta está en `App.jsx` pero falta el link en el menú |
| Al publicar el proyecto en un servidor, recargar en `/casas` da error 404 del servidor | El servidor busca un archivo `/casas` que no existe (la app es un solo `index.html`); hay que configurarlo para que cualquier URL devuelva `index.html` (en Apache, una regla `mod_rewrite` en `.htaccess`). Vite en desarrollo ya lo hace solo. |

---

## 13. Chuleta final

```jsx
// App.jsx — la estructura completa
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";

<BrowserRouter>
  <Menu />                                   {/* fuera de <Routes>: se ve siempre */}
  <Routes>
    <Route path="/" element={<HomePage />} />
    <Route path="/casas" element={<CasasPage />} />
    <Route path="/casas/:id" element={<DetallePage />} />          {/* :id = parámetro */}
    <Route path="/home" element={<Navigate to="/" replace />} />   {/* redirección */}
    <Route path="*" element={<NotFoundPage />} />                  {/* 404 */}
  </Routes>
</BrowserRouter>
```

```jsx
// Navegar con links (el usuario clickea)
<Link to="/casas">Casas</Link>
<NavLink to="/" end>Inicio</NavLink>        {/* agrega la clase "active" solo */}

// Leer un parámetro de la URL
const { id } = useParams();

// Navegar por código (lo dispara el programa)
const navigate = useNavigate();
navigate("/");     // a una ruta
navigate(-1);      // un paso atrás
```
