<?php 
    include_once('ConnectDatabase.php');

    class Product extends ConnectDatabase{
        private $conn;
        public function __construct()
        {
            parent::__construct(); 
            $this->conn = $this->getConnection(); 
        }
        //get all product
        public function getAllProduct()
        {
            $query = "SELECT * FROM products";
            $result = $this->conn->query($query);

            if ($result === false) {
                die("Query failed: ". $this->conn->error);
            }
            return $result;
        }
        //join reviews
        public function getAllProductWithReviews(){
            $query = "SELECT * FROM products AS p 
                        JOIN reviews AS r ON p.product_id = r.product_id
                        JOIN images AS i ON i.product_id = p.product_id";
            $result = $this->conn->query($query);

            if ($result === false) {
                die("Query failed: ". $this->conn->error);
            }
            return $result;
        }
        //get product by hight view
        public function getProductByHightView(){
            $query = "SELECT * FROM products WHERE view >= 5 LIMIT 7";
            $result = $this->conn->query($query);

            if ($result === false) {
                die("Query failed: ". $this->conn->error);
            }
            return $result;
        }
    }
?>