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

                <button type="submit" class="btn btn-primary w-100 mb-3">Đăng ký</button>
                <div class="d-flex align-items-center mb-3">
                    <hr class="flex-grow-1">
                    <span class="mx-2">hoặc</span>
                    <hr class="flex-grow-1">
                </div>
                <button type="button" class="btn btn-outline-secondary w-100">
                    <img src="asset/image/logo/logo-google.png" /> Đăng nhập bằng Google
                </button>
            </form>
            <script>
                // Kiểm tra họ tên và tự động viết hoa chữ cái đầu mỗi từ
                // Kiểm tra họ tên và tự động viết hoa chữ cái đầu mỗi từ
                document.getElementById('fullName').addEventListener('input', function() {
                    const fullNameInput = this;

                    // Viết hoa chữ cái đầu của mỗi từ sau khoảng trắng
                    fullNameInput.value = fullNameInput.value
                        .toLowerCase() // Đưa tất cả về chữ thường trước
                        .replace(/\b\w/g, char => char.toUpperCase()); // Viết hoa chữ cái đầu mỗi từ

                    // Kiểm tra nếu họ tên để trống
                    document.getElementById('fullNameError').textContent = fullNameInput.value.trim() ? "" : "Họ tên không được để trống";
                });

                // Kiểm tra email
                document.getElementById('email').addEventListener('input', function() {
                    const email = this.value.trim();
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    document.getElementById('emailError').textContent = emailRegex.test(email) ? "" : "Email không hợp lệ";
                });

                // Kiểm tra số điện thoại
                document.getElementById('phone').addEventListener('input', function() {
                    const phone = this.value.trim();
                    const phoneRegex = /^\d{10}$/;
                    document.getElementById('phoneError').textContent = phoneRegex.test(phone) ? "" : "Số điện thoại phải là 10 chữ số";
                });

                // Kiểm tra mật khẩu và hiển thị độ mạnh của mật khẩu
                document.getElementById('password').addEventListener('input', function() {
                    const password = this.value.trim();
                    const passwordStrengthElement = document.getElementById('passwordStrength');

                    if (password.length < 5) {
                        passwordStrengthElement.textContent = 'Mật khẩu yếu';
                        passwordStrengthElement.style.color = 'red';
                    } else if (password.length < 8) {
                        passwordStrengthElement.textContent = 'Mật khẩu trung bình';
                        passwordStrengthElement.style.color = 'orange';
                    } else if (password.length < 12) {
                        passwordStrengthElement.textContent = 'Mật khẩu mạnh';
                        passwordStrengthElement.style.color = 'green';
                    } else {
                        passwordStrengthElement.textContent = 'Mật khẩu rất mạnh';
                        passwordStrengthElement.style.color = 'darkgreen';
                    }
                });

                // Kiểm tra nhập lại mật khẩu
                document.getElementById('confirmPassword').addEventListener('input', function() {
                    const confirmPassword = this.value.trim();
                    const password = document.getElementById('password').value.trim();
                    document.getElementById('confirmPasswordError').textContent = (confirmPassword === password) ? "" : "Mật khẩu không khớp";
                });
            </script>


        </div>
    </div>
    <script src="vendor/js/bootstrap.bundle.min.js"></script>
</body>

</html>