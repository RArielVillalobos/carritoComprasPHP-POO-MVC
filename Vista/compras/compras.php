<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../css/estilos.css" rel="stylesheet">
    <title>Compras</title>
</head>
<body>
<?php
include_once '../estructura/encabezado.php';
$admin=new Admin();
$compras=$admin->comprasPendientes();

?>
<div class="container">
    <table class="table table-hover table-striped">
        <thead>
        <th>ID compra</th>
        <th>Usuario</th>
        <th>Email Usuario</th>
        <th>Fecha Compra</th>
        <th>Estado</th>
        <th>Opciones</th>
        </thead>
        <tbody>
        <?php
            foreach($compras as $compra){
                $estadoCompra=$admin->verificaEstadoCompra($compra->getIdcompra());
                ?>
                <tr class="<?php if($estadoCompra==4){echo 'table-danger';} elseif ($estadoCompra==2){echo 'table-success';} ?>">

                    <td><?php echo $compra->getIdcompra();?></td>
                    <td><?php echo $compra->getObjUsuario()->getUsnombre();?></td>
                    <td><?php echo $compra->getObjUsuario()->getUsmail();?></td>
                    <td><?php echo $compra->getCofecha();?></td>
                    <td><?php echo $estadoCompra;?></td>

                    <?php

                    // si la compra ya fue cancelada
                     if($estadoCompra==4 or $estadoCompra==2){

                         ?>
                         <td><button class="btn btn-info btn-sm"><a style="color: white" href="../../Vista/principal/pdf/detalles.php?idcompra=<?php echo $compra->getIdcompra();?>">Detalles</a></button></td>
                    <?php

                     }if($admin->verificaEstadoCompra($compra->getIdcompra())==3 ){
                         ?>
                        <td><button class="btn btn-info btn-sm"><a style="color: white" href="../principal/pdf/detalles.php?idcompra=<?php echo $compra->getIdcompra();?>">Detalles</a></button></td>
                         <td><button class="btn btn-danger btn-sm" data-compracan="<?php echo $compra->getIdcompra();?>">Cancelar</button></td>
                         <td><button class="btn btn-success btn-sm" data-compraacep="<?php echo $compra->getIdcompra();?>">Aceptar</button></td>
                    <?php

                     }
                    ?>


                </tr>

        <?php
            }
        ?>
        </tbody>

    </table>
    <hr>
</div>
<div class="modal" tabindex="-1" role="dialog" id="cancelarcompra">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Desea Cancelar la compra?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="aceptarcompra">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Esta Seguro que desea aceptar la compra?</h5>
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
<script src="../js/admin.js"></script>
</body>
</html>