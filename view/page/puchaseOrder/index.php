<?php 
    if((!isset($_SESSION['success_message']) && !isset($_SESSION['email'])) || (!isset($_SESSION['emailUserLoginGoogle']) && !isset($_SESSION['success_message']))){
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

    <section class="container pb-4 my-4 text-black">
        <div class="container mt-5">
            <ul class="nav nav-tabs">
                <li class="nav-item nav-tabs-item col-lg-2 text-center fw-bold">
                    <a class="nav-link active" href="#" data-target="all-puchase">Tất cả</a>
                </li>
                <li class="nav-item nav-tabs-item col-lg-2 text-center fw-bold">
                    <a class="nav-link" href="#" data-target="waiting">Chờ xác nhận</a>
                </li>
                <li class="nav-item nav-tabs-item col-lg-2 text-center fw-bold">
                    <a class="nav-link" href="#" data-target="shipping">Chờ nhận hàng</a>
                </li>
                <li class="nav-item nav-tabs-item col-lg-2 text-center fw-bold">
                    <a class="nav-link" href="#" data-target="completed">Hoàn tất</a>
                </li>
                <li class="nav-item nav-tabs-item col-lg-2 text-center fw-bold">
                    <a class="nav-link" href="#" data-target="canceled-puchase">Đã huỷ</a>
                </li>
            </ul>

            <div class="tab-content mt-5" id="all-puchase">
                <section class="mt-4">
                    <table class="table text-black">
                            <?php
                                include_once('controller/OrderDetail/OrderDetailController.php');
                                include_once('controller/User/UserController.php');

                                $orderDetailController = new OrderDetailController();
                                $userController = new UserController();

                                if (isset($_SESSION["success_message"]) && isset($_SESSION["emailUserLoginGoogle"])) {

                                    $userId = $userController->getUserIdByEmailController($_SESSION["emailUserLoginGoogle"]);
                                    $countOrder = $orderDetailController->countOrderDetailByUserIdController($userId);

                                    if($countOrder > 0){
                                        $allPuchaseOrder = $orderDetailController->getAllOrderDetailByUserId($userId);
                                        $stt = 1;
                                        echo '
                                        <thead>
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
                                        <tbody>
                                        ';
                                        foreach($allPuchaseOrder as $order){
                                            echo '
                                            <tr>
                                                <th scope="row">'. $stt++ .'</th>
                                                <td>'. $order['product_name'] .'</td>
                                                <td>
                                                    <img src="asset/image/product/'. $order['image_name'] .'" alt="'. $order['image_name'] .'" height="50" width="50" class="img-fluid">
                                                </td>
                                                <td>'. $order['quantity'] .'</td>
                                                <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                <td>' . $order['discount'] . ' </td>
                                                <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                <td>';
                                                    if($order['status'] == 0){
                                                        echo '<span class="badge bg-danger">Huỷ hàng</span>';
                                                    }elseif($order['status'] == 1){
                                                        echo '<span class="badge bg-success">Hoàn tất</span>';
                                                    }elseif($order['status'] == 2){
                                                        echo '<span class="badge bg-light text-dark">Chờ xác nhận</span>';
                                                    }else{
                                                        echo '<span class="badge bg-primary">Chờ nhận hàng</span>';
                                                    }
                                            echo '</td>
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
                                            </tr>
                                            <tr>
                                                <td colspan="9" class="p-0">
                                                    <div class="collapse" id="collapseOrder' . $order['order_id'] . '">
                                                        <div class="card card-body w-100">';
                                                            if($order['status'] == 0){
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
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] .'
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
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] .'" class="text-primary">' . $order['product_name'] .'</a>
                                                                    </li>
                                                                </ul>
                                                                ';
                                                            }else{
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
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] .'
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] .'" class="text-primary">' . $order['product_name'] .'</a>
                                                                    </li>
                                                                </ul>
                                                                ';
                                                            }
                                            echo '      </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            ';
                                        }
                                    }else{
                                        echo '
                                        <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                            <div class="text-center border border-2 rounded border-color p-4">
                                                <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25 mb-2"> <br>
                                                <label class="text-black" for="">Chưa có đơn hàng nào! Vui lòng tiếp tục mua sắm <a href="index.php?page=product&s_interface=1" class="text-primary mt-2">tại đây</a></label>
                                            </div>
                                        </section>
                                        ';
                                    }
                                }else{

                                    $userId = $userController->getUserIdByEmailController($_SESSION["email"]);
                                    $countOrder = $orderDetailController->countOrderDetailByUserIdController($userId);

                                    if($countOrder > 0){
                                        $allPuchaseOrder = $orderDetailController->getAllOrderDetailByUserId($userId);
                                        $stt = 1;
                                        echo '
                                        <thead>
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
                                        <tbody>
                                        ';
                                        foreach($allPuchaseOrder as $order){
                                            echo '
                                            <tr>
                                                <th scope="row">'. $stt++ .'</th>
                                                <td>'. $order['product_name'] .'</td>
                                                <td>
                                                    <img src="asset/image/product/'. $order['image_name'] .'" alt="'. $order['image_name'] .'" height="50" width="50" class="img-fluid">
                                                </td>
                                                <td>'. $order['quantity'] .'</td>
                                                <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                <td>' . $order['discount'] . ' </td>
                                                <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                <td>';
                                                    if($order['status'] == 0){
                                                        echo '<span class="badge bg-danger">Huỷ hàng</span>';
                                                    }elseif($order['status'] == 1){
                                                        echo '<span class="badge bg-success">Hoàn tất</span>';
                                                    }elseif($order['status'] == 2){
                                                        echo '<span class="badge bg-light text-dark">Chờ xác nhận</span>';
                                                    }else{
                                                        echo '<span class="badge bg-primary">Chờ nhận hàng</span>';
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
                                                                    </svg> Ngày đặt hàng: ' . $order['o_create_at'] .'
                                                            </li>
                                                            <li>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                    </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] .'" class="text-primary">' . $order['product_name'] .'</a>
                                                            </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            ';
                                        }
                                    }else{
                                        echo '
                                        <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                            <div class="text-center border border-2 rounded border-color p-4">
                                                <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25 mb-2"> <br>
                                                <label class="text-black" for="">Chưa có đơn hàng nào! Vui lòng tiếp tục mua sắm <a href="index.php?page=product&s_interface=1" class="text-primary mt-2">tại đây</a></label>
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


            <div class="tab-content mt-5" id="waiting">
                <section class="mt-4">
                    <table class="table text-black">
                            <?php
                                include_once('controller/OrderDetail/OrderDetailController.php');
                                include_once('controller/User/UserController.php');

                                $orderDetailController = new OrderDetailController();
                                $userController = new UserController();

                                if (isset($_SESSION["success_message"]) && isset($_SESSION["emailUserLoginGoogle"])) {

                                    $userId = $userController->getUserIdByEmailController($_SESSION["emailUserLoginGoogle"]);
                                    $countOrder = $orderDetailController->countOrderDetailByUserIdController($userId);

                                    if($countOrder > 0){
                                        $allPuchaseOrder = $orderDetailController->getAllOrderDetailByUserId($userId);
                                        $stt = 1;
                                        echo '
                                        <thead>
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
                                        <tbody>
                                        ';
                                        foreach($allPuchaseOrder as $order){
                                            
                                            if($order['status'] == 2){
                                                echo '
                                                <tr>
                                                    <th scope="row">'. $stt++ .'</th>
                                                    <td>'. $order['product_name'] .'</td>
                                                    <td>
                                                        <img src="asset/image/product/'. $order['image_name'] .'" alt="'. $order['image_name'] .'" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>'. $order['quantity'] .'</td>
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
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] .'
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] .'" class="text-primary">' . $order['product_name'] .'</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                    }else{
                                        echo '
                                        <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                            <div class="text-center border border-2 rounded border-color p-4">
                                                <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25 mb-2"> <br>
                                                <label class="text-black" for="">Chưa có đơn hàng nào! Vui lòng tiếp tục mua sắm <a href="index.php?page=product&s_interface=1" class="text-primary mt-2">tại đây</a></label>
                                            </div>
                                        </section>
                                        ';
                                    }
                                }else{

                                    $userId = $userController->getUserIdByEmailController($_SESSION["email"]);
                                    $countOrder = $orderDetailController->countOrderDetailByUserIdController($userId);

                                    if($countOrder > 0){
                                        $allPuchaseOrder = $orderDetailController->getAllOrderDetailByUserId($userId);
                                        $stt = 1;
                                        echo '
                                        <thead>
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
                                        <tbody>
                                        ';
                                        foreach($allPuchaseOrder as $order){
                                            if($order['status'] == 2){
                                                echo '
                                                <tr>
                                                    <th scope="row">'. $stt++ .'</th>
                                                    <td>'. $order['product_name'] .'</td>
                                                    <td>
                                                        <img src="asset/image/product/'. $order['image_name'] .'" alt="'. $order['image_name'] .'" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>'. $order['quantity'] .'</td>
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
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] .'
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] .'" class="text-primary">' . $order['product_name'] .'</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                    }else{
                                        echo '
                                        <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                            <div class="text-center border border-2 rounded border-color p-4">
                                                <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25 mb-2"> <br>
                                                <label class="text-black" for="">Chưa có đơn hàng nào! Vui lòng tiếp tục mua sắm <a href="index.php?page=product&s_interface=1" class="text-primary mt-2">tại đây</a></label>
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



            <div class="tab-content mt-5" id="shipping">
                <section class="mt-4">
                    <table class="table text-black">
                            <?php
                                include_once('controller/OrderDetail/OrderDetailController.php');
                                include_once('controller/User/UserController.php');

                                $orderDetailController = new OrderDetailController();
                                $userController = new UserController();

                                if (isset($_SESSION["success_message"]) && isset($_SESSION["emailUserLoginGoogle"])) {

                                    $userId = $userController->getUserIdByEmailController($_SESSION["emailUserLoginGoogle"]);
                                    $countOrder = $orderDetailController->countOrderDetailByUserIdController($userId);

                                    if($countOrder > 0){
                                        $allPuchaseOrder = $orderDetailController->getAllOrderDetailByUserId($userId);
                                        $stt = 1;
                                        echo '
                                        <thead>
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
                                        <tbody>
                                        ';
                                        foreach($allPuchaseOrder as $order){
                                            
                                            if($order['status'] == 3){
                                                echo '
                                                <tr>
                                                    <th scope="row">'. $stt++ .'</th>
                                                    <td>'. $order['product_name'] .'</td>
                                                    <td>
                                                        <img src="asset/image/product/'. $order['image_name'] .'" alt="'. $order['image_name'] .'" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>'. $order['quantity'] .'</td>
                                                    <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                    <td>' . $order['discount'] . ' </td>
                                                    <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                    <td><span class="badge bg-primary">Chờ nhận hàng</span></td>
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
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] .'
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] .'" class="text-primary">' . $order['product_name'] .'</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                    }else{
                                        echo '
                                        <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                            <div class="text-center border border-2 rounded border-color p-4">
                                                <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25 mb-2"> <br>
                                                <label class="text-black" for="">Chưa có đơn hàng nào! Vui lòng tiếp tục mua sắm <a href="index.php?page=product&s_interface=1" class="text-primary mt-2">tại đây</a></label>
                                            </div>
                                        </section>
                                        ';
                                    }
                                }else{

                                    $userId = $userController->getUserIdByEmailController($_SESSION["email"]);
                                    $countOrder = $orderDetailController->countOrderDetailByUserIdController($userId);

                                    if($countOrder > 0){
                                        $allPuchaseOrder = $orderDetailController->getAllOrderDetailByUserId($userId);
                                        $stt = 1;
                                        echo '
                                        <thead>
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
                                        <tbody>
                                        ';
                                        foreach($allPuchaseOrder as $order){
                                            if($order['status'] == 3){
                                                echo '
                                                <tr>
                                                    <th scope="row">'. $stt++ .'</th>
                                                    <td>'. $order['product_name'] .'</td>
                                                    <td>
                                                        <img src="asset/image/product/'. $order['image_name'] .'" alt="'. $order['image_name'] .'" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>'. $order['quantity'] .'</td>
                                                    <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                    <td>' . $order['discount'] . ' </td>
                                                    <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                    <td><span class="badge bg-primary">Chờ nhận hàng</span></td>
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
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] .'
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] .'" class="text-primary">' . $order['product_name'] .'</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                    }else{
                                        echo '
                                        <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                            <div class="text-center border border-2 rounded border-color p-4">
                                                <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25 mb-2"> <br>
                                                <label class="text-black" for="">Chưa có đơn hàng nào! Vui lòng tiếp tục mua sắm <a href="index.php?page=product&s_interface=1" class="text-primary mt-2">tại đây</a></label>
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
            <div class="tab-content mt-5" id="completed">
                <section class="mt-4">
                    <table class="table text-black">
                            <?php
                                include_once('controller/OrderDetail/OrderDetailController.php');
                                include_once('controller/User/UserController.php');

                                $orderDetailController = new OrderDetailController();
                                $userController = new UserController();

                                if (isset($_SESSION["success_message"]) && isset($_SESSION["emailUserLoginGoogle"])) {

                                    $userId = $userController->getUserIdByEmailController($_SESSION["emailUserLoginGoogle"]);
                                    $countOrder = $orderDetailController->countOrderDetailByUserIdController($userId);

                                    if($countOrder > 0){
                                        $allPuchaseOrder = $orderDetailController->getAllOrderDetailByUserId($userId);
                                        $stt = 1;
                                        echo '
                                        <thead>
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
                                        <tbody>
                                        ';
                                        foreach($allPuchaseOrder as $order){
                                            
                                            if($order['status'] == 1){
                                                echo '
                                                <tr>
                                                    <th scope="row">'. $stt++ .'</th>
                                                    <td>'. $order['product_name'] .'</td>
                                                    <td>
                                                        <img src="asset/image/product/'. $order['image_name'] .'" alt="'. $order['image_name'] .'" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>'. $order['quantity'] .'</td>
                                                    <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                    <td>' . $order['discount'] . ' </td>
                                                    <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                    <td><span class="badge bg-success">Hoàn tất</span></td>
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
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] .'
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] .'" class="text-primary">' . $order['product_name'] .'</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                    }else{
                                        echo '
                                        <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                            <div class="text-center border border-2 rounded border-color p-4">
                                                <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25 mb-2"> <br>
                                                <label class="text-black" for="">Chưa có đơn hàng nào! Vui lòng tiếp tục mua sắm <a href="index.php?page=product&s_interface=1" class="text-primary mt-2">tại đây</a></label>
                                            </div>
                                        </section>
                                        ';
                                    }
                                }else{

                                    $userId = $userController->getUserIdByEmailController($_SESSION["email"]);
                                    $countOrder = $orderDetailController->countOrderDetailByUserIdController($userId);

                                    if($countOrder > 0){
                                        $allPuchaseOrder = $orderDetailController->getAllOrderDetailByUserId($userId);
                                        $stt = 1;
                                        echo '
                                        <thead>
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
                                        <tbody>
                                        ';
                                        foreach($allPuchaseOrder as $order){
                                            if($order['status'] == 1){
                                                echo '
                                                <tr>
                                                    <th scope="row">'. $stt++ .'</th>
                                                    <td>'. $order['product_name'] .'</td>
                                                    <td>
                                                        <img src="asset/image/product/'. $order['image_name'] .'" alt="'. $order['image_name'] .'" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>'. $order['quantity'] .'</td>
                                                    <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                    <td>' . $order['discount'] . ' </td>
                                                    <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                    <td><span class="badge bg-success">Hoàn tất</span></td>
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
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] .'
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] .'" class="text-primary">' . $order['product_name'] .'</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                    }else{
                                        echo '
                                        <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                            <div class="text-center border border-2 rounded border-color p-4">
                                                <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25 mb-2"> <br>
                                                <label class="text-black" for="">Chưa có đơn hàng nào! Vui lòng tiếp tục mua sắm <a href="index.php?page=product&s_interface=1" class="text-primary mt-2">tại đây</a></label>
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
            <div class="tab-content mt-5" id="canceled-puchase">
                <section class="mt-4">
                    <table class="table text-black">
                    <?php
                                include_once('controller/OrderDetail/OrderDetailController.php');
                                include_once('controller/User/UserController.php');

                                $orderDetailController = new OrderDetailController();
                                $userController = new UserController();

                                if (isset($_SESSION["success_message"]) && isset($_SESSION["emailUserLoginGoogle"])) {

                                    $userId = $userController->getUserIdByEmailController($_SESSION["emailUserLoginGoogle"]);
                                    $countOrder = $orderDetailController->countOrderDetailByUserIdController($userId);

                                    if($countOrder > 0){
                                        $allPuchaseOrder = $orderDetailController->getAllOrderDetailByUserId($userId);
                                        $stt = 1;
                                        echo '
                                        <thead>
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
                                        <tbody>
                                        ';
                                        foreach($allPuchaseOrder as $order){
                                            
                                            if($order['status'] == 0){
                                                echo '
                                                <tr>
                                                    <th scope="row">'. $stt++ .'</th>
                                                    <td>'. $order['product_name'] .'</td>
                                                    <td>
                                                        <img src="asset/image/product/'. $order['image_name'] .'" alt="'. $order['image_name'] .'" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>'. $order['quantity'] .'</td>
                                                    <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                    <td>' . $order['discount'] . ' </td>
                                                    <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                    <td><span class="badge bg-danger">Huỷ hàng</span></td>
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
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] .'
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] .'" class="text-primary">' . $order['product_name'] .'</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                    }else{
                                        echo '
                                        <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                            <div class="text-center border border-2 rounded border-color p-4">
                                                <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25 mb-2"> <br>
                                                <label class="text-black" for="">Chưa có đơn hàng nào! Vui lòng tiếp tục mua sắm <a href="index.php?page=product&s_interface=1" class="text-primary mt-2">tại đây</a></label>
                                            </div>
                                        </section>
                                        ';
                                    }
                                }else{

                                    $userId = $userController->getUserIdByEmailController($_SESSION["email"]);
                                    $countOrder = $orderDetailController->countOrderDetailByUserIdController($userId);

                                    if($countOrder > 0){
                                        $allPuchaseOrder = $orderDetailController->getAllOrderDetailByUserId($userId);
                                        $stt = 1;
                                        echo '
                                        <thead>
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
                                        <tbody>
                                        ';
                                        foreach($allPuchaseOrder as $order){
                                            if($order['status'] == 0){
                                                echo '
                                                <tr>
                                                    <th scope="row">'. $stt++ .'</th>
                                                    <td>'. $order['product_name'] .'</td>
                                                    <td>
                                                        <img src="asset/image/product/'. $order['image_name'] .'" alt="'. $order['image_name'] .'" height="50" width="50" class="img-fluid">
                                                    </td>
                                                    <td>'. $order['quantity'] .'</td>
                                                    <td>' . number_format($order['price'], 0, ',', '.') . '</td>
                                                    <td>' . $order['discount'] . ' </td>
                                                    <td>' . number_format($order['price'] - ($order['price'] * $order['discount']), 0, ',', '.') . '</td>
                                                    <td><span class="badge bg-danger">Huỷ hàng</span></td>
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
                                                                        </svg> Ngày đặt hàng: ' . $order['o_create_at'] .'
                                                                    </li>
                                                                    <li>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                                                        </svg> Xem chi tiết sản phẩm: <a href="index.php?page=detailProduct&idp=' . $order['product_id'] .'" class="text-primary">' . $order['product_name'] .'</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                    }else{
                                        echo '
                                        <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                            <div class="text-center border border-2 rounded border-color p-4">
                                                <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25 mb-2"> <br>
                                                <label class="text-black" for="">Chưa có đơn hàng nào! Vui lòng tiếp tục mua sắm <a href="index.php?page=product&s_interface=1" class="text-primary mt-2">tại đây</a></label>
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
    include_once('script.php');
    ?>


    <?php
    include_once('view/layout/header/button_backtotop.php');
    ?>


    <?php
    include_once('view/layout/footer/footer.php');
    ?>

    <?php
    include_once('view/layout/footer/lib-cdn-js.php');
    ?>
</body>

</html>
