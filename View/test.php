<?php 
    /*
    include "../libs/phpmailer/class.phpmailer.php";
    include "../libs/phpmailer/class.smtp.php";
    $email_user = "lumberxd03@gmail.com";
    $email_password = "1234xd02";
    $the_subject = "Phpmailer prueba by Evilnapsis.com";
    $address_to = "dxurbina1996@gmail.com";
    $from_name = "Evilnapsis";
    $phpmailer = new PHPMailer();
    // ---------- datos de la cuenta de Gmail -------------------------------
    $phpmailer->Username = $email_user;
    $phpmailer->Password = $email_password; 
    //-----------------------------------------------------------------------
    // $phpmailer->SMTPDebug = 1;
    $phpmailer->SMTPSecure = 'ssl';
    $phpmailer->Host = "smtp.gmail.com"; // GMail
    $phpmailer->Port = 465;
    $phpmailer->IsSMTP(); // use SMTP
    $phpmailer->SMTPAuth = true;
    $phpmailer->setFrom($phpmailer->Username,$from_name);
    $phpmailer->AddAddress($address_to); // recipients email
    $phpmailer->Subject = $the_subject;	
    $phpmailer->Body .="<h1 style='color:#3498db;'>Hola Mundo!</h1>";
    $phpmailer->Body .= "<p>Mensaje personalizado</p>";
    $phpmailer->Body .= "<p>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";
    $phpmailer->IsHTML(true);
    $phpmailer->Send();*/
/*
    require("../libs/phpmailer/PHPMailerAutoload.php");
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port       = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth   = true;
    $mail->Username = 'lumberxd03@gmail.com';
    $mail->Password = '1234xd02';
    $mail->SetFrom('lumberxd03@gmail.com', 'FromEmail');
    $mail->AddAddress('dxurbina1996@gmail.com', 'ToEmail');
    //$mail->SMTPDebug  = 3;
    //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
    $mail->IsHTML(true);

    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    */
/*
    require("../libs/phpmailer/PHPMailerAutoload.php");
    $mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = "smtp.office365.com";
			$mail->SMTPDebug = 0;
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure = "tls";
			$mail->Host = gethostbyname("smtp.office365.com");
			$mail->Port = 587;
			$mail->Username = "dixon.urbina@loto.com.ni";
			$mail->Password = "TrafalgarLawXD02";
			$mail->SetFrom('dixon.urbina@loto.com.ni', 'First Last');
			$mail->AddReplyTo("dixon.urbina@loto.com.ni","First Last");
			$mail->AltBody    = "Para leer este mensaje use un visor HTML";
			
			$mail->SMTPOptions = array('ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
                        'allow_self_signed' => true));
                        
                        $msg =
                        "Para activar su cuenta ingrese a ";
                        $mail->Body = $msg;
                       // $mail = Mailer::createEmail($msg);
                        $mail->AddAddress('dxurbina1996@gmail.com', 'XD');
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        if (!$mail->send()) {
                            throw new Exception($mail->ErrorInfo);
                        }
*/
 /*                       
ini_set("SMTP","mail.cantv.net");
ini_set("smtp_port", 25);
ini_set("sendmail_from","lumberxd03@gmail.com");
$correo = "lumberxd03@gmail.com";
$correo2 = "dxurbina1996@gmail.com";
$asunto = "Envio e-mails";
$cuerpo = "Por fin FUNCIONO!!!!";
mail($correo,$asunto,$cuerpo,$correo2);*/
/*
    include("../libs/phpmailer/PHPMailerAutoload.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->Host = "smtp.live.com";
    $mail->SMTPAuth= true;
    $mail->Port = 587;
    $mail->Username= "steffanie@hotmail.com";
    $mail->Password= "L12345678.";
    $mail->SMTPSecure = 'tls';
    $mail->From = "steffanie@hotmail.com";
    $mail->FromName= "steffanie@hotmail.com";
    $mail->isHTML(true);
    $mail->Subject = "subject";
    $mail->Body = "mensaje";
    $mail->addAddress("dxurbina1996@gmail.com");*/
    date_default_timezone_set('America/Managua');
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $fechaActual = (string) date('Y-m-d');
        
        $fechaActual = strftime("%d de %B del %Y", strtotime($fechaActual));
        $destinatario;
        $nombreDesti;
        $correo;
        $fecha;
        $db = null;
        try{      
           
            $db = new PDO('mysql:host=localhost;dbname=Vacaciones;charset=utf8mb4', 'root', 'LumberXD02',
                array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' "));
        } catch (PDOException $e) {
            echo "se jodiò";
        }
       // $sql = "insert into Notificaciones values(null, now(), ?, ?, ?, ?, 1)";
       // $consult = $this->db->prepare($sql);
       // $remitente = $_SESSION['ID']->IdEmpleado;
            /* Cargar el jefe y nombre del empleado de la bd */
            $sql = "select e.PNombre, e.PApellido, e.IdJefe, ej.correo, n.Tipo from Empleados e inner join Empleados ej
            on e.IdJefe = ej.IdEmpleado inner join Notificaciones n on n.IdRemitente = e.IdEmpleado
            where n.Tipo = 'Solicitud' and n.Estado = 1 and n.EstadoMail = 1;";
            $resulSet = array();
            $consult = $db->prepare($sql);
            $consult->execute();
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                   
                }
               

            /* Cargar el destinatario por medio de la solicitud */
            $sql2 = "select e.PNombre, e.PApellido, e.IdJefe, e.correo, n.Tipo from Empleados e inner join Empleados ej
            on e.IdJefe = ej.IdEmpleado inner join Notificaciones n on n.IdRemitente = e.IdEmpleado
            where n.Tipo = 'Respuesta' and n.Estado = 1 and n.EstadoMail = 1;";
            $resultSet2 = array();
            $consult2 = $db->prepare($sql2);
            $consult2->execute();
            while( $row = $consult2->fetchAll(PDO::FETCH_OBJ)){
                $resultSet2 = $row; 
               
            }

        $mensajeR = array();
      
      for($i = 0 ; $i < count($resultSet2); $i++){
       if($resultSet2[$i]->Tipo == 'Respuesta'){
            $nombreDesti = $resultSet2[$i]->PNombre . " " . $resultSet2[$i]->PApellido;
            
            $MensajeR[$i] =  $nombreDesti . " Respondió tu solicitud de vacaciones( Enviado: " . $fechaActual .").";
        }
      }
      $mensajeS  = array(); 
    for($i = 0 ;  $i < count($resulSet); $i++){
        if($resultSet[$i]->Tipo == "Solicitud"){
            $nombreDesti = $resultSet[$i]->PNombre . " " . $resultSet[$i]->PApellido;
            $MensajeS[$i] =  $nombreDesti . " está solicitando vacaciones. ( Enviado: " . $fechaActual .")." ;
        // $consult->execute(array($remitente, $destinatario, $Mensaje, 'Solicitud'));
            }
    }
        


    require("../libs/phpmailer/PHPMailerAutoload.php");
    for($i = 0; $i < count($resulSet); $i ++){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->Port       = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth   = true;
        $mail->Username = 'dixon.urbina@loto.com.ni';
        $mail->Password = 'TrafalgarLawXD02';
        $mail->SetFrom('dixon.urbina@loto.com.ni', 'Sistema Vacaciones');
        $mail->addAddress($resultSet[$i]->correo, 'Colaborador');
        //$mail->SMTPDebug  = 3;
        //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
        $mail->IsHTML(true);

        $mail->Subject = 'Mensaje del sistema de Vacaciones';
        $message = "
                <html>
                <head>
                <title>HTML</title>
                </head>
                <body>
                <h1>Mensaje de Informacion: </h1>
                <p>" . $MensajeS[$i] . " Visite el siguiente enlace: <a href='#'>Redireccionar</a></p>
                </body>
                </html>";
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    }
    
    for($i = 0; $i < count($resultSet2); $i ++){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->Port       = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth   = true;
        $mail->Username = 'dixon.urbina@loto.com.ni';
        $mail->Password = 'TrafalgarLawXD02';
        $mail->SetFrom('dixon.urbina@loto.com.ni', 'Sistema Vacaciones');
        $mail->addAddress($resultSet2[$i]->correo, 'Colaborador');
        //$mail->SMTPDebug  = 3;
        //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
        $mail->IsHTML(true);

        $mail->Subject = 'Mensaje del sistema de Vacaciones';
        $message = "
                <html>
                <head>
                <title>HTML</title>
                </head>
                <body>
                <h1>Mensaje de Informacion: </h1>
                <p>" . $MensajeR[$i] . " Visite el siguiente enlace: <a href='#'>Redireccionar</a></p>
                </body>
                </html>";
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    }

    $sql = "update Notificaciones set EstadoMail = 0 
            where EstadoMail = 1;";
            $consult = $db->prepare($sql);
            $consult->execute();

?>