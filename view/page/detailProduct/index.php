<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chi tiết sản phẩm</title>

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
    include_once('controller/Image/ImageController.php');
    $imageController = new ImageController();

    $idp = $_REQUEST['idp'];
    $images = $imageController->getImageByProductIdController($idp);
    ?>

    <section class="container pb-4 my-4 text-black">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                        <div class="carousel-indicators">
                            <?php foreach ($images as $index => $image): ?>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $index; ?>" class="<?= $index === 0 ? 'active' : ''; ?>" aria-current="<?= $index === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?= $index + 1; ?>"></button>
                            <?php endforeach; ?>
                        </div>
                        <div class="carousel-inner">
                            <?php foreach ($images as $index => $image): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
                                    <img src="asset/image/product/<?= htmlspecialchars($image['image_name']); ?>" class="d-block w-100" alt=" <?= $index + 1; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php
                    include_once('controller/Product/ProductController.php');
                    $productController = new ProductController();

                    $idp = $_REQUEST['idp'];
                    $datas = $productController->getProductByIdController($idp);

                    foreach ($datas as $data) {

                        echo '<h1>' . $data['product_name'] . '</h1>';

                        echo '<p class="lead text-danger fw-bold fs-4">' . number_format($data['price'], 0, ',', '.') . ' đồng</p>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                            &nbsp;Phường Tân Hưng Thuận, Quận 12, Tp Hồ Chí Minh
                        </p>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            &nbsp;' . $data['update_at'] . '
                        </p>';
                    }
                    ?>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <?php
                            include_once('controller/Review/ReviewController.php');
                            $reviewController = new ReviewController();

                            $idp = $_REQUEST['idp'];
                            $resultData = $reviewController->getAVGReviewByProductIdController($idp);

                            if (is_numeric($resultData)) {
                                // Đánh giá hợp lệ, hiển thị sao
                                $ratingStar = round($resultData); // Làm tròn giá trị trung bình sao
                                $fullStars = floor($ratingStar); // Số sao đầy đủ
                                $halfStar = ($ratingStar - $fullStars) >= 0.5 ? true : false; // Kiểm tra có sao nửa không
                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Tính số sao trống

                                // Hiển thị sao đầy đủ
                                for ($i = 0; $i < $fullStars; $i++) {
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>';
                                }

                                // Hiển thị sao nửa
                                if ($halfStar) {
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
              </svg>';
                                }

                                // Hiển thị sao trống
                                for ($i = 0; $i < $emptyStars; $i++) {
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#e0e0e0" class="bi bi-star" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>';
                                }
                            } else {
                                // Nếu không có đánh giá
                                echo 'Chưa có bài đánh giá cho sản phẩm';
                            }
                            ?>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#74bd43" class="bi bi-align-middle" viewBox="0 0 16 16">
                            <path d="M6 13a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zM1 8a.5.5 0 0 0 .5.5H6v-1H1.5A.5.5 0 0 0 1 8m14 0a.5.5 0 0 1-.5.5H10v-1h4.5a.5.5 0 0 1 .5.5" />
                        </svg>
                        <div class="ms-3">
                            <?php
                            include_once('controller/Review/ReviewController.php');
                            $reviewController = new ReviewController();

                            $idp = $_REQUEST['idp'];
                            echo $reviewController->countReviewByProductIdController($idp);
                            ?> đánh giá
                        </div>
                    </div>

                    <?php
                    include_once('controller/User/UserController.php');
                    $userController = new UserController();

                    $idp = $_REQUEST['idp'];
                    $dataUsers = $userController->getUserByProductIdController($idp);

                    foreach ($dataUsers as $dataUser) {
                        echo '<div class="d-flex align-items-center mt-2">
                                    <div class="me-3">
                                            <img src="asset/image/user/' . $dataUser['image'] . '" height="50" width="50" class="rounded-circle img-fluid" alt="' . $dataUser['user_name'] . '">
                                    </div>
                                    <div>
                                        <p class="mb-0">' . $dataUser['user_name'] . '</p>
                                        <p class="text-muted mb-0">Phản hồi: 85% - 48 đã bán</p>
                                    </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-evenly mt-4">
                                <!-- Liên kết Chat với người bán -->
                                <a href="index.php?page=message&idp=' . $_REQUEST['idp'] . '" class="text-decoration-none btn-link p-2 d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chat-right-dots me-2" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                        <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                    </svg>
                                    Chat với người bán
                                </a>
                                
                                <!-- Số điện thoại của người bán -->
                                <p class="border-color border border-primary p-2 mb-0 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#74bd43" class="bi bi-telephone-outbound" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5"/>
                                    </svg>&nbsp; ' . $dataUser['number_phone'] . '
                                </p>
                            </div>
                            ';
                    }
                    ?>

                    <div class="mt-4">


                        <div class="d-flex justify-content-start align-items-center mt-3">
                            <button class="btn btn-primary rounded-1 p-2 d-flex align-items-center active"
                                onclick="addToCart(<?php echo $idp; ?>)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart-plus me-1" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                </svg>
                                Thêm vào giỏ hàng
                            </button>

                            <?php
                            include_once('controller/User/UserController.php');
                            include_once('controller/Whistlist/WhistlistController.php');

                            $userController = new UserController();
                            $whistlistController = new WhistlistController();

                            if (isset($_SESSION['emailUserLoginGoogle']) && isset($_SESSION['success_message'])) {
                                $getUserId = $userController->getUserIdByEmailController($_SESSION['emailUserLoginGoogle']);
                                $addWhistlist = $whistlistController->checkIfExistWhistlistController($_REQUEST['idp'], $getUserId);
                                if ($addWhistlist === true) {
                                    echo '
                                        <form action="" method="post">
                                            <input type="hidden" name="deleteProductOutWhistlist" value="">
                                            <button type="submit" name="deleteWishlist" value="deleteWishlist" class="btn btn-outline-danger rounded-1 p-2 d-flex align-items-center ms-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart-fill me-1" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                </svg>
                                                Thêm vào danh sách yêu thích
                                            </button>
                                        </form>
                                        ';
                                } else {
                                    echo '
                                        <form action="" method="post">
                                            <input type="hidden" name="addProductToWhistlist" value=""> 
                                            <button type="submit" name="btnSubmitAddWhistlist" class="btn btn-outline-danger rounded-1 p-2 d-flex align-items-center ms-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart me-1" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                                </svg>
                                                Thêm vào danh sách yêu thích
                                            </button>
                                        </form>
                                        ';
                                }
                            } elseif (isset($_SESSION['email']) && isset($_SESSION['success_message'])) {
                                $getUserId = $userController->getUserIdByEmailController($_SESSION['email']);
                                $addWhistlist = $whistlistController->checkIfExistWhistlistController($_REQUEST['idp'], $getUserId);
                                if ($addWhistlist === true) {
                                    echo '
                                        <form action="" method="post">
                                            <input type="hidden" name="deleteProductOutWhistlist" value="">
                                            <button type="submit" name="deleteWishlist" value="deleteWishlist" class="btn btn-outline-danger rounded-1 p-2 d-flex align-items-center ms-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart-fill me-1" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                </svg>
                                                Thêm vào danh sách yêu thích
                                            </button>
                                        </form>
                                        ';
                                } else {
                                    echo '
                                        <form action="" method="post">
                                            <input type="hidden" name="addProductToWhistlist" value=""> 
                                            <button type="submit" name="btnSubmitAddWhistlist" class="btn btn-outline-danger rounded-1 p-2 d-flex align-items-center ms-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart me-1" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                                </svg>
                                                Thêm vào danh sách yêu thích
                                            </button>
                                        </form>
                                        ';
                                }
                            } else {
                                echo '
                                        <form action="" method="post">
                                            <input type="hidden" name="addProductToWhistlist" value=""> 
                                            <button type="submit" name="btnSubmitAddWhistlist" class="btn btn-outline-danger rounded-1 p-2 d-flex align-items-center ms-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart me-1" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                                </svg>
                                                Thêm vào danh sách yêu thích
                                            </button>
                                        </form>
                                        ';
                            }
                            ?>
                            <?php
                            include_once('controller/User/UserController.php');
                            include_once('controller/Whistlist/WhistlistController.php');

                            $userController = new UserController();
                            $whistlistController = new WhistlistController();

                            if (isset($_REQUEST['addProductToWhistlist'])) {
                                if (isset($_SESSION['emailUserLoginGoogle']) && isset($_SESSION['success_message'])) {
                                    $getUserId = $userController->getUserIdByEmailController($_SESSION['emailUserLoginGoogle']);
                                    $addWhistlist = $whistlistController->addToWhistlistController($_REQUEST['idp'], $getUserId);
                                    if ($addWhistlist === true) {
                                        echo '<script>location.href = "index.php?page=detailProduct&idp=' . $_REQUEST['idp'] . '";</script>';
                                    }
                                } elseif (isset($_SESSION['email']) && isset($_SESSION['success_message'])) {
                                    $getUserId = $userController->getUserIdByEmailController($_SESSION['email']);
                                    $addWhistlist = $whistlistController->addToWhistlistController($_REQUEST['idp'], $getUserId);
                                    if ($addWhistlist === true) {
                                        echo '<script>location.href = "index.php?page=detailProduct&idp=' . $_REQUEST['idp'] . '";</script>';
                                    }
                                } else {
                                    echo '<script>location.href = "index.php?page=login";</script>';
                                }
                            } elseif (isset($_REQUEST['deleteProductOutWhistlist'])) {
                                if (isset($_SESSION['emailUserLoginGoogle']) && isset($_SESSION['success_message'])) {
                                    $getUserId = $userController->getUserIdByEmailController($_SESSION['emailUserLoginGoogle']);
                                    $addWhistlist = $whistlistController->removeFromWhistlistByProductIdController($_REQUEST['idp'], $getUserId);
                                    if ($addWhistlist === true) {
                                        echo '<script>location.href = "index.php?page=detailProduct&idp=' . $_REQUEST['idp'] . '";</script>';
                                    }
                                } elseif (isset($_SESSION['email']) && isset($_SESSION['success_message'])) {
                                    $getUserId = $userController->getUserIdByEmailController($_SESSION['email']);
                                    $addWhistlist = $whistlistController->removeFromWhistlistByProductIdController($_REQUEST['idp'], $getUserId);
                                    if ($addWhistlist === true) {
                                        echo '<script>location.href = "index.php?page=detailProduct&idp=' . $_REQUEST['idp'] . '";</script>';
                                    }
                                } else {
                                    echo '<script>location.href = "index.php?page=login";</script>';
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">

                <!-- <div class="col-12 col-md-13 mb-3">
                    <div class="title-description-product">
                        <p class="fs-4 bg-light p-3 fw-bold rounded">
                            THÔNG TIN CHI TIẾT
                        </p>
                    </div>
                    <div class="description-product p-3 bg-white rounded shadow-sm">
                        <table>
                            <tr>
                                <td>Danh mục:</td>
                            </tr>
                            <tr>
                                <td>Màu sắc:</td>
                            </tr>
                        </table>
                    </div>
                </div> -->

                <div class="col-12 col-md-12 mb-3">
                    <div class="title-describe-product">
                        <p class="fs-4 bg-light p-3 fw-bold rounded">
                            MÔ TẢ SẢN PHẨM
                        </p>
                    </div>
                    <div class="describe-product p-3 bg-white rounded shadow-sm">
                        <?php
                        include_once('controller/Review/ReviewController.php');
                        $reviewController = new ReviewController();

                        $idp = $_REQUEST['idp'];
                        $result = $reviewController->getReviewByProductIdController($idp);

                        foreach ($datas as $data) {
                            echo '<p>' . htmlspecialchars($data['description']) . '</p>';
                        }
                        ?>
                    </div>
                </div>

                <div class="col-12 col-md-12 mb-3">
                    <div class="title-describe-product">
                        <p class="fs-4 bg-light p-3 fw-bold rounded">
                            Đánh giá sản phẩm
                        </p>
                    </div>
                    <div class="describe-product p-3 bg-white rounded shadow-sm">
                        <?php

                        if (isset($_SESSION['user_id'])) {
                            include_once("./view/page/review/form_danhgia.php");
                        } else {
                            echo '
                            <div class="alert alert-warning" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4m.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                                </svg>
                                &nbsp; Bạn cần <a href="index.php?page=login" class="text-primary">đăng nhập</a> để thực hiện đánh giá.
                            </div>';
                        }
                        include_once("./view/page/review/danhgia.php");
                        ?>
                    </div>


                </div>
            </div>

        </div>
    </section>
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