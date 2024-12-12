<div>
    <?php
    include_once("controller/WarrantyPolicy/WarrantyPolicyController.php");
    $warrantyPoliciesController = new WarrantyPoliciesController();
    $policies = $warrantyPoliciesController->getAllPolicy();

    if ($policies) {
        echo '<label for="policy" class="form-label">Chính sách bảo hành<span class="text-danger">*</span></label>';
        echo '<select class="form-select border-color" id="policy" name="policy">';
        echo '<option value="">Chọn chính sách bảo hành</option>';

        while ($policy = mysqli_fetch_assoc($policies)) {
            echo "<option value='{$policy['warranty_policy_id']}'>{$policy['warranty_policy_name']}</option>";
        }

        echo '</select>';
    } else {
        echo '<p>Không có chính sách bảo hành nào.</p>';
    }
    ?>
</div>