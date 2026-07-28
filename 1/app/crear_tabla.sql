-- structured query language
CREATE DATABASE IF NOT EXISTS clase1;
USE clase1;

CREATE TABLE alumnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    edad INT NOT NULL
);
