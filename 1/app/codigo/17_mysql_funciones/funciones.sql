-- ====================================================================
-- Funciones de agregado en MySQL
-- --------------------------------------------------------------------
-- MAX   -> valor máximo
-- MIN   -> valor mínimo
-- SUM   -> suma de los valores
-- COUNT -> cantidad de valores
-- AVG   -> promedio entre los valores
-- ====================================================================

USE cursada_php;

DROP TABLE IF EXISTS ventas;

CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vendedor VARCHAR(50),
    producto VARCHAR(50),
    importe DECIMAL(10,2)
);

INSERT INTO ventas (vendedor, producto, importe) VALUES
    ('Juan', 'Teclado',  20.00),
    ('Juan', 'Monitor', 180.00),
    ('Ana',  'Mouse',   100.00),
    ('Ana',  'Monitor', 180.00),
    ('Luis', 'Teclado',  20.00);


-- --------------------------------------------------------------------
-- Los ejemplos del apunte, sobre valores sueltos
-- (en MySQL, GREATEST y LEAST hacen esto con valores literales)
-- --------------------------------------------------------------------
SELECT GREATEST(20, 100, 180) AS maximo;   -- 180
SELECT LEAST(20, 100, 180)    AS minimo;   -- 20


-- --------------------------------------------------------------------
-- MAX / MIN / SUM / COUNT / AVG sobre una columna
-- --------------------------------------------------------------------
SELECT MAX(importe)   AS maximo   FROM ventas;  -- 180.00
SELECT MIN(importe)   AS minimo   FROM ventas;  -- 20.00
SELECT SUM(importe)   AS total    FROM ventas;  -- 500.00
SELECT COUNT(importe) AS cantidad FROM ventas;  -- 5
SELECT AVG(importe)   AS promedio FROM ventas;  -- 100.00

-- Todas juntas en una misma consulta
SELECT
    MAX(importe)   AS maximo,
    MIN(importe)   AS minimo,
    SUM(importe)   AS total,
    COUNT(*)       AS cantidad,
    AVG(importe)   AS promedio
FROM ventas;


-- --------------------------------------------------------------------
-- Variantes de COUNT
-- --------------------------------------------------------------------
SELECT COUNT(*)                 AS total_filas       FROM ventas;
SELECT COUNT(DISTINCT vendedor) AS cantidad_vendedores FROM ventas;
SELECT COUNT(DISTINCT producto) AS cantidad_productos  FROM ventas;


-- --------------------------------------------------------------------
-- Combinadas con GROUP BY: el agregado se calcula por grupo
-- --------------------------------------------------------------------
SELECT
    vendedor,
    COUNT(*)     AS cantidad_ventas,
    SUM(importe) AS total_vendido,
    AVG(importe) AS promedio_por_venta,
    MAX(importe) AS venta_mas_alta,
    MIN(importe) AS venta_mas_baja
FROM ventas
GROUP BY vendedor
ORDER BY total_vendido DESC;


-- --------------------------------------------------------------------
-- HAVING: filtra sobre el resultado de las funciones de agregado
-- (WHERE filtra filas ANTES de agrupar; HAVING filtra grupos DESPUÉS)
-- --------------------------------------------------------------------
SELECT vendedor, SUM(importe) AS total_vendido
FROM ventas
GROUP BY vendedor
HAVING SUM(importe) > 150;


-- --------------------------------------------------------------------
-- Combinando WHERE + GROUP BY + HAVING
-- --------------------------------------------------------------------
SELECT producto, COUNT(*) AS veces_vendido, SUM(importe) AS recaudado
FROM ventas
WHERE importe >= 20
GROUP BY producto
HAVING COUNT(*) > 1
ORDER BY recaudado DESC;
