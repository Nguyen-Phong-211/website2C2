



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sản phẩm yêu thích</title>

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


    <!-- <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
        <div class="text-center border border-3 rounded-circle">
            <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
            <label for="">Chưa có sản phẩm nào</label>
        </div>
    </section> -->


    

    <section class="container pb-4 my-4 text-black">
        <div class="container mt-5">
            <div class="row">
                <div class="col-2">Sản phẩm</div>
                <div class="col-2">Giá</div>
                <div class="col-1">Số lượng</div>
                <div class="col-2">Tình trạng</div>
                <div class="col-2"></div>
                <div class="col-2"></div>
            </div>
            <div class="row mt-3">
                <div class="col-2">
                    <img src="images/product-thumb-1.png" alt="Hình ảnh sản phẩm" class="img-fluid tab-image">
                </div>
                <div class="col-2">45.000 đồng</div>
                <div class="col-1">1</div>
                <div class="col-2">
                    <span class="badge bg-primary">Còn hàng</span>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-primary active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-basket3-fill" viewBox="0 0 16 16">
                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
                        </svg>
                        </svg>
                            Thêm vào giỏ hàng
                    </button>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-danger active" style="background-color: rgb(255, 87, 87); color: white;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                        </svg>
                        Xóa
                    </button>
                </div>
            </div>
        </div>
    </section>

    

    <?php
        include_once('view/layout/footer/footer.php');
    ?>

    <?php
        include_once('view/layout/footer/lib-cdn-js.php');
    ?>
</body>

</html>