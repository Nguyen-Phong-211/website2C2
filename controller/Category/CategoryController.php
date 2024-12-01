<?php 
include_once(__DIR__ . '/../../model/Category.php');


class CategoryController {
    private $category;

    public function __construct() {
        $this->category = new Category();
    }
    
    public function getCategoryList() {
        $result = $this->category->getAllCategory();

        if (!$result) {
            die("Failed to retrieve category list: " . $this->category->getConnection()->error);
        }
        return $result;
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
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $categoryId = $_GET['id'];
    
            if ($this->category->hasSubcategories($categoryId)) {
                $_SESSION['message'] = 'Không thể xóa danh mục vì nó có danh mục con.';
            } else {
                if ($this->category->deleteCategory($categoryId)) {
                    $_SESSION['message'] = 'Xóa danh mục thành công!';
                } else {
                    $_SESSION['message'] = 'Không thể xóa danh mục.';
                }
            }
            header('Location: index.php?page=managerCategory');
            exit;
        }
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryName = $_POST['category_name'];
            $image = $_FILES['image'];
    
            // Kiểm tra tên danh mục có bị trùng không
            if ($this->category->isCategoryExists($categoryName)) {
                echo '<div class="message">Tên danh mục đã tồn tại. Vui lòng chọn tên khác.</div>';
                exit;
            }
    
            // Kiểm tra định dạng hình ảnh
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $imageExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    
            if ($image['error'] === 0) {
                if (!in_array($imageExtension, $allowedExtensions)) {
                    echo '<div class="message">Định dạng hình ảnh không hợp lệ. Chỉ chấp nhận jpg, jpeg, png, gif.</div>';
                    exit;
                }
    
                $uploadDir = 'asset/image/category/';
                $imageName = time() . '_' . basename($image['name']);
                $uploadFile = $uploadDir . $imageName;
    
                if (!move_uploaded_file($image['tmp_name'], $uploadFile)) {
                    echo '<div class="message">Có lỗi trong quá trình tải lên hình ảnh.</div>';
                    exit;
                }
            }
    
            if ($this->category->addCategory($categoryName, $image['error'] === 0 ? $imageName : null)) {
                echo '<div class="message">Danh mục đã được thêm thành công!</div>';
            } else {
                echo '<div class="message">Có lỗi xảy ra khi thêm danh mục vào CSDL.</div>';
            }
            exit;
        }
    }
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryId = $_POST['category_id'];
            $categoryName = $_POST['category_name'];
            $image = $_FILES['image'];
    
            $oldCategoryName = $this->category->getOldCategoryName($categoryId);
            if ($categoryName !== $oldCategoryName && $this->category->isCategoryExists($categoryName)) {
                echo '<div class="message">Tên danh mục đã tồn tại. Vui lòng chọn tên khác.</div>';
                exit;
            }
    
            $oldImageName = $this->category->getOldImage($categoryId);
            $imageName = $oldImageName; 
    
            if ($image['error'] === 0) {
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $imageExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    
                if (!in_array($imageExtension, $allowedExtensions)) {
                    echo '<div class="message">Định dạng hình ảnh không hợp lệ. Chỉ chấp nhận jpg, jpeg, png, gif.</div>';
                    exit;
                }
    
                $uploadDir = 'asset/image/category/';
                $imageName = time() . '_' . basename($image['name']);
                $uploadFile = $uploadDir . $imageName;
    
                if (!move_uploaded_file($image['tmp_name'], $uploadFile)) {
                    echo '<div class="message">Có lỗi trong quá trình tải lên hình ảnh.</div>';
                    exit;
                }
            }
    
            if ($this->category->update($categoryId, $categoryName, $imageName)) {
                echo '<div class="message">Danh mục đã được cập nhật thành công!</div>';
            } else {
                echo '<div class="message">Có lỗi xảy ra khi cập nhật danh mục vào CSDL.</div>';
            }
            exit;
        }
    }
    public function getCategoryByIdController($categoryId) {
        return $this->category->getCategoryById($categoryId);
    }

}
    $controller = new CategoryController();
    $controller->handleRequest();
?>
