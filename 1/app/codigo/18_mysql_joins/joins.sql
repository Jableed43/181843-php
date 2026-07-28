-- ====================================================================
-- JOINS en MySQL
-- --------------------------------------------------------------------
-- Los joins nos permiten "unir" los resultados de dos o más tablas
-- relacionadas.
--
-- Caso del apunte: tenemos las tablas cursos y alumnos; la tabla alumnos
-- tiene una relación con la tabla cursos. Queremos una consulta que
-- muestre el nombre, la edad y el TURNO al que asiste cada alumno.
-- El turno está en la tabla cursos, así que hay que hacer un JOIN.
--
-- Tipos:
--   INNER JOIN -> los resultados están en las DOS tablas relacionadas.
--   LEFT  JOIN -> los de las dos tablas, MÁS los de la tabla IZQUIERDA
--                 que no tienen correspondencia (esos vienen con NULL).
--   RIGHT JOIN -> los de las dos tablas, MÁS los de la tabla DERECHA
--                 que no tienen correspondencia.
-- ====================================================================

USE cursada_php;

DROP TABLE IF EXISTS alumnos_join;
DROP TABLE IF EXISTS cursos_join;

-- Tabla "padre": contiene la clave primaria a la que se hará referencia.
CREATE TABLE cursos_join (
    id INT AUTO_INCREMENT PRIMARY KEY,
    denominacion VARCHAR(80) NOT NULL,
    turno CHAR(1) NOT NULL          -- M: mañana, T: tarde, N: noche
);

-- Tabla "hija": tiene la clave foránea hacia cursos_join.
CREATE TABLE alumnos_join (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    edad INT,
    curso_id INT NULL,
    CONSTRAINT fk_alumnos_join_curso
        FOREIGN KEY (curso_id) REFERENCES cursos_join(id)
);

INSERT INTO cursos_join (denominacion, turno) VALUES
    ('Programador Web Avanzado', 'N'),   -- id 1
    ('Base de Datos',            'M'),   -- id 2
    ('Diseño UX',                'T');   -- id 3 (sin alumnos: sirve para el RIGHT JOIN)

INSERT INTO alumnos_join (nombre, edad, curso_id) VALUES
    ('Juan',  25, 1),
    ('Ana',   31, 1),
    ('Luis',  19, 2),
    ('María', 22, 2),
    ('Pedro', 40, NULL);   -- alumno sin curso: sirve para el LEFT JOIN


-- ====================================================================
-- INNER JOIN
-- Devuelve sólo los registros que tienen correspondencia en AMBAS tablas.
-- Pedro (sin curso) y Diseño UX (sin alumnos) NO aparecen.
-- ====================================================================
SELECT
    a.nombre,
    a.edad,
    c.denominacion AS curso,
    c.turno
FROM alumnos_join a
INNER JOIN cursos_join c ON a.curso_id = c.id
ORDER BY a.nombre;

-- La consulta que pide el apunte: nombre, edad y turno de cada alumno.
SELECT a.nombre, a.edad, c.turno
FROM alumnos_join a
INNER JOIN cursos_join c ON a.curso_id = c.id;


-- ====================================================================
-- LEFT JOIN
-- Devuelve TODOS los registros de la tabla izquierda (alumnos), tengan o
-- no correspondencia. Pedro aparece con curso y turno en NULL.
-- ====================================================================
SELECT
    a.nombre,
    a.edad,
    c.denominacion AS curso,
    c.turno
FROM alumnos_join a
LEFT JOIN cursos_join c ON a.curso_id = c.id
ORDER BY a.nombre;

-- Aplicación típica: encontrar los alumnos que NO tienen curso asignado.
SELECT a.nombre
FROM alumnos_join a
LEFT JOIN cursos_join c ON a.curso_id = c.id
WHERE c.id IS NULL;


-- ====================================================================
-- RIGHT JOIN
-- Devuelve TODOS los registros de la tabla derecha (cursos), tengan o no
-- alumnos. "Diseño UX" aparece con el alumno en NULL.
-- ====================================================================
SELECT
    a.nombre,
    a.edad,
    c.denominacion AS curso,
    c.turno
FROM alumnos_join a
RIGHT JOIN cursos_join c ON a.curso_id = c.id
ORDER BY c.denominacion;

-- Cursos sin ningún alumno inscripto.
SELECT c.denominacion
FROM alumnos_join a
RIGHT JOIN cursos_join c ON a.curso_id = c.id
WHERE a.id IS NULL;


-- ====================================================================
-- Joins combinados con funciones de agregado
-- ====================================================================

-- Cantidad de alumnos por curso (los cursos sin alumnos muestran 0).
SELECT
    c.denominacion AS curso,
    c.turno,
    COUNT(a.id)    AS cantidad_alumnos,
    AVG(a.edad)    AS edad_promedio
FROM cursos_join c
LEFT JOIN alumnos_join a ON a.curso_id = c.id
GROUP BY c.id, c.denominacion, c.turno
ORDER BY cantidad_alumnos DESC;

-- Mostrando el turno en texto en lugar de la letra.
SELECT
    a.nombre,
    a.edad,
    c.denominacion AS curso,
    CASE c.turno
        WHEN 'M' THEN 'Mañana'
        WHEN 'T' THEN 'Tarde'
        WHEN 'N' THEN 'Noche'
        ELSE 'Sin definir'
    END AS turno
FROM alumnos_join a
INNER JOIN cursos_join c ON a.curso_id = c.id;
