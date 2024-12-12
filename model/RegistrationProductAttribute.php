<?php 
    include_once('ConnectDatabase.php');

    class RegistrationProductAttribute extends ConnectDatabase{
        private $conn;
        public function __construct()
        {
            parent::__construct();
            $this->conn = $this->getConnection();
        }
        //get value category_attrubute and attribute_name
        public function getRegistrationProductAttribute($regisId){
            $stmt = $this->conn->prepare("SELECT ca.category_attribute_name, a.attribute_name FROM registration_product_attributes AS rpa JOIN registration_products AS rp ON rpa.registration_product_id = rp.registration_product_id JOIN category_attributes AS ca ON rpa.category_attribute_id = ca.category_attribute_id JOIN attributes AS a ON a.attribute_id = rpa.attribute_id WHERE rpa.registration_product_id = ?");
            $stmt->bind_param("i", $regisId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }
    }
?>