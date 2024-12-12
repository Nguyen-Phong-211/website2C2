<?php 
    include_once('model/Notification.php');

    class NotificationController {
        private $notification;
        public function __construct(){
            $this->notification = new Notification();
        }
        //count notifcation by user_id
        public function countNotificationByUserId($userId){
            return $this->notification->countNotificationByUserId($userId);
        }
         //add notifications
         public function addNotificationsByUserIdController($userId, $notification_name, $content){
            $result = $this ->notification->addNotificationByUserId($userId, $notification_name, $content);
            if(!$result ){
                die('that bai'. $this ->notification->getConnection()->error);
            }else{
                return $result;
            }
        }
        //get all notification by user_id
        public function getAllNotificationByUserIdController($userId){
            $result = $this->notification->getAllNotificationByUserId($userId);
            if(!$result ){
                die('Thất bại: '. $this->notification->getConnection()->error);
            }else{
                return $result;
            }
        }
    }
?>