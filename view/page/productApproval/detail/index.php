<?php
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) {
    echo '<script>alert("Vui lòng đăng nhập để tiếp tục.");
        window.location.href = "index.php?page=login";</script>';
}
?>
<?php
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . addslashes($_SESSION['message']) . "');</script>";
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Quản lý danh mục cấp 3</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <script src="asset/admin/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["asset/admin/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
    <link rel="stylesheet" href="asset/admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="asset/admin/css/plugins.min.css" />
    <link rel="stylesheet" href="asset/admin/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="asset/admin/css/demo.css" />

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php
        include_once('view/layout/slidebar/admin-slidebar.php');
        ?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img
                                src="assets/img/kaiadmin/logo_light.svg"
                                alt="navbar brand"
                                class="navbar-brand"
                                height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav
                            class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search ..."
                                    class="form-control" />
                            </div>
                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li
                                class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a
                                    class="nav-link dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    role="button"
                                    aria-expanded="false"
                                    aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                placeholder="Search ..."
                                                class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="messageDropdown"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                </a>
                                <!-- <ul
                                    class="dropdown-menu messages-notif-box animated fadeIn"
                                    aria-labelledby="messageDropdown">
                                    <li>
                                        <div
                                            class="dropdown-title d-flex justify-content-between align-items-center">
                                            Messages
                                            <a href="#" class="small">Mark all as read</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="assets/img/jm_denis.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jimmy Denis</span>
                                                        <span class="block"> How are you ? </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="assets/img/chadengle.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Chad</span>
                                                        <span class="block"> Ok, Thanks ! </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="assets/img/mlane.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jhon Doe</span>
                                                        <span class="block">
                                                            Ready for the meeting today...
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="assets/img/talha.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Talha</span>
                                                        <span class="block"> Hi, Apa Kabar ? </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul> -->
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-togg" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification">0</span>
                                </a>
                                <!-- <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">
                                            You have 4 new notification
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-icon notif-primary">
                                                        <i class="fa fa-user-plus"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block"> New user registered </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-icon notif-success">
                                                        <i class="fa fa-comment"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            Rahmad commented on Admin
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="assets/img/profile2.jpg" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            Reza send messages to you
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-icon notif-danger">
                                                        <i class="fa fa-heart"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block"> Farrah liked Admin </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul> -->
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a
                                    class="nav-link"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    aria-expanded="false">
                                    <i class="fas fa-layer-group"></i>
                                </a>
                                <!-- <div class="dropdown-menu quick-actions animated fadeIn">
                                    <div class="quick-actions-header">
                                        <span class="title mb-1">Quick Actions</span>
                                        <span class="subtitle op-7">Shortcuts</span>
                                    </div>
                                    <div class="quick-actions-scroll scrollbar-outer">
                                        <div class="quick-actions-items">
                                            <div class="row m-0">
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-danger rounded-circle">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </div>
                                                        <span class="text">Calendar</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div
                                                            class="avatar-item bg-warning rounded-circle">
                                                            <i class="fas fa-map"></i>
                                                        </div>
                                                        <span class="text">Maps</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-info rounded-circle">
                                                            <i class="fas fa-file-excel"></i>
                                                        </div>
                                                        <span class="text">Reports</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div
                                                            class="avatar-item bg-success rounded-circle">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <span class="text">Emails</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div
                                                            class="avatar-item bg-primary rounded-circle">
                                                            <i class="fas fa-file-invoice-dollar"></i>
                                                        </div>
                                                        <span class="text">Invoice</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div
                                                            class="avatar-item bg-secondary rounded-circle">
                                                            <i class="fas fa-credit-card"></i>
                                                        </div>
                                                        <span class="text">Payments</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </li>

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="asset/image/user/img-default.png" alt="..." class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">Phong</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="asset/image/user/img-default.png" alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4>Hizrian</h4>
                                                    <p class="text-muted">hello@example.com</p>
                                                    <a href="" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">My Profile</a>
                                            <a class="dropdown-item" href="#">My Balance</a>
                                            <a class="dropdown-item" href="#">Inbox</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Account Setting</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="index.php?page=logout">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="row">
                        <h3 class="fw-bold mb-3">CHI TIẾT SẢN PHẨM</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="index.php?page=manage">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=productApproval">Danh sách sản phẩm</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=productApproval/detail&idrp=<?= $_REQUEST['idrp'] ?>">Chi tiết sản phẩm</a>
                            </li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">THÔNG TIN NGƯỜI BÁN: </h4>
                                </div>
                                <div class="card-body">
                                    <?php
                                    include_once('controller/User/UserController.php');
                                    $userController = new UserController();
                                    $dataUserRegis = $userController->getInfoUserSellerRegisController();
                                    $_SESSION['userId'] = $dataUserRegis['email'];
                                    // var_dump($_SESSION);
                                    echo '
                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <div class="d-flex align-items-center">
                                                <label for="" class="form-label mb-0 me-2">Họ và tên người bán: </label>
                                                <p class="fw-bold mb-0">' . $dataUserRegis['user_name'] . '</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="d-flex align-items-center">
                                                <label for="" class="form-label mb-0 me-2">Số điện thoại: </label>
                                                <p class="fw-bold mb-0">' . $dataUserRegis['number_phone'] . '</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="d-flex align-items-center">
                                                <label for="" class="form-label mb-0 me-2">Email: </label>
                                                <p class="fw-bold mb-0">' . $dataUserRegis['email'] . '</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <label for="" class="form-label mb-0 me-2">Địa chỉ: </label>
                                                <p class="fw-bold mb-0">' . $dataUserRegis['address'] . '</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <div class="d-flex align-items-center">
                                                <label for="" class="form-label mb-0 me-2">Ngày đăng ký bán: </label>
                                                <p class="fw-bold mb-0">' . $dataUserRegis['create_at'] . '</p>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">THÔNG TIN DANH MỤC: </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        include_once('controller/RegistrationProduct/RegistrationProductController.php');
                                        $registrationProductController = new RegistrationProductController();

                                        $dataLevelCategories = $registrationProductController->getNameLevelCategoryController($_REQUEST['idrp']);
                                        foreach ($dataLevelCategories as $dataLevelCategory) {
                                            echo '
                                            <div class="col-md-4 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <label for="" class="form-label mb-0 me-2">Danh mục cấp 1: </label>
                                                    <p class="fw-bold mb-0">' . $dataLevelCategory['category_name'] . '</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <label for="" class="form-label mb-0 me-2">Danh mục cấp 2: </label>
                                                    <p class="fw-bold mb-0">' . $dataLevelCategory['category_item_name'] . '</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <label for="" class="form-label mb-0 me-2">Danh mục cấp 3:</label>
                                                    <p class="fw-bold mb-0">' . $dataLevelCategory['company_name'] . '</p>
                                                </div>
                                            </div>
                                            ';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                    include_once('controller/RegistrationProduct/RegistrationProductController.php');
                    include_once('controller/Image/ImageController.php');
                    include_once('controller/RegistrationProductAttribute/RegistrationProductAttributeController.php');
                    $registrationProductController = new RegistrationProductController();
                    $imageController = new ImageController();
                    $registrationProductAttributeController = new RegistrationProductAttributeController();

                    if (isset($_REQUEST['idrp'])) {
                        $infoProductRegis = $registrationProductController->getInfoRegisByIdController($_REQUEST['idrp']);
                        $imageRegis = $imageController->getAllImagesByRegisProductIdController($_REQUEST['idrp']);
                        $categoryAttributes = $registrationProductAttributeController->getRegistrationProductAttributeController($_REQUEST['idrp']);
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">SẢN PHẨM: </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php foreach ($infoProductRegis as $infoProduct): ?>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="d-inline-flex align-items-center">
                                                        <label for="" class="form-label mb-0 me-2">Mã đơn đăng ký: </label>
                                                        <span class="badge bg-primary mb-0"><?php echo $infoProduct['registration_product_id'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label for="" class="form-label mb-0 me-2" style="flex-shrink: 0; width: 150px;">Tên sản phẩm: </label>
                                                        <input disabled type="text" class="form-control" style="flex-grow: 1;" value="<?php echo $infoProduct['title'] ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label for="" class="form-label mb-0 me-2" style="flex-shrink: 0; width: 150px;">Số lượng: </label>
                                                        <input disabled type="text" class="form-control" style="flex-grow: 1;" value="<?php echo $infoProduct['quantity'] ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label for="" class="form-label mb-0 me-2" style="flex-shrink: 0; width: 150px;">Giá: </label>
                                                        <input disabled type="text" class="form-control" style="flex-grow: 1;" value="<?php echo $infoProduct['price'] ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label for="" class="form-label mb-0 me-2" style="flex-shrink: 0; width: 150px;">Địa chỉ: </label>
                                                        <input disabled type="text" class="form-control" style="flex-grow: 1;" value="<?php echo $infoProduct['address'] ?>">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label for="" class="form-label mb-0 me-2" style="flex-shrink: 0; width: 150px;">Ngày đăng tin: </label>
                                                        <input disabled type="text" class="form-control" style="flex-grow: 1;" value="<?php echo $infoProduct['create_at'] ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label for="" class="form-label mb-0 me-2" style="flex-shrink: 0; width: 150px;">Chính sách bảo hành: </label>
                                                        <input disabled type="text" class="form-control" style="flex-grow: 1;" value="<?php echo $infoProduct['warranty_policy_name'] ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label for="" class="form-label mb-0 me-2" style="flex-shrink: 0; width: 150px;">Tình trạng sản phẩm: </label>
                                                        <input disabled type="text" class="form-control" style="flex-grow: 1;" value="<?php echo $infoProduct['status_product_name'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label mb-0 me-2 mt-0">Mô tả: </label><br>
                                                    <div class="d-flex align-items-center gap-2 mt-3">
                                                        <textarea disabled class="form-control" id="exampleFormControlTextarea1" rows="17"><?php echo $infoProduct['description'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="" class="form-label mb-0">Hình ảnh: </label>
                                            <div class="row">
                                                <?php foreach ($imageRegis as $image): ?>
                                                    <div class="col-6 col-md-3 mb-3">
                                                        <div class="d-flex justify-content-start">
                                                            <img src="asset/image/product/<?php echo $image['image_name'] ?>" alt="" class="img-fluid" height="200px" width="200px">
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <?php foreach ($categoryAttributes as $valueca): ?>
                                            <div class="col-md-6 mb-3">
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label for="" class="form-label mb-0 me-2" style="flex-shrink: 0; width: 150px;">Danh mục thuộc tính: </label>
                                                        <input disabled type="text" class="form-control" style="flex-grow: 1;" value="<?php echo $valueca['category_attribute_name'] ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label for="" class="form-label mb-0 me-2" style="flex-shrink: 0; width: 150px;">Thuộc tính: </label>
                                                        <input disabled type="text" class="form-control" style="flex-grow: 1;" value="<?php echo $valueca['attribute_name'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <form action="" method="post" class="row">

                                    <?php if(isset($_REQUEST['idrp'])): ?>
                                        <?php
                                        include_once('controller/RegistrationProduct/RegistrationProductController.php');
                                        $registrationProductController = new RegistrationProductController();

                                        $statusReason = $registrationProductController->getStatusRegistrationProductController($_REQUEST['idrp']);
                                        ?>
                              
                                        <?php if($statusReason['status'] == 2 && $statusReason['reason_for_refusal'] != NULL): ?>
                                            <div class="row mb-4">
                                                <div class="form-group has-error has-feedback">
                                                    <label for="errorInput">Lý do từ chối: </label>
                                                    <input type="text" disabled value="<?php echo $statusReason['reason_for_refusal'] ?>" class="form-control"/>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(($statusReason['status'] == 1 && $statusReason['reason_for_refusal'] != NULL)): ?>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-success w-100" name="btnApprovalProduct">Duyệt</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-danger w-100 col-md-6" data-bs-toggle="modal" data-bs-target="#cancelProduct">Từ chối</button>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(($statusReason['status'] == 0 && $statusReason['reason_for_refusal'] == NULL)): ?>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-success w-100" name="btnApprovalProduct">Duyệt</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-danger w-100 col-md-6" data-bs-toggle="modal" data-bs-target="#cancelProduct">Từ chối</button>
                                            </div>
                                        <?php endif; ?>
                                

                                    <?php endif; ?>
                                    

                                    <?php
                                    include_once('controller/RegistrationProduct/RegistrationProductController.php');

                                    $registrationProductController = new RegistrationProductController();

                                    if (isset($_POST['btnApprovalProduct'])) {
                                        $regisId = $_REQUEST['idrp'];
                                        $registrationProductController->insertProductDataController($regisId);
                                        $registrationProductController->updateRoleSellerController($_SESSION['userId']);
                                    } elseif (isset($_POST['btnRefuseProduct'])) {
                                        if (!empty($_POST['reason'])) {
                                            $regisId = $_REQUEST['idrp'];
                                            $reason = $_POST['reason'];
                                            $registrationProductController->updateReasonRefusalController($regisId, $reason);
                                        } else {
                                            echo '<script>
                                                alert("Vui lòng nhập lý do từ chối!");
                                                window.loaction.href="page=productApproval"
                                            </script>';
                                        }
                                    }
                                    ?>
                                    



                                        <!-- Modal -->
                                        <div class="modal fade" id="cancelProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="cancelProductLabel">Lý do từ chối sản phẩm</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label mb-0 me-2 mt-0">Mô tả lý do từ chối sản phẩm: </label><br>
                                                            <div class="d-flex align-items-center gap-2 mt-3">
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="reason"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary" name="btnRefuseProduct">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeTopBarColor" data-color="dark"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="green"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange"></button>
                            <button type="button" class="changeTopBarColor" data-color="red"></button>
                            <button type="button" class="selected changeTopBarColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="green2"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                            <button type="button" class="changeTopBarColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeSideBarColor" data-color="white"></button>
                            <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
                            <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-toggle">
                <i class="icon-settings"></i>
            </div>
        </div>
        <!-- End Custom template -->
    </div>
    <?php
    include_once('view/layout/footer/lib-admin.php');
    ?>
</body>

</html>