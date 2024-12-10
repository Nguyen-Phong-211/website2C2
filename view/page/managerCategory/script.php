<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addCategoryForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn chặn hành động submit mặc định

        const formData = new FormData(form); // Tạo đối tượng FormData từ form
        fetch(form.action, {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Có lỗi xảy ra');
            }
            return response.text(); // Hoặc response.json() nếu server trả về JSON
        })
        .then(data => {
            // Hiển thị nội dung HTML nhận được
            const parser = new DOMParser();
            const htmlDocument = parser.parseFromString(data, 'text/html');
            const message = htmlDocument.querySelector('.message'); // Giả sử thông báo nằm trong một phần tử có class "message"
            
            if (message) {
                alert(message.textContent); // Hiển thị thông điệp từ server
            } else {
                alert('Có lỗi xảy ra, vui lòng kiểm tra lại.');
            }
            $('#addCategoryModal').modal('hide'); // Đóng modal
            location.reload();
        })
        .catch(error => {
            alert('Có lỗi xảy ra, vui lòng thử lại.');
            console.error('Lỗi:', error);
        });
    });
    <?php if (isset($message)): ?>
            alert("<?php echo $message; ?>");
        <?php endif; ?>
    const editButtons = document.querySelectorAll('.edit-button');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-id');
            const categoryName = this.getAttribute('data-name');
            const categoryImage = this.getAttribute('data-image');
            // Cập nhật thông tin vào modal
            document.getElementById('categoryId').value = categoryId;
            document.getElementById('categoryName').value = categoryName;
            document.getElementById('currentImage').src = categoryImage ? 'asset/image/category/' +  categoryImage : '';

            // Hiển thị modal
            $('#editCategoryModal').modal('show');
            const form = document.getElementById('editCategoryForm');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Ngăn chặn hành động submit mặc định

                const formData = new FormData(form); // Tạo đối tượng FormData từ form
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Có lỗi xảy ra');
                    }
                    return response.text(); // Hoặc response.json() nếu server trả về JSON
                })
                .then(data => {
                    // Hiển thị nội dung HTML nhận được
                    const parser = new DOMParser();
                    const htmlDocument = parser.parseFromString(data, 'text/html');
                    const message = htmlDocument.querySelector('.message'); // Giả sử thông báo nằm trong một phần tử có class "message"
                    
                    if (message) {
                        alert(message.textContent); // Hiển thị thông điệp từ server
                    } else {
                        alert('Có lỗi xảy ra, vui lòng kiểm tra lại.');
                    }
                    $('#addCategoryModal').modal('hide'); // Đóng modal
                    location.reload();
                })
                .catch(error => {
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                    console.error('Lỗi:', error);
                });
            });
        });
    });
});
</script>