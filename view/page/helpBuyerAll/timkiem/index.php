<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hỗ trợ người mua - Các bước tìm kiếm một sản phẩm</title>

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
                <!-- Cột bên trái: Thanh điều hướng -->
                <div class="col-md-4">
                    <nav id="navbar-example3" class="content-card navbar navbar-light-sidebar bg-white shadow-sm rounded p-3 position-sticky">
                        <h5 class="text-primary mb-3"><b>Mua hàng tại ORANIC như thế nào?</b></h5>
                        <ul class="nav flex-column">
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpBuyerAll/timkiem" class="nav-link-title text-secondary text-decoration-none">
                                    Các bước tìm kiếm một sản phẩm
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpBuyerAll/meo" class="nav-link-title text-secondary text-decoration-none">
                                    Mẹo tìm kiếm hiệu quả
                                </a>
                            </li>
                        </ul>

                        <h5 class="text-primary mt-4 mb-3"><b>Mẹo mua hàng</b></h5>
                        <ul class="nav flex-column">
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpBuyerAll/meomuahang" class="nav-link-title text-secondary text-decoration-none">
                                    Mẹo mua hàng an toàn
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpBuyerAll/muaxe" class="nav-link-title text-secondary text-decoration-none">
                                    Cách mua xe an toàn ở ORANIC
                                </a>
                            </li>
                        </ul>


                        <h5 class="text-primary mt-4 mb-3"><b>Các quy định chung</b></h5>
                        <ul class="nav flex-column">
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpBuyerAll/gioithieu" class="nav-link-title text-secondary text-decoration-none">
                                    Giới thiệu website chúng tôi
                                </a>
                            </li>
                            <li class="nav-item my-1">
                                <a href="index.php?page=helpBuyerAll/quyche" class="nav-link-title text-secondary text-decoration-none">
                                    Quy chế tài khoản
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="col-md-8">
                    <div class="content-section bg-white p-4">
                        <h4>Các bước tìm kiếm một sản phẩm</h4>
                        <p><b>TRÊN TRÌNH DUYỆT WEB MÁY TÍNH</b></p>
                        <p><b>Bước 1:</b> Tại Trang chủ ORANIC www.oranic.com, nhấn vào biểu tượng kính lúp “Tìm rao vặt” ở đầu trang hoặc chọn danh mục bạn muốn tìm kiếm.</p>
                        <img src="asset/image/banner/timkiem.jpg" alt="" style="width: 600px" class="img-fluid">
                        <p><b>Bước 2:</b> Chọn Khu vực bạn muốn tìm kiếm. Bạn cũng có thể thay đổi Danh mục tìm kiếm phù hợp với món hàng bạn cần.</p>
                        <img src="asset/image/banner/timkiem1.jpg" alt="" class="img-fluid">
                        <p><b>Bước 3:</b> Nhập tên món hàng bạn cần tìm vào ô Tìm kiếm và chọn nút Tìm.</p>
                        <img src="asset/image/banner/timkiem2.jpg" alt="" class="img-fluid">
                        <p>Kết quả sau khi tìm kiếm tin rao sẽ được hiển thị như sau:</p>
                        <img src="asset/image/banner/timkiem3.jpg" alt="" class="img-fluid">
                        <ul>
                            <li><b>Tiêu đề</b> tin ở phía trên cùng của tin đăng.</li>
                            <li><b>Giá sản phẩm</b> rao bán được hiển thị ở hàng thứ hai của tin đăng.</li>
                            <li><b>Thời gian tin đã đăng, Quận, huyện và Phân nhóm người dùng</b> (Cá nhân hay Bán chuyên) được hiển thị ở hàng thứ ba của tin tin đăng.</li>
                            <li>Đối với một số chuyên mục cụ thể, Tìm kiếm nâng cao được tích hợp để giúp bạn dễ dàng lọc được sản phẩm phù hợp với nhu cầu hơn khi chọn “Lọc”.</li>
                        </ul>
                        <p><b>TRÊN TRÌNH DUYỆT WEB ĐIỆN THOẠI/ỨNG DỤNG CHỢ TỐT</b></p>
                        <p><b>Bước 1:</b> Chọn biểu tượng kính lúp (Tìm kiếm) ở trang chủ ứng dụng Chợ Tốt :</p>
                        <img src="asset/image/banner/timkiem4.jpg" alt="" class="img-fluid">
                        <p><b>Bước 2:</b> Nhập thông tin của món hàng cần tìm, bao gồm: Tên món hàng, Vùng cần tìm, Danh mục. Sau đó, chọn nút Tìm.</p>
                        <p><b>Lưu ý khi tìm kiếm tin đăng:</b></p>
                        <ul>
                            <li>Tên món hàng cần tìm kiếm không cần phân biệt chữ hoa hay chữ thường.</li>
                            <li>Cụm từ khoá tìm kiếm có dấu và không dấu tiếng Việt sẽ cho các kết quả khác nhau.</li>
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