<?php
include_once('view/layout/header/lib_cdn.php');

?>
<style>
    .star-rating i {
        font-size: 2.5rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.3s;
    }

    .star-rating i.selected {
        color: #ffc107;
    }

    .star-rating i:hover {
        color: #ffc107;
    }
    .star-rating .star {
        font-size: 2rem;
        cursor: pointer;
        color: #f0f0f0;
        transition: color 0.3s ease;
    }

    .star-rating .star:hover,
    .star-rating .star.selected {
        color: #f39c12;
    }

    .star-rating .star.selected {
        color: #f39c12;
    }
</style>

<div class="container mt-12">
    <div class="row">
        <div class="col-md-12">
            <form method="POST">
                <div class="mb-4">
                    <div class="star-rating" id="star-rating">
                        <i class="bi bi-star-fill" data-value="1">
                            <svg xmlns="http://www.w3.org/2000/svg" data-value="1" width="25" height="25" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </i>
                        <i class="bi bi-star-fill ms-2" data-value="2">
                            <svg xmlns="http://www.w3.org/2000/svg" data-value="1" width="28" height="28" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </i>
                        <i class="bi bi-star-fill ms-2" data-value="3">
                            <svg xmlns="http://www.w3.org/2000/svg" data-value="1" width="28" height="28" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </i>
                        <i class="bi bi-star-fill ms-2" data-value="4">
                            <svg xmlns="http://www.w3.org/2000/svg" data-value="1" width="28" height="28" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </i>
                        <i class="bi bi-star-fill ms-2" data-value="5">
                            <svg xmlns="http://www.w3.org/2000/svg" data-value="1" width="28" height="28" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </i>
                    </div>
                    <input type="hidden" name="rating" id="rating-input" required>
                </div>
                <div class="mb-3">
                    <textarea class="form-control form-input-n-blur" name="review" id="exampleFormControlTextarea1" rows="3" required placeholder="Nhập nội dung đánh giá"></textarea>
                </div>
                <input type="hidden" name="idp" value="<?= htmlspecialchars($_REQUEST['idp']); ?>">
                <button type="submit" name="btn-up" class="btn btn-primary">Gửi đánh giá</button>
                <button type="reset" class="btn-cancel btn btn-danger">Huỷ bỏ</button>
            </form>
        </div>
    </div>
</div>
<?php
include_once('script.php');

if (isset($_POST['btn-up'])) {
    include_once("controller/Review/ReviewController.php");

    $reviewController = new ReviewController();

    $user_id = intval($_SESSION['user_id']);
    $product_id = intval($_POST['idp']);
    $content = trim($_POST['review']);
    $rating_star = intval($_POST['rating']);

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