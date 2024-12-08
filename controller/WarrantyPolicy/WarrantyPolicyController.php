<?php 
    include_once('model/WarrantyPolicies.php');

    class WarrantyPoliciesController{
        private $WarrantyPoliciesModel;

        public function __construct(){
            $this->WarrantyPoliciesModel = new WarrantyPolicies();
        }
        //get distinct status_product
        public function getAllPolicy(){

            $result = $this->WarrantyPoliciesModel->getAllListPolicies();
            
            if (!$result) {
                die("Failed to retrieve product list: " . $this->WarrantyPoliciesModel->getConnection()->error);
            }
            return $result;
        }
    }
?>