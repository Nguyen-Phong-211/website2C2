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
    public function getAllReviewByProductId($productId)
    {
        $query = "SELECT * FROM reviews r JOIN users u ON r.user_id=u.user_id  WHERE product_id = '$productId'";
        $result = $this->conn->query($query);
        if ($result === false) {
            die("Failed to retrieve review list: " . $this->conn->error);
        }
        return $result;
    }
    public function addReview($user_id, $product_id, $content, $rating_star)
{
    // Sử dụng prepared statements
    $query = "INSERT INTO reviews (user_id, product_id, content, rating_star, create_at, update_at)
              VALUES (?, ?, ?, ?, NOW(), NOW())";

    $stmt = $this->conn->prepare($query);
    if ($stmt === false) {
        die("Failed to prepare query: " . $this->conn->error);
    }

    $stmt->bind_param("iisi", $user_id, $product_id, $content, $rating_star);
    $result = $stmt->execute();
    if ($result === false) {
        die("Failed to add review: " . $stmt->error);
    }

    $stmt->close();
    return $result;
}

}
