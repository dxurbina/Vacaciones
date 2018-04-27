<?php 
    class Center{
        private $Nombre, $Codigo, $IdDep;
        public function __SET($variable, $valor){ return $this->variable = $valor; }
        public function __GET($variable){return $this->variable; }
    }
?>