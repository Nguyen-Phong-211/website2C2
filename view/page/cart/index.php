<!DOCTYPE html>
<html lang="en">

<head>
    <title>Giỏ hàng</title>

    <?php
    include_once('view/layout/header/lib_cdn.php');
    ?>

</head>

<body>

    <!-- Svg -->
    <?php
    // include_once('view/layout/body/svg.php');
    ?>

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




    <section class="container pb-4 my-4">
        <div class="container mt-5">
            <table class="table text-black">
                <thead>
                    <tr class="">
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                        <th scope="col">Tình trạng</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="images/product-thumb-1.png" alt="Hình ảnh sản phẩm" class="img-fluid tab-image">
                        </td>
                        <td>45.000 đồng</td>
                        <td>
                            <input type="number" class="form-control" value="1" min="1" style="width: 80px;">
                        </td>
                        <td class="text-center">
                            45.000 đồng
                        </td>
                        <td>
                            <span class="badge bg-primary">Còn hàng</span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger active" style="background-color: rgb(255, 87, 87); color: white;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                                Xóa
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="images/product-thumb-1.png" alt="Hình ảnh sản phẩm" class="img-fluid tab-image">
                        </td>
                        <td>45.000 đồng</td>
                        <td>
                            <input type="number" class="form-control" value="1" min="1" style="width: 80px;">
                        </td>
                        <td class="text-center">
                            45.000 đồng
                        </td>
                        <td>
                            <span class="badge bg-primary">Còn hàng</span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger active" style="background-color: rgb(255, 87, 87); color: white;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                                Xóa
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="images/product-thumb-1.png" alt="Hình ảnh sản phẩm" class="img-fluid tab-image">
                        </td>
                        <td>45.000 đồng</td>
                        <td>
                            <input type="number" class="form-control" value="1" min="1" style="width: 80px;">
                        </td>
                        <td class="text-center">
                            45.000 đồng
                        </td>
                        <td>
                            <span class="badge bg-primary">Còn hàng</span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger active" style="background-color: rgb(255, 87, 87); color: white;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                                Xóa
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
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