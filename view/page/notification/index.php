<?php
if ((!isset($_SESSION['success_message']) && !isset($_SESSION['email'])) || (!isset($_SESSION['emailUserLoginGoogle']) && !isset($_SESSION['success_message']))) {
    header('Location: index.php?page=login');
    $_SESSION['info_login'] = "Thông báo đăng nhập.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thông báo</title>

    <?php
    include_once('view/layout/header/lib_cdn.php');
    ?>

</head>

<body>

    <!-- <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div> -->

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
    include_once('controller/Notification/NotificationController.php');
    $notificationController = new NotificationController();

    $dataNotis = $notificationController->getAllNotificationByUserIdController($_SESSION['user_id']);
    if ($dataNotis->num_rows > 0) {
        echo '
        <section class="container pb-4 my-4" style="height: 50vh;">
            <div class="container py-5">
                <div class="row mb-4">
                    <h4 class="text-black">Danh sách thông báo</h4>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-group-noti">';
        foreach ($dataNotis as $dataNoti) {
            $notificationId = $dataNoti['notification_id'];
            $title = json_encode($dataNoti['notification_name']);
            $content = json_encode(value: $dataNoti['content']);
            $timeCreate = json_encode($dataNoti['create_at']);
            echo "          
                                <li class='list-group-item list-group-item-noti border-color notification-title'>
                                    <a href='javascript:void(0);' class='text-decoration-none' onclick='showDetail($title, $content, $timeCreate)'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-bell' viewBox='0 0 16 16'>
                                            <path d='M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6'/>
                                        </svg>&nbsp;
                                        " . $dataNoti['notification_name'] . "
                                    </a>
                                </li>
                                ";
        }
        echo '           </ul>
                </div>
                <div class="col-md-8">
                    <div id="notification-detail" class="p-3 border-color rounded-3 text-black" style="min-height: 150px;">
                        <p class="text-black fst-italic">Vui lòng chọn một thông báo để xem chi tiết.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>';
    }
    else{
        echo '
        <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
            <div class="text-center border border-2 rounded border-color p-4">
                <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                <label class="text-black mt-2" for="">Chưa có thông báo nào!</label>
            </div>
        </section>
        ';
    }
    ?>

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