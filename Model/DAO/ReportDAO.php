<?php 
    class ReportDAO{
        public $db;
        public function __construct(){
            include("Model/Conexion.php");
            $con = new Conexion();
            $this->db = $con->conex();
        }

        public function report($dateI, $dateE){
            $resultSet = array();
            $sql = "";
        }
    }
?>