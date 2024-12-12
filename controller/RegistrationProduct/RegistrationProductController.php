<?php
include_once('model/RegistrationProduct.php');
include_once('controller/Email/EmailController.php');

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
    //get info regis by registration_id
    public function getInfoRegisByIdController($regisId){
        $result = $this->registrationProductModel->getInfoRegisById($regisId);
        if (!$result) {
            die("Failed to retrieve category list: " . $this->registrationProductModel->getConnection()->error);
        }
        return $result;
    }
    //
    public function insertProductDataController($regisId){
        if (isset($_POST['btnApprovalProduct'])) {
            $result = $this->registrationProductModel->insertProductData($regisId); 

            $_SESSION['message'] = $result;  
            echo '<script>
                alert("Duyệt sản phẩm thành công!");
                window.location.href = "index.php?page=productApproval";
            </script>';
            exit();
        }
    }
    //updateReasonRefusal
    public function updateReasonRefusalController($regisId, $reasonRefusal){
        if(isset($_POST['btnRefuseProduct'])){
            $result = $this->registrationProductModel->updateReasonRefusal($regisId, $reasonRefusal); 
            if($result){
                $emailController = new EmailController();
                $emailController->sendReasonRefuse($_SESSION['email_seller'], $reasonRefusal, $_REQUEST['title']);
                echo '<script>
                        alert("Từ chối sản phẩm thành công!");
                        window.location.href = "index.php?page=productApproval";
                    </script>';
                    exit();
            }else{
                echo '<script>
                        alert("Từ chối sản phẩm thất bại! Vui lòng thử lại.");
                        window.location.href = "index.php?page=productApproval";
                    </script>';
                exit();
            }
        }
    }
    //get status registration_product
    public function getStatusRegistrationProductController($regisId){
        $result = $this->registrationProductModel->getStatusRegis($regisId);
        if (!$result) {
            die("Failed to retrieve status: ". $this->registrationProductModel->getConnection()->error);
        }
        return $result;
    }
}
