<?php
include_once('model/RegistrationProduct.php');

class RegistrationProductController
{
    private $registrationProductModel;

    public function __construct()
    {
        $this->registrationProductModel = new RegistrationProduct();
    }
    public function addRegistrationProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-upload'])) {
            try {
                // Thu thập dữ liệu từ form
                $data = [
                    'category_id' => $_POST['category'], 
                    'company_id' => $_POST['company'], 
                    'category_item_id' => $_POST['subcategory'], 
                    'user_id' => $_SESSION['user_id'], 
                    'warranty_policy_id' => $_POST['policy'],
                    'status_product_id' => $_POST['status_product_id'],
                    'title' => $_POST['title'], 
                    'price' => $_POST['price'], 
                    'quantity' => $_POST['quantity'], 
                    'description' => $_POST['des'], 
                    'address' => $_POST['address'], 
                    'attributes' => $_POST['attributes'] ?? [], 
                ];

                $result = $this->registrationProductModel->registerProduct($data, $_FILES);

                if (strpos($result, 'successfully') !== false) {
                    echo "<script>alert('Đăng sản phẩm thành công! Vui lòng đợi chúng tôi kiểm duyệt! Cảm ơn!');</script>";
                }else{
                    echo "<script>alert('Thêm sản phẩm thất bại! Chi tiết lỗi: " . htmlspecialchars($result) . "');</script>";
    
                }
            } catch (Exception $e) {
                echo "<p class='text-danger'>Error: " . $e->getMessage() . "</p>";
                echo "<p class='text-danger'>File: " . $e->getFile() . "</p>";
                echo "<p class='text-danger'>Line: " . $e->getLine() . "</p>";

                error_log("Error in file " . $e->getFile() . " on line " . $e->getLine() . ": " . $e->getMessage());
            }
        }
    }
    ////get all registration by role_seller_id = 1 and status = '0'
    public function getAllProductApprovalController(){
        $result = $this->registrationProductModel->getAllProductApproval();
        if (!$result) {
            die("Failed to retrieve category list: " . $this->registrationProductModel->getConnection()->error);
        }
        return $result;
    }
    ////get name of level category
    public function getNameLevelCategoryController($regisId){
        $result = $this->registrationProductModel->getNameLevelCategory($regisId);
        if (!$result) {
            die("Failed to retrieve category list: " . $this->registrationProductModel->getConnection()->error);
        }
        return $result;
    }
}
