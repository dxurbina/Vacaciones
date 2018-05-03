<?php 
class PositionController{
    public $obj, $model;
    public function __construct(){
        include("Model/Entity/Position.php");
        include("Model/DAO/PositionDAO.php");
        $this->obj = new Position();
        $this->model = new PositionDAO();
    }
    public function index(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            include("View/Head.php");
            include("View/PositionView.php");
            include("View/Footer.php");
        }
    }

    public function store(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
           $this->obj->__SET('Nombre', $_POST['Nombre']);
           $this->obj->__SET('IdCosto', $_POST['costo']);
           $this->obj->__SET('IdJefe', $_POST['jefe']);
           $this->obj->__SET('IdFactor', $_POST['factor']);
           $this->model->store($this->obj);
           header('Location: index.php?c=Position');
        }
    }

    public function update(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
             # Get JSON as a string
            $json_str = file_get_contents('php://input');
           // $json_str = $_POST['id'];
            # Get as an object
            $json_obj = json_decode($json_str);
            $this->obj->__SET('Id', $json_obj->Id);
            $this->obj->__SET('Nombre', $json_obj->Nombre);
            $this->obj->__SET('IdCosto', $json_obj->IdCosto);
            $this->obj->__SET('IdJefe', $json_obj->IdJefe);
            $this->obj->__SET('IdFactor', $json_obj->IdFactor);
            $_array = $this->model->update($this->obj);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function destroy(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
             # Get JSON as a string
            $json_str = file_get_contents('php://input');
           // $json_str = $_POST['id'];
            # Get as an object
            $json_obj = json_decode($json_str);
            $_array = $this->model->destroy($json_obj->id);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function GetPosition(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
             # Get JSON as a string
            $json_str = file_get_contents('php://input');
           // $json_str = $_POST['id'];
            # Get as an object
            $json_obj = json_decode($json_str);
            $_array = $this->model->GetPosition($json_obj->Nombre);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    

    public function show(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        
            header('Content-Type: application/json; charset=utf-8');
            $List = $this->model->show();
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

    public function showById(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
             # Get JSON as a string
            $json_str = file_get_contents('php://input');
           // $json_str = $_POST['id'];
            # Get as an object
            $json_obj = json_decode($json_str);
            $_array = $this->model->showById($json_obj->id);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function showToUpdate(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
             # Get JSON as a string
            $json_str = file_get_contents('php://input');
           // $json_str = $_POST['id'];
            # Get as an object
            $json_obj = json_decode($json_str);
            $_array = $this->model->showToUpdate($json_obj->id);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function showEspecial(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            header('Content-Type: application/json; charset=utf-8');
             # Get JSON as a string
            $json_str = file_get_contents('php://input');
           // $json_str = $_POST['id'];
            # Get as an object
            $json_obj = json_decode($json_str);
            $_array = $this->model->showEspecial($json_obj->id);
            $var = json_encode( $_array);
            $json = json_last_error();
            echo $var; 
            }else {
                header('Location: index.php?c=Principal&a=AccessError');
            }
    }

    public function showFactor(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        
            header('Content-Type: application/json; charset=utf-8');
            $List = $this->model->showFactor();
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
    
}
?>