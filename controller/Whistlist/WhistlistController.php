<?php
include_once('model/Whistlist.php');

class WhistlistController
{
    private $whistlist;
    public function __construct()
    {
        $this->whistlist = new Whistlist();
    }
    //count product in whistlist
    public function countProductInWhistlistController()
    {
        return $this->whistlist->countProductInWhistlist();
    }
    //add product in whistlist
    public function addToWhistlistController($productId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_to_wishlist') {
    
            $productId = $_POST['productId'];

            if (isset($productId) && is_numeric($productId)) {
        
                $whistlist = new Whistlist(); 
                $whistlist->addToWhistlist($productId); 

                header("Location: index.php?page=home");
            } else {
                die("Product ID không hợp lệ.");
            }
        }
    }
    //remove product from whistlist
    public function removeFromWhistlistController($productId)
    {
        $this->whistlist->removeFromWhistlist($productId);
    }
    //get all product in whistlist
    public function getAllProductInWhistlistController()
    {
        return $this->whistlist->getAllProductInWhistlist();
    }
}
