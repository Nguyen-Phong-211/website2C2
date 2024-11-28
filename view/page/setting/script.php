<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("info").classList.add("active");

        document.querySelectorAll(".nav-link").forEach(function(link) {
            link.addEventListener("click", function(event) {
                event.preventDefault();

                document.querySelectorAll(".nav-link").forEach(function(nav) {
                    nav.classList.remove("active");
                });
                document.querySelectorAll(".tab-content").forEach(function(content) {
                    content.classList.remove("active");
                });

                link.classList.add("active");
                const targetId = link.getAttribute("data-target");
                document.getElementById(targetId).classList.add("active");
            });
        });
    });

    function previewImagesUser(input) {
        const imagePreview = document.getElementById('imagePreviewImageUser');
        imagePreview.innerHTML = '';

        const files = input.files;

        if (files.length === 0) {
            alert('Vui lòng chọn ít nhất một hình ảnh!');
            return;
        }

        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            if (!file.type.startsWith('image/')) {
                alert('Tệp được chọn không phải là hình ảnh.');
                continue;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'me-2', 'mt-2');
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                imagePreview.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    };
    const fullNameInput = document.getElementById('fullNameUpdate');
    const dateInput = document.getElementById('dateUpdate');
    const phoneInput = document.getElementById('phoneUpdate');
    const emailInput = document.getElementById('emailUpdate');
    const submitButton = document.getElementById('btnUpdateInfoUser');

    const errorFullName = document.getElementById('errorFullName');
    const errorDate = document.getElementById('errorDate');
    const errorPhone = document.getElementById('errorPhone');
    const errorEmail = document.getElementById('errorEmail');

    function validateForm() {
        let isValid = true;

        const fullNameRegex = /^[a-zA-ZÀ-ỹ\s]+$/;
        if (!fullNameRegex.test(fullNameInput.value.trim())) {
            isValid = false;
            errorFullName.innerHTML = "Họ tên chỉ được chứa chữ cái và khoảng trắng.";
            errorFullName.classList.add("text-danger");
        } else {
            errorFullName.innerHTML = "";
            errorFullName.classList.remove("text-danger");
        }


        const birthDate = new Date(dateInput.value);
        const today = new Date();
        const age = today.getFullYear() - birthDate.getFullYear();
        const isBirthdayPassed =
            today.getMonth() > birthDate.getMonth() ||
            (today.getMonth() === birthDate.getMonth() && today.getDate() >= birthDate.getDate());
        const actualAge = isBirthdayPassed ? age : age - 1;

        if (isNaN(birthDate.getTime()) || actualAge < 18) {
            isValid = false;
            errorDate.innerHTML = "Bạn phải trên 18 tuổi.";
            errorDate.classList.add("text-danger");
        } else {
            errorDate.innerHTML = "";
            errorDate.classList.remove("text-danger");
        }

        const phoneRegex = /^\d{10}$/;
        if (!phoneRegex.test(phoneInput.value.trim())) {
            isValid = false;
            errorPhone.innerHTML = "Số điện thoại phải gồm 10 chữ số.";
            errorPhone.classList.add("text-danger");
        } else {
            errorPhone.innerHTML = "";
            errorPhone.classList.remove("text-danger");
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value.trim())) {
            isValid = false;
            errorEmail.innerHTML = "Địa chỉ email không hợp lệ.";
            errorEmail.classList.add("text-danger");
        } else {
            errorEmail.innerHTML = "";
            errorEmail.classList.remove("text-danger");
        }

        submitButton.disabled = !isValid;
    }

    fullNameInput.addEventListener('input', validateForm);
    dateInput.addEventListener('input', validateForm);
    phoneInput.addEventListener('input', validateForm);
    emailInput.addEventListener('input', validateForm);

    validateForm();
</script>