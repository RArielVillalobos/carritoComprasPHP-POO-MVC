<?php
include_once "../../../configuracion.php";
$data = data_submitted();
if (isset($data['idproducto'])){
    $objC = new AbmProducto();
    $respuesta = $objC->modificacion($data);
    
    if (!$respuesta){

        $mensaje = " La accion  MODIFICACION No pudo concretarse";
        
    }
    
}
$salida['respuesta'] = $respuesta;
if (isset($mensaje)){

    $salida['errorMsg']=$mensaje;
    
}
echo json_encode($salida);

?>