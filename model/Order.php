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
    //update status order by role seller
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
    //update status order by role buyer
    public function updateStatusOrderBuyer($orderId, $status)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
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
    //add order
    public function addOrder($userId, $orderDate, $totalAmount, $status, $statusOrder)
    {
        $stmt = $this->conn->prepare("INSERT INTO orders (user_id, order_date, total_amount, status, order_status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isdss", $userId, $orderDate, $totalAmount, $status, $statusOrder);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error: " . $stmt->error);
            return false;
        }
    }
    //get the last order_id
    public function getLastOrderId()
    {
        $stmt = $this->conn->prepare("SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1");
        $stmt->execute();
        $stmt->bind_result($order_id);
        $stmt->fetch();
        $stmt->close();
        return $order_id;
    }
}
