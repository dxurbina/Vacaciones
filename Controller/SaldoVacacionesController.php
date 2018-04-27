<?php
//session_start();

Class SaldoVacacionesController{
    public $obj, $obju, $model, $emp,$IdEmp, $factor;

    public function __construct(){
    include('Model/DAO/SaldoVacacionesDAO.php');
    include('Model/Entity/SaldoVacaciones.php');
    include('Model/Entity/User.php');
    require('Model/DAO/LoadDAO.php');
    include('Model/DAO/FactorDAO.php');  //Lo acabo de agregar, esto esta en VacacionesController
    $this->obj = new SaldoVacaciones();
    $this->obju = new User();
    $this->model = new SaldoVacacionesDAO();
    $this->modelf= new FactorDAO();  //Lo acabo de agregar, esto esta en VacacionesController
}

    public function index(){
        if(isset($_SESSION['nickname'])){
            $this->emp = $this->model->SaldoVacaciones();
            $this->factor = $this->modelf->show();  //Lo acabo de agregar, esto esta en VacacionesController
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






































    public function indexHistory(){
        require('View/Head.php');
        require('View/BalanceHistoryView.php');
        require('View/Footer.php');
    }

    public function ShowHistory(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        header('Content-Type: application/json; charset=utf-8');
        $datos = $this->model->ShowHistory();
        $this->var = json_encode( $datos);
        echo $this->var;
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }
}
?>