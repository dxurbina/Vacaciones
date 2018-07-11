<?php

Class SaldoColaboradoresController{
    public $obj, $obju, $model;

    public function __construct(){
    include('Model/DAO/SaldoColaboradoresDAO.php');
    include('Model/Entity/SaldoVacaciones.php');
    include('Model/Entity/User.php');
    require('Model/DAO/LoadDAO.php');
    $this->obj = new SaldoVacaciones();
    $this->obju = new User();
    $this->model = new SaldoColaboradoresDAO();
}

    public function index(){
        if(isset($_SESSION['nickname'])){
            include("View/Head.php");
            include("View/SaldoColaboradoresView.php");
            include("View/Footer.php");
        }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}

//Lista para traer los saldos de vacaciones de todos los empleados.
public function SaldoColaboradores(){
    if(isset($_SESSION['nickname'])){
        header('Content-Type: application/json; charset=utf-8');
        $List = $this->model->SaldoColaboradores();
        $var = json_encode($List);
        $json = json_last_error();
        echo $var; 
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
}

    public function deduce(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            $cant = $_REQUEST['CantDias'];
            $this->model->deduce($cant);
            header('Location: index.php?c=SaldoColaboradores&a=index');

             }else {
                 header('Location: index.php?c=Principal&a=AccessError');
             }
    }

    public function increase(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            $cant = $_REQUEST['CantDias_1'];
            $this->model->increase($cant);
            header('Location: index.php?c=SaldoColaboradores&a=index');

             }else {
                 header('Location: index.php?c=Principal&a=AccessError');
             }
    }

}
?>