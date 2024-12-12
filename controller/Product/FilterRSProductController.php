<?php

include_once(__DIR__.'/../../model/Product.php');

class FilterRSController
{
    private $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    public function filterByRating()
{

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ratingStar'])) {

        $ratingStar = intval($_POST['ratingStar']);
        
        if ($ratingStar < 1 || $ratingStar > 5) {
            echo json_encode(['error' => 'Giá trị rating sao không hợp lệ']);
            exit;
        }

        $products = $this->product->getProductByRating($ratingStar);


        if ($products !== false) {
            $productData = [];
            while ($row = $products->fetch_assoc()) {
                $productData[] = [
                    'product_id' => $row['product_id'],
                    'product_name' => $row['product_name'],
                    'quantity' => $row['quantity'],
                    'price' => $row['price'],
                    'status' => $row['status'],
                    'discount' => $row['discount'],
                    'description' => $row['description'],
                    'address' => $row['address'],
                    'whistlist_id' => $row['whistlist_id'],
                    'image_name' => $row['image_name'],
                    'rating_star' => $row['rating_star'],
                    'review_status' => $row['review_status'],
                ];
            }

            if (empty($productData)) {
                error_log('Không tìm thấy sản phẩm nào với rating sao: ' . $ratingStar); // Ghi log nếu không có sản phẩm
                echo json_encode(['error' => 'Không có sản phẩm nào']);
            } else {
                // Trả về dữ liệu sản phẩm dưới dạng JSON
                echo json_encode($productData);
            }
        } else {
            // Nếu truy vấn không thành công (sản phẩm không tìm thấy)
            echo json_encode(['error' => 'Không có sản phẩm nào']);
        }

    } else {
        // Nếu không có 'ratingStar' trong POST request
        echo json_encode(['error' => 'Thiếu thông tin ratingStar']);
    }

    exit;
}

}
