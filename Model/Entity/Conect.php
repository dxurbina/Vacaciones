<?php
    class Conect{
        private $user, $pass;
        public function __SET($var, $val){ $this->var = $val; }
        public function __GET($var){ return $this->var; }
    }
?>