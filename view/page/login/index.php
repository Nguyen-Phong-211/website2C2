<!-- notification of login must be login -->
<?php if (isset($_SESSION['info_login']))?>

<div class="modal fade border-color shadow-sm" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title font-monospace text-black" id="staticBackdropLabel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#dc3444" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                    </svg>
                    <small>
                        Cần đăng nhập để sử dụng các chức năng của chúng tôi!
                    </small>
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('staticBackdrop');
        const modalInstance = new bootstrap.Modal(modalElement);

        modalInstance.show();

        setTimeout(() => {
            modalInstance.hide();
        }, 2000);
    });
</script>

<?php
unset($_SESSION['info_login']);
?>


<?php

include_once('controller/Login/LoginController.php');

$loginController = new LoginController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnLogin'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $loginController->loginUserController($email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng nhập</title>
    <?php
    include_once('view/layout/header/lib_cdn.php');
    ?>

</head>

<body>
    
    <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="width: 100%; max-width: 40%;">
            <h2 class="text-center mb-4">Đăng Nhập</h2>
            <p class="text-black">Bạn chưa có tài khoản? <a href="index.php?page=signup" class="text-primary">Đăng ký</a></p>


            <?php
            if (isset($_SESSION['error_message'])) {

                echo '
                <div class="alert alert-danger" role="alert">
                    ' . $_SESSION['error_message'] . '
                </div>
                ';
                unset($_SESSION['error_message']);
            }
            ?>

            <form action="index.php?page=login" method="post">

                <div class="mb-3">
                    <label for="email" class="form-label text-black">Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control text-black border-color" id="email" name="email" placeholder="Nhập email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-black">Mật khẩu<span class="text-danger">*</span></label>
                    <input type="password" class="form-control border-color" id="password" name="password" placeholder="Nhập mật khẩu">
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3" name="btnLogin">Đăng nhập</button>

                <div class="d-flex align-items-center mb-3">
                    <hr class="flex-grow-1">
                    <span class="mx-2">hoặc</span>
                    <hr class="flex-grow-1">
                </div>
                
                <a href="
                <?php 
                    include_once('controller/Login/GoogleLoginController.php');
                    $googleLogin = new GoogleLoginController();
                    $authUrl = $googleLogin->getAuthUrl();
                    if (!empty($authUrl)) {
                        echo htmlspecialchars($authUrl); 
                    } else {
                        echo '#';
                    }
                ?>
                " class="btn btn-outline-secondary w-100">
                    <img src="asset/image/logo/logo-google.png" /> Đăng nhập bằng Google
                </a>

                
            </form>
        </div>
    </div>
    



    <script src="vendor/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    include_once('view/layout/footer/lib-cdn-js.php');
    ?>
</body>

</html>