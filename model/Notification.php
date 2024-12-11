<?php
include_once('ConnectDatabase.php');

class Notification extends ConnectDatabase
{
    private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }
    //count notifcation by user_id
    public function countNotificationByUserId($userId)
    {
        $query = "SELECT COUNT(*) as total_notification FROM notifications WHERE user_id = '$userId' AND status = '0'";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['total_notification'];
    }

    //add notications 
    public function addNotificationByUserId($userId, $notification_name, $content)
    {

        $query = "insert into notifications values (?, ?, ?)";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row;
    }
    //get all notification by user_id
    public function getAllNotificationByUserId($userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM notifications AS n JOIN users AS u ON n.user_id = u.user_id WHERE n.user_id = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }
        
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result === false) {
            die("Execution failed: " . $stmt->error);
        }
        
        $stmt->close();
        return $result;
    }

    //update status notification
    public function updateStatusNotification($notification_id, $status, $userId)
    {
        $query = "UPDATE notifications 
                        SET status = ? 
                        WHERE notification_id = ? AND user_id = ?;";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            throw new Exception("Lỗi chuẩn bị câu lệnh: " . $this->conn->error);
        }

        $stmt->bind_param("sii", $status, $notification_id, $userId);

        if ($stmt->execute()) {
            $affectedRows = $stmt->affected_rows;
            $stmt->close();
            return $affectedRows > 0; 
        } else {
            $stmt->close();
            throw new Exception("Lỗi thực thi câu lệnh: " . $stmt->error);
        }
    }
}
