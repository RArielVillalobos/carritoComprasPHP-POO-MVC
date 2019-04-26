<?php
/**
 * Created by PhpStorm.
 * User: ariel
 * Date: 8/nov/2018
 * Time: 15:35
 */

class Cliente extends Carrito
{




    public function misCompras(){

        $usuarioLogueado=new Session();
        $objUsuario=$usuarioLogueado->getUsuario();

        $idUsuarioLogueado=$objUsuario->getIdusuario();
        $abmCompra=new AbmCompra();
        $misCompras=$abmCompra->buscar(['idusuario'=>$idUsuarioLogueado]);

        return $misCompras;



    }

    public function ultimoEstadoCompra($idCompra){
        $abmCompraEstado=new AbmCompraestado();
        $arreglo=$abmCompraEstado->buscar(['idcompra'=>$idCompra]);
        $total=count($arreglo);

        $indice=$total-1;
        $objetoUltimoEstado=$arreglo[$indice];
        $estado=$objetoUltimoEstado->getObjCompraestadotipo()->getCetdescripcion();

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


        verEstructura($this->obtenerArregloItemCompra());

    }




}