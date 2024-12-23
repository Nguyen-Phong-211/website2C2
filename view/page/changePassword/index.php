<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 100px;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: auto;">
        <div class="card" style="width: 700px;">
            <div class="card-body">
                <h5 class="card-title text-center">Nhập Mã OTP</h5>
                <div class="alert alert-success mt-3" role="alert">
                    Mã OTP được gửi qua email. Vui lòng kiểm tra email trước khi nhập!
                </div>
                <form action="" method="post" class="mt-3">
                    <div class="mb-3">
                        <label for="otp" class="form-label">Mã OTP</label>
                        <input type="number" name="authuOtp" class="form-control" id="otp" placeholder="Nhập mã OTP của bạn">
                    </div>
                    <input type="submit" value="Xác Nhận" name="btnSubmitOtp" class="btn btn-primary w-100">
                </form>
                <?php
                if (isset($_REQUEST['btnSubmitOtp'])) {

                    $authuOtp = (int)$_REQUEST['authuOtp'];
                    include_once('controller/User/UserController.php');
                    $userController = new UserController();

                    if(isset($_SESSION['email'])){

                        $user_id = $userController->getUserIdByEmailController($_SESSION['email']);

                        if ($_SESSION['otp'] === $authuOtp) {

                            include_once('controller/Email/EmailController.php');
                            $emailController = new EmailController();

                            if (isset($_SESSION['passwordUpdate']) && isset($_SESSION['passwordConfirm'])) {
                                include_once('controller/Notification/NotificationController.php');
                                $notificationController = new NotificationController();
                                $updatePassword = $userController->updatePasswordController($user_id, $_SESSION['passwordUpdate']);
                                $notificationController->addNotificationsByUserIdController($_SESSION['user_id'], 'Đổi mật khẩu thành công', 'Bạn đã đổi mật khẩu thành công. Vui lòng không tiết lộ mật khẩu với bất kì ai.');
                                $emailController->sendEmailUpdateInfoPasswordSuccess($_SESSION['emailUserLoginGoogle']);
                                echo "
                                <script>
                                    alert('Cập nhật thông tin thành công!');
                                    window.location.href = 'index.php?page=setting'
                                </script>";
                                unset($_SESSION['passwordUpdate'], $_SESSION['passwordConfirm']);
                            } 
                        } else {
                            echo "<script>alert('Mã OTP không hợp lệ hoặc chưa nhập!')</script>";
                        }
                    }
                    else{
                        $user_id = $userController->getUserIdByEmailController($_SESSION['emailUserLoginGoogle']);

                        if ($_SESSION['otp'] === $authuOtp) {

                            include_once('controller/Email/EmailController.php');
                            $emailController = new EmailController();

                            if (isset($_SESSION['passwordUpdate']) && isset($_SESSION['passwordConfirm'])) {
                                include_once('controller/Notification/NotificationController.php');
                                $notificationController = new NotificationController();
                                $notificationController->addNotificationsByUserIdController($_SESSION['user_id'], 'Đổi mật khẩu thành công', 'Bạn đã đổi mật khẩu thành công. Vui lòng không tiết lộ mật khẩu với bất kì ai.');

                                $updatePassword = $userController->updatePasswordController($user_id, $_SESSION['passwordUpdate']);
            
                                $emailController->sendEmailUpdateInfoPasswordSuccess($_SESSION['emailUserLoginGoogle']);
                                echo "
                                <script>
                                    alert('Cập nhật thông tin thành công!');
                                    window.location.href = 'index.php?page=setting'
                                </script>";
                                unset($_SESSION['passwordUpdate'], $_SESSION['passwordConfirm']);
                            } 
                        } else {
                            echo "<script>alert('Mã OTP không hợp lệ hoặc chưa nhập!')</script>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>