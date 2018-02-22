<?php 
    class LoadDAO{
        public $con, $db;
        public function __construct(){
            require_once("Model/Conexion.php");
            $this->con = new Conexion();
            $this->db = $this->con->conex();
        }

        public function LoadType(){
            try{
            $tipo = "incorrecto";
            $sql = "Select IdTipoEmpleado from Empleados where Usuario = ?";
            $resulSet = $this->db->prepare($sql);
            $resulSet->execute(array(_USER));
            if($row = $resulSet->fetch(PDO::FETCH_OBJ)){
                $tipo = $row->IdTipoEmpleado;
            }
            return $tipo;
        }catch(PDOException  $e ){
            echo "Error: ".$e;
            }
        }

       
    }
?>
