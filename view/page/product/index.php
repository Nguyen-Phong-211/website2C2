<?php
if ((!isset($_SESSION['success_message']) && !isset($_SESSION['email'])) || (!isset($_SESSION['emailUserLoginGoogle']) && !isset($_SESSION['success_message']))) {
    header('Location: index.php?page=login');
    $_SESSION['info_login'] = "Thông báo đăng nhập.";
}
?>
<?php
if (isset($_REQUEST['deleteWishlist']) && isset($_REQUEST['whistlistId'])) {
    include_once('controller/Whistlist/WhistlistController.php');

    $whistlistController = new WhistlistController();

    $result = $whistlistController->removeFromWhistlistController($_REQUEST['whistlistId']);
    if ($result === true) {
        $_SESSION['whistlist_success_message'] = true;
    }
}
?>
<!-- notification of whistlist is add product success -->
<?php if (isset($_SESSION['whistlist_success_message']) && $_SESSION['whistlist_success_message'] === true): ?>

    <div class="modal fade border-color shadow-sm" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title font-monospace text-black" id="staticBackdropLabel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#198753" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                        <small>
                            Xoá sản phẩm khỏi danh sách yêu thích thành công!
                        </small>
                    </p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <?php
    $page = $_REQUEST['page'] ?? 'default_page';
    $idc = $_REQUEST['idc'] ?? 'default_idc';

    echo "
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modalElement = document.getElementById('staticBackdrop');
                const modalInstance = new bootstrap.Modal(modalElement);

                modalInstance.show();

                setTimeout(() => {
                    modalInstance.hide();
                    window.location.href = 'index.php?page=$page&idc=$idc';
                }, 500);
            });
            </script>
            ";
    ?>


    <?php
    unset($_SESSION['whistlist_success_message']);
    ?>

<?php endif; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?php
        if (isset($_REQUEST['idc'])) {
            include_once('controller/Category/CategoryController.php');
            $categoryController = new CategoryController();
            $datas = $categoryController->getCategoryList();

            $nameCategory = $_REQUEST['idc'];
            $namePage = $_REQUEST['page'];

            foreach ($datas as $data) {
                if ($namePage == 'product' && $nameCategory == $data['category_id']) {
                    echo 'Danh mục - ' . $data['category_name'];
                    break;
                }
            }
        } else {
            echo 'Khám phá danh mục';
        }
        ?>
    </title>
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
    include_once('view/layout/slider/slider.php');
    ?>

    <?php
    include_once('view/layout/pagination/index.php');
    ?>

    <div class="row">

        <div class="col-md-12">

            <section class="py-5 overflow-hidden">
                <div class="container-lg">
                    <div class="row">
                        <div class="col-md-12">

                            <div
                                class="section-header d-flex flex-wrap justify-content-between mb-5">
                                <h2 class="section-title">Khám phá danh mục
                                    <?php

                                    if (isset($_REQUEST['idc'])) {
                                        include_once('controller/Category/CategoryController.php');
                                        $categoryController = new CategoryController();
                                        $datas = $categoryController->getCategoryList();

                                        $nameCategory = $_REQUEST['idc'];
                                        $namePage = $_REQUEST['page'];

                                        foreach ($datas as $data) {
                                            if ($namePage == 'product' && $nameCategory == $data['category_id']) {
                                                echo $data['category_name'];
                                                break;
                                            }
                                        }
                                    }
                                    ?>
                                </h2>

                                <div class="d-flex align-items-center">
                                    <a href="#" class="btn btn-primary me-2">Xem tất cả</a>

                                    <div class="swiper-buttons">
                                        <button
                                            class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                                        <button
                                            class="swiper-next category-carousel-next btn btn-yellow">❯</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="category-carousel swiper">
                                <div class="swiper-wrapper">
                                    <?php
                                    if (isset($_REQUEST['idc'])) {
                                        include_once('controller/CategoryItem/CategoryItemController.php');
                                        $categoryItemController = new CategoryItemController();

                                        $idCategory = $_REQUEST['idc'];

                                        $datas = $categoryItemController->getAllListCategoryItemByCategoryController($idCategory);

                                        foreach ($datas as $data) {
                                            echo '
                                            <a href="index.php?page=product&idc=' . $data['category_id'] . '&idci=' . $data['category_item_id'] . '&fdh_op=oikHk5tRF"
                                                class="nav-link swiper-slide text-center">
                                                <img src="asset/image/category_item/' . $data['image'] . '" height="120" width="120" class="rounded" alt="' . $data['category_item_name'] . '">
                                                <h4 class="fs-6 mt-3 fw-normal category-title">' . $data['category_item_name'] . '</h4>
                                            </a>
                                            ';
                                        }
                                    } else {
                                        include_once('controller/Category/CategoryController.php');
                                        $getCategory = new CategoryController();
                                        $datas = $getCategory->getCategoryList();

                                        foreach ($datas as $data) {
                                            echo '
                                                <a href="index.php?page=product&idc=' . $data['category_id'] . '&df_sw=UHhgPl0k9"
                                                    class="nav-link swiper-slide text-center">
                                                    <img src="asset/image/category/' . $data['image'] . '" height="120" width="120" class="rounded" alt="' . $data['category_name'] . '">
                                                    <h4 class="fs-6 mt-3 fw-normal category-title">' . $data['category_name'] . '</h4>
                                                </a>
                                                ';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>

        <div class="row">
            <?php
            include_once('filter.php');
            ?>

            <div class="col-md-9">
                <section class="pb-5">
                    <div class="container-lg">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-header d-flex flex-wrap justify-content-between my-3">
                                    <h2 class="section-title">
                                        Có gì hot hôm nay
                                    </h2>
                                </div>
                            </div>
                            <?php
                            include_once('select_filter.php')
                            ?>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row" id="product-list">

                                    <?php

                                    include_once('controller/Product/ProductController.php');
                                    $productController = new ProductController();

                                    if (isset($_REQUEST['idc']) && isset($_REQUEST['df_sw']) && !isset($_REQUEST['htj'])) {

                                        $idc = $_GET['idc'];
                                        $count = 0;

                                        $dataProducts = $productController->getProductByCategoryIdController($idc);

                                        foreach ($dataProducts as $dataProduct) {

                                            if ($count % 4 == 0 && $count != 0) {
                                                echo '</div><div class="row">';
                                            }
                                            echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4 ">
                                                    <div class="product-item border rounded p-3">
                                                        <figure>
                                                            <a href="index.php?page=detailProduct&idp=' . $dataProduct['product_id'] . '" title="' . $dataProduct['product_name'] . '">
                                                                <img src="asset/image/product/' . $dataProduct['image_name'] . '" alt="' . $dataProduct['image_name'] . '" class="tab-image img-fluid">
                                                            </a>
                                                        </figure>
                                                        <div class="d-flex flex-column text-center">
                                                            <a class="fs-6 fw-normal text-truncate text-decoration-none" href="index.php?page=detailProduct&idp=' . $dataProduct['product_id'] . '">' . $dataProduct['product_name'] . '</a>
                                                            <div>
                                                                <span class="rating">';

                                            if ($dataProduct['rating_star'] >= 4.6 && $dataProduct['rating_star'] <= 5) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($dataProduct['rating_star'] == 4.5) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                            <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($dataProduct['rating_star'] >= 4 && $dataProduct['rating_star'] <= 4.4) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($dataProduct['rating_star'] >= 3.5 && $dataProduct['rating_star'] <= 3.9) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                            <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($dataProduct['rating_star'] == 3) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($dataProduct['rating_star'] >= 2.5 && $dataProduct['rating_star'] <= 2.9) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                            <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($dataProduct['rating_star'] == 2) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($dataProduct['rating_star'] >= 1.5 && $dataProduct['rating_star'] <= 1.9) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                            <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($dataProduct == 1) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                    ';
                                            } else {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                            <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                        </svg>
                                                                    ';
                                            }

                                            echo                '</span>
                                                                <span>
                                                                    (' . $dataProduct['quantity'] . ')
                                                                </span>
                                                            </div>

                                                            <div class="d-flex justify-content-center align-items-center gap-2">

                                                                <span class="text-danger fw-bold">' . number_format($dataProduct['price'], 0, ',', '.') . '<sup>đ</sup></span>

                                                                <span class="badge rounded fw-bold px-1 fs-7 lh-1 bg-warning text-black ms-2">
                                                                    ' . $dataProduct['discount'] . '% OFF
                                                                </span>
                                                            </div>
                                                            <div class="button-area p-3 pt-0">
                                                                <div class="row g-1 mt-2">

                                                                    <div class="col-9">
                                                                        <a href="javascript:void(0);" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart" 
                                                                        onclick="addToCart(' . $dataProduct['product_id'] . ')">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                                                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                                            </svg> Thêm vào giỏ hàng
                                                                        </a>
                                                                    </div>

                                                                    <div class="col-3">';
                                            if ($dataProduct['wstatus'] === NULL) {
                                                echo '
                                                                        <form action="index.php?page=whistlist" method="post">
                                                                            <input type="hidden" name="productId" value="' . $dataProduct['product_id'] . '"> 
                                                                            <button type="submit" name="action" value="add_to_wishlist" class="btn btn-outline-danger rounded-1 p-2 fs-6">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                                                                </svg>
                                                                            </button>
                                                                        </form>
                                                                        ';
                                            } else {
                                                echo '
                                                                        <form action="" method="post">
                                                                            <input type="hidden" name="whistlistId" value="' . $dataProduct['whistlist_id'] . '">
                                                                            <button type="submit" name="deleteWishlist" value="deleteWishlist" class="btn btn-outline-danger rounded-1 p-2 fs-6">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                                                </svg>
                                                                            </button>
                                                                        </form>
                                                                        ';
                                            }
                                            echo '              </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                ';
                                        }
                                    } elseif (isset($_REQUEST['idci']) && isset($_REQUEST['fdh_op'])) {
                                        $count = 0;

                                        $getProductByCateoryItems = $productController->getProductByCategoryItemController($_REQUEST['idc'], $_REQUEST['idci']);
                                        if ($getProductByCateoryItems->num_rows > 0) {
                                            foreach ($getProductByCateoryItems as $getProductByCateoryItem) {

                                                if ($count % 4 == 0 && $count != 0) {
                                                    echo '</div><div class="row">';
                                                }
                                                echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4 ">
                                                        <div class="product-item border rounded p-3">
                                                            <figure>
                                                                <a href="index.php?page=detailProduct&idp=' . $getProductByCateoryItem['product_id'] . '" title="' . $getProductByCateoryItem['product_name'] . '">
                                                                    <img src="asset/image/product/' . $getProductByCateoryItem['image_name'] . '" alt="' . $getProductByCateoryItem['image_name'] . '" class="tab-image img-fluid">
                                                                </a>
                                                            </figure>
                                                            <div class="d-flex flex-column text-center">
                                                                <a class="fs-6 fw-normal text-truncate text-decoration-none" href="index.php?page=detailProduct&idp=' . $getProductByCateoryItem['product_id'] . '">' . $getProductByCateoryItem['product_name'] . '</a>
                                                                <div>
                                                                    <span class="rating">';

                                                if ($getProductByCateoryItem['rating_star'] >= 4.6 && $getProductByCateoryItem['rating_star'] <= 5) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getProductByCateoryItem['rating_star'] == 4.5) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getProductByCateoryItem['rating_star'] >= 4 && $getProductByCateoryItem['rating_star'] <= 4.4) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getProductByCateoryItem['rating_star'] >= 3.5 && $getProductByCateoryItem['rating_star'] <= 3.9) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getProductByCateoryItem['rating_star'] == 3) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getProductByCateoryItem['rating_star'] >= 2.5 && $getProductByCateoryItem['rating_star'] <= 2.9) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getProductByCateoryItem['rating_star'] == 2) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getProductByCateoryItem['rating_star'] >= 1.5 && $getProductByCateoryItem['rating_star'] <= 1.9) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getProductByCateoryItem == 1) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } else {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                }

                                                echo                '</span>
                                                                    <span>
                                                                        (' . $getProductByCateoryItem['quantity'] . ')
                                                                    </span>
                                                                </div>
    
                                                                <div class="d-flex justify-content-center align-items-center gap-2">
    
                                                                    <span class="text-danger fw-bold">' . number_format($getProductByCateoryItem['price'], 0, ',', '.') . '<sup>đ</sup></span>
    
                                                                    <span class="badge rounded fw-bold px-1 fs-7 lh-1 bg-warning text-black ms-2">
                                                                        ' . $getProductByCateoryItem['discount'] . '% OFF
                                                                    </span>
                                                                </div>
                                                                <div class="button-area p-3 pt-0">
                                                                    <div class="row g-1 mt-2">
                                                                        <div class="col-9">
                                                                            <a href="javascript:void(0);" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart" 
                                                                            onclick="addToCart(' . $getProductByCateoryItem['product_id'] . ')">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                                                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                                                </svg> Thêm vào giỏ hàng
                                                                            </a>
                                                                        </div>
    
                                                                        <div class="col-3">';
                                                if ($getProductByCateoryItem['wstatus'] === NULL) {
                                                    echo '
                                                                            <form action="index.php?page=whistlist" method="post">
                                                                                <input type="hidden" name="productId" value="' . $getProductByCateoryItem['product_id'] . '"> 
                                                                                <button type="submit" name="action" value="add_to_wishlist" class="btn btn-outline-danger rounded-1 p-2 fs-6">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                            ';
                                                } else {
                                                    echo '
                                                                            <form action="" method="post">
                                                                                <input type="hidden" name="whistlistId" value="' . $getProductByCateoryItem['whistlist_id'] . '">
                                                                                <button type="submit" name="deleteWishlist" value="deleteWishlist" class="btn btn-outline-danger rounded-1 p-2 fs-6">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                            ';
                                                }
                                                echo '              </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    ';
                                            }
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
                                                <div class="text-center border border-2 rounded border-color p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Danh mục chưa có sản phẩm nào!</label>
                                                </div>
                                            </section>';
                                        }
                                    } elseif (isset($_REQUEST['keyword']) && isset($_REQUEST['btnFindProduct'])) {
                                        $count = 0;
                                        $getSearchProducts = $productController->searchProductController($_REQUEST['keyword']);
                                        if ($getSearchProducts->num_rows > 0) {
                                            foreach ($getSearchProducts as $getSearchProduct) {

                                                if ($count % 4 == 0 && $count != 0) {
                                                    echo '</div><div class="row">';
                                                }
                                                echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4 ">
                                                        <div class="product-item border rounded p-3">
                                                            <figure>
                                                                <a href="index.php?page=detailProduct&idp=' . $getSearchProduct['product_id'] . '" title="' . $getSearchProduct['product_name'] . '">
                                                                    <img src="asset/image/product/' . $getSearchProduct['image_name'] . '" alt="' . $getSearchProduct['image_name'] . '" class="tab-image img-fluid">
                                                                </a>
                                                            </figure>
                                                            <div class="d-flex flex-column text-center">
                                                                <a class="fs-6 fw-normal text-truncate text-decoration-none" href="index.php?page=detailProduct&idp=' . $getSearchProduct['product_id'] . '">' . $getSearchProduct['product_name'] . '</a>
                                                                <div>
                                                                    <span class="rating">';

                                                if ($getSearchProduct['rating_star'] >= 4.6 && $getSearchProduct['rating_star'] <= 5) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getSearchProduct['rating_star'] == 4.5) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getSearchProduct['rating_star'] >= 4 && $getSearchProduct['rating_star'] <= 4.4) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getSearchProduct['rating_star'] >= 3.5 && $getSearchProduct['rating_star'] <= 3.9) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getSearchProduct['rating_star'] == 3) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getSearchProduct['rating_star'] >= 2.5 && $getSearchProduct['rating_star'] <= 2.9) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getSearchProduct['rating_star'] == 2) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getSearchProduct['rating_star'] >= 1.5 && $getSearchProduct['rating_star'] <= 1.9) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($getSearchProduct == 1) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } else {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                }

                                                echo                '</span>
                                                                    <span>
                                                                        (' . $getSearchProduct['quantity'] . ')
                                                                    </span>
                                                                </div>
    
                                                                <div class="d-flex justify-content-center align-items-center gap-2">
    
                                                                    <span class="text-danger fw-bold">' . number_format($getSearchProduct['price'], 0, ',', '.') . '<sup>đ</sup></span>
    
                                                                    <span class="badge rounded fw-bold px-1 fs-7 lh-1 bg-warning text-black ms-2">
                                                                        ' . $getSearchProduct['discount'] . '% OFF
                                                                    </span>
                                                                </div>
                                                                <div class="button-area p-3 pt-0">
                                                                    <div class="row g-1 mt-2">

                                                                        <div class="col-9">
                                                                            <a href="javascript:void(0);" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart" 
                                                                            onclick="addToCart(' . $getSearchProduct['product_id'] . ')">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                                                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                                                </svg> Thêm vào giỏ hàng
                                                                            </a>
                                                                        </div>
    
                                                                        <div class="col-3">';
                                                if ($getSearchProduct['wstatus'] === NULL) {
                                                    echo '
                                                                            <form action="index.php?page=whistlist" method="post">
                                                                                <input type="hidden" name="productId" value="' . $getSearchProduct['product_id'] . '"> 
                                                                                <button type="submit" name="action" value="add_to_wishlist" class="btn btn-outline-danger rounded-1 p-2 fs-6">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                            ';
                                                } else {
                                                    echo '
                                                                            <form action="" method="post">
                                                                                <input type="hidden" name="whistlistId" value="' . $getSearchProduct['whistlist_id'] . '">
                                                                                <button type="submit" name="deleteWishlist" value="deleteWishlist" class="btn btn-outline-danger rounded-1 p-2 fs-6">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                            ';
                                                }
                                                echo '              </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    ';
                                            }
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 20vh;">
                                                <div class="text-center border border-2 rounded p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Không tìm thấy sản phẩm nào!</label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    } elseif (isset($_REQUEST["htj"]) && isset($_REQUEST['u_i'])) {
                                        // | (isset($_REQUEST['s_interface']) && isset($_REQUEST['u_i']))
                                        $count = 0;
                                        $findPriceProducts = $productController->findProductByPriceController($_REQUEST['fromPrice'], $_REQUEST['toPrice']);

                                        if ($findPriceProducts->num_rows > 0) {
                                            foreach ($findPriceProducts as $findPriceProduct) {

                                                if ($count % 4 == 0 && $count != 0) {
                                                    echo '</div><div class="row">';
                                                }
                                                echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4 ">
                                                        <div class="product-item border rounded p-3">
                                                            <figure>
                                                                <a href="index.php?page=detailProduct&idp=' . $findPriceProduct['product_id'] . '" title="' . $findPriceProduct['product_name'] . '">
                                                                    <img src="asset/image/product/' . $findPriceProduct['image_name'] . '" alt="' . $findPriceProduct['image_name'] . '" class="tab-image img-fluid">
                                                                </a>
                                                            </figure>
                                                            <div class="d-flex flex-column text-center">
                                                                <a class="fs-6 fw-normal text-truncate text-decoration-none" href="index.php?page=detailProduct&idp=' . $findPriceProduct['product_id'] . '">' . $findPriceProduct['product_name'] . '</a>
                                                                <div>
                                                                    <span class="rating">';

                                                if ($findPriceProduct['rating_star'] >= 4.6 && $findPriceProduct['rating_star'] <= 5) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($findPriceProduct['rating_star'] == 4.5) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($findPriceProduct['rating_star'] >= 4 && $findPriceProduct['rating_star'] <= 4.4) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($findPriceProduct['rating_star'] >= 3.5 && $findPriceProduct['rating_star'] <= 3.9) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($findPriceProduct['rating_star'] == 3) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($findPriceProduct['rating_star'] >= 2.5 && $findPriceProduct['rating_star'] <= 2.9) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($findPriceProduct['rating_star'] == 2) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($findPriceProduct['rating_star'] >= 1.5 && $findPriceProduct['rating_star'] <= 1.9) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                } elseif ($findPriceProduct == 1) {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                        ';
                                                } else {
                                                    echo '
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                            </svg>
                                                                        ';
                                                }

                                                echo                '</span>
                                                                    <span>
                                                                        (' . $findPriceProduct['quantity'] . ')
                                                                    </span>
                                                                </div>
    
                                                                <div class="d-flex justify-content-center align-items-center gap-2">
    
                                                                    <span class="text-danger fw-bold">' . number_format($findPriceProduct['price'], 0, ',', '.') . '<sup>đ</sup></span>
    
                                                                    <span class="badge rounded fw-bold px-1 fs-7 lh-1 bg-warning text-black ms-2">
                                                                        ' . $findPriceProduct['discount'] . '% OFF
                                                                    </span>
                                                                </div>
                                                                <div class="button-area p-3 pt-0">
                                                                    <div class="row g-1 mt-2">
                                                                        <div class="col-9">
                                                                            <a href="javascript:void(0);" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart" 
                                                                            onclick="addToCart(' . $findPriceProduct['product_id'] . ')">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                                                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                                                </svg> Thêm vào giỏ hàng
                                                                            </a>
                                                                        </div>
    
                                                                        <div class="col-3">';
                                                if ($findPriceProduct['wstatus'] === NULL) {
                                                    echo '
                                                                            <form action="index.php?page=whistlist" method="post">
                                                                                <input type="hidden" name="productId" value="' . $findPriceProduct['product_id'] . '"> 
                                                                                <button type="submit" name="action" value="add_to_wishlist" class="btn btn-outline-danger rounded-1 p-2 fs-6">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                            ';
                                                } else {
                                                    echo '
                                                                            <form action="" method="post">
                                                                                <input type="hidden" name="whistlistId" value="' . $findPriceProduct['whistlist_id'] . '">
                                                                                <button type="submit" name="deleteWishlist" value="deleteWishlist" class="btn btn-outline-danger rounded-1 p-2 fs-6">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                                                    </svg>
                                                                                </button>
                                                                            </form>
                                                                            ';
                                                }
                                                echo '              </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    ';
                                            }
                                        } else {
                                            echo '
                                            <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 40vh;">
                                                <div class="text-center border border-2 rounded p-4">
                                                    <img src="asset/image/general/list.png" alt="" class="img-fluid w-25 h-25"> <br>
                                                    <label class="text-black" for="">Không tìm thấy sản phẩm nào!</label>
                                                </div>
                                            </section>
                                            ';
                                        }
                                    } else {
                                        $getAllProducts = $productController->getAllProductController();
                                        $count = 0;

                                        // echo 'kkádfg';

                                        foreach ($getAllProducts as $getAllProduct) {

                                            if ($count % 4 == 0 && $count != 0) {
                                                echo '</div><div class="row">';
                                            }
                                            echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4 ">
                                                    <div class="product-item border rounded p-3">
                                                        <figure>
                                                            <a href="index.php?page=detailProduct&idp=' . $getAllProduct['product_id'] . '" title="' . $getAllProduct['product_name'] . '">
                                                                <img src="asset/image/product/' . $getAllProduct['image_name'] . '" alt="' . $getAllProduct['image_name'] . '" class="tab-image img-fluid">
                                                            </a>
                                                        </figure>
                                                        <div class="d-flex flex-column text-center">
                                                            <a class="fs-6 fw-normal text-truncate text-decoration-none" href="index.php?page=detailProduct&idp=' . $getAllProduct['product_id'] . '">' . $getAllProduct['product_name'] . '</a>
                                                            <div>
                                                                <span class="rating">';

                                            if ($getAllProduct['rating_star'] >= 4.6 && $getAllProduct['rating_star'] <= 5) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($getAllProduct['rating_star'] == 4.5) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                            <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($getAllProduct['rating_star'] >= 4 && $getAllProduct['rating_star'] <= 4.4) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($getAllProduct['rating_star'] >= 3.5 && $getAllProduct['rating_star'] <= 3.9) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                            <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($getAllProduct['rating_star'] == 3) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($getAllProduct['rating_star'] >= 2.5 && $getAllProduct['rating_star'] <= 2.9) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                            <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($getAllProduct['rating_star'] == 2) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($getAllProduct['rating_star'] >= 1.5 && $getAllProduct['rating_star'] <= 1.9) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                            <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                        </svg>
                                                                    ';
                                            } elseif ($getAllProduct == 1) {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                    ';
                                            } else {
                                                echo '
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                                        </svg>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                                            <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                                        </svg>
                                                                    ';
                                            }

                                            echo                '</span>
                                                                <span>
                                                                    (' . $getAllProduct['quantity'] . ')
                                                                </span>
                                                            </div>

                                                            <div class="d-flex justify-content-center align-items-center gap-2">

                                                                <span class="text-danger fw-bold">' . number_format($getAllProduct['price'], 0, ',', '.') . '<sup>đ</sup></span>

                                                                <span class="badge rounded fw-bold px-1 fs-7 lh-1 bg-warning text-black ms-2">
                                                                    ' . $getAllProduct['discount'] . '% OFF
                                                                </span>
                                                            </div>
                                                            <div class="button-area p-3 pt-0">
                                                                <div class="row g-1 mt-2">
                                                                    <div class="col-9">
                                                                        <a href="javascript:void(0);" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart" 
                                                                        onclick="addToCart(' . $getAllProduct['product_id'] . ')">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                                                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                                                            </svg> Thêm vào giỏ hàng
                                                                        </a>
                                                                    </div>

                                                                    <div class="col-3">';
                                            if ($getAllProduct['wstatus'] === NULL) {
                                                echo '
                                                                        <form action="index.php?page=whistlist" method="post">
                                                                            <input type="hidden" name="productId" value="' . $getAllProduct['product_id'] . '"> 
                                                                            <button type="submit" name="action" value="add_to_wishlist" class="btn btn-outline-danger rounded-1 p-2 fs-6">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                                                                </svg>
                                                                            </button>
                                                                        </form>
                                                                        ';
                                            } else {
                                                echo '
                                                                        <form action="" method="post">
                                                                            <input type="hidden" name="whistlistId" value="' . $getAllProduct['whistlist_id'] . '">
                                                                            <button type="submit" name="deleteWishlist" value="deleteWishlist" class="btn btn-outline-danger rounded-1 p-2 fs-6">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                                                </svg>
                                                                            </button>
                                                                        </form>
                                                                        ';
                                            }
                                            echo '              </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                ';
                                        }
                                    }
                                    include_once('script.php');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

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