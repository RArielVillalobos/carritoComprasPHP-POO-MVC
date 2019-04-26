<?php

include_once '../../../configuracion.php';


$carrito=new Carrito();

$resp = false;
if($carrito->terminarCompra()){

    $resp = true;

}

header('Location: ../../principal/principal.php')
?>
