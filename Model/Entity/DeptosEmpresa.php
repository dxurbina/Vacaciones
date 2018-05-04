<?php

class DeptosEmpresa{
    private $IdDep, $Nombre, $Descripcion, $Estado;  
    public function __SET($variable, $valor){ return $this->$variable = $valor;}
    public function __GET($variable){ return $this->$variable; }
     }
?>