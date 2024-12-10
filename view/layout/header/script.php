<script>
    function checkLogin(event) {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        <?php if (!isset($_SESSION["user_id"])) { ?>
            event.preventDefault(); 
            alert("Bạn cần đăng nhập để xem giỏ hàng.");
        <?php } ?>
    }
</script>