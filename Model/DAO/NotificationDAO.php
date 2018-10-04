<?php 
class NotificationDAO{
    public $con, $db;
    public function __construct(){
        include_once 'Model/Conexion.php';
        include_once 'Model/Entity/Notificaciones.php';
        $this->con = new Conexion();
        $this->db = $this->con->conex();
    }

    public function store($id_solicitud, $estado){
        date_default_timezone_set('America/Managua');
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $fechaActual = (string) date('Y-m-d');
        
        $fechaActual = strftime("%d de %B del %Y", strtotime($fechaActual));
        $destinatario;
        $nombreDesti;
        $correo;
        $fecha;
        $sql = "insert into notificaciones values(null, now(), ?, ?, ?, ?, 1, 1)";
        $consult = $this->db->prepare($sql);
        $remitente = $_SESSION['ID']->IdEmpleado;
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

            /* Cargar el destinatario por medio de la solicitud */
            $sql2 = "select e.PNombre, e.PApellido, v.IdEmpleado, e.correo from vacaciones v inner join empleados e on e.IdEmpleado = v.IdEmpleado
            where IdVacaciones = ?";
            $consult2 = $this->db->prepare($sql2);
            $consult2->execute(array($id_solicitud));
            if($row = $consult2->fetch(PDO::FETCH_OBJ)){
                $nombreDesti = $row->PNombre . " " . $row->PApellido;
                $destinatario = $row->IdEmpleado;
                $correo = $row->correo;
            }

        
        if($estado == "Solicitud"){
            $Mensaje =  $nombreDesti . " está solicitando vacaciones. ( Enviado: " . $fechaActual .")." ;
            $consult->execute(array($remitente, $destinatario, $Mensaje, 'Solicitud'));
        }else if($estado == 'Aceptada'){
            $Mensaje =  $nombreDesti . " ha aceptado tu solicitud de vacaciones( Enviado: " . $fechaActual .").";
            $consult->execute(array($remitente, $destinatario, $Mensaje, 'Respuesta'));
        }else if($estado == 'Rechazada'){
            $Mensaje =  $nombreDesti . " ha rechazado tu solicitud de vacaciones( Enviado: " . $fechaActual .").";
            $consult->execute(array($remitente, $destinatario, $Mensaje, 'Respuesta'));
        }else if($estado == 'Revertida'){
            $Mensaje =  $nombreDesti . " ha revertido tu solicitud de vacaciones( Enviado: " . $fechaActual .").";
            $consult->execute(array($remitente, $destinatario, $Mensaje, 'Respuesta'));
        }

    }

    //Método para las notificaciones de sugerir vacaciones 07/08/2018.
    public function storeNotiSugerir($id_solicitud, $estado, $IdEmpleado){
        date_default_timezone_set('America/Managua');
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $fechaActual = (string) date('Y-m-d');
        
        $fechaActual = strftime("%d de %B del %Y", strtotime($fechaActual));
        $destinatario;
        $nombreDesti;
        $correo;
        $fecha;
        $sql = "insert into notificaciones values(null, now(), ?, ?, ?, ?, 1, 1)";
        $consult = $this->db->prepare($sql);
        $remitente = $IdEmpleado;
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

            /* Cargar el destinatario por medio de la solicitud */
            $sql2 = "select e.PNombre, e.PApellido, v.IdEmpleado, e.correo from vacaciones v inner join empleados e on e.IdEmpleado = v.IdEmpleado
            where IdVacaciones = ?";
            $consult2 = $this->db->prepare($sql2);
            $consult2->execute(array($id_solicitud));
            if($row = $consult2->fetch(PDO::FETCH_OBJ)){
                $nombreDesti = $row->PNombre . " " . $row->PApellido;
                $destinatario = $row->IdEmpleado;
                $correo = $row->correo;
            }

        
        if($estado == "Solicitud"){
            $Mensaje =  $nombreDesti . " está solicitando vacaciones. ( Enviado: " . $fechaActual .")." ;
            $consult->execute(array($remitente, $destinatario, $Mensaje, 'Solicitud'));
        }else if($estado == 'Aceptada'){
            $Mensaje =  $nombreDesti . " ha aceptado tu solicitud de vacaciones( Enviado: " . $fechaActual .").";
            $consult->execute(array($remitente, $destinatario, $Mensaje, 'Respuesta'));
        }else if($estado == 'Rechazada'){
            $Mensaje =  $nombreDesti . " ha rechazado tu solicitud de vacaciones( Enviado: " . $fechaActual .").";
            $consult->execute(array($remitente, $destinatario, $Mensaje, 'Respuesta'));
        }else if($estado == 'Revertida'){
            $Mensaje =  $nombreDesti . " ha revertido tu solicitud de vacaciones( Enviado: " . $fechaActual .").";
            $consult->execute(array($remitente, $destinatario, $Mensaje, 'Respuesta'));
        }

    }
      
    public function show(){
        $resulSet = array();
        $sql = "select  n.Fecha, er.PNombre, er.PApellido, n.Mensaje, n.Tipo from notificaciones n inner join empleados e
        on n.IdDestinatario = e.IdEmpleado inner join empleados er on n.IdRemitente = er.IdEmpleado
        where e.IdEmpleado = ? and n.Estado = 1";
                $consult = $this->db->prepare($sql);
                $consult->execute(array($_SESSION['ID']->IdEmpleado));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
            
                return $resulSet; 
    }

    public function showAll(){
        $resulSet = array();
        $sql = "select  n.Fecha, er.PNombre, er.PApellido, n.Mensaje, n.Tipo from notificaciones n inner join empleados e
        on n.IdDestinatario = e.IdEmpleado inner join empleados er on n.IdRemitente = er.IdEmpleado
        where e.IdEmpleado = ? and n.Fecha > date_add(NOW(), INTERVAL -7 DAY)";
                $consult = $this->db->prepare($sql);
                $consult->execute(array($_SESSION['ID']->IdEmpleado));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
            
                return $resulSet; 
    }

    public function destroy(){
        $resulSet = array();
        $sql = "update notificaciones set Estado = 0 where IdDestinatario = ? and Estado = 1";
                $consult = $this->db->prepare($sql);
                $consult->execute(array($_SESSION['ID']->IdEmpleado));
    }
}
?>