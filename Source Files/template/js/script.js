$(document).ready(function () {
    $(".add-to-cart").click(function () {
        $.ajax({
            url: '/cart/addAjax/' + $(this).data('id'),
            type: 'POST',
            data: {count:$('#count').val()},
            success: function(data){
                $("#cart-count").html("(" + data + ")");
            },
            error: function(){
                alert('Error');
            }
        });
        return false;
    });
});

function deleteProduct(btn){
    var productID = $(btn).data('id');
    $.ajax({
        url: '/cart/delete/' + productID,
        type: 'POST',
        data: {count: $('#product_' + productID).val()},
        success: function(data){
            location.reload();
        },
        error: function(){
            alert('error');
        }
    });
}