<?php
require_once '../../../configuracion.php';
$idCompra=$_GET['idcompra'];

$abmCompra=new AbmCompra();
$compras=$abmCompra->buscar(['idcompra'=>$idCompra]);
$compra=$compras[0];


$compraEstado=new AbmCompraestado();
$param=['idcompra'=>$idCompra];
$arregloCompraEstadoDeLaCompra=$compraEstado->buscar($param);


$param=['idcompra'=>$idCompra];

$abmCompraItem=new AbmCompraitem();


$coleccionCompra=$abmCompraItem->buscar($param);

?>
<?php
require '../../../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
try{
    ob_start();
    require_once 'vista.php';
    $html=ob_get_clean();
    $html2pdf = new Html2Pdf('P','A4','en', false, 'UTF-8');
    //$html2pdf->setDefaultFont('Arial');

    $html2pdf->writeHTML($html);
    $html2pdf->output('Detalle Compra '.$idCompra.'.pdf', 'D');
}catch (Html2PdfException $e){
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}

