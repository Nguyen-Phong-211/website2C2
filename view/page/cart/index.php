<?php 
    if((!isset($_SESSION['success_message']) && !isset($_SESSION['email'])) || (!isset($_SESSION['emailUserLoginGoogle']) && !isset($_SESSION['success_message']))){
        header('Location: index.php?page=login');
        $_SESSION['info_login'] = "Thông báo đăng nhập.";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Giỏ hàng</title>

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

    <?php
    include_once('controller/Cart/CartController.php');
    $cartController = new CartController();
    $totalProducts = $cartController->getProductCount(); 
    if ($totalProducts > 0) {
        $cartItems = $cartController->getProductofCartList();
        
    ?>

    <section class="container pb-4 my-4">
        <div class="container mt-2">
            <table class="table text-black" id="productTable">
                <thead>
                    <tr class="">
                        <th scope="col" class="text-center">Sản phẩm</th>
                        <th scope="col" class="text-center">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col" class="text-center">Thành tiền</th>
                        <th scope="col" class="text-center">Tình trạng</th>
                        <th scope="col" class="text-center">Thao tác</th>
                        <th scope="col" class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    foreach ($cartItems as $item): 
                        $productImage = $item['image'];
                        $productPrice = $item['price'];  
                        $quantity = $item['quantity'];   
                        $totalPrice = $productPrice * $quantity; 
                        $productStatus = $item['status']; 
                ?>
                    <tr>
                        <td class="text-center">
                            <img src="asset/image/product/<?= htmlspecialchars($productImage); ?>" alt="Hình ảnh sản phẩm" style="width: 80px; height: 80px;">
                        </td>
                        <td class="text-center">
                            <a href="index.php?page=detailProduct&idp=<?= $item['product_id'] ?>" class="text-primary text-decoration-none"><?= $item['product_name'] ?></a> 
                        </td class="text-center">
                        <td>
                            <?= number_format($productPrice, 0, ',', '.') ?> đồng
                        </td>
                        <td class="text-center">
                            <input type="number" class="form-control border-color text-black quantity" value="<?= $quantity ?>" min="1" style="width: 80px;" onchange="updateCartQuantity(<?= $item['product_id'] ?>, this.value)">
                        </td>
                        <td class="text-center">
                            <span id="total-price-<?= $item['product_id'] ?>">
                                <?= number_format($totalPrice, 0, ',', '.') ?> đồng
                            </span>
                        </td>
                        <td class="text-center">
                        <?php
                            if ($productStatus == 1) {
                                echo '<span class="badge bg-primary">Còn hàng</span>';
                            } else {
                                echo '<span class="badge bg-secondary">Hết hàng</span>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-cancel" onclick="confirmDelete(<?= $item['product_id'] ?>)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                                Xóa
                            </button>
                        </td>

                        <?php 
                            // include_once('controller/Cart/CartController.php');
                            // $cartController = new CartController();
                            // $totalProducts = $cartController->getProductCount(); 
                            // if ($totalProducts > 0) {
                            //     echo '
                            //     <td class="text-center">
                            //         <button type="button" class="btn btn-danger btn-information">
                            //             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bucket" viewBox="0 0 16 16">
                            //                 <path d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5m1.005 0a4.5 4.5 0 0 1 8.945 0zm9.892 1-1.286 8.574a.5.5 0 0 1-.494.426H4.36a.5.5 0 0 1-.494-.426L2.58 6h10.838z"/>
                            //             </svg>
                            //             Đặt hàng
                            //         </button>
                            //     </td>
                            //     ';
                            // }
                        ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <a href="index.php?page=order" class="btn btn-primary col-3" style="margin-left: auto; padding: 5px 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                Đặt Hàng
            </a>
        </div>
        <div class="row mt-3">
            <div class="col-md-5 text-center">
            </div>
            <div class="col-md-6 text-center">
                <p class="text-primary fs-5 fw-bold border-1 border-color rounded-2">Tổng tiền: <span id="totalPrice"></span> đồng</p>
                <script>
                    let priceElements = document.querySelectorAll("span[id^='total-price-']");
                    let totalPrice = 0;

                    priceElements.forEach(priceElement => {
                        let price = priceElement.textContent.replace(' đồng', '').replace(/\./g, '');
                        let numericPrice = parseInt(price, 10);
                        if (!isNaN(numericPrice)) {
                            totalPrice += numericPrice;
                        }
                    });
                    document.getElementById("totalPrice").innerHTML = totalPrice.toLocaleString();
                </script>
            </div>
        </div>
    </section>
    <?php
    } else {
        echo '
        <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 35vh;">
            <div class="text-center border border-2 rounded border-color p-4">
                <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                <label class="text-black" for="">Chưa có sản phẩm trong giỏ hàng! Mua sắm tiếp <a href="index.php?page=home" class="text-primary">tại đây</a></label>
            </div>
        </section>';
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