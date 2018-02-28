<?php 
    class LoadDAO{
        public $con, $db;
        public function __construct(){
            require_once("Model/Conexion.php");
            require_once("Model/Entity/Empleado.php");       
            $this->con = new Conexion();
            $this->db = $this->con->conex();
            session_start();
        }


        public function login(Empleado $data){
            $flag = false;
            $sql = "select Usuario from Usuarios where Usuario = ? and Pass = ?";
            $result = $this->db->prepare($sql);
            $result->execute(array($data->__GET('user'), $data->__GET('pass')));
            
            if($row = $result->fetch(PDO::FETCH_OBJ)){
                $flag = true;
                
                $_SESSION['nickname'] = $data->__GET('user');
            }
            $_SESSION['nickname'] = 'Error';
            return $flag;
        }


        public function LoadType(Empleado $data){
            try{
            $tipo; $var;
            $sql = "select IdRol from Usuarios where Usuario = ?";
/*
            $resulSet = $this->db->prepare($sql);
            $sql = "select Usuario from Usuario where Usuario = ? and Pass = ?";
            $result = $this->db->prepare($sql);
            $result->execute(array($data->__GET('user'), $data->__GET('pass')));
            if($row = $result->fetch(PDO::FETCH_OBJ)){
                $var = $row->Usuario;
            }*/

            //$resulSet->bindParam(1, $var, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 20);
            $resultSet = $this->db->prepare($sql);
            $resultSet->execute(array($data->__GET('user')));
            
            if($row = $resultSet->fetch(PDO::FETCH_OBJ)){
                
                $_SESSION['access'] = $row->IdRol;
                
            }
/*
            $sql = "Select NombreCargo from Cargos c inner join Empleados e on c.IdCargo = e.IdCargo where Usuario = ?";

            $resulSet = $this->db->prepare($sql);
            $resulSet->execute(array(_USER));
            if($row = $resulSet->fetch(PDO::FETCH_OBJ)){
                if($row->NombreCargo = 'RRHH' || $row->NombreCargo = 'Gerente General'){
                    $tipo = "Admin";
                }
            }*/
        }catch(PDOException  $e ){
            echo "Error: ".$e;
            }
        }


















































       
        
    }
?>
