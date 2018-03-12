<?php 

class EmpleadoDAO{
    public $user, $db, $con;
    public function __construct(){
        include('Model/Conexion.php');
        include_once('Model/Entity/Empleado.php');
        include_once('Model/Entity/User.php');
        $this->con = new Conexion();
        $this->db = $this->con->conex();
    }


    /*Lista de Empleados*/
    public function ListEmployee(){
      try{
        $resultSet = array();
        $consult = $this->db->prepare("select e.IdEmpleado, e.PNombre, e.PApellido, e.Telefono, d.Nombre as Dep, c.NombreCargo, ej.PNombre as NJefe, ej.PApellido
		as AJefe from Empleados e, Empleados ej, Cargos c,DeptosEmpresa d where
        e.IdJefe = ej.IdEmpleado and e.IdCargo = c.IdCargo and c.IdDep = d.IdDep;");
        $consult->execute(); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            }
            return $resulSet; /*esto estaba ahí*/
    } catch(Exception $e)
        {
            die($e->getMessage());
        }
}

    public function ListEmployeebyId($id){
        try{
            $resultSet = array();
            $consult = $this->db->prepare("select e.IdEmpleado, e.PNombre, e.SNombre, e.PApellido, e.SApellido, e.Residencia, e.Cedula, e.Pasaporte, e.NInss, e.FechaNac, e.Sexo, e.Hijos, e.NumHijos, e.Hermanos, e.NumHermanos, e.Telefono, e.EstadoCivil, e.Correo, e.Escolaridad, e.NRuc, e.Profesion, e.Direccion, e.Nacionalidad1, e.Nacionalidad2, e.IdMunicipio,dt.IdDepartamento, d.Nombre as Dep, c.NombreCargo, c.IdCargo,  ej.PNombre as NJefe, ej.PApellido
            as AJefe, ej.IdEmpleado as IdJefeE from Empleados e, Empleados ej, Cargos c,DeptosEmpresa d, Municipio dt where
            e.IdJefe = ej.IdEmpleado and e.IdCargo = c.IdCargo and c.IdDep = d.IdDep and dt.IdMunicipio = e.IdMunicipio  and e.IdEmpleado = ?;");
            $consult->execute(array($id)); 
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet; /*esto estaba ahí*/
        } catch(Exception $e)
            {
                die($e->getMessage());
            }
    }

    public function ListaEmpEliminar($id){
        try{
            $resultSet = array();
            $consult = $this->db->prepare("delete from Empleado where id = ?");
            $consult->execute(array($id)); 
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet; /*esto estaba ahí*/
        } catch(Exception $e)
            {
                die($e->getMessage());
            }
    }

   /*Lista de Departamentos, con las exepciones*/
   public function listarDptos(){
    try{
       $Departamentos = array();
       $consult = $this->db->prepare("select * from Departamento");
       $consult->execute();   
       while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
           $Departamentos = $row; 
       }
       return $Departamentos ; /*esto estaba ahí*/
      
  } catch(Exception $e)
   {
      // die($e->getMessage());
   }
}

//Carga lista de municipios por idDepto, este es el que mando a llamar a RegistrarEmp.js
public function listarMunPorDepto($dep){
    $sql = "select IdMunicipio, Nombre from Municipio where IdDepartamento = ?";
    $resulSet = array();
    $consult = $this->db->prepare($sql);
    $consult->execute(array($dep));
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            }
            return $resulSet;

}
   public function listarDptosEmp(){
    try{
       $DeptoEmp = array();
       $consult = $this->db->prepare("select * from DeptosEmpresa");
       $consult->execute();   
       while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
           $DeptoEmp = $row; 
       }
       return $DeptoEmp ;
       /*echo json_encode($Departamentos);*/
   } catch(Exception $e)
   {
       die($e->getMessage());
   }
}

    /*Buscar en la tabla Empleados*/
    public function buscarEmp($IdEmp){
        $sql = "select * from Empleados where IdEmpleado = ?";
        $val = $this->db->prepare($sql)->execute(array($IdEmp));
    }    
    
    /*Agregar en la tabla Empleados*/ 
    public function AddEmpleados(Empleado $data, User $datau){
        $sql = "insert into Empleados values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?, ?);"; /*Verificar esta línea de código*/
        $consult = $this->db->prepare($sql);
        $consult->execute(array(null,
        $data->__GET('PNombre') /*= mysql_real_escape_string_PDO($clean['PNombre'])*/,
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
        $data->__GET('IdCargo'),
        $data->__GET('IdJefe'),
        $data->__GET('IdMunicipio')
        ));     

        $lastid;
        $sql = "select MAX(IdEmpleado) as valor from Empleados";
        $result = $this->db->prepare($sql);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $lastid=$row->valor;
        }
        
        $sql = "call adduser (?, ?, ?)";
        $consult2 = $this->db->prepare($sql);
        $consult->execute(array($datau->__GET('user'), $datau->__GET('pass'), $lastid));
    }
        
    
    
    public function GetId(){
        $id;
        $sql = "select MAX(IdEmpleado) as valor from Empleados";
        $result = $this->db->prepare($sql);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $id=$row->valor;
        }
        return $id;
    }

    /*Eliminar en la tabla de Empleados*/
    public function delete($id){
        $sql = "delete from Empleado where id = ?";
        $this->db->prepare($sql)->execute(array($id));
    }

    /*Actualizar en la tabla Empleados*/
    public function update($IdEmpAct){
        $sql = "update Empleado set IdEmpleado = ? where IdEmpleado = ?";
        $val = $this->db->prepare($sql)->execute(array($IdEmpAct));
    }





























    public function showDeparment(){
        $sql = "select * from Departamento";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute();
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;

    }

    public function showMunicipality($dep){
        $sql = "select IdMunicipio, Nombre from Municipio where IdDepartamento = ?";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($dep));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;

    }


    public function showCargos($id){
        $sql = "select IdCargo, NombreCargo from Cargos where IdDep = ?";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }

    public function showJefe($id){
        $sql = "select IdEmpleado, PNombre, SNombre from Empleados where IdEmpleado = ?";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }


    public function addRol(EmpleadoController $data){
        //Crear usuario
        /*
        $tipo;
        $sql = "create user ?@'" . HOST . "' identified by '?'";
        $resultSet = $this->db->prepare($sql);
        $resultSet->exectue(array($data->$_GET('Usuario'), $data->$_GET('Contraseña')));
        */
        $sql = "";

        //Agregar roles
        /*
            $sql = "Select Chksubordinado from Cargos c inner join Empleados e on c.IdCargo = e.IdCargo where Usuario = ?";
            $resulSet = $this->db->prepare($sql);
            $resulSet->execute(array(_USER));
            if($row = $resulSet->fetch(PDO::FETCH_OBJ)){
                $tipo = $row->Chksubordinado;
            }
            if($tipo == true){
                $sql = "Grant all privileges on Vacaciones.* to  ";
            }else if($tipo == false){

            }


            */

    }
}

?>