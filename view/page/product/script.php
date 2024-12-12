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
    // document.addEventListener('DOMContentLoaded', function() {
    //     // Lắng nghe sự kiện khi người dùng chọn một số sao
    //     const ratingStars = document.querySelectorAll('.rating-star-filter');

    //     ratingStars.forEach(function(star) {
    //         star.addEventListener('change', function() {
    //             const ratingStar = this.value; // Lấy giá trị số sao từ radio button

    //             // Gửi yêu cầu Ajax
    //             const xhr = new XMLHttpRequest();
    //             xhr.open('POST', 'controller/Product/FilterRSProductController.php', true);
    //             xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    //             xhr.onload = function() {
    //                 if (xhr.status === 200) {
    //                     const response = JSON.parse(xhr.responseText);

    //                     // Xử lý kết quả trả về và hiển thị danh sách sản phẩm
    //                     const productList = document.getElementById('product-list');
    //                     if (response.length > 0) {
    //                         let productHtml = '';
    //                         response.forEach(function(product) {
    //                             productHtml += `
    //                             <div class="col-md-4">
    //                                 <div class="product-card">
    //                                     <img src="images/${product.image_name}" alt="${product.product_name}" class="product-img">
    //                                     <h5>${product.product_name}</h5>
    //                                     <p>Giá: ${product.price}</p>
    //                                     <p>Số lượng: ${product.quantity}</p>
    //                                     <p>Đánh giá: ${product.rating_star} sao</p>
    //                                 </div>
    //                             </div>
    //                         `;
    //                         });
    //                         productList.innerHTML = productHtml; // Cập nhật lại danh sách sản phẩm
    //                     } else {
    //                         productList.innerHTML = '<p>Không có sản phẩm nào phù hợp.</p>';
    //                     }
    //                 } else {
    //                     alert('Có lỗi xảy ra khi lọc sản phẩm!');
    //                 }
    //             };

    //             xhr.onerror = function() {
    //                 alert('Có lỗi xảy ra khi gửi yêu cầu!');
    //             };

    //             xhr.send('rating=' + encodeURIComponent(ratingStar)); 
    //         });
    //     });
    // });
    document.addEventListener('DOMContentLoaded', function() {
    // Lắng nghe sự kiện khi người dùng chọn một số sao
    const ratingStars = document.querySelectorAll('.rating-star-filter');
    
    ratingStars.forEach(function(star) {
        star.addEventListener('change', function() {
            const ratingStar = this.value; // Lấy giá trị số sao từ radio button

            // Kiểm tra xem ratingStar có hợp lệ không
            if (!ratingStar) {
                console.error('Không có giá trị rating sao!');
                return;
            }

            console.log('Giá trị ratingStar:', ratingStar); // Debug log để kiểm tra giá trị
            
            // Gửi yêu cầu Ajax
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'controller/Product/FilterRSProductController.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    
                    // Xử lý kết quả trả về và hiển thị danh sách sản phẩm
                    const productList = document.getElementById('product-list');
                    if (response.length > 0) {
                        let productHtml = '';
                        response.forEach(function(product) {
                            productHtml += `
                                <div class="col-md-4">
                                    <div class="product-card">
                                        <img src="images/${product.image_name}" alt="${product.product_name}" class="product-img">
                                        <h5>${product.product_name}</h5>
                                        <p>Giá: ${product.price}</p>
                                        <p>Số lượng: ${product.quantity}</p>
                                        <p>Đánh giá: ${product.rating_star} sao</p>
                                    </div>
                                </div>
                            `;
                        });
                        productList.innerHTML = productHtml; // Cập nhật lại danh sách sản phẩm
                    } else {
                        productList.innerHTML = '<p>Không có sản phẩm nào phù hợp.</p>';
                    }
                } else {
                    console.error('Lỗi khi phản hồi từ server:', xhr.status);
                    alert('Có lỗi xảy ra khi lọc sản phẩm!');
                }
            };

            xhr.onerror = function() {
                console.error('Lỗi khi gửi yêu cầu Ajax.');
                alert('Có lỗi xảy ra khi gửi yêu cầu!');
            };

            // Kiểm tra và gửi yêu cầu Ajax với giá trị rating sao
            xhr.send('rating=' + encodeURIComponent(ratingStar)); 
        });
    });
});

</script>