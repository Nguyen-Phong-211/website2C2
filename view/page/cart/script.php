<script>
function updateCartQuantity(productId, quantity) {
    
    const userId = <?= json_encode($_SESSION['user_id']); ?>;
    const quantityInt = parseInt(quantity, 10);
    
    fetch('controller/Cart/UpdateController.php', {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
    },
    body: JSON.stringify({action: 'update_cart',  userId, productId, quantity: quantityInt }),
})
   .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data); 
        const totalPriceElement = document.querySelector(`#total-price-${productId}`);
        totalPriceElement.textContent = `${data.totalPrice.toLocaleString()} đồng`;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
function confirmDelete(productId) {
    var isConfirmed = confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?");
    const userId = <?= json_encode($_SESSION['user_id']); ?>;
    if (isConfirmed) {
        fetch('controller/Cart/DeleteProductController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({action: 'delete_product_cart',  userId,
             productId,
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Sản phẩm đã được xóa khỏi giỏ hàng!');
                location.reload(); 
            } else {
                alert('Có lỗi xảy ra khi xóa sản phẩm.');
            }
        })
        .catch(error => {
            console.error('Có lỗi xảy ra:', error);
            alert('Đã có lỗi xảy ra, vui lòng thử lại!');
        });
    }
}

</script>