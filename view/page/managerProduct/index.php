<?php
if ((!isset($_SESSION['success_message']) && !isset($_SESSION['email'])) || (!isset($_SESSION['emailUserLoginGoogle']) && !isset($_SESSION['success_message']))) {
    header('Location: index.php?page=login');
    $_SESSION['info_login'] = "Thông báo đăng nhập.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lý đơn bán</title>

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
    include_once('controller/Product/ProductController.php');
    $productController = new ProductController();
    if ($_SESSION['role_seller_id'] == 1):
        $datas = $productController->getAllProductByUserIdController($_SESSION['user_id']);

    ?>
        <section class="container pb-4 my-4 text-black">
            <div class="mt-5">
                <table class="table text-black">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 1;
                        foreach ($datas as $data): ?>
                            <tr>
                                <th scope="row"><?= $stt++ ?></th>
                                <td><?= $data['product_name'] ?></td>
                                <td><?= $data['quantity'] ?></td>
                                <td><?= number_format($data['price'], 0, ',', '.') ?></td>
                                <td><?= $data['address'] ?></td>
                                <td>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProduct<?= $data['product_id'] ?>" aria-expanded="false" aria-controls="collapseProduct">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="collapse" id="collapseProduct<?= $data['product_id'] ?>">
                                        <div class="card card-body text-black">
                                            <form class="row g-3" method="post" enctype="multipart/form-data">

                                                <div class="col-md-4">
                                                    <label class="form-label">Tên sản phẩm: </label>
                                                    <input type="text" class="form-control form-input-n-blur text-black" name="productName" value="<?= $data['product_name'] ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Số lượng: </label>
                                                    <input type="number" class="form-control form-input-n-blur text-black" name="quantity" value="<?= $data['quantity'] ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Giá: </label>
                                                    <input type="number" class="form-control form-input-n-blur text-black" name="price" value="<?= $data['price'] ?>">
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label">Mô tả:</label>
                                                    <textarea class="form-control form-input-n-blur text-black" name="description" rows="6"><?= $data['description'] ?></textarea>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label">Địa chỉ: </label>
                                                    <input type="text" class="form-control form-input-n-blur text-black" name="address" value="<?= $data['address'] ?>">
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">Hình ảnh: </label>
                                                    <input type="file" accept="image/*" name="productImages[]" multiple class="form-control form-input-n-blur text-black">
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">Hình ảnh trước đó: </label>
                                                    <?php $imageArray = explode(',', $data['image_name']);?>
                                                    <?php foreach ($imageArray as $image): ?>
                                                        <img src="asset/image/product/<?= trim($image) ?>" class="img-fluid" width="200px" height="200px" alt="">
                                                    <?php endforeach; ?>
                                                </div>

                                                <input type="hidden" name="productId" value="<?= $data['product_id'] ?>">
                                                
                                                <div class="col-12">
                                                    <button class="btn btn-primary" name="btnManagementProduct" type="submit">Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>

                        <?php 
                            if(isset($_POST['btnManagementProduct'])){
                                include_once('controller/Product/ProductController.php');
                                $productController = new ProductController();

                                $productController->updateProductController();
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

    <?php endif ?>

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