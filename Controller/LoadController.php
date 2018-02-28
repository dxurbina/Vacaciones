<?php 
class LoadController{
    public $Load, $var, $access, $flag = false, $obj;
    public function __construct(){
            include("Model/DAO/LoadDAO.php");
            include("Model/Entity/Empleado.php");
            $this->obj = new Empleado();
            $this->Load = new LoadDAO();
            $this->obj->__SET('user', $_REQUEST['user']);
            $this->obj->__SET('pass', $_REQUEST['pass']);
            $this->userP = $_REQUEST['user'];
            $this->passP = $_REQUEST['pass'];
    }

    public function load(){
        $this->flag = $this->Load->login($this->obj);
        
        if($this->flag == true){


            $this->Load->LoadType($this->obj);
            include("View/Head.php");
            include("View/PrincipalView.php");
            include("View/Footer.php");
        
        } else {
            include("View/Head.php");
            include("View/PrincipalView.php");
            include("View/Footer.php");
        }

        
    }
}
?>