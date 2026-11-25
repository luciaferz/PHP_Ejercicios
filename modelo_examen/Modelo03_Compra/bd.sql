CREATE DATABASE IF NOT EXISTS examen_material; USE examen_material;
CREATE TABLE empleados(codigo INT PRIMARY KEY,nombre VARCHAR(60),clave VARCHAR(30),limite DECIMAL(8,2));
CREATE TABLE materiales(codigo INT PRIMARY KEY,nombre VARCHAR(60),precio DECIMAL(8,2));
CREATE TABLE pedidos(id INT AUTO_INCREMENT PRIMARY KEY,codigo_empleado INT,codigo_material INT,precio DECIMAL(8,2));
INSERT INTO empleados VALUES(1,'Eva','1234',100),(2,'Leo','abcd',20);
INSERT INTO materiales VALUES(10,'Teclado',35),(11,'Pantalla',180),(12,'Ratón',12);
