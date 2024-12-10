<?php
include_once('model/Login.php');
include_once('model/User.php');

class LoginController
{
    private $loginModel;
    private $userModel;

    public function __construct()
    {
        $this->loginModel = new Login();
        $this->userModel = new User();
    }

    public function loginUserController($email, $password)
    {
        $result = $this->loginModel->loginUser($email, $password);

        if ($result) {

            $_SESSION['email'] = $result['email'];
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['role_id'] = $result['role_id'];

            $_SESSION['success_message'] = "Đăng nhập thành công!";

            sleep(3);
            header("Location: index.php?page=home");
            
            exit;
        } else {

            $_SESSION['error_message'] = "Email hoặc mật khẩu không đúng";
            header("Location: index.php?page=login"); 
            exit;
        }
    }
    //get user_name
    public function getUserNameController($email){
        $result = $this->loginModel->getUserName($email);
        return $result;
    }
}
