<?php

class Factores{
    private $IdFactor, $Nombre, $Factor, $Estado;  
    public function __SET($variable, $valor){ return $this->$variable = $valor;}
    public function __GET($variable){ return $this->$variable; }
     }
?>