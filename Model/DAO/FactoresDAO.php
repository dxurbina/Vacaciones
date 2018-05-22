<?php 
class FactoresDAO{
    public $user, $db, $con;
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
}

?>