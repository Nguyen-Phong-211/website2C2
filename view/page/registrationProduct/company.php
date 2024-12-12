<?php if (!empty($selectedSubCategory)) : ?>
    <div>
        <?php
        include_once("controller/Company/CompanyController.php");
        $companyController = new CompanyController();
        $companies = $companyController->getCompaniesList();

        if ($companies) {
            
            echo '<label for="subcategory" class="form-label">'.$_SESSION["name"].'<span class="text-danger">*</span></label>';
            echo '<select class="form-select border-color" id="company" name="company">';
            echo '<option value="">Chọn giá trị</option>';

            while ($company = mysqli_fetch_assoc($companies)) {
                if ($company['category_item_id'] == $selectedSubCategory) {
                    echo "<option value='{$company['company_id']}'>{$company['company_name']}</option>";
                }
            }

            echo '</select>';
        } else {
            echo '<p>Không có Thương hiệu nào.</p>';
        }
        include("./controller/Attribute/AttributeController.php");


        ?>
        
    </div>
<?php endif; ?>