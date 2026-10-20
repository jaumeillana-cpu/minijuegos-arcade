-- Estructura de base de datos y catálogo de juegos; sin datos personales de prueba.
CREATE DATABASE IF NOT EXISTS minijuegos_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE minijuegos_db;

CREATE TABLE IF NOT EXISTS juegos (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  codigo VARCHAR(50) NOT NULL UNIQUE,
  nombre VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS jugadores (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS puntuaciones (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  jugador_id INT NOT NULL,
  juego_id INT DEFAULT NULL,
  juego ENUM('pong','tres_en_raya','dobles_parejas') NOT NULL,
  puntuacion INT NOT NULL,
  fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_puntuaciones_jugador FOREIGN KEY (jugador_id) REFERENCES jugadores(id) ON DELETE CASCADE,
  CONSTRAINT fk_puntuaciones_juegos FOREIGN KEY (juego_id) REFERENCES juegos(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO juegos (codigo, nombre) VALUES
('pong', 'Pong'),
('tres_en_raya', 'Tres en raya'),
('dobles_parejas', 'Dobles parejas')
ON DUPLICATE KEY UPDATE nombre = VALUES(nombre);
