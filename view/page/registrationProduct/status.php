<div>
    <?php
    include_once("controller/StatusProduct/StatusProductController.php");
    $StatusController = new StatusProductController();
    $Status = $StatusController->getAllStatusProductController();

    if ($Status) {
        echo '<label for="status" class="form-label">Trạng thái<span class="text-danger">*</span></label>';
        echo '<select class="form-select border-color" id="status" name="status">';
        echo '<option value="">Chọn trạng thái</option>';

        while ($statusRow = mysqli_fetch_assoc($Status)) {
            echo "<option value='{$statusRow['status_product_id']}'>{$statusRow['status_product_name']}-{$statusRow['description']}</option>";
        }

        echo '</select>';
    } else {
        echo '<p>Không có trạng thái nào.</p>';
    }
    ?>
</div>