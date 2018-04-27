<?php 
    class Position{
        private $Nombre, $IdCosto, $IdJefe, $IdFactor;
        public function __SET($variable, $valor){ return $this->variable = $valor; }
        public function __GET($variable){return $this->variable; }
    }
?>