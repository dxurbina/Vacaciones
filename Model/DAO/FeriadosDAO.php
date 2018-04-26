<?php 
class FeriadosDAO{
    public $user, $db, $con;
    public function __construct(){
        require_once("Model/Conexion.php");
        include_once('Model/Entity/Feriados.php');
        include_once('Model/Entity/User.php');
        $this->con = new Conexion();
        $this->db = $this->con->conex();
    }

    //Función para devolver los días feriados
    public function ListFeriados(){
        try{
            $resulSet = array();
            $consult = $this->db->prepare("select IdFeriado, Nombre, Fecha from Feriados order by IdFeriado;");
            $consult -> execute(array());
            while($row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row;
            }
            return $resulSet;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }
       public function Addferiados(Feriados $data){
        $sql = 'insert into feriados values(null, ?, ?);';
        $result = $this->db->prepare($sql);
        $result->execute(array($data->__GET('Nombre'), $data->__GET('Fecha')));
    }
    }
?>