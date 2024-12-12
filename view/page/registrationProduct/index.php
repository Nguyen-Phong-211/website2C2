<?php

use GuzzleHttp\Psr7\Request;

$selectedCategory = isset($_POST['category']) ? $_POST['category'] : '';
$selectedSubCategory = isset($_POST['subcategory']) ? $_POST['subcategory'] : '';
$showError = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($selectedSubCategory)) {
        $showError = true;
    }
}
?>
<?php
if ((!isset($_SESSION['success_message']) && !isset($_SESSION['email'])) || (!isset($_SESSION['emailUserLoginGoogle']) && !isset($_SESSION['success_message']))) {
    header('Location: index.php?page=login');
    $_SESSION['info_login'] = "Thông báo đăng nhập.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng tin sản phẩm bán</title>

    <?php
    include_once('view/layout/header/lib_cdn.php');
    ?>

</head>


<body>

    <?php
    include_once('view/layout/slidebar/slidebar.php');
    ?>

    <header>
        <?php
        include_once('view/layout/header/menu.php');
        ?>
    </header>

    <?php
    include_once('view/layout/pagination/index.php');
    ?>
    <section class="container pb-4 my-4 text-black">
        <div class="container mt-5 shadow-sm rounded p-4">
            <header>
                <h1 class="text-center">Đăng tin bán sản phẩm</h1>
            </header>

            <main class="mt-4">

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <?php
                                include_once("controller/Category/CategoryController.php");
                                $p = new CategoryController();
                                $tbl = $p->getCategoryList();
                                ?>
                                <label for="category" class="form-label">Danh mục cấp 1 <span class="text-danger">*</span></label>
                                <select class="form-select border-color" id="category" name="category" required onchange="this.form.submit()">
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                    if ($tbl) {
                                        while ($r = mysqli_fetch_assoc($tbl)) {
                                            $selected = isset($selectedCategory) && $selectedCategory == $r["category_id"] ? 'selected' : '';
                                            echo "<option value='" . $r["category_id"] . "' $selected>" . $r["category_name"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>

                            </div>

                            <div class="mb-3" id="subcategoryContainer" style="display: <?php echo $selectedCategory ? 'block' : 'none'; ?>">

                                <?php if (!empty($selectedCategory)) : ?>
                                    <div>
                                        <?php
                                        include_once("controller/CategoryItem/CategoryItemController.php");
                                        $categoryItemController = new CategoryItemController();
                                        $subcategories = $categoryItemController->getAllListCategoryItemByCategoryController($selectedCategory);

                                        if ($subcategories) {
                                            echo '<label for="subcategory" class="form-label">Danh mục cấp 2 <span class="text-danger">*</span></label>';
                                            echo '<select class="form-select border-color" id="subcategory" name="subcategory" onchange="this.form.submit()">';
                                            echo '<option value="">Chọn danh mục cấp 2</option>';

                                            while ($subcategory = mysqli_fetch_assoc($subcategories)) {
                                                if ($subcategory['category_id'] == $selectedCategory) {
                                                    $selected = ($subcategory['category_item_id'] == $selectedSubCategory) ? 'selected' : '';
                                                    echo "<option value='{$subcategory['category_item_id']}' $selected>{$subcategory['category_item_name']}</option>";
                                                }
                                            }
                                            echo '</select>';
                                        } else {
                                            echo '<p>Không có danh mục cấp 2 nào.</p>';
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh và Video sản phẩm <span class="text-danger">*</span></label>

                                <input type="file" class="form-control border-color" name="imageUpload[]" accept="image/*" multiple onchange="previewImagesProduct(this)">
                                <small class="form-text text-muted">Chọn từ 1 đến 6 hình ảnh.</small>
                                <div class="image-preview" id="imagePreview"></div>

                                <script>
                                    function previewImagesProduct(input) {
                                        const imagePreview = document.getElementById('imagePreview');
                                        imagePreview.innerHTML = '';
                                        const files = input.files;

                                        if (files.length > 6) {
                                            alert('Bạn chỉ có thể chọn tối đa 6 hình ảnh.');
                                            input.value = '';
                                            return;
                                        }

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];

                                            if (!file.type.startsWith('image/')) {
                                                alert('Chỉ được phép tải lên tệp hình ảnh.');
                                                continue;
                                            }

                                            const reader = new FileReader();
                                            reader.onload = function(e) {
                                                const img = document.createElement('img');
                                                img.src = e.target.result;
                                                img.classList.add('img-thumbnail', 'me-2');
                                                img.style.width = '100px';
                                                img.style.height = 'auto';
                                                imagePreview.appendChild(img);
                                            };
                                            reader.readAsDataURL(file);
                                        }
                                    }
                                </script>
                            </div>
                            <?php
                            include_once('script.php');
                            ?>
                        </div>
                        <div class="col" id="productFields" style="display: 
                            <?php
                            echo !empty($selectedSubCategory) ? 'block' : 'none';
                            ?>">
                            <?php
                            if ($selectedCategory == 1) {
                                if ($selectedSubCategory == 6) {
                                    $_SESSION["name"] = 'Loại xe';
                                } elseif ($selectedSubCategory == 8) {
                                    $_SESSION["name"] = 'Phụ kiện và thiết bị';
                                } else {
                                    $_SESSION["name"] = 'Hãng xe';
                                }
                            } elseif ($selectedCategory == 4) {
                                if ($selectedSubCategory == 33) {
                                    $_SESSION["name"] = 'Loại dụng cụ';
                                } elseif ($selectedSubCategory == 35) {
                                    $_SESSION["name"] = 'Loại thiết bị';
                                }
                            } elseif ($selectedCategory == 5) {
                                if ($selectedSubCategory == 36) {
                                    $_SESSION["name"] = 'Loại quần áo';
                                } elseif ($selectedSubCategory == 37) {
                                    $_SESSION["name"] = 'Loại giày dép';
                                } else {
                                    $_SESSION["name"] = 'Loại phụ kiện';
                                }
                            } elseif ($selectedCategory == 6) {
                                $_SESSION["name"] = 'Loại dụng cụ';
                            } elseif ($selectedCategory == 7) {
                                $_SESSION["name"] = 'Loại sách';
                            } elseif ($selectedCategory == 8) {
                                $_SESSION["name"] = 'Loại nội thất';
                            } else {
                                $_SESSION["name"] = 'Thương hiệu';
                            }
                            include_once("company.php");
                            include_once("attribute.php");
                            include_once("status.php");
                            include_once("WarrantyPolicies.php");
                            include_once("thongtin.php");

                            ?>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <button type="reset" class="btn btn-outline-danger w-100">Huỷ bỏ</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary w-100 active" name="btn-upload">Đăng tin</button>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </section>
    <?php
    if (isset($_POST['btn-upload'])) {
        include_once("controller/RegistrationProduct/RegistrationProductController.php");
        $controller = new RegistrationProductController();
        $controller->addRegistrationProduct();
    }
    ?>
    <?php
    include_once('view/layout/footer/footer.php');
    ?>

    <?php
    include_once('view/layout/footer/lib-cdn-js.php');
    ?>

</body>

</html>