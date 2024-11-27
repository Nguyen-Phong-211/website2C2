<!DOCTYPE html>
<html lang="en">

<head>
    <title>Trang chủ</title>
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

    <!-- notification of whistlist is add product success -->
    <?php if (isset($_SESSION['whistlist_success_message']) && $_SESSION['whistlist_success_message'] === true): ?>

        <div class="modal fade border-color shadow-sm" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title font-monospace text-black" id="staticBackdropLabel">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#198753" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                            <small>
                                Thêm sản phẩm vào danh sách yêu thích thành công!
                            </small>
                        </p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modalElement = document.getElementById('staticBackdrop');
                const modalInstance = new bootstrap.Modal(modalElement);

                modalInstance.show();

                setTimeout(() => {
                    modalInstance.hide();
                }, 2000);
            });
        </script>

        <?php
        unset($_SESSION['whistlist_success_message']);
        ?>

    <?php endif; ?>

    <!-- Introduction -->
    <?php
    include_once('introduction.php');
    ?>
    <!-- Explore category -->
    <?php
    include_once('explore_category.php');
    ?>

    <!-- Best selling -->
    <?php
    include_once('best_selling.php');
    ?>

    <!-- Famous brands -->
    <?php
    include_once('brands.php');
    ?>

    <!-- Favorite product -->
    <?php
    include_once('favorite_product.php');
    ?>

    <?php
    include_once('image-ad.php');
    ?>

    <?php
    include_once('highly_appreciated.php');
    ?>

    <?php
    include_once('sold_out.php');
    ?>

    <section class="bg-dark">
        <div class="container-lg">
            <div class="text-light py-5">
                <div class="row justify-content-center gy-4">
                    <div class="col-12 col-sm-6 col-md-3 text-center">
                        <img src="asset/image/add/quangcao-5.png" alt="Quảng Cáo 5" class="img-fluid shadow rounded">
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 text-center">
                        <img src="asset/image/add/quangcao-6.png" alt="Quảng Cáo 6" class="img-fluid shadow rounded">
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 text-center">
                        <img src="asset/image/add/quangcao-7.png" alt="Quảng Cáo 7" class="img-fluid shadow rounded">
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 text-center">
                        <img src="asset/image/add/quangcao-8.png" alt="Quảng Cáo 8" class="img-fluid shadow rounded">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5">
        <div class="container-lg">
            <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-5">
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                                <path d="M4 11H2v3h2zm5-4H7v7h2zm5-5v12h-2V2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1z" />
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>Chất lượng sản phẩm</h5>
                            <p class="card-text">
                                Các sản phẩm bán trên website luôn đạt tiêu chuẩn chất lượng cao cấp.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484q-.121.12-.242.234c-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z" />
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>Độ tin cậy và minh bạch</h5>
                            <p class="card-text">
                                Cung cấp thông tin sản phẩm rõ ràng, đảm bảo uy tín và sự minh bạch.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-emoji-wink" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m1.757-.437a.5.5 0 0 1 .68.194.93.93 0 0 0 .813.493c.339 0 .645-.19.813-.493a.5.5 0 1 1 .874.486A1.93 1.93 0 0 1 10.25 7.75c-.73 0-1.356-.412-1.687-1.007a.5.5 0 0 1 .194-.68" />
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>Trải nghiệm người dùng</h5>
                            <p class="card-text">
                                Thiết kế website thân thiện, dễ sử dụng, tối ưu hóa cho thiết bị di động.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-badge-ad" viewBox="0 0 16 16">
                                <path d="m3.7 11 .47-1.542h2.004L6.644 11h1.261L5.901 5.001H4.513L2.5 11zm1.503-4.852.734 2.426H4.416l.734-2.426zm4.759.128c-1.059 0-1.753.765-1.753 2.043v.695c0 1.279.685 2.043 1.74 2.043.677 0 1.222-.33 1.367-.804h.057V11h1.138V4.685h-1.16v2.36h-.053c-.18-.475-.68-.77-1.336-.77zm.387.923c.58 0 1.002.44 1.002 1.138v.602c0 .76-.396 1.2-.984 1.2-.598 0-.972-.449-.972-1.248v-.453c0-.795.37-1.24.954-1.24z" />
                                <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z" />
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>Chiến lược truyền thông</h5>
                            <p class="card-text">
                                Nội dung hấp dẫn, tương tác thường xuyên, gắn kết với thương hiệu hiệu quả.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-3 border border-dark-subtle p-3">
                        <div class="text-dark mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-file-arrow-up" viewBox="0 0 16 16">
                                <path d="M8 11a.5.5 0 0 0 .5-.5V6.707l1.146 1.147a.5.5 0 0 0 .708-.708l-2-2a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L7.5 6.707V10.5a.5.5 0 0 0 .5.5" />
                                <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1" />
                            </svg>
                        </div>
                        <div class="card-body p-0">
                            <h5>Giá trị bền vững</h5>
                            <p class="card-text">
                                Nhấn mạnh lợi ích mua sắm đồ cũ, tiết kiệm chi phí và môi trường.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include_once('view/layout/header/button_backtotop.php');
    ?>

    <?php
    include_once('view/layout/footer/footer.php');
    ?>


    <?php
    include_once('view/layout/footer/lib-cdn-js.php');
    ?>

</body>

</html>