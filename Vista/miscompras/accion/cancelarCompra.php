<?php




include_once '../../../configuracion.php';
$idCompra=$_GET['idcompra'];


$cliente=new Cliente();
if($cliente->cancelarCompra($idCompra)){
    header('Location: ../miscompras.php');
}else{
    echo "hubo un error";
}




?>