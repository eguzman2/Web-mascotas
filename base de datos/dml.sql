-- Estados de mascotas
INSERT INTO `petstatus` (`id`, `name`) VALUES (NULL, 'Disponible'), (NULL, 'No disponible');

-- Mascotas
INSERT INTO `pet` (`id`, `name`, `race`, `size`, `status_id`, `description`, `observations`, `archived`) VALUES (NULL, 'Docky', 'Dalmata', 'Mediano', '1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu bibendum at varius vel pharetra. ', NULL, '0');
