<?php 
include_once "../../../configuracion.php";
$data = data_submitted();

if (isset($data['menombre'])){
        $objC = new AbmMenu();
        $respuesta = $objC->alta($data);
        if (!$respuesta){
            $mensaje = " La accion  ALTA No pudo concretarse";
        }
}

if (isset($mensaje)){
    
    $respuesta['errorMsg']=$mensaje;
    echo json_encode($respuesta);
}
?>