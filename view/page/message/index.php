<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tin nhắn</title>

    <?php include_once('view/layout/header/lib_cdn.php'); ?>
</head>

<body>
    <?php include_once('view/layout/slidebar/slidebar.php'); ?>

    <header>
        <?php include_once('view/layout/header/menu.php'); ?>
    </header>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <!-- Phần hình ảnh sản phẩm -->
                            <div class="col-md-4">
                                <?php
                                include_once('controller/Image/ImageController.php');
                                $imageController = new ImageController();
                                $idp = $_REQUEST['idp'];

                                $images = $imageController->getImageByProductIdController($idp);

                                if ($images) {
                                    echo '<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators">';
                                    $index = 0;
                                    foreach ($images as $image) {
                                        echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $index . '" class="' . ($index === 0 ? 'active' : '') . '" aria-label="Slide ' . ($index + 1) . '"></button>';
                                        $index++;
                                    }
                                    echo '</div>
                                          <div class="carousel-inner">';
                                    $index = 0;
                                    foreach ($images as $image) {
                                        echo '<div class="carousel-item ' . ($index === 0 ? 'active' : '') . '">
                                                  <img src="asset/image/product/' . htmlspecialchars($image['image_name']) . '" class="d-block w-100" alt="Product image">
                                              </div>';
                                        $index++;
                                    }
                                    echo '</div></div>';
                                }
                                ?>
                            </div>

                            <!-- Thông tin sản phẩm -->
                            <div class="col-md-8">
                                <?php
                                include_once('controller/Product/ProductController.php');
                                $productController = new ProductController();

                                $datas = $productController->getProductByIdController($idp);

                                foreach ($datas as $data) {
                                    echo '<h3>' . htmlspecialchars($data['product_name']) . '</h3>';
                                    echo '<p class="text-danger fw-bold fs-4">' . number_format($data['price'], 0, ',', '.') . ' đồng</p>';
                                    echo '<p>
                                            <i class="bi bi-clock"></i>&nbsp;' . htmlspecialchars($data['update_at']) . '
                                          </p>';
                                }

                                include_once('controller/User/UserController.php');
                                $userController = new UserController();
                                $dataUsers = $userController->getUserByProductIdController($idp);

                                foreach ($dataUsers as $dataUser) {
                                    echo '<div class="d-flex align-items-center mt-2">
                                            <img src="asset/image/user/' . htmlspecialchars($dataUser['image']) . '" class="rounded-circle" width="50" height="50" alt="' . htmlspecialchars($dataUser['user_name']) . '">
                                            <div class="ms-3">
                                                <p>' . htmlspecialchars($dataUser['user_name']) . '</p>
                                            </div>
                                          </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Phần chat -->
                <div class="card">
                    <div class="card-header bg-primary text-white">Tin nhắn</div>
                    <div class="card-body chat-box" id="chatBox" style="max-height: 400px; overflow-y: auto;">
                        <?php
                        include_once('controller/Message/MessageController.php');
                        $messageController = new MessageController();
                        $sender_id = $_SESSION['user_id'];
                        $receiver_id = $messageController->getProductOwner($idp);

                        $messages = $messageController->getMessages($sender_id, $receiver_id, $idp);


                        if (!empty($messages)) {
                            foreach ($messages as $message) {
                                $isSender = $message['sender_id'] === $sender_id;
                                echo '<div class="d-flex ' . ($isSender ? 'justify-content-end' : 'justify-content-start') . ' mb-3">
                                        <div class="' . ($isSender ? 'bg-success text-white' : 'bg-light') . ' p-2 rounded" style="max-width: 70%;">
                                            <p class="mb-0">' . htmlspecialchars($message['content']) . '</p>
                                        </div>
                                      </div>';
                            }
                        } else {
                            echo '<p class="text-muted text-center">Không có tin nhắn nào.</p>';
                        }
                        ?>
                    </div>
                    <div class="card-footer">
                        <form method="POST">
                            <div class="input-group">
                                <input type="text" class="form-control" name="message" placeholder="Nhập tin nhắn..." required>
                                <button class="btn btn-primary" type="submit">Gửi</button>
                            </div>
                        </form>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
                            $messageController->handleSendMessage();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('view/layout/footer/footer.php'); ?>
    <?php include_once('view/layout/footer/lib-cdn-js.php'); ?>
</body>

</html>
