<section id="latest-products" class="products-carousel">
    <div class="container-lg overflow-hidden pb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header d-flex justify-content-between my-4">
                    <h2 class="section-title">Sản phẩm sắp cháy hàng</h2>
                    <div class="d-flex align-items-center">
                        <a href="#" class="btn btn-primary me-2">Xem tất cả</a>
                        <div class="swiper-buttons">
                            <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                            <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="swiper">
                    <div class="swiper-wrapper">

                    <?php 
                        include_once('controller/Product/ProductController.php');
                        $productController = new ProductController();

                        $productSellOuts = $productController->getProductSellOutController();
                        foreach($productSellOuts as $productSellOut){
                            echo '
                            <div class="product-item swiper-slide">
                                <figure>
                                    <a href="index.php?page=detailProduct&idp='. $productSellOut['product_id'] .'" title="'. $productSellOut['product_name'] .'">
                                        <img src="asset/image/product/'. $productSellOut['image_name'] .'" alt="'. $productSellOut['image_name'] .'" class="tab-image img-fluid">
                                    </a>
                                </figure>
                                <div class="d-flex flex-column text-center">
                                <a class="fs-6 fw-normal text-truncate text-decoration-none" href="index.php?page=detailProduct&idp='. $productSellOut['product_id'] .'">'. $productSellOut['product_name'] .'</a>
                                    <div>
                                        <span class="rating">';
                                        if($productSellOut['rating_star'] >= 4.6 && $productSellOut['rating_star'] <= 5){
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
                                        }
                                        elseif($productSellOut['rating_star'] == 4.5){
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
                                        elseif($productSellOut['rating_star'] >= 4 && $productSellOut['rating_star'] <= 4.4){
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
                                        }
                                        elseif($productSellOut['rating_star'] >= 3.5 && $productSellOut['rating_star'] <= 3.9){
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
                                        }
                                        elseif($productSellOut['rating_star'] == 3){
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
                                        }
                                        elseif($productSellOut['rating_star'] >= 2.5 && $productSellOut['rating_star'] <= 2.9){
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
                                        }
                                        elseif($productSellOut['rating_star'] == 2){
                                            echo '
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                            ';
                                        }
                                        elseif($productSellOut['rating_star'] >= 1.5 && $productSellOut['rating_star'] <= 1.9){
                                            echo '
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-half" viewBox="0 0 16 16">
                                                    <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                                                </svg>
                                            ';
                                        }
                                        elseif($productSellOut['rating_star'] == 1){
                                            echo '
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                            ';
                                        }
                                        else{
                                            echo ' <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
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
                                            </svg>';
                                        }
                            echo '      </span>

                                        <small>
                                        Còn '. $productSellOut['quantity'] .'
                                        </small>
                                    </div>
                                    <div  class="d-flex justify-content-center align-items-center gap-2">
                                        <span class="text-dark fw-semibold">
                                            '. number_format($productSellOut['price'], 0, ',', '.') .' đồng
                                        </span>
                                        <span class="badge rounded fw-bold px-1 fs-7 lh-1 bg-warning text-black ms-2">';
                                        if($productSellOut['discount'] != 0){
                                            echo $productSellOut['discount'] .'% OFF';
                                        }else{
                                            echo '<img src="asset/image/general/promotional.png" alt="" height="20" width="20" class="rounded-circle">';
                                        }
                            echo '      </span>
                                    </div>
                                    <div class="button-area p-3 pt-0">
                                        <div class="row g-1 mt-2">
                                            <div class="col-9">
                                                <a href="#" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                                        <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                                    </svg> Thêm vào giỏ hàng
                                                </a>
                                            </div>
                                            <div class="col-3">
                                                <form action="index.php?page=whistlist" method="post">
                                                    <input type="hidden" name="productId" value="'. $productSellOut['product_id'] .'"> 
                                                    <button type="submit" name="action" value="add_to_wishlist" class="btn btn-outline-danger rounded-1 p-2 fs-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    ?>

                        

                        <!-- <div class="product-item swiper-slide">
                            <figure>
                                <a href="index.html" title="Product Title">
                                    <img src="images/product-thumb-1.png"
                                        alt="Product Thumbnail" class="tab-image">
                                </a>
                            </figure>
                            <div class="d-flex flex-column text-center">
                                <h3 class="fs-6 fw-normal">Whole Wheat Sandwich Bread</h3>
                                <div>
                                    <span class="rating">
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-half"></use>
                                        </svg>
                                    </span>
                                    <span>(222)</span>
                                </div>
                                <div
                                    class="d-flex justify-content-center align-items-center gap-2">
                                    <del>$24.00</del>
                                    <span class="text-dark fw-semibold">$18.00</span>
                                    <span
                                        class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">10%
                                        OFF</span>
                                </div>
                                <div class="button-area p-3 pt-0">
                                    <div class="row g-1 mt-2">
                                        <div class="col-3"><input type="number" name="quantity"
                                                class="form-control border-dark-subtle input-number quantity"
                                                value="1"></div>
                                        <div class="col-7"><a href="#"
                                                class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#cart"></use>
                                                </svg> Add to
                                                Cart</a></div>
                                        <div class="col-2"><a href="#"
                                                class="btn btn-outline-dark rounded-1 p-2 fs-6"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#heart"></use>
                                                </svg></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-item swiper-slide">
                            <figure>
                                <a href="index.html" title="Product Title">
                                    <img src="images/product-thumb-21.png"
                                        alt="Product Thumbnail" class="tab-image">
                                </a>
                            </figure>
                            <div class="d-flex flex-column text-center">
                                <h3 class="fs-6 fw-normal">Sunstar Fresh Melon Juice</h3>
                                <div>
                                    <span class="rating">
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-half"></use>
                                        </svg>
                                    </span>
                                    <span>(222)</span>
                                </div>
                                <div
                                    class="d-flex justify-content-center align-items-center gap-2">
                                    <del>$24.00</del>
                                    <span class="text-dark fw-semibold">$18.00</span>
                                    <span
                                        class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">10%
                                        OFF</span>
                                </div>
                                <div class="button-area p-3 pt-0">
                                    <div class="row g-1 mt-2">
                                        <div class="col-3"><input type="number" name="quantity"
                                                class="form-control border-dark-subtle input-number quantity"
                                                value="1"></div>
                                        <div class="col-7"><a href="#"
                                                class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#cart"></use>
                                                </svg> Add to
                                                Cart</a></div>
                                        <div class="col-2"><a href="#"
                                                class="btn btn-outline-dark rounded-1 p-2 fs-6"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#heart"></use>
                                                </svg></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-item swiper-slide">
                            <figure>
                                <a href="index.html" title="Product Title">
                                    <img src="images/product-thumb-22.png"
                                        alt="Product Thumbnail" class="tab-image">
                                </a>
                            </figure>
                            <div class="d-flex flex-column text-center">
                                <h3 class="fs-6 fw-normal">Gourmet Dark Chocolate</h3>
                                <div>
                                    <span class="rating">
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-half"></use>
                                        </svg>
                                    </span>
                                    <span>(222)</span>
                                </div>
                                <div
                                    class="d-flex justify-content-center align-items-center gap-2">
                                    <del>$24.00</del>
                                    <span class="text-dark fw-semibold">$18.00</span>
                                    <span
                                        class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">10%
                                        OFF</span>
                                </div>
                                <div class="button-area p-3 pt-0">
                                    <div class="row g-1 mt-2">
                                        <div class="col-3"><input type="number" name="quantity"
                                                class="form-control border-dark-subtle input-number quantity"
                                                value="1"></div>
                                        <div class="col-7"><a href="#"
                                                class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#cart"></use>
                                                </svg> Add to
                                                Cart</a></div>
                                        <div class="col-2"><a href="#"
                                                class="btn btn-outline-dark rounded-1 p-2 fs-6"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#heart"></use>
                                                </svg></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-item swiper-slide">
                            <figure>
                                <a href="index.html" title="Product Title">
                                    <img src="images/product-thumb-23.png"
                                        alt="Product Thumbnail" class="tab-image">
                                </a>
                            </figure>
                            <div class="d-flex flex-column text-center">
                                <h3 class="fs-6 fw-normal">Sunstar Fresh Melon Juice</h3>
                                <div>
                                    <span class="rating">
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-half"></use>
                                        </svg>
                                    </span>
                                    <span>(222)</span>
                                </div>
                                <div
                                    class="d-flex justify-content-center align-items-center gap-2">
                                    <del>$24.00</del>
                                    <span class="text-dark fw-semibold">$18.00</span>
                                    <span
                                        class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">10%
                                        OFF</span>
                                </div>
                                <div class="button-area p-3 pt-0">
                                    <div class="row g-1 mt-2">
                                        <div class="col-3"><input type="number" name="quantity"
                                                class="form-control border-dark-subtle input-number quantity"
                                                value="1"></div>
                                        <div class="col-7"><a href="#"
                                                class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#cart"></use>
                                                </svg> Add to
                                                Cart</a></div>
                                        <div class="col-2"><a href="#"
                                                class="btn btn-outline-dark rounded-1 p-2 fs-6"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#heart"></use>
                                                </svg></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-item swiper-slide">
                            <figure>
                                <a href="index.html" title="Product Title">
                                    <img src="images/product-thumb-10.png"
                                        alt="Product Thumbnail" class="tab-image">
                                </a>
                            </figure>
                            <div class="d-flex flex-column text-center">
                                <h3 class="fs-6 fw-normal">Greek Style Plain Yogurt</h3>
                                <div>
                                    <span class="rating">
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-half"></use>
                                        </svg>
                                    </span>
                                    <span>(222)</span>
                                </div>
                                <div
                                    class="d-flex justify-content-center align-items-center gap-2">
                                    <del>$24.00</del>
                                    <span class="text-dark fw-semibold">$18.00</span>
                                    <span
                                        class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">10%
                                        OFF</span>
                                </div>
                                <div class="button-area p-3 pt-0">
                                    <div class="row g-1 mt-2">
                                        <div class="col-3"><input type="number" name="quantity"
                                                class="form-control border-dark-subtle input-number quantity"
                                                value="1"></div>
                                        <div class="col-7"><a href="#"
                                                class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#cart"></use>
                                                </svg> Add to
                                                Cart</a></div>
                                        <div class="col-2"><a href="#"
                                                class="btn btn-outline-dark rounded-1 p-2 fs-6"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#heart"></use>
                                                </svg></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-item swiper-slide">
                            <figure>
                                <a href="index.html" title="Product Title">
                                    <img src="images/product-thumb-11.png"
                                        alt="Product Thumbnail" class="tab-image">
                                </a>
                            </figure>
                            <div class="d-flex flex-column text-center">
                                <h3 class="fs-6 fw-normal">Pure Squeezed No Pulp Orange
                                    Juice</h3>
                                <div>
                                    <span class="rating">
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-half"></use>
                                        </svg>
                                    </span>
                                    <span>(222)</span>
                                </div>
                                <div
                                    class="d-flex justify-content-center align-items-center gap-2">
                                    <del>$24.00</del>
                                    <span class="text-dark fw-semibold">$18.00</span>
                                    <span
                                        class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">10%
                                        OFF</span>
                                </div>
                                <div class="button-area p-3 pt-0">
                                    <div class="row g-1 mt-2">
                                        <div class="col-3"><input type="number" name="quantity"
                                                class="form-control border-dark-subtle input-number quantity"
                                                value="1"></div>
                                        <div class="col-7"><a href="#"
                                                class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#cart"></use>
                                                </svg> Add to
                                                Cart</a></div>
                                        <div class="col-2"><a href="#"
                                                class="btn btn-outline-dark rounded-1 p-2 fs-6"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#heart"></use>
                                                </svg></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-item swiper-slide">
                            <figure>
                                <a href="index.html" title="Product Title">
                                    <img src="images/product-thumb-12.png"
                                        alt="Product Thumbnail" class="tab-image">
                                </a>
                            </figure>
                            <div class="d-flex flex-column text-center">
                                <h3 class="fs-6 fw-normal">Fresh Oranges</h3>
                                <div>
                                    <span class="rating">
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-half"></use>
                                        </svg>
                                    </span>
                                    <span>(222)</span>
                                </div>
                                <div
                                    class="d-flex justify-content-center align-items-center gap-2">
                                    <del>$24.00</del>
                                    <span class="text-dark fw-semibold">$18.00</span>
                                    <span
                                        class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">10%
                                        OFF</span>
                                </div>
                                <div class="button-area p-3 pt-0">
                                    <div class="row g-1 mt-2">
                                        <div class="col-3"><input type="number" name="quantity"
                                                class="form-control border-dark-subtle input-number quantity"
                                                value="1"></div>
                                        <div class="col-7"><a href="#"
                                                class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#cart"></use>
                                                </svg> Add to
                                                Cart</a></div>
                                        <div class="col-2"><a href="#"
                                                class="btn btn-outline-dark rounded-1 p-2 fs-6"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#heart"></use>
                                                </svg></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-item swiper-slide">
                            <figure>
                                <a href="index.html" title="Product Title">
                                    <img src="images/product-thumb-13.png"
                                        alt="Product Thumbnail" class="tab-image">
                                </a>
                            </figure>
                            <div class="d-flex flex-column text-center">
                                <h3 class="fs-6 fw-normal">Gourmet Dark Chocolate Bars</h3>
                                <div>
                                    <span class="rating">
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-full"></use>
                                        </svg>
                                        <svg width="18" height="18" class="text-warning">
                                            <use
                                                xlink:href="#star-half"></use>
                                        </svg>
                                    </span>
                                    <span>(222)</span>
                                </div>
                                <div
                                    class="d-flex justify-content-center align-items-center gap-2">
                                    <del>$24.00</del>
                                    <span class="text-dark fw-semibold">$18.00</span>
                                    <span
                                        class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">10%
                                        OFF</span>
                                </div>
                                <div class="button-area p-3 pt-0">
                                    <div class="row g-1 mt-2">
                                        <div class="col-3"><input type="number" name="quantity"
                                                class="form-control border-dark-subtle input-number quantity"
                                                value="1"></div>
                                        <div class="col-7"><a href="#"
                                                class="btn btn-primary rounded-1 p-2 fs-7 btn-cart"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#cart"></use>
                                                </svg> Add to
                                                Cart</a></div>
                                        <div class="col-2"><a href="#"
                                                class="btn btn-outline-dark rounded-1 p-2 fs-6"><svg
                                                    width="18" height="18">
                                                    <use
                                                        xlink:href="#heart"></use>
                                                </svg></a></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>
                <!-- / products-carousel -->

            </div>
        </div>
    </div>
</section>