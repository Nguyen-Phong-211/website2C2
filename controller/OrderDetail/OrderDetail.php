<?php 
    include_once('model/OrderDetail.php');

    class OrderDetailController {
        private $orderDetailModel;

        public function __construct() {
            $this->orderDetailModel = new OrderDetail();
        }

        public function getAllOrderDetailByUserId($userId) {
            $result = $this->orderDetailModel->getAllOrderDetailByUserId($userId);
            if (!$result) {
                die("Failed to retrieve category list: " . $this->orderDetailModel->getConnection()->error);
            }
            return $result;
        }
        //count order detail by user id
        public function countOrderDetailByUserId($userId) {
            $result = $this->orderDetailModel->countOrderDetailByUserId($userId);
            if (!$result) {
                die("Failed to retrieve category list: " . $this->orderDetailModel->getConnection()->error);
            }
            return $result;
        }
    }
?>