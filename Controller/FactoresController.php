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
            if(isset($_SESSION['nickname'])){
                require "View/Head.php";
                require "View/FactoresView.php";
                require "View/Footer.php";
            }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }

    public function ListFactores(){
        if(isset($_SESSION['nickname'])){
            header('Content-Type: application/json; charset=utf-8');
            $List = $this->model->ListFactores();
            $var = json_encode($List);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }



}
?>