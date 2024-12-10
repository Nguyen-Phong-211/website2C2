<section class="container pb-4 my-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb text-black">
            <li class="breadcrumb-item">
                <a href="index.php?page=home" class="text-decoration-underline">Trang chủ</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#6bb252" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                </svg>
            </li>
            <li class="breadcrumb-item">
                <?php 
                    $pageName = $page;

                    switch ($pageName) {
                        case 'cart':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Giỏ hàng </a>';
                            break;
                        case 'whistlist':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Sản phẩm yêu thích </a>';
                            break;    
                        case 'notification':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Thông báo </a>';
                            break;
                        case 'registration_product':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Đăng tin </a>';
                            break; 
                        case 'contact':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Liên hệ </a>';
                            break;
                        case 'member':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Thành viên </a>';
                            break; 
                        case 'puchaseOrder':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Đơn mua </a>';
                            break; 
                        case 'sellOrder':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Đơn bán </a>';
                            break; 
                        case 'registrationProduct':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Đăng tin bán sản phẩm </a>';
                            break; 
                        case 'review':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Đánh giá từ tôi </a>';
                            break;
                        case 'setting':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Cài đặt </a>';
                            break; 
                        case 'clause':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Chính sách điều khoản và bảo mật </a>';
                            break;  


                        default:
                            # code...
                            break;
                    }
                ?>
            </li>
        </ol>
    </nav>
</section>