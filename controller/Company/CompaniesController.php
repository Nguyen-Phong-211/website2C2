<?php 
include_once('model/Companies.php');

class CompaniesController {
    private $companies;

    public function __construct() {
        $this->companies = new Companies();
    }
    
    public function getCompaniesList() {
        $result = $this->companies->getAllCompanies();

        if (!$result) {
            die("Failed to retrieve category list: " . $this->companies->getConnection()->error);
        }
        return $result;
    }

}
?>
