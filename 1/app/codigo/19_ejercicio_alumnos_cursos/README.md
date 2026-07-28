# Ejercicio: tablas Alumnos y Cursos con clave foránea

## Consigna

Crear las siguientes tablas:

**Alumnos**
- Id (PK)
- Nombre
- Apellido
- DNI
- Curso al que pertenece (FK a tabla cursos)

**Cursos**
- Id (PK)
- Denominación
- Turno (M: mañana, T: tarde, N: noche)

Crear las tablas respetando el uso de claves foráneas (FK). Una vez creadas, cargar
datos de prueba en sus registros, insertando, modificando y eliminando desde phpMyAdmin.

## Resolución por SQL

Todo el ejercicio está resuelto en [alumnos_cursos.sql](alumnos_cursos.sql).
Para ejecutarlo: abrir `http://localhost/phpmyadmin/`, ir a la pestaña **SQL**,
pegar el contenido del archivo y ejecutar.

## Resolución paso a paso desde phpMyAdmin

### 1. Crear la base de datos
1. Acceder a `http://localhost/phpmyadmin/`.
2. Pestaña **Bases de datos**.
3. Escribir el nombre `cursada_php` y hacer clic en **Crear**.

### 2. Crear la tabla `cursos` (primero esta)
Se crea antes que `alumnos` porque es la que contiene la clave primaria a la que
la clave foránea va a hacer referencia.

1. Dentro de la base `cursada_php`, escribir el nombre `cursos`, indicar 3 columnas
   y hacer clic en **Continuar**.
2. Cargar las columnas:

| Nombre | Tipo | Longitud | Índice | A_I (auto incremento) | Nulo |
|---|---|---|---|---|---|
| `id` | INT | — | PRIMARY | ✔ | ✘ |
| `denominacion` | VARCHAR | 100 | — | ✘ | ✘ |
| `turno` | CHAR | 1 | — | ✘ | ✘ |

3. Guardar.

### 3. Crear la tabla `alumnos`

| Nombre | Tipo | Longitud | Índice | A_I | Nulo |
|---|---|---|---|---|---|
| `id` | INT | — | PRIMARY | ✔ | ✘ |
| `nombre` | VARCHAR | 50 | — | ✘ | ✘ |
| `apellido` | VARCHAR | 50 | — | ✘ | ✘ |
| `dni` | VARCHAR | 10 | UNIQUE | ✘ | ✘ |
| `curso_id` | INT | — | INDEX | ✘ | ✔ |

> El campo `curso_id` necesita un **índice** para poder ser clave foránea.
> Se lo dejamos como **Nulo** permitido para que un alumno pueda existir
> temporalmente sin curso asignado.

### 4. Crear la clave foránea
1. Estando en la tabla `alumnos`, ir a la pestaña **Estructura**.
2. Hacer clic en **Vista de relaciones**.
3. Completar:
   - **Nombre de la restricción:** `fk_alumnos_curso`
   - **Columna:** `curso_id` (columna de la tabla origen)
   - **Base de datos:** `cursada_php` (base de datos destino)
   - **Tabla:** `cursos` (tabla destino)
   - **Columna:** `id` (clave primaria de la tabla destino)
   - **ON DELETE:** `SET NULL`
   - **ON UPDATE:** `CASCADE`
4. Guardar.

> Si phpMyAdmin no muestra la opción "Vista de relaciones", verificar que la tabla
> use el motor **InnoDB** (pestaña **Operaciones** → *Tipo de tabla*). MyISAM no
> soporta claves foráneas.

### 5. Cargar datos de prueba
Pestaña **Insertar** de cada tabla. Cargar **primero** los cursos: si se intenta
insertar un alumno con un `curso_id` que no existe, la clave foránea rechaza el
registro con el error *"Cannot add or update a child row: a foreign key constraint fails"*.

### 6. Ver, modificar y eliminar registros
- **Examinar:** muestra todos los registros cargados; cada fila tiene los enlaces
  *Editar* y *Borrar*.
- **Buscar:** permite encontrar registros por cualquier campo.
- **Estructura → Cambiar / Eliminar:** modifica o elimina columnas de la tabla.

## Qué se debe poder comprobar al terminar

1. No se puede insertar un alumno con un `curso_id` inexistente.
2. No se pueden cargar dos alumnos con el mismo DNI.
3. Al borrar un curso, sus alumnos quedan con `curso_id` en `NULL` (por el `ON DELETE SET NULL`).
4. El `JOIN` entre ambas tablas devuelve nombre, apellido, DNI, curso y turno de cada alumno.
