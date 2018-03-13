<?php 
ini_set('display_errors', 1);
class LoadController{
    public $Load, $var, $access, $flag = false, $obj;
    public function __construct(){
            include("Model/DAO/LoadDAO.php");
            include("Model/Entity/Empleado.php");
            $this->obj = new Empleado();
            $this->Load = new LoadDAO();
            if(isset($_REQUEST['user'])){
                $this->obj->__SET('user', $_REQUEST['user']);
                $this->obj->__SET('pass', $_REQUEST['pass']);
            }
            
    }

    public function load(){
        $this->flag = $this->Load->login($this->obj);
        if($this->flag == true || (isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5)){
            $this->Load->LoadType($this->obj);
            header('Location: index.php?c=Principal');

           // include("View/Head.php");
            //include("View/PrincipalView.php");
            //include("View/Footer.php");
        
        } else {
            header('Location: index.php?c=Principal');
           // include("View/Head.php");
            //include("View/PrincipalView.php");
            //include("View/Footer.php");
        }

        
    }

    public function close(){
    if(isset($_SESSION['nickname'])){
                session_unset();
        }
        header('Location: index.php?c=Principal');
    }
}
?>