<?php 

class EmpleadoDAO{
    public $user, $db, $con;
    public function __construct(){
        include('Model/Conexion.php');
        include_once('Model/Entity/Empleado.php');
        $this->con = new Conexion();
        $this->db = $this->con->conex();
    }

    /*Lista de Empleados*/
    public function list(){
        $resultSet = array();
        $consult = $this->bd->prepare("select * from Empleados");
        $consult->execute();
        while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
            $resultSet[] = $row; 
        }
        return $resultSet;
    }
    /*Agregar en la tabla Empleados*/ 
    public function CrearEmpleados(Empleados $data){
        $sql = "insert into Empleados values('?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?');"; /*Verificar esta línea de código*/
        $this->bd->prepare($sl)->execute(array($data->__GET(),
        $data->__GET('PNombre') = mysql_real_escape_string_PDO($clean['PNombre']),
        $data->__GET('SNombre'),
        $data->__GET('PApellido'),
        $data->__GET('SApellido'),
        $data->__GET('Residencia'),
        $data->__GET('Cedula'),
        $data->__GET('Pasaporte'),
        $data->__GET('NInss'),
        $data->__GET('FechaNac'),
        $data->__GET('Sexo'),
        $data->__GET('Hijos'),
        $data->__GET('NumHijos'),
        $data->__GET('Hermanos'),
        $data->__GET('NumHermanos'),
        $data->__GET('Telefono'),
        $data->__GET('EstadoCivil'),
        $data->__GET('Correo'),
        $data->__GET('Escolaridad'),
        $data->__GET('NRuc'),
        $data->__GET('Profesion'),
        $data->__GET('Direccion'),
        $data->__GET('Nacionalidad1'),
        $data->__GET('Nacionalidad2'),
        $data->__GET('Estado'),
        $data->__GET('Usuario'),
        $data->__GET('Contraseña'),
        $data->__GET('IdTipoEmpleado'),
        $data->__GET('IdMunicipio')));
    }

    /*Eliminar en la tabla de Empleados*/
    public function delete($id){
        $sql = "delete from Empleado where id = ?";
        $this->db->prepare($sql)->execute(array($id));
    }

    /*Actualizar en la tabla Empleados*/
    public function update($detalle, $user){
        $sql = "update Empleado set IdEmpleado = ? where IdEmpleado = ?";
        $val = $this->db->prepare($sql)->execute(array($detalle, $user));
        
    }

































    public function addRol(EmpleadoController $data){
        $sql = "create user ?@'" . HOST . "' identified by '?'";
        $resultSet = $this->db->prepare($sql);
        $resultSet->exectue(array($data->$_GET('Usuario'), $data->$_GET('')));
        echo "";
    }

?>
