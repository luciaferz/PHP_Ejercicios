CREATE DATABASE IF NOT EXISTS modelo_pedidos; USE modelo_pedidos;
CREATE TABLE clientes(id INT PRIMARY KEY,nombre VARCHAR(60));
CREATE TABLE pedidos(id INT AUTO_INCREMENT PRIMARY KEY,cliente_id INT,producto VARCHAR(60),importe DECIMAL(8,2),estado VARCHAR(20),FOREIGN KEY(cliente_id) REFERENCES clientes(id));
INSERT INTO clientes VALUES(1,'Clara'),(2,'Diego');
INSERT INTO pedidos(cliente_id,producto,importe,estado) VALUES(1,'Agenda',12.50,'pendiente'),(1,'Mochila',35,'enviado'),(2,'Libro',20,'pendiente');
