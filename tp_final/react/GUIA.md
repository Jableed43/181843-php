# ⚛️ Guía — E-commerce con React

> **Para qué sirve esta guía:** (1) que puedas **levantar el proyecto sin configurar nada** y (2) que lo uses
> como **referencia** para armar tu propio TP: acá vas a ver *dónde* se hace cada cosa y *cómo* se hace.
>
> **El proyecto:** una tienda con **Home** (listado de productos), **Detalle** (nombre, precio, stock y código),
> **Registro** y **Login**. Los productos salen de un **mock de datos** (un archivo con un array) y los formularios
> son **solo maquetado**, tal como permite la consigna para la versión React.

---

## 🚀 Levantarlo con cero configuración

Necesitás **Node.js** instalado (`https://nodejs.org`). No hay que configurar nada más.

### Opción A — Doble clic (la más fácil)

1. Hacé **doble clic en `iniciar.bat`** (está en esta misma carpeta).
2. La primera vez instala las librerías solo (tarda un minuto); después abre el navegador con la tienda. ¡Listo!

Para cerrarla, cerrá la ventana negra (o `Ctrl + C`).

### Opción B — Por terminal (2 comandos)

```bash
npm install      # solo la primera vez: descarga las librerías
npm run dev      # levanta la tienda; abrí la dirección que muestra (normalmente http://localhost:5173)
```

### Si algo no arranca

| Qué ves | Qué hacer |
| :--- | :--- |
| `iniciar.bat` dice que no encuentra Node.js | Instalá Node.js desde `https://nodejs.org` y volvé a abrirlo |
| Falla la instalación de librerías | Revisá tu conexión a internet y volvé a intentar |
| Dice "Port 5173 is in use" | Ya tenés otra app corriendo; Vite usa el siguiente puerto y te muestra la dirección correcta en la ventana |
| Pantalla en blanco | Abrí la consola del navegador (`F12`) y leé el error en rojo |

---

## 🧭 Recorrido: qué hace cada página y dónde mirar

Abrí cada archivo en este orden. Todo está **comentado en castellano**.

| # | Página | URL | Archivo a leer (en `src/`) |
| :-: | :--- | :--- | :--- |
| 1 | **Home** — listado de productos | `/#/` | `paginas/HomePage.jsx` + `componentes/TarjetaProducto.jsx` |
| 2 | **Detalle** — nombre, precio, stock, código | `/#/producto/3` | `paginas/DetallePage.jsx` |
| 3 | **Registro** (maqueta) | `/#/registro` | `paginas/RegistroPage.jsx` |
| 4 | **Login** (maqueta) | `/#/login` | `paginas/LoginPage.jsx` |
| 5 | **404** | `/#/loquesea` | `paginas/NotFoundPage.jsx` |

> Las URLs llevan un `#` porque se usa `HashRouter`: así la tienda funciona en **GitHub Pages** sin configurar el servidor.

### El esquema que tenés que entender

```
  URL ──► App.jsx (<Routes>) ──► PÁGINA ──► usa COMPONENTES ──► y los DATOS (datos/productos.js)
```

| Pieza | Qué hace | Archivos de este proyecto |
| :--- | :--- | :--- |
| **App** | El "mapa": qué URL muestra qué página | `App.jsx` |
| **Páginas** | Una por pantalla | `paginas/*.jsx` |
| **Componentes** | Piezas chicas y reutilizables | `componentes/Menu.jsx`, `componentes/TarjetaProducto.jsx` |
| **Datos** | El mock: array con los 8 productos | `datos/productos.js` |

### Los conceptos del curso, en este proyecto

| Concepto | Dónde se ve |
| :--- | :--- |
| **Componentes** | Cada archivo de `componentes/` y `paginas/` es una función que devuelve JSX |
| **Props** | `HomePage` le pasa `id`, `codigo`, `nombre`, `precio` y `stock` a `TarjetaProducto` |
| **`.map()` + `key`** | `HomePage` recorre el array y dibuja una tarjeta por producto |
| **Renderizado condicional** | `TarjetaProducto` y `DetallePage` muestran "Agotado" / "¡Últimas unidades!" según el stock |
| **Rutas** | `App.jsx`: `<Routes>` y `<Route path="..." element={...} />` |
| **Parámetro de URL** | La ruta `/producto/:id` + `useParams()` en `DetallePage` |
| **`Link` / `NavLink`** | `Menu.jsx` y las tarjetas navegan sin recargar la página |
| **Ruta comodín (404)** | `<Route path="*" ...>` al final de `App.jsx` |

### Ejemplo completo: la página de Detalle

1. Hacés click en una tarjeta: es un `<Link to="/producto/4">` (`TarjetaProducto.jsx`).
2. `App.jsx` encuentra la ruta `/producto/:id` y muestra `DetallePage`.
3. `useParams()` devuelve `{ id: "4" }`.
4. Se busca el producto con `productos.find(...)` en el mock.
5. Si no existe → "Producto no encontrado". Si existe → tabla con *Nombre, Precio, Stock, Código*.

> 💡 `useParams()` devuelve el id como **texto** (`"4"`) y en `productos.js` los ids son **números** (`4`). Por eso `DetallePage` hace `Number(id)` antes de comparar.

---

## 🛠️ Recetas: "¿cómo hago para...?"

### ➕ Agregar un producto
Abrí `src/datos/productos.js` y sumá un objeto al array (con un `id` que no se repita):
```js
{ id: 9, codigo: "TAB-009", nombre: "Tablet 10 pulgadas", precio: 149900, stock: 12 },
```
Guardá: aparece solo en el Home (no hay que tocar ningún otro archivo).

### 📝 Agregar un campo al producto (ej: `descripcion`)
1. En `datos/productos.js`, agregá `descripcion: "..."` a cada producto.
2. En `paginas/DetallePage.jsx`, sumá una fila a la tabla:
   ```jsx
   <tr><th>Descripción</th><td>{producto.descripcion}</td></tr>
   ```

### 🎨 Cambiar los colores
Todo está en `src/App.css`. Los colores principales: `#1b2a3a` (barra), `#1f5fbf` (botones), `#ffd24d` (resalte).

### 🔗 Pasar de `HashRouter` a `BrowserRouter` (URLs sin `#`)
En `App.jsx`, cambiá `HashRouter` por `BrowserRouter` (en el `import` y en las etiquetas). Sirve para un servidor propio; en GitHub Pages dejá `HashRouter`.

### 📄 Agregar una página nueva (ej: "Contacto")
1. Creá `src/paginas/ContactoPage.jsx`:
   ```jsx
   function ContactoPage() {
     return (
       <div className="detalle">
         <h1>Contacto</h1>
         <p>Escribinos a contacto@mitienda.com</p>
       </div>
     );
   }

   export default ContactoPage;
   ```
2. En `App.jsx`, importala y sumá su ruta (adentro de `<Routes>`, antes de la ruta `*`):
   ```jsx
   import ContactoPage from "./paginas/ContactoPage";
   // ...
   <Route path="/contacto" element={<ContactoPage />} />
   ```
3. En `componentes/Menu.jsx`, sumá el link: `<NavLink to="/contacto">Contacto</NavLink>`.

### 🌐 Usar una API en vez del mock
La consigna lo permite. En `HomePage.jsx`, reemplazá el `import productos ...` por un pedido con `useEffect`:
```jsx
const [productos, setProductos] = useState([]);

useEffect(() => {
  fetch("https://TU-API/productos")
    .then((respuesta) => respuesta.json())
    .then((datos) => setProductos(datos));
}, []);
```
El resto del componente (`productos.map(...)`) no cambia. *(Acordate de importar `useState` y `useEffect` de `react`.)*

---

## 📁 Qué es cada carpeta y archivo

```
react/
├── iniciar.bat              ← doble clic para levantar todo
├── package.json             ← lista de librerías y comandos (npm run dev, npm run deploy)
├── vite.config.js           ← configuración de Vite (base "./" para que funcione en GitHub Pages)
├── index.html               ← la única página HTML; React dibuja todo adentro de <div id="root">
└── src/
    ├── main.jsx             ← punto de entrada: dibuja <App /> en la página
    ├── App.jsx              ← el "mapa" de URLs (HashRouter + Routes)
    ├── App.css              ← estilos
    ├── datos/productos.js   ← el mock: array con los 8 productos
    ├── utils/formato.js     ← formatearPrecio(45999) → "$45.999,00"
    ├── componentes/         ← Menu.jsx, TarjetaProducto.jsx
    └── paginas/             ← HomePage, DetallePage, RegistroPage, LoginPage, NotFoundPage
```

---

## 🧰 Para llevarte a tu propio TP

La forma más rápida: **copiá toda la carpeta** (sin `node_modules`) y modificala.
- Cambiá los datos en `datos/productos.js`.
- Cambiá los textos (nombre de la tienda en `Menu.jsx` y `index.html`).
- Agregá las páginas que necesites con la receta de arriba.

## 🌐 Publicarlo en GitHub Pages (el link que pide la entrega)

1. Subí el proyecto a un repositorio de GitHub (la carpeta `node_modules` **no** se sube: ya está en `.gitignore`).
2. En la terminal, dentro del proyecto: **`npm run deploy`**. Genera la carpeta `dist` y la publica en la rama `gh-pages`.
3. En GitHub: **Settings → Pages →** *Branch:* `gh-pages` → **Save**.
4. En unos minutos queda online en `https://TU-USUARIO.github.io/TU-REPO/`.

## 📦 Entrega
- **Repositorio de GitHub** (recomendado), o un `.zip` llamado `apellido_final.zip` con el proyecto **sin** `node_modules` ni `dist`.
- Adjuntar el **link de GitHub Pages**.