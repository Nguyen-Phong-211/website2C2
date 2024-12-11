<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hỗ trợ người bán</title>

    <?php
    include_once('view/layout/header/lib_cdn.php');
    ?>

</head>
<style>
    .iu {
        text-decoration: none;
        margin-left: 20px;
        width: 50%;
        display: flex;
    }
</style>

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

    <section class="pb-4 my-4">
        <div class="container">
            <div class="row">
                <!-- Cột bên trái: Menu điều hướng -->
                <div class="col-md-4">
                    <nav id="navbar-example3" class="content-card navbar flex-column align-items-stretch p-3 position-sticky" style="height: 100vh; overflow-y: auto; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <h5 class="text-primary fw-bold mb-3">Bán hàng tại ORANIC</h5>
                        <nav class="nav nav-pills flex-column mb-4">
                            <a class="nav-link text-dark" href="#item-1">Bán hàng trên ORANIC như thế nào?</a>
                            <a class="nav-link text-dark" href="#item-2">ORANIC kiểm duyệt tin rao như thế nào?</a>
                            <a class="nav-link text-dark" href="#item-3">Hỗ trợ tài khoản</a>
                            <a class="nav-link text-dark" href="#item-4">Chat với người bán</a>
                        </nav>
                        <h5 class="text-primary fw-bold mb-3">Dịch vụ có tính phí</h5>
                        <nav class="nav nav-pills flex-column mb-4">
                            <a class="nav-link text-dark" href="#item-9">Đẩy tin</a>
                            <a class="nav-link text-dark" href="#item-10">Gói đẩy tin</a>
                            <a class="nav-link text-dark" href="#item-11">Tin ưu tiên</a>
                        </nav>
                        <h5 class="text-primary fw-bold mb-3">Phương thức thanh toán</h5>
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link text-dark" href="#item-17">Người bán và người mua sẽ trao đổi với nhau.</a>
                        </nav>
                    </nav>
                </div>

                <!-- Cột bên phải: Nội dung -->
                <div class="col-md-8" style="height: 100vh; overflow-y: auto;">
                    <div class="content-card p-4 mb-4 bg-white rounded-4" id="item-1">
                        <h5 class="text-primary fw-bold">Bán hàng trên ORANIC như thế nào?</h5>
                        <p><a href="index.php?page=helpSellerAll/cacbuocraoban1monhang" class="text-decoration-none text-dark">Các bước rao bán 1 món hàng</a></p>
                        <p><a href="index.php?page=helpSellerAll/dangtin" class="text-decoration-none text-dark">Đăng tin với ứng dụng ORANIC</a></p>
                    </div>
                    <div class="content-card p-4 mb-4 bg-white rounded-4" id="item-2">
                        <h5 class="text-primary fw-bold">ORANIC kiểm duyệt tin rao của tôi như thế nào?</h5>
                        <p><a href="index.php?page=helpSellerAll/taisao" class="text-decoration-none text-dark">Tại sao ORANIC duyệt tin trước khi đăng?</a></p>
                        <p><a href="index.php?page=helpSellerAll/tuchoi" class="text-decoration-none text-dark">Tại sao tin của tôi bị từ chối?</a></p>
                    </div>
                    <div class="content-card p-4 mb-4 bg-white rounded-4" id="item-3">
                        <h5 class="text-primary fw-bold">Hỗ trợ tài khoản</h5>
                        <p><a href="index.php?page=helpSellerAll/lamsao" class="text-decoration-none text-dark">Làm sao đăng ký tài khoản?</a></p>
                        <p><a href="index.php?page=helpSellerAll/lamgi" class="text-decoration-none text-dark">Tôi cần làm gì để thay đổi thông tin cá nhân (Số điện thoại, Email, …)?</a></p>
                    </div>
                    <div class="content-card p-4 mb-4 bg-white rounded-4" id="item-4">
                        <h5 class="text-primary fw-bold">Chat với người bán</h5>
                        <p><a href="index.php?page=helpSellerAll/chat" class="text-decoration-none text-dark">Chat với Người Bán là gì?</a></p>
                        <p><a href="index.php?page=helpSellerAll/antoan" class="text-decoration-none text-dark">An toàn khi sử dụng tính năng Chat với Người Bán</a></p>
                    </div>
                </div>
            </div>
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