<?php
class SaldoVacaciones{
    private $IdSaldo, $Saldo, $FechaConsulta, $IdEmpleado;  
     public function __SET($variable, $valor){ return $this->$variable = $valor;}
     public function __GET($variable){ return $this->$variable; }
}
?>