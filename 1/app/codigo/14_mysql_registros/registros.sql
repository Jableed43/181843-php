-- ====================================================================
-- Operaciones básicas sobre REGISTROS en MySQL
-- --------------------------------------------------------------------
-- Requiere la tabla alumnos creada en 13_mysql_tablas/tablas.sql
-- ====================================================================

USE cursada_php;

-- Por si no existe todavía:
CREATE TABLE IF NOT EXISTS alumnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    edad INT
);


-- --------------------------------------------------------------------
-- INSERTAR DATOS
-- --------------------------------------------------------------------
INSERT INTO alumnos (nombre, edad) VALUES ('Juan', 25);

-- No hace falta indicar el id: es AUTO_INCREMENT, MySQL lo asigna solo.
INSERT INTO alumnos (nombre, edad) VALUES ('Ana', 31);
INSERT INTO alumnos (nombre, edad) VALUES ('Luis', 19);

-- Insertar varios registros de una sola vez.
INSERT INTO alumnos (nombre, edad) VALUES
    ('María', 22),
    ('Pedro', 40),
    ('Sofía', 17);


-- --------------------------------------------------------------------
-- CONSULTAR DATOS
-- --------------------------------------------------------------------

-- Todas las columnas de todos los registros
SELECT * FROM alumnos;

-- Una sola columna, filtrando con WHERE
SELECT nombre FROM alumnos WHERE edad > 20;

-- Varias columnas
SELECT nombre, edad FROM alumnos;

-- Con alias de columna
SELECT nombre AS alumno, edad AS años FROM alumnos;

-- Ordenado
SELECT * FROM alumnos ORDER BY edad DESC;

-- Limitando la cantidad de resultados
SELECT * FROM alumnos ORDER BY edad ASC LIMIT 3;

-- Filtros combinados
SELECT * FROM alumnos WHERE edad >= 18 AND edad <= 30;
SELECT * FROM alumnos WHERE nombre LIKE 'J%';


-- --------------------------------------------------------------------
-- ACTUALIZAR DATOS
-- --------------------------------------------------------------------
UPDATE alumnos SET edad = 26 WHERE id = 1;

-- Actualizar varias columnas a la vez
UPDATE alumnos SET nombre = 'Juan Carlos', edad = 27 WHERE id = 1;

-- ATENCIÓN: si se olvida el WHERE, se actualizan TODOS los registros.
-- UPDATE alumnos SET edad = 0;   <-- ¡peligroso!

SELECT * FROM alumnos;


-- --------------------------------------------------------------------
-- ELIMINAR DATOS
-- --------------------------------------------------------------------
DELETE FROM alumnos WHERE id = 1;

-- También se puede borrar por cualquier condición
DELETE FROM alumnos WHERE edad < 18;

-- ATENCIÓN: sin WHERE se borran TODOS los registros de la tabla.
-- DELETE FROM alumnos;   <-- ¡peligroso!

SELECT * FROM alumnos;
