<?php 
class Compraestado{

    private $idcompraestado;
    private $objCompra;
    private $objCompraestadotipo;
    private $cefechaini;
    private $cefechafin;
    private $mensajeoperacion;
    
    public function __construct(){
        $this -> idcompraestado="";
        $this -> objCompra=NULL;
        $this -> objCompraestadotipo=NULL;
        $this -> cefechaini="";
        $this -> cefechafin=null;
        $this -> mensajeoperacion="";
    }
    
    // Metodo de acceso GET
    
    public function getIdcompraestado()
    {
        return $this->idcompraestado;
    }

    public function getObjCompra()
    {
        return $this->objCompra;
    }

    public function getObjCompraestadotipo()
    {
        return $this->objCompraestadotipo;
    }

    public function getCefechaini()
    {
        return $this->cefechaini;
    }

    public function getCefechafin()
    {
        return $this->cefechafin;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    // Metodos de acceso SET
    
    public function setIdcompraestado($idcompraestado)
    {
        $this->idcompraestado = $idcompraestado;
    }

    public function setObjCompra($objCompra)
    {
        $this->objCompra = $objCompra;
    }

    public function setObjCompraestadotipo($objCompraestadotipo)
    {
        $this->objCompraestadotipo = $objCompraestadotipo;
    }

    public function setCefechaini($cefechaini)
    {
        $this->cefechaini = $cefechaini;
    }

    public function setCefechafin($cefechafin)
    {
        $this->cefechafin = $cefechafin;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idcompaestado, $objCompra, $objCompraestadotipo, $cefechaini, $cefechafin){
        $this -> idcompraestado=$idcompaestado;
        $this -> objCompra=$objCompra;
        $this -> objCompraestadotipo=$objCompraestadotipo;
        $this -> cefechaini=$cefechaini;
        $this -> cefechafin=$cefechafin;
    }
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestado WHERE idcompraestado = ".$this->getIdcompraestado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $objCompra=NULL;
                    $objCompraestadotipo=NULL;
                    $row = $base->Registro();
                    if($row['idcompra']!=null){
                        $objCompra = new Compra();
                        $objCompra->setIdcompra($row['idcompra']);
                        $objCompra->cargar();
                    }
                    if($row['idcompraestadotipo']!=null){
                        $objCompraestadotipo = new Compraestadotipo();
                        $objCompraestadotipo->setIdcompraestadotipo($row['idcompraestadotipo']);
                        $objCompraestadotipo->cargar();
                    }
                    $this->setear($row['idcompraestado'], $objCompra, $objCompraestadotipo, $row['cefechaini'], $row['cefechafin']);
                }
            }
        } else {
            $this->setmensajeoperacion("Compraestado->listar: ".$base->getError());
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();

        $sql="INSERT INTO compraestado(idcompra, idcompraestadotipo, cefechaini, cefechafin)VALUES(".$this->getObjCompra()->getIdcompra().",".$this->getObjCompraestadotipo()->getIdcompraestadotipo().",'".$this -> getCefechaini()."','".$this -> getCefechafin()."');";





        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdcompraestado($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compraestado->insertar: ".$base->getError()[2]);
            }
        } else {
            $this->setmensajeoperacion("Compraestado->insertar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE compraestado SET idcompra=".$this->getObjCompra()->getIdcompra().",idcompraestadotipo=".$this->getObjCompraestadotipo()->getIdcompraestadotipo().", cefechaini='".$this -> getCefechaini()."', cefechafin='".$this -> getCefechafin()."' WHERE idcompraestado=".$this->getIdcompraestado().';';

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compraestado->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraestado->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraestado WHERE idcompraestado =".$this->getIdcompraestado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Compraestado->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Compraestado->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestado ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;


        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){                    
                    $objCompra=NULL;
                    $objCompraestadotipo=NULL;
                    if($row['idcompra']!=null){
                        $objCompra = new Compra();
                        $objCompra->setIdcompra($row['idcompra']);
                        $objCompra->cargar();
                    }
                    if($row['idcompraestadotipo']!=null){
                        $objCompraestadotipo = new Compraestadotipo();
                        $objCompraestadotipo->setIdcompraestadotipo($row['idcompraestadotipo']);
                        $objCompraestadotipo->cargar();
                    }
                    $obj= new Compraestado();
                    $obj->setear($row['idcompraestado'], $objCompra, $objCompraestadotipo, $row['cefechaini'], $row['cefechafin']);
                    array_push($arreglo, $obj);
                }
            }
        }else{
            // $this->setmensajeoperacion("Compra->listar: ".$base->getError());
        }
        return $arreglo;
    }
}?>