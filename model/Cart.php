<?php 
    include_once('ConnectDatabase.php');

    class Cart extends ConnectDatabase{
        private $conn;

        public function __construct()
        {
            parent::__construct(); 
            $this->conn = $this->getConnection(); 
        }
        //get all product in cart
        public function getAllProductofCart()
        {
            $query = "SELECT * FROM carts";
            $result = $this->conn->query($query);
    
            if ($result === false) {
                die("Query failed: " . $this->conn->error);
            }
    
            return $result;
        }
        //count product
        public function countProductInCart(){
            $query = "SELECT COUNT(*) as total FROM carts";
            $result = $this->conn->query($query);

            if ($result === false) {
                die("Query failed: ". $this->conn->error);
            }

            return $result->fetch_assoc()['total'];
        }
    }
?>