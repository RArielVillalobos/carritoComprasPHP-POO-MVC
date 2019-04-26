<?php 
class AbmProducto{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object Producto
     */
    private function cargarObjeto($param){
        $objProducto = null;

        if( array_key_exists('idproducto',$param) and array_key_exists('pronombre',$param) and array_key_exists('procantstock',$param) and array_key_exists('proimporte',$param)){
            $objProducto = new Producto();

            $objProducto->setear($param['idproducto'], $param['pronombre'], $param['prodetalle'], $param['procantstock'],$param['proimporte'],$param['proimagen']);
        }
        return $objProducto;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object Producto
     */
    public function cargarObjetoConClave($param){
        $objProducto = null;
        
        if( isset($param['idproducto']) ){
            $objProducto = new Producto();
            //$objProducto->setear($param['idproducto'], "", "", "", "");
            $objProducto->setIdproducto($param['idproducto']);
           // $objProducto->cargar();
        }
        return $objProducto;
    }
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idproducto']))
            $resp = true;
            return $resp;
    }
    
    /**
     * Permite crear un objeto
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $param['idproducto']=null;
        $elObjtProducto = $this->cargarObjeto($param);
        if ($elObjtProducto!=null and $elObjtProducto->insertar()){
            if ($_FILES['miArchivo'] != null){
                $listaProd = array();
                $listaProd = $this -> buscar($param);
                $cant = count($listaProd);
                $prod = $listaProd[$cant - 1];
                $param['idproducto'] = $prod -> getIdproducto();
                $nombreProd = $prod -> getIdproducto().".jpg";
                $pudeSubirArchivo = subirArchivo($param,$nombreProd);

                if($pudeSubirArchivo) {
                    $param['proimagen'] = "/programacionwebdinamica/proyectofinal/Imagenes/" . $nombreProd;
                    $prod = $this -> modificacion($param);

                }
            }
            $resp = true;
        }
        return $resp;
    }
    
    /**
     * Permite eliminar un objeto
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtProducto = $this->cargarObjetoConClave($param);
            if ($elObjtProducto!=null and $elObjtProducto->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtProducto = $this->cargarObjeto($param);
            if($elObjtProducto!=null and $elObjtProducto->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idproducto']))
                $where.=" and idproducto =".$param['idproducto'];
            if  (isset($param['pronombre']))
                $where.=" and pronombre ='".$param['pronombre']."'";
            if  (isset($param['prodetalle']))
                $where.=" and prodetalle ='".$param['prodetalle']."'";
            if  (isset($param['procantstock']))
                $where.=" and procantstock =".$param['procantstock'];
            if  (isset($param['proimporte']))
                $where.=" and proimporte =".$param['proimporte'];
            if  (isset($param['proimagen']))
                $where.=" and proimagen ='".$param['proimagen']."'";
        }
        $arreglo = Producto::listar($where);
        return $arreglo;      
    }
    
}
?>