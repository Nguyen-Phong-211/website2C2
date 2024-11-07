<?php 
include_once('model/Category.php');

class CategoryController {
    private $category;

    public function __construct() {
        $this->category = new Category();
    }
    
    public function getCategoryList() {
        $result = $this->category->getAllCategory();

        if (!$result) {
            die("Failed to retrieve category list: " . $this->category->getConnection()->error);
        }
        return $result;
    }

}
?>
