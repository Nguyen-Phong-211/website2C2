<?php
include_once('ConnectDatabase.php');

class CategoryItem extends ConnectDatabase
{
    private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }
    //get all product in category
    public function getAllListCategoryItemByCategory($categoryId)
    {
        $query = "SELECT * FROM category_items WHERE category_id = '$categoryId'";
        $result = $this->conn->query($query);
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //join categories table
    public function joinCategoriesTable()
    {
        $query = "SELECT c.category_name, c.category_id, ci.category_item_name, ci.category_item_id FROM category_items ci INNER JOIN categories c ON ci.category_id = c.category_id";
        $result = $this->conn->query($query);
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //get category_name by category_id and category_item_id
    public function getCategoryNameByCategoryItemId($categoryId, $categoryItemId)
    {
        $query = "SELECT category_item_name FROM category_items WHERE category_id = ? AND category_item_id = ?";
        
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param("ii", $categoryId, $categoryItemId); 
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['category_item_name'];
            } else {
                return false;
            }
        } else {
            echo "Có lỗi xảy ra khi chuẩn bị câu lệnh.";
            return false;
        }
    }
    public function addCategoryItem($name, $categoryId, $imagePath, $status = '1') {
        // Gán giá trị null nếu không có hình ảnh
        if (empty($imagePath)) {
            $imagePath = null; // Gán null nếu không có hình ảnh
        }
        $query = "INSERT INTO category_items (category_item_name, category_id, image, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            die("Lỗi chuẩn bị câu lệnh: " . $this->conn->error);
        }
    
        $stmt->bind_param("siss", $name, $categoryId, $imagePath, $status);
        return $stmt->execute(); // Trả về true nếu thành công
    }
    public function isCategoryItemExists($categoryName, $categoryId) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM category_items WHERE category_item_name = ? AND category_id = ?");
        $stmt->bind_param("si", $categoryName, $categoryId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0; // Trả về true nếu tồn tại
    }
    public function deleteCategoryItem($categoryItemId) {
        // Lấy thông tin danh mục từ cơ sở dữ liệu
        $stmt = $this->conn->prepare("SELECT image FROM category_items WHERE category_item_id = ?");
        $stmt->bind_param("i", $categoryItemId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imagePath = 'asset/image/category_item/' . $row['image'];
    
            // Xóa file ảnh nếu tồn tại
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa file ảnh
            }
        }
    
        // Xóa danh mục khỏi cơ sở dữ liệu
        $stmt = $this->conn->prepare("DELETE FROM category_items WHERE category_item_id = ?");
        $stmt->bind_param("i", $categoryItemId);
    
        if ($stmt->execute()) {
            return true; // Thành công
        } else {
            error_log("Lỗi khi xóa danh mục con: " . $stmt->error);
            return false; // Thất bại
        }
    }
    public function update($categoryItemId, $categoryItemName, $image = null) {
        if ($image === null) {
            $stmt = $this->conn->prepare("UPDATE category_items SET category_item_name = ? WHERE category_item_id = ?");
            $stmt->bind_param("si", $categoryItemName, $categoryItemId);
        } else {
            $stmt = $this->conn->prepare("UPDATE category_items SET category_item_name = ?, image = ? WHERE category_item_id = ?");
            $stmt->bind_param("ssi", $categoryItemName, $image, $categoryItemId);
        }
        return $stmt->execute(); 
    }
    public function getImageById($categoryItemId) {
        $stmt = $this->conn->prepare("SELECT image FROM category_items WHERE category_item_id = ?");
        $stmt->bind_param("i", $categoryItemId);
        $stmt->execute();
        $stmt->bind_result($image);
        $stmt->fetch();
        return $image; // Trả về tên hình ảnh
    }
    public function getOldCategoryItemName($categoryItemId) {
        $stmt = $this->conn->prepare("SELECT category_item_name FROM category_items WHERE category_item_id = ?");
        $stmt->bind_param("i", $categoryItemId);
        $stmt->execute();
        $stmt->bind_result($name);
        if ($stmt->fetch()) {
            return $name; // Trả về tên danh mục cũ
        }
        return null;
    }
    public function hasProducts($categoryitemId) {
        $query = "SELECT COUNT(*) AS count FROM products WHERE category_item_id = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $categoryitemId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0; 
    }
    public function getCategoryItemById($categoryItemId) {
        $query = "SELECT category_item_name FROM category_items WHERE category_item_id = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $categoryItemId); 
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); 
        } else {
            return null; 
        }
    }
    public function getCategoryItemId($categoryItemId) {
        $query = "SELECT category_id FROM category_items WHERE category_item_id = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $categoryItemId); 
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); 
            return $row['category_id']; 
        } else {
            return null; 
        }
    }
}
