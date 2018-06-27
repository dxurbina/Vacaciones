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
            $sql = "insert into cargos values(null, ?, ?, ?, ?, 1)";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($data->__GET('Nombre'), $data->__GET('IdCosto'), $data->__GET('IdJefe'), $data->__GET('IdFactor')));
        }

        public function update(Position $data){
            $sql = "update cargos set NombreCargo = ?, IdCosto = ?, IdJefe = ?, IdFactor = ?  where IdCargo = ?";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($data->__GET('Nombre'), $data->__GET('IdCosto'), $data->__GET('IdJefe'), $data->__GET('IdFactor'), $data->__GET('Id')));
        }
        public function show(){
            $sql = "select c.IdCargo, d.Nombre, c.NombreCargo, cj.NombreCargo as 'CargoSup' from centrocostos cc inner join 
            cargos c on cc.IdCosto = c.IdCosto inner join cargos cj on c.IdJefe = cj.IdCargo
            inner join deptosempresa d on cc.IdDptoEmp = d.IdDep where c.Estado = 1;";
            $resulSet = array();
            $consult = $this->db->prepare($sql);
            $consult->execute();
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        $resulSet = $row; 
                    }

            
                    $sql = "select c.IdCargo, d.Nombre, c.NombreCargo, '-' as 'CargoSup' from centrocostos cc inner join 
                    cargos c on cc.IdCosto = c.IdCosto
                    inner join deptosempresa d on cc.IdDptoEmp = d.IdDep where c.Estado = 1 and c.NombreCargo = 'Gerente General'"; 
                            
                            $consult = $this->db->prepare($sql);
                            $consult->execute();
                                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                                    // $resulSet = $row; 
                                    for($k = 0; $k < count($row); $k ++){
                                        $val = $row[$k];
                                        array_push($resulSet, $val);
                                    }
                                }

                    return $resulSet;
        }

        public function destroy($id){
            $sql = "update cargos set Estado = 0  where IdCargo = ?";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($id));

        }
        public function showById($id){
            $sql = "select c.IdCargo, c.NombreCargo, cc.Codigo from centrocostos cc inner join cargos c on cc.IdCosto = c.IdCosto
            inner join deptosempresa d on d.IdDep = cc.IdDptoEmp
where d.IdDep = ? and c.Estado = 1;";
            $resulSet = array();
            $consult = $this->db->prepare($sql);
            $consult->execute(array($id));
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        $resulSet = $row; 
                    }

            $sql = "select c.IdCargo, c.NombreCargo, cc.Codigo from centrocostos cc inner join cargos c on cc.IdCosto = c.IdCosto
            where c.NombreCargo = 'Gerente General' and c.Estado = 1;"; 
                    
                    $consult = $this->db->prepare($sql);
                    $consult->execute();
                        while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                            // $resulSet = $row; 
                            for($k = 0; $k < count($row); $k ++){
                                $val = $row[$k];
                                array_push($resulSet, $val);
                            }
                        }


             return $resulSet;
        }

        public function showToUpdate($id){
            $resulSet = array();
            $sql = "select c.NombreCargo, d.IdDep, c.Idcosto, c.IdJefe, c.IdFactor from cargos c inner join centrocostos cc
            on cc.IdCosto = c.IdCosto 
            inner join deptosempresa d on cc.IdDptoEmp = d.IdDep
            where IdCargo = ?;";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($id));
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        $resulSet = $row; 
                    }
                    return $resulSet;
        }

        public function showEspecial($id)
        {
            $sql = "select cc.IdCosto from centrocostos cc inner join cargos c on cc.IdCosto = c.IdCosto
            where c.NombreCargo = 'Gerente General' and c.Estado = 1;";
            $resulSet = array();
            $consult = $this->db->prepare($sql);
            $consult->execute(array($id));
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        $resulSet = $row; 
                    }
                    return $resulSet;
        }

        public function showFactor(){
            $sql = "select IdFactor, Factor from factor;";
            $resulSet = array();
            $consult = $this->db->prepare($sql);
            $consult->execute();
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        $resulSet = $row; 
                    }
                    return $resulSet;
        }

        public function GetPosition($nombre){
            $resulSet = array();
            $sql = "select IdCargo, NombreCargo from cargos where NombreCargo = ?;";
            $resulSet = array();
            $consult = $this->db->prepare($sql);
            $consult->execute(array($nombre));
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        $resulSet = $row; 
                    }
                    return $resulSet;
        }
    }
?>