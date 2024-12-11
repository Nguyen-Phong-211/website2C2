<section class="container pb-4 my-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb text-black">
            <li class="breadcrumb-item">
                <a href="index.php?page=home" class="text-decoration-underline">Trang chủ</a>
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
                        case 'detailProduct':
                            echo '<a class="text-decoration-none" href="index.php?page=detailProduct&idp='. $_REQUEST['idp'] .'">Chi tiết sản phẩm</a>';
                            break;  
                        case 'product':
                            if (isset($_REQUEST['s_interface']) && $_REQUEST['s_interface'] == 1) {
                                echo '<a href="index.php?page=' . $page . '&s_interface=1" class="text-decoration-none"> Khám phá danh mục </a>';
                            } else {
                                echo '<a href="index.php?page=' . $page . '&idc=' . $_REQUEST['idc'] . '" class="text-decoration-none"> Sản phẩm </a>';
                            }
                            break; 
                        case 'help':
                            echo '<a href="index.php?page=' . $page . '" class="text-decoration-none"> Hỗ trợ người bán và người mua </a>';
                            break;  
                        case 'helpSeller':
                            echo '<a href="index.php?page='. $page. '" class="text-decoration-none"> Hỗ trợ người bán </a>';
                            break;  
                        case 'helpSellerAll/cacbuocraoban1monhang':
                            echo '
                            <a href="index.php?page=helpSeller" class="text-decoration-none"> Hỗ trợ người bán - </a>
                            <a href="index.php?page=' . $page . '" class="text-decoration-none">Các bước rao bán 1 món hàng</a>';
                            break;
                        default:
                            echo '<a href="" class="text-decoration-none"> Khám phá </a>';
                            break;
                    }
                ?>
            </li>
            <?php 
                include_once('controller/Product/ProductController.php');
                include_once('controller/Category/CategoryController.php');
                include_once('controller/CategoryItem/CategoryItemController.php');

                $productController = new ProductController();
                $categoryController = new CategoryController(); 
                $categoryItemController = new CategoryItemController();

                if($_REQUEST['page'] == 'detailProduct'){
                    $idp = $_REQUEST['idp'];
                    echo '<li class="breadcrumb-item"><a>'. $productController->getNameProductByIdController($idp). '</a></li>';

                }elseif($_REQUEST['page'] == 'product' && isset($_REQUEST['idc']) && !isset($_REQUEST['fdh_op'])){
                    $idc = $_REQUEST['idc'];
                    $categoryName = $categoryController->getCategoryNameController($idc);
                    echo '<li class="breadcrumb-item">' . htmlspecialchars($categoryName) . '</li>';

                }elseif($_REQUEST['page'] == 'product' && isset($_REQUEST['idc']) && isset($_REQUEST['idci']) && isset($_REQUEST['fdh_op'])){
                    $categoryItemName = $categoryItemController->getCategoryNameController($_REQUEST['idc'], $_REQUEST['idci']);
                    $categoryName = $categoryController->getCategoryNameController($_REQUEST['idc']);

                    echo '<li class="breadcrumb-item"><a class="text-decoration-none" href="index.php?page=product&idc='. $_REQUEST['idc'] .'&idci='. $_REQUEST['idci'] .'&fdh_op=oikHk5tRF">' . $categoryName . '</a></li>';
                    echo '<li class="breadcrumb-item">' . $categoryItemName . '</li>';
                }
            ?>
        </ol>
    </nav>
</section>