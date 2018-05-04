<?php 
    class Vacation{
        private $IdVac, $FechaI, $FechaF, $Tipo, $CantDias, $Estado, $IdEmpleado, $IdRespSup, $FechaSol, $FechaResp, $Descripcion;
        public function __SET($variable, $valor){ return $this->$variable = $valor;}
        public function __GET($variable){ return $this->$variable; }
    }
?>  