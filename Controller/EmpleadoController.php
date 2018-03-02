<?php
 session_start();
class EmpleadoController{
    public $obj, $model, $obju;
public function __construct(){  
        include('Model/DAO/EmpleadoDao.php');
    include('Model/Entity/Empleado.php');
    include('Model/Entity/User.php');
    $this->obj = new Empleado();
    $this->obju = new User();
    $this->model = new EmpleadoDAO();
}

public function index (){
   
    if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        
        require_once "View/EmpleadosView.php";
    }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}

    public function ListEmployeeView(){
    if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            include("View/Head.php");
            include("View/ListEmployeeView.php");
            include("View/Footer.php");
    }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}




public function AddEmpleados(){
    if($_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
    $this->obj->__SET('Residencia', $_REQUEST['Residencia']);
    if($_REQUEST['Hijos'] == '1' ){
        $this->obj->__SET('Hijos', 1);
        $this->obj->__SET('NumHijos', $_REQUEST['NumHijos']);
    }else{
        $this->obj->__SET('Hijos', 0);
        $this->obj->__SET('NumHijos', 0);
    }


    if($_REQUEST['Hermanos'] == '1' ){
        $this->obj->__SET('Hermanos', 1);
        $this->obj->__SET('NumHermanos', $_REQUEST['NumHermanos']);
    }else{
        $this->obj->__SET('Hermanos', 0);
        $this->obj->__SET('NumHermanos', 0);
    }




    $this->obj->__SET('PNombre', $_REQUEST['PNombre']);
    $this->obj->__SET('SNombre', $_REQUEST['SNombre']);
    $this->obj->__SET('PApellido', $_REQUEST['PApellido']);
    $this->obj->__SET('SApellido', $_REQUEST['SApellido']);
    
    $this->obj->__SET('Cedula', $_REQUEST['Cedula']);
    $this->obj->__SET('Pasaporte', 'Pasaporte');
    $this->obj->__SET('NInss', $_REQUEST['NInss']);
    $this->obj->__SET('FechaNac', $_REQUEST['FechaNac']);
    $this->obj->__SET('Sexo', $_REQUEST['Sexo']);

    $this->obj->__SET('Telefono', $_REQUEST['Telefono']);
    $this->obj->__SET('EstadoCivil', $_REQUEST['EstadoCivil']);
    $this->obj->__SET('Correo', $_REQUEST['Correo']);
    $this->obj->__SET('Escolaridad', $_REQUEST['Escolaridad']);
    $this->obj->__SET('NRuc', $_REQUEST['NRuc']);
    $this->obj->__SET('Profesion', $_REQUEST['Profesion']);
    $this->obj->__SET('Direccion', 'Direccion');
    $this->obj->__SET('Nacionalidad1', $_REQUEST['Nacionalidad1']);
    $this->obj->__SET('Nacionalidad2', $_REQUEST['Nacionalidad2']);
    // $this->obj->__SET('Estado', $_REQUEST['Estado']);
    $this->obj->__SET('IdCargo', $_REQUEST['IdCargo']);
    $this->obj->__SET('IdJefe', $_REQUEST['IdJefe']);
    $this->obj->__SET('IdMunicipio', $_REQUEST['IdMunicipio']);
    /*
    $Emp->id > 0 
            ? $this->model->Actualizar($Emp)
            : $this->model->Registrar($Emp);
        */
        // header('Location: index.php');

        $this->obju->__SET('user', $_REQUEST['user']);
        $this->obju->__SET('user', $_REQUEST['pass']);

    $this->model->AddEmpleados($this->obj, $this->obju);
    
    
    header('Location: index.php?c=View');
}else {
    header('Location: index.php?c=Principal&a=AccessError');
}
}

public function listaDptos(){
    include('Model/DAO/EmpleadoDao.php');
    $this->model->listaDptos($this->obj);
        $this->url= $this->obj->__GET('url');
        header('Location: Empleados.php?c=View');
        echo "" .$list;

}



function utf8_converter($array){ 
    array_walk_recursive($array, function(&$item){     
              $item = utf8_encode( $item );   
               });       return json_encode( $array ); }

    public function ListEmployee(){
        

        

        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        
        header('Content-Type: application/json;');
        $cursos = $this->model->ListEmployee();
        //$var = json_encode(array_map('utf8_encode', $cursos));
        $var = json_encode( $cursos, JSON_UNESCAPED_UNICODE);
        
        echo $var;
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }

    }
}

?>