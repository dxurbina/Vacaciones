<?php 
class LoadController{
    public $Load, $var, $access;
    public function __construct(){
            include("Model/DAO/LoadDAO.php");
            Define("_USER", $_REQUEST['user']);
            define("_PASS", $_REQUEST['pass']);
            $this->Load = new LoadDAO();
    }

    public function load(){
        $tipo = $this->Load->LoadType();
        if(!($tipo == "incorrecto")){
            $this->access = $tipo;
            include("View/Head.php");
            include("View/PrincipalView.php");
            include("View/Footer.php");
        }else{
            $this->access = "incorrecto";
            include("View/Head.php");
            include("View/PrincipalView.php");
            include("View/Footer.php");
        }
    }
}
?>