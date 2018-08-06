<?php 

class SaldoColaboradoresDAO{
    public $user, $db, $con;
    public function __construct(){
        require_once("Model/Conexion.php");
        include_once('Model/Entity/SaldoVacaciones.php');
        include_once('Model/Entity/User.php');
        include_once('Model/Entity/Vacation.php');
        $this->con = new Conexion();
        $this->db = $this->con->conex();
    }

    //Función para devolver el saldo de las vacaciones de todos los empleados
    public function SaldoColaboradores(){
        try{
            $resulSet = array();
            $consult = $this->db->prepare("select e.IdEmpleado, PNombre, PApellido, NombreCargo, Saldo, f.Factor from saldovacaciones sv 
            inner join empleados e on e.IdEmpleado=sv.IdEmpleado
            inner join cargos c on e.IdCargo=c.IdCargo
            inner join Factor f on f.IdFactor=c.IdFactor; ");
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

    public function send_notif_csv_($id){
        $remitente = $_SESSION['ID']->IdEmpleado;
        $destinatario;
            /* Cargar el jefe y nombre del empleado de la bd */
            $sql2 = "select e.PNombre, e.PApellido, e.IdJefe, ej.correo from empleados e inner join empleados ej
            on e.IdJefe = ej.IdEmpleado where e.IdEmpleado = ?";
            $consult2 = $this->db->prepare($sql2);
            $consult2->execute(array($remitente));
            if($row = $consult2->fetch(PDO::FETCH_OBJ)){
                $nombreDesti = $row->PNombre . " " . $row->PApellido;
                $destinatario = $row->IdJefe;
                $correo = $row->correo;
            }


        $sql = "insert into notificaciones values (null, now(), ?, ?, ?, ?, 1, 1, ?)";
        $consult = $this->db->prepare($sql);
        $mensaje = "Solicitud de aprobación de carga masiva de saldos.";
        $tipo = "aprobacion";
        $consult->execute(array($remitente, $destinatario, $mensaje, $tipo, $id));

    }


    public function update_csv_($__file__, $linea){
        /* Registrar el usuario que realiza esta accion */
       /* $sql ="insert into deduc_cuenta_vacaciones values(null, ?, now(), 'Revertir');";
        $consult = $this->db->prepare($sql);
        $consult->execute(array($_SESSION['nickname']));
*/
        echo "before";
        for($i = 1; $i < $linea; $i++){
        
        /* incrementar saldo a todo los colaboradores*/
            $cedula = $__file__[$i][0];
            $saldo = $__file__[$i][1];
            $saldo = ltrim($saldo);
            $saldo = rtrim($saldo);
            var_dump($saldo);
        $sql = "call updatesaldoupload(?, ?);ç";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $cedula, PDO::PARAM_STR, 20);
        $stmt->bindParam(2, $saldo, PDO::PARAM_STR, 10);
        $stmt->execute();
        }

      

    }
}
?>