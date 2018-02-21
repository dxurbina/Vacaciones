<?php 
class LoadController{

    public function __construct(){
            include("UserController.php");
            Define("_USER", $_REQUEST('user'));
            define("_PASS", $_REQUEST('pass'));  
            
    }

    public function load(){

    }
}
?>