<?php 
    include_once('model/Order.php');

    class OrderController {
        private $orderModel;

        public function __construct() {
            $this->orderModel = new Order();
        }
        //update status order
        public function updateOrderStatusController($orderId, $status) {
            $result = $this->orderModel->updateStatusOrder($orderId, $status);

            if (!$result) {
                echo "<script>alert('Lỗi hệ thống! Hãy liên hệ với chúng tôi!')</script>";
            } else {
                echo "<script>alert('Cập nhật trạng thái đơn hàng thành công.')</script>";
            }
        }
    }
?>