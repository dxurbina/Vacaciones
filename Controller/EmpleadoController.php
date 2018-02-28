<?php

class EmpleadoController{
    public $obj, $model;
public function __construct(){
    include('Model/DAO/EmpleadoDao.php');
    include('Model/Entity/Empleado.php');
    $this->obj = new Empleado();
    $this->model = new EmpleadoDAO();
}

public function Index (){
    require_once "View/Empleados.php";
}

public function AddEmpleados(){
    $Emp = new Empleado();
    $this->obj->__SET('PNombre', $_REQUEST['PNombre']);
    $this->obj->__SET('SNombre', $_REQUEST['SNombre']);
    $this->obj->__SET('PApellido', $_REQUEST['PApellido']);
    $this->obj->__SET('SApellido', $_REQUEST['SApellido']);
    $this->obj->__SET('Residencia', $_REQUEST['Residencia']);
    $this->obj->__SET('Cedula', $_REQUEST['Cedula']);
    $this->obj->__SET('Pasaporte', 'Pasaporte');
    $this->obj->__SET('NInss', $_REQUEST['NInss']);
    $this->obj->__SET('FechaNac', $_REQUEST['FechaNac']);
    $this->obj->__SET('Sexo', $_REQUEST['Sexo']);
    $this->obj->__SET('Hijos', $_REQUEST['Hijos']);
    $this->obj->__SET('NumHijos', $_REQUEST['NumHijos']);
    $this->obj->__SET('Hermanos', $_REQUEST['Hermanos']);
    $this->obj->__SET('NumHermanos', 'NumHermanos');
    $this->obj->__SET('Telefono', $_REQUEST['Telefono']);
    $this->obj->__SET('EstadoCivil', $_REQUEST['EstadoCivil']);
    $this->obj->__SET('Correo', $_REQUEST['Correo']);
    $this->obj->__SET('Escolaridad', $_REQUEST['Escolaridad']);
    $this->obj->__SET('NRuc', $_REQUEST['NRuc']);
    $this->obj->__SET('Profesion', $_REQUEST['Profesion']);
    $this->obj->__SET('Direccion', 'Direccion');
    $this->obj->__SET('Nacionalidad1', $_REQUEST['Nacionalidad1']);
    $this->obj->__SET('Nacionalidad2', $_REQUEST['Nacionalidad2']);
    $this->obj->__SET('Estado', $_REQUEST['Estado']);
    $this->obj->__SET('Usuario', $_REQUEST['Usuario']);
    $this->obj->__SET('Pass', $_REQUEST['Pass']);
    $this->obj->__SET('IdCargo', $_REQUEST['IdCargo']);
    $this->obj->__SET('IdMunicipio', 'IdMunicipio');

    $Emp->id > 0 
            ? $this->model->Actualizar($Emp)
            : $this->model->Registrar($Emp);
        
        header('Location: index.php');
    $this->model->CrearEmpleados($this->obj);
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