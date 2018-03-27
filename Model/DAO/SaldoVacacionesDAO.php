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
    















































    public function ShowHistory(){
        $flag = true; $flag2 = true;
        $resulSet = array();
        $global = array();
        $resulSet2= array();
        $sql = "select IdEmpleado from Empleados where IdJefe = ?;";
        $consult = $this->db->prepare($sql);
        $id = $_SESSION['ID']->IdEmpleado;
        $consult->execute(array($id));
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                //$val = $row->IdEmpleado;
                array_push($global, $row);
                array_push($resulSet, $row);
                //$resulSet = $row; 
        }

        /* Obtain the connection of each employee with the head of IdSession */
        while($flag2 == true){
            $subjefe = array(); 
            for($i = 0; $i < count($resulSet); $i++){
                for($j = 0; $j < count($resulSet[$i]); $j++){
                    $sql = "select IdEmpleado from Empleados where IdJefe = ?;";
                    $consult = $this->db->prepare($sql);
                    $consult->execute(array($resulSet[$i][$j]->IdEmpleado));
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        //$subjefe = $subjefe + $row;
                        $val = $row[0]->IdEmpleado;
                        array_push($subjefe, $row);
                        //$global = $global + $row;
                        array_push($global, $row);
                    }
                }  
            }
            $resulSet = $subjefe;
            if($resulSet == null){
                $flag2 = false;
            }
        }
             /* List Balance by each Id obtained in the past method*/
        for($i = 0; $i < count($global); $i++){
            for($j = 0; $j < count($global[$i]); $j++){
                $sql = "select e.IdEmpleado, e.PNombre, e.PApellido, s.Saldo, c.NombreCargo, ej.PNombre as NJefe, ej.PApellido as AJefe
                        from Empleados e inner join saldovacaciones s on e.IdEmpleado = s.IdEmpleado 
                        inner join Empleados ej on e.IdJefe = ej.IdEmpleado,
                            Cargos c where e.IdCargo = c.IdCargo and e.Estado = 1
                        and e.IdJefe = ?;"; 
                
                $consult = $this->db->prepare($sql);
                $foo = $global[$i][$j]->IdEmpleado;
                $consult->execute(array($global[$i][$j]->IdEmpleado));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    // $resulSet = $row; 
                    for($k = 0; $k < count($row); $k ++){
                        $val = $row[$k];
                        array_push($resulSet2, $val);
                    }
                }
            }
        }

                   /*List employee Balance by IdSession*/      
        $sql = "select e.IdEmpleado, e.PNombre, e.PApellido, s.Saldo, c.NombreCargo, ej.PNombre as NJefe, ej.PApellido as AJefe
                from Empleados e inner join saldovacaciones s on e.IdEmpleado = s.IdEmpleado 
                inner join Empleados ej on e.IdJefe = ej.IdEmpleado,
                    Cargos c where e.IdCargo = c.IdCargo and e.Estado = 1
                and e.IdJefe = ?;";
        
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
        while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
            for($k = 0; $k < count($row); $k ++){
            $val = $row[$k];
            array_push($resulSet2, $val);
            }
        }
            
        /* List the Balance of General Manager */
        $sql = "select IdEmpleado from Empleados where IdJefe is null and Estado = 1";
        $result = $this->db->prepare($sql);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $lastid=$row->IdEmpleado;
        }
        if($lastid == $_SESSION['ID']->IdEmpleado){
            $sql = "select e.IdEmpleado, e.PNombre, e.PApellido, s.Saldo, c.NombreCargo, ej.PNombre as NJefe, ej.PApellido as AJefe
                    from Empleados e inner join saldovacaciones s on e.IdEmpleado = s.IdEmpleado 
                    inner join Empleados ej on e.IdJefe = ej.IdEmpleado,
                        Cargos c where e.IdCargo = c.IdCargo and e.Estado = 1
                    and e.IdEmpleado = ?;"; 
            
            $consult = $this->db->prepare($sql);
            $consult->execute(array( $_SESSION['ID']->IdEmpleado));
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                // $resulSet = $row; 
                for($k = 0; $k < count($row); $k ++){
                    $val = $row[$k];
                    array_push($resulSet2, $val);
                }
            }
        }
           
        return $resulSet2;
    }
   
}
?>