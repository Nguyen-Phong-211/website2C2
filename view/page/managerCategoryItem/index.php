
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý danh mục con</title>
    <?php
    include_once('view/layout/header/lib_cdn.php');
    ?>
</head>

<body>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<script>alert('" . addslashes($_SESSION['message']) . "');</script>";
        unset($_SESSION['message']); 
    }
    ?>
<?php
include_once('controller/CategoryItem/CategoryItemController.php');
include_once('controller/Category/CategoryController.php');
$categoryController = new CategoryController();
$categoryItemController = new CategoryItemController();

if (isset($_GET['category_id'])) {
    $categoryId = intval($_GET['category_id']); // Lấy category_id từ URL
    $category = $categoryController->getCategoryByIdController($categoryId);
    $categoryItems = $categoryItemController->getAllListCategoryItemByCategoryController($categoryId); 
} else {
    $categoryItems = []; 
}
?>
<div class="container mt-4">
    <h3>Quản lý danh mục con</h3>
    <a href="index.php?page=managerCategory" class="btn btn-secondary mx-2">Quay lại</a>
    <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addCategoryItemModal">
        Thêm danh mục con
    </button>
    <!-- Modal -->
    <div class="modal fade" id="addCategoryItemModal" tabindex="-1" aria-labelledby="addCategoryItemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryItemModalLabel">Thêm Danh Mục Con</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryItemForm" 
                    action="index.php?page=managerCategoryItem&action=add&category_id=<?php echo isset($_GET['category_id']) ? intval($_GET['category_id']) : ''; ?>" 
                    method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="categoryItem_parent" class="form-label"><strong>Danh mục cha:</strong></label>
                            <input type="text" id="categoryItem_parent"
                             class="form-control" value="<?php echo htmlspecialchars($category['category_name']); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên danh mục con: <span class="text-danger"> * </span></label>
                            <input type="text" name="categoryItem_name" id="categoryItem_name" class="form-control" required>
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
               <strong><th>Tên danh mục con</th></strong> 
               <strong> <th>Hình ảnh</th></strong> 
               <strong> <th>Hành động</th></strong>
            </tr>
        </thead>
        <tbody>
            <?php
             $stt = 1; 
            foreach ($categoryItems as $categoryItem): 
                $categoryItemImage = $categoryItem['image'];?>
                <tr>
                    <td><?php echo $stt++; ?></td>
                    <td><?php echo $categoryItem['category_item_name']; ?></td>  
                    <td>
                        <img src="asset/image/category_item/<?= htmlspecialchars($categoryItemImage); ?>" alt="Hình ảnh danh mục con"
                        style="width: 70px; height: 60px;">
                        </td>
                        <td>
                        <button type="button" class="btn btn-secondary edit-button"
                        data-id="<?php echo $categoryItem['category_item_id']; ?>" 
                        data-name="<?php echo $categoryItem['category_item_name']; ?>" 
                        data-image="<?php echo htmlspecialchars($categoryItem['image']); ?>" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editCategoryItemModal">
                            Sửa
                        </button>
                        <a href="index.php?page=managerCategoryItem&action=delete&id=<?php echo $categoryItem['category_item_id']; ?>" 
                        class="btn btn-danger mx-2" 
                        onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục con này?');">Xóa</a>
                        <a href="index.php?page=managerCompany&category_item_id=<?php echo $categoryItem['category_item_id']; ?>" 
                        class="btn btn-primary mx-2" >Công ty</a>
                        </td>
                </tr>
                <div class="modal fade" id="editCategoryItemModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryItemModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="editCategoryItemForm"
                         action="index.php?page=managerCategoryItem&action=edit&
                         category_id=<?php echo isset($_GET['category_id']) ? intval($_GET['category_id']) : ''; ?>" 
                        method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h4 class="modal-title" id="editCategoryItemModalLabel">Sửa danh mục con</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="category_item_id" id="categoryItemId">
                                <div class="mb-3">
                                    <label for="categoryItem_parent" class="form-label"><strong>Danh mục cha:</strong></label>
                                    <input type="text" id="categoryItem_parent"
                                    class="form-control" value="<?php echo htmlspecialchars($category['category_name']); ?>" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="category_name">Tên danh mục con<span class="text-danger"> * </span></label>
                                    <input type="text" class="form-control" name="category_item_name" id="categoryItemName" required>
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
