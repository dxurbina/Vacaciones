<?php

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
    session_start();
    if($_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
    require_once "View/EmpleadosView.php";
    }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}

public function AddEmpleados(){
    if($_REQUEST['Residencia'] == '0' ){
        $this->obj->__SET('Residencia', 1);

    }else{
        $this->obj->__SET('Residencia', 0);
        
    }

    if($_REQUEST['Hijos'] == 'Si' ){
        $this->obj->__SET('Hijos', 1);
        $this->obj->__SET('NumHijos', $_REQUEST['NumHijos']);
    }else{
        $this->obj->__SET('Hijos', 0);
        $this->obj->__SET('NumHijos', 0);
    }

    if($_REQUEST['Hermanos'] == 'Si' ){
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
    $valorCargo = $this->model->GetCargo($_REQUEST['IdCargo']);
    $valorJefe = $this->model->GetJefe($_REQUEST['IdJefe']);
    $valorMunicipio = $this->model->GetMunicipio($_REQUEST['IdMunicipio']);
    $this->obj->__SET('IdCargo', $valorCargo);
    $this->obj->__SET('IdJefe', $valorJefe);
    $this->obj->__SET('IdMunicipio', $valorMunicipio);
    /*
    $Emp->id > 0 
            ? $this->model->Actualizar($Emp)
            : $this->model->Registrar($Emp);
        */
        // header('Location: index.php');

        $this->obju->__SET('user', $_REQUEST['user']);
        $this->obju->__SET('user', $_REQUEST['pass']);

    $this->model->AddEmpleados($this->obj);
    
    
    header('Location: index.php?c=View');
}

public function listaDptos(){
    include('Model/DAO/EmpleadoDao.php');
    $this->model->listaDptos($this->obj);
        $this->url= $this->obj->__GET('url');
        header('Location: Empleados.php?c=View');
        echo "" .$list;

}


}

?>