<?php


class Carrito{


    public function verificaCompra(){
        $estado=false;
        $compra=new AbmCompra();

        $idUsuarioLogueado=$this->buscaUsuario();
        $comprasdelUsuario=$compra->buscar(['idusuario'=>$idUsuarioLogueado]);


        if(count($comprasdelUsuario)>=1){
            //obtener la ultima compra
            $totalCompras=count($comprasdelUsuario);

            $indice=$totalCompras-1;



            $idCompra=$comprasdelUsuario[$indice]->getIdcompra();


            $compraEstado=new AbmCompraestado();
            $objetoCompraEstado=$compraEstado->buscar(['idcompra'=>$idCompra]);

            $totalEstados=count($objetoCompraEstado);

            $indice=$totalEstados-1;

            $estadoCompra=$objetoCompraEstado[$indice]->getObjCompraestadotipo()->getIdcompraestadotipo();




            //la compra esta ene stado iniciado y esta pendiente
            if($estadoCompra==1){
                $estado=true;
            }
        }



        return $estado;

    }

    private function buscaUsuario(){
        $sesion=new Session();
        $validar=$sesion->validar();
        if($validar==false){
            header('Location: ../Vista/principal/login.php');


        }
        $objUsuario=$sesion->getUsuario();

        $idUsuarioLogueado=$objUsuario->getIdusuario();

        return $idUsuarioLogueado;

    }
    private function buscaUltimaCompraUsuario(){
        $objCompra=null;

        $idUsuarioLogueado=$this->buscaUsuario();

        $compra=new AbmCompra();
        $comprasdelUsuario=$compra->buscar(['idusuario'=>$idUsuarioLogueado]);
        $totalCompras=count($comprasdelUsuario);

        if(count($comprasdelUsuario)>=1){

            //obtener la ultima compra
            $totalCompras=count($comprasdelUsuario);

            $indice=$totalCompras-1;
            $objCompra=$comprasdelUsuario[$indice];

            $estado=$this->buscaEstadoCompra($objCompra);

            if($estado==true){
                return $objCompra;


            }
            else{
                $objCompra=null;
            }



        }


        return $objCompra;


    }

    public function objetoUltimaCompraUsuario(){

        $objCompra=null;

        $idUsuarioLogueado=$this->buscaUsuario();

        $compra=new AbmCompra();
        $comprasdelUsuario=$compra->buscar(['idusuario'=>$idUsuarioLogueado]);
        $totalCompras=count($comprasdelUsuario);

        if(count($comprasdelUsuario)>=1){

            //obtener la ultima compra
            $totalCompras=count($comprasdelUsuario);

            $indice=$totalCompras-1;
            $objCompra=$comprasdelUsuario[$indice];
            
        



        }


        return $objCompra;

    }
    public function buscaEstadoCompra($objCompra){
        $estado=false;

        $idCompra=$objCompra->getIdcompra();

        $compraEstado=new AbmCompraestado();
        $param=['idcompra'=>$idCompra];
        $arregloEstado=$compraEstado->buscar($param);

        $total=count($arregloEstado);
        $indice=$total-1;

        $objEstadoCompra=$arregloEstado[$indice];
        $estadoOBjCompra=$objEstadoCompra->getObjCompraestadotipo()->getIdcompraestadotipo();

        if($estadoOBjCompra==1){
            $estado=true;
        }else{
            $estado=false;
        }



        return $estado;



    }
    //se crea la compra en estado 1 (inicializado)
    public function crearCompra(){
        $sesion=new Session();
        $objUsuario=$sesion->getUsuario();
        $idUsuarioLogueado=$this->buscaUsuario();


        $compra=new AbmCompra();

        $hora=new DateTime();
        $hora=$hora->format('Y-m-d H:i:s');
        $param=['idcompra'=>null,'cofecha'=>$hora,'idusuario'=>$idUsuarioLogueado];

        $objetoCompra=$compra->cargarObjeto($param);

        if($objetoCompra->insertar()){

            //si se genera la compra, tambien se genera el el nuevo estado de la compra que seria 1
            $this->nuevoEstado(1,null);
        }

    }

    public function agregarProducto($param){
        $param['importe']=$param['precio']*$param['cantidad'];


        $producto=new AbmProducto();
        $objProducto=$producto->cargarObjetoConClave($param);
        $arregloProducto=$producto->buscar($param);
        $producto=$arregloProducto[0];



        if($this->verificaCompra()){

            //verEstructura($producto);
            //echo '<hr>';
            //print_r($param);


            $objetoUltimaCompra=$this->buscaUltimaCompraUsuario();
            $idUltimaCompra=$objetoUltimaCompra->getIdcompra();
            //print_r($idUltimaCompra);

            $datos=['idcompra'=>$idUltimaCompra,'idproducto'=>$param['idproducto'],'cicantidad'=>$param['cantidad'],'importe'=>$param['importe']];
            $cantidadPedida= $datos['cicantidad'];
            
            
            $this->actualizarStock($producto,$cantidadPedida,'restar');
            $objAbmCompraItem=new AbmCompraitem();
            if($objAbmCompraItem->alta($datos)){
                header('Location: ../../principal/principal.php');
            }else{
                echo 'error';
            }


        }else{
            $this->crearCompra();
            $this->agregarProducto($param);
        }

    }
    public function obtenerArregloItemCompra(){
        $coleccionCompra=null;


        $compra=$this->buscaUltimaCompraUsuario();
        if($compra!=null){
            $idCompra=$compra->getIdcompra();
            // echo $idCompra;
            $param=['idcompra'=>$idCompra];

            $abmCompraItem=new AbmCompraitem();


            $coleccionCompra=$abmCompraItem->buscar($param);
            // verEstructura($arregloCompraItem);

            return $coleccionCompra;
        }



    }


    private function nuevoEstado($nuevoEstado,$idCompra){
        $estado=false;
        if($idCompra==null){
            $objCompra=$this->objetoUltimaCompraUsuario();
            $idCompra=$objCompra->getIdcompra();
        }


        $hora=new DateTime();
        $hora=$hora->format('Y-m-d H:i:s');
        //se setea compraestado con id 3
        $param=['idcompraestado'=>null,'idcompra'=>$idCompra,'idcompraestadotipo'=>$nuevoEstado,'cefechaini'=>$hora,'cefechafin'=>null];
        $compraEstado=new AbmCompraestado();

        if($compraEstado->alta($param)){
            $estado=true;
        }

        return $estado;

    }




    public function cambiarHoraEstadoAnterior($idCompra){
        $modificado=false;
        $hora=new DateTime();
        $hora=$hora->format('Y-m-d H:i:s');

        //$ultimaCompraUsuario=$this->buscaUltimaCompraUsuario();
        //$idUltimaCompra=$ultimaCompraUsuario->getIdcompra();

        $abmCompraEstado=new AbmCompraestado();
        $arregloEstadosCompra=$abmCompraEstado->buscar(['idcompra'=>$idCompra]);
        $totalEstadosCompra=count($arregloEstadosCompra);
        $indice=$totalEstadosCompra-1;


        $arregloEstadosCompra[$indice]->setCefechafin($hora);


        if($arregloEstadosCompra[$indice]->modificar()){

            $modificado=true;
        }
        return $modificado;
    }





    protected function cambiarEstadoCompra($idcompra,$nuevoEstado){


        $cambiado=false;
        if($this->cambiarHoraEstadoAnterior($idcompra)){

            if($this->nuevoEstado($nuevoEstado,$idcompra)){
                $cambiado=true;

            }
        }

        return $cambiado;
    }


    public function terminarCompra(){
        $ultimaCompraUsuario=$this->buscaUltimaCompraUsuario();
        $idUltimaCompra=$ultimaCompraUsuario->getIdcompra();
        $estado=false;

        if($this->cambiarEstadoCompra($idUltimaCompra,3)){
            $estado=true;
        }

        return $estado;



    }



    public function quitarProducto($param){
        $idCompraItem=$param['idcompraitem'];

        $itemsCompra=$this->obtenerArregloItemCompra();
        $compra=$itemsCompra[0]->getObjCompra();

        $idCompra=$compra->getIdCompra();


        foreach ($itemsCompra as $item){
            
            
            if( $item->getIdcompraitem()==$idCompraItem){
                //como vamos a quitar el item, devemos devolver la cantidad pedida al stock del prod
                // se suma la cantidad pedida al stock
                $this->actualizarStock($item->getObjProducto(),$item->getCiCantidad(),'sumar');
                
                
                $abmCompraItem=new AbmCompraitem();
                if($abmCompraItem->baja($param)){
                    $totalItemsCarrito=count($this->obtenerArregloItemCompra());
                    //
                    if($totalItemsCarrito==0){
                      $this->cambiarEstadoCompra($idCompra,4);

                    }
                    header('Location: ../carrito.php');

                }


            }
        }



    }

 
    public function totalCompra(){
        $total=0;
      
        $arregloITems=$this->obtenerArregloItemCompra();
        if($arregloITems!=null){
            foreach ($arregloITems as $compra){
                $total+=$compra->getImporte();
            }
        }


        return $total;

    }

    
    //si el operador es restar(cuando se agrega un producto al carrito) , se resta lo pedido al stock
    //si el operador es sumar(cuando se quita un producto del carrito) , se suma lo pedido al stock

    public function actualizarStock($objProducto,$cantidadPedida,$operador){
        $actualizado=false;
        $cantidadActualProducto=$objProducto->getProcantstock();

        
        
        if($operador=='restar'){
           $nuevoStock=$cantidadActualProducto-$cantidadPedida; 
        }else{
            $nuevoStock=$cantidadActualProducto+$cantidadPedida;
        }
        $abmProducto=new AbmProducto();
            $param['idproducto'] = $objProducto->getIdproducto();
            $param["pronombre"]=$objProducto->getPronombre();
            $param["prodetalle"]=$objProducto->getProdetalle();
            $param["procantstock"]=$nuevoStock;
            $param["proimporte"]=$objProducto->getProimporte();
            $param["proimagen"]=$objProducto->getProimagen();

        $abmProducto=new AbmProducto();

        if($abmProducto->modificacion($param)){
            $actualizado=true;
        } 


        return $actualizado;

        
    }


    // si cancelamos un items, se devuelve(sumar) la cantidad pedida al stock del producto
    /*public function devolverStock($objItem){


        $cantidadPedida=$objItem->getCiCantidad();
        $objProducto=$objItem->getObjProducto();

        $this->actualizarStock($objProducto,$cantidadPedida,'sumar');

    }*/
}