
<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_header>

        <img src="https://orienten.me/media/institution/thumbnails/logo-universidad-nacional-del-comahue_lsmQ1D6.jpg.180x180_q70_crop.jpg" style="width: 100px; float: right">
        Numero Compra: <?php echo $idCompra;?>
        <br>
        Nombre Usuario Comprador: <?php echo $compra->getObjUsuario()->getUsnombre(); ?>
        <br>
        Fecha Compra: <?php echo $compra->getCofecha();?>
    </page_header>
    <br>
    <br>
    <br>
    <br>
    <br>

    <p style="margin-left: 280px;" >Historial Estados de la Compra</p>

    <table style="width: 100%; border: 1px solid #000; margin-left: 100px;">
        <tr style="border: 1px solid grey">
            <th  style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;">Descripcion</th>
            <th style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;">Fecha Inicio Estado</th>
            <th style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;">Fecha Fin Estado</th>

        </tr>
        <tbody>
        <?php
        foreach($arregloCompraEstadoDeLaCompra as $arreglo){
            ?>
            <tr>
                <td style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;"><?php echo $arreglo->getObjCompraestadotipo()->getCetdescripcion(); ?></td>
                <td style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;"><?php echo $arreglo->getCefechaini(); ?></td>
                <td style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;"><?php echo $arreglo->getCefechafin(); ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <br>



    <p style="margin-left: 300px;" >Articulos Pedidos</p>

    <table style="width: 100%; border: 1px solid #000;" >

        <tr style="border: 1px solid grey">
            <th  style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;">Nombre Producto</th>
            <th style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;">Precio</th>
            <th style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;">Cantidad</th>
            <th style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;">Subtotal</th>

        </tr>
        <tbody>
        <?php
        foreach($coleccionCompra as $arreglo){
            ?>
            <tr>
                <td style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;"><?php echo $arreglo->getObjProducto()->getPronombre(); ?></td>
                <td style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;"><?php echo '$ '. $arreglo->getObjProducto()->getProimporte(); ?></td>
                <td style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;"><?php echo $arreglo->getCicantidad(); ?></td>
                <td style="width: 25%;text-align: left;vertical-align: top;border: 1px solid #000;border-spacing: 0;"><?php echo '$ '. $arreglo->getImporte() ?></td>

            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <page_footer>
        Contenido Footer
    </page_footer>
</page>
