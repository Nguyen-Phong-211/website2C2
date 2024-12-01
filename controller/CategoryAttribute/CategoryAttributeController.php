<?php
include_once('model/CategoryAttribute.php');

class CategoryAttributeController
{
    private $categoryAttribute;
    public function __construct()
    {
        $this->categoryAttribute = new CategoryAttribute();
    }
    public function handleRequest() {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'add':
                    $this->add(); 
                    break;
                case 'delete':
                    $this->delete();
                    break;
                case 'edit':
                    $this->edit();
                    break;
            }
        }
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryAttName = $_POST['categoryAttribute_name'];
            $categoryId = intval($_GET['category_id']);
            
            if ($this->categoryAttribute->isCategoryAttExists($categoryAttName, $categoryId)) {
                $_SESSION['message'] = "Thuộc tính đã tồn tại!";
                header("Location: index.php?page=managerCategoryAttribute&category_id=$categoryId");
                exit;
            }
            $this->categoryAttribute->addCategoryAtt($categoryAttName, $categoryId); 
            $_SESSION['message'] = "Thêm thuộc tính thành công!";
            
            // Chuyển hướng về trang danh mục con
            header("Location: index.php?page=managerCategoryAttribute&category_id=$categoryId");
            exit;
        }
    }
    //get all product in category
    public function getAllListAttributeByCategoryID($categoryId)
    {
        $result = $this->categoryAttribute->getAllListAttributeByCategory($categoryId);

        if (!$result) {
            die("Failed to retrieve product list: " . $this->categoryAttribute->getConnection()->error);
        }
        return $result;
    }
    //join categoies table

     public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $categoryAttId = $_GET['id'];
            if ($this->categoryAttribute->deleteCategoryAtt($categoryAttId)) {
                $_SESSION['message'] = 'Xóa thuộc tính thành công!';
            } else {
                $_SESSION['message'] = 'Không thể xóa thuộc tính.';
            }
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }    
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $categoryAttId = intval($_POST['category_attribute_id']);
            $categoryAttName = $_POST['category_attribute_name'];
            $categoryId = intval($_GET['category_id']);
      
            $oldCategoryItemName = $this->categoryAttribute->getOldCategoryAttName($categoryAttId);
            if ($categoryAttName !== $oldCategoryItemName && $this->categoryAttribute->isCategoryAttExists($categoryAttName, $categoryId)) {
                $_SESSION['message'] = "Thuộc tính đã tồn tại!";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
            $this->categoryAttribute->update($categoryAttId, $categoryAttName);
            
            $_SESSION['message'] = "Cập nhật thành công";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}
    $controller = new CategoryAttributeController();
    $controller->handleRequest();

