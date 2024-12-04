<?php
if ((!isset($_SESSION['success_message']) && !isset($_SESSION['email'])) || (!isset($_SESSION['emailUserLoginGoogle']) && !isset($_SESSION['success_message']))) {
    header('Location: index.php?page=login');
    $_SESSION['info_login'] = "Thông báo đăng nhập.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đơn mua</title>

    <?php
    include_once('view/layout/header/lib_cdn.php');
    ?>

</head>

<body>

    <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div>

    <?php
    include_once('view/layout/slidebar/slidebar.php');
    ?>

    <header>
        <?php
        include_once('view/layout/header/menu.php');
        ?>
    </header>

    <?php
    include_once('view/layout/pagination/index.php');
    ?>

    <?php 
        include_once('controller/Order/OrderController.php');
        $orderController = new OrderController();

        if(isset($_POST['btnUpdateStatusOrder']) && $_POST['btnUpdateStatusOrder'] == "btnUpdateStatusOrder"){
            $orderController->updateOrderStatusController($_POST['orderId'], $_POST['status']);
        }
    ?>

    <section class="container pb-4 my-4 text-black">
        <div class="container mt-5">
            <ul class="nav nav-tabs">
                <li class="nav-item nav-tabs-item col-lg-2 text-center fw-bold">
                    <a class="nav-link active" href="#" data-target="all-sell">Tất cả</a>
                </li>
                <li class="nav-item nav-tabs-item col-lg-2 text-center fw-bold">
                    <a class="nav-link" href="#" data-target="acepting">Chờ xác nhận</a>
                </li>
                <li class="nav-item nav-tabs-item col-lg-2 text-center fw-bold">
                    <a class="nav-link" href="#" data-target="processing">Đang xử lý</a>
                </li>
                <li class="nav-item nav-tabs-item col-lg-2 text-center fw-bold">
                    <a class="nav-link" href="#" data-target="deliverying">Đang giao</a>
                </li>
                <li class="nav-item nav-tabs-item col-lg-2 text-center fw-bold">
                    <a class="nav-link" href="#" data-target="deliveried">Đã giao</a>
                </li>
                <li class="nav-item nav-tabs-item col-lg-2 text-center fw-bold">
                    <a class="nav-link" href="#" data-target="canceled-sell">Hoàn tiền/Đã huỷ</a>
                </li>
            </ul>

            <div class="tab-content mt-5" id="all-sell">
                <section class="mt-4">
                    <table class="table text-black">
                        <?php
                            include_once('controller/OrderDetail/OrderDetailController.php');
                            include_once('controller/User/UserController.php');

                            $orderDetailController = new OrderDetailController();
                            $userController = new UserController();

                            if (isset($_SESSION["success_message"]) && isset($_SESSION["emailUserLoginGoogle"])) {

                                $userId = $userController->getUserIdByEmailController($_SESSION["emailUserLoginGoogle"]);
                                $allSellOrder = $orderDetailController->getAllOrderDetailByRoleSeller($userId);

                                $stt = 1;

                                if ($allSellOrder) {
                                    echo '<thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giảm giá</th>
                                                <th scope="col">Thành tiền</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Thao tác</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                    foreach ($allSellOrder as $order) {

                                        if ($order['role_seller_id'] == 1) {
                                            echo '      
                                            <tr>
                                                <th scope="row">' . $stt++ . '</th>
                                                <td>' . $order['product_name'] . '</td>
                                                <td>
                                                    <img src="asset/image/product/' . $order['image_name'] . '" alt="' . $order['image_name'] . '" height="50" width="50" class="img-fluid">
                                                </td>
                                                <td>' . $order['quantity'] . '</td>
                                                <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                <td>' . $order['discount'] . ' </td>
                                                <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                <td>';
                                                    if ($order['order_status'] == 0) {
                                                        echo '<span class="badge bg-danger">Hoàn tiền/Đã huỷ</span>';
                                                    } elseif ($order['order_status'] == 1) {
                                                        echo '<span class="badge bg-success">Đã giao</span>';
                                                    } elseif ($order['order_status'] == 2) {
                                                        echo '<span class="badge bg-light text-dark">Chờ xác nhận</span>';
                                                    } elseif ($order['order_status'] == 3) {
                                                        echo '<span class="badge bg-primary">Đang xử lý</span>';
                                                    } else {
                                                        echo '<span class="badge bg-info text-dark">Đang giao</span>';
                                                    }
                                            echo '
                                                </td>
                                                <td>
                                                    <p data-bs-toggle="tooltip" data-bs-placement="left" title="Chi tiết">
                                                        <a class="btn btn-primary active" data-bs-toggle="collapse" href="#collapseOrder' . $order['order_id'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                                            </svg>
                                                        </a>
                                                    </p>
                                                </td>
                                                <td data-bs-toggle="modal" data-bs-target="#exampleModal' . $order['order_id'] . '">
                                                    <a class="btn btn-primary active" data-bs-toggle="tooltip" data-bs-placement="top" title="Cập nhật">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                                        </svg>
                                                    </a>
                                                </td>

                                                <div class="modal fade" id="exampleModal' . $order['order_id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin đơn hàng</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-black">
                                                                <small>Mã đơn hàng: ' . $order['order_id'] . '</small> <br>
                                                                <small>Tên sản phẩm: ' . $order['product_name'] . '</small> <br>
                                                                <small>Ngày đặt hàng: ' . date('d/m/Y H:i:m', strtotime($order['o_create_at'])) . '</small> <br>
                                                                <small>Số lượng: ' . $order['quantity'] . '</small> <br>
                                                                <small>Giảm giá: ' . $order['discount'] . '%</small> <br>
                                                                <p class="fs-5 fw-bold">Thành tiền: '. number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . ' đồng</p>
                                                                <small>Cập nhật trạng thái đơn hàng</small>
                                                                <form action="index.php?page=sellOrder" method="post">
                                                                    <input type="hidden" name="orderId" value="' . $order['order_id'] . '"> ';
                                                                    if($order['order_status'] == 0){
                                                                        echo '
                                                                        <select class="form-select border-color" disabled>
                                                                            <option value="0" selected>Hoàn tiền/Đã huỷ</option>
                                                                            <option value="1">Đã giao</option>
                                                                            <option value="2">Chờ xác nhận</option>
                                                                            <option value="3">Đang xử lý</option>
                                                                            <option value="4">Đang giao</option>
                                                                        </select>';
                                                                    }elseif ($order['order_status'] == 1) {
                                                                        echo '
                                                                        <select class="form-select border-color" disabled>
                                                                            <option value="0">Hoàn tiền/Đã huỷ</option>
                                                                            <option value="1" selected>Đã giao</option>
                                                                            <option value="2">Chờ xác nhận</option>
                                                                            <option value="3">Đang xử lý</option>
                                                                            <option value="4">Đang giao</option>
                                                                        </select>';
                                                                    } elseif ($order['order_status'] == 2) {
                                                                        echo '
                                                                        <select class="form-select border-color" name="status">
                                                                            <option value="0">Hoàn tiền/Đã huỷ</option>
                                                                            <option value="1">Đã giao</option>
                                                                            <option value="2" selected>Chờ xác nhận</option>
                                                                            <option value="3">Đang xử lý</option>
                                                                            <option value="4">Đang giao</option>
                                                                        </select>';
                                                                    } elseif ($order['order_status'] == 3) {
                                                                        echo '
                                                                        <select class="form-select border-color" name="status">
                                                                            <option value="0">Hoàn tiền/Đã huỷ</option>
                                                                            <option value="1">Đã giao</option>
                                                                            <option value="2">Chờ xác nhận</option>
                                                                            <option value="3" selected>Đang xử lý</option>
                                                                            <option value="4">Đang giao</option>
                                                                        </select>';
                                                                    } else {
                                                                        echo '
                                                                        <select class="form-select border-color" name="status">
                                                                            <option value="0">Hoàn tiền/Đã huỷ</option>
                                                                            <option value="1">Đã giao</option>
                                                                            <option value="2">Chờ xác nhận</option>
                                                                            <option value="3">Đang xử lý</option>
                                                                            <option value="4" selected>Đang giao</option>
                                                                        </select>';
                                                                    } 
                                            echo            '</div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger btn-cancel" data-bs-dismiss="modal">Đóng</button>';
                                                                if($order['order_status'] == 0 || $order['order_status'] == 1){
                                                                    echo '<button type="submit" name="btnUpdateStatusOrder" value="btnUpdateStatusOrder" class="btn btn-primary" disabled>Lưu thay đổi</button>';
                                                                }else{
                                                                    echo '<button type="submit" name="btnUpdateStatusOrder" value="btnUpdateStatusOrder" class="btn btn-primary">Lưu thay đổi</button>';
                                                                }
                                            echo            '</div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                            </tr>
                                            <tr>
                                                <td colspan="9" class="p-0">
                                                    <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                        <div class="card card-body w-100">';
                                                            if ($order['order_status'] == 0) {
                                                                echo '
                                                                <ul class="list-unstyled">
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                            <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                            <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày huỷ hàng: ' . $order['o_update_at'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                    </li>
                                                                </ul>
                                                                ';
                                                            } else {
                                                                echo '
                                                                <ul class="list-unstyled">
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                            <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                            <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                    </li>
                                                                </ul>
                                                            ';
                                            echo '      </div>
                                                    </div>
                                                </td>
                                            </tr>';
                                            }
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                        <div class="text-center border border-2 rounded border-color p-4">
                                            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                            <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                        </div>
                                    </section>
                                    ';
                                }
                            } else {
                                $userId = $userController->getUserIdByEmailController($_SESSION["email"]);
                                $allSellOrder = $orderDetailController->getAllOrderDetailByRoleSeller($userId);

                                $stt = 1;

                                if ($allSellOrder) {

                                    echo '<thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giảm giá</th>
                                                <th scope="col">Thành tiền</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                    foreach ($allSellOrder as $order) {
                                        if ($order['role_seller_id'] == 1) {
                                            echo '
                                            <tr>
                                                <th scope="row">' . $stt++ . '</th>
                                                <td>' . $order['product_name'] . '</td>
                                                <td>
                                                    <img src="asset/image/product/' . $order['image_name'] . '" alt="' . $order['image_name'] . '" height="50" width="50" class="img-fluid">
                                                </td>
                                                <td>' . $order['quantity'] . '</td>
                                                <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                <td>' . $order['discount'] . ' </td>
                                                <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                <td>';
                                                    if ($order['order_status'] == 0) {
                                                        echo '<span class="badge bg-danger">Huỷ hàng</span>';
                                                    } elseif ($order['order_status'] == 1) {
                                                        echo '<span class="badge bg-success">Hoàn tất</span>';
                                                    } elseif ($order['order_status'] == 2) {
                                                        echo '<span class="badge bg-light text-dark">Chờ xác nhận</span>';
                                                    } elseif ($order['order_status'] == 3) {
                                                        echo '<span class="badge bg-primary">Chờ nhận hàng</span>';
                                                    } else {
                                                        echo '<span class="badge bg-info text-dark">Hoàn tiền/Đã huỷ</span>';
                                                    }
                                            echo '</td>
                                                <td>
                                                    <p>
                                                        <a class="btn btn-primary active" data-bs-toggle="collapse" href="#collapseOrder' . $order['order_id'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                            Xem chi tiết
                                                        </a>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="9" class="p-0">
                                                    <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                        <div class="card card-body w-100">';
                                                            if ($order['order_status'] == 0) {
                                                                echo '
                                                                <ul class="list-unstyled">
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                            <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                            <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày huỷ hàng: ' . $order['o_update_at'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                    </li>
                                                                </ul>';
                                                            } else {
                                                                echo '
                                                                <ul class="list-unstyled">
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                            <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                            <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                    </li>
                                                                </ul>';
                                                            }
                                                        echo '</div>
                                                    </div>
                                                </td>
                                            </tr>';
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                        <div class="text-center border border-2 rounded border-color p-4">
                                            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                            <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                        </div>
                                    </section>
                                    ';
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </section>
            </div>


            <div class="tab-content mt-5" id="acepting">
                <section class="mt-4">
                    <table class="table text-black">
                        <?php
                            include_once('controller/OrderDetail/OrderDetailController.php');
                            include_once('controller/User/UserController.php');

                            $orderDetailController = new OrderDetailController();
                            $userController = new UserController();

                            if (isset($_SESSION["success_message"]) && isset($_SESSION["emailUserLoginGoogle"])) {

                                $userId = $userController->getUserIdByEmailController($_SESSION["emailUserLoginGoogle"]);
                                $allSellOrder = $orderDetailController->getAllOrderDetailByRoleSeller($userId);

                                $stt = 1;

                                if ($allSellOrder) {
                                    echo '<thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giảm giá</th>
                                                <th scope="col">Thành tiền</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                    foreach ($allSellOrder as $order) {

                                        if ($order['role_seller_id'] == 1) {
                                            if($order['order_status'] == 2){
                                                echo '      
                                            <tr>
                                                <th scope="row">' . $stt++ . '</th>
                                                <td>' . $order['product_name'] . '</td>
                                                <td>
                                                    <img src="asset/image/product/' . $order['image_name'] . '" alt="' . $order['image_name'] . '" height="50" width="50" class="img-fluid">
                                                </td>
                                                <td>' . $order['quantity'] . '</td>
                                                <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                <td>' . $order['discount'] . ' </td>
                                                <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                <td><span class="badge bg-light text-dark">Chờ xác nhận</span></td>
                                                <td>
                                                    <p>
                                                        <a class="btn btn-primary active" data-bs-toggle="collapse" href="#collapseOrder' . $order['order_id'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                            Xem chi tiết
                                                        </a>
                                                    </p>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="9" class="p-0">
                                                    <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                        <div class="card card-body w-100">
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                        <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                    </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                </li>
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                        <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                        <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                    </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                </li>
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                    </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>';
                                            }
                                            
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                        <div class="text-center border border-2 rounded border-color p-4">
                                            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                            <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                        </div>
                                    </section>
                                    ';
                                }
                            } else {
                                $userId = $userController->getUserIdByEmailController($_SESSION["email"]);
                                $allSellOrder = $orderDetailController->getAllOrderDetailByRoleSeller($userId);

                                $stt = 1;

                                if ($allSellOrder) {

                                    echo '<thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giảm giá</th>
                                                <th scope="col">Thành tiền</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                    foreach ($allSellOrder as $order) {
                                        if ($order['role_seller_id'] == 1) {
                                            if($order['order_status'] == 2){
                                                echo '      
                                                <tr>
                                                    <th scope="row">' . $stt++ . '</th>
                                                    <td>' . $order['product_name'] . '</td>
                                                    <td>
                                                        <img src="asset/image/product/' . $order['image_name'] . '" alt="' . $order['image_name'] . '" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>' . $order['quantity'] . '</td>
                                                    <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                    <td>' . $order['discount'] . ' </td>
                                                    <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                    <td><span class="badge bg-light text-dark">Chờ xác nhận</span></td>
                                                    <td>
                                                        <p>
                                                            <a class="btn btn-primary active" data-bs-toggle="collapse" href="#collapseOrder' . $order['order_id'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                Xem chi tiết
                                                            </a>
                                                        </p>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="9" class="p-0">
                                                        <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                            <div class="card card-body w-100">
                                                                <ul class="list-unstyled">
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                            <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                            <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                        <div class="text-center border border-2 rounded border-color p-4">
                                            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                            <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                        </div>
                                    </section>
                                    ';
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </section>
            </div>


            <div class="tab-content mt-5" id="processing">
                <section class="mt-4">
                    <table class="table text-black">
                        <?php
                            include_once('controller/OrderDetail/OrderDetailController.php');
                            include_once('controller/User/UserController.php');

                            $orderDetailController = new OrderDetailController();
                            $userController = new UserController();

                            if (isset($_SESSION["success_message"]) && isset($_SESSION["emailUserLoginGoogle"])) {

                                $userId = $userController->getUserIdByEmailController($_SESSION["emailUserLoginGoogle"]);
                                $allSellOrder = $orderDetailController->getAllOrderDetailByRoleSeller($userId);

                                $stt = 1;

                                if ($allSellOrder) {
                                    echo '<thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giảm giá</th>
                                                <th scope="col">Thành tiền</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                    foreach ($allSellOrder as $order) {

                                        if ($order['role_seller_id'] == 1) {
                                            if($order['order_status'] == 3){
                                                echo '      
                                            <tr>
                                                <th scope="row">' . $stt++ . '</th>
                                                <td>' . $order['product_name'] . '</td>
                                                <td>
                                                    <img src="asset/image/product/' . $order['image_name'] . '" alt="' . $order['image_name'] . '" height="50" width="50" class="img-fluid">
                                                </td>
                                                <td>' . $order['quantity'] . '</td>
                                                <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                <td>' . $order['discount'] . ' </td>
                                                <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                <td><span class="badge bg-warning text-dark">Chờ xử lý</span></td>
                                                <td>
                                                    <p>
                                                        <a class="btn btn-primary active" data-bs-toggle="collapse" href="#collapseOrder' . $order['order_id'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                            Xem chi tiết
                                                        </a>
                                                    </p>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="9" class="p-0">
                                                    <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                        <div class="card card-body w-100">
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                        <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                    </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                </li>
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                        <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                        <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                    </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                </li>
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                    </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>';
                                            }
                                            
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                        <div class="text-center border border-2 rounded border-color p-4">
                                            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                            <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                        </div>
                                    </section>
                                    ';
                                }
                            } else {
                                $userId = $userController->getUserIdByEmailController($_SESSION["email"]);
                                $allSellOrder = $orderDetailController->getAllOrderDetailByRoleSeller($userId);

                                $stt = 1;

                                if ($allSellOrder) {

                                    echo '<thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giảm giá</th>
                                                <th scope="col">Thành tiền</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                    foreach ($allSellOrder as $order) {
                                        if ($order['role_seller_id'] == 1) {
                                            if($order['order_status'] == 3){
                                                echo '      
                                                <tr>
                                                    <th scope="row">' . $stt++ . '</th>
                                                    <td>' . $order['product_name'] . '</td>
                                                    <td>
                                                        <img src="asset/image/product/' . $order['image_name'] . '" alt="' . $order['image_name'] . '" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>' . $order['quantity'] . '</td>
                                                    <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                    <td>' . $order['discount'] . ' </td>
                                                    <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                    <td><span class="badge bg-warning text-dark">Chờ xử lý</span></td>
                                                    <td>
                                                        <p>
                                                            <a class="btn btn-primary active" data-bs-toggle="collapse" href="#collapseOrder' . $order['order_id'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                Xem chi tiết
                                                            </a>
                                                        </p>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="9" class="p-0">
                                                        <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                            <div class="card card-body w-100">
                                                                <ul class="list-unstyled">
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                            <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                            <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                        <div class="text-center border border-2 rounded border-color p-4">
                                            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                            <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                        </div>
                                    </section>
                                    ';
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </section>
            </div>



            <div class="tab-content mt-5" id="deliverying">
                <section class="mt-4">
                    <table class="table text-black">
                        <?php
                            include_once('controller/OrderDetail/OrderDetailController.php');
                            include_once('controller/User/UserController.php');

                            $orderDetailController = new OrderDetailController();
                            $userController = new UserController();

                            if (isset($_SESSION["success_message"]) && isset($_SESSION["emailUserLoginGoogle"])) {

                                $userId = $userController->getUserIdByEmailController($_SESSION["emailUserLoginGoogle"]);
                                $allSellOrder = $orderDetailController->getAllOrderDetailByRoleSeller($userId);

                                $stt = 1;

                                if (!empty($allSellOrder)) {
                                    echo '<thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giảm giá</th>
                                                <th scope="col">Thành tiền</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                    foreach ($allSellOrder as $order) {

                                        if ($order['role_seller_id'] == 1) {
                                            if($order['order_status'] == 4){
                                                echo '      
                                            <tr>
                                                <th scope="row">' . $stt++ . '</th>
                                                <td>' . $order['product_name'] . '</td>
                                                <td>
                                                    <img src="asset/image/product/' . $order['image_name'] . '" alt="' . $order['image_name'] . '" height="50" width="50" class="img-fluid">
                                                </td>
                                                <td>' . $order['quantity'] . '</td>
                                                <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                <td>' . $order['discount'] . ' </td>
                                                <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                <td><span class="badge bg-info text-dark">Đang giao</span></td>
                                                <td>
                                                    <p>
                                                        <a class="btn btn-primary active" data-bs-toggle="collapse" href="#collapseOrder' . $order['order_id'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                            Xem chi tiết
                                                        </a>
                                                    </p>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="9" class="p-0">
                                                    <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                        <div class="card card-body w-100">
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                        <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                    </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                </li>
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                        <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                        <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                    </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                </li>
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                    </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>';
                                            }
                                            
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                        <div class="text-center border border-2 rounded border-color p-4">
                                            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                            <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                        </div>
                                    </section>
                                    ';
                                }
                            } else {
                                $userId = $userController->getUserIdByEmailController($_SESSION["email"]);
                                $allSellOrder = $orderDetailController->getAllOrderDetailByRoleSeller($userId);

                                $stt = 1;

                                if ($allSellOrder) {

                                    echo '<thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giảm giá</th>
                                                <th scope="col">Thành tiền</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                    foreach ($allSellOrder as $order) {
                                        if ($order['role_seller_id'] == 1) {
                                            if($order['order_status'] == 4){
                                                echo '      
                                                <tr>
                                                    <th scope="row">' . $stt++ . '</th>
                                                    <td>' . $order['product_name'] . '</td>
                                                    <td>
                                                        <img src="asset/image/product/' . $order['image_name'] . '" alt="' . $order['image_name'] . '" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>' . $order['quantity'] . '</td>
                                                    <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                    <td>' . $order['discount'] . ' </td>
                                                    <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                    <td><span class="badge bg-info text-dark">Đang giao</span></td>
                                                    <td>
                                                        <p>
                                                            <a class="btn btn-primary active" data-bs-toggle="collapse" href="#collapseOrder' . $order['order_id'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                Xem chi tiết
                                                            </a>
                                                        </p>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="9" class="p-0">
                                                        <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                            <div class="card card-body w-100">
                                                                <ul class="list-unstyled">
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                            <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                            <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                        <div class="text-center border border-2 rounded border-color p-4">
                                            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                            <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                        </div>
                                    </section>
                                    ';
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </section>
            </div>



            <div class="tab-content mt-5" id="deliveried">
                <section class="mt-4">
                    <table class="table text-black">
                        <?php
                            include_once('controller/OrderDetail/OrderDetailController.php');
                            include_once('controller/User/UserController.php');

                            $orderDetailController = new OrderDetailController();
                            $userController = new UserController();

                            if (isset($_SESSION["success_message"]) && isset($_SESSION["emailUserLoginGoogle"])) {

                                $userId = $userController->getUserIdByEmailController($_SESSION["emailUserLoginGoogle"]);
                                $allSellOrder = $orderDetailController->getAllOrderDetailByRoleSeller($userId);

                                $stt = 1;

                                if ($allSellOrder) {
                                    echo '<thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giảm giá</th>
                                                <th scope="col">Thành tiền</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                    foreach ($allSellOrder as $order) {

                                        if ($order['role_seller_id'] == 1) {
                                            if($order['order_status'] == 1){
                                                echo '      
                                            <tr>
                                                <th scope="row">' . $stt++ . '</th>
                                                <td>' . $order['product_name'] . '</td>
                                                <td>
                                                    <img src="asset/image/product/' . $order['image_name'] . '" alt="' . $order['image_name'] . '" height="50" width="50" class="img-fluid">
                                                </td>
                                                <td>' . $order['quantity'] . '</td>
                                                <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                <td>' . $order['discount'] . ' </td>
                                                <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                <td><span class="badge bg-success text-dark">Đã giao</span></td>
                                                <td>
                                                    <p>
                                                        <a class="btn btn-primary active" data-bs-toggle="collapse" href="#collapseOrder' . $order['order_id'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                            Xem chi tiết
                                                        </a>
                                                    </p>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="9" class="p-0">
                                                    <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                        <div class="card card-body w-100">
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                        <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                    </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                </li>
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                        <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                        <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                    </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                </li>
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                    </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>';
                                            }
                                            
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                        <div class="text-center border border-2 rounded border-color p-4">
                                            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                            <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                        </div>
                                    </section>
                                    ';
                                }
                            } else {
                                $userId = $userController->getUserIdByEmailController($_SESSION["email"]);
                                $allSellOrder = $orderDetailController->getAllOrderDetailByRoleSeller($userId);

                                $stt = 1;

                                if ($allSellOrder) {

                                    echo '<thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giảm giá</th>
                                                <th scope="col">Thành tiền</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                    foreach ($allSellOrder as $order) {
                                        if ($order['role_seller_id'] == 1) {
                                            if($order['order_status'] == 1){
                                                echo '      
                                                <tr>
                                                    <th scope="row">' . $stt++ . '</th>
                                                    <td>' . $order['product_name'] . '</td>
                                                    <td>
                                                        <img src="asset/image/product/' . $order['image_name'] . '" alt="' . $order['image_name'] . '" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>' . $order['quantity'] . '</td>
                                                    <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                    <td>' . $order['discount'] . ' </td>
                                                    <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                    <td><span class="badge bg-success text-dark">Đã giao</span></td>
                                                    <td>
                                                        <p>
                                                            <a class="btn btn-primary active" data-bs-toggle="collapse" href="#collapseOrder' . $order['order_id'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                Xem chi tiết
                                                            </a>
                                                        </p>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="9" class="p-0">
                                                        <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                            <div class="card card-body w-100">
                                                                <ul class="list-unstyled">
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                            <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                            <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                        <div class="text-center border border-2 rounded border-color p-4">
                                            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                            <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                        </div>
                                    </section>
                                    ';
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </section>
            </div>



            <div class="tab-content mt-5" id="canceled-sell">
                <section class="mt-4">
                    <table class="table text-black">
                        <?php
                            include_once('controller/OrderDetail/OrderDetailController.php');
                            include_once('controller/User/UserController.php');

                            $orderDetailController = new OrderDetailController();
                            $userController = new UserController();

                            if (isset($_SESSION["success_message"]) && isset($_SESSION["emailUserLoginGoogle"])) {

                                $userId = $userController->getUserIdByEmailController($_SESSION["emailUserLoginGoogle"]);
                                $allSellOrder = $orderDetailController->getAllOrderDetailByRoleSeller($userId);

                                $stt = 1;

                                if ($allSellOrder) {
                                    echo '<thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giảm giá</th>
                                                <th scope="col">Thành tiền</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                    foreach ($allSellOrder as $order) {

                                        if ($order['role_seller_id'] == 1) {
                                            if($order['order_status'] == 0){
                                                echo '      
                                            <tr>
                                                <th scope="row">' . $stt++ . '</th>
                                                <td>' . $order['product_name'] . '</td>
                                                <td>
                                                    <img src="asset/image/product/' . $order['image_name'] . '" alt="' . $order['image_name'] . '" height="50" width="50" class="img-fluid">
                                                </td>
                                                <td>' . $order['quantity'] . '</td>
                                                <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                <td>' . $order['discount'] . ' </td>
                                                <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                <td><span class="badge bg-danger text-dark">Hoàn tiền/Đã huỷ</span></td>
                                                <td>
                                                    <p>
                                                        <a class="btn btn-primary active" data-bs-toggle="collapse" href="#collapseOrder' . $order['order_id'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                            Xem chi tiết
                                                        </a>
                                                    </p>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="9" class="p-0">
                                                    <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                        <div class="card card-body w-100">
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                        <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                    </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                </li>
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                        <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                        <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                    </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                </li>
                                                                <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày huỷ hàng: ' . $order['o_update_at'] .'
                                                                    </li>
                                                                <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                    </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>';
                                            }
                                            
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                        <div class="text-center border border-2 rounded border-color p-4">
                                            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                            <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                        </div>
                                    </section>
                                    ';
                                }
                            } else {
                                $userId = $userController->getUserIdByEmailController($_SESSION["email"]);
                                $allSellOrder = $orderDetailController->getAllOrderDetailByRoleSeller($userId);

                                $stt = 1;

                                if ($allSellOrder) {

                                    echo '<thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Sản phẩm</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Số lượng</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Giảm giá</th>
                                                <th scope="col">Thành tiền</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                    foreach ($allSellOrder as $order) {
                                        if ($order['role_seller_id'] == 1) {
                                            if($order['order_status'] == 0){
                                                echo '      
                                                <tr>
                                                    <th scope="row">' . $stt++ . '</th>
                                                    <td>' . $order['product_name'] . '</td>
                                                    <td>
                                                        <img src="asset/image/product/' . $order['image_name'] . '" alt="' . $order['image_name'] . '" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>' . $order['quantity'] . '</td>
                                                    <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                    <td>' . $order['discount'] . ' </td>
                                                    <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                    <td><span class="badge bg-danger text-dark">Hoàn tiền/Đã huỷ</span></td>
                                                    <td>
                                                        <p>
                                                            <a class="btn btn-primary active" data-bs-toggle="collapse" href="#collapseOrder' . $order['order_id'] . '" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                Xem chi tiết
                                                            </a>
                                                        </p>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="9" class="p-0">
                                                        <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                            <div class="card card-body w-100">
                                                                <ul class="list-unstyled">
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                                                                            <path d="M6.804 8 1 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                            <path d="M14.804 8 9 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696z"/>
                                                                        </svg>  Mã đơn hàng: ' . $order['order_id'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] . '
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                                                        </svg> Ngày huỷ hàng: ' . $order['o_update_at'] .'
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] . '" class="text-primary">' . $order['product_name'] . '</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    }
                                } else {
                                    echo '
                                    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                        <div class="text-center border border-2 rounded border-color p-4">
                                            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                            <label class="text-black" for="">Chưa đăng bán sản phẩm nào! Đăng ký <a href="index.php?page=registrationProduct" class="text-primary">tại đây</a></label>
                                        </div>
                                    </section>
                                    ';
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </section>
            </div>


        </div>
    </section>
    <?php
    include_once('view/layout/header/button_backtotop.php');
    ?>

    <?php
    include_once('script.php');
    ?>
    <?php
    include_once('view/layout/footer/footer.php');
    ?>

    <?php
    include_once('view/layout/footer/lib-cdn-js.php');
    ?>
</body>

</html>