<?php

require_once 'model/Product.php';

class FilterRSController
{
    public function filterByRating()
    {
        if (isset($_POST['rating'])) {
            $ratingStar = $_POST['rating'];  // Lấy giá trị số sao từ Ajax

            // Tạo đối tượng Product và gọi hàm lấy sản phẩm theo số sao
            $productModel = new Product();
            $result = $productModel->getProductByRating($ratingStar);
            
            if ($result) {
                $products = [];
                while ($row = $result->fetch_assoc()) {
                    $products[] = $row;
                }
                echo json_encode($products); // Trả về kết quả dưới dạng JSON
            } else {
                echo json_encode(['message' => 'Không có sản phẩm nào với đánh giá này.']);
            }
        }
    }
}

?>
