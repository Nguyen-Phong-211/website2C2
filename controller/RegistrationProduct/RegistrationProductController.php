<?php
include_once('model/RegistrationProduct.php');

class RegistrationProductController {
    private $registrationProductModel;

    public function __construct() {
        $this->registrationProductModel = new RegistrationProduct();
    }

    // Xử lý thêm sản phẩm mới
    public function addRegistrationProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-upload'])) {
            try {
                // Thu thập dữ liệu từ form
                $data = [
                    'category_id' => $_POST['category'], // Danh mục cấp 1
                    'company_id' => $_POST['company'], // Thương hiệu
                    'category_item_id' => $_POST['subcategory'], // Danh mục cấp 2
                    'user_id' => $_SESSION['user_id'], // ID người dùng (lưu trong session)
                    'warranty_policy_id' => $_POST['policy'], // Chính sách bảo hành
                    'title' => $_POST['title'], // Tên sản phẩm
                    'price' => $_POST['price'], // Giá sản phẩm
                    'quantity' => $_POST['quantity'], // Số lượng
                    'status' => $_POST['status'], // Trạng thái
                    'description' => $_POST['des'], // Mô tả sản phẩm
                    'address' => $_POST['address'], // Địa chỉ liên hệ
                    'attributes' => $_POST['attributes'] ?? [], // Mảng thuộc tính sản phẩm (nếu có)
                ];

                // Gọi model để xử lý thêm sản phẩm
                $result = $this->registrationProductModel->registerProduct($data, $_FILES);

                // Hiển thị kết quả
                if (strpos($result, 'successfully') !== false) {
                    echo "<script>alert('Thêm sản phẩm thành công!');</script>";
                } else {
                    echo "<script>alert('Thêm sản phẩm thất bại!');</script>";
                }
            } catch (Exception $e) {
                echo "<p class='text-danger'>Error: " . $e->getMessage() . "</p>";
            }
        }
    }
}
