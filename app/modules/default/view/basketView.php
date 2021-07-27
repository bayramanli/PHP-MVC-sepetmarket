<?php //echo "<pre>"; print_r($data); 
if (empty($data["basket"])) { ?>
<h5 class="text-center m-4">Sepetinizde ürün bulunmamaktadır.</h5>
<p class="text-center"><a href="/index" class="btn btn-primary btn-lg">Sepete Ürün Ekle</a></p>
<?php } else { ?>
    <h5 class="text-center m-4">Sepetinizde <span class="product-count"><?php echo count($data["basket"]); ?></span> adet farklı ürün bulunmaktadır.</h5>

    <table class="table table-bordered table-striped">
        <thead class="thead-light table-primary">
            <tr>
                <th scope="col">Sıra</th>
                <th scope="col">Ürün Adı</th>
                <th scope="col">Ürün Fiyatı</th>
                <th scope="col">Adedi</th>
                <th scope="col">Toplam Fiyat</th>
                <th scope="col">İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php $num = 1;
            $productNum = 0;
            $productsPrice = 0;
            foreach ($data["basket"] as $basket) : ?>
                <tr>
                    <th scope="row"><?php echo $num; ?></th>
                    <td class="text-center"><?php echo $basket["product"]["name"]; ?></td>
                    <td class="text-center"><strong><?php echo $basket["product"]["price"] ?></strong></td>
                    <td class="text-center">
                        <a href="/basketplus/<?php echo $basket["id"]; ?>/<?php echo $basket["quantity"]; ?>" basket-id-plus="<?php echo $basket["id"]; ?>" class="btn btn-xs btn-success basketPlus">
                            <span class="bi bi-plus"></span>
                        </a>
                        <input type="text" class="item-count-input quantity" value="<?php echo $basket["quantity"]; ?>">
                        <a href="/basketminus/<?php echo $basket["id"]; ?>/<?php echo $basket["quantity"]; ?>" basket-id-minus="<?php echo $basket["id"]; ?>" class="btn btn-xs btn-danger basketMinus">
                            <span class="bi bi-dash-lg"></span>
                        </a>
                    </td>
                    <td class="text-center"><strong><?php echo $basket["product"]["price"] * $basket["quantity"]; ?> TL</strong></td>
                    <td class="text-center">
                        <button basket-id-drop="<?php echo $basket["id"]; ?>" class="btn btn-danger basketDrop">
                            <span class="bi bi-x"></span>
                            <span>Sepetten Çıkar</span>
                        </button>
                    </td>
                </tr>
            <?php $productNum = $productNum + $basket["quantity"];
                $productsPrice = $productsPrice + $basket["quantity"] * $basket["product"]["price"];
                $num++;
            endforeach;
            ?>

        </tbody>
        <tfoot>
            <th colspan="3" class="text-center table-primary">
                Toplam Ürün: <span class="text-danger"><?php echo $productNum; ?></span>
            </th>
            <th colspan="3" class="text-center table-primary">
                Toplam Fiyat: <span class="product-count"><?php echo $productsPrice; ?> TL</span>
            </th>
        </tfoot>
    </table>
<?php } ?>