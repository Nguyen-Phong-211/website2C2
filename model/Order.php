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
}
