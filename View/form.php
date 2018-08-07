<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<meta charset="utf-8" />
<?php include "./adminpanel/ewcfg7.php" ?>
<?php include "./adminpanel/ewmysql7.php" ?>
<?php include "./adminpanel/phpfn7.php" ?>
<?php include "./adminpanel/userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php
$conn = ew_Connect();
?>
<?php
$sqlgralconf="select * from general_settings";
$gralconf = $conn->Execute($sqlgralconf);
?>
<?php
require './mailer/PHPMailer/PHPMailerAutoload.php';
?>
<?php

$sql  = "select * from mail_settings";
$mailcfg = $conn->Execute($sql);

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = $mailcfg->fields('smtp_server');
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Host = $mailcfg->fields('smtp_server');
$mail->Port = $mailcfg->fields('smtp_port');
if($mailcfg->fields('smtp_auth')==1){
	$mail->SMTPAuth = true;
	$mail->Username = $mailcfg->fields('smtp_user');
	$mail->Password = $mailcfg->fields('smtp_pass');
}

$to = array();
$from  = "";
$template = "";
if($_POST['form']==1){
	$to = explode(",",$gralconf->fields('contact_mailto'));
	$from = $gralconf->fields('contact_from');
	$template = "contacto-sent.php";
}elseif($_POST['form']==2){
	$to = explode(",",$gralconf->fields('agent_mailto'));
	$from = $gralconf->fields('agent_from');
	$template = "agente-sent.php";
}elseif($_POST['form']==3){
	$to = explode(",",$gralconf->fields('subscribe_mailto'));
	$from = $gralconf->fields('subscribe_from');
	$template = "suscribase-sent.php";
}

$mail->setFrom($from, '');
$mail->addReplyTo($from, '');

$mailbody = file_get_contents($template);


//validaciones 
$error = 0;
if($_POST['form']==1){
	$subject ="Nuevo Contacto - Loto";
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
  	{
  		$error=1;
  	}
	
	if($_POST['nombres']=="" || strlen($_POST['nombres']) < 2){
		$error=1;
	}
	if($_POST['apellidos']=="" || strlen($_POST['apellidos']) < 2){
		$error=1;
	}
}elseif($_POST['form']==2){
	$subject ="Nueva Solicitud de Agente";
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
  	{
  		$error=1;
  	}
	
	if($_POST['nombres']=="" || strlen($_POST['nombres']) < 2){
		$error=1;
	}
	if($_POST['cedula']=="" || strlen($_POST['cedula']) < 5){
		$error=1;
	}
	if($_POST['negocio']=="" || strlen($_POST['negocio']) < 5){
		$error=1;
	}
	if($_POST['direccion1']=="" || strlen($_POST['direccion1']) < 5){
		$error=1;
	}
	if($_POST['matricula']=="" || strlen($_POST['matricula']) < 5){
		$error=1;
	}
	if($_POST['ruc']=="" || strlen($_POST['ruc']) < 4){
		$error=1;
	}
	if($_POST['cellphone']=="" || strlen($_POST['cellphone']) < 5){
		$error=1;
	}
	if($_POST['años-apertura']=="" || strlen($_POST['años-apertura']) < 1){
		$error=1;
	}
	if($_POST['dpto']=="" || strlen($_POST['dpto']) < 4){
		$error=1;
	}
	if($_POST['ciudad']=="" || strlen($_POST['ciudad']) < 4){
		$error=1;
	}
	if($_POST['tipo-negocio']=="" || strlen($_POST['tipo-negocio']) < 3){
		$error=1;
	}

	if($_POST['dias-atencion']=="" || strlen($_POST['dias-atencion']) < 3){
		$error=1;
	}

	if($_POST['servicio']=="" || strlen($_POST['servicio']) < 3){
		$error=1;
	}
}elseif($_POST['form']==3){
	$subject ="Nuevo Suscriptor - Loto";
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
  	{
  		$error=1;
  	}
	
	if($_POST['nombres']=="" || strlen($_POST['nombres']) < 2){
		$error=1;
	}
	if($_POST['apellidos']=="" || strlen($_POST['apellidos']) < 2){
		$error=1;
	}
}
$mail->Subject = $subject;
//captcha
if(strtolower($_SESSION['security_code1']) != strtolower($_POST['code'])){
	$error = 1;
}else{
	unset($_SESSION['security_code1']);
	unset($_POST['code']);
	//unset($_POST['form']);
}

if($error==1){
	$redirect = "";
	if(preg_match('/error/',$_SERVER['HTTP_REFERER'])){
		$redirect = $_SERVER['HTTP_REFERER'];
	}else{
		$redirect = $_SERVER['HTTP_REFERER']."?error=1";
	}
	header("Location: " .$redirect);
	exit;
}

if($_POST['form']==3){
	$sql= "insert into suscriptores (nombre,apellido,email,activo) values ('". ew_AdjustSql($_POST['nombres']) ."','". ew_AdjustSql($_POST['apellidos']) ."','". ew_AdjustSql($_POST['email']) ."',1)";
	$conn->Execute($sql);
	
	require_once('mc/mcapi.class.php');
	// grab an API Key from http://admin.mailchimp.com/account/api/
	$api = new MCAPI('333fa94bf19e852417c45c883cffcc7e-us8');
	
	// grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
	// Click the "settings" link for the list - the Unique Id is at the bottom of that page. 
	$list_id = "e7cc387c4d";
	if($api->listSubscribe($list_id, $_POST['email'], '')===true){
		//echo "exito!";
		//exit;
	}else{
		//echo "FALLO!";
		//exit;
	}
}
//body
$cuerpo = "";
foreach($_POST as $key => $value){
	$cuerpo .= "<strong>".$key ."</strong>: ". $value."<br />\n";
	$mailbody = str_replace("{". $key ."}", htmlentities($value,ENT_COMPAT,'UTF-8') ,$mailbody);
	//echo htmlentities($value,ENT_COMPAT,'UTF-8') ."<br/>\n<br/>\n<br/>\n";
}

$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
$mail->msgHTML($mailbody);
			

foreach($to as $key=>$value){
	///mail($value,$subject,$cuerpo,$headers);
	$mail->addAddress($value, '');
	$mail->send();
	$mail->clearAddresses();
}


//echo $mailbody;
header("Location: /gracias/");
?>