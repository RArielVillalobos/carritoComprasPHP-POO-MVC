<?php
/**
 * Created by PhpStorm.
 * User: ariel
 * Date: 8/nov/2018
 * Time: 11:36
 */

class Admin extends  Carrito
{
    public function verificaEstadoCompra($idCompra){
        $compraEstado=new AbmCompraestado();
        $param=['idcompra'=>$idCompra];
        $arregloCompraEstadoDeLaCompra=$compraEstado->buscar($param);
        $total=count($arregloCompraEstadoDeLaCompra);

        $idEstadoCompra=$arregloCompraEstadoDeLaCompra[$total-1]->getObjCompraestadotipo()->getIdcompraestadotipo();
        return $idEstadoCompra;





    }



    public function comprasPendientes(){
        /*$compraEstado=new AbmCompraestado();
        $param=['idcompraestadotipo'=>3];
        $arregloCompras=$compraEstado->buscar($param);

        $comprasPendientes=[];
        foreach($arregloCompras as $compra){
            $comprasPendientes[]=$compra->getObjCompra();
        }*/
        $compra=new AbmCompra();
        $arregloCompras= $compra->buscar(null);

        return $arregloCompras;
        //return $comprasPendientes;

    }

    //funcion para aceptar la compra, el nuevo estado de la compra se debe guardar con id 3
    public function aceptarCompra($idCompra){
        $estado=false;
        //aca usamos la funcion para cambiarestado implementada en la clase Carrito
        if($this->cambiarEstadoCompra($idCompra,2)){
            $estado=true;

       }

        return $estado;



    }

    public function cancelarCompra($idcompra){
        $estado=false;
        if($this->cambiarEstadoCompra($idcompra,4)){
            $estado=true;
        }

        return $estado;
    }

    public function devolverStock(){
        
    }

   /* public function actualizarStock($idCompra){
        $actualizado=false;
        $param=['idcompra'=>$idCompra];
        $abmCompraItem=new abmCompraItem;
        $arreglo=$abmCompraItem->buscar($param);

        foreach($arreglo as $item){
            $cantidadActualProducto=$item->getObjProducto()->getProcantstock();
            $producto=$item->getObjProducto();
            
            
            $cantidad=$item->getCicantidad();
            $nuevoStock=$cantidadActualProducto-$cantidad;
            
            $abmProducto=new AbmProducto();
            $param['idproducto'] = $producto->getIdproducto();
            $param["pronombre"]=$producto->getPronombre();
            $param["prodetalle"]=$producto->getProdetalle();
            $param["procantstock"]=$nuevoStock;
            $param["proimporte"]=$producto->getProimporte();
            $param["proimagen"]=$producto->getProimagen();



            if($abmProducto->modificacion($param)){
                $actualizado=true;
            } 
           
        }

        return $actualizado;




    }*/

}