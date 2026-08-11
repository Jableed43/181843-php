CREATE DATABASE IF NOT EXISTS clase3;
USE clase3;

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0
);

INSERT INTO productos (nombre, precio, stock) VALUES
('Coca Cola 2L', 1500.00, 30),
('Agua Mineral 500ml', 500.00, 100),
('Cerveza Rubia 1L', 2200.00, 45);
