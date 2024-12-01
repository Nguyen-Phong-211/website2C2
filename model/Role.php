<?php 
    include_once('ConnectDatabase.php');

    class Role extends ConnectDatabase{
        private $conn;

        public function __construct(){
            $this->conn = $this->getConnection();
        }
    }
?>