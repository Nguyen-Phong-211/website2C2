<?php

    $attributeController = new AttributeController();
    $category_id = $selectedCategory; // ID của category cấp 1
    $category_item_id = $selectedSubCategory; // ID của category cấp 2
    $attributesGrouped = $attributeController->getAttributesGroupedByCategoryAttribute($category_id, $category_item_id);

    if (!empty($attributesGrouped)) {
        foreach ($attributesGrouped as $category_attribute_id => $group) {
            echo '<div class="mb-3">';
            echo "<label for='attribute_$category_attribute_id' class='form-label'>{$group['category_attribute_name']}</label>";
            echo "<select id='attribute_$category_attribute_id' name='attributes[$category_attribute_id]' class='form-select border-color'>";
            echo '<option value="">Chọn giá trị</option>';

            foreach ($group['attributes'] as $attributes) {
                echo "<option value='{$attributes['attribute_id']}'>{$attributes['attribute_name']}</option>";
            }
            
            echo '</select>';
            
            echo '</div>';
        }
    } else {
        echo '<p>Không có thuộc tính nào để hiển thị.</p>';
}?>