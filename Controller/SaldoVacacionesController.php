<?php
//session_start();

Class SaldoVacacionesController{
    public $obj, $obju, $model, $emp, $IdEmp;

    public function __construct(){
    include('Model/DAO/SaldoVacacionesDAO.php');
    include('Model/Entity/SaldoVacaciones.php');
    include('Model/Entity/User.php');
    require('Model/DAO/LoadDAO.php');
    $this->obj = new SaldoVacaciones();
    $this->obju = new User();
    $this->model = new SaldoVacacionesDAO();
}

    public function index(){
        if(isset($_SESSION['nickname'])){
            $this->emp = $this->model->SaldoVacaciones();
            include("View/Head.php");
            include("View/SaldoVacacionesView.php");
            include("View/Footer.php");
        }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}

public function SaldoVacacionesbyId(){
        if(isset($_SESSION['nickname'])){
        header('Content-Type: application/json; charset=utf-8');
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str);
        $datos = $this->model->SaldoVacaciones($json_obj->id);
        $this->var = json_encode( $datos);
        echo $this->var;
    }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }

}

public function HistVac(){
    if(isset($_SESSION['nickname'])){
    
        header('Content-Type: application/json; charset=utf-8');
        $List = $this->model->HistVac();
        $var = json_encode($List);
        $json = json_last_error();
        echo $var; 
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
}
    
}
?>