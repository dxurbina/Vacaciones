<?php 
class VacacionesController{
    public $model;
    public function __construct(){
        include 'Model/DAO/VacationDAO.php';
        $this->model = new VacationDAO();
    }

    public function index(){
        require "View/Head.php";
        require "View/VacacionesView.php";
        require "View/Footer.php";
    }
    
    public function requests(){
        require "View/Head.php";
        require "View/RequestsView.php";
        require "View/Footer.php";
    }
    public function store(){

    }
    public function update(){

    }

    public function showAll(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        
            header('Content-Type: application/json; charset=utf-8');
            $List = $this->model->showAll();
            //$var = json_encode(array_map('utf8_encode', $cursos));
            # unset($cursos[5]);
            $var = json_encode($List);
            $json = json_last_error();
           // $var2 = utf8_converter($cursos);
            
           # echo $json; #esta era la wea que lo jodia hace rato
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

}
?>