<?php
Class HisVacColaboradoresController{
    public $model, $var;
    public function __construct(){
        include("Model/DAO/HisVacColaboradoresDAO.php");
        $this->model = new HisVacColaboradoresDAO();
    }

    public function index(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
                include("View/Head.php");
                include("View/HistVacacionesColaboradores.php");
                include("View/Footer.php");
            }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }

    /*public function GenerarReporte(){
        if(isset($_SESSION['nickname'])and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
                $originalDate = $_REQUEST['Fecha1'];
                //$DateI = date("Y-m-d", strtotime($originalDate));
                $originalDate = ltrim($originalDate);
                $originalDate = rtrim($originalDate);
                $nums = explode('/', $originalDate);
                $dateI = $nums[2] . "-" . $nums[1] . "-" . $nums[0];
                $originalDate = $_REQUEST['Fecha2'];
                $originalDate = ltrim($originalDate);
                $originalDate = rtrim($originalDate);
                $nums = explode('/', $originalDate);
                $dateF = $nums[2] . "-" . $nums[1] . "-" . $nums[0];
                $List = $this->model->GenerarReporte($dateI, $dateF);
            $var = json_encode($List);
            $json = json_last_error();
            echo $var; 
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }*/

    public function GenerarReporte(){
        if(isset($_SESSION['nickname'])){
            header('Content-Type: application/json; charset=utf-8');
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $originalDate = $json_obj->Fecha1;
            //$DateI = date("Y-m-d", strtotime($originalDate));
            $originalDate = ltrim($originalDate);
            $originalDate = rtrim($originalDate);
            $nums = explode('/', $originalDate);
            $Fecha1 = $nums[2] . "-" . $nums[1] . "-" . $nums[0];
            $originalDate = $json_obj->Fecha2;
            $originalDate = ltrim($originalDate);
            $originalDate = rtrim($originalDate);
            $nums = explode('/', $originalDate);
            $Fecha2 = $nums[2] . "-" . $nums[1] . "-" . $nums[0];
            $_array = $this->model->GenerarReporte($Fecha1, $Fecha2);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }

    public function CargarEmpleados(){
        if(isset($_SESSION['nickname'])){
            header('Content-Type: application/json; charset=utf-8');
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            //$datos = $this->model->CargarEmpleados();
            $this->Lista = json_encode( $var);
            echo $this->Lista;
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }
}
?>