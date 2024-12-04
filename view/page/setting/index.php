<?php 
    if((!isset($_SESSION['success_message']) && !isset($_SESSION['email'])) || (!isset($_SESSION['emailUserLoginGoogle']) && !isset($_SESSION['success_message']))){
        header('Location: index.php?page=login');
        $_SESSION['info_login'] = "Thông báo đăng nhập.";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cài đặt</title>

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

    <section class="container pb-4 my-4 text-black">

        <div class="profile-header text-center">
            <?php
            include_once('controller/User/UserController.php');
            $userController = new UserController();

            if (isset($_SESSION['email'])) {
                $user = $userController->getUserByEmailController($_SESSION['email']);

                if ($user) {
                    echo '
                    <img src="asset/image/user/' . htmlspecialchars($user['image'], ENT_QUOTES, 'UTF-8') . '" alt="Ảnh đại diện" class="img-fluid mb-3">
                    <h2>' . htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8') . '</h2>
                    <p class="text-black">Email: ' . htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') . '</p>
                    <p class="text-black">Số điện thoại: ' . htmlspecialchars($user['number_phone'], ENT_QUOTES, 'UTF-8') . '</p>
                    ';
                } else {
                    echo '<p>Không tìm thấy người dùng.</p>';
                }
            } else {
                $user = $userController->getUserByEmailController($_SESSION['emailUserLoginGoogle']);

                if ($user) {
                    echo '
                    <img src="asset/image/user/' . htmlspecialchars($user['image'], ENT_QUOTES, 'UTF-8') . '" alt="Ảnh đại diện" class="img-fluid mb-3">
                    <h2>' . htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8') . '</h2>
                    <p class="text-black">Email: ' . htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') . '</p>
                    ';
                    if ($user['number_phone'] === NULL) {
                        echo '<p class="text-black">Số điện thoại: Chưa cập nhật</p>';
                    } else {
                        echo '<p class="text-black">Số điện thoại: ' . htmlspecialchars($user['number_phone'], ENT_QUOTES, 'UTF-8') . '</p>';
                    }
                } else {
                    echo '<p>Không tìm thấy người dùng.</p>';
                }
            }

            ?>

        </div>

        <div class="container mt-5">
            <ul class="nav nav-tabs">
                <li class="nav-item nav-tabs-item col-lg-4 text-center fw-bold">
                    <a class="nav-link active" href="#" data-target="info">Thông tin cá nhân</a>
                </li>
                <li class="nav-item nav-tabs-item col-lg-4 text-center fw-bold">
                    <a class="nav-link" href="#" data-target="order">Lịch sử đơn hàng</a>
                </li>
                <li class="nav-item nav-tabs-item col-lg-4 text-center fw-bold">
                    <a class="nav-link" href="#" data-target="setting">Cài đặt tài khoản</a>
                </li>
            </ul>

            <div class="tab-content mt-5" id="info">
                <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: auto;">
                    <form action="" method="post" class="form p-4 w-100 card" enctype="multipart/form-data">
                        <h3 class="text-center mb-4">Cập nhật thông tin</h3>
                        <div class="row">
                            <div class="col-lg-7">
                                <?php
                                include_once('controller/User/UserController.php');
                                $userController = new UserController();

                                if (isset($_SESSION['email'])) {
                                    $user = $userController->getUserByEmailController($_SESSION['email']);

                                    if ($user) {
                                        echo '
                                                <div class="mb-3">
                                                    <label for="fullname" class="form-label text-black">Họ tên<span class="text-danger">*</span></label>
                                                    <input type="text" name="user_name" value="' . htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8') . '" class="form-control text-black border-color" id="fullNameUpdate" placeholder="Nhập họ và tên">
                                                    <small class="valid-feedback" id="errorFullName"></small>
                                                </div>
                                                ';
                                        if ($user['date_of_birth'] != NULL) {
                                            echo '
                                                    <div class="mb-3">
                                                        <label for="date" class="form-label text-black">Ngày sinh<span class="text-danger">*</span></label>
                                                        <input type="date" name="date" value="' . htmlspecialchars($user['date_of_birth'], ENT_QUOTES, 'UTF-8') . '" class="form-control text-black border-color" id="dateUpdate">
                                                        <small class="valid-feedback" id="errorDate"></small>
                                                    </div>
                                                    
                                                    ';
                                        } else {
                                            echo '
                                                    <div class="mb-3">
                                                        <label for="date" class="form-label text-black">Ngày sinh<span class="text-danger">*</span></label>
                                                        <input type="date" name="date" class="form-control text-black border-color" id="dateUpdate">
                                                        <small class="valid-feedback" id="errorDate"></small>
                                                    </div>
                                                    
                                                    ';
                                        }
                                        echo '<div class="mb-3">
                                                    <label for="email" class="form-label text-black">Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="email" value="' . htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') . '" class="form-control text-black border-color" id="emailUpdate" placeholder="Nhập địa chỉ email">
                                                    <small class="valid-feedback" id="errorEmail"></small>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="phone" class="form-label text-black">Số điện thoại<span class="text-danger">*</span></label>
                                                    <input type="text" name="number_phone" value="' . htmlspecialchars($user['number_phone'], ENT_QUOTES, 'UTF-8') . '" class="form-control text-black border-color" id="phoneUpdate" placeholder="Nhập số điện thoại">
                                                    <small class="valid-feedback" id="errorPhone"></small>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address" class="form-label text-black">Địa chỉ<span class="text-danger">*</span></label>';

                                        $address = $user['address'] ? htmlspecialchars($user['address'], ENT_QUOTES, 'UTF-8') : 'Chưa cập nhật';

                                        echo '
                                                    <input type="text" name="address" value="' . $address . '" class="form-control text-black border-color" id="addressUpdate" placeholder="Nhập địa chỉ">
                                                    <small class="valid-feedback" id="errorAddress"></small>
                                                </div>
                                            ';
                                    }
                                } else {
                                    $user = $userController->getUserByEmailController($_SESSION['emailUserLoginGoogle']);

                                    if ($user) {
                                        echo '
                                                <div class="mb-3">
                                                    <label for="fullname" class="form-label text-black">Họ tên<span class="text-danger">*</span></label>
                                                    <input type="text" name="user_name" value="' . htmlspecialchars($user['user_name'], ENT_QUOTES, 'UTF-8') . '" class="form-control text-black border-color" id="fullNameUpdate" placeholder="Nhập họ và tên">
                                                </div>';
                                        if ($user['date_of_birth'] != NULL) {
                                            echo '
                                                    <div class="mb-3">
                                                        <label for="date" class="form-label text-black">Ngày sinh<span class="text-danger">*</span></label>
                                                        <input type="date" name="date" value="' . htmlspecialchars($user['date_of_birth'], ENT_QUOTES, 'UTF-8') . '" class="form-control text-black border-color" id="dateUpdate">
                                                    </div>
                                                    ';
                                        } else {
                                            echo '
                                                    <div class="mb-3">
                                                        <label for="date" class="form-label text-black">Ngày sinh<span class="text-danger">*</span></label>
                                                        <input type="date" name="date" class="form-control text-black border-color" id="dateUpdate">
                                                    </div>
                                                    ';
                                        }
                                        echo '<div class="mb-3">
                                                    <label for="email" class="form-label text-black">Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="email" value="' . htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') . '" class="form-control text-black border-color" id="emailUpdate" placeholder="Nhập địa chỉ email">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label text-black">Số điện thoại<span class="text-danger">*</span></label>';
                                        if ($user['number_phone'] === NULL) {
                                            echo '<input type="text" name="number_phone" value="" class="form-control text-black border-color" id="phone" placeholder="Chưa cập nhật số điện thoại">';
                                        } else {
                                            echo '<input type="text" name="number_phone" value="' . htmlspecialchars($user['number_phone'], ENT_QUOTES, 'UTF-8') . '" class="form-control text-black border-color" id="phoneUpdate" placeholder="Nhập số điện thoại">';
                                        }
                                        echo '</div>
                                                <div class="mb-3">
                                                    <label for="address" class="form-label text-black">Địa chỉ<span class="text-danger">*</span></label>';

                                        $address = $user['address'] ? htmlspecialchars($user['address'], ENT_QUOTES, 'UTF-8') : 'Chưa cập nhật';

                                        echo '
                                                    <input type="text" name="address" value="' . $address . '" class="form-control text-black border-color" id="addressUpdate" placeholder="Nhập địa chỉ">
                                                </div>
                                            ';
                                    }
                                }
                                ?>
                            </div>

                            <div class="col-lg-5">
                                <div class="update-avatar">
                                    <label class="form-label text-black">Cập nhật hình đại diện</label>
                                    <input type="file" class="form-control border-color" name="imageUser" accept="image/*" id="imageUploadUser" onchange="previewImagesUser(this)">
                                    <div class="image-preview mt-2" id="imagePreviewImageUser"></div>
                                </div>

                                <div class="old-avatar mt-3 mb-2">
                                    <label for="old-avatar" class="form-label text-black">Ảnh đại diện trước đó</label> <br>
                                    <?php
                                    include_once('controller/User/UserController.php');
                                    $userController = new UserController();

                                    if (isset($_SESSION['email'])) {
                                        $user = $userController->getUserByEmailController($_SESSION['email']);

                                        if ($user) {
                                            echo '
                                                <img src="asset/image/user/' . htmlspecialchars($user['image'], ENT_QUOTES, 'UTF-8') . '" alt="Ảnh đại diện" height="170" width="170" class="img-fluid mx-auto d-block"> 
                                                ';
                                        }
                                    } else {
                                        $user = $userController->getUserByEmailController($_SESSION['emailUserLoginGoogle']);

                                        if ($user) {
                                            echo '
                                                <img src="asset/image/user/' . htmlspecialchars($user['image'], ENT_QUOTES, 'UTF-8') . '" alt="Ảnh đại diện" height="170" width="170" class="img-fluid mx-auto d-block"> 
                                                ';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" name="btnUpdateInfoUser" value="btnUpdateInfoUser" id="btnUpdateInfoUser" class="btn btn-outline-primary active">Lưu thay đổi</button>
                        </div>

                    </form>
                    <?php
                    if (isset($_REQUEST['btnUpdateInfoUser']) && $_REQUEST['btnUpdateInfoUser'] === "btnUpdateInfoUser") {
                        include_once('controller/Email/EmailController.php');
                        $emailController = new EmailController();

                        $emailAuthu = $_REQUEST['email'];
                        $userNameAuthu = $_REQUEST['user_name'];

                        $_SESSION['userName'] = $_REQUEST['user_name'];
                        $_SESSION['nameUserName'] = $_REQUEST['user_name'];
                        $_SESSION['date'] = $_REQUEST['date'];
                        $_SESSION['emailUserName'] = $_REQUEST['email'];
                        $_SESSION['numberPhoneUserName'] = $_REQUEST['number_phone'];
                        $_SESSION['addressUserName'] = $_REQUEST['address'];

                        $emailController->sendEmailUpdateInfo($emailAuthu, $userNameAuthu);

                        if (isset($_FILES['imageUser']) && $_FILES['imageUser']['error'] == 0) {

                            $fileExtension = pathinfo($_FILES['imageUser']['name'], PATHINFO_EXTENSION);
                            $randomFileName = uniqid('user_', true) . '.' . $fileExtension;
                            if (move_uploaded_file($_FILES['imageUser']['tmp_name'], "asset/image/user/" . $randomFileName)) {

                                $_SESSION['randomFileName'] = $randomFileName;
                                sleep(2);
                                echo '<script>
                                    window.location.href = "index.php?page=authu";
                                </script>';
                            }
                        } else {
                            sleep(2);
                            echo '<script>
                                window.location.href = "index.php?page=authu";
                            </script>';
                        }
                    }
                    ?>
                </section>
            </div>

            <div class="tab-content mt-5" id="order">
                <section class="container pb-4 my-4 d-flex justify-content-center align-items-start" style="height: auto;">
                    <div class="card w-100">
                        <div class="card-body d-flex">
                            <img src="https://via.placeholder.com/250" class="img-fluid me-3" alt="Áo sơ mi">
                            <div class="text-black">
                                <h5 class="card-title">Tên người bán</h5>
                                <p class="mt-2">Tên sản phẩm</p>
                                <div class="mb-2">
                                    <p class="mb-1">Phân loại hàng: <span class="fw-bold">Danh mục thuộc tính: - Thuộc tính: </span></p>
                                    <p class="mb-1">Số lượng: <span class="fw-bold">x1</span></p>
                                </div>
                                <p class="text-danger fw-bold">Giá bán: <span>₫110.000</span></p>
                                <p class="fw-bold">Thành tiền: <span>₫99.000</span></p>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-primary active">Mua Lại</a>
                                    <a href="#" class="btn btn-link">Chat với người bán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <div class="tab-content mt-5" id="setting">
                <section class="container pb-4 my-4 d-flex justify-content-center align-items-center" style="height: auto;">

                    <form action="" method="post" class="form card p-4 w-100">
                        <h3 class="text-center mb-4">Cập nhật mật khẩu</h3>
                        <div class="mb-3">
                            <label for="password" class="form-label text-black">Mật khẩu mới<span class="text-danger">*</span></label>
                            <input type="password" name="passwordUpdate" class="form-control border-color text-black" id="passwordUpdate" placeholder="Nhập mật khẩu mới">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label text-black">Xác nhận mật khẩu<span class="text-danger">*</span></label>
                            <input type="password" name="passwordConfirm" class="form-control border-color text-black" id="confirmPasswordUpdate" placeholder="Xác nhận mật khẩu">
                        </div>
                        <button type="submit" id="btnUpdatePassword" name="btnUpdatePassword" value="btnUpdatePassword" class="btn btn-outline-primary active w-100">Cập nhật mật khẩu</button>
                    </form>

                    <?php
                    if(isset($_REQUEST['btnUpdatePassword'])){

                        include_once('controller/Email/EmailController.php');
                        $emailController = new EmailController();

                        $_SESSION['passwordUpdate'] = $_REQUEST['passwordUpdate'];
                        $_SESSION['passwordConfirm'] = $_REQUEST['passwordConfirm'];

                        if(!empty($_REQUEST['passwordUpdate']) && !empty($_REQUEST['passwordConfirm']) && $_REQUEST['passwordUpdate'] === $_REQUEST['passwordConfirm'] && strlen($_REQUEST['passwordUpdate']) >= 8 && strlen($_REQUEST['passwordConfirm']) >= 8){

                            if(isset($_SESSION['emailUserLoginGoogle'])){
                                $emailController->sendEmailUpdatePasswordOtp($_SESSION['emailUserLoginGoogle']);

                                sleep(2);
                                echo '<script>
                                    window.location.href = "index.php?page=changePassword";
                                </script>';
                            }else{
                                $emailController->sendEmailUpdatePasswordOtp($_SESSION['email']);

                                sleep(2);
                                echo '<script>
                                    window.location.href = "index.php?page=changePassword";
                                </script>';
                            }
                            
                        }else{
                            echo '<script>alert("Mật khẩu không hợp lệ")</script>';
                            
                        }
                    }
                    ?>

                </section>
            </div>
        </div>
    </section>

    <?php
    include_once('view/layout/header/button_backtotop.php');
    ?>

    <?php
    include_once('script.php');
    ?>

    <?php
    include_once('view/layout/footer/footer.php');
    ?>

    <?php
    include_once('view/layout/footer/lib-cdn-js.php');
    ?>
</body>

</html>