<?php

class defaultController extends mainController
{
    //index sayfası controller
    public function index()
    {
        $data = [];
        $indexModel = new defaultModel();
        $data["product"] = $indexModel->indexModel();
        //echo "<pre>";
        //print_r($data);
        //exit;
        // ürünleri bublesort algoritması ile ürün fiyatına göre sıralayarak listeleme
        $newArray = 0; // geçici dizi
        for ($i = 0; $i < count($data["product"]); $i++) {
            for ($j = 0; $j < count($data["product"]) - 1; $j++) {
                if ($data["product"][$j]["price"] > $data["product"][$j + 1]["price"]) {
                    $newArray = $data["product"][$j + 1];
                    $data["product"][$j + 1] = $data["product"][$j];
                    $data["product"][$j] = $newArray;
                }
            }
        }
        $this->callLayout("frontend", "main", "default", "index", $data);
    }

    //Login sayfası controller fonksiyonu
    public function login()
    {
        $data = [];
        if (isset($_SESSION['users'])) {
            Header("Location:/");
            exit;
        } else {
            $this->callView("default", "login", $data);
        }
    }

    //giriş kontrolü
    public function loginControl()
    {

        $loginControlModel = new defaultModel();
        $data = $loginControlModel->loginControl();

        if ($data['status']) {
            $_SESSION["messageManagement"] = ["status" => true, "message" => "Giriş başarılı"];
            Header("Location:/");
            exit;
            //$this->callLayout("frontend","main","default","index",$data);
        } else {
            $_SESSION["messageManagement"] = ["status" => false, "message" => "Giriş başarısız oldu. Lütfen daha sonra tekrar deneyiniz."];
            $this->callView("default", "login", $data);
        }
    }

    //user çıkışı yapma
    public function logout()
    {
        $data = [];
        $logoutModel = new defaultModel();
        $logoutModel->logoutModel();
        $this->callView("default", "login", $data);
    }

    //Sepet Sayfası
    public function basket()
    {
        $data = [];
        $basket = new defaultModel();
        $data["basket"] = $basket->basketModel($_SESSION["users"]["users_id"]);
        //echo "<pre>";
        //print_r($data);
        //exit;
        $this->callLayout("frontend", "main", "default", "basket", $data);
    }

    //giriş yapmışsa sepete ürün ekleyebilsin
    public function basketLoginControl()
    {
        $_SESSION["messageManagement"] = ["status" => false, "message" => "Ürünü sepete ekleyebilmek için önce giriş yapmalısınız."];
        Header("Location:/login");
        exit;
    }

    //Sepete Ürün ekleme
    public function addProductToBasket()
    {
        $data = [];
        $product_id = $_POST["product_id"];
        $addProductToBasket = new defaultModel();
        //Kullanıcıya ait aynı ürün var mı
        $data["basket"] = $addProductToBasket->basketControl($product_id);
        //kullanıcıya ait aynı ürün varsa miktarını güncelle

        if (count($data["basket"])) {
            $basket_id = $data["basket"][0]["id"];
            $quantity = $data["basket"][0]["quantity"] + 1;
            $data = $addProductToBasket->updateCustomerProduct($basket_id, $quantity);
        } else {
            //kullanıcıya ait aynı ürün yoksa ekle
            $data = $addProductToBasket->addProductToBasket($product_id);
        }
        echo $data["status"];
    }

    //sepetteki ürün sayısını artırma
    public function basketPlus($basket_id, $quantity)
    {
        $data = [];
        $basketPlus = new defaultModel();
        $quantity = $quantity + 1;
        $data = $basketPlus->updateCustomerProduct($basket_id, $quantity);

        if ($data["status"]) {
            $_SESSION["messageManagement"] = ["status" => true, "message" => "Ekleme İşlemi başarılı"];
        } else {
            $_SESSION["messageManagement"] = ["status" => false, "message" => "Ekleme İşlemi başarısız"];
        }

        Header("Location:{$_SERVER['HTTP_REFERER']}");
        exit;
    }

    //sepetteki ürün sayısını azaltma
    public function basketMinus($basket_id, $quantity)
    {
        $data = [];
        $basketMinus = new defaultModel();

        //eğer ürün sayısı 1 eeşit ise ürünü tamamen sil
        if ($quantity == 1) {
            $data = $basketMinus->basketDrop($basket_id);
        } else {
            // 1 değilse azalt
            $quantity = $quantity - 1;
            $data = $basketMinus->updateCustomerProduct($basket_id, $quantity);
        }
        if ($data["status"]) {
            $_SESSION["messageManagement"] = ["status" => true, "message" => "Silme İşlemi başarılı"];
        } else {
            $_SESSION["messageManagement"] = ["status" => false, "message" => "Silme İşlemi başarısız"];
        }

        Header("Location:{$_SERVER['HTTP_REFERER']}");
        exit;
    }

    //sepetten ürün silme
    public function basketDrop()
    {
        $data = [];
        $basket_id = $_POST["basket_id"];
        $basketDrop = new defaultModel();
        $data = $basketDrop->basketDrop($basket_id);

        echo $data["status"];
    }
}
