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
                    <div class="col-md-12 d-flex flex-column">
                        <h4>An toàn khi sử dụng tính năng Chat Với Người Bán</h4>
                        <p><b>1. Các lưu ý khi sử dụng tính năng “Chat với người bán”</b></p>
                        <ul><li>ORANIC không chat với khách hàng qua kênh Chat với người bán. Vui lòng nhấn vào đây nếu bạn muốn chat trực tuyến với bộ phận Chăm sóc khách hàng của Chợ Tốt (từ 8h-12h và 13h-17h hàng ngày).</li>
                        <li>ORANIC chỉ thu phí đối với dịch vụ có tính phí (Đẩy tin, Tin Ưu Tiên, …) và dịch vụ Đăng tin đối với 1 số chuyên mục.</li>
                        <li>Đối với các chương trình khuyến mãi hoặc trao thưởng, ORANIC không yêu cầu khách hàng trả phí tham gia/nhận thưởng và không liên hệ với khách hàng qua kênh Chat với người bán.</li>
                        <li>Các kênh thông tin truyền thông chính thức của ORANIC:</li>
                        <P>Fanpage ORANIC: www.facebook.com/oranic.vn </BR>
                        Kênh cập nhật các chương trình khuyến mãi của Chợ Tốt: chuongtrinh.oranic.com</P>  
                        <P><B>2. Mẹo khi chat với người mua/người bán</B></P>  
                        <UL><li>Tuyệt đối không cung cấp cho bất kì ai (bao gồm cả nhân viên ORANIC) thông tin của dịch vụ ngân hàng điện tử của bạn như tên truy cập, mật khẩu, mã xác thực giao dịch một lần (OTP) và các thông tin trên thẻ.</li>
                        <li>Cẩn thận với các nội dung/link trúng thưởng từ người mua/bán khác.</li>
                        <li>Không nên chuyển tiền cho người khác dưới bất kỳ hình thức nào bên ngoài nền tảng ORANIC. Nếu có nhu cầu chuyển tiền hoặc đặt cọc, hãy sử dụng tính năng Đặt cọc qua ORANIC để việc mua bán được an toàn hơn. Tìm hiểu thêm.</li>
                        <li>Nếu không muốn nhận tin nhắn chat từ người mua/bán khác, bạn có thể sử dụng tính năng “Chặn người này”. </li>
                        <li>Nếu phát hiện hoặc nghi ngờ các trường hợp chat có nội dung không nghiêm túc, vui lòng thông báo cho ORANIC bằng cách sử dụng tính năng “Báo xấu”.</li></UL>
                        <img src="asset/image/banner/antoan.jpg" alt="" style="width: 600px">
                        <p><b>Nếu có ai đó liên hệ bạn để thu tiền hoặc thông báo trúng thưởng, hãy liên hệ với Chợ Tốt để được kiểm chứng thông tin:</b></p>
                        <ul>
                            <li>Nhấn vào đây để chat trực tiếp với chúng tôi trong giờ hành chính (từ 8h-12h và 13h-17h hàng ngày).</li>
                            <li>Gửi email về trogiup@oranic.vn.</li>
                            <li>Đường dây nóng: 19003003 (Thời gian hỗ trợ từ 08h-12h và 13h-17h từ thứ 2 đến thứ 6 hàng tuần).</li>
                        </ul>
                    </ul>
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