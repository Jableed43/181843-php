-- ====================================================================
-- Tipos de datos en MySQL
-- --------------------------------------------------------------------
-- Tabla de ejemplo que usa un campo de cada tipo visto en la unidad.
-- ====================================================================

USE cursada_php;

DROP TABLE IF EXISTS ejemplo_tipos;

CREATE TABLE ejemplo_tipos (

    id INT AUTO_INCREMENT PRIMARY KEY,

    -- ================================================================
    -- ENTEROS
    -- ================================================================
    campo_tinyint    TINYINT,    -- de -128 a 127
    campo_smallint   SMALLINT,   -- de -32.768 a 32.767
    campo_mediumint  MEDIUMINT,  -- de -8.388.608 a 8.388.607
    campo_int        INT,        -- de -2.147.483.648 a 2.147.483.647
    campo_bigint     BIGINT,     -- entero grande
    campo_boolean    BOOLEAN,    -- 0 o 1 (en MySQL es un alias de TINYINT(1))
    campo_bit        BIT,        -- 0 o 1

    -- UNSIGNED: no admite negativos, por lo que duplica el rango positivo
    campo_int_unsigned INT UNSIGNED,

    -- ================================================================
    -- REALES
    -- ================================================================
    -- DECIMAL(5,2): 5 dígitos en total, 2 de ellos decimales -> 123.45
    campo_decimal    DECIMAL(5,2),
    campo_float      FLOAT(10,4),

    -- ================================================================
    -- CADENAS
    -- ================================================================
    campo_char       CHAR(10),      -- longitud FIJA (máx. 255)
    campo_varchar    VARCHAR(50),   -- hasta la longitud indicada (máx. 65.535)
    campo_text       TEXT,          -- texto muy largo
    campo_blob       BLOB,          -- datos binarios (imágenes, archivos)

    -- ================================================================
    -- FECHA Y HORA
    -- ================================================================
    campo_date       DATE,      -- AAAA-MM-DD
    campo_time       TIME,      -- HH:MM:SS
    campo_datetime   DATETIME,  -- AAAA-MM-DD HH:MM:SS

    -- El campo puede aceptar NULL o no
    campo_obligatorio VARCHAR(30) NOT NULL DEFAULT 'sin dato'
);

DESCRIBE ejemplo_tipos;


-- --------------------------------------------------------------------
-- Un registro de prueba con cada tipo cargado
-- --------------------------------------------------------------------
INSERT INTO ejemplo_tipos (
    campo_tinyint, campo_smallint, campo_mediumint, campo_int, campo_bigint,
    campo_boolean, campo_bit, campo_int_unsigned,
    campo_decimal, campo_float,
    campo_char, campo_varchar, campo_text,
    campo_date, campo_time, campo_datetime,
    campo_obligatorio
) VALUES (
    127, 32767, 8388607, 2147483647, 9223372036854775807,
    TRUE, 1, 4294967295,
    123.45, 3.1416,
    'ABC', 'Texto de longitud variable', 'Un texto largo para el campo TEXT...',
    '2026-07-28', '14:30:00', '2026-07-28 14:30:00',
    'valor cargado'
);

SELECT * FROM ejemplo_tipos;


-- --------------------------------------------------------------------
-- CHAR vs VARCHAR
-- --------------------------------------------------------------------
-- CHAR(10)    con el valor 'ABC' ocupa siempre 10 caracteres (rellena con espacios).
-- VARCHAR(10) con el valor 'ABC' ocupa sólo lo necesario.
-- Por eso CHAR conviene para datos de longitud siempre igual (ej: 'M'/'T'/'N',
-- un código de provincia) y VARCHAR para el resto.

SELECT
    CONCAT('[', campo_char, ']')    AS char_con_relleno,
    CHAR_LENGTH(campo_char)         AS largo_char,
    CONCAT('[', campo_varchar, ']') AS varchar_sin_relleno,
    CHAR_LENGTH(campo_varchar)      AS largo_varchar
FROM ejemplo_tipos;


-- --------------------------------------------------------------------
-- DECIMAL vs FLOAT
-- --------------------------------------------------------------------
-- DECIMAL guarda el valor exacto  -> usar para dinero.
-- FLOAT   guarda una aproximación -> usar para cálculos científicos.
SELECT campo_decimal, campo_float FROM ejemplo_tipos;
