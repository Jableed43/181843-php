# 🎓 Guía de la clase — Hooks en React (última clase del curso)

> Esta guía es para **seguir durante la clase**: te dice qué vamos a construir, en qué archivo
> trabajamos en cada momento y cómo saber que te salió bien. Al terminar, el repaso teórico completo
> está en `RESUMEN-HOOKS-REACT.md`.

---

## 🎯 Objetivo de la clase

Aprender los **hooks** de React armando una pantallita de Hogwarts con **tres partes**, cada una
enseña un hook distinto:

| Parte | Qué construimos | Hook que aprendemos |
| :--- | :--- | :--- |
| **1 · Contador de hechizos** | Un botón que suma hechizos y **cambia el título de la pestaña** del navegador | `useState` y `useEffect` |
| **2 · Indicador de conexión** | Un punto verde/rojo en el header y un aviso amarillo que aparece si **se corta internet** | **Custom Hook** (`useEstadoConexion`) |
| **3 · Copa de las Casas** | Un marcador de puntos por casa, con botones **+10 / -10 / Reiniciar** | `useReducer` |

**Al terminar vas a saber:** guardar datos que cambian (`useState`), hacer cosas "hacia afuera" del
componente y limpiarlas (`useEffect`), reutilizar lógica entre componentes (Custom Hook) y manejar
un estado con varios valores que cambian juntos (`useReducer`).

---

## 👀 Así va a quedar (el resultado final)

```
┌──────────────────────────────────────────────────────────────┐
│ Hogwarts · Copa de las Casas                    ● En línea   │  ← Parte 2 (hook de conexión)
├──────────────────────────────────────────────────────────────┤
│ ⚠️ Perdiste la conexión...   (solo aparece si cortás internet)│  ← Parte 2
├──────────────────────────────────────────────────────────────┤
│            Práctica de hechizos                              │
│                      3                                       │  ← Parte 1 (useState)
│     [ ¡Lanzar hechizo! ]   [ Reiniciar ]                     │
├──────────────────────────────────────────────────────────────┤
│                  Copa de las Casas                           │
│ ┌─Gryffindor─┐ ┌─Hufflepuff─┐ ┌─Ravenclaw──┐ ┌─Slytherin──┐  │
│ │    20      │ │     0      │ │     0      │ │     0      │  │  ← Parte 3 (useReducer)
│ │Movimientos:│ │Movimientos:│ │Movimientos:│ │Movimientos:│  │
│ │     2      │ │     0      │ │     0      │ │     0      │  │
│ │[+10][-10]  │ │[+10][-10]  │ │[+10][-10]  │ │[+10][-10]  │  │
│ │[Reiniciar] │ │[Reiniciar] │ │[Reiniciar] │ │[Reiniciar] │  │
│ └────────────┘ └────────────┘ └────────────┘ └────────────┘  │
└──────────────────────────────────────────────────────────────┘
        Pestaña del navegador:  "Hechizos lanzados: 3"          ← Parte 1 (useEffect)
```

---

## 🛠️ Antes de empezar: levantar el proyecto

```bash
git clone https://github.com/Jableed43/181843-php.git     # solo si todavía no lo clonaste
cd 181843-php/12/base                                     # (si ya lo tenías: git pull y después cd 12/base)
npm install                                               # una sola vez
npm run dev                                               # abrí la dirección que muestra (http://localhost:5173)
```

Cuando abras el navegador vas a ver **todo dibujado pero nada funciona**: los botones no hacen nada.
Es el punto de partida. Nuestro trabajo es **completar los `TODO 1` al `TODO 9`** que están como
comentarios en los archivos.

> 💡 Para parar el servidor: `Ctrl + C`. Para simular que se corta internet (Parte 2): `F12` →
> pestaña **Network** → selector **Offline**.

---

## 🧭 Mapa de la clase — qué archivo tocamos y cuándo

| Paso | TODO | 📂 Archivo (dentro de `src/`) | ✍️ Qué hacés | ✅ Cómo sabés que anda |
| :---: | :---: | :--- | :--- | :--- |
| 1 | 1 | `componentes/contador/ContadorHechizos.jsx` | Crear el estado `hechizos` | El número sube al clickear |
| 2 | 2 | `ContadorHechizos.jsx` | Actualizar el título de la pestaña | Cambia el título del navegador |
| 3 | 3 | `hooks/useEstadoConexion.js` | Estado `enLinea` | *(todavía no se nota)* |
| 4 | 4 | `useEstadoConexion.js` | Escuchar online/offline y limpiar | *(se ve en el paso 6)* |
| 5 | 5 | `componentes/conexion/IndicadorConexion.jsx` | Usar el hook | Punto verde "En línea" |
| 6 | 6 | `componentes/conexion/BannerConexion.jsx` | Usar el **mismo** hook | Offline → cambia el header y aparece el aviso |
| 7 | 7 | `componentes/marcador/marcadorReducer.js` | Escribir el reducer | *(se ve en el paso 9)* |
| 8 | 8 | `componentes/marcador/Marcador.jsx` | Conectar `useReducer` | *(se ve en el paso 9)* |
| 9 | 9 | `Marcador.jsx` | Conectar los 3 botones | +10 / -10 / Reiniciar funcionan |

---

# PARTE 1 — `useState` y `useEffect`

> 🧠 **Idea:** un componente necesita **recordar** cosas (el estado) y a veces hacer cosas **hacia
> afuera** de dibujar la pantalla (efectos secundarios), como cambiar el título de la pestaña.

### Paso 1 · `useState` — recordar cuántos hechizos lanzaste &nbsp;`TODO 1`

📂 **Abrí:** `src/componentes/contador/ContadorHechizos.jsx`

✍️ **Reemplazá las dos líneas** que están debajo del `TODO 1` (`const hechizos = 0;` y
`const setHechizos = () => {};`) por **una sola**:

```jsx
const [hechizos, setHechizos] = useState(0);
```

🧠 `useState(0)` devuelve **un par**: el valor actual (`hechizos`) y una función para cambiarlo
(`setHechizos`). El `0` es el valor inicial. Los nombres los elegís vos (por convención `algo` y `setAlgo`).

✅ **Probá:** hacé click en "¡Lanzar hechizo!" → el número sube.
⚠️ **Ojo:** si dejás las dos líneas viejas **y** agregás la nueva, te va a decir que `hechizos` ya
está declarada. Hay que **reemplazarlas**, no sumar.

### Paso 2 · `useEffect` — cambiar el título de la pestaña &nbsp;`TODO 2`

📂 **Mismo archivo.** Debajo del comentario del `TODO 2` escribí:

```jsx
useEffect(() => {
  document.title = `Hechizos lanzados: ${hechizos}`;
}, [hechizos]);
```

🧠 Un **efecto** es algo que el componente hace *hacia afuera* de dibujar (acá, tocar el título del
navegador). La lista del final (`[hechizos]`) le dice a React **cuándo** repetirlo:

| Lista de dependencias | Cuándo corre el efecto |
| :--- | :--- |
| *(sin lista)* | En **cada** render |
| `[]` | **Una sola vez**, al aparecer el componente |
| `[hechizos]` | Al aparecer **y** cada vez que `hechizos` cambia |

✅ **Probá:** lanzá varios hechizos y mirá la **pestaña del navegador**: el título cambia solo.

---

# PARTE 2 — Custom Hook: `useEstadoConexion`

> 🧠 **Idea:** dos componentes (el punto del header y el aviso amarillo) necesitan saber si hay
> internet. En vez de **copiar y pegar** la misma lógica en los dos, la guardamos en **una función
> propia** y la reutilizamos. Esa función es un **Custom Hook**: una función normal cuyo nombre
> empieza con `use` y que adentro usa otros hooks.

### Paso 3 · El estado del hook &nbsp;`TODO 3`

📂 **Abrí:** `src/hooks/useEstadoConexion.js`

✍️ **Reemplazá las dos líneas** del `TODO 3` por:

```jsx
const [enLinea, setEnLinea] = useState(navigator.onLine);
```

🧠 `navigator.onLine` es un dato del navegador: `true` si hay internet, `false` si no. Lo usamos
como valor inicial.

✅ Todavía no se nota nada; sigue el efecto.

### Paso 4 · Escuchar los cambios y limpiar &nbsp;`TODO 4`

📂 **Mismo archivo.** Debajo del comentario del `TODO 4` (y **antes** de `return enLinea`) escribí:

```jsx
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
```

🧠 El navegador avisa con los eventos `online` y `offline` cuando cambia la conexión. Dos ideas clave:
- **La limpieza:** todo lo que **abrís** en un efecto lo **cerrás** en su `return`. Si no, el
  "oyente" queda vivo aunque el componente ya no exista.
- **El `[]`:** el efecto corre **una sola vez**, al aparecer el componente.

⚠️ En desarrollo, React ejecuta los efectos **dos veces** al cargar (a propósito, para detectar
limpiezas que faltan). Es normal.

### Paso 5 · Usar el hook en el header &nbsp;`TODO 5`

📂 **Abrí:** `src/componentes/conexion/IndicadorConexion.jsx`

✍️ **Reemplazá** `const enLinea = true;` por:

```jsx
const enLinea = useEstadoConexion();
```

✅ **Probá:** en el header aparece el punto verde y "En línea".

### Paso 6 · Usar el **mismo** hook en otro componente &nbsp;`TODO 6`

📂 **Abrí:** `src/componentes/conexion/BannerConexion.jsx`

✍️ **Reemplazá** `const enLinea = true;` por **la misma línea**:

```jsx
const enLinea = useEstadoConexion();
```

✅ **Probá (lo lindo del paso):** `F12` → **Network** → **Offline**. El header pasa a "Sin conexión"
(punto rojo) **y** aparece el aviso amarillo. Volvé a **Online** y se normaliza todo.

🧠 **¿Los dos componentes comparten el estado?** **No.** Se comparte la **lógica** (el código del
hook), pero cada componente tiene **su propio** estado. Cambian a la vez porque cada uno recibe el
evento del navegador por su cuenta.

---

# PARTE 3 — `useReducer`

> 🧠 **Idea:** el marcador de cada casa tiene **dos valores que cambian juntos** (puntos y
> movimientos). Cuando el estado tiene varias piezas así, conviene `useReducer`. Tiene tres partes:
>
> | Pieza | Qué es | En nuestro proyecto |
> | :--- | :--- | :--- |
> | **Estado** | Un objeto con todo lo que cambia junto | `{ puntos: 0, movimientos: 0 }` |
> | **Reducer** | Una función `(estado, acción) => nuevoEstado` que decide cómo cambia | `marcadorReducer` |
> | **`dispatch`** | La función que "manda" una acción al reducer | `dispatch({ type: "sumar", cantidad: 10 })` |

### Paso 7 · Escribir el reducer &nbsp;`TODO 7`

📂 **Abrí:** `src/componentes/marcador/marcadorReducer.js`

✍️ **Dentro del `switch`, antes de `case "reiniciar"`**, agregá los dos casos que faltan:

```jsx
case "sumar":
  return {
    puntos: state.puntos + action.cantidad,
    movimientos: state.movimientos + 1,
  };
case "restar":
  return {
    puntos: state.puntos - action.cantidad,
    movimientos: state.movimientos + 1,
  };
```

🧠 El reducer **nunca modifica** `state` directamente: devuelve un **objeto nuevo**. La acción
(`action`) es un objeto cualquiera; acá lleva `type` (qué hacer) y `cantidad` (cuánto).

### Paso 8 · Conectar `useReducer` al componente &nbsp;`TODO 8`

📂 **Abrí:** `src/componentes/marcador/Marcador.jsx`

✍️ **Arriba de todo**, agregá el import:

```jsx
import { useReducer } from "react";
```

Y **reemplazá las dos líneas** del `TODO 8` (`const state = estadoInicial;` y
`const dispatch = () => {};`) por:

```jsx
const [state, dispatch] = useReducer(marcadorReducer, estadoInicial);
```

🧠 `useReducer(reducer, estadoInicial)` devuelve `[state, dispatch]`, igual que `useState` devuelve
`[valor, setValor]`.

### Paso 9 · Conectar los botones &nbsp;`TODO 9`

📂 **Mismo archivo.** En los tres botones, cambiá el `onClick={() => {}}` por:

```jsx
onClick={() => dispatch({ type: "sumar", cantidad: 10 })}      // botón +10
onClick={() => dispatch({ type: "restar", cantidad: 10 })}     // botón -10
onClick={() => dispatch({ type: "reiniciar" })}                // botón Reiniciar
```

✅ **Probá:** en Gryffindor, hacé +10 dos veces y -10 una → **10 puntos** y **Movimientos: 3**.
Las otras tres casas siguen en `0`: cada marcador tiene **su propio** `useReducer`.
⚠️ **Ojo:** el `type` tiene que escribirse **igual** que en el `case` (`"sumar"` no es lo mismo que
`"Sumar"`); si no, aparece el error `Acción desconocida`.

---

## ✅ ¿Terminaste? Checklist final

- [ ] El número de hechizos sube y **el título de la pestaña cambia**.
- [ ] El header muestra el punto verde. En **Offline** pasa a rojo y aparece el **aviso amarillo**.
- [ ] En cada casa, **+10 / -10 / Reiniciar** funcionan y las demás casas no se mueven.
- [ ] No hay errores en rojo en la consola (`F12` → **Console**).

---

## 🆘 Si algo no anda

| Qué ves | Qué revisar |
| :--- | :--- |
| `Identifier '...' has already been declared` | Dejaste las líneas viejas **y** agregaste las nuevas. Hay que **reemplazarlas** |
| Hacés click y no pasa nada, sin errores | Falta completar un `TODO` (por ejemplo, un botón sigue con `() => {}`) |
| `... is not defined` | Falta un `import` (por ejemplo `useReducer`, `useState` o `useEffect` en esa pestaña) |
| `Acción desconocida: ...` | El `type` del `dispatch` no coincide, letra por letra, con un `case` del reducer |
| La página se cuelga / se repite sin parar | Un `useEffect` sin lista de dependencias que cambia un estado adentro |
| Los mensajes de la consola salen dos veces | Es `StrictMode` en desarrollo: normal |

---

## 🧰 Lo que tenés que llevarte (las 6 reglas)

1. Los hooks se llaman **siempre en el nivel superior** del componente: nunca dentro de un `if` ni de un `for`.
2. Actualizar el estado lo **reemplaza**, no lo combina.
3. La lista de `useEffect` decide **cuándo** corre: sin lista = siempre · `[]` = una vez · `[a]` = cuando `a` cambia.
4. **Lo que abrís en un efecto, lo cerrás en su `return`.**
5. Un Custom Hook comparte **lógica**, no estado.
6. Un reducer **nunca modifica** el estado: devuelve uno nuevo.

📘 **Para repasar con calma:** `RESUMEN-HOOKS-REACT.md` (teoría completa, ejemplos, diccionario de errores y
el mapa de todo el curso).
