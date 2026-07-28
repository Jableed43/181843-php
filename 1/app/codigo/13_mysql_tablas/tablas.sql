-- ====================================================================
-- Operaciones básicas sobre TABLAS en MySQL
-- --------------------------------------------------------------------
-- Ejecutar desde phpMyAdmin (pestaña "SQL") o desde la consola de MySQL.
-- ====================================================================

-- Base de datos de trabajo para todos los ejemplos de la clase.
CREATE DATABASE IF NOT EXISTS cursada_php
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE cursada_php;


-- --------------------------------------------------------------------
-- CREAR TABLA
-- Creamos la tabla en la cual almacenaremos los datos.
-- Debemos especificar columna y tipo de dato a crear.
-- --------------------------------------------------------------------
CREATE TABLE alumnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    edad INT
);

-- Ver la estructura de la tabla recién creada.
DESCRIBE alumnos;


-- --------------------------------------------------------------------
-- MODIFICAR TABLA
-- Mediante esta sintaxis podremos modificar la estructura de la tabla.
-- --------------------------------------------------------------------

-- Agregar una columna
ALTER TABLE alumnos ADD email VARCHAR(100);

-- Modificar el tipo de dato de una columna existente
ALTER TABLE alumnos MODIFY nombre VARCHAR(80);

-- Renombrar una columna (cambia nombre y tipo)
ALTER TABLE alumnos CHANGE edad edad_alumno INT;

-- Volver a dejarla como estaba
ALTER TABLE alumnos CHANGE edad_alumno edad INT;

-- Eliminar una columna
ALTER TABLE alumnos DROP COLUMN email;

DESCRIBE alumnos;


-- --------------------------------------------------------------------
-- ELIMINAR TODOS LOS REGISTROS DE UNA TABLA
-- Vacía la tabla pero la estructura sigue existiendo.
-- Además reinicia el contador del AUTO_INCREMENT.
-- --------------------------------------------------------------------
TRUNCATE TABLE alumnos;


-- --------------------------------------------------------------------
-- ELIMINAR TABLA
-- Borra la tabla completa: estructura y datos.
-- --------------------------------------------------------------------
-- DROP TABLE alumnos;

-- Variante segura: no da error si la tabla no existe.
-- DROP TABLE IF EXISTS alumnos;


-- --------------------------------------------------------------------
-- Diferencias a tener en cuenta
-- --------------------------------------------------------------------
-- DELETE FROM alumnos;  -> borra registros, admite WHERE, no reinicia el AUTO_INCREMENT
-- TRUNCATE TABLE alumnos; -> borra TODOS los registros, no admite WHERE, reinicia AUTO_INCREMENT
-- DROP TABLE alumnos;   -> elimina la tabla entera (ya no existe)
