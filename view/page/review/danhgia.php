<div class="container mt-5">
    <h5 class="fw-semibold">Các đánh giá của khách hàng</h5>
    <div class="row">
        <div class="col-md-12">
            <?php
            include_once("controller/Review/ReviewController.php");
            if (isset($_GET['idp'])) {
                $id_san_pham = intval($_GET['idp']);
                $controller = new ReviewController();
                $result = $controller->getAllReviewByProductIdController($id_san_pham);

                if ($result && mysqli_num_rows($result) > 0) {
                    echo "<div id='danhgia' class='mt-4'>";
                    echo "<ul class='list-unstyled'>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li class='rounded-3 mb-3 p-3 border-color'>";
                        $ten_goc = htmlspecialchars($row["user_name"]);
                        $do_dai_ten = mb_strlen($ten_goc, 'UTF-8');
                        $phan_hien = ceil($do_dai_ten / 2.5);
                        $ten_hien = mb_substr($ten_goc, 0, $phan_hien, 'UTF-8');
                        $ten_ngoisaos = str_repeat('*', $do_dai_ten - $phan_hien);

                        echo "<strong>" . $ten_hien . $ten_ngoisaos . "</strong>: ";

                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $row["rating_star"]) {
                                echo '
                                <i class="bi bi-star-fill" style="color: #ffc107;">
                                    <svg xmlns="http://www.w3.org/2000/svg" data-value="1" width="25" height="25" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                                </i>';
                            } else {
                                echo '
                                <i class="bi bi-star" style="color: #ccc;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                    </svg>
                                </i>';
                            }
                        }

                        echo "<p>" . htmlspecialchars($row["content"]) . "</p>";
                        echo "<small class='text-muted'>Ngày đánh giá: " . date("d/m/Y", strtotime($row["create_at"])) . "</small>";
                        echo "</li>";
                    }

                    echo "</ul>";
                    echo "</div>";
                } else {
                    // Nếu không có đánh giá
                    echo "<p>KHÔNG CÓ ĐÁNH GIÁ.</p>";
                }
            } else {
                // Nếu không có sản phẩm được chọn
                echo "<p>Vui lòng chọn sản phẩm để xem đánh giá.</p>";
            }
            ?>
        </div>
    </div>
</div>
</div>
</body>

</html>