<?php 
class Compraestadotipo{
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object Compraestadotipo
     */
    private function cargarObjeto($param){
        $objCompraestadotipo = null;
        
        if( array_key_exists('idcompraestadotipo',$param) and array_key_exists('cetdescripcion',$param) and array_key_exists('cetdetalle',$param)){
            $objCompraestadotipo = new Compraestadotipo();
            $objCompraestadotipo->setear($param['idcompraestadotipo'], $param['cetdescripcion'],"", $param['cetdetalle']);
        }
        return $objCompraestadotipo;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object Compraestadotipo
     */
    private function cargarObjetoConClave($param){
        $objCompraestadotipo = null;
        
        if( isset($param['idcompraestadotipo']) ){
            $objCompraestadotipo = new Compraestadotipo();
            $objCompraestadotipo->setear($param['idcompraestadotipo'], "", "");
        }
        return $objCompraestadotipo;
    }
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraestadotipo']))
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
        $param['idcompraestadotipo'] =null;
        $elObjtCompraestadotipo = $this->cargarObjeto($param);
        if ($elObjtCompraestadotipo!=null and $elObjtCompraestadotipo->insertar()){
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
            $elObjtCompraestadotipo = $this->cargarObjetoConClave($param);
            if ($elObjtCompraestadotipo!=null and $elObjtCompraestadotipo->eliminar()){
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
            $elObjtCompraestadotipo = $this->cargarObjeto($param);
            if($elObjtCompraestadotipo!=null and $elObjtCompraestadotipo->modificar()){
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
            if  (isset($param['idcompraestadotipo']))
                $where.=" and idcompraestadotipo =".$param['idcompraestadotipo'];
            if  (isset($param['cetdescripcion']))
                $where.=" and cetdescripcion ='".$param['cetdescripcion']."'";
            if  (isset($param['cetdetalle']))
                $where.=" and cetdetalle ='".$param['cetdetalle']."'";
        }
        $arreglo = Compraestadotipo::listar($where);
        return $arreglo;
    }
}
?>