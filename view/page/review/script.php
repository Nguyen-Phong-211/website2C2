<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("review-buyer").classList.add("active");

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
    document.addEventListener('DOMContentLoaded', () => {
        const stars = document.querySelectorAll('.star-rating i');
        const ratingInput = document.getElementById('rating-input');
        const form = document.querySelector('form'); // Tham chiếu đến form

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.getAttribute('data-value');
                ratingInput.value = rating;

                // Làm sáng các ngôi sao từ 1 đến giá trị chọn
                stars.forEach(s => {
                    s.classList.remove('selected');
                    if (s.getAttribute('data-value') <= rating) {
                        s.classList.add('selected');
                    }
                });
            });
        });

        // Xử lý sự kiện gửi form
        form.addEventListener('submit', (event) => {
            if (!ratingInput.value) {
                alert('Vui lòng chọn sao!');
                event.preventDefault(); // Ngừng gửi form nếu chưa chọn sao
            }
        });
    });
</script>