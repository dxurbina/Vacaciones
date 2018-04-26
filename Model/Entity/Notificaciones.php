<?php
    class Notificaciones{
        public $remitente, $destinatario, $mensaje;
            public function __SET($variable, $valor){ return $this->variable = $valor; }
            public function __GET($variable){return $this->variable; }
    }
?>