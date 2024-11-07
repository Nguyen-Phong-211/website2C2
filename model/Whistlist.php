<?php 
    include_once('ConnectDatabase.php');

    class Whistlist extends ConnectDatabase{
        private $conn;
        public function __construct()
        {
            parent::__construct(); 
            $this->conn = $this->getConnection(); 
        }
        //add product to whistlist
        public function addToWhistlist($productId)
        {
            $query = "INSERT INTO whistlists (product_id) VALUES ('$productId')";
            $result = $this->conn->query($query);

            if ($result === false) {
                die("Query failed: ". $this->conn->error);
            }
            echo "Product added to whistlist successfully";
        }
        //get all product in whistlist
        public function getAllProductInWhistlist()
        {
            $query = "SELECT * FROM whistlists";
            $result = $this->conn->query($query);

            if ($result === false) {
                die("Query failed: ". $this->conn->error);
            }

            return $result;
        }
        //remove product from whistlist
        public function removeFromWhistlist($productId)
        {
            $query = "DELETE FROM whistlists WHERE product_id = '$productId'";
            $result = $this->conn->query($query);

            if ($result === false) {
                die("Query failed: ". $this->conn->error);
            }
            echo "Product removed from whistlist successfully";
        }
        //count product in whistlist
        public function countProductInWhistlist(){
            $query = "SELECT COUNT(*) as total FROM whistlists";
            $result = $this->conn->query($query);

            if ($result === false) {
                die("Query failed: ". $this->conn->error);
            }

            return $result->fetch_assoc()['total'];
        }
    }
?>