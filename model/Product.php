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
        $query = "SELECT * FROM products";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //join reviews
    public function getAllProductWithReviews()
    {
        $query = "SELECT * FROM products AS p LEFT JOIN reviews AS r ON p.product_id = r.product_id LEFT JOIN ( SELECT product_id, image_name FROM images GROUP BY product_id ) AS i ON i.product_id = p.product_id;";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //get product by hight view
    public function getProductByHightView()
    {
        $query = "SELECT * FROM products WHERE view >= 5 LIMIT 7";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //count product
    public function countProduct()
    {
        $query = "SELECT COUNT(*) as total FROM products";
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
        $query = "SELECT product_name FROM products WHERE product_id = '$id'";
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
        $query = "SELECT * FROM products WHERE product_id = '$id'";
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
            die("Query failed: ". $this->conn->error);
        }
        return $result;
    }
    //get product by category_id
    public function getProductByCategory($categoryId)
    {
        $query = "
        SELECT *
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
            WHERE 
                c.category_id = '$categoryId'
            GROUP BY 
                p.product_id, p.product_name, c.category_name, ci.category_item_name;
        ";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
}
