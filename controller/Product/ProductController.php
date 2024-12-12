<?php
include_once('model/Product.php');

class ProductController
{
    private $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    //get all product
    public function getAllProductController()
    {
        $result = $this->product->getAllProduct();

        if (!$result) {
            die("Failed to retrieve category list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    //join reviews
    public function getAllProductWithReviewsController()
    {
        $result = $this->product->getAllProductWithReviews();

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    public function getAllFavoriteProductController()
    {
        $result = $this->product->getAllFavoriteProduct();

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    //get product by hight view
    public function getProductByHightViewController()
    {
        $result = $this->product->getProductByHightView();

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    //cout product
    public function countProductController()
    {
        $result = $this->product->countProduct();

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    //get product_name by id
    public function getNameProductByIdController($id)
    {
        $result = $this->product->getNameProductById($id);

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    //get product by id
    public function getProductByIdController($id)
    {
        $result = $this->product->getProductById($id);

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    //get product by category_id
    public function getProductByCategoryIdController($categoryId)
    {
        $result = $this->product->getProductByCategory($categoryId);

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    //get product hightly appreciated
    public function getProductHightlyAppreciatedController()
    {
        $result = $this->product->getProductHightlyAppreciated();

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    //get product sell out
    public function getProductSellOutController()
    {
        $result = $this->product->getProductSellOut();

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    //find product by price
    public function findProductByPriceController($priceFrom, $priceTo)
    {
        $result = $this->product->findProductByPrice($priceFrom, $priceTo);

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    //get product by category_item_id
    public function getProductByCategoryItemController($categoryId, $categoryItemId)
    {
        $result = $this->product->getProductByCategoryItem($categoryId, $categoryItemId);

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    //Search
    public function searchProductController($keyword)
    {
        $result = $this->product->searchProduct($keyword);

        if (!$result) {
            die("Failed to retrieve search results: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    // count search
    // public function countProductsController($keyword)
    // {
    //     return $this->product->countProducts($keyword);
    // }

    //get product by rating_star
    // public function getProductByRatingStarController($ratingStar)
    // {
    //     $result = $this->product->getProductByRating($ratingStar);

    //     if (!$result) {
    //         echo json_encode(['status' => 'error', 'message' => 'Không có sản phẩm']);
    //         die("Failed to retrieve product list: ". $this->product->getConnection()->error);
    //     }
    //     $products = [];
    //     while ($row = $result->fetch_assoc()) {
    //         $products[] = $row;
    //     }
    //     echo json_encode(['status' => 'success', 'data' => $products]);
    //     exit;
    // }
    public function getProductByRatingStarController()
    {
        if (isset($_GET['action']) && $_GET['action'] === 'getProductByRatingStar') {
            $ratingStar = isset($_GET['ratingStar']) ? (int)$_GET['ratingStar'] : 0;

            if ($ratingStar < 1 || $ratingStar > 5) {
                echo json_encode(['status' => 'error', 'message' => 'Số sao không hợp lệ']);
                exit;
            }

            $result = $this->product->getProductByRating($ratingStar);

            if (!$result) {
                echo json_encode(['status' => 'error', 'message' => 'Không có sản phẩm']);
                exit;
            }

            $products = [];
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }

            echo json_encode(['status' => 'success', 'data' => $products]);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Hành động không hợp lệ']);
            exit;
        }
    }
    //update view product_id
    public function updateViewProductController($productId)
    {
        $result = $this->product->updateViewCount($productId);

        if (!$result) {
            die("Failed to retrieve search results: " . $this->product->getConnection()->error);
        }
        return true;
    }
    //get discount by product_id
    public function getDiscountByProductIdController($productId)
    {
        $result = $this->product->getDiscountByProductId($productId);

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    ////get all product by user_id
    public function getAllProductByUserIdController($userId)
    {
        $result = $this->product->getAllProductByUserId($userId);

        if (!$result) {
            die("Failed to retrieve product list: " . $this->product->getConnection()->error);
        }
        return $result;
    }
    //update product by product_id
    public function updateProductController()
    {
        if (isset($_POST['btnManagementProduct'])) {
            $product_id = $_POST['productId'];
            $product_name = $_POST['productName'];
            $quantity = $_POST['quantity'];
            $product_price = $_POST['price'];
            $product_description = $_POST['description'];
            $address = $_POST['address'];

            $imagePaths = $_FILES['productImages']['name'];

            // Kiểm tra và xử lý hình ảnh
            if (!empty($imagePaths[0])) {
                $newImagePaths = [];

                foreach ($_FILES['productImages']['name'] as $index => $imageName) {
                    $imageTmpName = $_FILES['productImages']['tmp_name'][$index];
                    $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    if (!in_array($imageExtension, $allowedExtensions)) {
                        echo '
                        <script>
                            alert("Chỉ chấp nhận các tệp ảnh jpg, jpeg, png, gif.");
                            window.location.href = "index.php?page=managerProduct";
                        </script>';
                        return;
                    }

                    $newImageName = uniqid('product_', true) . '.' . $imageExtension;

                    if (move_uploaded_file($imageTmpName, 'asset/image/product/' . $newImageName)) {
                        $newImagePaths[] = $newImageName;
                    } else {
                        echo '
                        <script>
                            alert("Lỗi khi tải lên ảnh.");
                            window.location.href = "index.php?page=managerProduct";
                        </script>';
                        return;
                    }
                }

                $result = $this->product->updateProduct($product_id, $product_name, $product_price, $product_description, $address, $quantity, $newImagePaths);
            } else {
                $result = $this->product->updateProduct($product_id, $product_name, $product_price, $product_description, $address, $quantity);
            }

            echo '<script>
                alert("' . $result . '");
                window.location.href = "index.php?page=managerProduct";
            </script>';
        } else {
            echo '<script>
            alert("Cập nhật thất bại. Vui lòng kiểm tra lại!");
            window.location.href = "index.php?page=managerProduct";
        </script>';
            die("Failed to update product: " . $this->product->getConnection()->error);
        }
    }
}
