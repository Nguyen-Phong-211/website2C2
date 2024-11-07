<?php 
    include_once('model/Product.php');

    class ProductController {
        private $product;
        public function __construct() {
            $this->product = new Product();
        }
        //get all product
        public function getAllProductController(){
            $result = $this->product->getAllProduct();

            if (!$result) {
                die("Failed to retrieve category list: " . $this->product->getConnection()->error);
            }
            return $result;
        }
        //join reviews
        public function getAllProductWithReviewsController(){
            $result = $this->product->getAllProductWithReviews();

            if (!$result) {
                die("Failed to retrieve product list: " . $this->product->getConnection()->error);
            }
            return $result;
        }
        //get product by hight view
        public function getProductByHightViewController(){
            $result = $this->product->getProductByHightView();

            if (!$result) {
                die("Failed to retrieve product list: " . $this->product->getConnection()->error);
            }
            return $result;
        }
    }
?>