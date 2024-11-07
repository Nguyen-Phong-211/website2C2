<?php 
    include_once('model/Cart.php');

    class CartController {
        private $cart;

        public function __construct() {
            $this->cart = new Cart();
        }
        //get cart in product
        public function getProductofCartList() {
            $result = $this->cart->getAllProductofCart();

            if (!$result) {
                die("Failed to retrieve category list: " . $this->cart->getConnection()->error);
            }
            return $result;
        }
        //count product in cart
        public function getProductCount() {
            return $this->cart->countProductInCart();
        }
    }
?>