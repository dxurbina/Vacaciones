<?php

Class SaldoColaboradoresController{
    public $obj, $obju, $model, $factor1;

    public function __construct(){
    include('Model/DAO/SaldoColaboradoresDAO.php');
    include('Model/Entity/SaldoVacaciones.php');
    include('Model/Entity/User.php');
    require('Model/DAO/LoadDAO.php');
    include('Model/DAO/FactoresDAO.php'); //Agregado 30/07/2018 1:29pm
    include('Model/Entity/Vacation.php'); //Agregado 31/07/2018 9:21am
    $this->obj = new SaldoVacaciones();
    $this->obju = new User();
    $this->model = new SaldoColaboradoresDAO();
    $this->modelfe = new FactoresDAO(); //Agregado 30/07/2018 1:29pm
    
}

    public function index(){
        if(isset($_SESSION['nickname'])){
            include("View/Head.php");
            include("View/SaldoColaboradoresView.php");
            //$this->factor1;
            include("View/Footer.php");
        }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}

//Lista para traer el factor de un empleado en específico.
public function listFacByEmp(){
    if(isset($_SESSION['nickname'])){
        header('Content-Type: application/json; charset=utf-8');
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str);
        $datos = $this->modelfe->listFacByEmp($json_obj->id);
        $factor1 = json_encode( $datos);
        echo $factor1;
        //include("View/SaldoColaboradoresView.php");
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