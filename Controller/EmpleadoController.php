<?php

class EmpleadoController{
    public $obj, $model;
public function __construct(){
    include('Model/DAO/EmpleadoDao.php');
    include('Model/Entity/Empleado.php');
    $this->obj = new Empleado();
    $this->model = new EmpleadoDAO();
}


public function AddEmpleados(){
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
    $this->obj->__SET('Contraseña', $_REQUEST['Contraseña']);
    $this->obj->__SET('IdTipoEmpleado', $_REQUEST['IdTipoEmpleado']);
    $this->obj->__SET('IdMunicipio', 'IdMunicipio');
    $this->model->CrearEmpleados($this->obj);
    header('Location: index.php?c=View');
}
}

?>