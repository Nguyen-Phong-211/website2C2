<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hỗ trợ người bán - Đăng tin trên website</title>

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

                <div class="col-md-8">
                    <div class="content-section bg-white p-4">
                        <h4>Đăng tin với ứng dụng ORANIC</h4>
                        <p><b>ORANIC</b> hiện nay đã phát triển trên cả hai nền tảng website và ứng dụng (App). Để đăng bán một món hàng trên chính điện thoại của mình bằng cách dùng Ứng dụng của ORANIC, bạn chỉ cần thực hiện các bước đơn giản sau:</p>
                        <p><b>Bước 1: Đăng nhập vào ứng dụng ORANIC</b></p>
                        <ul>
                            <li>Nếu bạn chưa có ứng dụng ORANIC, vui lòng cài đặt tại đây nhé!</li>
                            <li>Nếu bạn chưa có tài khoản trên ORANIC, hãy nhấn vào đây để xem hướng dẫn tạo tài khoản nhé!</li>
                            <li>Nếu bạn đã tạo tài khoản nhưng quên mật khẩu, hãy nhấn vào đây để được hướng dẫn lấy lại mật khẩu nhé!</li>
                        </ul>
                        <p><b>Bước 2: Chọn biểu tượng “Đăng tin” trên ứng dụng ORANIC.</b></p>
                        <img src="asset/image/banner/taisao3.jpg" alt="">
                        <p><b>Bước 3: Chọn danh mục cần đăng tin tương ứng.</b></p>
                        <img src="asset/image/banner/dangtin.jpg" alt="">
                        <p><b>Bước 4: Tạo tin đăng với nội dung theo yêu cầu (hình ảnh, nội dung, giá, …), sau đó nhấn nút “ĐĂNG TIN“.</b></p>
                        <img src="asset/image/banner/dangtin1.jpg" alt="">
                        <p>Như vậy bạn đã hoàn thành việc đăng tin. ORANIC sẽ cố gắng duyệt tin của bạn nhanh nhất có thể. Bạn có thể theo dõi tình trạng tin đăng tại trang Quản lý tin (nhấn vào biểu tượng hình mặt người trên trang chủ ORANIC).</p>
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