<?php 
    class DeparmentDAO{
        public $db;
        public function __construct(){
            include("Model/Conexion.php");
            include_once("Model/Entitity/Deparment.php");
            $con = new Conexion();
            $this->db = $con->conex();
        }

        public function store(Deparment $data){
            $sql = "";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($dateI, $dateE));        
    }
    }
?>