<?php
include_once('includes.php');
session_start();
function toform($msg){
	echo "<script>
		alert('$msg'); 
		window.history.go(-1);
		</script>";
	exit;
}
	class Application{
		var $hdir;
		var $user;
		var $server;
		var $password;
		var $database;
		var $mysqli;
		var $models;
		var $urlbase;
		var $tipi_user;
		var $uploader;
		var $tipi_session;

		function __construct($server, $user, $password, $database
			, $urlbase, $hdir){
			$this->user = $user;
			$this->server = $server;
			$this->password = $password;
			$this->database = $database;
			$this->tables = array();
			$this->models = array();
			$this->urlbase = $urlbase;
			$this->hdir = $hdir;
			$this->uploader = new Uploader($this->urlbase);
		}

		function get_mailer(){
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = "mail.yourdomain.com";
			$mail->SMTPDebug = 0;
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure = "tls";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 587;
			$mail->Username = "alestermon@gmail.com";
			$mail->Password = "Ataru&ramu1987";
			$mail->SetFrom('name@yourdomain.com', 'First Last');
			$mail->AddReplyTo("name@yourdomain.com","First Last");
			$mail->AltBody    = "Para leer este mensaje use un visor HTML";
			return $mail;
		}

		function getSQLUser(){
			return $this->user;
		}

		function getConnection(){
			$res =  new mysqli($this->server, $this->user, $this->password
				, $this->database);
			echo "$this->server<br>";
			echo "$this->user<br>";
			echo "$this->password<br>";
			echo "$this->database<br>";
			echo "$res->error<br>";
			if ($res->connect_error){
				die("Could not create connection:" . $res->connect_errno);
			}
			return $res;
		}

		function create_default_instance_of($className){
			$res = $this->create_empty_instance_of($className);
			$res->init();
			return $res;
		}

		function getModelFor($className){
			$this->create_default_instance_of($className);
			return $this->models[$className];
		}

		function create_empty_instance_of($className){
			spl_autoload_register(function ($e) {
				$fbase =  strtolower ($e);
				require_once('model/' . $fbase . 'model.php');
				require_once("control/" . $fbase . ".php");
			});
			$res = new $className();
			if (!isset($this->models[$className])){
				$model_name = $className . "Model";
				$this->models[$className] = new $model_name();
				$this->models[$className]->set_application($this);
			}
			$res->model = $this->models[$className];
			return $res;
		}

		function beginSession(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$this->login($_POST["username"], $_POST["password"]);
			}
		}
		function login($username, $password){
			if ($this->tipi_user){
				return;
			}
			$usr = $this->getModelFor("user")->login($username, $password);
			if ($usr == null){
				toform("Usuario o contrasña inválidos");
				return null;
			}
			$session = $this->create_default_instance_of("userlog");
			$session->user_id = $usr->id;
			$session->end = null;
			$session->saveOrUpdate();
			$this->tipi_session = $session;
			return $usr;
		}

		function logout(){
			$this->tipi_user = null;
			if ($this->tipi_session){
				$this->tipi_session->end_session();
				$this->tipi_session->saveOrUpdate();
			}
			$this->tipi_session = null;
		}

		function send_confirmation_to($usr){
			$mail = $this->get_mailer();
			$template = new PHPTemplate("", "mail");
			$template->set_var("url", $this->create_confirmation_url($usr));
			$mail->AddAddress($usr->email, $usr->firstName 
				. " " . $usr->lastName);
			$mail->Body = $template->publish();
			return $mail->Send();
		}

		function create_confirmation_url($usr){
			$uname = $usr->userName;
			$t = time();
			return "${_SERVER['HTTP_HOST']}/tipi/confirm.php?user=$uname"
				. "&expires=$t";
		}

		function getUploader(){
			return $this->uploader;
		}
	};
	function getApplication(){
		if (isset($_SESSION["app"])){
			return $_SESSION["app"];
		}
		$app = new Application(MYSQLHOST, MYSQLUSER, MYSQPASSWORD, MYSQLDATABASE
			, URL, RDIR);
		$_SESSION["app"] = $app;
		return $app;
	}
	getApplication();
?>