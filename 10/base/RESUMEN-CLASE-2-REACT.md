# Resumen — Clase 2: Componentes, Propiedades y Ciclo de Vida

> Salida de la clase. Sirve para repasar solo, sin el profe al lado. Todos los ejemplos son del
> proyecto de hoy (`base/` → `final/`): las tarjetas de las casas de Hogwarts, con un botón para
> elegir favorita y un reloj que se puede mostrar/ocultar.

## Índice

0. [Clonar y levantar el proyecto](#0-clonar-y-levantar-el-proyecto)
1. [Repaso: props vs. estado](#1-repaso-props-vs-estado)
2. [`useState`, a fondo](#2-usestate-a-fondo)
3. [Eventos: de hijo a padre](#3-eventos-de-hijo-a-padre)
4. [Ciclo de vida: de las clases a los hooks](#4-ciclo-de-vida-de-las-clases-a-los-hooks)
5. [`useEffect`, a fondo](#5-useeffect-a-fondo)
6. [El proyecto completo](#6-el-proyecto-completo)
7. [Reglas de oro](#7-reglas-de-oro)
8. [Diccionario de errores](#8-diccionario-de-errores)
9. [Chuleta final](#9-chuleta-final)

---

## 0. Clonar y levantar el proyecto

Esta sección es **súper paso a paso** a propósito — si en la Clase 1 esto ya te quedó claro, saltá
directo a la [sección 1](#1-repaso-props-vs-estado). Si todavía te perdés con la terminal, quedate
acá y hacé cada paso en orden, sin saltear ninguno.

### 0.1 — ¿Qué es "clonar un repo"?

Todo el código de la cursada (el tuyo incluido) vive en un repositorio de GitHub — pensalo como
una carpeta gigante, guardada en internet, con un historial de cada cambio que se hizo. **Clonar**
significa "traerme una copia completa de esa carpeta a mi compu". Se hace una sola vez por
proyecto (no hay que clonar de nuevo en cada clase, salvo que te digan lo contrario).

### 0.2 — Paso a paso

**1. Abrir una terminal.**
* Windows: buscar "cmd" o "PowerShell" en el menú de inicio, o abrir la terminal integrada de VS
  Code (menú *Terminal → New Terminal*, o `` Ctrl + ` ``).
* La terminal siempre arranca "parada" en alguna carpeta. Para saber en cuál, mirá el texto antes
  del cursor (algo como `C:\Users\TuNombre>`).

**2. Pararse en la carpeta donde querés que viva el proyecto** (por ejemplo, el escritorio o una
carpeta `cursada` que hayas armado). Se usa el comando `cd` (*change directory*):
```bash
cd Desktop
```

**3. Clonar el repositorio** con `git clone` seguido de la URL:
```bash
git clone https://github.com/Jableed43/181843-php.git
```
Esto crea, adentro de donde estabas parado, una carpeta nueva llamada `181843-php` con **todo** el
contenido del repositorio — todas las clases, no solo la de hoy.

> ⚠️ Si la terminal responde `git no se reconoce como un comando` (o `command not found`), Git no
> está instalado. Se instala desde `https://git-scm.com/downloads` y después se repite este paso.

**4. Entrar a la carpeta de la clase de hoy.** El proyecto de hoy vive en `10/base` adentro del
repo:
```bash
cd 181843-php/10/base
```
Confirmar que estás en el lugar correcto: escribir `dir` (Windows/cmd) o `ls` (PowerShell, Git
Bash, Mac/Linux) y verificar que aparece un archivo llamado `package.json`. Si no aparece, no
estás parado en la carpeta correcta — revisar el paso anterior.

**5. Instalar las dependencias** — descarga todo lo que el proyecto necesita para correr
(`react`, `vite`, etc., ver el resumen de la Clase 1 para el detalle de `package.json`):
```bash
npm install
```
Esto tarda unos segundos (a veces un par de minutos con internet lento) y va a crear una carpeta
`node_modules/` adentro de `base/`. **Se corre UNA sola vez** por proyecto — no hace falta
repetirlo cada vez que abrís la compu, solo si borraste `node_modules/` o clonaste de nuevo.

**6. Levantar el servidor de desarrollo:**
```bash
npm run dev
```
La terminal va a quedar "colgada" mostrando algo así — **eso es normal, significa que el servidor
está corriendo**:
```
  VITE vX.X.X  ready in 200 ms

  ➜  Local:   http://localhost:5173/
```

**7. Abrir esa dirección en el navegador** (`http://localhost:5173/`, o el puerto que te haya
mostrado a vos — puede variar). Ahí tiene que aparecer la página de Hogwarts.

### 0.3 — Cosas que conviene saber

* **Para parar el servidor:** volver a la terminal donde quedó "colgada" y apretar `Ctrl + C`.
  Mientras el servidor esté corriendo, esa terminal queda ocupada — si necesitás escribir otro
  comando, abrí una segunda pestaña de terminal en vez de cerrar esa.
* **Guardaste un archivo y no ves el cambio:** revisá que el servidor (`npm run dev`) siga
  corriendo — si lo cerraste sin querer, hay que volver a correr `npm run dev`.
* **`npm install` tira errores en rojo:** antes de asustarse, confirmar que estás parado adentro
  de `10/base` (con el `package.json` ahí mismo) y no en la raíz del repo clonado.
* **El puerto 5173 "ya está en uso":** significa que ya tenés otro `npm run dev` corriendo en
  otra terminal (quizás de la Clase 1). Cerrar esa terminal con `Ctrl + C`, o simplemente abrir la
  URL de puerto distinto que Vite te ofrezca automáticamente.
* **Esto NO hay que repetirlo en cada clase:** los pasos 3, 4 y 5 (clonar e instalar) se hacen una
  vez. De ahí en adelante, para seguir trabajando en el proyecto alcanza con `cd` hasta la carpeta
  y `npm run dev`.

---

## 1. Repaso: props vs. estado

En la Clase 1 vimos las **props**: datos que un componente padre le pasa a un hijo, y que el hijo
solo lee (nunca los modifica). Hoy se suma el **estado** (`state`): un dato que un componente
guarda **por su cuenta**, y que puede cambiar **desde adentro** en respuesta a algo (un click, un
timer, lo que sea).

| | Props | Estado |
| :--- | :--- | :--- |
| ¿Quién lo define? | El componente padre | El propio componente |
| ¿Se puede modificar desde adentro? | No (solo lectura) | Sí, con su función `set...` |
| ¿Dispara un re-render al cambiar? | Sí (porque cambia por fuera) | Sí (por eso existe) |

**Analogía:** una prop es una carta que te manda otra persona — la leés, no la reescribís. El
estado es tu propio cuaderno de notas: lo escribís vos, y cuando lo cambiás, React vuelve a
dibujar la pantalla para reflejar ese cambio.

---

## 2. `useState`, a fondo

```jsx
import { useState } from "react";

function ListaCasas() {
  const [favorita, setFavorita] = useState(null);
  // favorita     → el valor actual (arranca en null: nadie eligió nada)
  // setFavorita  → la ÚNICA función permitida para cambiar ese valor
}
```

* `useState(valorInicial)` devuelve **siempre un array de 2 elementos**: el valor actual y la
  función para cambiarlo. Se desestructura con los nombres que uno elige — por convención,
  `algo` y `setAlgo`.
* **Nunca se modifica el estado a mano.** `favorita = "Gryffindor"` no funciona y no dispara el
  re-render — React ni se entera. Siempre se pasa por la función `set...`.
* El valor que le pasás a `useState(...)` es el **valor inicial**, y solo se usa una vez, la
  primera vez que el componente se dibuja.

### El estado usado como dato para las props de los hijos

```jsx
{casas.map((casa) => (
  <Casa
    key={casa.nombre}
    nombre={casa.nombre}
    // ...el resto de las props de datos...
    esFavorita={casa.nombre === favorita}
    onElegir={() => setFavorita(casa.nombre)}
  />
))}
```

* `esFavorita` es una prop calculada: un booleano que sale de comparar el estado (`favorita`) con
  el dato de esa vuelta del `.map()`.
* `onElegir` es una prop que **es una función**. Eso no es nuevo — lo nuevo es que, al ejecutarse,
  esa función cambia el estado del componente que la definió.

---

## 3. Eventos: de hijo a padre

Las props bajan (padre → hijo). **Los eventos suben (hijo → padre)** — es la dirección contraria.

```
ListaCasas (tiene el estado "favorita")
  └─ le pasa onElegir={() => setFavorita(casa.nombre)} a  →  Casa
       └─ Casa le pasa esa misma función como onClick a   →  Boton
            └─ Boton la ejecuta en su <button onClick={onClick}>
```

```jsx
// Boton.jsx — no sabe qué hace "onClick", solo lo ejecuta cuando lo aprietan
function Boton({ texto, color, onClick }) {
  return (
    <button style={{ backgroundColor: color }} onClick={onClick}>
      {texto}
    </button>
  );
}
```

```jsx
// Casa.jsx — recibe "onElegir" y se lo pasa a Boton como su onClick
<Boton
  texto={esFavorita ? "★ Tu favorita" : "Elegir como favorita"}
  color={esFavorita ? "#ffd700" : "#007bff"}
  onClick={onElegir}
/>
```

Al hacer click: `Boton` dispara `onClick` → esa es, en realidad, la función `onElegir` que le
pasó `Casa` → que es la función que `ListaCasas` definió al llamar `setFavorita`. **Tres
componentes, una sola función viajando hacia abajo por props, que termina ejecutándose y
afectando al de más arriba.**

**Idea clave:** `Casa` y `Boton` no saben que existe un estado llamado `favorita`. Solo saben
"tengo una función que me pasaron, la ejecuto cuando corresponda". Quien sabe qué hace esa función
es, únicamente, `ListaCasas` — el componente que la definió.

**¿Por qué el estado vive en `ListaCasas` y no en cada `Casa`?** Porque `favorita` es un dato que
**varias** tarjetas necesitan conocer (para saber si son ellas o no la elegida). Si el estado
viviera adentro de cada `Casa`, cada una sabría solo de sí misma y no podrían "desmarcarse" entre
sí al elegir otra.

---

## 4. Ciclo de vida: de las clases a los hooks

El **ciclo de vida** es la serie de momentos por los que pasa todo componente: nace, existe un
tiempo (posiblemente actualizándose), y en algún momento se retira. React antiguo (componentes de
clase) tenía un método por cada momento; hoy, con componentes de función, todo eso se resuelve con
un solo hook: `useEffect`.

| Etapa | ¿Cuándo pasa? | Método de clase (histórico) | Hook (lo que usamos hoy) |
| :--- | :--- | :--- | :--- |
| **Montaje** | La primera vez que el componente aparece en pantalla | `componentDidMount` | Código **adentro** de `useEffect(() => {...}, [])` |
| **Actualización** | Cada vez que cambian sus props o su estado | `componentDidUpdate` | Un `useEffect` con dependencias en el array (`[algo]`) |
| **Desmontaje** | Cuando el componente se saca de pantalla | `componentWillUnmount` | El `return` **adentro** de ese mismo `useEffect` |

**Analogía:** un componente vive como una planta. **Nace** (se monta), **crece/cambia** (se
actualiza) y en algún momento **se la retira** (se desmonta). `useEffect` es donde regás la planta
al nacer, y donde la guardás cuando se va.

---

## 5. `useEffect`, a fondo

```jsx
import { useState, useEffect } from "react";

function Reloj() {
  const [hora, setHora] = useState(new Date());

  useEffect(() => {
    console.log("Reloj: montado");

    const intervalo = setInterval(() => {
      setHora(new Date());
    }, 1000);

    return () => {
      console.log("Reloj: desmontado");
      clearInterval(intervalo);
    };
  }, []);

  return <div className="reloj">🕐 {hora.toLocaleTimeString()}</div>;
}
```

* **Por qué un solo hook cubre 3 momentos distintos:** `useEffect` recibe una función. Lo que esa
  función hace al ejecutarse = montaje (o actualización). Lo que esa función **devuelve** (otra
  función) = desmontaje. El segundo argumento — el array `[]` — le dice a React **cuándo** volver
  a correr el efecto: vacío significa "una sola vez, al montar".
* **Al montar:** arranca un `setInterval` que actualiza el estado `hora` cada 1000ms — por eso el
  reloj se ve corriendo.
* **Al desmontar:** si no se limpiara el intervalo con `clearInterval`, seguiría corriendo en
  segundo plano **aunque el reloj ya no esté en pantalla** — eso es una fuga de memoria. La
  función que se devuelve adentro del `useEffect` es exactamente el lugar para esa limpieza.
* **Regla general:** todo `setInterval`, `setTimeout` o suscripción que se cree en un `useEffect`
  se limpia en su `return`. Si no se limpia, sigue vivo después de que el componente desaparezca.

### El detalle de `StrictMode` (para no asustarse)

En desarrollo, React ejecuta cada `useEffect` **dos veces seguidas** al montar (monta → desmonta →
monta), a propósito, para ayudar a encontrar efectos mal limpiados. Por eso en la consola puede
verse `Reloj: montado` / `Reloj: desmontado` / `Reloj: montado` ni bien carga la página. **Esto no
pasa en producción** — es una ayuda de desarrollo, no un bug ni un error propio.

---

## 6. El proyecto completo

```jsx
// App.jsx — decide si el Reloj está montado o no
import { useState } from "react";

function App() {
  const [mostrarReloj, setMostrarReloj] = useState(true);

  return (
    <>
      <Header />
      <Seccion />

      <section className="seccion-reloj">
        <Boton
          texto="Mostrar/Ocultar reloj"
          color="#343434"
          onClick={() => setMostrarReloj(!mostrarReloj)}
        />
        {mostrarReloj && <Reloj />}
      </section>

      <ListaCasas />
      <Footer />
    </>
  );
}
```

* `{mostrarReloj && <Reloj />}` es **renderizado condicional**: si `mostrarReloj` es `true`, JSX
  evalúa y muestra `<Reloj />`; si es `false`, la expresión completa da `false` y React no
  renderiza nada ahí. Cuando pasa de `true` a `false`, `Reloj` se **desmonta de verdad** — no se
  esconde con CSS, deja de existir en el árbol de React. Por eso dispara el `console.log("Reloj:
  desmontado")` del `useEffect`.

**El recorrido completo, de punta a punta:**
1. `App` guarda el estado `mostrarReloj`.
2. Click en el botón → `setMostrarReloj(!mostrarReloj)` → React vuelve a renderizar `App`.
3. Si ahora `mostrarReloj` es `false`, `<Reloj />` deja de estar en el JSX → React lo desmonta →
   corre la función de limpieza del `useEffect` de `Reloj`.
4. Mientras tanto, `ListaCasas` tiene su **propio** estado (`favorita`), completamente
   independiente del de `App` — cada componente que declara su `useState` tiene su propia caja de
   memoria, nadie más la toca.

---

## 7. Reglas de oro

1. **El estado se cambia SOLO con su función `set...`.** Nunca asignación directa.
2. **Cambiar el estado dispara un re-render.** Es la única razón por la que existe: las props no
   alcanzan cuando algo tiene que cambiar solo, en respuesta a una acción.
3. **Las props bajan, los eventos suben.** Un componente hijo nunca le avisa directamente a sus
   hermanos que algo cambió — se lo avisa a su padre (vía una función que recibió por props), y el
   padre decide qué hacer.
4. **Todo lo que arranca en un `useEffect` se apaga en su `return`.** Temporizadores,
   suscripciones, listeners — si no se limpian, quedan vivos después de que el componente
   desaparezca.
5. **El array de dependencias de `useEffect` (`[]`) controla CUÁNDO se repite.** Vacío = una sola
   vez, al montar.

---

## 8. Diccionario de errores

| Síntoma | Causa típica |
| :--- | :--- |
| Hice click y no pasa nada visualmente, pero tampoco hay error | Se está reasignando el estado directo (`favorita = ...`) en vez de llamar a `setFavorita(...)` |
| El reloj no arranca a andar | Falta el `setInterval` dentro del `useEffect`, o el `useState` inicial de `hora` no se usa en el JSX |
| El reloj "tartamudea" o va muy rápido | Falta el array `[]` al final del `useEffect`; sin él, se crea un intervalo nuevo en cada render |
| `"Reloj: montado"` aparece dos veces seguidas al cargar | Comportamiento normal de `StrictMode` en desarrollo (ver sección 5) — no es un error propio |
| Al ocultar el reloj sigue "corriendo" en segundo plano (se ve en consola) | Falta devolver la función de limpieza (`clearInterval`) en el `useEffect` |
| `Cannot read properties of undefined (reading 'map')` | Falta el `import casas from "./datosCasas"`, o el archivo de datos tiene un error de sintaxis |

---

## 9. Chuleta final

```jsx
// Estado: se declara así, se cambia SOLO con su función set...
const [valor, setValor] = useState(inicial);

// Evento hijo → padre: una función que baja por props y sube ejecutándose
<Hijo onAlgo={() => setValor(nuevoValor)} />

// Ciclo de vida con useEffect
useEffect(() => {
  // esto corre al MONTAR (y de nuevo si cambia algo del array de dependencias)

  return () => {
    // esto corre al DESMONTAR — acá se limpia todo lo que se abrió arriba
  };
}, []); // [] = una sola vez, al montar

// Renderizado condicional: si es false, React no dibuja nada ahí
{condicion && <Componente />}
```
