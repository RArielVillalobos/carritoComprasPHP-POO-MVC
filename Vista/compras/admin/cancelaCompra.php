<?php

include_once '../../../configuracion.php';
$idCompra=$_GET['idcompra'];


$admin=new Admin();
if($admin->cancelarCompra($idCompra)){
    header('Location: ../compras.php');
}else{
    echo "hubo un error";
}