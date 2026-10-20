# 🐘 Guía — E-commerce con CodeIgniter 3

> **Para qué sirve esta guía:** (1) que puedas **levantar el proyecto sin configurar nada** y (2) que lo uses
> como **referencia** para armar tu propio TP: acá vas a ver *dónde* se hace cada cosa y *cómo* se hace.
>
> **El proyecto:** una tienda con **Home** (listado de productos), **Detalle** (nombre, precio, stock y código),
> **Registro** y **Login**, todo conectado a una **base de datos MySQL**.

---

## 🚀 Levantarlo con cero configuración

Necesitás **XAMPP** instalado (el mismo del curso). No hay que editar ningún archivo ni importar ninguna base de datos:
**la base de datos se crea sola** la primera vez que entrás.

### Opción A — Doble clic (la más fácil)

1. Hacé **doble clic en `iniciar.bat`** (está en esta misma carpeta).
2. Se abre el navegador con la tienda. ¡Listo!

*Qué hace `iniciar.bat` por vos:* busca XAMPP, enciende MySQL si estaba apagado, y levanta la tienda en
`http://localhost:8000/index.php/`. Para cerrarla, cerrá la ventana negra.

### Opción B — Con el Apache de XAMPP

1. Abrí el panel de **XAMPP** y encendé **Apache** y **MySQL** (botón *Start*).
2. Copiá esta carpeta dentro de `xampp\htdocs\` (con el nombre que quieras).
3. Abrí `http://localhost/NOMBRE-DE-LA-CARPETA/index.php/`

> ✅ Funciona desde **cualquier carpeta**: la dirección base (`base_url`) se calcula sola.

### Si algo no arranca

| Qué ves | Qué hacer |
| :--- | :--- |
| Un cartel **"No se pudo conectar a MySQL"** | Encendé **MySQL** en el panel de XAMPP y recargá la página |
| `iniciar.bat` dice que no encuentra PHP | Instalá XAMPP, o usá la Opción B |
| Se ve "Not Found" / 404 en todo | Falta escribir `index.php/` al final de la dirección |
| Quiero empezar con la base de datos de cero | En phpMyAdmin borrá la base `tp_ecommerce` y recargá la tienda: se vuelve a crear sola |

---

## 🧭 Recorrido: qué hace cada página y dónde mirar

Abrí cada archivo en este orden. Todo está **comentado en castellano**.

| # | Página | URL | Archivo a leer (en `application/`) |
| :-: | :--- | :--- | :--- |
| 1 | **Home** — listado de productos | `index.php/` | `controllers/Productos.php` → `index()` · `views/productos_listado.php` |
| 2 | **Detalle** — nombre, precio, stock, código | `index.php/producto/3` | `controllers/Productos.php` → `ver($id)` · `views/productos_detalle.php` |
| 3 | **Registro** | `index.php/registro` | `controllers/Auth.php` → `registro()` · `views/auth_registro.php` |
| 4 | **Login** | `index.php/login` | `controllers/Auth.php` → `login()` · `views/auth_login.php` |
| 5 | **Salir** | `index.php/logout` | `controllers/Auth.php` → `logout()` |

### El esquema que tenés que entender: MVC

```
  URL  ──►  routes.php  ──►  CONTROLADOR  ──►  MODELO  ──►  MySQL
                                  │              │
                                  │   ◄──datos───┘
                                  ▼
                               VISTA  ──►  HTML que ve el usuario
```

| Pieza | Qué hace | Archivos de este proyecto |
| :--- | :--- | :--- |
| **Controlador** | Decide qué hacer con cada URL | `controllers/Productos.php`, `controllers/Auth.php` |
| **Modelo** | Es el único que habla con la base de datos | `models/Producto_model.php`, `models/Usuario_model.php` |
| **Vista** | El HTML que se muestra | `views/*.php` y `views/partials/` (cabecera y pie compartidos) |
| **Rutas** | URLs cortas → controlador/método | `config/routes.php` |

### Ejemplo completo: la página de Detalle

1. Entrás a **`index.php/producto/3`**.
2. `config/routes.php` tiene `$route['producto/(:num)'] = 'productos/ver/$1'` → llama a `Productos::ver(3)`.
3. `ver($id)` le pide el producto al **modelo**: `Producto_model->obtenerPorId(3)`.
4. El modelo hace la consulta (`SELECT ... WHERE id = 3`) y devuelve la fila.
5. Si no existe → `show_404()`. Si existe → se la pasa a la **vista** `productos_detalle.php`, que arma la tabla con *Nombre, Precio, Stock, Código*.

---

## 🔐 Registro y Login, paso a paso

**Registro** (`Auth::registro`)
1. Se muestra el formulario. Al enviarlo, `form_validation` revisa cada campo:
   nombre (mínimo 3 letras) · email válido y **no repetido** (`is_unique[usuarios.email]`) · contraseña de 6+ caracteres · repetir contraseña igual a la primera (`matches[password]`).
2. Si hay errores → se vuelve a mostrar el formulario con los mensajes y **conservando lo que escribiste** (`set_value`).
3. Si está bien → `Usuario_model->crear()` guarda al usuario con la contraseña **encriptada** (`password_hash`).
4. Redirige al Login con un cartel verde "¡Cuenta creada!" (un *flashdata*: se muestra una sola vez).

**Login** (`Auth::login`)
1. Busca al usuario por email → `Usuario_model->obtenerPorEmail()`.
2. `password_verify()` compara lo que escribiste con el hash guardado.
3. Si coincide → guarda al usuario en la **sesión** (`$this->session->set_userdata`), y el menú de arriba pasa a decir *"Hola, tu nombre · Salir"*.
4. Si no → muestra "Email o contraseña incorrectos" (el mismo mensaje para los dos casos: no se le dan pistas a un atacante).

**Seguridad que ya viene incluida:** contraseñas con hash · consultas por Query Builder (sin SQL a mano, no hay inyección SQL) · `html_escape()` en lo que se muestra · protección **CSRF** (`form_open()` agrega el token solo).

---

## 🛠️ Recetas: "¿cómo hago para...?"

### ➕ Agregar un producto
Abrí **phpMyAdmin → base `tp_ecommerce` → tabla `productos` → Insertar**. Completá `codigo`, `nombre`, `precio`, `stock`. Aparece solo en el Home.
*(O agregá una línea al `INSERT` de `ecommerce.sql`, borrá la base `tp_ecommerce` y recargá la tienda: se recrea con el producto nuevo.)*

### 📝 Agregar un campo al producto (ej: `descripcion`)
1. **Base:** agregá la columna en `ecommerce.sql`, dentro del `CREATE TABLE productos` (por ejemplo `descripcion VARCHAR(255)`), borrá la base `tp_ecommerce` y recargá la tienda para que se recree.
2. **Vista:** en `views/productos_detalle.php` sumá una fila con `<tr><th>Descripción</th><td>` + `html_escape($producto->descripcion)` + `</td></tr>`.
   *(No hace falta tocar el modelo ni el controlador: `$producto` ya trae todas las columnas.)*

### 🔗 Cambiar una URL
En `config/routes.php`, una línea por URL: `$route['url-corta'] = 'controlador/metodo';`

### 🎨 Cambiar los colores
Todo está en `public/css/estilos.css`. Los colores principales: `#1b2a3a` (barra), `#1f5fbf` (botones), `#ffd24d` (resalte).

### 📄 Agregar una página nueva (ej: "Contacto")
1. **Controlador** — creá `controllers/Contacto.php`:
   ```php
   <?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Contacto extends CI_Controller {
       public function index() {
           $datos['titulo'] = 'Contacto';
           $this->load->view('contacto', $datos);
       }
   }
   ```
2. **Vista** — creá `views/contacto.php`:
   ```php
   <?php $this->load->view('partials/head'); ?>
   <h1>Contacto</h1>
   <p>Escribinos a contacto@mitienda.com</p>
   <?php $this->load->view('partials/pie'); ?>
   ```
3. Entrá a **`index.php/contacto`**. *(Si querés un link en el menú: `views/partials/head.php`.)*

### 🔒 Hacer que una página requiera estar logueado
Al principio del método del controlador:
```php
if (!$this->session->userdata('usuario')) {
    redirect('login');
}
```

---

## 📁 Qué es cada carpeta y archivo

```
codeigniter/
├── iniciar.bat              ← doble clic para levantar todo
├── ecommerce.sql            ← estructura de la base + 8 productos (la importa sola el instalador)
├── index.php                ← puerta de entrada de CodeIgniter (no se toca)
├── system/                  ← el "motor" de CodeIgniter (no se toca)
├── public/css/estilos.css   ← estilos
└── application/
    ├── config/
    │   ├── config.php       ← base_url automática, CSRF
    │   ├── autoload.php     ← qué librerías se cargan solas
    │   ├── database.php     ← conexión a MySQL
    │   └── routes.php       ← URLs cortas
    ├── hooks/Instalador.php ← crea la base de datos sola la primera vez
    ├── controllers/         ← Productos.php, Auth.php
    ├── models/              ← Producto_model.php, Usuario_model.php
    └── views/               ← pantallas (.php) y partials/ (cabecera y pie)
```

---

## 🧰 Para llevarte a tu propio TP

Si querés **copiar la estructura** para tu proyecto, lo mínimo que necesitás es:
- `system/`, `index.php` y `application/` completos (es CodeIgniter).
- Tus propias tablas en un `.sql` y el nombre de tu base en `application/config/database.php`.
- Un controlador + modelo + vista por cada pantalla (mirá `Productos` como molde para un listado y un detalle, y `Auth` como molde para formularios con validación).

> ⚠️ **Si copiás el instalador automático** (`hooks/Instalador.php`), cambiá en él el nombre del archivo `.sql` y la tabla que usa para comprobar si la base ya existe. Es una comodidad para desarrollar en tu compu; en un hosting normalmente la base se importa desde el panel del hosting.

## 🌐 Publicarlo online
GitHub Pages **no ejecuta PHP**. Para el link online hace falta un hosting con **PHP y MySQL** (por ejemplo InfinityFree): subí los archivos, importá `ecommerce.sql` desde el panel del hosting y poné los datos de la base del hosting en `application/config/database.php`.

## 📦 Entrega
Comprimir la carpeta como **`apellido_final.zip`** (o subirla a un repositorio de GitHub) e incluir `ecommerce.sql`.
