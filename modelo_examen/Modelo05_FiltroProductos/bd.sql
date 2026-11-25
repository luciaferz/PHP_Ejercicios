CREATE DATABASE IF NOT EXISTS examen_catalogo; USE examen_catalogo;
CREATE TABLE productos(id INT AUTO_INCREMENT PRIMARY KEY,nombre VARCHAR(60),categoria VARCHAR(40),precio DECIMAL(8,2));
INSERT INTO productos(nombre,categoria,precio) VALUES('Agenda','papeleria',8.50),('Mochila','accesorios',22),('Bolígrafo','papeleria',1.20),('Botella','accesorios',12);
