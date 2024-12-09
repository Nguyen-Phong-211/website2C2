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
    public function getAllListCategoryItemByCategoryController($categoryId)
    {
        $result = $this->categoryItem->getAllListCategoryItemByCategory($categoryId);

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
    //get category_name by category_id and category_item_id

    public function getCategoryNameController($category_id, $category_item_id)
    {
        $result = $this->categoryItem->getCategoryNameByCategoryItemId($category_id, $category_item_id);
        if (!$result) {
            die("Failed to retrieve category list: " . $this->categoryItem->getConnection()->error);
        }
        return $result;
    }
}
