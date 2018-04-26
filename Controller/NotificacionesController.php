<?php 
    class NotificacionesController{
        public $obj, $model;
        public function __construct(){
            include 'Model/DAO/NotificationDAO.php';
            $this->model = new NotificationDAO();
        }


        public function show(){
            if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5 || $_SESSION['access'] == 2 || $_SESSION['access'] == 1){
        
                header('Content-Type: application/json; charset=utf-8');
                $_array = $this->model->show();
                $var = json_encode($_array);
               //$json = json_last_error();
                echo $var; 
                }else {
                    header('Location: index.php?c=Principal&a=AccessError');
                }
        }

        public function showAll(){
            if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5 || $_SESSION['access'] == 2 || $_SESSION['access'] == 1){
        
                header('Content-Type: application/json; charset=utf-8');
                $_array = $this->model->showAll();
                $var = json_encode($_array);
               //$json = json_last_error();
                echo $var; 
                }else {
                    header('Location: index.php?c=Principal&a=AccessError');
                }
        }

        public function destroy(){
            if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5 || $_SESSION['access'] == 2 || $_SESSION['access'] == 1){
        
                header('Content-Type: application/json; charset=utf-8');
                $_array = $this->model->destroy();
                $var = json_encode($_array);
               //$json = json_last_error();
                echo $var; 
                }else {
                    header('Location: index.php?c=Principal&a=AccessError');
                }
        }
    }
?>