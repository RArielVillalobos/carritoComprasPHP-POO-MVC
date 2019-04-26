<?php
include_once "../../configuracion.php";

$menu=new AbmMenu();
$arregloMenu=$menu->buscar(null);

$carrito=new Carrito();

$coleccionCompra=$carrito->obtenerArregloItemCompra();

$totalCompra=$carrito->totalCompra();



?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>PatagoniaIT</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../css/estilos.css" rel="stylesheet">
</head>

<body>

<?php
include_once '../estructura/encabezado.php';


?>



<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">

    <h3>Carrito de Compras</h3>
    <?php
      //if($coleccionCompra!=null){
        //  ?>
         <!--  <a class="btn btn-danger btn-sm" style="color: white " href="accion/vaciarcarrito.php">Vaciar Carrito</a> -->
    <?php

      //}
    ?>


    <br>
    <br>
   <table class="table table-hover table-sm">
       <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Quitar</th>
            </tr>
       </thead>
       <tbody>
               <?php
               if($coleccionCompra!=null){
                   foreach($coleccionCompra as $compra){



                       ?>
                       <tr>
                           <td><img src="<?php echo $compra->getObjProducto()->getProimagen();?>" width="70px"></td>
                           <td><?php echo $compra->getObjProducto()->getPronombre();?></td>
                           <td>$ <?php echo $compra->getObjProducto()->getProimporte();?></td>
                           <td><?php echo $compra->getCicantidad();?></td>
                           <td>$ <?php echo $compra->getImporte();?></td>
                           <td><a href="accion/quitarproducto.php?idcompraitem=<?php echo $compra->getIdcompraitem();?>" class="btn btn-danger btn-sm" style="color: white">Quitar</a></td>

                       </tr>
                       <?php
                   }

                   ?>
               <?php
               }
               ?>


       </tbody>


   </table>
    <strong><p style="font-size: 30px">Total: $ <?php echo $totalCompra;?></p></strong>


    <hr>

    <a class="btn btn-info" href="../principal/principal.php">Seguir Comprando</a>
    <?php
     if($coleccionCompra!=null){
         ?>
         <a class="btn btn-success" href="accion/finalizarcompra.php">Finalizar Compra</a>
    <?php
    }
    ?>


</div>

<?php

include_once '../estructura/pie.php';


?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
    });
</script>
</body>
</html>