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
    public function getProductByRatingStarController() {
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
            die("Failed to retrieve product list: ". $this->product->getConnection()->error);
        }
        return $result;
    }
}
