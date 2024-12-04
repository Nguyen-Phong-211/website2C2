<?php 
    if((!isset($_SESSION['success_message']) && !isset($_SESSION['email'])) || (!isset($_SESSION['emailUserLoginGoogle']) && !isset($_SESSION['success_message']))){
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
    include_once('view/layout/slider/slider.php');
    ?>


    <?php
    include_once('view/layout/pagination/index.php');
    ?>

    <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
        <div class="text-center border border-2 rounded border-color p-4">
            <img src="asset/image/general/list.png" alt="Thông báo" class="img-fluid w-25 h-25"> <br>
            <label class="text-black" for="">Chưa có thông báo nào!</label>
        </div>
    </section>

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