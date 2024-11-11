<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng ký</title>
    <?php
    include_once('view/layout/header/lib_cdn.php');
    ?>

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="width: 100%; max-width: 40%;">
            <h2 class="text-center mb-4">Đăng Ký</h2>

            <form action="" method="post" id="registerForm">
                <div class="mb-3">
                    <label for="fullName" class="form-label text-black">Họ tên<span class="text-danger">*</span></label>
                    <input type="text" class="form-control border-color text-black" id="fullName" placeholder="Họ tên" required>
                    <small id="fullNameError" class="form-text text-danger fst-italic"></small>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-black">Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control border-color text-black" id="email" placeholder="Email" required>
                    <small id="emailError" class="form-text text-danger fst-italic"></small>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label text-black">Số điện thoại<span class="text-danger">*</span></label>
                    <input type="tel" class="form-control border-color text-black" id="phone" placeholder="Số điện thoại" required>
                    <small id="phoneError" class="form-text text-danger fst-italic"></small>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-black">Mật khẩu<span class="text-danger">*</span></label>
                    <input type="password" class="form-control border-color text-black" id="password" placeholder="Nhập mật khẩu" required>
                    <small id="passwordStrength" class="form-text fst-italic"></small>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label text-black">Nhập lại mật khẩu<span class="text-danger">*</span></label>
                    <input type="password" class="form-control border-color text-black" id="confirmPassword" placeholder="Nhập lại mật khẩu" required>
                    <small id="confirmPasswordError" class="form-text text-danger fst-italic"></small>
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <input type="checkbox" class="form-check-input me-2 border-color" id="confirmPassword" checked>
                    <label for="confirmPassword" class="form-check-label">
                        Tôi đồng ý với <a href="#" class="text-primary">Điều khoản</a> và <a href="#" class="text-primary">Bảo mật.</a>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3" id="btnSignup">Đăng ký</button>
                <div class="d-flex align-items-center mb-3">
                    <hr class="flex-grow-1">
                    <span class="mx-2">hoặc</span>
                    <hr class="flex-grow-1">
                </div>
                <button type="button" class="btn btn-outline-secondary w-100">
                    <img src="asset/image/logo/logo-google.png" /> Đăng nhập bằng Google
                </button>
            </form>
            <?php 
                include_once('script.php');
            ?>
        </div>
    </div>
    <script src="vendor/js/bootstrap.bundle.min.js"></script>
</body>

</html>