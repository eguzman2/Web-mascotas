-- Estados de mascotas
INSERT INTO `petstatus` (`id`, `name`) VALUES (NULL, 'Disponible'), (NULL, 'Adoptada'), (NULL, 'No disponible'), (NULL, 'Fallecida');

-- Mascotas
INSERT INTO `pet` (`id`, `name`, `race`, `size`, `status_id`, `description`, `observations`, `archived`) VALUES (NULL, 'Docky', 'Dalmata', 'Mediano', '1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu bibendum at varius vel pharetra. ', NULL, '0');

-- Tipos de producto
INSERT INTO `producttype` (`id`, `name`) VALUES (NULL, 'Alimento'), (NULL, 'Correas');

-- Productos
INSERT INTO `product` (`id`, `name`, `product_type_id`, `brand`, `observations`, `archived`) VALUES (NULL, 'Concentrado Dog Chow Adulto', '1', 'Dog Chow', 'Bolsa grande', '0'), (NULL, 'Correa roja', '2', '--', NULL, '0');

-- Inventario
INSERT INTO `inventory` (`id`, `product_id`, `quantity`, `status`, `observations`) VALUES (NULL, '1', '20', NULL, NULL);

-- Donacion
INSERT INTO `donation` (`id`, `product_id`, `status`, `quantity`, `timestamp_date`, `donor_name`) VALUES (NULL, '1', 'Nuevo', '2', current_timestamp(), 'Edgar');

-- Users
INSERT INTO `users` (`id`, `uname`, `upassword`) VALUES (1, 'admin', 'admin');