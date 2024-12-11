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
                        <H4>Đăng tin với ứng dụng ORANIC</H4>
                        <P><B>ORANIC</B> hiện nay đã phát triển trên cả hai nền tảng website và ứng dụng (App). Để đăng bán một món hàng trên chính điện thoại của mình bằng cách dùng Ứng dụng của ORANIC, bạn chỉ cần thực hiện các bước đơn giản sau:</P>
                        <P><B>Bước 1: Đăng nhập vào ứng dụng ORANIC</B></P>
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