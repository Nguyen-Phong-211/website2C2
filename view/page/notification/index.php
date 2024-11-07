<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thông báo</title>

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


    <?php
    include_once('view/layout/pagination/index.php');
    ?>

    <!-- <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: 50vh;">
        <div class="text-center" id="circle-notification">
            <img src="asset/image/general/list.png" alt="Thông báo" class="img-fluid notification-icon">
            <label class="notification-label">Chưa có thông báo nào</label>
        </div>
    </section> -->

    <style>
        #circle-notification {
            border: 1px solid #cacaca;
            height: 300px;
            width: 320px;
            border-radius: calc(40% + 30px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .notification-icon {
            width: 80px;
            height: 80px;
            opacity: 0.6;
        }
    </style>







    <?php
    include_once('view/layout/footer/footer.php');
    ?>

    <?php
    include_once('view/layout/footer/lib-cdn-js.php');
    ?>
</body>

</html>