<?php 
    class PrincipalController{
        private $conect;
        public function index(){
            
            if(isset($_SESSION['nickname']) and isset($_SESSION['ID'])){
                include("View/Head.php");
                include("View/inicio.php");
                include("View/Footer.php");
            }else{
                
                include("View/PrincipalView.php");
                //include("View/Footer.php");
            }
        }  
        public function AccessError(){
        
            include("View/AccessErrorView.php");
            
         }   
         
    }
 ?>