# Clase 1 — Código de ejemplo

Resolución de todos los ejemplos y ejercicios propuestos de
[`unidad_m1.md`](../../unidad_m1.md) — *Módulo 1, Unidad 1: Nivelación PHP y MySQL*.

Cada ejemplo está en su propia carpeta.

## Cómo ejecutar los ejemplos de PHP

Los archivos `.php` deben abrirse **a través del servidor**, no haciendo doble clic
en el archivo. Con XAMPP corriendo (Apache iniciado), la ruta es:

```
http://localhost/cursada_php/material/clase_1/codigo/01_sintaxis_basica/index.php
```

También se pueden probar desde la consola:

```bash
D:\xampp\php\php.exe D:\xampp\htdocs\cursada_php\material\clase_1\codigo\09_ciclo_for\for.php
```

> Los ejemplos de **formularios** y **sesión** sólo funcionan por Apache
> (`http://localhost/...`), no por consola.

## Cómo ejecutar los ejemplos de MySQL

Los archivos `.sql` se ejecutan desde phpMyAdmin (`http://localhost/phpmyadmin/`),
pestaña **SQL**: pegar el contenido y ejecutar. Todos trabajan sobre la base
`cursada_php`, que se crea en el ejemplo 13.

---

## Índice

### PHP

| # | Carpeta | Tema | Contenido |
|---|---|---|---|
| 01 | `01_sintaxis_basica` | Sintaxis básica de PHP | `index.php` — etiquetas `<?php ?>`, PHP incrustado en HTML |
| 02 | `02_variables_imprimir` | Variables e impresión | `imprimir.php` — **ejercicio propuesto**: `$mi_nombre` con `echo`, `print`, `var_dump` y `print_r` |
| 03 | `03_constantes` | Constantes | `constantes.php` — **ejercicio propuesto**: constante `_CURSO` y qué pasa al intentar modificarla |
| 04 | `04_operadores` | Operadores | `01_aritmeticos.php`, `02_asignacion.php`, `03_comparacion.php`, `04_logicos.php` |
| 05 | `05_funciones` | Funciones | `01_sumar.php` (ejemplo del apunte) y `02_concatenar.php` (**ejercicio propuesto**) |
| 06 | `06_condicional_if_else` | Condicionales | `if_else.php` — ejemplo de la batería, `elseif`, ternario |
| 07 | `07_condicional_switch` | Condicionales | `switch.php` — ejemplo de los meses, completo |
| 08 | `08_ciclo_while` | Ciclos | `while.php` |
| 09 | `09_ciclo_for` | Ciclos | `for.php` |
| 10 | `10_vectores` | Vectores | `01_vectores.php`, `02_vectores_asociativos.php`, y los dos **ejercicios propuestos**: `03_ejercicio_for.php` y `04_ejercicio_while.php` |
| 11 | `11_formularios` | Formularios | **ejercicio propuesto**: `formulario.html` → `formulario.php` (`var_dump($_POST)`). Incluye la variante por GET para comparar |
| 12 | `12_session` | Session | `01_session_basica.php`, `02_cerrar_session.php` y el **ejercicio propuesto**: `formulario.html` → `guardar_session.php` → `formulario_session.php` |

### MySQL

| # | Carpeta | Tema | Contenido |
|---|---|---|---|
| 13 | `13_mysql_tablas` | Operaciones sobre tablas | `CREATE`, `ALTER`, `TRUNCATE`, `DROP` |
| 14 | `14_mysql_registros` | Operaciones sobre registros | `INSERT`, `SELECT`, `UPDATE`, `DELETE` |
| 15 | `15_mysql_tipos_datos` | Tipos de datos | Tabla con un campo de cada tipo; `CHAR` vs `VARCHAR`, `DECIMAL` vs `FLOAT` |
| 16 | `16_mysql_operadores` | Operadores | Aritméticos, de comparación y lógicos (`AND`, `OR`, `BETWEEN`, `IN`, `LIKE`, `NOT`) |
| 17 | `17_mysql_funciones` | Funciones | `MAX`, `MIN`, `SUM`, `COUNT`, `AVG` + `GROUP BY` y `HAVING` |
| 18 | `18_mysql_joins` | Joins | `INNER JOIN`, `LEFT JOIN`, `RIGHT JOIN` sobre alumnos/cursos |
| 19 | `19_ejercicio_alumnos_cursos` | phpMyAdmin / FK | **ejercicio propuesto**: tablas Alumnos y Cursos con clave foránea. Incluye el paso a paso por phpMyAdmin en su `README.md` |

---

## Respuestas a las preguntas del apunte

**Ejemplo 03 — ¿Qué nos arroja en pantalla al intentar modificar una constante?**
Un `Warning: Constant _CURSO already defined` (en PHP 7 era un `Notice`). La constante
**conserva su valor original**: no se puede modificar. Esa es la diferencia principal
con las variables, que sí se pueden reasignar.

**Ejemplo 11 — ¿Qué es la variable `$_POST`?**
Es un **vector asociativo superglobal** que PHP arma automáticamente con los datos
enviados por un formulario cuyo `method` es `POST`. Las claves son los valores del
atributo `name` de cada campo del formulario y los valores son lo que cargó el
usuario. Es *superglobal* porque está disponible en cualquier ámbito del script sin
tener que declararla.
