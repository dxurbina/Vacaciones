<?php 
    class PositionDAO{
        public $db;
        public function __construct(){
            include("Model/Conexion.php");
            include_once("Model/Entity/Position.php");
            $con = new Conexion();
            $this->db = $con->conex();
        }

        public function store(Position $data){
            $sql = "";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($dateI, $dateE));
        }

        public function showById($id){
            $sql = "select cc.IdCosto, cc.Codigo, cc.Nombre from CentroCostos cc inner join deptosempresa d on cc.IdDptoEmp = d.IdDep
            where d.IdDep = ?;";
            $resulSet = array();
            $consult = $this->db->prepare($sql);
            $consult->execute(array($id));
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        $resulSet = $row; 
                    }
                    return $resulSet;
            }
    }
?>