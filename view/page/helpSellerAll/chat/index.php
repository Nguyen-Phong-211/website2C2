<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hỗ trợ người bán - Chat với người bán là gì?</title>

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
                        <h4>Chat với Người Bán là gì</h4>
                        <p>ORANIC nay đã có tính năng “Chat với người bán”. Bạn có thể nhắn tin trực tiếp với người
                            mua hoặc người bán trên ORANIC.</p>
                        <p><b>Lưu ý:</b>Để sử dụng tính năng Chat, bạn cần Đăng nhập vào tài khoản ORANIC.</p>
                        <p>Để chat với người mua/người bán, bạn có thể làm theo các cách sau:</p>
                        <p><b>TRÊN TRÌNH DUYỆT WEB MÁY TÍNH</b></p>
                        <ul>
                            <li>Nhấn nút “Chat” ở góc phải phía trên màn hình trang chủ.</li>
                            <img src="asset/image/banner/chat.jpg" alt="" style="width : 600px" class="img-fluid">
                        </ul>
                        <p>Bạn có thể chọn “Chặn người này” để ngưng nhận tin nhắn chat từ người khác hoặc chọn
                            “Báo xấu” nếu muốn thông báo cho ORANIC người chat không nghiêm túc.</p>
                        <img src="asset/image/banner/chat1.jpg" alt="" class="img-fluid">
                        <p><b>TRÊN TRÌNH DUYỆT WEB ĐIỆN THOẠI/ỨNG DỤNG CHỢ TỐT</b></p>
                        <ul>
                            <li>Nhấn vào biểu tượng “Chat” như hình bên dưới.</li>
                            <img src="asset/image/banner/chat2.jpg" alt="" class="img-fluid">
                            <li>Hoặc nhấn vào nút “Chat” ở giao diện xem chi tiết tin đăng.</li>
                            <img src="asset/image/banner/chat3.jpg" alt="" class="img-fluid">
                            <p>Bạn có thể chọn “Chặn người này” để ngưng nhận tin nhắn chat từ người khác hoặc chọn “Báo xấu” nếu muốn thông báo cho Chợ Tốt người chat không nghiêm túc.</p>
                            <img src="asset/image/banner/chat4.jpg" alt="" class="img-fluid">
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