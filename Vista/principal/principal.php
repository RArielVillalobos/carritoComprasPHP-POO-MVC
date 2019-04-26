
<?php

include_once "../../configuracion.php";

$producto=new AbmProducto();
$productos=$producto->buscar(null);



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
    <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Lo mejor en Tecnologia</h1>
        <p class="lead font-weight-normal">Los mejores precios de la patagonia</p>

    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>


<div class="container mt-3">
    <div class="row">


    <?php
     foreach ($productos as $producto){
         if($producto->getProcantstock()>0){
             ?>
        <div class="card-deck">
            <div class="card mb-4" style="min-width: 18rem; max-width: 18rem;">
                <img class="card-img-top" src="<?php echo  ($imagen= $producto->getproImagen()) ? $producto->getproImagen(): 'https://placehold.it/280x140/abc'?>?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $producto->getproNombre();?></h5>
                    <p class="card-text"><?php echo $producto->getProdetalle();?></p>
                    <p class="card-text"><strong> $ <?php echo $producto->getProimporte();?></p></strong>


                    <button data-id="<?php echo $producto->getIdproducto();?>"  class="btn btn-info btn-sm comprar">Comprar</button>


                </div>
            </div>

        </div>
        <?php
         }

         ?>


        <?php
     }
     ?>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalcomprar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Producto Al Carrito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>



<?php

include_once '../estructura/pie.php';


?>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->



<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
    });
</script>
<script src="../js/modal.js"></script>
<script src="../js/total.js"></script>
</body>
</html>