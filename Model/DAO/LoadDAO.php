<?php 
    class LoadDAO{
        public $con, $db;
        public function __construct(){
            require_once("Model/Conexion.php");
            require_once("Model/Entity/Empleado.php");       
            $this->con = new Conexion();
            $this->db = $this->con->conex();
            
        }


        public function login(Empleado $data){
            $flag = false;
            $sql = "select u.IdEmpleado, u.IdUsuario from usuarios u where u.Usuario = ? and u.Pass = MD5(?) and u.Estado!=0";
            $result = $this->db->prepare($sql);
            $result->execute(array($data->__GET('user'), $data->__GET('pass')));
            
            if($row = $result->fetchAll(PDO::FETCH_OBJ)){
                $flag = true;
                $_SESSION['ID'] = $row;
                $_SESSION['nickname'] = $data->__GET('user');
            }else{
               $_SESSION['nickname'] = 'Error';
                $_SESSION['access'] = null;
            }
            
            return $flag;
        }


        public function LoadType(Empleado $data){
            try{
            $tipo; $var;
            $sql = "select IdRol from usuarios where Usuario = ?";
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

        public function GeneralData(){
            $flag = false;
            $sql = "select  e.PNombre, e.PApellido, c.NombreCargo from  empleados e, cargos c, centrocostos cc, deptosempresa d where e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep 
            and e.IdEmpleado = ?;";
            $result = $this->db->prepare($sql);
            $result->execute(array( $_SESSION['ID']->IdEmpleado));
            $data;
            if($row = $result->fetch(PDO::FETCH_OBJ)){
               
                $_SESSION['data'] = $row;
                
            }
            
           
        }
        
    }
?>
