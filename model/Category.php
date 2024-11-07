<?php
include_once('ConnectDatabase.php');

class Category extends ConnectDatabase
{
    private $conn;
    public function __construct()
    {
        parent::__construct(); 
        $this->conn = $this->getConnection(); 
    }

    public function getAllCategory()
    {
        $query = "SELECT * FROM categories";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }
}
