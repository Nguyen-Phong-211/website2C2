<?php
include_once('ConnectDatabase.php');

class Product extends ConnectDatabase
{
    private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }
    //get all product
    public function getAllProduct()
    {
        $query = "SELECT *, w.status AS wstatus FROM products AS p 
                    LEFT JOIN whistlists AS w ON p.product_id = w.product_id 
                    LEFT JOIN reviews AS r ON p.product_id = r.product_id 
                    LEFT JOIN ( SELECT product_id, image_name FROM images GROUP BY product_id ) AS i 
                        ON i.product_id = p.product_id 
                    WHERE p.quantity >= 1";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //join reviews
    public function getAllProductWithReviews()
    {
        $query = "
        SELECT 
            p.*, 
            w.whistlist_id,
            GROUP_CONCAT(DISTINCT w.status) AS wstatus, 
            GROUP_CONCAT(DISTINCT r.product_id) AS reviews, 
            GROUP_CONCAT(DISTINCT r.rating_star) AS rating_star, 
            i.image_name AS image_name
        FROM products AS p
        LEFT JOIN whistlists AS w ON p.product_id = w.product_id 
        LEFT JOIN reviews AS r ON p.product_id = r.product_id 
        LEFT JOIN images AS i ON i.product_id = p.product_id
        WHERE p.quantity >= 1
        GROUP BY p.product_id
        LIMIT 10;
        ";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //join hightly appreciated
    public function getAllFavoriteProduct()
    {
        $query = "
            SELECT 
            p.*, w.whistlist_id,
            GROUP_CONCAT(DISTINCT w.status) AS wstatus, 
            GROUP_CONCAT(DISTINCT r.product_id) AS reviews, 
            GROUP_CONCAT(DISTINCT r.rating_star) AS rating_star, 
            COALESCE(i.image_name, 'default_image.jpg') AS image_name  
        FROM products AS p
        LEFT JOIN whistlists AS w ON p.product_id = w.product_id 
        LEFT JOIN reviews AS r ON p.product_id = r.product_id 
        LEFT JOIN (
            SELECT product_id, image_name
            FROM images
            ORDER BY image_name  
        ) AS i ON i.product_id = p.product_id 
        WHERE p.quantity >= 1
        GROUP BY p.product_id
        ORDER BY p.product_id DESC
        ";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //get product by hight view
    public function getProductByHightView()
    {
        $query = "SELECT * FROM products WHERE view >= 5 AND quantity >= 1 LIMIT 7 ";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //count product
    public function countProduct()
    {
        $query = "SELECT COUNT(*) as total FROM products WHERE quantity >= 1";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    //get product_name by id
    public function getNameProductById($id)
    {
        $query = "SELECT product_name FROM products WHERE product_id = '$id' AND quantity >= 1";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        $row = $result->fetch_assoc();
        return $row['product_name'];
    }
    //get product by id
    public function getProductById($id)
    {
        $query = "SELECT * FROM products WHERE product_id = '$id' AND quantity >= 1";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //get category_attribute by category_attribute_id
    public function getCategoryAttribute()
    {
        $query = "SELECT * FROM category_attributes";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //get product by category_id
    public function getProductByCategory($categoryId)
    {
        $query = "
            SELECT 
                p.product_id,
                p.product_name,
                p.quantity,
                p.price,
                p.status,
                p.discount,
                p.description,
                p.address,
                c.category_name,
                c.category_id,
                i.image_name,
                r.content,
                r.rating_star,
                r.status AS review_status,
                w.status AS wstatus,
                w.whistlist_id,
                ci.category_item_name,
                COUNT(r.review_id) AS total_reviews,
                MAX(i.image_id) AS total_image_by_product_id
            FROM 
                products AS p
            LEFT JOIN 
                category_items AS ci ON p.category_item_id = ci.category_item_id
            LEFT JOIN 
                categories AS c ON c.category_id = ci.category_id
            LEFT JOIN 
                images AS i ON p.product_id = i.product_id
            LEFT JOIN 
                reviews AS r ON r.product_id = p.product_id
            LEFT JOIN 
                whistlists AS w ON p.product_id = w.product_id
            WHERE 
                c.category_id = '$categoryId' AND p.quantity >= 1
            GROUP BY 
                p.product_id, 
                p.product_name, 
                c.category_name, 
                ci.category_item_name, 
                w.status, 
                w.whistlist_id;
        ";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //get product hightly appreciated
    public function getProductHightlyAppreciated()
    {
        $query = "
            SELECT *, w.status AS wstatus FROM products AS p 
                LEFT JOIN whistlists AS w ON p.product_id = w.product_id 
                LEFT JOIN reviews AS r ON p.product_id = r.product_id  
                LEFT JOIN ( SELECT product_id, image_name FROM images GROUP BY product_id ) AS i ON i.product_id = p.product_id 
                WHERE r.rating_star >= 4 AND p.quantity >= 1;
        ";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //get product sell out
    public function getProductSellOut()
    {
        $query = "
            SELECT *, w.status AS wstatus FROM products AS p 
                LEFT JOIN whistlists AS w ON p.product_id = w.product_id 
                LEFT JOIN reviews AS r ON p.product_id = r.product_id  
                LEFT JOIN (SELECT product_id, image_name FROM images GROUP BY product_id) AS i ON i.product_id = p.product_id 
                WHERE p.quantity = 1";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }

    //find product by price
    public function findProductByPrice($priceFrom, $priceTo)
    {
        $stmt = $this->conn->prepare("SELECT 
                                                p.product_id, 
                                                p.product_name, 
                                                p.quantity, 
                                                p.price, 
                                                p.status, 
                                                p.discount, 
                                                p.description, 
                                                p.address, 
                                                c.category_name, 
                                                ci.category_item_name, 
                                                w.status AS wstatus, 
                                                w.whistlist_id,
                                                r.content, 
                                                r.rating_star, 
                                                COUNT(r.review_id) AS total_reviews, 
                                                i.image_name  
                                            FROM 
                                                products AS p
                                            LEFT JOIN 
                                                category_items AS ci ON p.category_item_id = ci.category_item_id
                                            LEFT JOIN 
                                                categories AS c ON c.category_id = ci.category_id
                                            LEFT JOIN 
                                                (
                                                    SELECT product_id, image_name
                                                    FROM images
                                                    WHERE image_id IN (SELECT MIN(image_id) FROM images GROUP BY product_id)
                                                ) AS i ON p.product_id = i.product_id
                                            LEFT JOIN 
                                                reviews AS r ON r.product_id = p.product_id
                                            LEFT JOIN 
                                                whistlists AS w ON p.product_id = w.product_id
                                            WHERE 
                                            
                                                p.quantity >= 1  
                                                AND p.price BETWEEN ? AND ?
                                            GROUP BY 
                                                p.product_id, 
                                                p.product_name, 
                                                p.quantity, 
                                                p.price, 
                                                p.status, 
                                                p.discount, 
                                                p.description, 
                                                p.address, 
                                                c.category_name, 
                                                ci.category_item_name, 
                                                w.status, 
                                                w.whistlist_id, 
                                                r.rating_star, 
                                                i.image_name;
                                            ");

        $stmt->bind_param("ii", $priceFrom, $priceTo);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }
    //get product by category_item_id
    public function getProductByCategoryItem($categoryId, $categoryItemId)
    {
        $stmt = $this->conn->prepare("
        SELECT 
                p.product_id,
                p.product_name,
                p.quantity,
                p.price,
                p.status,
                p.discount,
                p.description,
                p.address,
                c.category_name,
                c.category_id,
                i.image_name,
                r.content,
                r.rating_star,
                r.status AS review_status,
                w.status AS wstatus,
                w.whistlist_id,
                ci.category_item_name,
                COUNT(r.review_id) AS total_reviews,
                MAX(i.image_id) AS total_image_by_product_id
            FROM 
                products AS p
            LEFT JOIN 
                category_items AS ci ON p.category_item_id = ci.category_item_id
            LEFT JOIN 
                categories AS c ON c.category_id = ci.category_id
            LEFT JOIN 
                images AS i ON p.product_id = i.product_id
            LEFT JOIN 
                reviews AS r ON r.product_id = p.product_id
            LEFT JOIN 
                whistlists AS w ON p.product_id = w.product_id
            WHERE 
                c.category_id = ? AND p.quantity >= 1 AND p.category_item_id = ?
            GROUP BY 
                p.product_id, 
                p.product_name, 
                c.category_name, 
                ci.category_item_name, 
                w.status, 
                w.whistlist_id;
        ");

        $stmt->bind_param("ii", $categoryId, $categoryItemId);
        if ($stmt->execute()) {
            $result =  $stmt->get_result();
            $stmt->close();
            return $result;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }
    //search by product name
    public function searchProduct($keyword)
    {
        $query = "SELECT 
                    COUNT(*) AS total, 
                    p.product_id, 
                    p.product_name, 
                    p.quantity, 
                    p.price, 
                    p.status, 
                    p.discount, 
                    p.description, 
                    p.address, 
                    w.status AS wstatus, 
                    w.whistlist_id,
                    r.content, 
                    r.rating_star, 
                    r.status AS review_status, 
                    i.image_name
                FROM 
                    products AS p
                LEFT JOIN 
                    whistlists AS w ON p.product_id = w.product_id 
                LEFT JOIN 
                    reviews AS r ON p.product_id = r.product_id  
                LEFT JOIN 
                    (SELECT product_id, MAX(image_name) AS image_name FROM images GROUP BY product_id) AS i 
                    ON i.product_id = p.product_id
                WHERE 
                    p.product_name LIKE ?
                    AND p.quantity >= 1
                GROUP BY 
                    p.product_id, 
                    p.product_name, 
                    p.quantity, 
                    p.price, 
                    p.status, 
                    p.discount, 
                    p.description, 
                    p.address, 
                    w.status, 
                    r.content, 
                    r.rating_star, 
                    r.status, 
                    i.image_name; ";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }
        $searchTerm = "%$keyword%";
        $stmt->bind_param("s", $searchTerm);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result === false) {
            error_log("Query failed: " . $stmt->error);
            return false;
        }
        return $result;
    }

    //get product by rating_star
    public function getProductByRating($ratingStar)
    {
        $query = "SELECT 
                    COUNT(*) AS total, 
                    p.product_id, 
                    p.product_name, 
                    p.quantity, 
                    p.price, 
                    p.status, 
                    p.discount, 
                    p.description, 
                    p.address, 
                    w.status AS wstatus, 
                    w.whistlist_id,
                    r.content, 
                    r.rating_star, 
                    r.status AS review_status, 
                    i.image_name
                FROM 
                    products AS p
                LEFT JOIN 
                    whistlists AS w ON p.product_id = w.product_id 
                LEFT JOIN 
                    reviews AS r ON p.product_id = r.product_id  
                LEFT JOIN 
                    (SELECT product_id, MAX(image_name) AS image_name FROM images GROUP BY product_id) AS i 
                    ON i.product_id = p.product_id
                WHERE 
                    r.rating_star =?
                    AND p.quantity >= 1
                GROUP BY
                p.product_id, 
                    p.product_name, 
                    p.quantity, 
                    p.price, 
                    p.status,
                    p.discount, 
                    p.description, 
                    p.address, 
                    w.status, 

                    r.rating_star, 
                    r.status, 
                    i.image_name";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }
        $stmt->bind_param("i", $ratingStar);

        $stmt->execute();
        $result = $stmt->get_result();
        if ($result === false) {
            error_log("Query failed: " . $stmt->error);
            return false;
        }
        return $result;
    }
    //update view product_id
    public function updateViewCount($productId)
    {
        $query = "UPDATE products SET view = view + 1 WHERE product_id =?";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }
        $stmt->bind_param("i", $productId);

        $stmt->execute();
        $stmt->close();
        return true;
    }
    //get discount by product_id
    public function getDiscountByProductId($productId)
    {
        $query = "SELECT discount FROM products WHERE product_id =?";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }
        $stmt->bind_param("i", $productId);

        $stmt->execute();
        $result = $stmt->get_result();
        if ($result === false) {
            error_log("Query failed: " . $stmt->error);
            return false;
        }
        $row = $result->fetch_assoc();
        return $row['discount'];
    }
    public function getOwnerByProductId($product_id)
    {
        $query = "SELECT user_id FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row['user_id'];
        }
        return null; // Trường hợp không tìm thấy
    }
    //get all product by user_id
    public function getAllProductByUserId($userId)
    {
        $query = "SELECT p.*, GROUP_CONCAT(i.image_name) AS image_name
                        FROM products AS p
                        LEFT JOIN users AS u ON p.user_id = u.user_id
                        LEFT JOIN roles AS rl ON rl.role_id = u.role_seller_id
                        LEFT JOIN images AS i ON i.product_id = p.product_id
                        WHERE u.role_seller_id = 1 AND p.user_id = ?
                        GROUP BY p.product_id;
                        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
    //update product by user_id
    public function updateProduct($product_id, $product_name, $product_price, $product_description, $address, $quantity, $imagePaths = [])
    {
        // Bắt đầu transaction
        $this->conn->begin_transaction();

        try {
            // Cập nhật thông tin sản phẩm
            $updateProductQuery = "
            UPDATE products 
            SET product_name = ?, price = ?, description = ?, address = ?, quantity = ? 
            WHERE product_id = ?
        ";

            $stmt = $this->conn->prepare($updateProductQuery);
            $stmt->bind_param("sdssii", $product_name, $product_price, $product_description, $address, $quantity, $product_id);

            if (!$stmt->execute()) {
                throw new Exception("Error updating product: " . $stmt->error);
            }

            // Kiểm tra xem có thay đổi không
            if ($stmt->affected_rows == 0) {
                // Không có thay đổi nào
                return "Không có thay đổi!";
            }

            // Nếu có hình ảnh mới, xóa các hình ảnh cũ và thêm mới
            if (!empty($imagePaths)) {
                // Xóa các hình ảnh cũ chỉ khi có hình ảnh mới được upload
                $deleteImagesQuery = "DELETE FROM images WHERE product_id = ?";
                $stmt = $this->conn->prepare($deleteImagesQuery);
                $stmt->bind_param("i", $product_id);
                if (!$stmt->execute()) {
                    throw new Exception("Error deleting images: " . $stmt->error);
                }

                // Thêm các hình ảnh mới
                $insertImageQuery = "INSERT INTO images (product_id, image_name, create_at, update_at) VALUES (?, ?, NOW(), NOW())";
                foreach ($imagePaths as $image) {
                    $stmt = $this->conn->prepare($insertImageQuery);
                    $stmt->bind_param("is", $product_id, $image);
                    if (!$stmt->execute()) {
                        throw new Exception("Error inserting image: " . $stmt->error);
                    }
                }
            }

            // Commit transaction
            $this->conn->commit();
            return "Cập nhật sản phẩm thành công!";
        } catch (Exception $e) {
            // Rollback transaction nếu có lỗi
            $this->conn->rollback();
            return "Lỗi: " . $e->getMessage();
        }
    }
}
