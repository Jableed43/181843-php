# 🕒 Guía de Clase: React JS — Routing con React Router (60 min)

> Basada en: [`text.md`](text.md) (transcripción de la presentación — Módulo III, Unidad 3:
> "Routing en React Js").
>
> **Formato: teórico-práctica, código en vivo paso a paso.** Es la clase en la que la app deja de
> ser "una pantalla" y pasa a tener varias páginas navegables. Los alumnos completan 9 TODO a lo
> largo de la clase (no al final), y cierran con un mini desafío autónomo. Asumo 60 minutos, igual
> que las clases anteriores — si tu módulo dura otra cosa, recortá por el final (ver "Plan B").
>
> 📂 **El código está en `base/` y `final/`**, dos proyectos Vite ya instalados (`node_modules`
> incluido, `react-router-dom` ya está en el `package.json`). Son standalone: no dependen de ningún
> otro archivo fuera de esta carpeta.
>
> ⚠️ **`text.md` está escrito para React Router v5** (`Switch`, `useHistory`, `Redirect`,
> `exact`), una versión que **ya no existe**: hoy se instala la v7, y copiar el código del
> material tal cual da error. Esta clase enseña **los mismos conceptos con la sintaxis actual**.
> La tabla de equivalencias está en el Bloque 1 — conviene dejarla en el pizarrón porque los
> alumnos van a ver tutoriales viejos.

## 🚀 Accesos y Herramientas Rápidas (Machete para el Profe)

| Elemento | Enlace / Comando / Recurso |
| :--- | :--- |
| **Entorno** | Node.js instalado, terminal, VS Code, navegador con DevTools (F12) |
| **Carpeta de trabajo** | `cursada_php/unidad_3_mod_3/` |
| **Starter (para repartir)** | `unidad_3_mod_3/base/` |
| **Resuelto (para vos)** | `unidad_3_mod_3/final/` |
| **Levantar cualquiera de los dos** | `cd base` (o `final`) `&& npm run dev` → abre `http://localhost:5173` |
| **Presentación / temario original** | [`text.md`](text.md) |
| **Instalación de la librería** | `npm install react-router-dom` (ya hecho en `base/` y `final/`; mostrarlo igual) |
| **Tema de la práctica** | Hogwarts multi-página: Inicio, Casas, Detalle de casa, Registro y 404 |
| **Rutas del proyecto** | `/` · `/casas` · `/casas/:id` · `/registro` · `/home` (redirige a `/`) · cualquier otra → 404 |
| **Analogía ancla** | Un edificio con recepción: la **URL** es el piso que pedís, **`<Routes>`** es el ascensorista que decide a qué piso (componente) llevarte, y **`<Link>`** es el botón del ascensor. Con un `<a>` común "salís del edificio y volvés a entrar". |

⚠️ **Verificación pre-clase (5 min antes de arrancar):**
1. `npm run dev` en `final/` y recorrer: Inicio → Casas → click en una casa → Volver → Registro →
   "Ir al inicio". La pestaña **Network** de DevTools no debería mostrar recargas de documento al
   navegar.
2. Escribir a mano en la barra `localhost:5173/home` (tiene que saltar a `/`) y
   `localhost:5173/cualquier-cosa` (tiene que mostrar el 404).
3. En `base/`, click en "Casas" del menú: la URL cambia pero sigue mostrando Inicio y la página
   parpadea (recarga completa). Ese es el problema que resuelve la clase.
4. Tener `base/` abierto en el editor, con la fuente grande.

---

## 📅 Bloque 1: ¿Qué es el routing? (00:00 - 00:08)

* **🧠 Concepto principal:** Una app React es **una sola página HTML** (ya lo vieron en la Clase 1:
  un `index.html` con un `<div id="root">`). Pero el usuario espera poder ir a `/casas`,
  compartir el link de `/casas/ravenclaw` o volver con el botón "atrás". **El router es lo que
  hace que la URL y el componente que se muestra estén sincronizados**, sin recargar nada.

* **🧠 React Router no es parte de React** (lo dice `text.md`): es una librería aparte, la más
  usada para esto. Se instala una vez por proyecto:
  ```bash
  npm install react-router-dom
  ```
  Mostrarlo y señalar que queda anotado en `package.json` bajo `dependencies` (repaso de la
  Clase 1: es algo que el navegador del usuario final necesita).

* **🎬 Demo del problema (en `base/`):** abrir `base/`, click en "Casas". La URL cambia a `/casas`
  pero la pantalla sigue en Inicio y se nota la recarga. Preguntar: *"¿por qué?"* → el
  `<a href>` le pide al **navegador** una página nueva (recarga todo), y aunque la URL cambie, **no
  hay nadie que le diga a React qué mostrar** para `/casas`. Eso es lo que vamos a construir.

* **🧠 Tabla de equivalencias v5 (material) → versión actual (la que usamos) — dejar en el pizarrón:**

  | `text.md` (v5, obsoleto) | Hoy (v6/v7) | Notas |
  | :--- | :--- | :--- |
  | `BrowserRouter as Router` | `BrowserRouter` | Ya no hace falta el alias |
  | `<Switch>` | `<Routes>` | |
  | `<Route path="/x"><Comp /></Route>` | `<Route path="/x" element={<Comp />} />` | El componente va en la prop `element` |
  | `exact` | *(no hace falta)* | Hoy el match es exacto por defecto |
  | `<NavLink exact>` | `<NavLink end>` | Mismo concepto, otro nombre |
  | `useHistory()` + `history.push("/x")` | `useNavigate()` + `navigate("/x")` | |
  | `history.goBack()` | `navigate(-1)` | |
  | `<Redirect from="/a" to="/b" />` | `<Route path="/a" element={<Navigate to="/b" replace />} />` | |
  | `this.props.params.id` (clases) | `useParams()` | Con hooks, igual que en `text.md` |
  | El **orden** de las rutas importa (primera que coincide gana) | **No importa** (React Router elige la más específica) | `path="*"` ya no *necesita* ir al final, pero conviene dejarlo ahí por claridad |

* **⚠️ No profundizar hoy en:** rutas anidadas con `<Outlet />`, `createBrowserRouter`, loaders y
  actions. Existen, pero no son parte del temario de esta unidad.

---

## 🧩 Bloque 2: Configurar las rutas (00:08 - 00:21)

**Cómo dar este bloque:** abrir [`final/src/App.jsx`](final/src/App.jsx) como referencia y hacer
los TODO 1 al 3 en vivo sobre `base/`. Cada paso: explicar → escribirlo → probar en el navegador.

### 2.1 — `BrowserRouter` (TODO 1)

```jsx
import { BrowserRouter } from "react-router-dom";

<BrowserRouter>
  <Menu />
  <main> ... </main>
</BrowserRouter>
```

* `BrowserRouter` **activa el ruteo** para todo lo que tiene adentro: cualquier `Link`, `Routes` o
  hook de React Router **solo funciona adentro** de uno. Es el paso que más se olvida.
* Usa la URL "de verdad" del navegador (`/casas`), no un `#/casas`.

### 2.2 — `Routes` y `Route` (TODO 2)

```jsx
<Routes>
  <Route path="/" element={<HomePage />} />
  <Route path="/casas" element={<CasasPage />} />
  <Route path="/registro" element={<RegistroPage />} />
</Routes>
```

* `Routes` mira la URL actual y renderiza **una sola** `Route`: la que coincide.
* Cada `Route` tiene dos props: **`path`** (la URL) y **`element`** (el componente a mostrar,
  escrito como JSX: `<HomePage />`, con los `< />`).
* Lo que está **fuera** de `<Routes>` (el `Menu`) se ve en todas las páginas; lo que está
  **adentro** cambia según la URL. Esa es la estructura típica de cualquier sitio.

**Probar ahora:** escribir a mano `localhost:5173/casas` en la barra → aparece la lista de casas.
Ya hay ruteo. Todavía falta que el menú navegue sin recargar.

### 2.3 — `Link` (TODO 3)

En `Menu.jsx`, cambiar cada `<a href="/casas">` por:

```jsx
import { Link } from "react-router-dom";

<Link to="/casas">Casas</Link>
```

* **`Link` es el reemplazo de `<a>`** (lo dice `text.md`): la prop se llama **`to`**, no `href`.
* Diferencia clave, para decirlo en voz alta: `<a>` le pide una página nueva **al servidor** (recarga
  todo y se pierde cualquier estado de React). `Link` solo cambia la URL y le avisa a React Router,
  que cambia el componente **sin recargar nada**.

**Probar ahora:** click en "Casas" → cambia la pantalla **sin parpadeo**. (Para mostrarlo con
evidencia: DevTools → Network → no aparece ningún pedido nuevo de documento.)

---

## 🧭 Bloque 3: `NavLink` y parámetros por URL (00:21 - 00:33)

### 3.1 — `NavLink` (TODO 4)

```jsx
import { NavLink } from "react-router-dom";

<NavLink to="/" end>Inicio</NavLink>
<NavLink to="/casas">Casas</NavLink>
```

* `NavLink` es un `Link` que **sabe si apunta a la página actual** y, en ese caso, le agrega solo
  la clase CSS `active`. En `App.css` ya está `.menu a.active` con el estilo amarillo: no hay que
  escribir ningún `if`.
* **La prop `end`** (antes `exact`): sin ella, "Inicio" (`/`) quedaría marcado como activo en
  *todas* las páginas, porque todas las URLs "empiezan con `/`". `end` dice "solo cuando sea
  exactamente esta".
* **Mostrarlo:** sacar `end` en vivo y navegar a Casas → los dos quedan amarillos. Volver a ponerlo.

### 3.2 — Rutas con parámetro (TODO 5 y TODO 6)

La lista de casas (`CasasPage`, ya hecha) genera links como `/casas/ravenclaw`. Hace falta **una
sola ruta** que atienda a todos:

```jsx
<Route path="/casas/:id" element={<DetallePage />} />
```

* **`:id`** (con dos puntos) es un **parámetro**: acepta cualquier valor en esa posición
  (`/casas/gryffindor`, `/casas/slytherin`...). El nombre después de los dos puntos es el que se
  usa para leerlo.

Y adentro de `DetallePage` se lee con el hook **`useParams`**:

```jsx
import { useParams } from "react-router-dom";

const { id } = useParams();
const casa = casas.find((c) => c.id === id);
```

* `useParams()` devuelve un objeto con todos los parámetros de la URL; se desestructura el que se
  necesita. **El nombre tiene que coincidir con el de la ruta** (`:id` → `id`).
* ⚠️ **Siempre llegan como string.** Acá los ids son texto (`"ravenclaw"`) así que se comparan
  directo; si fueran números (`1`, `2`) habría que convertir: `Number(id)`.
* En `text.md` esto se muestra con `this.props.params.id` para clases y `useParams` para funciones;
  hoy se usa siempre `useParams`.

**Probar ahora:** click en una casa del listado → se ve el detalle con su color. Escribir a mano
`/casas/durmstrang` → "Casa no encontrada" (la página maneja el caso en vez de romper).

---

## 🚦 Bloque 4: Navegar por código, redirigir y 404 (00:33 - 00:43)

### 4.1 — `useNavigate`: navegación programática (TODO 7)

A veces hay que cambiar de página **sin que el usuario clickee un link**: después de guardar un
formulario, al terminar un login, con un botón "volver". Para eso:

```jsx
import { useNavigate } from "react-router-dom";

const navigate = useNavigate();

navigate("/");   // ir a una ruta
navigate(-1);    // un paso atrás en el historial (como el botón "atrás" del navegador)
```

* Es el reemplazo de `useHistory` / `history.push` de `text.md`.
* **Regla para decidir:** ¿el usuario hace click en algo que es "un link"? → `Link`/`NavLink`.
  ¿La navegación ocurre como **consecuencia de algo que hace el código**? → `useNavigate`.

**Probar ahora:** ir a Registro → "Ir al inicio" lleva a `/`; entrar a Casas y después a Registro →
"Volver" regresa a Casas.

### 4.2 — `Navigate`: redirecciones (TODO 8)

```jsx
<Route path="/home" element={<Navigate to="/" replace />} />
```

* Cuando alguien entra a `/home`, lo mandamos a `/`. Es el reemplazo de `<Redirect>` de `text.md`.
* **`replace`**: en vez de *sumar* una entrada al historial, *reemplaza* la actual. Sin él, si el
  usuario aprieta "atrás" vuelve a `/home` y lo vuelve a redirigir: queda atrapado.
* **Mostrarlo:** escribir `/home` a mano → termina en `/`. Y probar que el botón "atrás" no lo
  atrapa.
* 🎯 Conexión con `text.md`: ahí el botón de Registro hacía `history.push("/home")` justamente para
  mostrar la redirección. Se puede probar cambiando `navigate("/")` por `navigate("/home")`.

### 4.3 — `path="*"`: página 404 (TODO 9)

```jsx
<Route path="*" element={<NotFoundPage />} />
```

* `*` significa "cualquier cosa". Como React Router elige la ruta **más específica** que coincide,
  `*` solo se usa cuando ninguna otra encaja. (En v5 había que ponerlo último porque `Switch`
  tomaba la *primera* coincidencia; hoy ya no hace falta, pero se sigue dejando al final por
  claridad.)
* **Probar:** escribir `/esto/no/existe` → 404, con un `Link` de vuelta al inicio. Notar que en
  ese caso ningún link del menú queda activo.

---

## 🎯 Bloque 5: Desafío autónomo (00:43 - 00:53)

**Dinámica:** de forma individual, sin ayuda directa, sobre el `base/` que ya completaron.
Objetivo: comprobar que entendieron el **patrón completo**, no cada TODO suelto.

> **Consigna:** agregar una página **"Contacto"** (`/contacto`) que:
> 1. Sea un componente nuevo en `src/paginas/ContactoPage.jsx` con un título y un texto.
> 2. Tenga su ruta en `App.jsx`.
> 3. Aparezca en el menú, con `NavLink`.
> 4. *(Opcional)* Tenga un botón "Volver" que use `useNavigate`.

**Qué tienen que hacer (solución, para que puedas chequear rápido):**
1. Crear el componente (función que devuelve JSX + `export default`).
2. En `App.jsx`: `import ContactoPage ...` y `<Route path="/contacto" element={<ContactoPage />} />`.
3. En `Menu.jsx`: `<NavLink to="/contacto">Contacto</NavLink>`.

**Mientras circulás, los errores más comunes:** se olvidan el `import` en `App.jsx` (error
"ContactoPage is not defined"), o la ruta en `App.jsx` pero no el link del menú (anda escribiendo la
URL a mano, pero no se puede llegar clickeando).

---

## 🏁 Bloque 6: Puesta en común y cierre (00:53 - 01:00)

* **Comparar con el resuelto:** abrir [`final/`](final/) corriendo y revisar entre todos que las 6
  rutas funcionan.
* **Repaso relámpago:**
  * ¿Qué diferencia hay entre `<a>` y `<Link>`? → `<a>` recarga toda la página; `Link` solo cambia
    el componente.
  * ¿Cómo se declara una ruta con parámetro y cómo se lee? → `path="/casas/:id"` y `useParams()`.
  * ¿Cuándo `useNavigate` y cuándo `Link`? → `Link` cuando el usuario clickea un enlace;
    `useNavigate` cuando la navegación la dispara el código.
  * ¿Cómo se arma un 404? → `<Route path="*" ... />`.
* **Mapa mental de cierre (pizarrón):**
  `BrowserRouter → Routes → Route (path + element) → Link / NavLink → useParams → useNavigate / Navigate → path="*"`
* **Próxima clase:** **Hooks** (`useState` y `useEffect` a fondo, Custom Hooks y `useReducer`).
  Las páginas de hoy son casi estáticas; con hooks van a poder guardar datos, reaccionar a lo que
  hace el usuario y reutilizar lógica entre componentes.

---

## 🆘 Tips de Supervivencia (Machete final)

### 🏆 Reglas de Oro
1. **Todo lo de React Router (`Link`, `Routes`, hooks) vive adentro de un `BrowserRouter`.**
2. **`Link`/`NavLink` en vez de `<a>`, y `to` en vez de `href`.** Un `<a>` recarga la app entera.
3. **`element={<Componente />}`**, con JSX (los `< />`), no `element={Componente}`.
4. **Los parámetros se declaran con `:nombre` y se leen con `useParams()` — mismo nombre en los
   dos lados. Siempre llegan como string.**
5. **`end` en el `NavLink` de `/`**, o queda activo en todas las páginas.
6. **Siempre tener un `path="*"`**: sin él, una URL equivocada deja la pantalla en blanco.

### 🚩 ¿Errores o dudas frecuentes?
* **`"Switch" is not exported by react-router-dom` / `useHistory is not a function` /
  `Redirect`** → copiaron código del material (o de un tutorial viejo) escrito para v5. Usar la
  tabla de equivalencias del Bloque 1.
* **`useRoutes() may be used only in the context of a <Router> component` /
  `Cannot destructure property 'basename'...`** → hay un `Link`, `NavLink`, `Routes` o hook
  **fuera** de `<BrowserRouter>` (típicamente el `Menu`, que quedó afuera del envoltorio).
* **El link no hace nada / la URL no cambia** → escribieron `<Link href="...">` en vez de
  `<Link to="...">`.
* **"Inicio" queda marcado como activo en todas las páginas** → falta `end` en ese `NavLink`.
* **`useParams()` devuelve `{}` o `id` es `undefined`** → el nombre del parámetro no coincide con el
  de la ruta (`path="/casas/:codigo"` pero se lee `const { id }`), o el componente se usa en una
  ruta sin parámetro.
* **La página queda en blanco al ir a una URL inventada** → falta la ruta `path="*"`.
* **Funciona en `npm run dev` pero, al subir el `build` a un servidor (XAMPP/Apache), recargar en
  `/casas` da error 404 del servidor** → es normal: el servidor busca un archivo `/casas` que no
  existe (la app es un solo `index.html`). Hay que configurarlo para que cualquier URL devuelva
  `index.html` (en Apache, una regla de `mod_rewrite` en `.htaccess`). Vite en desarrollo ya lo
  hace solo, por eso no se nota hasta publicar.
* **"¿Por qué `react-router-dom` y no `react-router`?"** → en la v7 son lo mismo (`-dom` re-exporta
  todo). El curso usa `-dom` porque es lo que aparece en el material y en casi todos los ejemplos.

### 🔄 Plan B (Troubleshooting)
* **Si el grupo viene flojo de la clase anterior:** hacer solo los TODO 1 al 6 (rutas, `Link`,
  `NavLink`, parámetros) y dejar `useNavigate`, `Navigate` y 404 como demostración tuya. Es mejor
  que el ruteo básico quede sólido.
* **Si sobra tiempo:** que los alumnos hagan el botón "Volver" del desafío con `navigate(-1)` y
  prueben la diferencia con `navigate("/casas")` (uno depende del historial, el otro va a un
  lugar fijo).
* **Si falta tiempo:** saltear el desafío autónomo (Bloque 5) y hacerlo como demostración tuya en
  2 minutos (crear página, ruta, link).
* **Si no levanta el proyecto de un alumno:** que clone/copie `final/`, y que cambie solo lo que
  esté trabajando — el objetivo es entender el ruteo, no perder la clase en dependencias.
* **Si falla el proyector:** el núcleo se explica con la analogía del edificio y la tabla de
  equivalencias del pizarrón.

---

## 📋 Instrucciones para el Alumno (enviar ANTES de la clase)

**Qué traer listo:**
1. Node.js instalado y funcionando.
2. La carpeta `unidad_3_mod_3/base/` copiada en su compu.
3. Adentro de `base/`, correr `npm install` **antes** de la clase (instala también
   `react-router-dom`, que ya está en el `package.json`).
4. Navegador con DevTools (Chrome o Edge).

**Con qué venir pensado:**
* Repasar de las clases anteriores: componentes, props, `import`/`export`, `.map()` y qué es un
  componente "padre" y uno "hijo".

---

## 🛠️ Material Entregable (Para el alumno)

### 1. Starter — carpeta [`base/`](base/) (se reparte al inicio de la clase)
Proyecto Vite + React con las páginas y los datos ya armados, y los 9 `// TODO` de ruteo.

| Archivo | Qué tiene que completar el alumno |
| :--- | :--- |
| [`base/src/App.jsx`](base/src/App.jsx) | `BrowserRouter`, `Routes`/`Route`, ruta con `:id`, `Navigate` y `path="*"` (TODO 1, 2, 5, 8, 9) |
| [`base/src/componentes/Menu.jsx`](base/src/componentes/Menu.jsx) | De `<a>` a `Link` y de `Link` a `NavLink` (TODO 3 y 4) |
| [`base/src/paginas/DetallePage.jsx`](base/src/paginas/DetallePage.jsx) | Leer el id con `useParams` (TODO 6) |
| [`base/src/paginas/RegistroPage.jsx`](base/src/paginas/RegistroPage.jsx) | Navegar por código con `useNavigate` (TODO 7) |

Ya vienen completos: `HomePage`, `CasasPage` (ejemplo de `Link` dentro de un `.map()`),
`NotFoundPage` y los datos de las casas.

### 2. Resuelto — carpeta [`final/`](final/) (se comparte al terminar la clase)
Los mismos archivos 100% completos y funcionando, para que puedan comparar solos.

### 3. Material de lectura opcional
[`text.md`](text.md) — la presentación completa de la unidad. **Está escrita para React Router v5**
(`Switch`, `useHistory`, `Redirect`): sirve para entender los conceptos y reconocer código viejo,
pero **no se debe copiar tal cual**. Usar la tabla de equivalencias del Bloque 1.
