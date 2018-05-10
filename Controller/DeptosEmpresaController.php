<?php
Class DeptosEmpresaController{
    public $obj, $obju, $model;

    public function __construct(){
        include('Model/DAO/DeptosEmpresaDAO.php');
        include('Model/Entity/DeptosEmpresa.php');
        include('Model/Entity/User.php');
        require('Model/DAO/LoadDAO.php');
        $this->obj = new DeptosEmpresa();
        $this->obju = new User();
        $this->model = new DeptosEmpresaDAO();
        }

        public function index(){
            if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
                require "View/Head.php";
                require "View/DeptosEmpresaView.php";
                require "View/Footer.php";
            }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }

    public function ListDeptosEmpresa(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
            $List = $this->model->ListDeptosEmpresa();
            $var = json_encode($List);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function ListDeptosEmpresaById(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $List = $this->model->ListDeptosEmpresaById($json_obj->id);
            $var = json_encode($List);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function AddDeptosEmpresa(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            $this->obj->__SET('Nombre', $_REQUEST['nombre']);
            $this->obj->__SET('Descripcion', $_REQUEST['des']);
            $this->model->AddDeptosEmpresa($this->obj);
            header('Location: index.php?c=DeptosEmpresa');
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }

    /*public function EditDeptoEmp(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            $this->obj->__SET('Nombre', $_REQUEST['nombre']);
            $this->obj->__SET('Descripcion', $_REQUEST['des']);
            $this->obj->__SET('IdDep', $_REQUEST['idDepEmpresa']);
            $List = $this->model->EditDeptoEmp($this->obj);
            header('Location: index.php?c=DeptosEmpresa');
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }*/

    public function EditDeptoEmp(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $this->obj->__SET('Nombre', $json_obj->Nombre);
            $this->obj->__SET('Descripcion', $json_obj->Descripcion);
            $this->obj->__SET('IdDep',$json_obj->IdDep);
            $_array = $this->model->EditDeptoEmp($this->obj);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function DeleteDeptosEmpresa(){
        if(isset($_SESSION['nickname'])){
           header('Content-Type: application/json; charset=utf-8');
           $json_str = file_get_contents('php://input');
           $json_obj = json_decode($json_str);
           $_array = $this->model->DeleteDeptosEmpresa($json_obj->id);
           $var = json_encode( $_array);
           $json = json_last_error();
           echo $var; 
           header('Location: index.php?c=DeptosEmpresa');
        }else{
               header('Location: index.php?c=Principal&a=AccessError');
             }
    }

    public function GetPosition(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $_array = $this->model->GetPosition($json_obj->Nombre);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

}
?>