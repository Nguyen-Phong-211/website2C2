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
    <title>Quản lý danh mục cấp 2</title>
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
                    <div
                        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">THỐNG KÊ</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div
                                                class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Visitors</p>
                                                <h4 class="card-title">1,294</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div
                                                class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Subscribers</p>
                                                <h4 class="card-title">1303</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div
                                                class="icon-big text-center icon-success bubble-shadow-small">
                                                <i class="fas fa-luggage-cart"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Sales</p>
                                                <h4 class="card-title">$ 1,345</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div
                                                class="icon-big text-center icon-secondary bubble-shadow-small">
                                                <i class="far fa-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Order</p>
                                                <h4 class="card-title">576</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    include_once('controller/CategoryItem/CategoryItemController.php');
                    include_once('controller/Category/CategoryController.php');
                    $categoryController = new CategoryController();
                    $categoryItemController = new CategoryItemController();

                    if (isset($_GET['category_id'])) {
                        $categoryId = intval($_GET['category_id']); 
                        $category = $categoryController->getCategoryByIdController($categoryId);
                        $categoryItems = $categoryItemController->getAllListCategoryItemByCategoryController($categoryId);
                    } else {
                        $categoryItems = [];
                    }
                    ?>
                    <div class="row">
                        <div class="container mt-4">
                            <h3 class="mb-4">Quản lý cấp 2</h3>
                            <a href="index.php?page=managerCategory" class="btn btn-secondary mx-1"><i class="icon-arrow-left"></i>&nbsp; Quay lại</a>
                            <!-- <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addCategoryItemModal">
                                Thêm danh mục con
                            </button> -->
                            <?php 
                            if(isset($_GET['category_id'])){
                                echo '
                                <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addCategoryItemModal">
                                    Thêm danh mục con
                                </button>';
                            }else{
                                echo '
                                <div class="alert alert-warning mt-3 w-50" role="alert">
                                    <i class="icon-ban"></i> Chưa chọn danh mục cha. Vui lòng bấm <a href="index.php?page=managerCategory">Quay lại</a> để tiếp tục!
                                </div>';
                            }
                            ?>
                            <!-- Modal -->
                            <div class="modal fade" id="addCategoryItemModal" tabindex="-1" aria-labelledby="addCategoryItemModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addCategoryItemModalLabel">Thêm Danh Mục Con</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="addCategoryItemForm"
                                                action="index.php?page=managerCategoryItem&action=add&category_id=<?php echo isset($_GET['category_id']) ? intval($_GET['category_id']) : ''; ?>"
                                                method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="categoryItem_parent" class="form-label"><strong>Danh mục cha:</strong></label>
                                                    <input type="text" id="categoryItem_parent"
                                                        class="form-control" value="<?php echo htmlspecialchars($category['category_name']); ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="category_name" class="form-label">Tên danh mục con: <span class="text-danger"> * </span></label>
                                                    <input type="text" name="categoryItem_name" id="categoryItem_name" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Hình ảnh (không bắt buộc):</label>
                                                    <input type="file" name="image" id="image" class="form-control">
                                                </div>
                                                <button type="button" class="btn btn-danger mx-2 mt-2" data-bs-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-primary mx-2 mt-2">Thêm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered mt-4">
                                <thead>
                                    <tr>
                                        <strong>
                                            <th>STT</th>
                                        </strong>
                                        <strong>
                                            <th>Tên danh mục con</th>
                                        </strong>
                                        <strong>
                                            <th>Hình ảnh</th>
                                        </strong>
                                        <strong>
                                            <th>Hành động</th>
                                        </strong>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stt = 1;
                                    foreach ($categoryItems as $categoryItem):
                                        $categoryItemImage = $categoryItem['image']; ?>
                                        <tr>
                                            <td><?php echo $stt++; ?></td>
                                            <td><?php echo $categoryItem['category_item_name']; ?></td>
                                            <td>
                                                <img src="asset/image/category_item/<?= htmlspecialchars($categoryItemImage); ?>" alt="Hình ảnh danh mục con"
                                                    style="width: 70px; height: 60px;">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary edit-button"
                                                    data-id="<?php echo $categoryItem['category_item_id']; ?>"
                                                    data-name="<?php echo $categoryItem['category_item_name']; ?>"
                                                    data-image="<?php echo htmlspecialchars($categoryItem['image']); ?>"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editCategoryItemModal">
                                                    Sửa
                                                </button>
                                                <a href="index.php?page=managerCategoryItem&action=delete&id=<?php echo $categoryItem['category_item_id']; ?>"
                                                    class="btn btn-danger mx-2"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục con này?');">Xóa</a>
                                                <a href="index.php?page=managerCompany&category_item_id=<?php echo $categoryItem['category_item_id']; ?>"
                                                    class="btn btn-primary mx-2">Thương hiệu</a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editCategoryItemModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryItemModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form id="editCategoryItemForm"
                                                        action="index.php?page=managerCategoryItem&action=edit&
                                                        category_id=<?php echo isset($_GET['category_id']) ? intval($_GET['category_id']) : ''; ?>"
                                                        method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="editCategoryItemModalLabel">Sửa danh mục con</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="category_item_id" id="categoryItemId">
                                                            <div class="mb-3">
                                                                <label for="categoryItem_parent" class="form-label"><strong>Danh mục cha:</strong></label>
                                                                <input type="text" id="categoryItem_parent"
                                                                    class="form-control" value="<?php echo htmlspecialchars($category['category_name']); ?>" readonly>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="category_name">Tên danh mục con<span class="text-danger"> * </span></label>
                                                                <input type="text" class="form-control" name="category_item_name" id="categoryItemName" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="image">Hình ảnh (không bắt buộc)</label>
                                                                <input type="file" class="form-control-file" name="image">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label>Hình ảnh hiện tại:</label>
                                                                <div>
                                                                    <img id="currentImage" src="" alt="Hình ảnh cũ"
                                                                        style="max-width: 100px; display: block; margin-top: 10px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary mx-2 mt-2" data-bs-dismiss="modal">Đóng</button>
                                                            <button type="submit" class="btn btn-primary mx-2 mt-2">Lưu thay đổi</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        include_once('script.php');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Custom template | don't include it in your project! -->
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