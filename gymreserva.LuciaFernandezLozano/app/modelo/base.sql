CREATE TABLE Socio (
codigo_socio INT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL,
contador_asistencias INT DEFAULT 0,
bloqueado INT DEFAULT 0
);
CREATE TABLE Clase (
codigo_clase INT PRIMARY KEY,
actividad VARCHAR(100) NOT NULL, -- Ej: 'Yoga', 'Spinning', 'Crossfit'
instalacion VARCHAR(100) NOT NULL, -- Sala o zona del gimnasio
precio_sesion DECIMAL(10,2) NOT NULL,
plazas_libres INT NOT NULL CHECK (plazas_libres >= 0)
);
INSERT INTO Socio (codigo_socio, nombre, contador_asistencias, bloqueado)
VALUES
(11, 'Lucas Silva', 6,0),
(22, 'Elena Martínez', 12,0),
(33, 'Marcos Jover', 4,0),
(55, 'Casino Cansino', 124,1);
INSERT INTO Clase (codigo_clase, actividad, instalacion, precio_sesion,
plazas_libres) VALUES
(101, 'Spinning', 'Sala A - Ciclismo', 12.00, 15),
(102, 'Yoga', 'Sala Zen', 18.50, 2),
(103, 'Crossfit', 'Box Exterior', 22.00, 0),
(104, 'Aerobic', 'Sala B - Multiusos', 10.00, 8),
(105, 'Zumba', 'Sala Fitness 1', 15.00, 5),
(106, 'Crossfit', 'Box Central', 25.00, 3),
(107, 'Chi Kung', 'Sala Zen', 14.00, 0);