<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">

    <div class="offcanvas-header justify-content-between">
        <h4 class="fw-normal text-uppercase fs-6">Danh mục sản phẩm</h4>
        <button type="button" class="btn-close"
            data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">

        <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
            <?php 
                include_once('controller/Category/CategoryController.php');
                $categoryController = new CategoryController();
                $categories = $categoryController->getCategoryList();

                foreach ($categories as $category) {
                    echo '
                    <li class="nav-item border-dashed active">
                        <a href="index.php?page=category&idc='. $category['category_id'] .'"
                            class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                            <svg width="24" height="24" viewBox="0 0 24 24">
                                <use xlink:href="#fruits"></use>
                            </svg>
                            <span>'. $category['category_name'] .'</span>
                        </a>
                    </li>
                    ';
                }
            ?>
            <li class="nav-item border-dashed">
                <button
                    class="btn btn-toggle dropdown-toggle position-relative w-100 d-flex justify-content-between align-items-center text-dark p-2"
                    data-bs-toggle="collapse"
                    data-bs-target="#beverages-collapse"
                    aria-expanded="false">
                    <div class="d-flex gap-3">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#beverages"></use>
                        </svg>
                        <span>Beverages</span>
                    </div>
                </button>
                <div class="collapse" id="beverages-collapse">
                    <ul
                        class="btn-toggle-nav list-unstyled fw-normal ps-5 pb-1">
                        <li class="border-bottom py-2"><a
                                href="index.html"
                                class="dropdown-item">Water</a></li>
                        <li class="border-bottom py-2"><a
                                href="index.html"
                                class="dropdown-item">Juice</a></li>
                        <li class="border-bottom py-2"><a
                                href="index.html"
                                class="dropdown-item">Soda</a></li>
                        <li class="border-bottom py-2"><a
                                href="index.html"
                                class="dropdown-item">Tea</a></li>
                    </ul>
                </div>
            </li>
            
</ul>

        </ul>

    </div>

</div>