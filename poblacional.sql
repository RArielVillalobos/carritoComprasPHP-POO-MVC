INSERT INTO `usuario` (`idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'ariel.villalobos96@gmail.com', NULL),
(2, 'ariel', '81dc9bdb52d04dc20036dbd8313ed055', 'ariel@gmail.com', NULL),
(3, 'wachi', '8f14aa806d987309218eaf28ba304c3f', 'wachu@gmail.com', NULL);

INSERT INTO `rol` (`idrol`, `rodescripcion`) VALUES
(1, 'administrador'),
(2, 'cliente');

INSERT INTO `usuariorol` (`idusuario`, `idrol`) VALUES
(1, 1),
(2, 2);

INSERT INTO `menu` (`idmenu`, `menombre`, `medescripcion`, `idpadre`, `medeshabilitado`) VALUES
(1, 'carrito', 'para carrito', NULL, '0000-00-00 00:00:00'),
(2, 'productos', 'para gestion de productos', NULL, '0000-00-00 00:00:00'),
(3, 'abmProducto', '', 2, '0000-00-00 00:00:00'),
(4, 'compras', 'panel para compras', NULL, '0000-00-00 00:00:00'),
(5, 'usuarios', '', NULL, '0000-00-00 00:00:00'),
(6, 'abmUsuario', '', 5, '0000-00-00 00:00:00'),
(7, 'abmRol', '', 5, '0000-00-00 00:00:00');

INSERT INTO `menurol` (`idmenu`, `idrol`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1);

INSERT INTO `producto` (`idproducto`, `pronombre`, `prodetalle`, `procantstock`, `proimporte`, `proimagen`) VALUES
(1, 'Cable SATA Datos', 'Cable adaptador de SATA power a 4 pines. Alimentacion de Fuente a Disco Rigido o Lectograbadora.', 10, 57, '/programacionwebdinamica/proyectofinal/Imagenes/cablesatadatos00.jpg'),
(2, 'Cable USB A/B 2.0 1Mts', 'Cable USB 2.0 color azul para impresora 1Mts Intco', 5, 65, '/programacionwebdinamica/proyectofinal/Imagenes/cableusbab2.jpg'),
(3, 'Extension USB 2.0 60cm', 'Cable extensión USB 0.60 Mts Nisuta', 5, 78, '/programacionwebdinamica/proyectofinal/Imagenes/extensionusb2.jpg'),
(4, 'Anbyte HDMI 1.8Mts', 'Cable HDMI a HDMI Anbyte 1.8Mts', 1, 129, '/programacionwebdinamica/proyectofinal/Imagenes/cablehdmi.jpg'),
(5, 'Verbatim Multimedia', 'Teclado Verbatim multimedia con nueve teclas de acceso directo', 15, 329, '/programacionwebdinamica/proyectofinal/Imagenes/verbatimmultimedia.jpg');


INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');

