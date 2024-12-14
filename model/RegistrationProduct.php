<?php
include_once('ConnectDatabase.php');

class RegistrationProduct extends ConnectDatabase
{
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    // Get all product in category
    public function getAllListCategoryItemByCategory($categoryId)
    {
        $query = "SELECT * FROM category_items WHERE category_id = '$categoryId'";
        $result = $this->conn->query($query);
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }

    // Join categories table
    public function joinCategoriesTable()
    {
        $query = "SELECT c.category_name, c.category_id, ci.category_item_name, ci.category_item_id FROM category_items ci INNER JOIN categories c ON ci.category_id = c.category_id";
        $result = $this->conn->query($query);
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }

    private function getCategoryShortName($categoryName)
    {
        $words = explode(' ', $categoryName);
        $shortName = '';
        foreach ($words as $word) {
            $shortName .= mb_substr($word, 0, 1); // Get first letter of each word
        }
        return strtolower($shortName); // Convert to lowercase
    }

    // Register a new product
    public function registerProduct($data, $files)
    {
        $this->conn->begin_transaction(); // Start transaction
        try {
            // Insert product into registration_products
            $stmt = $this->conn->prepare(
                "INSERT INTO registration_products 
                (`category_id`, `company_id`, `category_item_id`, `user_id`, `warranty_policy_id`, `status_product_id`, `title`, 
                `price`, `quantity`, `description`, `address`, `create_at`, `update_at`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())"
            );

            $stmt->bind_param(
                "iiiiiisdiss",
                $data['category_id'],
                $data['company_id'],
                $data['category_item_id'],
                $data['user_id'],
                $data['warranty_policy_id'],
                $data['status_product_id'],
                $data['title'],
                $data['price'],
                $data['quantity'],
                $data['description'],
                $data['address']
            );

            if (!$stmt->execute()) {
                throw new Exception("Failed to insert product: " . $stmt->error);
            }

            $registrationProductId = $stmt->insert_id;

            // Insert attributes into registration_product_attributes
            if (isset($data['attributes']) && is_array($data['attributes'])) {
                foreach ($data['attributes'] as $categoryAttributeId => $attributeId) {
                    if (empty($categoryAttributeId) || empty($attributeId)) {
                        continue; // Skip if any attribute is empty
                    }

                    // Prepare SQL to insert attribute
                    $attributeStmt = $this->conn->prepare(
                        "INSERT INTO registration_product_attributes 
                                (`attribute_id`, `registration_product_id`, `category_attribute_id`) 
                                VALUES (?, ?, ?)"
                    );

                    if (!$attributeStmt) {
                        throw new Exception("Failed to prepare statement for attributes: " . $this->conn->error);
                    }

                    // Bind parameters and execute statement
                    $attributeStmt->bind_param("iii", $attributeId, $registrationProductId, $categoryAttributeId);

                    if (!$attributeStmt->execute()) {
                        throw new Exception("Failed to insert attribute: " . $attributeStmt->error);
                    }
                }
            } else {
                throw new Exception("Attributes data is missing or not properly structured.");
            }

            // Handle image uploads and insert into images table
            $imageCount = 0;
            foreach ($files['imageUpload']['tmp_name'] as $index => $tmpName) {
                if (!empty($tmpName) && $imageCount < 6) { // Limit to 6 images
                    $imageCount++;

                    // Process product title to create image name
                    $imageName = $this->processProductName($data['title']) . "-{$imageCount}.png";

                    $targetFilePath = "./asset/image/product/" . $imageName;

                    if (!move_uploaded_file($tmpName, $targetFilePath)) {
                        throw new Exception("Failed to upload image: " . $imageName);
                    }

                    $imageStmt = $this->conn->prepare(
                        "INSERT INTO images (`image_name`, `user_id`, `registration_product_id`, `create_at`, `update_at`) 
                        VALUES (?, ?, ?, NOW(), NOW())"
                    );

                    $imageStmt->bind_param("sii", $imageName, $data['user_id'], $registrationProductId);

                    if (!$imageStmt->execute()) {
                        throw new Exception("Failed to insert image: " . $imageStmt->error);
                    }
                }
            }

            // Handle video upload and insert into video_products table
            if (!empty($files['videoUpload']['tmp_name'])) {
                $videoName = $this->processProductName($data['title']);
                $targetVideoPath = "./asset/image/product/" . $videoName;

                if (!move_uploaded_file($files['videoUpload']['tmp_name'], $targetVideoPath)) {
                    throw new Exception("Failed to upload video: " . $videoName);
                }

                $videoStmt = $this->conn->prepare(
                    "INSERT INTO video_products (`registration_product_id`, `name_video`, `create_at`, `update_at`) 
                    VALUES (?, ?, NOW(), NOW())"
                );

                $videoStmt->bind_param("is", $registrationProductId, $videoName);

                if (!$videoStmt->execute()) {
                    throw new Exception("Failed to insert video: " . $videoStmt->error);
                }
            }

            $this->conn->commit(); // Commit transaction
            return "Product registered successfully!";
        } catch (Exception $e) {
            $this->conn->rollback(); // Rollback on error
            return "Error: " . $e->getMessage();
        }
    }

    // Process the product name: convert to lowercase, remove accents, replace spaces with underscores
    private function processProductName($productName)
    {
        // Convert to lowercase
        $productName = strtolower($productName);

        // Remove Vietnamese accents
        $replace = array(
            'á' => 'a',
            'à' => 'a',
            'ả' => 'a',
            'ã' => 'a',
            'ạ' => 'a',
            'ă' => 'a',
            'ắ' => 'a',
            'ằ' => 'a',
            'ẳ' => 'a',
            'ẵ' => 'a',
            'ặ' => 'a',
            'â' => 'a',
            'ấ' => 'a',
            'ầ' => 'a',
            'ẩ' => 'a',
            'ẫ' => 'a',
            'ậ' => 'a',
            'é' => 'e',
            'è' => 'e',
            'ẻ' => 'e',
            'ẽ' => 'e',
            'ẹ' => 'e',
            'ê' => 'e',
            'ế' => 'e',
            'ề' => 'e',
            'ể' => 'e',
            'ễ' => 'e',
            'ệ' => 'e',
            'í' => 'i',
            'ì' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',
            'ị' => 'i',
            'ó' => 'o',
            'ò' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ọ' => 'o',
            'ô' => 'o',
            'ố' => 'o',
            'ồ' => 'o',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ộ' => 'o',
            'ơ' => 'o',
            'ớ' => 'o',
            'ờ' => 'o',
            'ở' => 'o',
            'ỡ' => 'o',
            'ợ' => 'o',
            'ú' => 'u',
            'ù' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ụ' => 'u',
            'ư' => 'u',
            'ứ' => 'u',
            'ừ' => 'u',
            'ử' => 'u',
            'ữ' => 'u',
            'ự' => 'u',
            'ý' => 'y',
            'ỳ' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',
            'ỵ' => 'y',
            'đ' => 'd'
        );
        $productName = strtr($productName, $replace);
        // Replace spaces with underscores
        $productName = str_replace(' ', '-', $productName);

        return $productName;
    }
    //get all registration by role_seller_id = 1 and status = '0'
    public function getAllProductApproval()
    {
        $stmt = $this->conn->prepare("
                                        SELECT DISTINCT rp.registration_product_id, 
                                                        ci.category_item_id, 
                                                        c.category_id,         
                                                        rp.category_id, 
                                                        rp.company_id, 
                                                        rp.user_id, 
                                                        rp.warranty_policy_id, 
                                                        rp.title, 
                                                        rp.price, 
                                                        rp.quantity, 
                                                        rp.create_at, 
                                                        rp.status AS rpstatus, 
                                                        i.image_name, u.*,
                                                        c.category_name
                                        FROM registration_products AS rp
                                        JOIN users AS u ON rp.user_id = u.user_id
                                        LEFT JOIN roles AS rl ON u.role_seller_id = rl.role_id
                                        LEFT JOIN images AS i ON i.registration_product_id = rp.registration_product_id
                                        JOIN categories AS c ON rp.category_id = c.category_id
                                        JOIN category_items AS ci ON ci.category_item_id = rp.category_item_id
                                        JOIN companies AS cp ON cp.company_id = rp.company_id
                                        
                                        ORDER BY rp.create_at DESC;
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    //get name of level category
    public function getNameLevelCategory($regisId)
    {
        $stmt = $this->conn->prepare("SELECT c.category_name, ci.category_item_name, cp.company_name FROM registration_products AS rp 
                                                JOIN categories AS c ON c.category_id = rp.category_id
                                                JOIN category_items AS ci ON rp.category_item_id = ci.category_item_id
                                                JOIN companies AS cp ON rp.company_id = cp.company_id
                                            WHERE rp.registration_product_id = ?");

        $stmt->bind_param("i", $regisId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    //get info regis by registration_id
    public function getInfoRegisById($regisId)
    {
        $stmt = $this->conn->prepare("
        SELECT rp.*, wp.warranty_policy_name, st.status_product_name
        FROM registration_products AS rp
            JOIN warranty_policies AS wp ON wp.warranty_policy_id = rp.warranty_policy_id
            JOIN status_products AS st ON st.status_product_id = rp.status_product_id
            JOIN users AS u ON rp.user_id = u.user_id
            LEFT JOIN roles AS rl ON u.role_seller_id = rl.role_id
            JOIN categories AS c ON rp.category_id = c.category_id
            JOIN category_items AS ci ON ci.category_item_id = rp.category_item_id
            JOIN companies AS cp ON cp.company_id = rp.company_id
        WHERE rp.registration_product_id = ?
        ");
        $stmt->bind_param("i", $regisId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    //insert into product, images, registration_products
    public function insertProductData($regisId)
    {
        // Bắt đầu transaction
        $this->conn->begin_transaction();

        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO products (
                product_name, quantity, price, description, category_item_id, 
                company_id, status_product_id, warranty_policy_id, user_id, 
                category_attribute_id, attribute_id, address
            )
            SELECT rp.title, rp.quantity, rp.price, rp.description, rp.category_item_id, 
                   rp.company_id, rp.status_product_id, rp.warranty_policy_id, rp.user_id, 
                   NULL, NULL, rp.address 
            FROM registration_products AS rp 
            WHERE rp.registration_product_id = ?"
            );

            $stmt->bind_param("i", $regisId); 
            if (!$stmt->execute()) {
                throw new Exception("Error inserting into products: " . $stmt->error);
            }

            $newProductId = $this->conn->insert_id;

            $imageStmt = $this->conn->prepare(
                "INSERT INTO images (product_id, image_name, create_at, update_at)
            SELECT ?, i.image_name, NOW(), NOW()
            FROM images i
            JOIN registration_products rp ON i.registration_product_id = rp.registration_product_id
            WHERE rp.registration_product_id = ?"
            );

            $imageStmt->bind_param("ii", $newProductId, $regisId);
            if (!$imageStmt->execute()) {
                throw new Exception("Error inserting into images: " . $imageStmt->error);
            }

            $attrStmt = $this->conn->prepare(
                "INSERT INTO product_attributes (product_id, category_attribute_id, attribute_id)
            SELECT ?, rpa.category_attribute_id, rpa.attribute_id
            FROM registration_product_attributes rpa
            JOIN registration_products rp ON rp.registration_product_id = rpa.registration_product_id
            WHERE rp.registration_product_id = ?"
            );

            $attrStmt->bind_param("ii", $newProductId, $regisId);
            if (!$attrStmt->execute()) {
                throw new Exception("Error inserting into product_attributes: " . $attrStmt->error);
            }

            //update status registration_product
            $statusRegis = $this->conn->prepare("UPDATE registration_products SET status = '1' WHERE  registration_product_id = ?");
            $statusRegis->bind_param("i", $regisId);
            if (!$statusRegis->execute()) {
                throw new Exception("Error updating registration_products: " . $statusRegis->error);
            }

            $this->conn->commit();
            return "Data inserted successfully!";
        } catch (Exception $e) {
            $this->conn->rollback();
            return "Error: " . $e->getMessage();
        }
    }
    //reason for refusal
    public function updateReasonRefusal($regisId, $content){
        $stmt = $this->conn->prepare("UPDATE registration_products  SET reason_for_refusal = ?, status = '2' WHERE registration_product_id = ?");
        $stmt->bind_param("si", $content, $regisId);
        if ($stmt === false) {
            error_log("Prepare failed: ". $this->conn->error);
            return false;
        }
        $stmt->execute();
        return true;
    }
    //get status registration_product
    public function getStatusRegis($regisId)
    {
        $stmt = $this->conn->prepare("SELECT status, reason_for_refusal FROM registration_products WHERE registration_product_id = ?");
        $stmt->bind_param("i", $regisId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    //update role_seller_id
    public function updateRoleSeller($email){
        $stmt = $this->conn->prepare("UPDATE users SET role_seller_id = '1' WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return true;
    }
}
