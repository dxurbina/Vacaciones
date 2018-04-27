<?php 
class PositionController{
    public $obj, $model;
    public function __construct(){
        include("Model/Entity/Position.php");
        include("Model/DAO/PositionDAO.php");
        $this->obj = new Position();
        $this->model = new PositionDAO();
    }
    public function index(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            include("View/Head.php");
            include("View/PositionView.php");
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