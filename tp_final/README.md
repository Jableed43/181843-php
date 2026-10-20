# 🎓 TP Final — E-commerce (dos versiones resueltas)

La consigna ([`consigna.md`](consigna.md)) pide desarrollar un e-commerce **en React o en CodeIgniter**, con estas páginas:
**Home** (listado de productos) · **Detalle** (nombre, precio, stock, código) · **Registro** · **Login**.

Acá están las **dos versiones resueltas**, con el mismo diseño y los mismos 8 productos. Sirven de **referencia** para armar tu
propio TP, y se pueden levantar **sin configurar nada**.

| | 🐘 CodeIgniter | ⚛️ React |
| :--- | :--- | :--- |
| Guía | **[`codeigniter/GUIA.md`](codeigniter/GUIA.md)** | **[`react/GUIA.md`](react/GUIA.md)** |
| Levantarla | doble clic en [`iniciar.bat`](codeigniter/iniciar.bat) *(necesita XAMPP)* | doble clic en [`iniciar.bat`](react/iniciar.bat) *(necesita Node.js)* |
| Productos | Leídos de **MySQL** | **Mock** de datos (array en un archivo) |
| Registro y Login | **Funcionan** con la base de datos (contraseña con hash, sesión) | **Solo maquetado** (lo permite la consigna) |
| Base de datos | Se **crea sola** la primera vez | No usa |
| Publicación online | Hosting con PHP y MySQL | GitHub Pages (`npm run deploy`) |

## ✅ Checklist de la consigna

| Requisito | CodeIgniter | React |
| :--- | :---: | :---: |
| Home con listado de productos | ✅ | ✅ |
| Detalle con nombre, precio, stock y código | ✅ | ✅ |
| Registro (formulario con campos a criterio) | ✅ con base de datos | ✅ maquetado |
| Login con email y contraseña | ✅ con base de datos | ✅ maquetado |
| Productos desde la base de datos (CI) / mock o API (React) | ✅ MySQL | ✅ mock |
| Link del servidor online o GitHub Pages | hosting PHP | GitHub Pages |
| Entrega: `apellido_final.zip` o repositorio de GitHub | ✅ | ✅ |

## 🧭 ¿Cuál elijo para mi entrega?
Alcanza con **una**. La de **CodeIgniter** muestra más contenido del curso (MVC, base de datos, validaciones, sesiones),
pero necesita un hosting con PHP para el link online. La de **React** es más rápida de publicar (GitHub Pages) y
no requiere base de datos.

## 🔍 La misma pantalla en las dos tecnologías

| Idea | CodeIgniter | React |
| :--- | :--- | :--- |
| "Mapa" de URLs | `config/routes.php` | `<Routes>` en `App.jsx` |
| Una página | **Vista** (`views/*.php`) | **Componente** de página (`paginas/*.jsx`) |
| Cabecera repetida en todas las páginas | `views/partials/head.php` | `componentes/Menu.jsx` |
| Una tarjeta de producto | HTML dentro de un `foreach` | `TarjetaProducto` dentro de un `.map()` |
| Datos | **Modelo** + MySQL | `datos/productos.js` |
| Parámetro de URL (`/producto/3`) | `ver($id)` en el controlador | `useParams()` |
| Página 404 | `show_404()` | `<Route path="*">` |
