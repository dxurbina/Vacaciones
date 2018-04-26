<?php 
class VacacionesController{
    public $model, $obj, $factor, $modelFe;
    public function __construct(){
        include('Model/DAO/VacationDAO.php');
        include('Model/Entity/Vacation.php');
        include('Model/DAO/FeriadosDAO.php'); //Agregado 18-04-2018 3:06pm
        $this->obj = new Vacation();
        $this->model = new VacationDAO();
        $this->modelFe = new FeriadosDAO(); //Agregado 18-04-2018 3:06pm
    }

    public function index(){
        if(isset($_SESSION['nickname'])){
        include('Model/DAO/FactorDAO.php');
        $modelf = new FactorDAO();
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
 public function store(){
        if(isset($_SESSION['nickname'])){
         $this->obj->__SET('Tipo', $_REQUEST['Tipo']);
            $this->obj->__SET('CantDias', $_REQUEST['CantDias']);
            $this->obj->__SET('FechaI', $_REQUEST['FechaI']);
            $this->obj->__SET('FechaF', $_REQUEST['FechaF']);
            $this->obj->__SET('Descripcion', $_REQUEST['Descripcion']);
            //$this->modelFe->Feriados(); //Agregado 18-04-2018 3:08pm
            $this->model->store($this->obj, $this->obj->FechaI, $this->obj->FechaF);
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

   //Función de la edición de una solicitud de vacaciones
   /* public function EditSolicitud(){
        if(isset($_SESSION['nickname'])){
            header('Content-Type: application/json; charset=utf-8');
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $_array = $this->model->EditSolicitud($json_obj->id);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
            header('Location: index.php?c=SaldoVacaciones');
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }*/
//Función de la edición de una solicitud de vacaciones
public function EditSolicitud(){
    if(isset($_SESSION['nickname'])){
    $this->obj->__SET('Tipo', $_REQUEST['Tipo']);
    $this->obj->__SET('CantDias', $_REQUEST['CantDias']);
    $this->obj->__SET('FechaI', $_REQUEST['FechaI']);
    $this->obj->__SET('FechaF', $_REQUEST['FechaF']);
    $this->obj->__SET('Descripcion', $_REQUEST['Descripcion']);
    $this->obj->__SET('IdVac', $_REQUEST['idVacaciones']);
    $this->model->EditSolicitud($this->obj);
    header('Location: index.php?c=SaldoVacaciones');
}else {
    header('Location: index.php?c=Principal&a=AccessError');
}
}
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
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }


}
?>