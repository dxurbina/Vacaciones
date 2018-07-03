<?php 

class SaldoColaboradoresDAO{
    public $user, $db, $con;
    public function __construct(){
        require_once("Model/Conexion.php");
        include_once('Model/Entity/SaldoVacaciones.php');
        include_once('Model/Entity/User.php');
        $this->con = new Conexion();
        $this->db = $this->con->conex();
    }

    //Función para devolver el saldo de las vacaciones de todos los empleados
    public function SaldoColaboradores(){
        try{
            $resulSet = array();
            $consult = $this->db->prepare("select PNombre, PApellido, NombreCargo, Saldo  from saldovacaciones sv 
            inner join empleados e on e.IdEmpleado=sv.IdEmpleado
            inner join cargos c on e.IdCargo=c.IdCargo; ");
            $consult -> execute(array());
            while($row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row;
            }
            return $resulSet;
        }catch (Exception $e){
            die($e->getMessage());
        }
    
    }      
}
?>