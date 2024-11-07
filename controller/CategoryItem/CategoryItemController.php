<?php
include_once('model/CategoryItem.php');

class CategoryItemController
{
    private $categoryItem;
    public function __construct()
    {
        $this->categoryItem = new CategoryItem();
    }
    //get all product in category
    public function getAllProductByCategory($categoryId)
    {
        $result = $this->categoryItem->getAllProductByCategory($categoryId);

        if (!$result) {
            die("Failed to retrieve product list: " . $this->categoryItem->getConnection()->error);
        }
        return $result;
    }
    //join categoies table

    public function joinCategoriesTableController()
    {
        $result = $this->categoryItem->joinCategoriesTable();

        if (!$result) {
            die("Failed to retrieve category list: " . $this->categoryItem->getConnection()->error);
        }
        return $result;
    }
}
