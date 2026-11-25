CREATE DATABASE IF NOT EXISTS examen_socios; USE examen_socios;
CREATE TABLE socios(login VARCHAR(20) PRIMARY KEY,nombre VARCHAR(60),password VARCHAR(100),comentario TEXT,saldo DECIMAL(8,2),bloqueo TINYINT);
INSERT INTO socios VALUES('ines','Inés','1234','Lectura',40,0),('raul','Raúl','abcd','Música',75,1),('noa','Noa','pass','Ciencia',20,0);
