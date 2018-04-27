<?php 
class CenterController{
    public $obj, $model;
    public function __construct(){
        include("Model/Entity/Center.php");
        include("Model/DAO/CenterDAO.php");
        $this->obj = new Center();
        $this->model = new CenterDAO();
    }
    public function index(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            include("View/Head.php");
            include("View/CenterView.php");
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
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
             # Get JSON as a string
            $json_str = file_get_contents('php://input');
           // $json_str = $_POST['id'];
            # Get as an object
            $json_obj = json_decode($json_str);
            $_array = $this->model->showById($json_obj->id);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }
    
}
?>