<?php
require_once('vendor/autoload.php');
include_once('model/LoginGoogle.php');
include_once('model/User.php');

ob_start();
class GoogleLoginController
{
    private $client;
    private $userModel;

    public function __construct()
    {

        $this->client = new Google\Client();
        $this->client->setClientId('92732100425-grt9ful5s2tt1i3300cqauteihrjee93.apps.googleusercontent.com');
        $this->client->setClientSecret('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');
        $this->client->setRedirectUri('http://localhost/php/projectfinal');
        $this->client->addScope("email");
        $this->client->addScope("profile");

        $this->userModel = new User();
    }

    public function getAuthUrl()
    {
        return $this->client->createAuthUrl();
    }
    public function handleCallback()
    {
        if (isset($_GET['code'])) {

            $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            $this->client->setAccessToken($token["access_token"]);

            $aothu = new Google\Service\Oauth2($this->client);
            $userinfo = $aothu->userinfo->get();

            $email =  $userinfo->email;
            $name =  $userinfo->name;
            $avatar = $userinfo->picture;

            $loginGoogle = new LoginGoogle();

            if($loginGoogle->checkEmail($email) != $email){

                $fileName = uniqid('avatar_', true) . '.jpg';
                $filePath = 'asset/image/user/' . $fileName; 

                $fileImage = file_get_contents($avatar);
                file_put_contents($filePath, $fileImage);

                $password = md5(uniqid('password_', true));

                $addUserLogin = $loginGoogle->addUserSignupGoogle($name, $email, $password);

                $updateAvatar = $loginGoogle->updateAvatar($email, $fileName);

                if ($addUserLogin == true && $updateAvatar == true) {
                    $userId = $this->userModel->getUserIdByEmail($email);
                    $_SESSION['success_message'] = "Đăng nhập thành công!";
                    $_SESSION['emailUserLoginGoogle'] = $email;
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['role_seller_id'] = $this->userModel->checkRole($userId);
                    return true;
                } else {
                    header("Location: index.php?page=login");
                    $_SESSION['error_message'] = "Đăng nhập thất bại!";
                    return false;
                }
            }else{
                $userId = $this->userModel->getUserIdByEmail($email);
                $_SESSION['success_message'] = "Đăng nhập thành công!";
                $_SESSION['emailUserLoginGoogle'] = $email;
                $_SESSION['user_id'] =  $userId;
                $_SESSION['role_seller_id'] = $this->userModel->checkRole($userId);
                return true;
            }
        } else {
            return false;
        }
    }
}
