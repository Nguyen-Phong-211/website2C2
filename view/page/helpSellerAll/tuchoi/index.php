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
                <div class="col-md-5 d-flex flex-column" >
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
                        <h4>Tại sao tin của tôi bị từ chối?</h4>
                        <p>Để tin đăng hiệu quả bán nhanh, bạn cần:</p>
                        <ul>
                            <li>Chú ý đến các thông báo được hiển thị trong phần hướng dẫn đăng tin để điền đầy đủ các thông tin được yêu cầu.</li>
                            <li>Đăng hình ảnh thật của sản phẩm bạn bán.</li>
                            <li>Nếu đã đăng bán mặt hàng đó trên ORANIC rồi thì không đăng lại nữa. Bạn có thể sử dụng chức năng Sửa tin hoặc Đẩy tin để bán hàng nhanh hơn.</li>
                            <li>Miêu tả chi tiết về thông tin sản phẩm/dịch vụ.</li>
                            <li>Trong ô tên không được để số điện thoại, đường dẫn web, email.</li>
                            <li>Sử dụng tiếng việt có dấu.</li>
                        </ul>
                        <p>Tại ORANIC, chúng tôi luôn cố gắng tất cả tin đăng của khách hàng đều được kiểm duyệt với chất lượng tốt nhất. Nếu trường hợp tin đăng bị từ chối xảy ra, nguyên nhân do tin đăng của bạn vi phạm 1 trong những Quy định đăng tin của chúng tôi.</p>
                        <P>Các lý do thường gặp khiến tin bị từ chối:</P>
                        <p>Trường hợp 1: Tin rao trùng lặp</p>
                        <ul>
                            <li>Nếu bạn đã đăng 1 mặt hàng trên ORANIC, toàn bộ những tin đăng bán cùng mặt hàng đó của bạn sẽ bị từ chối do trùng lặp (Kể cả trùng lặp với tin đã ẩn).</li>
                            <li>Trong trường hợp bạn có nhiều tài khoản và dùng những tài khoản đó đăng tin giống nhau thì tin đăng vẫn bị từ chối tin trùng lặp. Quy định này nhằm loại bỏ các tin rác, giúp người mua tìm mặt hàng ưng ý nhanh hơn và người bán bán hàng nhanh hơn.</li>
                            <li>Nếu bạn có nhiều sản phẩm cùng loại có nhiều tình trạng khác nhau, bạn có thể miêu tả nhiều tình trạng, giá tiền khác nhau của cùng 1 sản phẩm trong 1 tin đăng. Lưu ý: Nội dung tin có thể miêu tả bán nhiều sản phẩm cùng model nhưng hình ảnh phải đảm bảo có 3 hình thật, riêng biệt của 1 sản phẩm.</li>
                            <li>Đối với bất động sản, tin đăng có tựa đề trùng lặp sẽ không được đăng. Mỗi dự án chỉ đăng 1 lần, tuy nhiên trong mỗi dự án bạn có thể có nhiều căn hộ, diện tích.   </li>
                            <li>Trong trường hợp bạn chưa bán được hàng, hãy Sửa tin để thu hút hơn. Bạn hãy thêm hình thật của sản phẩm, miêu tả tin chi tiết hơn, hoặc có thể cân nhắc giảm giá. Bạn cũng có thể sử dụng chức năng Đẩy tin để đăng lại tin lên trang đầu.</li>
                        </ul>
                        <P>Trường hợp 2: Tin rao trùng lặp với tin đã ẩn</P>
                        <UL>
                            <LI>Sử dụng chức năng Hiện tin đã ẩn trong mục Quản lý tin đăng thay vì đăng lại tin mới trong trường hợp bạn muốn bán lại món hàng đã ẩn trước đó.</LI>
                        </UL>
                        <p>Trường hợp 3: Sử dụng hình tải từ trên mạng</p>
                        <ul><li>Tin đăng sử dụng hình tải từ trên mạng sẽ bị từ chối.</li>
                        <li>ORANIC yêu cầu người bán tự chụp hình mặt hàng khi đăng tin. Việc đăng hình thật thu hút các khách hàng thực sự yêu thích sản phẩm, giúp bạn bán hàng nhanh hơn.</li>
                    </ul>
                    <P>Trường hợp 4: Đăng thiếu hình sản phẩm hoặc chỉnh sửa hình ảnh quá nhiều</P>
                    <UL>
                        <LI>Khách hàng muốn xem nhiều hình trước khi quyết định mua hàng, do đó hãy đăng ít nhất 5-6 hình thật của sản phẩm.</LI>
                        <LI>Hình đạt yêu cầu là hình rõ, đẹp, chụp từ sản phẩm bạn đang bán.</LI>
                        <LI>Các hình chỉnh sửa quá nhiều, dễ gây hiểu nhầm cho người mua về tình trạng thật của sản phẩm sẽ bị từ chối.</LI>
                        <LI>Không thêm chữ, địa chỉ website, logo, số điện thoại trên hình.</LI>
                        <LI>Không sử dụng hình nghiêng, không đúng chiều, hình được ghép từ nhiều hình khác nhau</LI>
                    </UL>
                    <P>Trường hợp 5: Thiếu thông tin chi tiết khi miêu tả sản phẩm</P>
                    <P>Nếu tin đăng của bạn có quá ít thông tin, người mua sẽ không liên lạc với bạn để mua hàng. Đó là lý do tại sao Chợ Tốt chỉ cho phép tin có miêu tả đầy đủ sản phẩm được đăng.</P>
                    <P>Một số thông tin người mua muốn biết khi mua hàng như sau:</P>
                    <ul>
                        <li>Xuất xứ, hãng sản xuất, model (đặc biệt đối với: đồ điện tử, xe cộ)</li>
                        <li>Kích cỡ, chất liệu (đối với: quần áo, đồ thời trang)</li>
                        <li>Diện tích, địa chỉ, tình trạng sở hữu(đối với: bất động sản)</li>
                        <li>Bạn đã sử dụng mặt hàng được bao lâu & tình trạng hiện tại của mặt hàng (còn xài tốt không, ngoại hình có trầy xước không, có hư hỏng gì không).</li>
                        <li>Lý do tại sao bạn bán mặt hàng đó.</li>
                        <li>Mặt hàng còn bảo hành không và có phụ kiện đi kèm không.</li>
                    </ul>
                    <p>Ngoài ra, bạn có thể tham khảo Quy định về Hàng hoá/Dịch vụ để tránh các mặt hàng, dịch vụ nhạy cảm, hoặc bất hợp pháp trước khi đăng tin.

Để biết về toàn bộ những lý do tin đăng có thể bị từ chối, bạn vui lòng tham khảo tại Quy định đăng tin. 

Để biết cách xử lý khi tin bị từ chối, bạn vui lòng tham khảo Tôi phải làm sao khi tin đăng của tôi bị từ chối?</p>
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