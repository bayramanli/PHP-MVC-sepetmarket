<?php //echo "<pre>"; print_r($data["product"]); 
?>
<h1 class="text-center">Ürünler</h1>
<br>
<div class="row row-cols-1 row-cols-md-4 g-4">
    <?php foreach ($data["product"] as $products) : ?>
        <div class="col">
            <div class="card text-center">
                <img src="/images/100.png" class="card-img-top" alt="Ürün Resmi">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $products["name"]; ?></h5>
                    <p>
                        <span><strong><?php echo $products["price"]; ?> TL</strong></span>
                        <br>
                        <span>Stok Adedi: <?php echo $products["stock"]; ?></span>
                    </p>
                    <?php if (isset($_SESSION["users"])) { ?>
                        <button product-id="<?php echo $products["id"]; ?>" class="btn btn-primary addToCartBtn">Sepete Ekle</button>
                    <?php } else { ?>
                        <a href="/basketlogin" class="btn btn-primary">Sepete Ekle</a>
                    <?php } ?>
                    <?php /* ?>
                    <form action="/addproduct" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $products["id"]; ?>">
                        <button class="btn btn-primary addToCartBtn">Sepete Ekle</button>
                    </form>
                    <?php */ ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>