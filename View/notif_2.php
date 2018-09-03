<?php 
date_default_timezone_set('America/Managua');
    setlocale(LC_TIME, 'es_ES.UTF-8');
    $fechaActual = (string) date('Y-m-d');
    
    $fechaActual = strftime("%d de %B del %Y", strtotime($fechaActual));
    $db = null;

    try{      
       
        $db = new PDO('mysql:host=localhost;dbname=vacaciones;charset=utf8mb4', 'root', 'LumberXD02',
            array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' "));
    } catch (PDOException $e) {
        echo "Error";
    }
    $destinatario;
    $nombreDesti;
    $correo;
    $fecha;

    $sql = "select v.IdVacaciones, e.IdEmpleado, e.PNombre, e.PApellido, e.IdJefe, ej.correo from empleados e inner join empleados ej
    on e.IdJefe = ej.IdEmpleado inner join vacaciones v on e.IdEmpleado = v.IdEmpleado
    where v.Estado = 'pendiente' and DATEDIFF(now(), v.FechaSolicitud) = 1;";
        $resultSet = array();
        $consult = $db->prepare($sql);
        $consult->execute();
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resultSet = $row; 
            }

    for($i = 0; $i < count($resultSet); $i++){
    $sql = "insert into notificaciones values(null, now(), ?, ?, ?, ?, 1, 1, null)";
    $consult = $db->prepare($sql);
    $remitente = $resultSet[$i]->IdEmpleado;
        /* Cargar el jefe y nombre del empleado de la bd */
        $sql2 = "select e.PNombre, e.PApellido, e.IdJefe, ej.correo from empleados e inner join empleados ej
        on e.IdJefe = ej.IdEmpleado where e.IdEmpleado = ?";
        $consult2 = $db->prepare($sql2);
        $consult2->execute(array($remitente));
        if($row = $consult2->fetch(PDO::FETCH_OBJ)){
            $nombreDesti = $row->PNombre . " " . $row->PApellido;
            $destinatario = $row->IdJefe;
            $correo = $row->correo;
        }

        $Mensaje =  $nombreDesti . " tiene una solicitud de vacaciones pendiente. ( Enviado: " . $fechaActual .")." ;
        $consult->execute(array($remitente, $destinatario, $Mensaje, 'Solicitud'));

    }


    $sql = "select v.IdVacaciones, e.IdEmpleado, e.PNombre, e.PApellido, e.IdJefe, ej.correo from empleados e inner join empleados ej
    on e.IdJefe = ej.IdEmpleado inner join vacaciones v on e.IdEmpleado = v.IdEmpleado
    where v.Estado = 'pendiente' and DATEDIFF(now(), v.FechaSolicitud) > 2;";
        $resultSet = array();
        $consult = $db->prepare($sql);
        $consult->execute();
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resultSet = $row; 
               
            }


    for($i = 0; $i < count($resultSet); $i++){
            $sql = "insert into notificaciones values(null, now(), ?, ?, ?, ?, 1, 1, null)";
            $consult = $db->prepare($sql);
            $remitente = $resultSet[$i]->IdEmpleado;
                /* Cargar el jefe y nombre del empleado de la bd */
                $sql2 = "select e.PNombre, e.PApellido, ej.IdJefe from empleados e inner join empleados ej
                on e.IdJefe = ej.IdEmpleado 
                where e.IdEmpleado = ?";
                $consult2 = $db->prepare($sql2);
                $consult2->execute(array($remitente));
                if($row = $consult2->fetch(PDO::FETCH_OBJ)){
                    $nombreDesti = $row->PNombre . " " . $row->PApellido;
                    $destinatario = $row->IdJefe;
                   // $correo = $row->correo;
                }
                $Mensaje =  $nombreDesti . " tiene una solicitud de vacaciones pendiente. ( Enviado: " . $fechaActual .")." ;
                $consult->execute(array($remitente, $destinatario, $Mensaje, 'Solicitud'));
            
                $sql = "insert into notificaciones values(null, now(), ?, ?, ?, ?, 1, 1, null)";
                $consult = $db->prepare($sql);
                $remitente = $resultSet[$i]->IdEmpleado;
                    /* Cargar el jefe y nombre del empleado de la bd */
                    $sql2 = "select e.PNombre, e.PApellido, e.IdJefe, ej.correo from empleados e inner join empleados ej
                    on e.IdJefe = ej.IdEmpleado where e.IdEmpleado = ?";
                    $consult2 = $db->prepare($sql2);
                    $consult2->execute(array($remitente));
                    if($row = $consult2->fetch(PDO::FETCH_OBJ)){
                        $nombreDesti = $row->PNombre . " " . $row->PApellido;
                        $destinatario = $row->IdJefe;
                        $correo = $row->correo;
                    }

                    $Mensaje =  $nombreDesti . " tiene una solicitud de vacaciones pendiente. ( Enviado: " . $fechaActual .")." ;
                    $consult->execute(array($remitente, $destinatario, $Mensaje, 'Solicitud'));
            
    }

?>