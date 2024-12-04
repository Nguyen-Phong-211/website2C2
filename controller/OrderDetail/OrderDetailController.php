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
        public function countOrderDetailByUserIdController($userId)
        {
            $result = $this->orderDetailModel->countOrderDetailByUserId($userId);
            if ($result === false) {
                die("Không thể lấy dữ liệu đơn hàng: " . $this->orderDetailModel->getConnection()->error);
            }
            return $result;
        }

        //get all order detail by role seller
        public function getAllOrderDetailByRoleSeller($userId) {
            $result = $this->orderDetailModel->getAllOrderDetailByRoleSeller($userId);
            if (!$result) {
                try {
                    $result = $this->orderDetailModel->getAllOrderDetailByRoleSeller($userId);
                } catch (Exception $e) {
                    die("Error: " . $e->getMessage());
                }                
            }
            return $result;
        }
        
    }
?>