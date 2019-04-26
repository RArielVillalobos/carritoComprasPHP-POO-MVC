<?php 
class AbmCompra{
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object Compraitem
     */
    
    public function cargarObjeto($param){

        
        $objCompra=null;
        $objUsuario=null;
        
        if( array_key_exists('idcompra',$param) ){


            $objCompra = new Compra();
            $objCompra->setIdcompra($param['idcompra']);
            if($objCompra->cargar()==false){

                $objCompra=null;
            }


        }
        
        if( array_key_exists('idusuario',$param) and $param['idusuario']!=null ){
            $objUsuario = new Usuario();
            $objUsuario->setIdusuario($param['idusuario']);
            $objUsuario->cargar();


        }

        if( array_key_exists('cofecha',$param) and $param['cofecha']!=null){


            if ($objCompra==null){

                $objCompra=new Compra();



                $objCompra->setear($param['idcompra'], $param['cofecha'],$objUsuario);
            }
            
        }
        return $objCompra;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object Compraitem
     */
    private function cargarObjetoConClave($param){
        
        $objCompra = null;
        
        if( isset($param['idcompra']) and isset($param['idusuario'])){
            $objCompra = new Compra();
            $objCompra->setear($param['idcompraitem'], "",null);
        }
        return $objCompra;
    }
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompra']))
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
        $param['idcompra'] =null;
        $elObjtCompra = $this->cargarObjeto($param);
        //print_r($elObjtCompra);
        if ($elObjtCompra!=null and $elObjtCompra->insertar()){
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
            $elObjtCompra = $this->cargarObjetoConClave($param);
            if ($elObjtCompra!=null and $elObjtCompra->eliminar()){
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
            $elObjtCompra = $this->cargarObjeto($param);
            if($elObjtCompra!=null and $elObjtCompra->modificar()){
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
        //verEstructura($param);
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idcompra']))
                $where.=" and idcompra =".$param['idcompra'];
            if  (isset($param['cofecha']))
                $where.=" and cofecha =".$param['cofecha'];
            if  (isset($param['idusuario']))
                $where.=" and idusuario =".$param['idusuario'];
           }
        $arreglo = Compra::listar($where);
        return $arreglo;
    }
}
?>