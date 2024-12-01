<?php
include_once('ConnectDatabase.php');

class Category extends ConnectDatabase
{
    private $conn;
    public function __construct()
    {
        parent::__construct(); 
        $this->conn = $this->getConnection(); 
    }

    public function getAllCategory()
    {
        $query = "SELECT * FROM categories";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }
    public function addCategory($categoryName, $imageName) {
        // Giá trị mặc định cho status
        $status = '1'; 
    
        if ($imageName) {
            // Nếu có hình ảnh
            $stmt = $this->conn->prepare("INSERT INTO categories (category_name, image, status) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $categoryName, $imageName, $status); // 'sss' cho 3 chuỗi
        } else {
            // Nếu không có hình ảnh
            $stmt = $this->conn->prepare("INSERT INTO categories (category_name, status) VALUES (?, ?)");
            $stmt->bind_param("ss", $categoryName, $status); // 'ss' cho 2 chuỗi
        }
    
        // Thực hiện câu lệnh
        if ($stmt->execute()) {
            return true; // Trả về true nếu thành công
        } else {
            // Ghi lại lỗi để kiểm tra
            error_log("Lỗi khi thêm danh mục: " . $stmt->error);
            return false; // Trả về false nếu có lỗi
        }
    }
    public function deleteCategory($categoryId) {
        // Lấy thông tin danh mục từ cơ sở dữ liệu
        $stmt = $this->conn->prepare("SELECT image FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imagePath = 'asset/image/category/' . $row['image'];
    
            // Xóa file ảnh nếu tồn tại
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa file ảnh
            }
        }
    
        // Xóa danh mục khỏi cơ sở dữ liệu
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $categoryId);
    
        if ($stmt->execute()) {
            return true; // Thành công
        } else {
            error_log("Lỗi khi xóa danh mục: " . $stmt->error);
            return false; // Thất bại
        }
    }
    public function isCategoryExists($categoryName) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM categories WHERE category_name = ?");
        $stmt->bind_param("s", $categoryName);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        return $count > 0; // Trả về true nếu tồn tại
    }
    public function update($categoryId, $categoryName, $image = null) {
        $stmt = $this->conn->prepare("UPDATE categories SET category_name = ?, image = ? WHERE category_id = ?");
        $stmt->bind_param("ssi", $categoryName, $image, $categoryId);
        
        return $stmt->execute(); // Trả về true nếu cập nhật thành công
    }
    public function getOldImage($categoryId) {
        $stmt = $this->conn->prepare("SELECT image FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $stmt->bind_result($image);
        $stmt->fetch();
        return $image; // Trả về tên hình ảnh cũ
    }
    public function getOldCategoryName($categoryId) {
        $stmt = $this->conn->prepare("SELECT category_name FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $stmt->bind_result($name);
        if ($stmt->fetch()) {
            return $name; // Trả về tên danh mục cũ
        }
        return null;
    }
    public function getCategoryById($categoryId) {
        $query = "SELECT category_name FROM categories WHERE category_id = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $categoryId); 
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); 
        } else {
            return null; // Không tìm thấy danh mục
        }
    }
    public function hasSubcategories($categoryId) {
        $query = "SELECT COUNT(*) AS count FROM category_items WHERE category_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $categoryId); 
        $stmt->execute();
        
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0; 
    }
}
