<?php
include_once('model/Review.php');

class ReviewController
{
    private $reviewModel;
    public function __construct()
    {
        $this->reviewModel = new Review();
    }
     //count review by user_id
    public function countReviewRoleBuyerController($userId)
    {
        try {
            $result = $this->reviewModel->countReviewRoleBuyer($userId);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    
        return $result;
    }  
    //count review by role_seller_id
    public function countReviewRoleSellerController($userId)
    {
        try {
            $result = $this->reviewModel->countReviewRoleSeller($userId);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    
        return $result;
    }       
    //get review by product_id
    public function getReviewByProductIdController($productId)
    {
        $result = $this->reviewModel->getReviewByProductId($productId);

        if (!$result) {
            die("Failed to retrieve product list: " . $this->reviewModel->getConnection()->error);
        }
        return $result;
    }
    //count review by product_id
    public function countReviewByProductIdController($productId)
    {
        return $this->reviewModel->countReviewByProductId($productId);
    }
    //get all review by user_id, role_id and product_id
    public function getAllReviewByRoleBuyerController($userId)
    {

        try {
            $result = $this->reviewModel->getAllReviewByRoleBuyer($userId);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    
        return $result;
    }
    //get all review by user_id, role_seller_id and product_id
    public function getAllReviewByRoleSellerController($userId)
    {

        try {
            $result = $this->reviewModel->getAllReviewByRoleSeller($userId);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    
        return $result;
    }
}
?>

