<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hỗ trợ người mua</title>

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

<section class="pb-4 my-4">
    <div class="container">
        <div class="row">
            <!-- Cột bên trái: Menu điều hướng -->
            <div class="col-md-4">
                <nav id="navbar-example3" class="content-card navbar flex-column align-items-stretch p-3 position-sticky" style="height: 100vh; overflow-y: auto; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <h5 class="text-primary fw-bold mb-3">Mua hàng tại ORANIC</h5>
                    <nav class="nav nav-pills flex-column mb-4">
                        <a class="nav-link text-dark" href="#item-1">Mua hàng tại ORANIC như thế nào?</a>
                        <a class="nav-link text-dark" href="#item-2">ORANIC Official Store</a>
                        <a class="nav-link text-dark" href="#item-3">Chat với người bán</a>
                        <a class="nav-link text-dark" href="#item-4">Tính năng Đánh giá</a>
                    </nav>
                    <h5 class="text-primary fw-bold mb-3">An toàn mua hàng</h5>
                    <nav class="nav nav-pills flex-column mb-4">
                        <a class="nav-link text-dark" href="#item-5">Mẹo mua hàng</a>
                        <a class="nav-link text-dark" href="#item-6">Chuyên mục Bất Động Sản</a>
                    </nav>
                    <h5 class="text-primary fw-bold mb-3">Quy định cần biết</h5>
                    <nav class="nav nav-pills flex-column">
                        <a class="nav-link text-dark" href="#item-7">Quy định chung</a>
                        <a class="nav-link text-dark" href="#item-8">Quy định về tính năng và dịch vụ</a>
                    </nav>
                </nav>
            </div>

            <!-- Cột bên phải: Nội dung -->
            <div class="col-md-8" style="height: 100vh; overflow-y: auto;">
                <div class="content-card p-4 mb-4 bg-white rounded-4" id="item-1">
                    <h5 class="text-primary fw-bold">Mua hàng tại ORANIC như thế nào?</h5>
                    <p><a href="index.php?page=helpBuyerAll/timkiem" class="text-decoration-none text-dark ">Các bước tìm kiếm một sản phẩm</a></p>
                    <p><a href="index.php?page=helpBuyerAll/meo" class="text-decoration-none text-dark">Mẹo tìm kiếm hiệu quả</a></p>
                </div>
                <div class="content-card p-4 mb-4 bg-white rounded-4" id="item-5">
                    <h5 class="text-primary fw-bold">Mẹo mua hàng</h5>
                    <p><a href="index.php?page=helpBuyerAll/meomuahang" class="text-decoration-none text-dark">Mẹo mua hàng an toàn</a></p>
                    <p><a href="index.php?page=helpBuyerAll/muaxe" class="text-decoration-none text-dark">Cách mua xe an toàn ở ORANIC</a></p>
                </div>
                <div class="content-card p-4 mb-4 bg-white rounded-4" id="item-7">
                    <h5 class="text-primary fw-bold">Quy định chung</h5>
                    <p><a href="index.php?page=helpBuyerAll/gioithieu" class="text-decoration-none text-dark">Giới thiệu website ORANIC</a></p>
                    <p><a href="index.php?page=helpBuyerAll/quyche" class="text-decoration-none text-dark">Quy chế tài khoản</a></p>
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