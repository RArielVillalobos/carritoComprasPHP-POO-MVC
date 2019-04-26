<?php 
include_once "../../../configuracion.php";
$data = data_submitted();
$objControl = new AbmProducto();
$list = $objControl->buscar($data);
$arreglo_salida =  array();
foreach ($list as $elem ){
    
    $nuevoElem['idproducto'] = $elem->getIdproducto();
    $nuevoElem["pronombre"]=$elem->getPronombre();
    $nuevoElem["prodetalle"]=$elem->getProdetalle();
    $nuevoElem["procantstock"]=$elem->getProcantstock();
    $nuevoElem["proimporte"]=$elem->getProimporte();
    $nuevoElem["proimagen"]=$elem->getProimagen();
    array_push($arreglo_salida,$nuevoElem);
}

echo json_encode($arreglo_salida,null,2);

?>