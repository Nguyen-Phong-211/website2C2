<section class="py-5 overflow-hidden">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-12">

                <div
                    class="section-header d-flex flex-wrap justify-content-between mb-5">
                    <h2 class="section-title">Khám phá danh mục</h2>

                    <div class="d-flex align-items-center">
                        <a href="#" class="btn btn-primary me-2">Xem tất cả</a>
                        <div class="swiper-buttons">
                            <button
                                class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                            <button
                                class="swiper-next category-carousel-next btn btn-yellow">❯</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="category-carousel swiper"> <!-- id="brand-category-carousel" -->
                    <div class="swiper-wrapper">

                        <?php
                            $logoDir = 'asset/image/logo';

                            $logosToShow = ['logo-apple.png', 'logo-canon.png', 'logo-dell.jpg', 'logo-honda.jpg', 'logo-mes.jpg', 'logo-panasonic.png', 'logo-samsung.png', 'logo-sym.jpg', 'logo-thongnhat.png', 'logo-toshiba.png', 'logo-vinfast.jpg', 'logo-xiaomi.png']; // Thay đổi tên file theo nhu cầu

                            foreach ($logosToShow as $logo) {

                                if (file_exists($logoDir . '/' . $logo)) {

                                    echo '<a href="#" class="nav-link swiper-slide text-center">';
                                    echo '<img src="' . $logoDir . '/' . $logo . '" class="img-fluid" alt="Logo ' . basename($logo, '.png') . '">';
                                    echo '</a>';
                                } else {
                                    echo 'Logo ' . htmlspecialchars($logo) . ' không tồn tại.<br>';
                                }
                            }
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>