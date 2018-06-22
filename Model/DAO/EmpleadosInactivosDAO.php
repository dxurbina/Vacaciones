<?php 

class EmpleadosInactivosDAO{
    public $user, $db, $con;
    public function __construct(){
        require_once("Model/Conexion.php");
        include_once('Model/Entity/Empleado.php');
        include_once('Model/Entity/User.php');
        $this->con = new Conexion();
        $this->db = $this->con->conex();
    }

    //Función para devolver los empleados inactivos
    public function EmpleadosInactivos(){
        try{
            $resulSet = array();
            $consult = $this->db->prepare("select IdEmpleado, PNombre, PApellido, FechaIngreso, NombreCargo  from empleados e
            inner join cargos c on c.IdCargo=e.IdCargo
            where e.Estado=0; ");
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