<?php 

class HisVacColaboradoresDAO{
    public $db;
    public function __construct(){
        require_once("Model/Conexion.php");
        //include_once('Model/Entity/Vacation.php');
       // include_once('Model/Entity/User.php');
        $this->con = new Conexion();
        $this->db = $this->con->conex();
    }

    //Función para cargar la lista de todos los colaboradores en el combobox.
    public function CargarEmpleados(){
        try{
            $resulSet = array();
            $consult = $this->db->prepare("select e.IdEmpleado, e.PNombre, e.PApellido, dp.Nombre, c.NombreCargo  from empleados e
            inner join cargos c on c.IdCargo=e.IdCargo
            inner join centrocostos cc on cc.IdCosto=c.IdCosto
            inner join deptosempresa dp on dp.IdDep=cc.IdDptoEmp
            where e.Estado = 1;");
            $consult ->execute(array());
            while($row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row;
            }
            return $resulSet;
        }catch(Exception $e){
            die($e->getMessage());

        }
    }

    public function GenerarReporte($Fecha1, $Fecha2){
        $resulSet = array();
        //$i = 0;
        $sql = "select V.IdVacaciones, e.PNombre, e.PApellido, dp.Nombre, c.NombreCargo, v.CantDias, v.FechaI, v.FechaF
        from vacaciones v 
        inner join empleados e on v.IdEmpleado = e.IdEmpleado
        inner join cargos c on c.IdCargo=e.IdCargo
        inner join centrocostos cc on cc.IdCosto=c.IdCargo
        inner join deptosempresa dp on dp.IdDep=cc.IdDptoEmp
        where v.Tipo = 'Vacaciones' and v.Estado = 'Aceptada' between ? and ?;";
        $consult = $this->db->prepare($sql);
        $consult->execute(array($Fecha1, $Fecha2));
        while( $row = $consult->fetch(PDO::FETCH_ASSOC)){
            //$row['NCedula'] = str_replace("-","",$row['NCedula']);
            $resulSet[] = $row; 
        }
        return $resulSet;
    }
   
}
?>