CREATE DATABASE IF NOT EXISTS examen_viajes; USE examen_viajes;
CREATE TABLE trenes(codigo VARCHAR(10) PRIMARY KEY,destino VARCHAR(40),compania VARCHAR(40),precio DECIMAL(8,2),plazas_libres INT);
INSERT INTO trenes VALUES('RG101','Bilbao','RailGo',31.50,8),('RG102','Bilbao','NorteExpress',28.00,2),('RG103','Córdoba','RailGo',25.00,20);
