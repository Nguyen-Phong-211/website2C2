
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý công ty</title>
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
include_once('controller/Company/CompanyController.php');
include_once('controller/CategoryItem/CategoryItemController.php');
$categoryItemController = new CategoryItemController();
$companyController = new CompanyController();

if (isset($_GET['category_item_id'])) {
    $categoryItemId = intval($_GET['category_item_id']); 
    $categoryItem = $categoryItemController->getCategoryItemById($categoryItemId);
    $companies = $companyController->getAllListCompanyByCategoryItemID($categoryItemId); 
    $categoryId = $categoryItemController->getCategoryItemId($categoryItemId);
} else {
    $companies = []; 
}
?>
<div class="container mt-4">
    <h3>Quản lý công ty</h3>
    <a href="index.php?page=managerCategoryItem&category_id=<?php echo $categoryId; ?>" class="btn btn-secondary mx-2">Quay lại</a>
    <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
        Thêm công ty
    </button>
      <!-- Modal -->
      <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanytModalLabel">Thêm Công Ty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form 
                    action="index.php?page=managerCompany&action=add&category_item_id=<?php echo isset($_GET['category_item_id']) ? intval($_GET['category_item_id']) : ''; ?>" 
                    method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="categoryItem_parent" class="form-label"><strong>Thuộc danh mục con:</strong></label>
                            <input type="text" id="categoryItem_parent"
                             class="form-control" value="<?php echo htmlspecialchars($categoryItem['category_item_name']); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên công ty: <span class="text-danger"> * </span></label>
                            <input type="text" name="company_name" id="company_name" class="form-control" required>
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
               <strong><th>Tên công ty</th></strong> 
               <strong> <th>Hành động</th></strong>
              
            </tr>
        </thead>
        <tbody>
            <?php
             $stt = 1; 
            foreach ($companies as $company): 
                ?>
                <tr>
                    <td><?php echo $stt++; ?></td>
                    <td><?php echo $company['company_name']; ?></td>  
                    <td>
                        <button type="button" class="btn btn-secondary edit-button"
                        data-id="<?php echo $company['company_id']; ?>" 
                        data-name="<?php echo $company['company_name']; ?>" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editCompanyModal">
                            Sửa
                        </button>
                        <a href="index.php?page=managerCompany&action=delete&id=<?php echo $company['company_id']; ?>" 
                        class="btn btn-danger mx-2" 
                        onclick="return confirm('Bạn có chắc chắn muốn xóa công ty này?');">Xóa</a>
                        </td>
                </tr>
                <div class="modal fade" id="editCompanyModal" tabindex="-1" role="dialog" aria-labelledby="editCompanyModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form 
                         action="index.php?page=managerCompany&action=edit&
                         category_item_id=<?php echo isset($_GET['category_item_id']) ? intval($_GET['category_item_id']) : ''; ?>" 
                        method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h4 class="modal-title" id="editCompanyModalLabel">Sửa tên công ty</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="company_id" id="companyId">
                                <div class="mb-3">
                                    <label for="categoryItem_parent" class="form-label"><strong>Thuộc danh mục con:</strong></label>
                                    <input type="text" id="categoryItem_parent"
                                    class="form-control" value="<?php echo htmlspecialchars($categoryItem['category_item_name']); ?>" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="category_name">Tên công ty<span class="text-danger"> * </span></label>
                                    <input type="text" class="form-control" name="company_name" id="companyName" required>
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
