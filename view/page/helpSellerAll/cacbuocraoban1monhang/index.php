<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hỗ trợ người bán - Các bước rao bán một đơn hàng</title>

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

    <section class="pb-4 my-4">
        <div class="container">
            <div class="row">
                <!-- Sidebar Menu -->
                <div class="col-md-4 ">
                    <nav id="navbar-example3" class="content-card navbar navbar-light-sidebar bg-white shadow-sm rounded p-3 position-sticky">
                        <h5 class="text-primary mb-3"><b>Bán hàng trên website chúng tôi như thế nào?</b></h5>
                        <ul class="nav flex-column">
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpSellerAll/cacbuocraoban1monhang" class="nav-link-title text-secondary text-decoration-none">
                                    Các bước rao bán 1 món hàng
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpSellerAll/dangtin" class="nav-link-title text-secondary text-decoration-none">
                                    Đăng tin trên website
                                </a>
                            </li>
                        </ul>

                        <h5 class="text-primary mt-4 mb-3"><b>Chúng tôi kiểm duyệt tin rao của tôi như thế nào?</b></h5>
                        <ul class="nav flex-column">
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpSellerAll/taisao" class="nav-link-title text-secondary text-decoration-none">
                                    Tại sao chúng tôi phải duyệt tin trước khi đăng?
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpSellerAll/tuchoi" class="nav-link-title text-secondary text-decoration-none">
                                    Tại sao tin của tôi bị từ chối?
                                </a>
                            </li>
                        </ul>

                        <h5 class="text-primary mt-4 mb-3"><b>Hỗ trợ tài khoản</b></h5>
                        <ul class="nav flex-column">
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpSellerAll/lamsao" class="nav-link-title text-secondary text-decoration-none">
                                    Làm sao đăng ký tài khoản?
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpSellerAll/lamgi" class="nav-link-title text-secondary text-decoration-none">
                                    Thay đổi thông tin cá nhân
                                </a>
                            </li>
                        </ul>

                        <h5 class="text-primary mt-4 mb-3"><b>Chat với người bán</b></h5>
                        <ul class="nav flex-column">
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpSellerAll/chat" class="nav-link-title text-secondary text-decoration-none">
                                    Chat Với Người Bán là gì?
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpSellerAll/antoan" class="nav-link-title text-secondary text-decoration-none">
                                    An toàn khi sử dụng tính năng Chat Với Người Bán
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Content -->
                <div class="col-md-8">
                    <div class="content-section bg-white shadow-sm rounded p-4 content-card">
                        <h4 class="text-primary">Các bước rao bán một món hàng</h4>
                        <p>Để đăng bán một món hàng, bạn chỉ cần thực hiện các bước đơn giản sau:</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <img src="asset/image/banner/baner.jpg" alt="Hướng dẫn bán hàng" class="img-fluid rounded">
                            </div>
                            <div class="col-md-6">
                                <img src="asset/image/banner/baner1.jpg" alt="Hướng dẫn bán hàng" class="img-fluid rounded">
                            </div>
                        </div>
                        <ul class="mt-4">
                            <li>
                                <b>Lưu ý:</b> Nếu bạn chưa đăng ký tài khoản trước đó, Chúng tôi sẽ yêu cầu xác nhận qua email. Tin rao chỉ được duyệt nếu tài khoản của bạn đã xác thực.
                            </li>
                            <li>
                                Tất cả tin đăng sẽ qua quy trình kiểm duyệt. Thông báo duyệt tin hoặc từ chối sẽ được gửi qua email và ứng dụng.
                            </li>
                            <li>
                                <a href="#" class="text-primary">Tham khảo Mẹo rao bán nhanh</a> để biết cách bán hàng hiệu quả hơn.
                            </li>
                            <li>
                                <a href="#" class="text-primary">Tham khảo Sao tin tôi bị từ chối</a> để tránh các lỗi phổ biến.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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