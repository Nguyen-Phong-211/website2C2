<?php
include_once('ConnectDatabase.php');

class Whistlist extends ConnectDatabase
{
    private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }
    //count product in whistlist
    public function countProductInWhistlistRole($userId)
    {
        $query = "SELECT COUNT(*) as total FROM whistlists AS w WHERE w.user_id = ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $userId);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }

        $data = $result->fetch_assoc();
        $stmt->close(); 

        return $data['total'] ?? 0; 
    }
    public function countProductInWhistlist()
    {
        $query = "SELECT COUNT(*) as total FROM whistlists";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }

        $data = $result->fetch_assoc();
        $stmt->close(); 

        return $data['total'] ?? 0; 
    }
    //add product to whistlist
    public function addToWhistlist($productId, $userId)
    {
        $query = "INSERT INTO whistlists (product_id, user_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("ii", $productId, $userId);
        $result = $stmt->execute();

        if ($result === false) {
            die("Execution failed: " . $stmt->error);
        }

        $stmt->close();
        return $result;
    }
    //check
    public function checkIfExistWhistlist($productId, $userId)
    {
        $query = "SELECT * FROM whistlists WHERE product_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("ii", $productId, $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;

        $stmt->close();
        return $exists;
    }
    //get all whistlist by user_id
    public function getAllWhistlistByUserId($userId)
    {
        $query = "SELECT DISTINCT * FROM whistlists AS w 
                        JOIN products AS p ON w.product_id = p.product_id JOIN images AS i ON i.product_id = p.product_id 
                        WHERE w.user_id = ? 
                        GROUP BY p.product_id;";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();
        return $result;
    }
    //remove product from whistlist
    public function removeFromWhistlist($whistlist_id)
    {
        $query = "DELETE FROM whistlists WHERE whistlist_id = '$whistlist_id'";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }
        $result = $stmt->execute();
        if ($result === false) {
            die("Execution failed: " . $stmt->error);
        }
        $stmt->close();
        return $result;
    }
    public function removeFromWhistlistByProductId($productId, $userId)
    {
        $query = "DELETE FROM whistlists WHERE product_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            error_log("Prepare failed: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param("ii", $productId, $userId); 
        $result = $stmt->execute();
        if ($result === false) {
            error_log("Execution failed: " . $stmt->error);
            return false;
        }
        $stmt->close();

        return $result; 
    }

    //check product in whistlist by user_id at page detailProduct
    public function checkProductInWhistlist($productId, $userId){
        $query = "SELECT w.*
                    FROM whistlists AS w
                    WHERE w.product_id = ? AND w.user_id = ?
                    ";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ii", $productId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        return $exists;
    }
}
