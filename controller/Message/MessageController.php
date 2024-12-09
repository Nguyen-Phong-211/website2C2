<?php
include_once('model/Message.php');
include_once('model/Product.php');

class MessageController
{
    private $messageModel;
    private $productModel;

    public function __construct()
    {
        $this->messageModel = new Message();
        $this->productModel = new Product();
    }

    // Lấy ID người đăng sản phẩm
    public function getProductOwner($product_id)
    {
        return $this->productModel->getOwnerByProductId($product_id);
    }

    // Lấy tin nhắn giữa hai người dùng
    public function getMessages($sender_id, $receiver_id, $product_id)
{
    return $this->messageModel->getMessages($sender_id, $receiver_id, $product_id);
}


    // Gửi tin nhắn
    public function sendMessage($sender_id, $receiver_id, $content, $product_id)
    {
        return $this->messageModel->sendMessage($sender_id, $receiver_id, $content, $product_id);
    }
    

    // Xử lý gửi tin nhắn
    public function handleSendMessage()
{
    if (isset($_POST['message']) && !empty($_POST['message'])) {
        $sender_id = $_SESSION['user_id']; // ID người gửi
        $product_id = $_REQUEST['idp'];    // ID sản phẩm
        $receiver_id = $this->getProductOwner($product_id); // Lấy ID người nhận

        if ($receiver_id) {
            // Nếu là lần đầu tiên, gửi tin nhắn tự động
            $messages = $this->getMessages($sender_id, $receiver_id, $product_id);
            if (empty($messages)) {
                $this->sendMessage($receiver_id, $sender_id, "Đây là tin nhắn tự động, người bán sẽ trả lời bạn sớm nhất!", $product_id);
            }
            // Gửi tin nhắn từ người mua
            $this->sendMessage($sender_id, $receiver_id, $_POST['message'], $product_id);
        } else {
            die("Không tìm thấy người đăng sản phẩm!");
        }
    }
}

}
?>
