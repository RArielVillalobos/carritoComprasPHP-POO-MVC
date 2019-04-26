<?php 
class AbmCompraitem{
  
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object Compraitem
     */
    
    private function cargarObjeto($param){

        $objCompraitem = null;
        $objProducto = null;
        $objCompra = null;
        
        if( array_key_exists('idcompraitem',$param) and $param['idcompraitem']!=null ){
            $objCompraitem = new Compraitem();
            $objCompraitem->setIdcompraitem($param['idcompraitem']);
            $objCompraitem->cargar();
            
        }
        
        if( array_key_exists('idcompra',$param) and $param['idcompra']!=null ){
            $objCompra = new Compra();
            $objCompra->setIdcompra($param['idcompra']);
            $objCompra->cargar();

            
        }
        
        if( array_key_exists('idproducto',$param) and $param['idproducto']!='null' ){
            $objProducto = new Producto();
            $objProducto->setIdproducto($param['idproducto']);
            $objProducto->cargar();

        }
                
        if( array_key_exists('cicantidad',$param) and array_key_exists('importe',$param) and $param['cicantidad']!=null and $param['importe']!=null){

            if ($objCompraitem==null){


                $objCompraitem = new Compraitem();
                $objCompraitem->setear("", $objProducto,$objCompra,$param['cicantidad'],$param['importe']);

            }
                        
        }        
        return $objCompraitem;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return object Compraitem
     */
    private function cargarObjetoConClave($param){
        $objCompraitem = null;
        
        if( isset($param['idcompraitem']) ){
            $objCompraitem = new Compraitem();
            $objCompraitem->setear($param['idcompraitem'], null, null, "","");
        }
        return $objCompraitem;
    }
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraitem']))
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
        $param['idcompraitem'] =null;
        $elObjtCompraitem = $this->cargarObjeto($param);


        if ($elObjtCompraitem!=null and $elObjtCompraitem->insertar()){

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
            $elObjtCompraitem = $this->cargarObjetoConClave($param);
            if ($elObjtCompraitem!=null and $elObjtCompraitem->eliminar()){
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
            $elObjtCompraitem = $this->cargarObjeto($param);
            if($elObjtCompraitem!=null and $elObjtCompraitem->modificar()){
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
            if  (isset($param['idcompraitem']))
                $where.=" and idcompraitem =".$param['idcompraitem'];
            if  (isset($param['idproducto']))
                $where.=" and idproducto =".$param['idproducto'];
            if  (isset($param['idcompra']))
                $where.=" and idcompra =".$param['idcompra'];
            if  (isset($param['cicantidad']))
                $where.=" and cicantidad =".$param['cicantidad'];
            if  (isset($param['importe']))
                $where.=" and importe =".$param['importe'];
        }
        $arreglo = Compraitem::listar($where);
        return $arreglo;
    }
}
?>