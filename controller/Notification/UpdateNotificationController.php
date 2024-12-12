<?php
include_once(__DIR__ . '/../../model/Notification.php');

class UpdateNotificationController
{
    private $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new Notification();
    }

    public function updateStatusNotificationController()
    {
        header('Content-Type: application/json; charset=utf-8');

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Kiểm tra dữ liệu
        if (!isset($data['userId'], $data['notification_id'], $data['status'])) {
            http_response_code(400); 
            echo json_encode(['success' => false, 'message' => 'Dữ liệu không đầy đủ']);
            exit;
        }

        $userId = $data['userId'];
        $notificationId = $data['notification_id'];
        $status = $data['status'];

        try {
            $result = $this->notificationModel->updateStatusNotification($notificationId, $status, $userId);
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Không có thông báo nào được cập nhật.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            error_log("Error: " . $e->getMessage()); // Ghi vào log server
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }

        exit;
    }
}

// Khởi tạo và gọi phương thức cập nhật trạng thái
$updateNotificationController = new UpdateNotificationController();
$updateNotificationController->updateStatusNotificationController();
