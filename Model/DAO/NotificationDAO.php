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
        $sql = "insert into Notificaciones values(null, now(), ?, ?, ?, ?, 1, 1)";
        $consult = $this->db->prepare($sql);
        $remitente = $_SESSION['ID']->IdEmpleado;
            /* Cargar el jefe y nombre del empleado de la bd */
            $sql2 = "select e.PNombre, e.PApellido, e.IdJefe, ej.correo from Empleados e inner join Empleados ej
            on e.IdJefe = ej.IdEmpleado where e.IdEmpleado = ?";
            $consult2 = $this->db->prepare($sql2);
            $consult2->execute(array($remitente));
            if($row = $consult2->fetch(PDO::FETCH_OBJ)){
                $nombreDesti = $row->PNombre . " " . $row->PApellido;
                $destinatario = $row->IdJefe;
                $correo = $row->correo;
            }

            /* Cargar el destinatario por medio de la solicitud */
            $sql2 = "select e.PNombre, e.PApellido, v.IdEmpleado, e.correo from Vacaciones v inner join Empleados e on e.IdEmpleado = v.IdEmpleado
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
        /*
        $to = $correo;
        $subject = "Sistema Vacaciones";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= 'From: Your name <marxel98cisnero@gmail.com>' . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        
        $message = "
        <html>
        <head>
        <title>HTML</title>
        </head>
        <body>
        <h1>Mensaje de Informacion: </h1>
        <p>" . $Mensaje . " Visite el siguiente enlace: <a href='#'>Redireccionar</a></p>

        </body>
        </html>";
        
        mail($to, $subject, $message, $headers);
        */
        /* 
        require("libs/phpmailer/class.phpmailer.php");
        require("libs/phpmailer/class.smtp.php");
        $mail = new PHPMailer();

        //Luego tenemos que iniciar la validación por SMTP:
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.office365.com"; // A RELLENAR. Aquí pondremos el SMTP a utilizar. Por ej. mail.midominio.com
        $mail->Username = "dixon.urbina@loto.com.ni"; // A RELLENAR. Email de la cuenta de correo. ej.info@midominio.com La cuenta de correo debe ser creada previamente. 
        $mail->Password = "TrafalgarLawXD02"; // A RELLENAR. Aqui pondremos la contraseña de la cuenta de correo
       $mail->Port = 465; // Puerto de conexión al servidor de envio. 
        $mail->From = "dixon.urbina@loto.com.ni"; // A RELLENARDesde donde enviamos (Para mostrar). Puede ser el mismo que el email creado previamente.
        $mail->FromName = "Sistema Vacaciones"; //A RELLENAR Nombre a mostrar del remitente. 
        $mail->AddAddress("debianurbina@gmail.com"); // Esta es la dirección a donde enviamos 
        $mail->IsHTML(true); // El correo se envía como HTML 
        $mail->Subject = "Mensaje del sistema de Vacaciones"; // Este es el titulo del email. 
        $message = "
        <html>
        <head>
        <title>HTML</title>
        </head>
        <body>
        <h1>Mensaje de Informacion: </h1>
        <p>" . $Mensaje . " Visite el siguiente enlace: <a href='#'>Redireccionar</a></p>

        </body>
        </html>";

        $body = $message; 
        $body .= ""; 
        $mail->Body = $body; 
        // Mensaje a enviar. 
         $mail->Send(); // Envía el correo.
        $text =  $mail->ErrorInfo;
        echo $text;
     //   if($exito){ echo "El correo fue enviado correctamente."; }else{ echo "Hubo un problema. Contacta a un administrador."; } 
          //
*/
/*
          require("libs/phpmailer/PHPMailerAutoload.php");
          $mail = new PHPMailer(true);
          $mail->isSMTP();
          $mail->Host = 'smtp.office365.com';
          $mail->Port       = 587;
          $mail->SMTPSecure = 'tls';
          $mail->SMTPAuth   = true;
          $mail->Username = 'dixon.urbina@loto.com.ni';
          $mail->Password = 'TrafalgarLawXD02';
          $mail->SetFrom('dixon.urbina@loto.com.ni', 'Sistema Vacaciones');
          $mail->addAddress($correo, 'Colaborador');
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
                    <p>" . $Mensaje . " Visite el siguiente enlace: <a href='#'>Redireccionar</a></p>

                    </body>
                    </html>";
          $mail->Body    = $message;
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  
          $mail->send();
              */

          /*
          require("libs/phpmailer/PHPMailerAutoload.php");
          $mail = new PHPMailer(true);
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->Port       = 587;
          $mail->SMTPSecure = 'tls';
          $mail->SMTPAuth   = true;
          $mail->Username = 'lumberxd03@gmail.com';
          $mail->Password = '1234xd02';
          $mail->SetFrom('lumberxd03@gmail.com', 'FromEmail');
          $mail->addAddress('dixon.urbina@loto.com.ni', 'ToEmail');
          //$mail->SMTPDebug  = 3;
          //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
          $mail->IsHTML(true);
  
          $mail->Subject = 'Here is the subject';
          $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  
          $mail->send();
              */
            /*Lo primero es añadir al script la clase phpmailer desde la ubicación en que esté*/

            /*
            require 'libs/phpmailer/class.phpmailer.php';
            
            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();
            //Definir que vamos a usar SMTP
            $mail->IsSMTP();
            //Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
            // 0 = off (producción)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug  = 0;
            //Ahora definimos gmail como servidor que aloja nuestro SMTP
            $mail->Host       = 'smtp.gmail.com';
            //El puerto será el 587 ya que usamos encriptación TLS
            $mail->Port       = 587;
            //Definmos la seguridad como TLS
            $mail->SMTPSecure = 'tls';
            //Tenemos que usar gmail autenticados, así que esto a TRUE
            $mail->SMTPAuth   = true;
            //Definimos la cuenta que vamos a usar. Dirección completa de la misma
            $mail->Username   = "lumberxd03@gmail.com";
            //Introducimos nuestra contraseña de gmail
            $mail->Password   = "1234xd02";
            //Definimos el remitente (dirección y, opcionalmente, nombre)
            $mail->SetFrom('lumberxd03@gmail.com', 'Sistema');
            //Esta línea es por si queréis enviar copia a alguien (dirección y, opcionalmente, nombre)
          //  $mail->AddReplyTo('debianurbina@gmail.com','niem');
            //Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
            $mail->AddAddress('dxurbina1996@gmail.com', 'niem');
            //Definimos el tema del email
            $mail->Subject = 'Esto es un correo de prueba';
            //Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
            //$mail->Body = "cuerpo del mensaje";
           //$mail->MsgHTML(
              //  file_get_contents('AccesErrorView.html'), dirname('View')
               // 'This is the HTML message body <b>in bold!</b>'
          // );
            //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
            $mail->AltBody = 'This is a plain-text message body';
            //Enviamos el correo
            if(!$mail->Send()) {
            echo "Error: " . $mail->ErrorInfo;
            } else {
            echo "Enviado!";
            }*/
/*
            require('libs/phpmailer/class.phpmailer.php');
            $mail = new PHPMailer();
            //Definir que vamos a usar SMTP
            $mail->IsSMTP();
            //permite modo debug para ver mensajes de las cosas que van ocurriendo
            $mail­->SMTPDebug = 2;
            //Debo de hacer autenticación SMTP
            $mail­->SMTPAuth = true;
            $mail­->SMTPSecure = "ssl";
            //indico el servidor de Gmail para SMTP
            $mail­->Host = "smtp.gmail.com";
            //indico el puerto que usa Gmail
            $mail­->Port = 465;
            //indico un usuario / clave de un usuario de gmail
            $mail­->Username = "lumberxd03@gmail.com";
            $mail­->Password = "1234xd02";
            $mail­->SetFrom('lumberxd03@gmail.com', 'Nombre completo');
            //$mail->SetFrom('lumberxd03@gmail.com', 'Sistema');
            $mail­->AddReplyTo("lumberxd03@gmail.com","Nombre completo");
            $mail­->Subject = "Envío de email usando SMTP de Gmail";
            $mail­->MsgHTML("Hola que tal, esto es el cuerpo del mensaje!");
            //indico destinatario
            $address = "dxurbina1996@gmail.com";
            $mail­->AddAddress($address, "Nombre completo");
            if(!$mail-­>Send()) {
            echo "Error al enviar: " . $mail­>ErrorInfo;
            } else {
            echo "Mensaje enviado!";
            }
              */
          }
          
          

    public function show(){
        $resulSet = array();
        $sql = "select  n.Fecha, er.PNombre, er.PApellido, n.Mensaje, n.Tipo from Notificaciones n inner join Empleados e
        on n.IdDestinatario = e.IdEmpleado inner join Empleados er on n.IdRemitente = er.IdEmpleado
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
        $sql = "select  n.Fecha, er.PNombre, er.PApellido, n.Mensaje, n.Tipo from Notificaciones n inner join Empleados e
        on n.IdDestinatario = e.IdEmpleado inner join Empleados er on n.IdRemitente = er.IdEmpleado
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
        $sql = "update Notificaciones set Estado = 0 where IdDestinatario = ? and Estado = 1";
                $consult = $this->db->prepare($sql);
                $consult->execute(array($_SESSION['ID']->IdEmpleado));
    }
}
?>