<?php

Class EmpleadosInactivosController{
    public $obj, $obju, $model;

    public function __construct(){
    include('Model/DAO/EmpleadosInactivosDAO.php');
    include('Model/Entity/Empleado.php');
    include('Model/Entity/User.php');
    require('Model/DAO/LoadDAO.php');
    $this->obj = new Empleado();
    $this->obju = new User();
    $this->model = new EmpleadosInactivosDAO();
}

    public function index(){
        if(isset($_SESSION['nickname'])){
            include("View/Head.php");
            include("View/EmpleadosInactivosView.php");
            include("View/Footer.php");
        }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}

//Lista para traer los empleados inactivos.
public function EmpleadosInactivos(){
    if(isset($_SESSION['nickname'])){
        header('Content-Type: application/json; charset=utf-8');
        $List = $this->model->EmpleadosInactivos();
        $var = json_encode($List);
        $json = json_last_error();
        echo $var; 
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
}

}
?>