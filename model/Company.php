<?php
include_once('ConnectDatabase.php');

class Company extends ConnectDatabase
{
    private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }
    
    public function getAllListCompanyByCategoryItem($categoryItemId)
    {
        $query = "SELECT * FROM companies WHERE category_item_id = '$categoryItemId'";
        $result = $this->conn->query($query);
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    
    public function addCompany($name, $categoryItemId) {
        $query = "INSERT INTO companies (company_name, category_item_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("Lỗi chuẩn bị câu lệnh: " . $this->conn->error);
        }
        $stmt->bind_param("si", $name, $categoryItemId);
        return $stmt->execute(); 
    }
    public function isCompanyExists($company, $categoryItemId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM companies WHERE company_name = ? AND category_item_id = ?");
        $stmt->bind_param("si", $company, $categoryItemId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0; // Trả về true nếu tồn tại
    }
    public function deleteCompany($companyId) {
        $stmt = $this->conn->prepare("DELETE FROM companies WHERE company_id = ?");
        $stmt->bind_param("i", $companyId);
        if ($stmt->execute()) {
            return true;
        }
    }
    public function update($companyId, $companyName) {
            $stmt = $this->conn->prepare("UPDATE companies SET company_name = ? WHERE company_id = ?");
            $stmt->bind_param("si", $companyName,$companyId);
        return $stmt->execute(); 
    }
    public function getOldCompanyName($companyId) {
        $stmt = $this->conn->prepare("SELECT company_name FROM companies WHERE company_id = ?");
        $stmt->bind_param("i", $companyId);
        $stmt->execute();
        $stmt->bind_result($name);
        if ($stmt->fetch()) {
            return $name; 
        }
        return null;
    }
}
