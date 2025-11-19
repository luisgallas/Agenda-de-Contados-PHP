CREATE DATABASE IF NOT EXISTS agenda_contactos CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE agenda_contactos;

CREATE TABLE IF NOT EXISTS contactos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  telefono VARCHAR(50),
  email VARCHAR(150),
  favorito TINYINT(1) DEFAULT 0,
  creado_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_email (email)
);

