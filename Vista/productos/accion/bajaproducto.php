<?php
include_once "../../../configuracion.php";
$data = data_submitted();

if (isset($data['idproducto'])){
    $objC = new AbmProducto();
    $respuesta = $objC->baja($data);
    if (!$respuesta){
        $mensaje = " La accion  ELIMINACION No pudo concretarse";
    }
}
$salida['respuesta'] = $respuesta;

if (isset($mensaje)){

    $salida['errorMsg']=$mensaje;
}
echo json_encode($salida);

?>