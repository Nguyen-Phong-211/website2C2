<?php
include_once('ConnectDatabase.php');

class Message extends ConnectDatabase
{
    private $conn;

    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    // Lấy danh sách tin nhắn giữa hai người dùng
    public function getMessages($sender_id, $receiver_id, $product_id)
    {
        $query = "SELECT * FROM messages 
              WHERE ((sender_id = ? AND receive_id = ?) 
                 OR (sender_id = ? AND receive_id = ?)) 
                AND product_id = ?
              ORDER BY create_at ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiiii", $sender_id, $receiver_id, $receiver_id, $sender_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
        return $messages;
    }

    // Gửi tin nhắn mới
    public function sendMessage($sender_id, $receiver_id, $content, $product_id)
    {
        $query = "INSERT INTO messages (sender_id, receive_id, content, status, create_at, product_id) 
              VALUES (?, ?, ?, '0', NOW(), ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iisi", $sender_id, $receiver_id, $content, $product_id);
        return $stmt->execute();
    }
}
