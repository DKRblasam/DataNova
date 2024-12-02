/* MYSQL_ADDON_HOST=bcobddenafaiocpas8fm-mysql.services.clever-cloud.com
MYSQL_ADDON_DB=bcobddenafaiocpas8fm
MYSQL_ADDON_USER=umil3ibxm0xtpsub
MYSQL_ADDON_PORT=3306
MYSQL_ADDON_PASSWORD=D0Gn0SaZRv2PwTcDeUtw
MYSQL_ADDON_URI=mysql://umil3ibxm0xtpsub:D0Gn0SaZRv2PwTcDeUtw@bcobddenafaiocpas8fm-mysql.services.clever-cloud.com:3306/bcobddenafaiocpas8fm
*/

-- Crear Base de Datos
CREATE DATABASE RestaurantManagementDB;
USE RestaurantManagementDB;

-- Tablas (estructura original)
CREATE TABLE RESTAURANTES (
    id_restaurante INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    direccion VARCHAR(200),
    o_h VARCHAR(100)
);

CREATE TABLE PLATOS (
    id_plato INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    precio DECIMAL(10,2),
    categoria VARCHAR(50)
);

CREATE TABLE RESTAURANTES_PLATOS (
    id_restaurante_plato INT PRIMARY KEY AUTO_INCREMENT,
    id_restaurante INT,
    id_plato INT,
    FOREIGN KEY (id_restaurante) REFERENCES RESTAURANTES(id_restaurante),
    FOREIGN KEY (id_plato) REFERENCES PLATOS(id_plato)
);

CREATE TABLE CLIENTES (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    correo VARCHAR(100),
    telefono VARCHAR(20)
);

CREATE TABLE RESERVAS (
    id_reserva INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    id_restaurante INT,
    fecha DATE,
    numero_personas INT,
    FOREIGN KEY (id_cliente) REFERENCES CLIENTES(id_cliente),
    FOREIGN KEY (id_restaurante) REFERENCES RESTAURANTES(id_restaurante)
);

-- Inserción de Restaurantes (30 restaurantes)
INSERT INTO RESTAURANTES (nombre, direccion, o_h) VALUES 
('La Parrilla', 'Av. Siempre Viva 123', 'Lun-Dom 12:00-23:00'),
('Sushi Nikkei', 'Calle Los Pinos 456', 'Mar-Sab 18:00-00:00'),
('Pizzería Napoli', 'Jiron Camaná 789', 'Lun-Dom 11:00-22:00'),
('Cevichería El Puerto', 'Malecón Balta 321', 'Mié-Dom 13:00-21:00'),
('Café Colonial', 'Plaza Mayor 654', 'Lun-Sab 07:00-20:00'),
('Restaurante Italia', 'Av. Italia 1001', 'Lun-Dom 12:00-23:30'),
('El Buen Gusto', 'Calle de la Amistad 420', 'Lun-Vie 10:00-20:00'),
('La Casa del Sabor', 'Callejón del Sol 118', 'Mar-Dom 12:00-22:00'),
('Café del Mar', 'Av. Costanera 789', 'Lun-Sab 08:00-22:00'),
('La Perla Negra', 'Playa Blanca 24', 'Mié-Dom 14:00-23:00'),
('Tacos El Rey', 'Calle de la Luna 222', 'Lun-Sáb 12:00-21:00'),
('Pescados del Caribe', 'Malecón de Miraflores 118', 'Mar-Dom 10:00-19:00'),
('Sabor a México', 'Av. México 555', 'Lun-Dom 11:00-22:00'),
('Restaurante Andino', 'Calle Machu Picchu 777', 'Lun-Dom 11:30-22:00'),
('La Bodega del Vino', 'Calle Vino 432', 'Lun-Sab 12:00-22:00'),
('Burgers & Fries', 'Av. Las Américas 124', 'Lun-Dom 12:00-21:00'),
('Sushi Mura', 'Calle 3 de Febrero 134', 'Mié-Sáb 18:00-00:00'),
('Café Barista', 'Plaza de la República 321', 'Lun-Vie 07:00-19:00'),
('La Casa del Chef', 'Av. Bolívar 567', 'Lun-Dom 10:00-22:00'),
('Restaurante Fusion', 'Calle Mariposa 411', 'Lun-Dom 11:00-23:00'),
('Sabor Peruano', 'Calle Puno 89', 'Lun-Dom 10:00-20:00'),
('Ristorante Bella Vita', 'Calle Toscana 500', 'Lun-Dom 12:00-23:00'),
('La Taberna del Arte', 'Calle de los Artistas 520', 'Lun-Sáb 14:00-00:00'),
('El Sazón de Mamá', 'Av. Comida 123', 'Lun-Dom 11:00-22:00'),
('Las Delicias de la Abuela', 'Calle Santa María 223', 'Lun-Vie 10:00-20:00'),
('Hamburguesas El Rey', 'Calle de las Estrellas 200', 'Mar-Sáb 12:00-22:00'),
('La Cocina de María', 'Av. El Chef 99', 'Lun-Dom 10:00-22:00'),
('Los Sabores del Mundo', 'Calle de la Cultura 311', 'Mar-Sáb 12:00-22:00'),
('La Trattoria', 'Plaza San Martín 101', 'Lun-Dom 12:00-23:00'),
('Restaurante de Autor', 'Paseo de los Chefs 250', 'Lun-Dom 12:00-23:00');

-- Inserción de Platos (30 platos)
INSERT INTO PLATOS (nombre, precio, categoria) VALUES
('Asado Argentino', 25.50, 'Carnes'),
('Salmón Teriyaki', 22.00, 'Pescados'),
('Pizza Margherita', 15.75, 'Pizzas'),
('Ceviche Mixto', 18.90, 'Mariscos'),
('Lomo Saltado', 16.50, 'Platos Peruanos'),
('Rollo California', 12.50, 'Sushi'),
('Pollo a la Brasa', 14.00, 'Aves'),
('Risotto de Champiñones', 17.25, 'Pastas'),
('Causa Limeña', 10.50, 'Entradas Peruanas'),
('Tiramisu', 8.75, 'Postres'),
('Cordero a la Menta', 30.00, 'Carnes'),
('Camarones al Ajillo', 23.00, 'Mariscos'),
('Pizza Cuatro Estaciones', 17.50, 'Pizzas'),
('Lasaña Bolognesa', 18.25, 'Pastas'),
('Sushi Roll Especial', 13.00, 'Sushi'),
('Pechuga de Pollo a la Parrilla', 16.75, 'Aves'),
('Mousse de Chocolate', 9.00, 'Postres'),
('Pescado a la Plancha', 20.50, 'Pescados'),
('Sopa de Mariscos', 14.75, 'Mariscos'),
('Fettuccine Alfredo', 16.25, 'Pastas'),
('Tacos de Carne Asada', 12.00, 'Entradas Mexicanas'),
('Churros con Chocolate', 7.50, 'Postres'),
('Pechuga de Pavo a la Naranja', 22.50, 'Aves'),
('Arroz Chaufa', 13.00, 'Platos Peruanos'),
('Sushi de Atún', 12.25, 'Sushi'),
('Pasta Carbonara', 17.50, 'Pastas'),
('Pollo en Salsa de Mostaza', 18.00, 'Aves'),
('Paella Valenciana', 28.00, 'Arroces'),
('Flan Casero', 6.50, 'Postres'),
('Pizza Hawaiana', 16.00, 'Pizzas');

-- Inserción de Restaurantes_Platos (asegurando referencias válidas)
INSERT INTO RESTAURANTES_PLATOS (id_restaurante, id_plato) SELECT 
    r.id_restaurante, 
    p.id_plato
FROM 
    RESTAURANTES r
CROSS JOIN 
    PLATOS p
WHERE 
    (r.id_restaurante <= 7 AND p.id_plato <= 17)
LIMIT 50;  -- Limitar para evitar duplicados

-- Inserción de Clientes 
INSERT INTO CLIENTES (nombre, correo, telefono) VALUES 
('Juan Pérez', 'juan.perez@email.com', '987654321'),
('María García', 'maria.garcia@email.com', '912345678'),
('Carlos Rodríguez', 'carlos.rodriguez@email.com', '965432187'),
('Ana Martínez', 'ana.martinez@email.com', '998877665'),
('Luis Sánchez', 'luis.sanchez@email.com', '944556677'),
('Elena Torres', 'elena.torres@email.com', '933224411'),
('Roberto Ramírez', 'roberto.ramirez@email.com', '977665544'),
('Sofía López', 'sofia.lopez@email.com', '911223344'),
('Diego Fernández', 'diego.fernandez@email.com', '900112233'),
('Valentina Morales', 'valentina.morales@email.com', '988776655');

-- Inserción de Reservas
INSERT INTO RESERVAS (id_cliente, id_restaurante, fecha, numero_personas) 
SELECT 
    c.id_cliente, 
    r.id_restaurante, 
    DATE_ADD('2024-03-15', INTERVAL (c.id_cliente - 1) DAY) AS fecha,
    (c.id_cliente % 5) + 2 AS numero_personas
FROM 
    CLIENTES c
CROSS JOIN 
    RESTAURANTES r
WHERE 
    c.id_cliente <= 10 AND r.id_restaurante <= 10
LIMIT 30; 