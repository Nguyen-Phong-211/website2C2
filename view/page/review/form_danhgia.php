<?php
include_once('view/layout/header/lib_cdn.php');
?>
<style>
    .star-rating {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .star-rating i {
        font-size: 2.5rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.3s;
    }

    .star-rating i.selected {
        color: #ffc107;
    }
</style>
<div class="container mt-12">
    <div class="row">
        <div class="col-md-12">
            <form method="POST">
                <div class="mb-4">
                    <div class="star-rating" id="star-rating">
                        <i class="bi bi-star-fill" data-value="1"></i>
                        <i class="bi bi-star-fill" data-value="2"></i>
                        <i class="bi bi-star-fill" data-value="3"></i>
                        <i class="bi bi-star-fill" data-value="4"></i>
                        <i class="bi bi-star-fill" data-value="5"></i>
                    </div>
                    <input type="hidden" name="rating" id="rating-input" required>
                </div>
                <div class="mb-12">
                    <textarea class="form-control border border-primary border-3" id="review" name="review" rows="4" placeholder="Nhập nội dung đánh giá" required></textarea>
                </div>
                <input type="hidden" name="idp" value="<?= htmlspecialchars($_REQUEST['idp']); ?>">
                <br>
                <button type="submit" name="btn-up" class="btn btn-primary w-25">Gửi đánh giá</button>
                <button type="reset" class="btn btn-secondary w-25">Hủy</button>
            </form>
        </div>
    </div>
</div>
<?php
include_once('script.php');

if (isset($_POST['btn-up'])) {
    include_once("controller/Review/ReviewController.php");

    $reviewController = new ReviewController();

    // Lấy thông tin từ session và form
    $user_id = intval($_SESSION['user_id']); // Lấy user_id từ session
    $product_id = intval($_POST['idp']); // Lấy product_id từ form
    $content = trim($_POST['review']); // Lấy nội dung đánh giá
    $rating_star = intval($_POST['rating']); // Lấy số sao

    // Kiểm tra dữ liệu hợp lệ trước khi thêm vào cơ sở dữ liệu
    if ($rating_star >= 1 && $rating_star <= 5 && !empty($content)) {
        $result = $reviewController->addReviewController($user_id, $product_id, $content, $rating_star);

        if ($result) {
            echo "<script>alert('Thêm đánh giá thành công!');</script>";
            echo "<script>window.location.href='?page=detailProduct&idp=" . $product_id . "';</script>";
        } else {
            echo "<script>alert('Thêm đánh giá thất bại! Vui lòng thử lại.');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng nhập thông tin hợp lệ!');</script>";
    }
}
?>
