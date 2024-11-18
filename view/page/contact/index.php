<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sản phẩm yêu thích</title>

    <?php
    include_once('view/layout/header/lib_cdn.php');
    ?>

</head>

<body>

    <div class="preloader-wrapper">
        <div class="preloader">
        </div>
    </div>

    <?php 
    include_once('view/layout/slidebar/slidebar.php');
    ?>

    

    <header>
        <?php
        include_once('view/layout/header/menu.php');
        ?>
    </header>

    <?php
    include_once('view/layout/slider/slider.php');
    ?>

    <?php
    include_once('view/layout/pagination/index.php');
    ?>

    <section class="container pb-4 my-4 text-black">
        <div class="container mt-5 card p-4 shadow-sm contact-form">

            <h1 class="text-center text-label-contact">Liên hệ với chúng tôi</h1>
            <form id="contact_form" name="contact_form" method="post" class="">
                <div class="mb-4">
                    <label for="first_name" class="form-label">Họ và tên</label>
                    <input type="text" required maxlength="50" class="form-control input-form-contact border-color" id="first_name" name="first_name" placeholder="Nhập họ và tên của bạn">
                </div>
                <div class="mb-4 row">
                    <div class="col">
                        <label for="email_addr" class="form-label">Địa chỉ Email</label>
                        <input type="email" required maxlength="50" class="form-control input-form-contact border-color" id="email_addr" name="email" placeholder="name@example.com">
                    </div>
                    <div class="col">
                        <label for="phone_input" class="form-label">Số điện thoại</label>
                        <input type="tel" required maxlength="50" class="form-control input-form-contact border-color" id="phone_input" name="phone" placeholder="Số điện thoại">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="message" class="form-label">Tin nhắn</label>
                    <textarea class="form-control input-form-contact border-color" id="message" name="message" rows="5" placeholder="Nhập tin nhắn của bạn"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100 btn-form-contact active">Gửi</button>
            </form>

        </div>
    </section>

    <style>

    </style>



    <?php
    include_once('view/layout/footer/footer.php');
    ?>

    <?php
    include_once('view/layout/footer/lib-cdn-js.php');
    ?>
</body>

</html>