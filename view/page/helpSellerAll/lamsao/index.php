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
                        <h4>Làm sao đăng ký tài khoản ORANIC ?</h4>
                        <P>Để đăng ký tài khoản trên Chợ Tốt, vui lòng làm theo các bước sau:</P>
                        <p><b>Bước 1:</b>Vào trang www.organic.com → Nhấn vào biểu tượng 3 chấm “Thêm” → Nhấn “Đăng nhập/Đăng ký“.</p>
                        <img src="asset/image/banner/lamsao.jpg" alt="">
                        <p><b>Bước 2:</b>Nhấn vào nút Đăng ký tại trang Đăng nhập như hình bên dưới.</p>
                        <img src="asset/image/banner/lamsao1.jpg" alt="">
                        <p><b>Bước 3:</b> Nhập số điện thoại bạn muốn sử dụng và mật khẩu tự tạo của bạn. Sau đó, nhấn vào nút Đăng ký.</p>
                        <img src="asset/image/banner/lamsao2.jpg" alt="">
                        <p>Khi đó, tài khoản đã được tạo. Sau đó, một tin nhắn chứa Mã xác nhận sẽ được gửi tới số điện thoại trên, bạn dùng Mã này để xác nhận cho tài khoản của bạn.</p>
                        <p><b>Lưu ý:</b></p>
                        <ul>
                            <li>Chọn Đăng ký cũng đồng nghĩa với việc bạn đã đọc và đồng ý với Quy chế hoạt động của ORANIC.</li>
                            <li>Nếu sau 5 phút bạn không nhận được mã xác nhận, vui lòng tham khảo hướng dẫn.</li>
                        </ul>
                        <P><b>Bước 4:</b> Nhập Mã xác nhận để xác nhận số điện thoại</P>
                        <img src="asset/image/banner/lamsao3.jpg" alt="">
                        <p>Sau khi nhập mã xác nhận thành công, vậy là bạn đã hoàn thành đăng ký tài khoản trên ORANIC. Bạn có thể đăng nhập tài khoản theo thông tin đã đăng ký để sử dụng đầy đủ các tính năng cũng như trải nghiệm mua bán trên ORANIC.</p>

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