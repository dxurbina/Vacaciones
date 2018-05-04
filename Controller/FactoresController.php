<?php
Class FactoresController{
    public $obj, $obju, $model;

    public function __construct(){
        include('Model/DAO/FactoresDAO.php');
        include('Model/Entity/Factores.php');
        include('Model/Entity/User.php');
        require('Model/DAO/LoadDAO.php');
        $this->obj = new Factores();
        $this->obju = new User();
        $this->model = new FactoresDAO();
        }

        public function index(){
            if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
                require "View/Head.php";
                require "View/FactoresView.php";
                require "View/Footer.php";
            }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }

    public function ListFactores(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
            $List = $this->model->ListFactores();
            $var = json_encode($List);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function ListFactoresById(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $List = $this->model->ListFactoresById($json_obj->id);
            $var = json_encode($List);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function AddFactor(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            $this->obj->__SET('Nombre', $_REQUEST['des']);
            $this->obj->__SET('Factor', $_REQUEST['factor']);
            $this->model->AddFactor($this->obj);
            header('Location: index.php?c=Factores');
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }

    public function EditFactor(){
        if(isset($_SESSION['nickname'])){
            $this->obj->__SET('Nombre', $_REQUEST['des']);
            $this->obj->__SET('Factor', $_REQUEST['factor']);
            $this->obj->__SET('IdFactor', $_REQUEST['idFactor']);
            $this->model->EditFactor($this->obj);
            header('Location: index.php?c=Factores');
        }else {
         header('Location: index.php?c=Principal&a=AccessError');
        }
    }

        //Función de cancelar la solicitud de vacaciones
    public function DeleteFac(){
        if(isset($_SESSION['nickname'])){
           header('Content-Type: application/json; charset=utf-8');
           $json_str = file_get_contents('php://input');
           $json_obj = json_decode($json_str);
           $_array = $this->model->DeleteFac($json_obj->id);
           $var = json_encode( $_array);
           $json = json_last_error();
           echo $var; 
           header('Location: index.php?c=Factores');
        }else {
                header('Location: index.php?c=Principal&a=AccessError');
        }
    }
}
?>