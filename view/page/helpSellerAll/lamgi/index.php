<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hỗ trợ người bán - Thay đổi thông tin cá nhân</title>

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
                        <h4>Tôi cần làm gì để thay đổi thông tin cá nhân (Số điện thoại, Email, …)?</h4>
                        <P>Nhằm đảm bảo tính xác thực của tài khoản và tin đăng trên ORANIC, Chợ Tốt quy định các thông tin có thể chỉnh sửa/thay đổi như sau:</P>
                        <p>1. Những thông tin cá nhân bạn KHÔNG THỂ thay đổi tại tài khoản của mình bao gồm:</p>
                        <ul>
                            <li>Số điện thoại: ORANIC chưa hỗ trợ thay đổi thông tin này.</li>
                        </ul>
                        <p>2. Những thông tin cá nhân bạn CÓ THỂ thay đổi tại tài khoản của mình bao gồm:</p>
                        <ul>
                            <li>Địa chỉ Email.</li>
                            <li>Mật khẩu.</li>
                            <li>Họ và tên, Địa chỉ và các thông tin cơ bản còn lại (Giới tính, Ngày sinh, …)</li>
                        </ul>
                        <p>Để tự thay đổi thông tin cá nhân mà bạn đã đăng ký tại Chợ Tốt, vui lòng thao tác theo các bước sau:</p>
                        <p><b>Bước 1:</b> Vào trang https://www.oranic.com/ → Nhấn vào biểu tượng “Tài khoản” → Chọn “Cài đặt tài khoản”</p>
                        <img src="asset/image/banner/lamgi.jpg" alt="">
                        <p><b>Bước 2:</b> Chọn thông tin mà bạn muốn thay đổi:</p>
                        <ul>
                            <li>Thay đổi Địa chỉ email</li>
                            <li>Thay đổi mật khẩu</li>
                            <li>Thay đổi họ tên, địa chỉ và các thông tin cơ bản (Giới tính, ngày sinh,...)</li>
                        </ul>
                        <p><i>LƯU Ý:</i></p>
                        <ul>
                            <LI>Số điện thoại sẽ không thay đổi được.</LI>
                            <LI>Nếu bạn không nhớ mật khẩu hiện tại của mình, bạn có thể tham khảo hướng dẫn Quên mật khẩu.</LI>
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