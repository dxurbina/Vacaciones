<?php

class empleado{
    private $idEmpleado, $PNombre, $SNombre, $PApellido, $SApellido, $Residencia, $Cedula, $Pasaporte, $NInss, $FechaNac, $FechaIng, $Sexo, $Hijos, $NumHijos, $Hermanos, $NumHermanos, $Telefono, $EstadoCivil, $Correo, $Escolaridad, $NRuc, $Profesion, $Direccion, $Nacionalidad1, $Nacionalidad2, $Estado, $IdCargo, $IdJefe, $IdMunicipio;  
     public function __SET($variable, $valor){ return $this->$variable = $valor;}
     public function __GET($variable){ return $this->$variable; }
     }
?>