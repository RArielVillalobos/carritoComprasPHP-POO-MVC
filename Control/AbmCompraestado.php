<?php 
class AbmCompraestado{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object Compraestado
     */
    
    public function cargarObjeto($param){
        
        $objCompraestado = null;
        $objCompra = null;
        $objCompraestadotipo = null;
        
        if( array_key_exists('idcompraestado',$param) and $param['idcompraestado']!=null ){

            $objCompraestado = new Compraestado();
            $objCompraestado->setIdcompraestado($param['idcompraestado']);
            $objCompraestado->cargar();
            
        }
        
        if( array_key_exists('idcompra',$param) and $param['idcompra']!=null ){

            $objCompra = new Compra();
            $objCompra->setIdcompra($param['idcompra']);
            $objCompra->cargar();

            
        }
        
        if( array_key_exists('idcompraestadotipo',$param) and $param['idcompraestadotipo']!='null' ){
            $objCompraestadotipo = new Compraestadotipo();
            $objCompraestadotipo->setIdcompraestadotipo($param['idcompraestadotipo']);
            $objCompraestadotipo->cargar();

        }
        
        if( array_key_exists('cefechaini',$param) and array_key_exists('cefechafin',$param) and $param['cefechaini']!=null and $param['cefechafin']==null){

            if ($objCompraestado==null){
                $objCompraestado = new Compraestado();
                $objCompraestado->setear("", $objCompra,$objCompraestadotipo,$param['cefechaini'],$param['cefechafin']);
                $objCompraestado->setCefechafin(null);


                /*verEstructura($objCompraestado);
                die();*/
            }            
        }
        return $objCompraestado;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object Compraestado
     */
    private function cargarObjetoConClave($param){
        $objCompraestado = null;
        
        if( isset($param['idcompraestado']) ){
            $objCompraestado = new Compraestado();
            $objCompraestado->setear($param['idcomprestado'], null, null, "","");
        }
        return $objCompraestado;
    }
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraestado']))
            $resp = true;
            return $resp;
    }
    
    /**
     * Permite cargar objeto
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $param['idcompraestado'] =null;
        $elObjtCompraestado = $this->cargarObjeto($param);
        if ($elObjtCompraestado!=null and $elObjtCompraestado->insertar()){
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
            $elObjtCompraestado = $this->cargarObjetoConClave($param);
            if ($elObjtCompraestado!=null and $elObjtCompraestado->eliminar()){
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
            $elObjtCompraestado = $this->cargarObjeto($param);
            if($elObjtCompraestado!=null and $elObjtCompraestado->modificar()){
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
       // verEstructura($param);
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idcompraestado']))
                $where.=" and idcompraestado =".$param['idcompraestado'];
            if  (isset($param['idcompra']))
                $where.=" and idcompra =".$param['idcompra'];
            if  (isset($param['idcompraestadotipo']))
                $where.=" and idcompraestadotipo =".$param['idcompraestadotipo'];
            if  (isset($param['cefechaini']))
                $where.=" and cefechaini =".$param['cefechaini'];
            if  (isset($param['cefechafin']))
                $where.=" and cefechafin =".$param['cefechafin'];
        }
        $arreglo = Compraestado::listar($where);
        return $arreglo;
    }
}
?>