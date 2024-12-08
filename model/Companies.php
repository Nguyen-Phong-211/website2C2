<?php
include_once('ConnectDatabase.php');

class Companies extends ConnectDatabase
{
    private $conn;
    public function __construct()
    {
        parent::__construct(); 
        $this->conn = $this->getConnection(); 
    }

    public function getAllCompanies()
    {
        $query = "SELECT * FROM companies";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }
}