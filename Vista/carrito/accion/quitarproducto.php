<?php

include_once '../../../configuracion.php';
$data=data_submitted();

$carrito=new Carrito();
$carrito->quitarProducto($data);
//header('Location: ../carrito.php');

?>