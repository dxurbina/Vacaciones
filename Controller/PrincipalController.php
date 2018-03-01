<?php 
    class PrincipalController{
        private $conect;
        public function index(){
            include("View/Head.php");
            include("View/PrincipalView.php");
            include("View/Footer.php");
        }  
        public function AccessError(){
            include("View/Head.php");
            include("View/AccessErrorView.php");
            include("View/Footer.php");
         }    
    }
 ?>