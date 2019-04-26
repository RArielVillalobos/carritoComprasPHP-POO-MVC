$(document).ready(function() {

    $('[data-id]').on('click',function(e){
        e.preventDefault();

        var id=$(this).data('id');
        $('.modal-body').load('prod.php?idproducto='+id,function(){
            $('#modalcomprar').modal('show');











        });






    });

});






