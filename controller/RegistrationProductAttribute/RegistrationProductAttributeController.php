<?php 
    include_once('model/RegistrationProductAttribute.php');
    class RegistrationProductAttributeController {
        private $registrationProductAttribute;
        public function __construct(){
            $this->registrationProductAttribute = new RegistrationProductAttribute();
        }
        //get value category_attrubute and attribute_name
        public function getRegistrationProductAttributeController($regisId)
        {
            $result = $this->registrationProductAttribute->getRegistrationProductAttribute($regisId);

            if (!$result) {
                die("Failed to retrieve attribute list: ". $this->registrationProductAttribute->getConnection()->error);
            }
            return $result;
        }
    }
?>