-- ====================================================================
-- Ejercicio propuesto (phpMyAdmin / Claves foráneas)
-- --------------------------------------------------------------------
-- Crear las siguientes tablas:
--
--   Alumnos                     Cursos
--     Id (PK)                     Id (PK)
--     Nombre                      Denominación
--     Apellido                    Turno (M: mañana, T: tarde, N: noche)
--     DNI
--     Curso al que pertenece (FK a tabla cursos)
--
-- Crear las tablas respetando el uso de claves foráneas (FK). Una vez
-- creadas, cargar datos de prueba en sus registros, insertando,
-- modificando y eliminando.
--
-- Este script hace por SQL exactamente lo mismo que se puede hacer con
-- los formularios de phpMyAdmin (ver README.md de esta carpeta).
-- ====================================================================

CREATE DATABASE IF NOT EXISTS cursada_php
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE cursada_php;

-- Se borra primero la tabla hija (alumnos), porque es la que tiene la FK.
DROP TABLE IF EXISTS alumnos;
DROP TABLE IF EXISTS cursos;


-- ====================================================================
-- 1) CREACIÓN DE LAS TABLAS
-- ====================================================================

-- Primero la tabla CURSOS: es la que tiene la clave primaria a la que la
-- clave foránea hará referencia. Si se crea al revés, MySQL da error.
CREATE TABLE cursos (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    denominacion VARCHAR(100) NOT NULL,
    turno        CHAR(1)      NOT NULL,   -- M: mañana, T: tarde, N: noche

    -- Restricción extra: el turno sólo puede tomar esos tres valores.
    CONSTRAINT chk_cursos_turno CHECK (turno IN ('M', 'T', 'N'))
) ENGINE = InnoDB;   -- InnoDB es necesario para que las FK funcionen


-- Luego la tabla ALUMNOS, con la clave foránea hacia cursos.
CREATE TABLE alumnos (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nombre   VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni      VARCHAR(10) NOT NULL UNIQUE,  -- no puede haber dos alumnos con el mismo DNI
    curso_id INT NULL,                     -- FK: curso al que pertenece

    CONSTRAINT fk_alumnos_curso
        FOREIGN KEY (curso_id) REFERENCES cursos(id)
        ON UPDATE CASCADE      -- si cambia el id del curso, se actualiza acá
        ON DELETE SET NULL     -- si se borra el curso, el alumno queda sin curso
) ENGINE = InnoDB;

DESCRIBE cursos;
DESCRIBE alumnos;


-- ====================================================================
-- 2) INSERTAR datos de prueba
-- ====================================================================

-- Siempre primero los cursos: un alumno no puede apuntar a un curso
-- que todavía no existe (la FK lo impide).
INSERT INTO cursos (denominacion, turno) VALUES
    ('Programador Web Avanzado', 'N'),   -- id 1
    ('Base de Datos MySQL',      'M'),   -- id 2
    ('Diseño UX',                'T');   -- id 3

INSERT INTO alumnos (nombre, apellido, dni, curso_id) VALUES
    ('Juan',  'Pérez',    '30111222', 1),
    ('Ana',   'Gómez',    '31222333', 1),
    ('Luis',  'Martínez', '32333444', 2),
    ('María', 'López',    '33444555', 2),
    ('Pedro', 'Sosa',     '34555666', 3);

SELECT * FROM cursos;
SELECT * FROM alumnos;


-- ====================================================================
-- 3) CONSULTAR con JOIN: alumnos con su curso y turno
-- ====================================================================
SELECT
    a.id,
    a.nombre,
    a.apellido,
    a.dni,
    c.denominacion AS curso,
    CASE c.turno
        WHEN 'M' THEN 'Mañana'
        WHEN 'T' THEN 'Tarde'
        WHEN 'N' THEN 'Noche'
    END AS turno
FROM alumnos a
INNER JOIN cursos c ON a.curso_id = c.id
ORDER BY a.apellido;

-- Cantidad de alumnos por curso
SELECT c.denominacion, c.turno, COUNT(a.id) AS cantidad_alumnos
FROM cursos c
LEFT JOIN alumnos a ON a.curso_id = c.id
GROUP BY c.id, c.denominacion, c.turno;


-- ====================================================================
-- 4) MODIFICAR registros
-- ====================================================================

-- Cambiar de curso a un alumno
UPDATE alumnos SET curso_id = 2 WHERE dni = '30111222';

-- Corregir el apellido de un alumno
UPDATE alumnos SET apellido = 'Pérez González' WHERE dni = '30111222';

-- Cambiar el turno de un curso
UPDATE cursos SET turno = 'T' WHERE id = 2;

SELECT * FROM alumnos;
SELECT * FROM cursos;


-- ====================================================================
-- 5) ELIMINAR registros
-- ====================================================================

-- Eliminar un alumno: no hay problema, nadie lo referencia.
DELETE FROM alumnos WHERE dni = '34555666';

-- Eliminar un curso que TIENE alumnos: gracias al ON DELETE SET NULL,
-- los alumnos de ese curso quedan con curso_id = NULL en lugar de dar error.
DELETE FROM cursos WHERE id = 3;

SELECT * FROM alumnos;
SELECT * FROM cursos;


-- ====================================================================
-- 6) Comprobar que la clave foránea realmente funciona
-- ====================================================================

-- Esta inserción DEBE fallar: el curso 99 no existe.
-- Error esperado: Cannot add or update a child row: a foreign key
--                 constraint fails (...fk_alumnos_curso...)
-- INSERT INTO alumnos (nombre, apellido, dni, curso_id)
--     VALUES ('Test', 'Error', '99999999', 99);

-- Esta también DEBE fallar: el DNI 30111222 ya existe (UNIQUE).
-- Error esperado: Duplicate entry '30111222' for key 'dni'
-- INSERT INTO alumnos (nombre, apellido, dni, curso_id)
--     VALUES ('Otro', 'Alumno', '30111222', 1);

-- Y esta también: el turno 'X' no está permitido por el CHECK.
-- INSERT INTO cursos (denominacion, turno) VALUES ('Curso raro', 'X');


-- ====================================================================
-- Ver las claves foráneas definidas en la base
-- ====================================================================
SELECT
    TABLE_NAME              AS tabla_origen,
    COLUMN_NAME             AS columna_origen,
    CONSTRAINT_NAME         AS nombre_restriccion,
    REFERENCED_TABLE_NAME   AS tabla_destino,
    REFERENCED_COLUMN_NAME  AS columna_destino
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = 'cursada_php'
  AND REFERENCED_TABLE_NAME IS NOT NULL;
