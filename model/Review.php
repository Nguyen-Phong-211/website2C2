<?php
include_once('ConnectDatabase.php');

class Review extends ConnectDatabase
{
    private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }
    //count review by user_id
    public function countReviewRoleBuyer($userId)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total 
                                    FROM reviews AS r 
                                    JOIN users AS u ON r.user_id = u.user_id 
                                    JOIN roles AS rl ON u.role_id = rl.role_id 
                                    WHERE r.user_id = ?");
        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $userId);

        if (!$stmt->execute()) {
            throw new Exception("Failed to execute query: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result === false) {
            throw new Exception("Failed to get result: " . $this->conn->error);
        }
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }
    //count review by role_seller_id
    public function countReviewRoleSeller($userId)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total 
                                    FROM reviews AS r 
                                    JOIN users AS u ON r.user_id = u.user_id 
                                    JOIN roles AS rl ON u.role_seller_id = rl.role_id 
                                    WHERE r.user_id = ?");
        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $this->conn->error);
        }

        $stmt->bind_param("i", $userId);

        if (!$stmt->execute()) {
            throw new Exception("Failed to execute query: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result === false) {
            throw new Exception("Failed to get result: " . $this->conn->error);
        }
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }
    //get review by product_id
    public function getReviewByProductId($productId)
    {
        $query = "SELECT rating_star FROM reviews WHERE product_id = '$productId'";
        $result = $this->conn->query($query);
        if ($result === false) {
            die("Failed to retrieve review list: " . $this->conn->error);
        }
        return $result;
    }
    //count review by product_id
    public function countReviewByProductId($productId)
    {
        $query = "SELECT COUNT(*) as total FROM reviews WHERE product_id = '$productId'";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Failed to retrieve review count: " . $this->conn->error);
        }
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    //get all review by user_id, role_id and product_id
    public function getAllReviewByRoleBuyer($userId)
    {
        $stmt = $this->conn->prepare("SELECT r.*, u.user_id, p.product_id, p.product_name, 
                                                (SELECT i.image_name FROM images AS i WHERE i.product_id = p.product_id LIMIT 1) AS image_name
                                                FROM reviews AS r
                                                JOIN users AS u ON r.user_id = u.user_id
                                                JOIN roles AS rl ON u.role_id = rl.role_id
                                                JOIN products AS p ON r.product_id = p.product_id
                                                WHERE r.user_id = ?
                                            ");
        if ($stmt === false) {
            die("Failed to prepare statement: " . $this->conn->error);
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result === false) {
            die("Failed to retrieve review list: " . $this->conn->error);
        }
        return $result;
    }
    //get all review by user_id, role_seller_id and product_id
    public function getAllReviewByRoleSeller($userId)
    {
        $stmt = $this->conn->prepare("SELECT r.*, u.user_id, p.product_id, p.product_name, 
                                                (SELECT i.image_name FROM images AS i WHERE i.product_id = p.product_id LIMIT 1) AS image_name
                                                FROM reviews AS r
                                                JOIN users AS u ON r.user_id = u.user_id
                                                JOIN roles AS rl ON u.role_seller_id = rl.role_id
                                                JOIN products AS p ON r.product_id = p.product_id
                                                WHERE r.user_id = ?
                                            ");
        if ($stmt === false) {
            die("Failed to prepare statement: " . $this->conn->error);
        }
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result === false) {
            die("Failed to retrieve review list: " . $this->conn->error);
        }
        return $result;
    }
}
