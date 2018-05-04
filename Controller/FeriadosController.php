<?php
Class FeriadosController{
    public $obj, $obju, $model, $dias_cerrados;

    public function __construct(){
    include('Model/DAO/FeriadosDAO.php');
    include('Model/Entity/Feriados.php');
    include('Model/Entity/User.php');
    require('Model/DAO/LoadDAO.php');
    $this->obj = new Feriados();
    $this->obju = new User();
    $this->model = new FeriadosDAO();
    }

    public function index(){
        if(isset($_SESSION['nickname'])){
            require "View/Head.php";
            require "View/FeriadosView.php";
            require "View/Footer.php";
        }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}

    public function ListFeriados(){
        if(isset($_SESSION['nickname'])){
            header('Content-Type: application/json; charset=utf-8');
            $List = $this->model->ListFeriados();
            $var = json_encode($List);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function Addferiados(){
        if(isset($_SESSION['nickname'])){
            $this->obj->__SET('Nombre', $_REQUEST['des']);
            $this->obj->__SET('Fecha', $_REQUEST['fecha']);
            $this->model->Addferiados($this->obj);
            header('Location: index.php?c=Feriados');
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }

    public function DeleteFeriados(){
        if(isset($_SESSION['nickname'])){
            header('Content-Type: application/json; charset=utf-8');
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $_array = $this->model->DeleteFeriados($json_obj->id);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
            header('Location: index.php?c=Feriados');
        }else{
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }
}
?>