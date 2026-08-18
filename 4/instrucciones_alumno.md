# 📋 Clase 4 — CodeIgniter 3 (Parte 2): qué preparar

---

## ✅ Antes de la clase

### 1. Traer la Clase 3 funcionando
Necesitás tu proyecto de CodeIgniter con el listado de productos andando. Si te quedó a medias, avisá **antes**.

### 2. Base de datos
Vamos a usar una base nueva, `clase4`, para no pisar lo de la clase pasada. El script te lo paso junto con este documento (`crear_tabla_productos.sql`): importalo desde phpMyAdmin.

Después revisá `application/config/database.php` y que la línea diga:
```php
'database' => 'clase4',
```

### 3. Activar la librería de validación
En `application/config/autoload.php`, alrededor de la línea 61:
```php
$autoload['libraries'] = array('database', 'form_validation');
```
Es agregar `'form_validation'` a lo que ya tenías.

### 4. Comprobar que anda
Entrá al listado de productos. Si ves la tabla, estás listo.

---

## 📚 Qué repasar (10 minutos)

**De la Clase 3:**
- Cómo el controlador le pide datos al modelo y se los pasa a la vista
- Qué hace `$this->db->get()` y `$this->db->where()`
- Que cada clave del array `$datos` se convierte en una variable dentro de la vista

**De la Clase 1 (HTML):**
- Cómo se arma un `<form>`: los atributos `action` y `method`
- Para qué sirve el atributo `name` de un `<input>` ← **este es el importante de hoy**

---

## 🎯 Qué vamos a hacer

Hoy cerramos el circuito. La clase pasada solo **leíamos** de la base; hoy vamos a **escribir**:

1. Un formulario para cargar un producto nuevo
2. Validar los datos antes de guardarlos (que el nombre no venga vacío, que el precio sea un número)
3. Insertar en la base de datos
4. Ver el detalle de un producto, con el id viajando por la URL
5. Ponerle estilos con una hoja CSS propia

> 📧 **Sobre el envío de emails:** está en el material de la unidad, pero **no lo vemos en clase**. Mandar un mail de verdad necesita un servidor de correo configurado, y eso no se resuelve en una clase de una hora. Te lo dejo **resuelto y comentado** en el proyecto final, y explicado más abajo en este documento.

---

## 🎯 Después de la clase (tarea)

### Parte A — Cerrar el CRUD

En la Clase 3 leímos, hoy insertamos. Faltan **modificar** y **borrar**.

1. Completá en `application/models/Productos_model.php` los dos métodos que quedaron con TODO:

   ```php
   public function actualizar($id, $datos) {
       $this->db->where('id', $id);
       return $this->db->update('productos', $datos);
   }

   public function eliminar($id) {
       $this->db->where('id', $id);
       return $this->db->delete('productos');
   }
   ```

   > ⚠️ **Ojo con `eliminar()`:** si te olvidás el `where()`, `delete()` **borra la tabla entera**. Lo mismo con `update()`: sin `where()` modifica todas las filas. Probalo con datos de prueba, no con algo que te importe.

2. Agregá al controlador un método `editar($id)` que:
   - Traiga el producto con `obtenerPorId($id)` (lo escribiste en la clase 3)
   - Muestre el formulario **con los datos ya cargados**
   - Al recibir el POST, valide igual que `nuevo()` y llame a `actualizar()`

   **Pista:** el tercer parámetro de `set_value()` no hace falta; podés pasarle el valor actual del producto como segundo argumento: `set_value('nombre', $producto->nombre)`.

3. Agregá una columna "Acciones" al listado, con un link a `productos/editar/ID` en cada fila.

### Parte B — Mejorar la validación

4. Agregá la regla `greater_than[0]` al precio, para que no se pueda cargar un producto con precio 0 o negativo.

   > 🔗 Es literalmente la regla de negocio del ejercicio de la distribuidora de la clase pasada: *"el precio debe ser mayor a 0"*.

5. Agregá `trim` al principio de las reglas del nombre: `'trim|required|min_length[3]'`. Probá cargar un producto con espacios al principio y fijate la diferencia.

### Parte C — Envío de emails (lectura + opcional)

Este tema está en el material de la unidad y **no lo vimos en clase**, porque necesita un servidor de correo configurado. Te lo dejo resuelto para que lo leas y, si querés, lo pongas a andar.

**Dónde mirar:**
- `application/config/email.php` — la configuración
- `application/controllers/Productos.php` → método `notificarAlta()` — el uso

**Cómo funciona.** CodeIgniter trae una librería de email. Se carga con `$this->load->library('email')` y lee `config/email.php` solo, sin que le pases nada. Después son cuatro métodos:

```php
$this->email->from('sistema@distribuidora.com', 'Sistema de Stock');
$this->email->to('deposito@distribuidora.com');
$this->email->subject('Nuevo producto cargado');
$this->email->message('El cuerpo del mensaje');
$this->email->send();
```

**Por qué en el proyecto no se envía.** XAMPP no trae servidor de correo, así que `send()` falla siempre. Para que igual puedas ver el resultado, el código está en **modo simulado**:

| Línea | Por qué está |
| :--- | :--- |
| `@` antes de `send()` | Silencia el warning de PHP por no haber servidor |
| `send(FALSE)` | El `FALSE` le pide que **no limpie** los datos del email |
| `print_debugger()` | Devuelve el email **ya armado** (headers, asunto, cuerpo) y lo mostramos en pantalla |

Por eso, al guardar un producto, vas a ver un aviso que dice *"Unable to send email"* y **debajo el email completo**. Ese aviso es esperado: no es un error tuyo.

**7. (Opcional) Hacer que envíe de verdad.**
En `application/config/email.php` está el bloque SMTP comentado al final. Descomentalo y completalo con una cuenta real. Con Gmail necesitás una **contraseña de aplicación**, no la de tu usuario: `https://myaccount.google.com/apppasswords`

Después, en `notificarAlta()`, reemplazá las dos últimas líneas por:
```php
return $this->email->send();
```

> ⚠️ No subas nunca esa contraseña a un repositorio público.

### Parte D — Opcional, si te quedaste con ganas

8. Cambiá la pantalla de éxito por un `redirect('productos')` y averiguá qué es el patrón **POST-Redirect-GET**: por qué al refrescar después de guardar el navegador pregunta si querés reenviar los datos, y cómo el redirect lo evita.

---

## 📤 Qué entregar

Los tres archivos que modificaste:
- `application/controllers/Productos.php`
- `application/models/Productos_model.php`
- `application/views/productos_nuevo.php`

Más una captura del listado mostrando un producto cargado por vos desde el formulario.
