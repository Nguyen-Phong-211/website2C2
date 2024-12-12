<?php
include_once('model/Notification.php');

class UpdateNotificationController
{
    private $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new Notification();
    }
    //update status notification
    // public function updateStatusNotificationController()
    // {
    //     header('Content-Type: application/json; charset=utf-8');

    //     $json = file_get_contents('php://input');
    //     $data = json_decode($json, true);
    //     var_dump($data);

    //     $userId = $data['userId'] ?? null;
    //     $notificationId = $data['notification_id'] ?? null;
    //     $status = $data['status'] ?? null;

    //     if (empty($userId) || empty($notificationId) || empty($status)) {
    //         http_response_code(400); // Bad Request
    //         echo json_encode(['success' => false, 'message' => 'Dữ liệu không đầy đủ']);
    //         exit;
    //     }

    //     try {
    //         $result = $this->notificationModel->updateStatusNotification($notificationId, $status, $userId);

    //         if ($result) {
    //             echo json_encode(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
    //         } else {
    //             echo json_encode(['success' => false, 'message' => 'Không có thông báo nào được cập nhật.']);
    //         }
    //     } catch (Exception $e) {
    //         http_response_code(500); // Internal Server Error
    //         echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    //     }

    //     // if (empty($userId) || empty($notificationId) || empty($status)) {
    //     //     echo json_encode(['success' => false, 'message' => 'Dữ liệu không đầy đủ']);
    //     //     exit;
    //     // }
    //     // $result = $this->notificationModel->updateStatusNotification($notificationId, $status, $userId);

    //     // if ($result) {
    //     //     echo json_encode(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
    //     // } else {
    //     //     echo json_encode(['success' => false, 'message' => 'Cập nhật thất bại']);
    //     // }
    //     exit;
    // }
    public function updateStatusNotificationController()
{
    header('Content-Type: application/json; charset=utf-8');
    
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    $userId = $data['userId'] ?? null;
    $notificationId = $data['notification_id'] ?? null;
    $status = $data['status'] ?? null;

    if (empty($userId) || empty($notificationId) || empty($status)) {
        http_response_code(400); // Bad Request
        echo json_encode(['success' => false, 'message' => 'Dữ liệu không đầy đủ']);
        exit;
    }

    try {
        $result = $this->notificationModel->updateStatusNotification($notificationId, $status, $userId);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Cập nhật trạng thái thành công']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Không có thông báo nào được cập nhật.']);
        }
    } catch (Exception $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }

    exit;
}

}
$updateNotificationController = new UpdateNotificationController();
$updateNotificationController->updateStatusNotificationController();
