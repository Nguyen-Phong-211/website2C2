<?php
include_once('ConnectDatabase.php');

class WarrantyPolicy extends ConnectDatabase
{
    private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }
    //get all product in category
    public function getAllListPolicies()
    {
        $query = "SELECT * FROM warranty_policies";
        $result = $this->conn->query($query);
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
}