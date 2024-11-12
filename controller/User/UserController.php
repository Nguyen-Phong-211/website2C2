<?php
include_once('model/User.php');

class UserController
{

    private $user;
    public function __construct()
    {
        $this->user = new User();
    }
    //count user
    public function countUserController()
    {
        $result = $this->user->countUser();
        if (!$result) {
            die("Failed to retrieve product list: " . $this->user->getConnection()->error);
        }
        return $result;
    }
    //count role seller 
    public function countRoleSellerController()
    {
        $result = $this->user->countRoleSeller();
        if (!$result) {
            die("Failed to retrieve product list: " . $this->user->getConnection()->error);
        }
        return $result;
    }
    //get user by product_id
    public function getUserByProductIdController($productId)
    {
        $result = $this->user->getUserbyProduct($productId);
        if (!$result) {
            die("Failed to retrieve product list: " . $this->user->getConnection()->error);
        }
        return $result;
    }
}
