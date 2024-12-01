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
        SELECT *, w.status AS wstatus FROM products AS p 
            LEFT JOIN whistlists AS w ON p.product_id = w.product_id 
            LEFT JOIN reviews AS r ON p.product_id = r.product_id 
            LEFT JOIN ( SELECT product_id, image_name FROM images GROUP BY product_id ) AS i 
                ON i.product_id = p.product_id 
            WHERE p.quantity >= 1 
            ORDER BY RAND() 
            LIMIT 10;
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
        $query = "SELECT COUNT(*) as total FROM products WHERE quantity >= 1" ;
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
            die("Query failed: ". $this->conn->error);
        }
        return $result;
    }

    //find product by price
    public function findProductByPrice($priceFrom, $priceTo){
        $stmt = $this->conn->prepare("SELECT 
                                                p.*, 
                                                w.status AS wstatus, 
                                                i.image_name, 
                                                r.content, 
                                                r.rating_star, 
                                                COUNT(r.review_id) AS total_reviews 
                                            FROM 
                                                products AS p
                                            LEFT JOIN 
                                                whistlists AS w ON p.product_id = w.product_id
                                            LEFT JOIN 
                                                reviews AS r ON p.product_id = r.product_id
                                            LEFT JOIN 
                                                (SELECT product_id, MIN(image_name) AS image_name FROM images GROUP BY product_id) AS i 
                                                ON i.product_id = p.product_id
                                            WHERE 
                                                p.quantity >= 1 AND p.price BETWEEN ? AND ?
                                            GROUP BY 
                                                p.product_id, w.status, i.image_name");

        $stmt->bind_param("ii", $priceFrom, $priceTo);
        if ($stmt->execute()) {
            $stmt->get_result();
            $stmt->close();
            return true;
        } else {
            echo "Error: " . $stmt->error;
            return false;
        }
    }
}
