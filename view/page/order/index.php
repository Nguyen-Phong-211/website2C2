<?php
if ((!isset($_SESSION['success_message']) && !isset($_SESSION['email'])) || (!isset($_SESSION['emailUserLoginGoogle']) && !isset($_SESSION['success_message']))) {
    header('Location: index.php?page=login');
    $_SESSION['info_login'] = "Thông báo đăng nhập.";
}
?>
<?php
include_once('controller/Order/OrderController.php');
include_once('controller/OrderDetail/OrderDetailController.php');
include_once('controller/User/UserController.php');
include_once('controller/Cart/CartController.php');
include_once('controller/Product/ProductController.php');

$orderController = new OrderController();
$orderDetailController = new OrderDetailController();
$userController = new UserController();
$cartController = new CartController();
$productController = new ProductController();

if (isset($_POST['btndh'])) {

    if(empty($_POST['name'])){
        //|| !empty($_POST['email']) || !empty($_POST['phone']) || !empty($_POST['address'])
        $cartItems = $cartController->getProductofCartList();

        $totalOrderPrice = 0;
        foreach ($cartItems as $item) {
            $totalOrderPrice += $item['price'] * $item['quantity'];
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $orderDate = date('Y-m-d H:i:s');
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        $orderController->addOrderController($userId, $orderDate, $totalOrderPrice, 2, 2);
        sleep(1);

        include_once('controller/Notification/NotificationController.php');
        $notificationController = new NotificationController();
        $notificationController->addNotificationsByUserIdController($_SESSION['user_id'], 'Gửi liên hệ thành công', 'Bạn đã gửi liên hệ thành công. Chúng tôi sẽ phản hồi sớm nhất cho bạn.');

        foreach ($cartItems as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $linetotal = $price * $quantity;
            $discount = $productController->getDiscountByProductIdController($product_id);
            $orderId = $orderController->getLastOrderIdController();
            $orderDetailController->addOrderDetailController($orderId, $product_id, $quantity, $price, $discount, $linetotal);
        }
        include_once('controller/Notification/NotificationController.php');
        $notificationController = new NotificationController();
        $notificationController->addNotificationsByUserIdController($_SESSION['user_id'], 'Đặt hàng thành công', 'Bạn đã đặt hàng thành công. Vui lòng liên hệ với người bán qua số điện thoại để được hỗ trợ nhanh chóng.');
        echo "
            <script>
                alert('Đặt hàng thành công');
                window.location.href='index.php?page=puchaseOrder';
            </script>";
        exit();
    }else{
        echo '
        <script>alert("Vui lòng cập nhật thông tin trước khi đặt hàng!")</script>
        ';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đặt hàng</title>
    <link rel="stylesheet" href="vendor/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="vendor/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container" style="height: 50vh;">
        <div class="row justify-content-center align-items-end" style="height: 100%;">
            <div class="col-md-4 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h2>Thông Tin Người Mua</h2>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning" role="alert">
                            Nếu thông tin bị thiếu. Vui lòng nhấn <a href="index.php?page=setting">Cập nhật thông tin</a> để có thể đặt hàng!
                        </div>
                        <?php
                        $infoUserOrder = $userController->getUserByIdController($_SESSION['user_id']);
                        echo '
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ và Tên</label>
                                    <input type="text" disabled class="form-control" name="name" value="' . $infoUserOrder['user_name'] . '">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" disabled class="form-control" name="email" value="' . $infoUserOrder['email'] . '">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="tel" disabled class="form-control" name="phone" value="' . $infoUserOrder['number_phone'] . '">
                                </div>
                                <div class="mb-3">
                                    <label for="address"  class="form-label">Địa chỉ</label>
                                    <textarea class="form-control" disabled name="address" rows="3">' . $infoUserOrder['address'] . '</textarea>
                                </div>
                            </form>
                            ';
                        ?>
                        <!-- <a href="index.php?page=setting" class="btn btn-primary w-100">Cập nhật thông tin</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row mb-4">
                    <a href="index.php?page=cart" class="text-decoration-none fs-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                        </svg>
                        Quay trở lại
                    </a>
                </div>
                <form action="" method="post">
                    <div class="row card">
                        <div class="card-header">
                            <h2>Thông Tin Đơn Hàng</h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Số Lượng</th>
                                        <th>Giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include_once('controller/Cart/CartController.php');
                                    $cartController = new CartController();
                                    $totalProducts = $cartController->getProductCount();
                                    if ($totalProducts > 0) {
                                        $cartItems = $cartController->getProductofCartList();
                                        $totalOrderPrice = 0;
                                        foreach ($cartItems as $item) {
                                            $totalOrderPrice += $item['price'] * $item['quantity'];
                                            echo '
                                                <tr>
                                                    <td>' .  $item['product_name'] . '</td>
                                                    <td>' .  $item['quantity'] . '</td>
                                                    <td>' .  number_format($item['price'], 0, ',', '.') . '</td>
                                                    <td>' .  number_format($item['quantity'] * $item['price'], 0, ',', '.') . ' VNĐ</td>
                                                </tr>
                                                ';
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td><strong class="fs-4">Tổng tiền: </strong></td>
                                        <td></td>
                                        <td></td>
                                        <td><strong class="fs-4"><?= number_format($totalOrderPrice, 0, ',', '.') ?> VNĐ</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary w-100 mt-3" name="btndh" id="btndh">Xác Nhận Đặt Hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>