<?php 
class VacacionesController{
    public $model, $modelNotif, $obj,  $objNotif, $factor,  $modelFe;
    public function __construct(){
        include('Model/DAO/VacationDAO.php');
        include('Model/DAO/NotificationDAO.php');
        include('Model/Entity/Vacation.php');
        include('Model/DAO/FeriadosDAO.php'); //Agregado 18-04-2018 3:06pm
        include('Model/Entity/Notificaciones.php');
        $this->obj = new Vacation();
        $this->model = new VacationDAO();
        $this->modelFe = new FeriadosDAO(); //Agregado 18-04-2018 3:06pm
        $this->modelNotif = new NotificationDAO();
    }

    public function index(){
        if(isset($_SESSION['nickname'])){
        include('Model/DAO/FactorDAO.php');
        $modelf = new FactoresDAO();
        $this->factor = $modelf->show();
        require "View/Head.php";
        require "View/VacacionesView.php";
        require "View/Footer.php";
        }else{
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }
    
    public function requests(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        require "View/Head.php";
        require "View/RequestsView.php";
        require "View/Footer.php";
    }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
    }
       //Funciona correctamente 08-05-18 3:05 pm
    /*public function store(){
        if(isset($_SESSION['nickname'])){
         $this->obj->__SET('Tipo', $_REQUEST['Tipo']);
            $this->obj->__SET('CantDias', $_REQUEST['CantDias']);
            $originalDate = $_REQUEST['FechaI'];
            $originalDate = ltrim($originalDate);
            $originalDate = rtrim($originalDate);
            $nums = explode('/', $originalDate);
            $this->obj->__SET('FechaI', $nums[2] . "-" . $nums[1] . "-" . $nums[0]);
            $originalDate = $_REQUEST['FechaF'];
            $originalDate = ltrim($originalDate);
            $originalDate = rtrim($originalDate);
            $nums = explode('/', $originalDate);
            $this->obj->__SET('FechaF', $nums[2] . "-" . $nums[1] . "-" . $nums[0]);
            $this->obj->__SET('Descripcion', $_REQUEST['Descripcion']);
            $this->model->store($this->obj, $this->obj->FechaI, $this->obj->FechaF);
            $estado = "Solicitud";
            $this->modelNotif->store(null, $estado);
            header('Location: index.php?c=SaldoVacaciones');
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }*/


 public function store(){
    if(isset($_SESSION['nickname'])){
     $this->obj->__SET('Tipo', $_REQUEST['Tipo']);
        $this->obj->__SET('CantDias', $_REQUEST['CantDias']);
        $originalDate = $_REQUEST['FechaI'];
        $originalDate = ltrim($originalDate);
        $originalDate = rtrim($originalDate);
        $nums = explode('/', $originalDate);
        $this->obj->__SET('FechaI', $nums[2] . "-" . $nums[1] . "-" . $nums[0]);
        $originalDate = $_REQUEST['FechaF'];
        $originalDate = ltrim($originalDate);
        $originalDate = rtrim($originalDate);
        $nums = explode('/', $originalDate);
        $this->obj->__SET('FechaF', $nums[2] . "-" . $nums[1] . "-" . $nums[0]);
        $this->obj->__SET('Descripcion', $_REQUEST['Descripcion']);
        $this->model->store($this->obj, $this->obj->FechaI, $this->obj->FechaF, $this->obj->CantDias);
        $estado = "Solicitud";
        $this->modelNotif->store(null, $estado);
        header('Location: index.php?c=SaldoVacaciones');
    }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}
    
    public function update(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        
            header('Content-Type: application/json; charset=utf-8');
             # Get JSON as a string
            $json_str = file_get_contents('php://input');
           // $json_str = $_POST['id'];
            # Get as an object
            $json_obj = json_decode($json_str);
            $_array = $this->model->update($json_obj->id, $json_obj->Estado);
            $this->modelNotif->store($json_obj->id, $json_obj->Estado);
            //$var = json_encode(array_map('utf8_encode', $cursos));
            # unset($cursos[5]);
            $var = json_encode( $_array);
            $json = json_last_error();
           // $var2 = utf8_converter($cursos);
            
           # echo $json; #esta era la wea que lo jodia hace rato
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function showAll(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        
            header('Content-Type: application/json; charset=utf-8');
            $List = $this->model->showAll();
            $var = json_encode($List);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function showById(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        
            header('Content-Type: application/json; charset=utf-8');
             # Get JSON as a string
            $json_str = file_get_contents('php://input');
           // $json_str = $_POST['id'];
            # Get as an object
            $json_obj = json_decode($json_str);
            $_array = $this->model->showById($json_obj->id);
            # unset($cursos[5]);
            $var = json_encode( $_array);
            $json = json_last_error();
           // $var2 = utf8_converter($cursos);
            
           # echo $json; #esta era la wea que lo jodia hace rato
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function showHistory(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
            $List = $this->model->showhistory();
            //$var = json_encode(array_map('utf8_encode', $cursos));
            # unset($cursos[5]);
            $var = json_encode($List);
            $json = json_last_error();
           // $var2 = utf8_converter($cursos);
            
           # echo $json; #esta era la wea que lo jodia hace rato
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function ListSolicitudById(){
    
        if(isset($_SESSION['nickname'])){
            header('Content-Type: application/json; charset=utf-8');
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $datos = $this->model->ListSolicitudById($json_obj->id);
            $var = json_encode( $datos);
            echo $var;
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }

public function EditSolicitud(){ //ESTA FUNCIONA 3/05/18 3:30
    if(isset($_SESSION['nickname'])){
     $this->obj->__SET('Tipo', $_REQUEST['Tipo']);
        $this->obj->__SET('CantDias', $_REQUEST['CantDias']);
        $originalDate = $_REQUEST['FechaI'];
        $originalDate = ltrim($originalDate);
        $originalDate = rtrim($originalDate);
        $nums = explode('/', $originalDate);
        $this->obj->__SET('FechaI', $nums[2] . "-" . $nums[1] . "-" . $nums[0]);
        $originalDate = $_REQUEST['FechaF'];
        $originalDate = ltrim($originalDate);
        $originalDate = rtrim($originalDate);
        $nums = explode('/', $originalDate);
        $this->obj->__SET('FechaF', $nums[2] . "-" . $nums[1] . "-" . $nums[0]);
        $this->obj->__SET('Descripcion', $_REQUEST['Descripcion']);
        $this->obj->__SET('IdVac', $_REQUEST['idVacaciones']);
        //$this->model->EditSolicitud($this->obj, $this->obj->FechaI, $this->obj->FechaF);
        $this->model->EditSolicitud($this->obj, $this->obj->FechaI, $this->obj->FechaF, $this->obj->CantDias);
        $estado = "Solicitud";
        $this->modelNotif->store(null, $estado);
        header('Location: index.php?c=SaldoVacaciones');
    }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}


/*public function EditSolicitud(){
    if(isset($_SESSION['nickname'])){
     $this->obj->__SET('Tipo', $_REQUEST['Tipo']);
     $this->obj->__SET('CantDias', $_REQUEST['CantDias']);
            if($nums = explode('/', $originalDate)){
            $originalDate = $_REQUEST['FechaI'];
            $originalDate = ltrim($originalDate);
            $originalDate = rtrim($originalDate);
            $this->obj->__SET('FechaI', $nums[2] . "-" . $nums[1] . "-" . $nums[0]);
        } elseif ($nums = explode('-', $originalDate)){
            $this->obj->__SET('FechaI', $nums[2] . "-" . $nums[1] . "-" . $nums[0]);
        }
        $originalDate = $_REQUEST['FechaF'];
        $originalDate = ltrim($originalDate);
        $originalDate = rtrim($originalDate);
        $cambio1 = true;
        if($cambio1){
            $nums = explode('/', $originalDate);
            $this->obj->__SET('FechaF', $nums[2] . "-" . $nums[1] . "-" . $nums[0]);
        } elseif ($nums = explode('-', $originalDate)){
            $this->obj->__SET('FechaF', $nums[2] . "-" . $nums[1] . "-" . $nums[0]);
        }

        $this->obj->__SET('Descripcion', $_REQUEST['Descripcion']);
        $this->obj->__SET('IdVac', $_REQUEST['idVacaciones']);
        $this->model->EditSolicitud($this->obj, $this->obj->FechaI, $this->obj->FechaF);
        $estado = "Solicitud";
        $this->modelNotif->store(null, $estado);
        header('Location: index.php?c=SaldoVacaciones');
    }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}*/

    //Función de cancelar la solicitud de vacaciones
    public function CancelarSolicitud(){
        if(isset($_SESSION['nickname'])){
            header('Content-Type: application/json; charset=utf-8');
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $_array = $this->model->CancelarSolicitud($json_obj->id);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
            header('Location: index.php?c=SaldoVacaciones');
        }else{
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }


}
?>