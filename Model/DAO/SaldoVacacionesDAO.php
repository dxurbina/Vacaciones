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

    //Función para devolver el saldo de las vacaciones del empleado logueado
    public function SaldoVacaciones(){
        try{
            $id = $_SESSION['ID']->IdEmpleado; //Captura el id del usuario logueado
            $resulSet = array();
            $consult = $this->db->prepare("select e.PNombre, e.PApellido, sv.Saldo, u.Usuario
            from Empleados e
            inner join SaldoVacaciones sv on sv.IdEmpleado=e.IdEmpleado
            inner join Usuarios u on u.IdEmpleado=e.IdEmpleado
            where u.IdEmpleado = ?; ");
            $consult -> execute(array($id));
            while($row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row;
            }
            return $resulSet;
        }catch (Exception $e){
            die($e->getMessage());
        }
    
    }

        //Función para devolver el historial de las vacaciones del empleado logueado
        public function HistVac(){
            try{
                $id = $_SESSION['ID']->IdEmpleado; //Captura el id del usuario logueado
                $resulSet = array();
                $consult = $this->db->prepare("select e.PNombre, e.PApellido, c.NombreCargo, v.CantDias, v.FechaI, v.FechaF, v.Tipo, v.FechaSolicitud, ej.PNombre as NJefe, ej.PApellido as AJefe, v.Estado, v.FechaRespuesta, v.Descripcion
                from Vacaciones v 
                inner join Empleados e on v.IdEmpleado = e.IdEmpleado 
                inner join cargos car on car.IdCargo=e.IdCargo
                inner join Empleados ej on v.IdRespSup = ej.IdEmpleado,
                Cargos c where e.IdCargo = c.IdCargo and v.IdEmpleado = ?;");
                $consult -> execute(array($id));
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