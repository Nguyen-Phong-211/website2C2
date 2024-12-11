<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hỗ trợ người bán và người mua</title>

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
    include_once('controller/General/GeneralController.php');
    $generalController = new GeneralController();
    ?>

    <section class="container-sm pb-4 my-4 mt-5" style="height: 50vh;">
        <div class="row container g-4 d-flex justify-content-evenly">
            <!-- Card 1 -->
            <a class="col-md-5 card p-4 card-link-seller-buyer text-decoration-none" href="index.php?page=helpSeller&ouig_jih=<?= $generalController->generateRandomString() ?>">
                <div class="d-flex align-items-center">
                    <div class="card-icon-seller-buyer">
                        <img src="asset/image/general/seller.png" class="img-fluid" alt="" height="80" width="80">
                    </div>
                    <h3 class="card-title-seller-buyer text-black ms-3">Tôi là người bán</h3>
                </div>
                <p class="card-text fst-italic text-black">Những mẹo vặt, các hướng dẫn giúp bán hàng nhanh chóng và tiện lợi.</p>
            </a>

            <a class="col-md-5 card p-4 card-link-seller-buyer text-decoration-none" href="index.php?page=helpBuyer&ouig_jih=<?= $generalController->generateRandomString() ?>">
                <div class="d-flex align-items-center">
                    <div class="card-icon-seller-buyer">
                        <img src="asset/image/general/buyer.png" class="img-fluid" alt="" height="80" width="80">
                    </div>
                    <h3 class="card-title-seller-buyer text-black ms-3">Tôi là người mua</h3>
                </div>
                <p class="card-text fst-italic text-black">Những mẹo vặt, các hướng dẫn giúp người mua nhanh chóng và tiện lợi.</p>
            </a>
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