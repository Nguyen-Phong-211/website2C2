<script>
    function addToCart(productId) {
        const userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!userId) {
            alert('Bạn cần đăng nhập để thêm vào giỏ hàng!');
            return;
        }
        console.log(productId);
        // Gửi yêu cầu AJAX đến server
        fetch('controller/Cart/AddToCartController.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'add_to_cart',
                    product_id: productId,
                    user_id: userId,
                    quantity: 1,
                }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                alert('Sản phẩm đã thêm vào giỏ hàng!');
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    // JavaScript AJAX request to filter products by rating
    function filterByRating() {
        var selectedRating = document.querySelector('input[name="ratingStar"]:checked')?.value;

        if (!selectedRating) {
            alert("Vui lòng chọn số sao để lọc sản phẩm.");
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'controller/Product/FilterRSProductController.php', true); // Thay '/controller/filterByRating' bằng URL đúng của controller
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);

                if (response.error) {
                    alert(response.error); // Hiển thị thông báo lỗi nếu có
                } else {
                    // Cập nhật giao diện với các sản phẩm lọc được
                    var productList = document.getElementById('product-list');
                    productList.innerHTML = ''; // Xóa các sản phẩm cũ
                    response.forEach(function(product) {
                        var productHTML = `<div class="product-item">
                        <h3>${product.product_name}</h3>
                        <p>Price: ${product.price}</p>
                        <p>Rating: ${product.rating_star} stars</p>
                    </div>`;
                        productList.innerHTML += productHTML;
                    });
                }
            } else {
                alert('Có lỗi khi tải dữ liệu sản phẩm.');
            }
        };

        xhr.onerror = function() {
            alert('Lỗi khi thực hiện yêu cầu.');
        };

        xhr.send('ratingStar=' + selectedRating);
    }

    // Lắng nghe sự kiện thay đổi rating
    document.querySelectorAll('input[name="ratingStar"]').forEach(function(input) {
        input.addEventListener('change', filterByRating);
    });



    <?php
    // include_once('controller/Product/FilterRSProductController.php');
    ?>