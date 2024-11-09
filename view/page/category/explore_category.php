<section class="py-5 overflow-hidden">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-12">

                <div
                    class="section-header d-flex flex-wrap justify-content-between mb-5">
                    <h2 class="section-title">Khám phá danh mục 
                    <?php 
                        include_once('controller/Category/CategoryController.php');
                        $categoryController = new CategoryController();
                        $datas = $categoryController->getCategoryList();

                        $nameCategory = $_REQUEST['idc'];
                        $namePage = $_REQUEST['page'];

                        foreach($datas as $data){
                            if($namePage == 'category' && $nameCategory == $data['category_id']){
                                echo $data['category_name'];
                                break;
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
                            include_once('controller/CategoryItem/CategoryItemController.php');
                            $categoryItemController = new CategoryItemController();

                            $idCategory = $_REQUEST['idc'];

                            $datas = $categoryItemController->getAllListCategoryItemByCategoryController($idCategory);

                            foreach($datas as $data){
                                echo '
                                    <a href="index.php?page=product&idci='. $data['category_item_id'] .'"
                                        class="nav-link swiper-slide text-center">
                                        <img src="asset/image/category_item/'. $data['image'] .'" height="120" width="120" class="rounded" alt="'. $data['category_item_name'] .'">
                                        <h4 class="fs-6 mt-3 fw-normal category-title">'. $data['category_item_name'] .'</h4>
                                    </a>
                                ';
                            }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>