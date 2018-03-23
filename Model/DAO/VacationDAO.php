<?php 
    class VacationDAO{
        public $con, $db;
       public function __construct(){
        require_once('Model/Conexion.php');
        require_once('Model/Entity/Vacation.php');
        $this->con = new Conexion();
        $this->db= $this->con->conex();
       }

       public function store(Vacation $data){
           $sql = 'insert into vacaciones values(null, ?, ?, ?, ?, ?, ?, null, now(), null, ?);';
           $result = $this->db->prepare($sql);
           $result->execute(array($data->__GET('FechaI'), $data->__GET('FechaF'),
                            $data->__GET('Tipo'), $data->__GET('CantDias'), $data->__GET('Estado'),
                            $data->__GET('IdEmpleado'), $data->__GET('Descripcion')));
       }

       public function update(Vacation $data){
           $sql= "update Vacaciones set Estado = ?, IdRespSup = ?, FechaRespuesta = ? ";
           $result = $this->db->prepare($sql);
           $result->execute(array($data->__GET('Estado'), $data->__GET('IdRespSup'), $data->__GET('FechaREsp')));
       }

    public function showAll(){
        $flag = true;
        $resulSet = array();
        $sql = "select IdJefe from Empleados where IdEmpleado = ?";
        $consult = $this->db->prepare($sql);
        $id = $_SESSION['ID']->IdEmpleado;
        $consult->execute(array($id));
            if($row = $consult->fetch(PDO::FETCH_OBJ)){
                $boss = $row->IdJefe;
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

            } 
                return $resulSet;
        }

    }
?>