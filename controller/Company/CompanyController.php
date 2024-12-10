<?php
include_once('model/Company.php');

class CompanyController
{
    private $company;
    public function __construct()
    {
        $this->company = new Company();
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
            $companyName = $_POST['company_name'];
            $categoryItemId = intval($_GET['category_item_id']);
            
            if ($this->company->isCompanyExists($companyName, $categoryItemId)) {
                $_SESSION['message'] = "Thương hiệu đã tồn tại!";
                header("Location: index.php?page=managerCompany&category_item_id=$categoryItemId");
                exit;
            }
            $this->company->addCompany($companyName, $categoryItemId); 
            $_SESSION['message'] = "Thêm thương hiệu thành công!";
           
            header("Location: index.php?page=managerCompany&category_item_id=$categoryItemId");
            exit;
        }
    }
    public function getAllListCompanyByCategoryItemID($categoryItemId)
    {
        $result = $this->company->getAllListCompanyByCategoryItem($categoryItemId);

        if (!$result) {
            die("Failed to retrieve product list: " . $this->company->getConnection()->error);
        }
        return $result;
    }
    //join categoies table

     public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $companyId = $_GET['id'];
            if ($this->company->hasProducts($companyId)) {
                $_SESSION['message'] = 'Không thể xóa vì có sản phẩm dùng thương hiệu.';
            } else {
                if ($this->company->deleteCompany($companyId)) {
                    $_SESSION['message'] = 'Xóa thương hiệu thành công!';
                } else {
                    $_SESSION['message'] = 'Không thể xóa thương hiệu.';
                }
            }
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }    
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $companyId = intval($_POST['company_id']);
            $companyName = $_POST['company_name'];
            $categoryItemId = intval($_GET['category_item_id']);
      
            $oldCompanyName = $this->company->getOldCompanyName($companyId);
            if ($companyName !== $oldCompanyName && $this->company->isCompanyExists($companyName, $categoryItemId)) {
                $_SESSION['message'] = "Tên thương hiệu đã tồn tại!";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
            $this->company->update($companyId, $companyName);
            
            $_SESSION['message'] = "Cập nhật thành công";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}
$controller = new CompanyController();
$controller->handleRequest();
