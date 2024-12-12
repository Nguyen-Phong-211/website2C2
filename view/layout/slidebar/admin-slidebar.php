<?php 
    include_once('controller/General/GeneralController.php');
    $generalController = new GeneralController();
?>
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.php?page=manage" class="logo">
                <img src="asset/admin/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
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
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a href="index.php?page=manage" class="collapsed">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">QUẢN LÝ</h4>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Danh mục</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="index.php?page=managerCategory&hsu_poij=<?= $generalController->generateRandomString() ?>">
                                    <span class="sub-item">Danh mục cấp 1</span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php?page=managerCategoryItem&hsu_poij=<?= $generalController->generateRandomString() ?>">
                                    <span class="sub-item">Danh mục cấp 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="index.php?page=managerCompany&hsu_poij=<?= $generalController->generateRandomString() ?>">
                                    <span class="sub-item">Danh mục cấp 3</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Thuộc tính</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="index.php?page=managerCategoryAttribute&hsu_poij=<?= $generalController->generateRandomString() ?>">
                                    <span class="sub-item">Danh mục thuộc tính</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Sản phẩm</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="index.php?page=productApproval&hsu_poij=<?= $generalController->generateRandomString() ?>">
                                    <span class="sub-item">Duyệt sản phẩm</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>