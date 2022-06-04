CREATE TABLE `tables` (
  `id` int(50) NOT NULL,
  `client_id` varchar(50) DEFAULT NULL,
  `waiter_id` varchar(50) DEFAULT NULL,
  `table_status` varchar(50) DEFAULT NULL,
  `capacity` varchar(50) NOT NULL,
  `invoice` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tables` (`id`, `client_id`, `waiter_id`, `table_status`, `capacity`, `invoice`) VALUES
(1, '1', '1', 'ABONO LA CUENTA', '10', '8240'),
(2, '-', '-', 'DISPONIBLE', '8', '-'),
(3, '-', '-', 'DISPONIBLE', '8', '-'),
(4, '-', '-', 'DISPONIBLE', '4', '-'),
(5, '-', '-', 'DISPONIBLE', '4', '-'),
(6, '-', '-', 'DISPONIBLE', '2', '-'),
(7, '-', '-', 'DISPONIBLE', '2', '-'),
(8, '-', '-', 'DISPONIBLE', '2', '-'),
(9, '-', '-', 'DISPONIBLE', '2', '-'),
(10, '-', '-', 'DISPONIBLE', '2', '-'),
(11, '-', '-', 'DISPONIBLE', '2', '-');

CREATE TABLE `orders` (
  `id` int(50) NOT NULL,
  `table_id` varchar(50) NOT NULL,
  `client_id` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `sector` varchar(50) NOT NULL,
  `waitingTime` varchar(50) NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `orders` (`id`, `table_id`, `client_id`, `product_id`, `sector`, `waitingTime`, `order_status`) VALUES
(1, '1', '1', '1', 'BARTENDER', '15', 'MODIFICADO POR bartender'),
(2, '1', '1', '1', 'COCINERO', '15', 'MODIFICADO POR COCINERO'),
(3, '1', '1', '1', 'CERVECERO', '5', 'EN ESPERA'),
(9, '1', '15', '1', 'COCINA', '5', 'EN PREPARACION'),
(10, '1', '13', '1', 'COCINA', '5', 'EN PREPARACION'),
(11, '1', '14', '1', 'COCINA', '5', 'EN PREPARACION'),
(12, '1', '19', '1', 'COCINA', '5', 'EN PREPARACION');

CREATE TABLE `products` (
  `id` int(50) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `products` (`id`, `productName`, `price`, `product_type`, `active`) VALUES
(1, 'Milanesa a Caballo', 500, 'Plato Vegano', 'ACTIVO'),
(2, 'Milanesa de Pollo', 600, 'Plato Principal', 'ACTIVO'),
(3, 'Hamburguesa de Garbanzo', 1000, 'Plato Principal', 'ACTIVO'),
(4, 'Coca Cola', 120, 'Bebida', 'ACTIVO'),
(5, 'Pepsi', 120, 'Bebida', 'ACTIVO'),
(6, 'Cerveza Corona', 120, 'Bebida', 'ACTIVO'),
(7, 'Daikiri', 120, 'Bebida', 'ACTIVO'),
(8, 'Cerveza Brahma', 120, 'Bebida', 'ACTIVO'),
(9, 'Cerveza Quilmes', 120, 'Bebida', 'ACTIVO');

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `active` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `username`, `lastname`, `userPassword`, `user_type`, `active`, `email`) VALUES
(13, 'Carlos', 'Tevez', '$2y$10$hQkI4bn00zsDx7gxbp1bTOg8rKqHWnYY9Tk5RK/Gw0sz5awTPKJ1C', 'SOCIO', 'ACTIVO', 'socio@socio.com'),
(14, 'Juan', 'Perez', '$2y$10$d0zqgQjLxsvxFoFuq4MELO1WCl.gAU6lVuP8AFzmNdBHXrTcV9xiO', 'MOZO', 'ACTIVO', 'mozo@mozo.com'),
(15, 'Pepe', 'Peposo', '$2y$10$Y8KiEYg19hKwbn/AyiH6zuyCl6C2eQslxA7zTI0Yv.ZxOzgyXVbyK', 'COCINERO', 'DESCANSANDO', 'cocinero@cocinero.com'),
(16, 'Sterling', 'Yan', '$2y$10$Y8KiEYg19hKwbn/AyiH6zuyCl6C2eQslxA7zTI0Yv.ZxOzgyXVbyK', 'CERVECERO', 'ACTIVO', 'cervecero@cervecero.com'),
(17, 'Pier', 'Yan', '$2y$10$Y8KiEYg19hKwbn/AyiH6zuyCl6C2eQslxA7zTI0Yv.ZxOzgyXVbyK', 'BARTENDER', 'ACTIVO', 'bartender@bartender.com'),
(18, 'Jose', 'Aldo', '$2y$10$Y8KiEYg19hKwbn/AyiH6zuyCl6C2eQslxA7zTI0Yv.ZxOzgyXVbyK', 'CLIENTE', 'ACTIVO', 'cliente@cliente.com'),
(19, 'Jose', 'Gomez', '$2y$10$gflBSIHAC5of55RQbHolk.Bju98/.8/9gv0RIWEjSU1fqlNd/Z4uy', 'CLIENTE', 'ACTIVO', 'Pedro@gmail.com'),
(20, 'Nahuel', 'Perez', '$2y$10$d0zqgQjLxsvxFoFuq4MELO1WCl.gAU6lVuP8AFzmNdBHXrTcV9xiO', 'CLIENTE', 'ACTIVO', 'clientex@clientex.com'),
(21, 'Pablo', 'Perez', '$2y$10$d0zqgQjLxsvxFoFuq4MELO1WCl.gAU6lVuP8AFzmNdBHXrTcV9xiO', 'MOZO', 'ACTIVO', 'mozo1@mozo1.com');

ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tables`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `orders`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `products`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;
