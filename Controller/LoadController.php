<?php 
class LoadController{
    public function __construct(){
            include("UserController.php");
            include("Model/Entity/Conect.php");
            $conect = new Conect();
            $conect->__SET('user', $_REQUEST('user'));
            $conect->__SET('pass', $_REQUEST('pass'));
            Define("_USER", $_REQUEST('user'));
            define("_PASS", $_REQUEST('pass'));
    }

    public function load(){}
}
?>