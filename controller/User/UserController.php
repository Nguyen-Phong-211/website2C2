<?php
include_once('model/User.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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
    //get user by email
    public function getUserByEmailController($email)
    {
        $result = $this->user->getUserByEmail($email);
        if (!$result) {
            die("Don't reviece info user: " . $this->user->getConnection()->error);
        }
        return $result;
    }
    //get user_id by email
    public function getUserIdByEmailController($email)
    {
        $userId = $this->user->getUserIdByEmail($email);
        if ($userId === null) {
            die("No user found with email: $email");
        }
        return $userId;
    }
    //update user_name, email, number_phone, address, image
    public function updateUserController($user_id, $user_name, $email, $number_phone, $address, $image, $date_of_birth)
    {
        $result = $this->user->updateUser($user_id, $user_name, $email, $number_phone, $address, $image, $date_of_birth);
        if (!$result) {
            die("Failed to update user: " . $this->user->getConnection()->error);
        }
        else{
            return $result;
        }
    }
    //update password by user_id
    public function updatePasswordController($user_id, $password)
    {
        $result = $this->user->updatePassword($user_id, md5($password));
        if (!$result) {
            die("Failed to update password: " . $this->user->getConnection()->error);
        }
        else{
            return $result;
        }
    }
    //check role of user
    public function checkRoleController($userId)
    {
        $result = $this->user->checkRole($userId);
        if (!$result) {
            die("Failed to check role: " . $this->user->getConnection()->error);
        }
        else{
            return $result;
        }
    }
    //get infomation user by user_id
    public function getUserByIdController($user_id)
    {
        $result = $this->user->getUserById($user_id);
        if (!$result) {
            die("Failed to retrieve product list: ". $this->user->getConnection()->error);
        }
        return $result;
    }
    //get user
    public function getInfoUserSellerRegisController(){
        $result = $this->user->getInfoUserSellerRegis();
        if (!$result) {
            die("Failed to retrieve product list: ". $this->user->getConnection()->error);
        }
        return $result;
    }
}
