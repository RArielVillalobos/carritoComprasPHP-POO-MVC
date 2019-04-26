<?php 
class Compraitem{
    
    private $idcompraitem;
    private $objProducto;
    private $objCompra;
    private $cicantidad;
    private $importe;
    private $mensajeoperacion;
    
    public function __construct(){
        $this -> idcompraitem="";
        $this -> objProducto=NULL;
        $this -> objCompra=NULL;
        $this -> cicantidad="";
        $this -> importe="";
        $this -> mensajeoperacion="";
    }
    
    // Metodos de acceso GET
    
    public function getIdcompraitem()
    {
        return $this->idcompraitem;
    }

    public function getObjProducto()
    {
        return $this->objProducto;
    }

    public function getObjCompra()
    {
        return $this->objCompra;
    }

    public function getCicantidad()
    {
        return $this->cicantidad;
    }

    public function getImporte()
    {
        return $this->importe;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    // Metodos de acceso SET
    
    
    public function setIdcompraitem($idcompraitem)
    {
        $this->idcompraitem = $idcompraitem;
    }

    public function setObjProducto($objProducto)
    {
        $this->objProducto = $objProducto;
    }

    public function setObjCompra($objCompra)
    {
        $this->objCompra = $objCompra;
    }

    public function setCicantidad($cicantidad)
    {
        $this->cicantidad = $cicantidad;
    }

    public function setImporte($importe)
    {
        $this->importe = $importe;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idcompraitem, $objProducto, $objCompra, $cicantidad, $importe){
        $this -> idcompraitem=$idcompraitem;
        $this -> objProducto=$objProducto;
        $this -> objCompra=$objCompra;
        $this -> cicantidad=$cicantidad;
        $this -> importe=$importe;
    }
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem WHERE idcompraitem = ".$this->getIdcompraitem();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $objProducto =NULL;
                    $objCompra=NULL;
                    $row = $base->Registro();
                    if($row['idproducto']!=null){
                        $objProducto = new Producto();
                        $objProducto->setIdproducto($row['idproducto']);
                        $objProducto->cargar();
                    }
                    if($row['idcompra']!=null){
                        $objCompra = new Compra();
                        $objCompra->setIdcompra($row['idcompra']);
                        $objCompra->cargar();
                    }
                    $this->setear($row['idcompraitem'], $objProducto, $objCompra, $row['cicantidad'], $row['importe']);
                }
            }
        } else {
            $this->setmensajeoperacion("Compraitem->listar: ".$base->getError());
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraitem(idproducto, idcompra, cicantidad, importe)VALUES(".$this->getObjProducto()->getIdproducto().",".$this->getObjCompra()->getIdcompra().",".$this -> getCicantidad().",".$this -> getImporte().");";

        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdcompraitem($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compraitem->insertar: ".$base->getError()[2]);
            }
        } else {
            $this->setmensajeoperacion("Compraitem->insertar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE compraitem SET idproducto=".$this->getObjProducto()->getIdproducto().",idcompra=".$this->getObjCompra()->getIdcompra().", cicantidad=".$this -> getCicantidad().", importe=".$this -> getImporte()." WHERE idcompraitem=".$this->getIdcompraitem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compraitem->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraitem->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraitem WHERE idcompraitem =".$this->getIdcompraitem();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compraitem->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraitem->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $objProducto=NULL;
                    $objCompra=NULL;
                    if($row['idproducto']!=null){
                        $objProducto = new Producto();
                        $objProducto->setIdproducto($row['idproducto']);
                        $objProducto->cargar();
                    }
                    if($row['idcompra']!=null){
                        $objCompra = new Compra();
                        $objCompra->setIdcompra($row['idcompra']);
                        $objCompra->cargar();
                    }
                    $obj= new Compraitem();
                    $obj->setear($row['idcompraitem'], $objProducto, $objCompra, $row['cicantidad'], $row['importe']);
                    array_push($arreglo, $obj);
                }
            }
        }else{
            // $this->setmensajeoperacion("Compra->listar: ".$base->getError());
        }
        return $arreglo;
    }
    
}?>