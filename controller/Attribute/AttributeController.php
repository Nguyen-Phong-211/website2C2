<?php 
include_once('model/Attribute.php');

class AttributeController {
    private $attribute;

    public function __construct() {
        $this->attribute = new AttributeModel();
    }
    
    public function getAttributeList() {
        $result = $this->attribute->getAllAttribute();

        if (!$result) {
            die("Failed to retrieve category list: " . $this->attribute->getConnection()->error);
        }
        return $result;
    }
    public function getAttributesGroupedByCategoryAttribute($category_id, $category_item_id)
    {
        return $this->attribute->getAttributesGroupedByCategoryAttribute($category_id, $category_item_id);
    }

}
?>