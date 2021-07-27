$(document).ready(function () {
    //sepete ürün ekleme
    $(".addToCartBtn").click(function () {
        var url = "/addproduct";
        var data = {
            product_id: $(this).attr("product-id")
        };
        $.post(url, data, function (response) {
            //alert(response);
            if(parseInt(response)) {
                alertify.success('Ürün sepete eklendi.');
            } else {
                alertify.error('Ürün sepete eklenirken hata oluştu. Lütfen daha sonra tekrar deneyiniz.');
            }
        });
    });

    //sepetteki ürünü silme
    $(".basketDrop").click(function () {
        var url = "/basketdrop";
        var data = {
            basket_id: $(this).attr("basket-id-drop")
        };
        $.post(url, data, function (response) {
            //alert(response);
            if(parseInt(response)) {
                window.location.reload();
                alertify.success('Ürün sepete silindi.');
            } else {
                alertify.error('Ürün sepetten silinirken hata oluştu. Lütfen daha sonra tekrar deneyiniz.');
            }
        });
    });
});

function messageManagement(success,error) {
    if (success)
    {
        alertify.success("İşlem Başarılı");
    } else {
        alertify.error(error);
    }
}
