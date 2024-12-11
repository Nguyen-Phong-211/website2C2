<?php 
    include_once('model/Order.php');

    class OrderController {
        private $orderModel;

        public function __construct() {
            $this->orderModel = new Order();
        }
        //update status order buy role seller
        public function updateOrderStatusController($orderId, $status) {
            $result = $this->orderModel->updateStatusOrder($orderId, $status);

            if ($result) {
                echo "<script>alert('Cập nhật trạng thái đơn hàng thành công.')</script>";
            } else{
                echo "<script>
                window.location.href='index.php?page=sellOrder';
                </script>";
            }
        }
        //update status order buy role buyer
        public function updateOrderStatusBuyerController($orderId, $status) {
            $result = $this->orderModel->updateStatusOrderBuyer($orderId, $status);

            if ($result) {
                echo "<script>alert('Cập nhật trạng thái đơn hàng thành công.')</script>";
            } else{
                echo "<script>
                window.location.href='index.php?page=puchaseOrder';
                </script>";
            }
        }
        //add order
        public function addOrderController($userId, $orderDate, $totalAmount, $status, $statusOrder) {
            $result = $this->orderModel->addOrder($userId, $orderDate, $totalAmount, $status, $statusOrder);
            if ($result) {
                echo "
                <script>
                    alert('Đặt hàng thành công');
                    window.location.href='index.php?page=message';
                </script>";
            } else{
                echo "
                <script>
                    alert('Đặt hàng thất bại! Vui lòng thử lại!');
                    window.location.href='index.php?page=order';
                </script>";
            }
        }
        //get the last order_id
        public function getLastOrderIdController()
        {
            $result = $this->orderModel->getLastOrderId();
            return $result;
        }
    }
?>