<?php
include_once('ConnectDatabase.php');

class CategoryAttribute extends ConnectDatabase
{
    private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }
    //get all product in category
    public function getAllListAttributeByCategory($categoryId)
    {
        $query = "SELECT * FROM category_attributes WHERE category_id = '$categoryId'";
        $result = $this->conn->query($query);
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    
    public function addCategoryAtt($name, $categoryId) {
        $query = "INSERT INTO category_attributes (category_attribute_name, category_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("Lỗi chuẩn bị câu lệnh: " . $this->conn->error);
        }
        $stmt->bind_param("si", $name, $categoryId);
        return $stmt->execute(); // Trả về true nếu thành công
    }
    public function isCategoryAttExists($categoryAtt, $categoryId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM category_attributes WHERE category_attribute_name = ? AND category_id = ?");
        $stmt->bind_param("si", $categoryAtt, $categoryId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0; // Trả về true nếu tồn tại
    }
    public function deleteCategoryAtt($categoryAttId) {
        $stmt = $this->conn->prepare("DELETE FROM category_attributes WHERE category_attribute_id = ?");
        $stmt->bind_param("i", $categoryAttId);
        if ($stmt->execute()) {
            return true; // Thành công
        } else {
            error_log("Lỗi khi xóa thuộc tính: " . $stmt->error);
            return false; // Thất bại
        }
    }
    public function update($categoryAttId, $categoryAttName) {
            $stmt = $this->conn->prepare("UPDATE category_attributes SET category_attribute_name = ? WHERE category_attribute_id = ?");
            $stmt->bind_param("si", $categoryAttName,$categoryAttId);
        return $stmt->execute(); 
    }
    public function getOldCategoryAttName($categoryAttId) {
        $stmt = $this->conn->prepare("SELECT category_attribute_name FROM category_attributes WHERE category_attribute_id = ?");
        $stmt->bind_param("i", $categoryAttId);
        $stmt->execute();
        $stmt->bind_result($name);
        if ($stmt->fetch()) {
            return $name; // Trả về tên danh mục cũ
        }
        return null;
    }
}
