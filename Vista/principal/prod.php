<?php

include_once '../../configuracion.php';

if(!empty($_GET['idproducto'])){
    $id=$_GET['idproducto'];

    $param=['idproducto'=>$id];

    $producto=new AbmProducto();

    $arregloProductos=$producto->buscar(['idproducto'=>$id]);
    $producto=$arregloProductos[0];


}
?>



<form method="get" action="../carrito/accion/agregarproductocarro.php">
    <input name="precio" id="precio" type="hidden" value="<?php echo $producto->getProimporte();?>">
    <input name="idproducto" id="idproducto" type="hidden" value="<?php echo $id;?>">
    <p style="font-size: 20px"><strong><?php echo $producto->getPronombre();?></strong></p>


    <span><?php echo $producto->getProdetalle();?></span>
    <br>
    <br>
    <img src="<?php echo $producto->getProimagen();?>" width="180px">
    <br>
    <br>
    <p style="font-size: 15px"><strong id="precio">Importe $ <?php echo $producto->getProimporte();?></strong></p>

    <div class="form-group">
        <label>Cantidad</label>
        <input type="number" name="cantidad" class="form-control" id="cantidad" min="1" max="<?php echo $producto -> getProcantstock() ?>">

    </div>





    <strong style="display: inline">Total: $</strong>
    <div id="total" style="display: inline;">

    </div>

    <div class="modal-footer">
        <button type="submit"  class="btn btn-info">Agregar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
    </div>

</form>




<script>

    $(document).ready(function() {

        $( "#cantidad" ).keyup(function() {
            var total=0;
            var precio=200;

            var precio=$('#precio').val();
            var cantidad=$('#cantidad').val();

            total+=cantidad*precio;
            //var cantidad=document.getElementById('cantidad').value;

            $('#total').html(total);




        });




    });


</script>
