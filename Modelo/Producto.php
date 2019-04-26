<?php
class Producto{
    
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
    private $proimporte;
    private $proimagen;
    private $mensajeoperacion;
    
    public function __construct(){
        $this -> idproducto="";
        $this -> pronombre="";
        $this -> prodetalle="";
        $this -> procantstock="";
        $this -> proimporte="";
        $this -> proimagen="";
        $this -> mensajeoperacion="";
    }
    
    // Metodos de acceso GET
    
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    public function getPronombre()
    {
        return $this->pronombre;
    }

    public function getProdetalle()
    {
        return $this->prodetalle;
    }

    public function getProcantstock()
    {
        return $this->procantstock;
    }

    public function getProimporte()
    {
        return $this->proimporte;
    }

    public function getProimagen()
    {
        return $this->proimagen;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    // Metodos de acceso SET
    
    public function setIdproducto($idproducto)
    {
        $this->idproducto = $idproducto;
    }

    public function setPronombre($pronombre)
    {
        $this->pronombre = $pronombre;
    }

    public function setProdetalle($prodetalle)
    {
        $this->prodetalle = $prodetalle;
    }

    public function setProcantstock($procantstock)
    {
        $this->procantstock = $procantstock;
    }

    public function setProimporte($proimporte)
    {
        $this->proimporte = $proimporte;
    }

    public function setProimagen($proimagen)
    {
        $this->proimagen = $proimagen;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setear($idproducto, $pronombre, $prodetalle, $procantstock, $proimporte, $proimagen){
        $this -> idproducto=$idproducto;
        $this -> pronombre=$pronombre;
        $this -> prodetalle=$prodetalle;
        $this -> procantstock=$procantstock;
        $this -> proimporte=$proimporte;
        $this -> proimagen=$proimagen;
    }
    
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM producto WHERE idproducto = ".$this->getIdproducto();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['proimporte'], $row['proimagen']);                    
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->cargar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO producto(pronombre, prodetalle, procantstock, proimporte, proimagen)  VALUES('".$this -> getPronombre()."','".$this -> getProdetalle()."','".$this -> getProcantstock()."','".$this -> getProimporte()."','".$this -> getProimagen()."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdproducto($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->insertar: ".$base->getError()[2]);
            }
        } else {
            $this->setmensajeoperacion("Producto->insertar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE producto SET pronombre='".$this->getPronombre()."', prodetalle='".$this -> getProdetalle()."', procantstock=".$this -> getProcantstock().", proimporte=".$this -> getProimporte().", proimagen='".$this -> getProimagen()."' WHERE idproducto =".$this->getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setmensajeoperacion("Producto->modificar 1: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM producto WHERE idproducto =".$this -> getIdproducto();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM producto ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new Producto();
                    $obj->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock'], $row['proimporte'], $row['proimagen']);
                    array_push($arreglo, $obj);
                }              
            }         
        }        
        return $arreglo;
    }
}

?>