<?php 
class DeparmentController{
    public $obj, $model;
    public function __construct(){
        include("Model/Entity/Deparment.php");
        include("Model/DAO/DeparmentDAO.php");
        $this->obj = new Deparment();
        $this->model = new DeparmentDAO();
    }
    public function index(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            include("View/Head.php");
            include("View/DeparmentView.php");
            include("View/Footer.php");
        }
    }

    public function store(){

    }

    public function update(){
        
    }

    public function destroy(){

    }

    public function showAll(){

    }

    public function showById(){

    }
    
}
?>