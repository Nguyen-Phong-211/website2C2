<?php
include_once('ConnectDatabase.php');

class User extends ConnectDatabase
{

    private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    //count user
    public function countUser()
    {
        $query = "SELECT COUNT(*) as total FROM users";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    //count role seller
    public function countRoleSeller()
    {
        $query = "SELECT COUNT(role_seller_id) AS count_seller FROM users AS u JOIN roles AS r ON r.role_id = u.role_seller_id";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        $row = $result->fetch_assoc();
        return $row['count_seller'];
    }
    //get user by product_id
    public function getUserbyProduct($product_id)
    {
        $query = "SELECT * 
                    FROM users AS u 
                    JOIN products AS p ON u.user_id = p.user_id 
                    WHERE p.product_id = '$product_id';
                    ";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    //get user_id by email
    public function getUserIdByEmail($email)
    {
        $query = "SELECT user_id FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Prepare statement failed: " . $this->conn->error);
        }

        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row['user_id'] ?? null;
    }
    //get user by email
    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Prepare statement failed: " . $this->conn->error);
        }
    
        $stmt->bind_param('s', $email);
    
        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        return $row;
    }
    //update user_name, email, number_phone, address, image
    public function updateUser($user_id, $user_name, $email, $number_phone, $address, $image, $date_of_birth)
    {
        $query = "UPDATE users 
                    SET user_name = ?, email = ?, number_phone = ?, address = ?, image = ?, date_of_birth = ?
                    WHERE user_id = ?";

        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Prepare statement failed: ". $this->conn->error);
        }

        $stmt->bind_param("ssssssi", $user_name, $email, $number_phone, $address, $image, $date_of_birth, $user_id);

        if (!$stmt->execute()) {
            die("Execution failed: ". $stmt->error);
        }

        $stmt->close();
        return true;
    }
    //update password by user_id
    public function updatePassword($user_id, $password)
    {
        $query = "UPDATE signup SET password = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Prepare statement failed: " . $this->conn->error);
        }
        $stmt->bind_param("si", $password, $user_id);
        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        }
        $stmt->close();
        return true;
    }
    //check role of user
    public function checkRole($userId){
        $query = "SELECT role_seller_id FROM users AS u JOIN roles AS r ON u.role_seller_id = r.role_id WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Prepare statement failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $userId);
        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        }
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }
    //get infomation user by user_id
    public function getUserById($user_id){
        $query = "SELECT * FROM users WHERE user_id =?";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Prepare statement failed: ". $this->conn->error);
        }
        $stmt->bind_param("i", $user_id);
        if (!$stmt->execute()) {
            die("Execution failed: ". $stmt->error);
        }
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }
    //get user 
    public function getInfoUserSellerRegis(){
        $query = "SELECT DISTINCT u.*, rp.create_at
                    FROM users AS u 
                    JOIN roles AS rl
                    JOIN registration_products AS rp ON u.user_id = rp.user_id
                    ORDER BY create_at DESC
        ";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Prepare statement failed: ". $this->conn->error);
        }
        if (!$stmt->execute()) {
            die("Execution failed: ". $stmt->error);
        }
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }
}