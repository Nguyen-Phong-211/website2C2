<?php
include_once('model/CategoryItem.php');

class CategoryItemController
{
    private $categoryItem;
    public function __construct()
    {
        $this->categoryItem = new CategoryItem();
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
            // Lấy dữ liệu từ form
            $categoryItemName = $_POST['categoryItem_name'];
            $categoryId = intval($_GET['category_id']);
            $image = $_FILES['image'];
    
            $imageName = null;
    
            // Kiểm tra định dạng hình ảnh
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $imageExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    
            if ($this->categoryItem->isCategoryItemExists($categoryItemName, $categoryId)) {
                $_SESSION['message'] = "Tên danh mục con đã tồn tại!";
                header("Location: index.php?page=managerCategoryItem&category_id=$categoryId");
                exit;
            }
            if ($image['error'] === 0) {
                if (!in_array($imageExtension, $allowedExtensions)) {
                    $_SESSION['message'] = "Định dạng hình ảnh không hợp lệ!";
                    header("Location: index.php?page=managerCategoryItem&category_id=$categoryId");
                    exit;
                }
    
                $uploadDir = 'asset/image/category_item/';
                $imageName = time() . '_' . basename($image['name']); 
                $uploadFile = $uploadDir . $imageName;
    
                if (!move_uploaded_file($image['tmp_name'], $uploadFile)) {
                    $_SESSION['message'] = "Có lỗi trong quá trình tải lên hình ảnh.";
                    header("Location: index.php?page=managerCategoryItem&category_id=$categoryId");
                    exit;
                }
            }
    
            // Gọi phương thức thêm vào model, chỉ truyền tên hình ảnh đã lưu
            $this->categoryItem->addCategoryItem($categoryItemName, $categoryId, $imageName, 1); 
            $_SESSION['message'] = "Thêm danh mục con thành công!";
            
            // Chuyển hướng về trang danh mục con
            header("Location: index.php?page=managerCategoryItem&category_id=$categoryId");
            exit;
        }
    }
    //get all product in category
    public function getAllListCategoryItemByCategoryController($categoryId)
    {
        $result = $this->categoryItem->getAllListCategoryItemByCategory($categoryId);

        if (!$result) {
            die("Failed to retrieve product list: " . $this->categoryItem->getConnection()->error);
        }
        return $result;
    }
    //join categoies table

    public function joinCategoriesTableController()
    {
        $result = $this->categoryItem->joinCategoriesTable();

        if (!$result) {
            die("Failed to retrieve category list: " . $this->categoryItem->getConnection()->error);
        }
        return $result;
    }
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $categoryitemId = $_GET['id'];
    
            if ($this->categoryItem->hasProducts($categoryitemId)) {
                $_SESSION['message'] = 'Không thể xóa danh mục con vì nó chứa sản phẩm.';
            } else {
                if ($this->categoryItem->deleteCategoryItem($categoryitemId)) {
                    $_SESSION['message'] = 'Xóa danh mục con thành công!';
                } else {
                    $_SESSION['message'] = 'Không thể xóa danh mục con.';
                }
            }
    
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $categoryItemId = intval($_POST['category_item_id']);
            $categoryItemName = $_POST['category_item_name'];
            $categoryId = intval($_GET['category_id']);
            $image = $_FILES['image'];
            
            $oldCategoryItemName = $this->categoryItem->getOldCategoryItemName($categoryItemId);
            if ($categoryItemName !== $oldCategoryItemName && $this->categoryItem->isCategoryItemExists($categoryItemName, $categoryId)) {
                $_SESSION['message'] = "Tên danh mục con đã tồn tại!";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
            $oldImageName = $this->categoryItem->getImageById($categoryItemId);
            $newImageName = $oldImageName; // Giả định hình ảnh cũ trước
    
            // Kiểm tra định dạng hình ảnh
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $imageExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    
            // Kiểm tra xem có hình ảnh mới không
            if ($image['error'] === 0) {
                if (!in_array($imageExtension, $allowedExtensions)) {
                    $_SESSION['message'] = "Định dạng hình ảnh không hợp lệ!";
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit;
                }
    
                $uploadDir = 'asset/image/category_item/';
                $newImageName = time() . '_' . basename($image['name']); 
                $uploadFile = $uploadDir . $newImageName;
    
                if (!move_uploaded_file($image['tmp_name'], $uploadFile)) {
                    $_SESSION['message'] = "Có lỗi trong quá trình tải lên hình ảnh.";
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit;
                }
            }
    
            // Gọi phương thức cập nhật vào model
            $this->categoryItem->update($categoryItemId, $categoryItemName, $newImageName);
    
            
            $_SESSION['message'] = "Cập nhật thành công";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
    public function getCategoryItemById($categoryItemId) {
        return $this->categoryItem->getCategoryItemById($categoryItemId);
    }
    public function getCategoryItemId($categoryItemId) {
        return $this->categoryItem->getCategoryItemId($categoryItemId);
    }
}
    $controller = new CategoryItemController();
    $controller->handleRequest();

