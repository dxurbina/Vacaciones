<?php 
class FactoresDAO{
    public $user, $db, $con, $factor;
    public function __construct(){
        require_once("Model/Conexion.php");
        include_once('Model/Entity/Factores.php');
        include_once('Model/Entity/User.php');
        $this->con = new Conexion();
        $this->db = $this->con->conex();
    }

    public function ListFactores(){
        try{
            $resulSet = array();
            $consult = $this->db->prepare("select * from factor where Estado!=0;");
            $consult -> execute(array());
            while($row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row;
            }
            return $resulSet;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function ListFactoresById($id){
        try{
             $resulSet = array();
             $consult = $this->db->prepare("select * from factor where IdFactor = ?;");
             $consult->execute(array($id));
             while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
              $resulSet = $row; 
          }
          return $resulSet; 
          } catch(Exception $e)
                  {
                      die($e->getMessage());
                  }
      }

    public function FactorId($id){
        $resulSet = array();
        $sql = "select * from factor where Factor = ? and Estado = 1;";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }

    public function AddFactor(Factores $data){
        $sql = 'insert into factor values(null, ?, ?, 1);';
        $result = $this->db->prepare($sql);
        $result->execute(array($data->__GET('Nombre'), $data->__GET('Factor')));
    }

    public function EditFactor(Factores $data){
        $sql = 'update factor set Nombre = ?, Factor = ? where IdFactor = ? and Estado = 1;';
        $result = $this->db->prepare($sql);
        $result->execute(array( 
        $data->__GET('Nombre'),
        $data->__GET('Factor'),
        $data->__GET('IdFactor'))); 
    }   

    public function DeleteFac($id){
        try{
            $sql= 'update factor set Estado = 0 where IdFactor = ?;';
            $result = $this->db->prepare($sql);
            $result->execute(array($id));
        }catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function GetPosition($factor){
        $resulSet = array();
        $sql = "select * from factor where factor = ? and Estado = 1;";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($factor));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
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
                    from vacaciones v inner join empleados e on v.IdEmpleado = e.IdEmpleado where v.Estado = 'Pendiente'
                    and e.IdJefe = ?;"; 
                     
                    $consult = $this->db->prepare($sql);
                    $consult->execute(array($boss));
                        while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                             $resulSet = $row; 
                        }
                        
                    $sql = "select IdJefe from empleados where IdEmpleado = ?";
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
        
        public function show(){
            $factor = null;
            $sql = "select f.Factor from factor f, cargos c, empleados e where
            f.IdFactor = c.IdFactor and c.IdCargo = e.IdCargo and e.IdEmpleado = ?";
            $result = $this->db->prepare($sql);
            $result->execute(array($_SESSION['ID']->IdEmpleado));
            if($row = $result->fetch(PDO::FETCH_OBJ)){
                $factor=$row->Factor;
            }
            return $factor;
           }

        //#Lista de factores filtrados por el idEmpleado
        public function listFacByEmp($id){
        try{
            $resultSet = array();
            $consult = $this->db->prepare("select e.IdEmpleado, f.Factor, sv.Saldo from empleados e
            inner join cargos c on e.IdCargo=c.IdCargo
            inner join factor f on f.IdFactor=c.IdFactor
            inner join saldovacaciones sv on sv.IdEmpleado=e.IdEmpleado
            where e.IdEmpleado = ?;");
            $consult->execute(array($id));
                while($row = $consult->fetch(PDO::FETCH_OBJ)) {
                    $resultSet = $row;
                }
                return $resultSet;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        }
}

?>