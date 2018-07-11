<?php 

class SaldoColaboradoresDAO{
    public $user, $db, $con;
    public function __construct(){
        require_once("Model/Conexion.php");
        include_once('Model/Entity/SaldoVacaciones.php');
        include_once('Model/Entity/User.php');
        $this->con = new Conexion();
        $this->db = $this->con->conex();
    }

    //Función para devolver el saldo de las vacaciones de todos los empleados
    public function SaldoColaboradores(){
        try{
            $resulSet = array();
            $consult = $this->db->prepare("select PNombre, PApellido, NombreCargo, Saldo  from saldovacaciones sv 
            inner join empleados e on e.IdEmpleado=sv.IdEmpleado
            inner join cargos c on e.IdCargo=c.IdCargo; ");
            $consult -> execute(array());
            while($row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row;
            }
            return $resulSet;
        }catch (Exception $e){
            die($e->getMessage());
        }
    
    }      

    public function deduce($cant){
        /* Registrar el usuario que realiza esta accion */
        $sql ="insert into deduc_cuenta_vacaciones values(null, ?, now(), 'Deducir');";
        $consult = $this->db->prepare($sql);
        $consult->execute(array($_SESSION['nickname']));

        /* Deducir saldo a todo los colaboradores*/
        $sql = "call CursorDeducirSaldo(?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $cant, PDO::PARAM_STR, 10);
        $stmt->execute();

        $sql = "call UpdateSaldoDeduced(?, ?)";
        $stmt = $this->db->prepare($sql);
        $tipo = "deduce";
        $stmt->bindParam(1, $tipo, PDO::PARAM_STR, 20);
        $stmt->bindParam(2, $cant, PDO::PARAM_STR, 10);
        $stmt->execute();


    }

    public function increase($cant){
        /* Registrar el usuario que realiza esta accion */
        $sql ="insert into deduc_cuenta_vacaciones values(null, ?, now(), 'Revertir');";
        $consult = $this->db->prepare($sql);
        $consult->execute(array($_SESSION['nickname']));

        /* incrementar saldo a todo los colaboradores*/
        $sql = "call CursorRevertirDeduccionSaldo(?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $cant, PDO::PARAM_STR, 10);
        $stmt->execute();

        $sql = "call UpdateSaldoDeduced(?, ?)";
        $stmt = $this->db->prepare($sql);
        $tipo = "increase";
        $stmt->bindParam(1, $tipo, PDO::PARAM_STR, 20);
        $stmt->bindParam(2, $cant, PDO::PARAM_STR, 10);
        $stmt->execute();

    }
}
?>