CREATE DATABASE IF NOT EXISTS examen_talleres; USE examen_talleres;
CREATE TABLE talleres(id INT PRIMARY KEY,nombre VARCHAR(60),plazas INT);
CREATE TABLE reservas(id INT AUTO_INCREMENT PRIMARY KEY,taller_id INT,alumno VARCHAR(60));
INSERT INTO talleres VALUES(1,'PHP inicial',2),(2,'Bases de datos',0),(3,'Formularios',5);
