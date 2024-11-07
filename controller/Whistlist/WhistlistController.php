<?php 
    include_once('model/Whistlist.php');

    class WhistlistController {
        private $whistlist;
        public function __construct() {
            $this->whistlist = new Whistlist();
        }
        //count product in whistlist
        public function countProductInWhistlistController(){
            return $this->whistlist->countProductInWhistlist();
        }
    }
?>