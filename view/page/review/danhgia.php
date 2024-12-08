<style>
    .star-rating {
        color: #ffc107;
    }

    .star-rating .bi {
        font-size: 1.5rem;
    }

    #danhgia ul {
        list-style-type: none;
        padding: 0;
    }

    #danhgia ul li {
        border: 1px solid #ddd;
        margin: 10px 0;
        padding: 15px;
        border-radius: 5px;
    }

    #danhgia ul li p {
        margin: 10px 0;
    }

    #danhgia ul li .text-muted {
        font-size: 0.875rem;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            include_once("controller/Review/ReviewController.php");
            if (isset($_GET['idp'])) {
                $id_san_pham = intval($_GET['idp']);
                $controller = new ReviewController();
                $result = $controller->getAllReviewByProductIdController($id_san_pham);

                if ($result && mysqli_num_rows($result) > 0) {
                    // Nếu có đánh giá
                    echo "<div id='danhgia'>";
                    echo "<ul>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li>";
                        $ten_goc = htmlspecialchars($row["user_name"]);
                        $do_dai_ten = mb_strlen($ten_goc, 'UTF-8');
                        $phan_hien = ceil($do_dai_ten / 2.5);
                        $ten_hien = mb_substr($ten_goc, 0, $phan_hien, 'UTF-8');
                        $ten_ngoisaos = str_repeat('*', $do_dai_ten - $phan_hien);

                        echo "<strong>" . $ten_hien . $ten_ngoisaos . "</strong>: ";

                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $row["rating_star"]) {
                                echo "<i class='bi bi-star-fill' style='color: #ffc107;'></i>";
                            } else {
                                echo "<i class='bi bi-star' style='color: #ccc;'></i>";
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