<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Ingrseso Producto</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<h3>Pruducto</h3>

<form method="post" action="../Vista/usuarios/accion/bajausuario.php">
       <h3>Usuario Informacion</h3>
                <div style="margin-bottom:10px">            
                <input name="idusuario" id="idusuario"  class="easyui-textbox" value="8" label="Nombre:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                <input  name="uspass" id="uspass"  class="easyui-textbox" label="Descripcion:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                <input  name="usmail" id="usmail"  class="easyui-textbox"  label="e-mail:" style="width:100%">                 
                </div>
                 <div style="margin-bottom:10px">
                <input  name="usdeshabilitado" id="usdeshabilitado" type="hidden" class="easyui-textbox"  label="usdeshabilitado" style="width:100%">                 
                </div>
<br><input id="accion" name ="accion" value="nuevo" type="hidden">
<input type="submit" value='Ingresar'>
</form>
<br><br>
<a href="../menuProductos.php">Volver</a>
</body>
</html>