<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sản phẩm yêu thích</title>

    <?php
    include_once('view/layout/header/lib_cdn.php');
    ?>

</head>

<body>

    <!-- Svg -->
    <?php
    include_once('view/layout/body/svg.php');
    ?>

    <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1"
        id="offcanvasNavbar">

        <div class="offcanvas-header justify-content-between">
            <h4 class="fw-normal text-uppercase fs-6">Menu</h4>
            <button type="button" class="btn-close"
                data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">

            <ul
                class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                <li class="nav-item border-dashed active">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#fruits"></use>
                        </svg>
                        <span>Fruits and vegetables</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#dairy"></use>
                        </svg>
                        <span>Dairy and Eggs</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#meat"></use>
                        </svg>
                        <span>Meat and Poultry</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#seafood"></use>
                        </svg>
                        <span>Seafood</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#bakery"></use>
                        </svg>
                        <span>Bakery and Bread</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#canned"></use>
                        </svg>
                        <span>Canned Goods</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#frozen"></use>
                        </svg>
                        <span>Frozen Foods</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#pasta"></use>
                        </svg>
                        <span>Pasta and Rice</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#breakfast"></use>
                        </svg>
                        <span>Breakfast Foods</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#snacks"></use>
                        </svg>
                        <span>Snacks and Chips</span>
                    </a>
                </li>
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
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#spices"></use>
                        </svg>
                        <span>Spices and Seasonings</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#baby"></use>
                        </svg>
                        <span>Baby Food and Formula</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#health"></use>
                        </svg>
                        <span>Health and Wellness</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#household"></use>
                        </svg>
                        <span>Household Supplies</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#personal"></use>
                        </svg>
                        <span>Personal Care</span>
                    </a>
                </li>
                <li class="nav-item border-dashed">
                    <a href="index.html"
                        class="nav-link d-flex align-items-center gap-3 text-dark p-2">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="#pet"></use>
                        </svg>
                        <span>Pet Food and Supplies</span>
                    </a>
                </li>
            </ul>

        </div>

    </div>

    <header>
        <?php
            include_once('view/layout/header/menu.php');
        ?>
    </header>

    <section class="container pb-4 my-4 text-black">
        <div class="container mt-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="text-center fade-in" id="fade-in">
                    <div class="error-title" id="error-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg> 
                        404
                    </div>
                    <h1>Không tìm thấy trang</h1>
                    <p class="lead">Rất tiếc, trang bạn tìm không tồn tại.</p>
                    <a href="index.php?page=home" class="btn btn-primary active">Quay về trang chủ</a>
                </div>
            </div>
        </div>
    </section>

    <style>
        
    </style>

    

    <?php
        include_once('view/layout/footer/footer.php');
    ?>

    <?php
        include_once('view/layout/footer/lib-cdn-js.php');
    ?>
</body>

</html>