<?php 

class SaldoVacacionesDAO{
    public $user, $db, $con;
    public function __construct(){
        require_once("Model/Conexion.php");
        include_once('Model/Entity/SaldoVacaciones.php');
        include_once('Model/Entity/User.php');
        $this->con = new Conexion();
        $this->db = $this->con->conex();
    }

    //Función para devolver el saldo de las vacaciones de un empleado
    public function SaldoVacaciones(){
        try{
            $resulSet = array();
            $consult = $this->db->prepare("select e.PNombre, e.PApellido, sv.Saldo, u.Usuario
            from Empleados e
            inner join SaldoVacaciones sv on sv.IdEmpleado=e.IdEmpleado
            inner join Usuarios u on u.IdEmpleado=e.IdEmpleado
            where u.IdEmpleado= 2; ");
            $consult -> execute();
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