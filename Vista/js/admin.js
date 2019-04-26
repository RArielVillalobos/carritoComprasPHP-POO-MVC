

$(document).ready(function() {

    $('[data-compracan]').on('click',function(e){
        e.preventDefault();

        var id=$(this).data('compracan');
        $('.modal-body').load('../compras/admin/cancelarCompra.php?idcompra='+id,function(){
            $('#cancelarcompra').modal('show');

        });


    });

});
$(document).ready(function() {

    $('[data-compraacep]').on('click',function(e){
        e.preventDefault();

        var id=$(this).data('compraacep');
        $('.modal-body').load('../compras/admin/aceptarCompra.php?idcompra='+id,function(){
            $('#aceptarcompra').modal('show');

        });


    });

});