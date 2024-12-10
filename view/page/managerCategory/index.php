
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý danh mục</title>
    <?php
    include_once('view/layout/header/lib_cdn.php');
    ?>
</head>

<body>
    <?php
    include_once('controller/Category/CategoryController.php');
    $categoryController = new CategoryController();
    $categories = $categoryController->getCategoryList(); 
    ?>
    <?php
   if (isset($_SESSION['message'])) {
    $message = htmlspecialchars($_SESSION['message']);
    unset($_SESSION['message']);
   }
    ?>
<div class="container mt-4">
    <h3>Quản lý danh mục</h3>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        Thêm danh mục
    </button>
    <!-- Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Thêm Danh Mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" action="index.php?page=managerCategory&action=add" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên danh mục: <span class="text-danger"> * </span></label>
                            <input type="text" name="category_name" id="category_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh (không bắt buộc):</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <button type="button" class="btn btn-secondary mx-2 mt-2" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary mx-2 mt-2">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
               <strong><th>STT</th></strong> 
               <strong><th>Tên danh mục</th></strong> 
               <strong> <th>Hình ảnh</th></strong> 
               <strong> <th>Hành động</th></strong>
               <strong> <th style="padding-left: 40px;">Quản lý</th></strong>
            </tr>
        </thead>
        <tbody>
            <?php
             $stt = 1; 
            foreach ($categories as $category): 
                $categoryImage = $category['image'];?>
                <tr>
                    <td><a href="index.php?page=managerCategoryItem&category_id=<?php echo $category['category_id']; ?>" 
                    style="text-decoration: none;"><?php echo $stt++; ?></a> </td>
                    <td><a href="index.php?page=managerCategoryItem&category_id=<?php echo $category['category_id']; ?>" 
                    style="text-decoration: none;"><?php echo $category['category_name']; ?></a></td>  
                    <td>
                        <img src="asset/image/category/<?= htmlspecialchars($categoryImage); ?>" alt="Hình ảnh danh mục"
                        style="width: 70px; height: 60px;">
                        </td>
                        <td>
                        <button type="button" class="btn btn-secondary edit-button"
                        data-id="<?php echo $category['category_id']; ?>" 
                        data-name="<?php echo $category['category_name']; ?>" 
                        data-image="<?php echo htmlspecialchars($category['image']); ?>" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editCategoryModal">
                            Sửa
                        </button>
                        <a href="index.php?page=managerCategory&action=delete&id=<?php echo $category['category_id']; ?>" class="btn btn-danger mx-2" 
                        onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">Xóa</a>
                        </td>
                        <td>
                        <a href="index.php?page=managerCategoryAttribute&category_id=<?php echo $category['category_id']; ?>" 
                        class="btn btn-primary mx-2" > Quản lý thuộc tính</a>
                        </td>
                </tr>
                <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="editCategoryForm" action="index.php?page=managerCategory&action=edit&id=<?php echo $category['category_id']; ?>" 
                        method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h4 class="modal-title" id="editCategoryModalLabel">Sửa danh mục</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="category_id" id="categoryId">
                                <div class="form-group mb-3">
                                    <label for="category_name">Tên danh mục<span class="text-danger"> * </span></label>
                                    <input type="text" class="form-control" name="category_name" id="categoryName" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="image">Hình ảnh (không bắt buộc)</label>
                                    <input type="file" class="form-control-file" name="image">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Hình ảnh hiện tại:</label>
                                    <div>
                                        <img id="currentImage" src="" alt="Hình ảnh cũ"
                                         style="max-width: 100px; display: block; margin-top: 10px;">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mx-2 mt-2" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary mx-2 mt-2">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
        include_once('script.php');
    ?>
<?php
    include_once('view/layout/footer/lib-cdn-js.php');
    ?>
</body>
</html>
