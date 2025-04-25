<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/autoload.php';

class EmailController
{
    function sendEmailUpdateInfo($emailAuthu, $userNameAuthu)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnUpdateInfoUser'])) {

            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'your email';
                $mail->Password = 'your password';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->CharSet = 'UTF-8';
                $mail->Encoding = 'base64';

                $mail->setFrom('your email', 'Hệ Thống');
                $mail->addAddress($emailAuthu);

                $template = file_get_contents('view/page/email/otp_updateinfo.html');
                $template = str_replace('{{ user_name }}', $userNameAuthu, $template);
                $template = str_replace('{{ otp }}', $_SESSION['otp'], $template);

                $mail->isHTML(true);
                $mail->Subject = 'Thông báo từ hệ thống';
                $mail->Body = $template;

                $mail->send();

            } catch (Exception $e) {
                echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
            }
        }
    }
    function sendEmailContactSuccess($emailAuthu, $userNameAuthu, $message)
    {
        $mail = new PHPMailer(true);

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dateTimeContact = date("d/m/Y H:i:s");

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your email';
                $mail->Password = 'your password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom('your email', 'Hệ Thống');
            $mail->addAddress($emailAuthu);

            $template = file_get_contents('view/page/email/success_contact.html');
            $template = str_replace('{{ user_name }}', $userNameAuthu, $template);
            $template = str_replace('{{ message }}', $message, $template);
            $template = str_replace('{{ dateTimeContact }}', $dateTimeContact, $template);

            $mail->isHTML(true);
            $mail->Subject = 'Thông báo từ hệ thống';
            $mail->Body = $template;

            $mail->send();

        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }
    }
    function sendEmailUpdateInfoSuccess($emailAuthu, $userNameUpdate, $emailUpdate, $dateOfBirth, $numberPhoneUpdate, $addressUpdate )
    {
        $mail = new PHPMailer(true);

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dateTimeUpdateInfo = date("d/m/Y H:i:s");

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your email';
            $mail->Password = 'your password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom('your email', 'Hệ Thống');
            $mail->addAddress($emailAuthu);

            $template = file_get_contents('view/page/email/success_updateinfo.html');
            $template = str_replace('{{ dateTimeUpdateInfo }}', $dateTimeUpdateInfo, $template);
            $template = str_replace('{{ userNameUpdate }}', $userNameUpdate, $template);
            $template = str_replace('{{ dateOfBirth }}', $dateOfBirth, $template);
            $template = str_replace('{{ emailUpdate }}', $emailUpdate, $template);
            $template = str_replace('{{ numberPhoneUpdate }}', $numberPhoneUpdate, $template);
            $template = str_replace('{{ addressUpdate }}', $addressUpdate, $template);

            $mail->isHTML(true);
            $mail->Subject = 'Thông báo từ hệ thống';
            $mail->Body = $template;

            $mail->send();

        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }
    }
    function sendEmailUpdateInfoImageSuccess($emailAuthu, $userNameUpdate, $dateOfBirth, $emailUpdate, $numberPhoneUpdate, $addressUpdate)
    {
        $mail = new PHPMailer(true);

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dateTimeUpdateInfo = date("d/m/Y H:i:s");

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your email';
            $mail->Password = 'your password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom('your email', 'Hệ Thống');
            $mail->addAddress($emailAuthu);

            $template = file_get_contents('view/page/email/success_updateinfo_image.html');
            $template = str_replace('{{ dateTimeUpdateInfo }}', $dateTimeUpdateInfo, $template);
            $template = str_replace('{{ userNameUpdate }}', $userNameUpdate, $template);
            $template = str_replace('{{ dateOfBirth }}', $dateOfBirth, $template);
            $template = str_replace('{{ emailUpdate }}', $emailUpdate, $template);
            $template = str_replace('{{ numberPhoneUpdate }}', $numberPhoneUpdate, $template);
            $template = str_replace('{{ addressUpdate }}', $addressUpdate, $template);

            $mail->isHTML(true);
            $mail->Subject = 'Thông báo từ hệ thống';
            $mail->Body = $template;

            $mail->send();

        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }
    }
    function sendEmailUpdateInfoPasswordSuccess($emailAuthu)
    {
        $mail = new PHPMailer(true);

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dateTimeUpdateInfo = date("d/m/Y H:i:s");

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your email';
            $mail->Password = 'your password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom('your email', 'Hệ Thống');
            $mail->addAddress($emailAuthu);

            $template = file_get_contents('view/page/email/success_update_password.html');
            $template = str_replace('{{ dateTimeUpdateInfo }}', $dateTimeUpdateInfo, $template);

            $mail->isHTML(true);
            $mail->Subject = 'Thông báo từ hệ thống';
            $mail->Body = $template;

            $mail->send();

        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }
    }
    function sendEmailUpdatePasswordOtp($emailAuthu)
    {
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your email';
            $mail->Password = 'your password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom('your email', 'Hệ Thống');
            $mail->addAddress($emailAuthu);

            $template = file_get_contents('view/page/email/otp_updatepassword.html');
            $template = str_replace('{{ otp }}', $_SESSION['otp'], $template);

            $mail->isHTML(true);
            $mail->Subject = 'Thông báo từ hệ thống';
            $mail->Body = $template;

            $mail->send();

        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }
    }
    function sendEmailInfoLoginGoogleSuccess($emailAuthu)
    {
        $mail = new PHPMailer(true);

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dateInfoSuccess = date("d/m/Y H:i:s");

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your email';
            $mail->Password = 'your password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom('your email', 'Hệ Thống');
            $mail->addAddress($emailAuthu);

            $template = file_get_contents('view/page/email/success_login_google.html');
            $template = str_replace('{{ dateInfoSuccess }}', $dateInfoSuccess, $template);

            $mail->isHTML(true);
            $mail->Subject = 'Thông báo từ hệ thống';
            $mail->Body = $template;

            $mail->send();

        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }
    }
    function sendReasonRefuse($emailAuthu, $content, $product_name)
    {

        $mail = new PHPMailer(true);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $dateApproval = date("d/m/Y H:i:s");

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your email';
            $mail->Password = 'your password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom('your email', 'Hệ Thống');
            $mail->addAddress($emailAuthu);

            $template = file_get_contents('view/page/email/send_reason_refuse.html');
            $template = str_replace('{{ product_name }}', $product_name, $template);
            $template = str_replace('{{ content }}', $content, $template);
            $template = str_replace('{{ dateApproval }}', $dateApproval, $template);

            $mail->isHTML(true);
            $mail->Subject = 'Thông báo từ hệ thống';
            $mail->Body = $template;

            $mail->send();

        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }
    }
}
