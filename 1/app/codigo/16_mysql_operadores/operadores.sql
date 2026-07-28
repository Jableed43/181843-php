-- ====================================================================
-- Operadores en MySQL
-- ====================================================================

USE cursada_php;

-- Tabla de trabajo con datos de prueba.
DROP TABLE IF EXISTS alumnos_operadores;

CREATE TABLE alumnos_operadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    edad INT,
    nota DECIMAL(4,2)
);

INSERT INTO alumnos_operadores (nombre, apellido, edad, nota) VALUES
    ('Juan',  'Pérez',    25, 8.50),
    ('Ana',   'Gómez',    31, 9.75),
    ('Luis',  'Martínez', 19, 6.00),
    ('María', 'López',    22, 7.25),
    ('Jorge', 'Borges',   40, 10.00),
    ('Sofía', 'Díaz',     17, 4.50);


-- ====================================================================
-- ARITMÉTICOS:  +   -   *   /   %
-- ====================================================================
SELECT
    5 + 3  AS suma,            -- 8
    5 - 3  AS resta,           -- 2
    5 * 3  AS multiplicacion,  -- 15
    10 / 5 AS division,        -- 2
    5 % 3  AS resto;           -- 2

-- Aplicados sobre columnas de una tabla
SELECT
    nombre,
    edad,
    edad + 1        AS edad_el_anio_que_viene,
    nota,
    nota * 10       AS nota_sobre_100,
    edad % 2        AS resto_division_por_2
FROM alumnos_operadores;


-- ====================================================================
-- COMPARACIÓN:  =   !=  (o <>)   <   >   <=   >=
-- ====================================================================
SELECT
    5 =  3 AS igual,            -- 0 (False)
    5 != 3 AS distinto,         -- 1 (True)
    5 <> 3 AS distinto_alt,     -- 1 (True)
    5 <  3 AS menor,            -- 0 (False)
    5 >  3 AS mayor,            -- 1 (True)
    5 <= 3 AS menor_o_igual,    -- 0 (False)
    5 >= 3 AS mayor_o_igual;    -- 1 (True)

-- Usados en el WHERE
SELECT * FROM alumnos_operadores WHERE edad =  25;
SELECT * FROM alumnos_operadores WHERE edad != 25;
SELECT * FROM alumnos_operadores WHERE edad >  21;
SELECT * FROM alumnos_operadores WHERE nota <= 7;


-- ====================================================================
-- LÓGICOS: AND, OR, BETWEEN, IN, LIKE, NOT
-- ====================================================================

-- AND: se deben cumplir las dos condiciones
SELECT 2 < 3 AND 3 < 5 AS resultado_and;   -- 1 (True)
SELECT * FROM alumnos_operadores WHERE edad >= 18 AND nota >= 7;

-- OR: alcanza con que se cumpla una
SELECT 2 > 3 OR 3 < 5 AS resultado_or;     -- 1 (True)
SELECT * FROM alumnos_operadores WHERE edad < 18 OR edad > 35;

-- BETWEEN: verifica que un valor esté entre otros dos (incluye los extremos)
SELECT 3 BETWEEN 2 AND 5 AS resultado_between;  -- 1 (True)
SELECT * FROM alumnos_operadores WHERE edad BETWEEN 18 AND 30;

-- IN: verifica que un valor esté dentro de una lista
SELECT 2 IN (1,2,3,4,5) AS resultado_in;   -- 1 (True)
SELECT * FROM alumnos_operadores WHERE nombre IN ('Juan', 'Ana', 'Sofía');

-- LIKE: verifica que un valor esté contenido en otro (string)
--   %  -> cualquier cantidad de caracteres
--   _  -> exactamente un carácter
SELECT 'Jorge Luis Borges' LIKE '%Luis%' AS resultado_like;  -- 1 (True)

SELECT * FROM alumnos_operadores WHERE nombre LIKE 'J%';      -- empieza con J
SELECT * FROM alumnos_operadores WHERE apellido LIKE '%ez';   -- termina en ez
SELECT * FROM alumnos_operadores WHERE nombre LIKE '%an%';    -- contiene "an"
SELECT * FROM alumnos_operadores WHERE nombre LIKE '_na';     -- 3 letras terminadas en "na" (Ana)

-- NOT (o !): niega el resultado de la operación siguiente
SELECT 3 NOT BETWEEN 2 AND 5 AS resultado_not;  -- 0 (False)

SELECT * FROM alumnos_operadores WHERE edad NOT BETWEEN 18 AND 30;
SELECT * FROM alumnos_operadores WHERE nombre NOT IN ('Juan', 'Ana');
SELECT * FROM alumnos_operadores WHERE nombre NOT LIKE 'J%';


-- ====================================================================
-- Combinando varios operadores
-- ====================================================================
SELECT nombre, apellido, edad, nota
FROM alumnos_operadores
WHERE (edad BETWEEN 18 AND 35)
  AND nota >= 7
  AND apellido NOT LIKE 'M%'
ORDER BY nota DESC;
