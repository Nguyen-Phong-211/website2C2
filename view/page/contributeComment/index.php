<?php 
    if((!isset($_SESSION['success_message']) && !isset($_SESSION['email'])) || (!isset($_SESSION['emailUserLoginGoogle']) && !isset($_SESSION['success_message']))){
        header('Location: index.php?page=login');
        $_SESSION['info_login'] = "Thông báo đăng nhập.";
    }
?>