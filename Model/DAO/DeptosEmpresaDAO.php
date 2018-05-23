<?php 
class DeptosEmpresaDAO{
    public $user, $db, $con;
    public function __construct(){
        require_once("Model/Conexion.php");
        include_once('Model/Entity/DeptosEmpresa.php');
        include_once('Model/Entity/User.php');
        $this->con = new Conexion();
        $this->db = $this->con->conex();
    }

    public function ListDeptosEmpresa(){
        try{
            $resulSet = array();
            $consult = $this->db->prepare("select * from deptosempresa where Estado!=0;");
            $consult -> execute(array());
            while($row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row;
            }
            return $resulSet;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function ListDeptosEmpresaById($id){
        try{
            $resulSet = array();
            $consult = $this->db->prepare("select * from deptosempresa where IdDep = ? ");
            $consult -> execute(array($id));
            while($row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row;
            }
            return $resulSet;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function AddDeptosEmpresa(DeptosEmpresa $data){
        $sql = 'insert into deptosempresa values(null, ?, ?, 1);';
        $result = $this->db->prepare($sql);
        $result->execute(array($data->__GET('Nombre'), $data->__GET('Descripcion')));
    }

    public function EditDeptoEmp(DeptosEmpresa $data){
        $sql = 'update deptosempresa set Nombre = ?, Descripcion = ? where IdDep = ? and Estado = 1;';
        $result = $this->db->prepare($sql);
        $result->execute(array( 
        $data->__GET('Nombre'),
        $data->__GET('Descripcion'),
        $data->__GET('IdDep'))); 
    } 

    public function DeleteDeptosEmpresa($id){
        try{
                //$sql= 'delete from DeptosEmpresa where IdDep = ?; ';
                $sql = 'update deptosempresa set Estado = 0 where IdDep = ?';
                $consult = $this->db->prepare($sql);
                $consult->execute(array($id));
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function GetPosition($nombre){
        $resulSet = array();
        $sql = "select * from deptosempresa where Nombre = ? and Estado = 1;";
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