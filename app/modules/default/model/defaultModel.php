<?php

class defaultModel extends mainModel
{
    //index sayfası model fonksiyonu
    public function indexModel()
    {
        //ürünleri çek
        $sql = $this->db->read("product");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    //login model
    public function loginControl()
    {
        $sql = $this->db->userLogin(
            htmlspecialchars($_POST["email"]),
            htmlspecialchars($_POST["passwords"])
        );
        return $sql;
    }

    //logout model
    public function logoutModel()
    {
        $this->db->userLogout();
    }

    //sepete ürün ekleme
    public function addProductToBasket($product_id)
    {
        $values = [
            "product_id" => $product_id,
            "customer_id" => $_SESSION["users"]["users_id"],
            "quantity" => 1,
            "record_date" => date("Y-m-d H:i:s")
        ];
        $sql = $this->db->insert("basket", $values);

        return $sql;
    }

    //Ürün bilgilerini alma
    public function productInfo($product_id)
    {
        $sql = $this->db->wread("product", "id", $product_id);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    //sepetteki ürünleri alma
    public function basketModel($customer_id)
    {
        $sql = $this->db->wread("basket", "customer_id", $customer_id);
        $data["basket"] = $sql->fetchAll(PDO::FETCH_ASSOC);

        $count = 0;
        foreach($data["basket"] as $basket) {
            $sql = $this->db->wread("product", "id", $basket["product_id"]);
            $result[$count] = $basket;
            $result[$count]["product"] = $sql->fetch(PDO::FETCH_ASSOC);
            $count++;
        }

        //echo "<pre>";
        //print_r($result);
        //exit;

        return $result;
    }

    //Kullanıcı ürünü daha önceden sepete eklemiş mi
    public function basketControl($product_id)
    {
        $sql = "SELECT * FROM basket WHERE product_id={$product_id} AND customer_id={$_SESSION['users']['users_id']}";
        $result = $this->db->qSql($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
        //return $result->rowCount();
    }

    //Kullanıcıya ait ürünün müktarını güncelle
    public function updateCustomerProduct($basket_id, $quantity)
    {
        $values = [
            "quantity" => $quantity,
            "id" => $basket_id
        ];
        $sql = $this->db->update(
            "basket",
            $values,
            [
                "columns" => "id"
            ]
        );

        return $sql;
    }

    //sepetten ürün silme
    public function basketDrop($basket_id)
    {
        $sql = $this->db->delete("basket", "id", $basket_id);
        return $sql;
    }
}
