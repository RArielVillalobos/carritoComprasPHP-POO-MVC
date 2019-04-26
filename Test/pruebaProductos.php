<?php
include_once '../configuracion.php';
$objProducto = new AbmProducto();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Ingrseso Producto</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<h3>Pruducto</h3>

<form method="post" action="../Vista/productos/accion/altaproducto.php">
    <div style="margin-bottom:10px">
    Nombre          
                <input name="pronombre" id="pronombre"  class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                Detalle
                <input  name="prodetalle" id="prodetalle"  class="easyui-textbox" label="Descripcion:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                Stock
                <input  name="procantstock" id="procantstock"  class="easyui-textbox" required="true" label="Stock:" style="width:100%">                 
                </div>
                <div style="margin-bottom:10px">
                Importe
                <input name="proimporte" value="proimporte" class="easyui-textbox" required="true" label="Importe:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                Imagen
                <input name="proimagen" value="proimagen" class="easyui-textbox" label="Ruta imagen:" style="width:100%">
                </div>
<br><input id="accion" name ="accion" value="nuevo" type="hidden">
<input type="submit" value='Ingresar'>
</form>
<br><br>
<a href="../menuProductos.php">Volver</a>
</body>
</html>