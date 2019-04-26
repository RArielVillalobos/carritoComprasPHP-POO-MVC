<?php

include_once '../../../configuracion.php';

if(!empty($_GET['idcompra'])){
    $id=$_GET['idcompra'];




}
?>



<form method="get" action="../compras/admin/cancelaCompra.php">
    <input type="hidden" name="idcompra" id="idcompra" value="<?php echo $id;?>">



    <div class="modal-footer">
        <button type="submit"  class="btn btn-danger">Cancelar</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
    </div>

</form>
