<!DOCTYPE html>
<html lang="en">

<head>
    <title>Trợ Giúp</title>

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
    include_once('view/layout/slider/slider.php');
    ?>


    <?php
    include_once('view/layout/pagination/index.php');
    ?>

    <section class="pb-4 my-4">
        <div class="container">
            <div class="row">
                <!-- Cột bên trái: Thanh điều hướng -->
                <div class="col-md-5 d-flex flex-column">
                <nav id="navbar-example3"
                        class="navbar navbar-light bg-light flex-column align-items-stretch p-3 position-sticky">
                        <a class="navbar-brand text-primary" href="#"><b>Bán hàng trên ORANIC như thế nào ?</b></a>
                        <nav class="nav nav-pills flex-column">
                        <a class="nav-link ms-3 my-1" href="#item-1" ><a href="index.php?page=helpSellerAll/cacbuocraoban1monhang" style = "text-decoration: none; margin-left: 30px;">Các bước rao bán 1 món hàng</a></a>
                        <a class="nav-link ms-3 my-1" href="#item-1"><a href="index.php?page=helpSellerAll/dangtin" style = "text-decoration: none; margin-left: 30px; padding-bottom: 20px;">Đăng tin với ứng dụng ORANIC</a></a>
                        </nav>
                        <a class="navbar-brand text-primary" href="#"><b>ORANIC kiểm duyệt tin rao của tôi như thế nào ?</b></a>
                        <nav class="nav nav-pills flex-column">
                        <a class="nav-link ms-3 my-1" href="#item-2"><a href="index.php?page=helpSellerAll/taisao" style = "text-decoration: none; margin-left: 30px;">Tại sao ORANIC duyệt tin trước khi đăng?</a></a>
                        <a class="nav-link ms-3 my-1" href="#item-2"><a href="index.php?page=helpSellerAll/tuchoi" style = "text-decoration: none; margin-left: 30px; padding-bottom: 20px;">Tại sao tin của tôi bị từ chối?</a></a>
                        </nav>
                        <a class="navbar-brand text-primary" href="#"><b>Hỗ trợ tài khoản</b></a>
                        <nav class="nav nav-pills flex-column">
                        <a class="nav-link ms-3 my-1" href="#item-3"><a href="index.php?page=helpSellerAll/lamsao" style = "text-decoration: none; margin-left: 30px;">Làm sao đăng ký tài khoản?</a></a>
                        <a class="nav-link ms-3 my-1" href="#item-3"><a href="index.php?page=helpSellerAll/lamgi" style = "text-decoration: none; margin-left: 30px; padding-bottom: 20px;">Tôi cần làm gì để thay đổi thông tin cá nhân (Số điện thoại, Email, …)?</a></a>
                        </nav>
                        <a class="navbar-brand text-primary" href="#"><b>Chat với người bán</b></a>
                        <nav class="nav nav-pills flex-column">
                        <a class="nav-link ms-3 my-1" href="#item-4"><a href="index.php?page=helpSellerAll/chat" style = "text-decoration: none; margin-left: 30px;">Chat Với Người Bán là gì?</a></a>
                        <a class="nav-link ms-3 my-1" href="#item-4"><a href="index.php?page=helpSellerAll/antoan" style = "text-decoration: none; margin-left: 30px; padding-bottom: 20px;" >An toàn khi sử dụng tính năng Chat Với Người Bán</a></a>
                        </nav>
                    </nav>
                </div>
                <div class="col-md-1"></div>
                <!-- Cột bên phải: Nội dung -->
                <div class="col-md-6" data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0"
                    tabindex="0">
                    <div class="row">
                    <div class="col-md-11 d-flex flex-column">
                        <H4>Tôi cần làm gì để thay đổi thông tin cá nhân (Số điện thoại, Email, …)?</H4>
                        <P>Nhằm đảm bảo tính xác thực của tài khoản và tin đăng trên Chợ Tốt, Chợ Tốt quy định các thông tin có thể chỉnh sửa/thay đổi như sau:</P>
                        <p>1. Những thông tin cá nhân bạn KHÔNG THỂ thay đổi tại tài khoản của mình bao gồm:</p>
                        <ul><li>Số điện thoại: ORANIC chưa hỗ trợ thay đổi thông tin này.</li></ul>
                        <P>2. Những thông tin cá nhân bạn CÓ THỂ thay đổi tại tài khoản của mình bao gồm:</P>
                        <UL><LI>Địa chỉ Email.</LI>
                        <LI>Mật khẩu.</LI>
                        <LI>Họ và tên, Địa chỉ và các thông tin cơ bản còn lại (Giới tính, Ngày sinh, …)</LI></UL>
                        <P>Để tự thay đổi thông tin cá nhân mà bạn đã đăng ký tại Chợ Tốt, vui lòng thao tác theo các bước sau:</P>
                        <p><b>Bước 1:</b> Vào trang https://www.chotot.com/ → Nhấn vào biểu tượng “Tài khoản” → Chọn “Cài đặt tài khoản”</p>
                        <img src="asset/image/banner/lamgi.jpg" alt="">
                        <p><b>Bước 2:</b> Chọn thông tin mà bạn muốn thay đổi:</p>
                        <ul>
                            <li>Thay đổi Địa chỉ email</li>
                            <li>Thay đổi mật khẩu</li>
                            <li>Thay đổi họ tên, địa chỉ và các thông tin cơ bản (Giới tính, ngày sinh,...)</li>
                        </ul>
                        <p><i>LƯU Ý:</i></p>
                        <UL>
                            <LI>Số điện thoại sẽ không thay đổi được.</LI>
                            <LI>Nếu bạn không nhớ mật khẩu hiện tại của mình, bạn có thể tham khảo hướng dẫn Quên mật khẩu.</LI>
                        </UL>
                    </div>
                    <div class="col-md-1 d-flex flex-column">

                    </div>
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