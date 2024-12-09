<?php
include_once('ConnectDatabase.php');

class Order extends ConnectDatabase
{
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }
    //update status order
    public function updateStatusOrder($orderId, $status)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
        if ($stmt === false) {
            die("Error preparing the statement: " . $this->conn->error);
        }

        $stmt->bind_param("ii", $status, $orderId);

        $executeResult = $stmt->execute();

        if ($executeResult) {
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            echo "Failed to update order status: " . $stmt->error;
            return false;
        }
    }
    //count status = 1
    public function countOrderStatus1()
    {
        $query = "SELECT COUNT(*) AS count_status 
                    FROM orders AS o 
                        JOIN users AS u ON o.user_id = u.user_id
                        JOIN roles AS rl ON u.role_seller_id = rl.role_id
                    WHERE o.status = '1'";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: ". $this->conn->error);
        }

        $row = $result->fetch_assoc();
        return $row['count_status '];
    }
    //count status = 0
    public function countOrderStatus0()
    {
        $query = "SELECT COUNT(*) AS count_status 
                    FROM orders AS o 
                        JOIN users AS u ON o.user_id = u.user_id
                        JOIN roles AS rl ON u.role_seller_id = rl.role_id
                    WHERE o.status = '0'";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: ". $this->conn->error);
        }

        $row = $result->fetch_assoc();
        return $row['count_status '];
    }
    //count status = 2
    public function countOrderStatus2()
    {
        $query = "SELECT COUNT(*) AS count_status 
                    FROM orders AS o 
                        JOIN users AS u ON o.user_id = u.user_id
                        JOIN roles AS rl ON u.role_seller_id = rl.role_id
                    WHERE o.status = '2'";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: ". $this->conn->error);
        }

        $row = $result->fetch_assoc();
        return $row['count_status '];
    }
    //count status = 3
    public function countOrderStatus3()
    {
        $query = "SELECT COUNT(*) AS count_status 
                    FROM orders AS o 
                        JOIN users AS u ON o.user_id = u.user_id
                        JOIN roles AS rl ON u.role_seller_id = rl.role_id
                    WHERE o.status = '3'";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: ". $this->conn->error);
        }

        $row = $result->fetch_assoc();
        return $row['count_status '];
    }
    //count status = 4
    public function countOrderStatus4()
    {
        $query = "SELECT COUNT(*) AS count_status 
                    FROM orders AS o 
                        JOIN users AS u ON o.user_id = u.user_id
                        JOIN roles AS rl ON u.role_seller_id = rl.role_id
                    WHERE o.status = '4'";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: ". $this->conn->error);
        }

        $row = $result->fetch_assoc();
        return $row['count_status '];
    }
    
}
