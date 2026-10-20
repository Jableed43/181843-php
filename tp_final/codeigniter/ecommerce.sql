-- ============================================================
--  TP FINAL (CodeIgniter) — Base de datos del e-commerce
--  Cómo usarlo: phpMyAdmin -> pestaña "Importar" -> elegir este archivo.
--  (o por consola: mysql -u root < ecommerce.sql)
-- ============================================================

CREATE DATABASE IF NOT EXISTS tp_ecommerce
    CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE tp_ecommerce;

-- ---------- Productos (Home + Detalle) ----------
CREATE TABLE IF NOT EXISTS productos (
    id     INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20)   NOT NULL UNIQUE,    -- ej: AUR-001
    nombre VARCHAR(100)  NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock  INT           NOT NULL DEFAULT 0
);

-- ---------- Usuarios (Registro + Login) ----------
-- El email es UNIQUE: la base no deja registrar dos veces el mismo.
-- La contraseña NUNCA se guarda en texto plano: se guarda el "hash"
-- (por eso es VARCHAR(255): los hashes son largos).
CREATE TABLE IF NOT EXISTS usuarios (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nombre   VARCHAR(80)  NOT NULL,
    email    VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    creado   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- ---------- Datos de ejemplo ----------
-- Se cargan solo si la tabla está vacía (así se puede importar más de una vez).
INSERT INTO productos (codigo, nombre, precio, stock)
SELECT * FROM (
    SELECT 'AUR-001' AS codigo, 'Auriculares Bluetooth'  AS nombre,  45999.00 AS precio, 15 AS stock UNION ALL
    SELECT 'TEC-002', 'Teclado Mecánico',                            78500.00, 8  UNION ALL
    SELECT 'MOU-003', 'Mouse Inalámbrico',                           18900.00, 32 UNION ALL
    SELECT 'MON-004', 'Monitor 24" Full HD',                        189900.00, 5  UNION ALL
    SELECT 'WEB-005', 'Webcam HD 1080p',                             32500.00, 0  UNION ALL
    SELECT 'MOC-006', 'Mochila para Notebook',                       27800.00, 20 UNION ALL
    SELECT 'CAR-007', 'Cargador USB-C 65W',                          21400.00, 40 UNION ALL
    SELECT 'PAD-008', 'Pad Mouse XL',                                 9800.00, 60
) AS datos
WHERE NOT EXISTS (SELECT 1 FROM productos);
