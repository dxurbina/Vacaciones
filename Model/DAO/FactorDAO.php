<?php 
    class FactorDAO{
        public $con, $db;
       public function __construct(){
        require_once('Model/Conexion.php');
        require_once('Model/Entity/Vacation.php');
        $this->con = new Conexion();
        $this->db= $this->con->conex();
       }

       public function store(Vacation $data){
           $sql = 'insert into vacaciones values(null, ?, ?, ?, ?, "Pendiente", ?, null, now(), null, ?);';
           $result = $this->db->prepare($sql);
           $result->execute(array($data->__GET('FechaI'), $data->__GET('FechaF'),
                            $data->__GET('Tipo'), $data->__GET('CantDias'), 
                            $_SESSION['ID']->IdEmpleado, $data->__GET('Descripcion')));
       }

       public function update($id, $Estado){
           $sql= "update Vacaciones set Estado = ?, IdRespSup = ?, FechaRespuesta = now() where IdVacaciones = ?; ";
           $result = $this->db->prepare($sql);
           $result->execute(array($Estado, $_SESSION['ID']->IdEmpleado, $id));
       }

       public function show(){
        $factor;
        $sql = "select f.Factor from Factor f, Cargos c, Empleados e, Vacaciones v where
        f.IdFactor = c.IdFactor and c.IdCargo = e.IdCargo and e.IdEmpleado = ?";
        $result = $this->db->prepare($sql);
        $result->execute(array($_SESSION['ID']->IdEmpleado));
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $factor=$row->Factor;
        }
        return $factor;
       }

    public function showAll(){
        $flag = true;
        $resulSet = array();
        //$sql = "select IdJefe from Empleados where IdEmpleado = ?";
        //$consult = $this->db->prepare($sql);
        //$id = $_SESSION['ID']->IdEmpleado;
        //$consult->execute(array($id));
            //if($row = $consult->fetch(PDO::FETCH_OBJ)){
               // $boss = $row->IdJefe;
               $boss = $_SESSION['ID']->IdEmpleado;
                while($flag == true){
                    $sql = "select v.IdVacaciones, e.PNombre, e.PApellido, v.CantDias, v.FechaI, v.FechaF, v.tipo, v.Descripcion
                    from Vacaciones v inner join Empleados e on v.IdEmpleado = e.IdEmpleado where v.Estado = 'Pendiente'
                    and e.IdJefe = ?;"; 
                     
                    $consult = $this->db->prepare($sql);
                    $consult->execute(array($boss));
                        while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                             $resulSet = $row; 
                        }
                        
                    $sql = "select IdJefe from Empleados where IdEmpleado = ?";
                    $consult = $this->db->prepare($sql);
                    $consult->execute(array($boss));
                        if($row = $consult->fetch(PDO::FETCH_OBJ)){
                            
                            $boss = $row->IdJefe;
                            if($boss == null){
                                $flag = false;
                            }
                        }
                }

            //} 
                return $resulSet;
        }














        

    }
?>