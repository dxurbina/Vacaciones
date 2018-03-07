<?php
 session_start();
class EmpleadoController{
    public $obj, $model, $obju;
    public  $Departamentos, $mun;

public function __construct(){
    include('Model/DAO/EmpleadoDAO.php');
    include('Model/Entity/Empleado.php');
    include('Model/Entity/User.php');
    $this->obj = new Empleado();
    $this->obju = new User();
    $this->model = new EmpleadoDAO();
 
}

public function index (){
   
    if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        $this->Departamentos = $this->model->listarDptos();
        $this->mun= $this->model->listarMunicipios();
        include("View/Head.php");
        require_once('View/Empleados.php');
        include("View/Footer.php");
        
    /*Esto lo agregue yo*/
  
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
    //$this->obj->__SET('Estado', '$_REQUEST['Estado']');
   $this->obj->__SET('IdCargo', '3');
    $this->obj->__SET('IdJefe', '2');
    $this->obj->__SET('IdMunicipio', $_REQUEST['IdMunicipio']);
    /*
    $Emp->id > 0 
            ? $this->model->Actualizar($Emp)
            : $this->model->Registrar($Emp);
        */
        // header('Location: index.php');

        $this->obju->__SET('user','new');
        $this->obju->__SET('user', '135');

    $this->model->AddEmpleados($this->obj, $this->obju);
    
    header('Location: index.php?c=Empleado');
}else {
    header('Location: index.php?c=Principal&a=AccessError');
}
}

/*Llamado al método del controlador*/ 
public function MunicipiosPorDepto($IdDepto){
    header('Content-type: application/json');
    $this->mun = $this->model->listarMuniPorDpto($_POST[_IdDepartamento]);

    //$mun=$this->EmpleadoDAO->listarDeptos($_POST[_IdDepartamento]);
    print_r(json_encode($mun));

}


    public function utf8_converter($array){ 
    array_walk_recursive($array, function(&$item){     
              $item = utf8_encode( $item );   
               });       return json_encode( $array ); }

    public function ListEmployee(){
        

        

        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        
        header('Content-Type: application/json; charset=utf-8');
        $cursos = $this->model->ListEmployee();
        //$var = json_encode(array_map('utf8_encode', $cursos));
        # unset($cursos[5]);
        $var = json_encode( $cursos);
        $json = json_last_error();
       // $var2 = utf8_converter($cursos);
        
       # echo $json; #esta era la wea que lo jodia hace rato
        echo $var; 
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }

    }


    public function ListEmployeebyId(){
        

        

        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        
        header('Content-Type: application/json; charset=utf-8');
       # Get JSON as a string
    $json_str = file_get_contents('php://input');

        # Get as an object
        $json_obj = json_decode($json_str);
                $datos = $this->model->ListEmployeebyId($json_obj->id);

        # unset($cursos[5]);
        $var = json_encode( $datos);

        echo $var; 
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }

    }
}

?>