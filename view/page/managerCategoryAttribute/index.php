
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý danh mục thuộc tính</title>
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
include_once('controller/CategoryAttribute/CategoryAttributeController.php');
include_once('controller/Category/CategoryController.php');
$categoryController = new CategoryController();
$categoryAttributeController = new CategoryAttributeController();

if (isset($_GET['category_id'])) {
    $categoryId = intval($_GET['category_id']); // Lấy category_id từ URL
    $category = $categoryController->getCategoryByIdController($categoryId);
    $categoryAttributes = $categoryAttributeController->getAllListAttributeByCategoryID($categoryId); 
} else {
    $categoryAttributes = []; 
}
?>
<div class="container mt-4">
    <h3>Quản lý thuộc tính</h3>
    <a href="index.php?page=managerCategory" class="btn btn-secondary mx-2">Quay lại</a>
    <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addCategoryAttModal">
        Thêm thuộc tính
    </button>
     <!-- Modal -->
     <div class="modal fade" id="addCategoryAttModal" tabindex="-1" aria-labelledby="addCategoryAttModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryAttModalLabel">Thêm Thuộc Tính</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryAttributeForm" 
                    action="index.php?page=managerCategoryAttribute&action=add&category_id=<?php echo isset($_GET['category_id']) ? intval($_GET['category_id']) : ''; ?>" 
                    method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="categoryItem_parent" class="form-label"><strong>Danh mục:</strong></label>
                            <input type="text" id="categoryItem_parent"
                             class="form-control" value="<?php echo htmlspecialchars($category['category_name']); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên thuộc tính: <span class="text-danger"> * </span></label>
                            <input type="text" name="categoryAttribute_name" id="categoryAttribute_name" class="form-control" required>
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
               <strong><th>Tên thuộc tính</th></strong> 
               <strong> <th>Hành động</th></strong>
            </tr>
        </thead>
        <tbody>
            <?php
             $stt = 1; 
            foreach ($categoryAttributes as $categoryAttribute): 
                ?>
                <tr>
                    <td><?php echo $stt++; ?></td>
                    <td><?php echo $categoryAttribute['category_attribute_name']; ?></td>  
                    <td>
                        <button type="button" class="btn btn-secondary edit-button"
                        data-id="<?php echo $categoryAttribute['category_attribute_id']; ?>" 
                        data-name="<?php echo $categoryAttribute['category_attribute_name']; ?>" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryAttributeModal">
                            Sửa
                        </button>
                        <a href="index.php?page=managerCategoryAttribute&action=delete&id=<?php echo $categoryAttribute['category_attribute_id']; ?>" 
                        class="btn btn-danger mx-2" 
                        onclick="return confirm('Bạn có chắc chắn muốn xóa thuộc tính này?');">Xóa</a>
                        </td>
                </tr>
                <div class="modal fade" id="editcategoryAttributeModal" tabindex="-1" role="dialog" aria-labelledby="editcategoryAttributeModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="editCategoryItemForm"
                         action="index.php?page=managerCategoryAttribute&action=edit&
                         category_id=<?php echo isset($_GET['category_id']) ? intval($_GET['category_id']) : ''; ?>" 
                        method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h4 class="modal-title" id="editcategoryAttributeModalLabel">Sửa thuộc tính</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="category_attribute_id" id="categoryAttId">
                                <div class="mb-3">
                                    <label for="categoryItem_parent" class="form-label"><strong>Danh mục:</strong></label>
                                    <input type="text" id="categoryItem_parent"
                                    class="form-control" value="<?php echo htmlspecialchars($category['category_name']); ?>" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="category_name">Tên thuộc tính<span class="text-danger"> * </span></label>
                                    <input type="text" class="form-control" name="category_attribute_name" id="categoryAttName" required>
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
