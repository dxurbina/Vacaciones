<?php 
    class ConexDAO{
        public $con, $db;
        public function __construct(){
            require_once("Model/Conexion.php");
            $this->con = new Conexion();
            $this->db = $this->con->conex();
        }
    }
?>