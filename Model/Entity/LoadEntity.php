<?php 
    class LoadEntity{
        private $user, $pass;
        public function __SET($variable, $valor){ return $this->variable = $valor; }
        public function __GET($variable){return $this->variable; }
    }
?>
