<?php 
class VacacionesController{
    public $model, $obj;
    public function __construct(){
        include('Model/DAO/FactorDAO.php');
        //include('Model/Entity/Vacation.php');
        //$this->obj = new Vacation();
        $this->model = new FactorDAO();
    }

    public function index(){
        if(isset($_SESSION['nickname'])){
        require "View/Head.php";
        require "View/VacacionesView.php";
        require "View/Footer.php";
        }else{
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }
    
    public function requests(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        require "View/Head.php";
        require "View/RequestsView.php";
        require "View/Footer.php";
    }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
    }

    public function store(){
        if(isset($_SESSION['nickname'])){
            $this->obj->__SET('Tipo', $_REQUEST['Tipo']);
            $this->obj->__SET('CantDias', $_REQUEST['CantDias']);
            $this->obj->__SET('FechaI', $_REQUEST['FechaI']);
            if(isset($_REQUEST['Add'])){
                $this->obj->__SET('FechaF', $_REQUEST['FechaF']);
            }else{
            $this->obj->__SET('FechaF', $_REQUEST['FechaF2']);
            }
            $this->obj->__SET('Descripcion', $_REQUEST['Descripcion']);
            $this->model->store($this->obj);
            header('Location: index.php?c=Vacaciones');
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }

    }
    public function update(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        
            header('Content-Type: application/json; charset=utf-8');
             # Get JSON as a string
            $json_str = file_get_contents('php://input');
           // $json_str = $_POST['id'];
            # Get as an object
            $json_obj = json_decode($json_str);
            $_array = $this->model->update($json_obj->id, $json_obj->Estado);
            //$var = json_encode(array_map('utf8_encode', $cursos));
            # unset($cursos[5]);
            $var = json_encode( $_array);
            $json = json_last_error();
           // $var2 = utf8_converter($cursos);
            
           # echo $json; #esta era la wea que lo jodia hace rato
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function show(){
        if(isset($_SESSION['nickname'])){

        }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
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