<?php 
    class CenterDAO{
        public $db;
        public function __construct(){
            include("Model/Conexion.php");
            include_once('Model/Entity/Center.php');
            $con = new Conexion();
            $this->db = $con->conex();

        }

        public function store(Center $data){
            $sql = "insert into centrocostos values(null, ?, ?, ?, 1)";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($data->__GET('Nombre'), $data->__GET('Codigo'), $data->__GET('IdDep')));
        
        }

        public function destroy($id){
            $sql = "update centrocostos set Estado = 0 where IdCosto = ?";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($id));
        }

        public function update(Center $data){
            $sql = "update centrocostos set Nombre = ?, Codigo = ?, IdDptoEmp = ?  where IdCosto = ?";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($data->__GET('Nombre'), $data->__GET('Codigo'), $data->__GET('IdDep'), $data->__GET('Id')));
        
        }
        public function showById($id){
            $sql = "select distinct cc.IdCosto, cc.Codigo, cc.Nombre from centrocostos cc inner join deptosempresa d on cc.IdDptoEmp = d.IdDep
            where d.IdDep = ? and d.Estado = 1;";
            $resulSet = array();
            $consult = $this->db->prepare($sql);
            $consult->execute(array($id));
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        $resulSet = $row; 
                    }
                    return $resulSet;
        }

        public function show(){
                $sql = "
                select c.IdCosto, c.Nombre, c.Codigo, d.Nombre as dpto from centrocostos c inner join deptosempresa d on c.IdDptoEmp = d.IdDep where
                                        d.Estado = 1;";
                $resulSet = array();
                $consult = $this->db->prepare($sql);
                $consult->execute();
                        while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                            $resulSet = $row; 
                        }
                return $resulSet;
         }

         public function showToUpdate($id){
            $resulSet = array();
                $sql = "select c.IdCosto, c.Nombre, c.Codigo, d.IdDep, d.Nombre as dpto from centrocostos c inner join deptosempresa d on c.IdDptoEmp = d.IdDep where
                c.Estado = 1 and c.IdCosto = ?";
                $consult = $this->db->prepare($sql);
                $consult->execute(array($id));
                        while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                            $resulSet = $row; 
                        }
                        return $resulSet;
        }
    }

    
?>