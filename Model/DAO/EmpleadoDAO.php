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
		as AJefe from empleados e, empleados ej, cargos c, centrocostos cc, deptosempresa d where
        e.IdJefe = ej.IdEmpleado and e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and e.Estado !=0;");
        $consult->execute(); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            }


         $consult = $this->db->prepare("select e.IdEmpleado, e.PNombre, e.PApellido, e.Telefono, d.Nombre as Dep, c.NombreCargo
          from empleados e inner join cargos c on e.IdCargo = c.Idcargo inner join centrocostos cc on c.IdCosto = cc.IdCosto
                           inner join deptosempresa d on cc.IdDptoEmp = d.IdDep where e.IdJefe is Null and e.Estado = 1;");
          $consult->execute(); 
              while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                for($k = 0; $k < count($row); $k ++){
                    $val = $row[$k];
                    array_push($resulSet, $val);
                }
              }
        

            return $resulSet; /*esto estaba ahí*/
    } catch(Exception $e)
        {
            die($e->getMessage());
        }
    }


      public function showGeneralManager(){
        try{
          $resultSet = array();
          $consult = $this->db->prepare("select e.IdEmpleado, e.PNombre, e.PApellido, e.Telefono, d.Nombre as Dep, c.NombreCargo
          from empleados e inner join cargos c on e.IdCargo = c.Idcargo inner join centrocostos cc on c.IdCosto = cc.IdCosto
                           inner join deptosempresa d on cc.IdDptoEmp = d.IdDep where e.IdJefe is Null an e.Estado = 1;");
          $consult->execute(); 
              while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                  $resulSet = $row; 
              }
              return $resulSet;
        } catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

    public function ListEmployeebyId($id){
        try{
            $sql = "select IdEmpleado from empleados where IdJefe is null and Estado = 1";
            $result = $this->db->prepare($sql);
            $result->execute();
            $resultSet = array();
            if($row = $result->fetch(PDO::FETCH_OBJ)){
                $lastid=$row->IdEmpleado;
                if($lastid == $id){
                    
                    $consult = $this->db->prepare("select e.IdEmpleado, e.PNombre, e.SNombre, e.PApellido, e.SApellido, e.Residencia, e.Cedula, e.Pasaporte, e.NInss, e.FechaNac, e.FechaIngreso, e.Sexo, e.Hijos, e.NumHijos, e.Hermanos, e.NumHermanos, e.Telefono, e.EstadoCivil, e.Correo, e.Escolaridad, e.NRuc, e.Profesion, e.Direccion, e.Nacionalidad1, e.Nacionalidad2, e.IdMunicipio, d.Nombre as Dep, d.IdDep, c.NombreCargo, c.IdCargo, cc.IdCosto, cc.Nombre, cc.Codigo
                    from empleados e, cargos c, centrocostos cc, deptosempresa d where
                 e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and e.IdEmpleado = ?;");
                    $consult->execute(array($id)); 
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        $resulSet = $row; 
                    }
                
            }else {
               
                $consult = $this->db->prepare("select e.IdEmpleado, e.PNombre, e.SNombre, e.PApellido, e.SApellido, e.Residencia, e.Cedula, e.Pasaporte, e.NInss, e.FechaNac, e.FechaIngreso, e.Sexo, e.Hijos, e.NumHijos, e.Hermanos, e.NumHermanos, e.Telefono, e.EstadoCivil, e.Correo, e.Escolaridad, e.NRuc, e.Profesion, e.Direccion, e.Nacionalidad1, e.Nacionalidad2, e.IdMunicipio, d.Nombre as Dep, d.IdDep, c.NombreCargo, c.IdCargo, cc.IdCosto, cc.Nombre, cc.Codigo,  ej.PNombre as NJefe, ej.PApellido
                as AJefe, ej.IdEmpleado as IdJefeE from empleados e, empleados ej, cargos c, centrocostos cc, deptosempresa d where
                e.IdJefe = ej.IdEmpleado and e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and e.IdEmpleado = ?;");
                $consult->execute(array($id)); 
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
            }
            
        }else {
               
                $consult = $this->db->prepare("select e.IdEmpleado, e.PNombre, e.SNombre, e.PApellido, e.SApellido, e.Residencia, e.Cedula, e.Pasaporte, e.NInss, e.FechaNac, e.Sexo, e.Hijos, e.NumHijos, e.Hermanos, e.NumHermanos, e.Telefono, e.EstadoCivil, e.Correo, e.Escolaridad, e.NRuc, e.Profesion, e.Direccion, e.Nacionalidad1, e.Nacionalidad2, e.IdMunicipio,dt.IdDepartamento, d.Nombre as Dep, d.IdDep, c.NombreCargo, c.IdCargo, cc.IdCosto, cc.Nombre,  ej.PNombre as NJefe, ej.PApellido
                as AJefe, ej.IdEmpleado as IdJefeE from empleados e, empleados ej, cargos c, centrocostos cc, deptosempresa d, municipio dt where
                e.IdJefe = ej.IdEmpleado and e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and dt.IdMunicipio = e.IdMunicipio  and e.IdEmpleado = ?;");
                $consult->execute(array($id)); 
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
            }
                return $resulSet; 
        } catch(Exception $e)
            {
                die($e->getMessage());
            }
            
    }

    public function EliminarEmp($id){
        try{
            $resultSet = array(); 
                $consult = $this->db->prepare("update empleados set empleados.Estado = 0 where IdEmpleado = ?;");
                $consult->execute(array($id)); //Actualiza el estado del empleado a inactivo.

                $consult = $this->db->prepare("update usuarios set usuarios.Estado = 0 where IdEmpleado = ? ;");
                $consult->execute(array($id)); //Actualiza el usuario asociado a este id de empleado.

                $consult = $this->db->prepare("update vacaciones set vacaciones.Estado = 'Cancelada' where IdEmpleado = ? and vacaciones.Estado = 'Pendiente';");
                $consult->execute(array($id)); //Actualiza las vacaciones asociadas a ese Id de empleado.            
        }catch(Exception $e)
            {
                die($e->getMessage());
            }
    }

   /*Lista de Departamentos, con las exepciones*/
public function listarDptos(){
    try{
       $Departamentos = array();
       $consult = $this->db->prepare("select * from departamento");
       $consult->execute();   
       while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
           $Departamentos = $row; 
       }
       return $Departamentos ; /*esto estaba ahí*/
      
   } catch(Exception $e)
   {
       die($e->getMessage());
   }
}

//Carga lista de municipios por idDepto, este es el que mando a llamar a RegistrarEmp.js
public function listarMunPorDepto($dep){
    $sql = "select IdMunicipio, Nombre from municipio where IdDepartamento = ?";
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
       $consult = $this->db->prepare("select * from deptosempresa");
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
        $sql = "select * from empleados where IdEmpleado = ?";
        $val = $this->db->prepare($sql)->execute(array($IdEmp));
    }    

//Agregar en la tabla Empleados*/ 
   public function AddEmpleados(Empleado $data, User $datau){
    $sql = "insert into empleados values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?, ?);"; /*Verificar esta línea de código*/
    $consult = $this->db->prepare($sql);
    $consult->execute(array(null,
    $data->__GET('PNombre'),
    $data->__GET('SNombre'),
    $data->__GET('PApellido'),
    $data->__GET('SApellido'),
    $data->__GET('Residencia'),
    $data->__GET('Cedula'),
    $data->__GET('Pasaporte'),
    $data->__GET('NInss'),
    $data->__GET('FechaNac'),
    $data->__GET('FechaIng'),
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
    $sql = "select MAX(IdEmpleado) as valor from empleados";
    $result = $this->db->prepare($sql);
    $result->execute();
    if($row = $result->fetch(PDO::FETCH_OBJ)){
        $lastid=$row->valor;
    }
    /* Crear usuario 09-05-18 */
    $sql = "call adduser(?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    $user = $datau->user;
    $pass = $datau->pass;
    $stmt->bindParam(1, $user, PDO::PARAM_STR, 20 );
    $stmt->bindParam(2, $pass, PDO::PARAM_STR, 40 );
    $stmt->bindParam(3, $lastid, PDO::PARAM_INT, 10 );
    
    $stmt->execute(array($datau->__GET('user'), $datau->__GET('pass'), $lastid));

    $sql = "insert into saldovacaciones values(null, 0.00, null, ?)";
    $result = $this->db->prepare($sql);
    $result->execute(array($lastid));

}
//16-05-18
public function GetPosition($usuario){
    $resulSet = array();
    $sql = "select * from usuarios where usuario = ? and Estado = 1;";
    $resulSet = array();
    $consult = $this->db->prepare($sql);
    $consult->execute(array($usuario));
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            }
            return $resulSet;
}
    
    public function GetId(){
        $id;
        $sql = "select MAX(IdEmpleado) as valor from empleados";
        $result = $this->db->prepare($sql);
        $result->execute();
        if($row = $result->fetch(PDO::FETCH_OBJ)){
            $id=$row->valor;
        }
        return $id;
    }

    /*Eliminar en la tabla de Empleados*/
    public function delete($id){
        $sql = "delete from empleados where id = ?";
        $this->db->prepare($sql)->execute(array($id));
    }

    /*Actualizar en la tabla Empleados*/
    public function update($IdEmpAct){
        $sql = "update empleados set IdEmpleado = ? where IdEmpleado = ?";
        $val = $this->db->prepare($sql)->execute(array($IdEmpAct));
    }





























    public function showDeparment(){
        $sql = "select * from departamento";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute();
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }

    public function showMunicipality($mun){
        
            $sql = "select IdMunicipio, Nombre from municipio where IdMunicipio= ?";
            $resulSet = array();
            $consult = $this->db->prepare($sql);
            $consult->execute(array($mun));
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        $resulSet = $row; 
                    }
                return $resulSet;

    }

    public function showDptosEmpresa(){
        $sql = "select IdDep, Nombre from deptosempresa where Estado = 1";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute();
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;

    }

    public function showUserById($id){
        $sql = "select usuario from usuarios u inner join empleados e on e.IdEmpleado = u.IdEmpleado
                where e.IdEmpleado = ?";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;

    }


    public function GetUser($id){
        $sql = "select IdUsuario, Usuario from usuarios where Usuario = ?";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;

    }
    
    public function updateUser($id, $user, $pass){
        $sql = "update usuarios u inner join empleados e on e.IdEmpleado = u.IdEmpleado set Usuario = ?, Pass = MD5(?) where e.IdEmpleado = ?";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($user, $pass, $id));
               
    }


    public function showCargos($id){
        $sql = "select c.IdCargo, c.NombreCargo from deptosempresa dp
        inner join centrocostos cc on dp.IdDep=cc.IdDptoEmp
        inner join cargos c on c.IdCosto=cc.IdCosto
        where dp.IdDep = ? and c.Estado = 1;";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }

    public function showCCostobyId($id){
        $sql = "select cc.Codigo, cc.Nombre from centrocostos cc inner join cargos c on cc.IdCosto = c.IdCosto
        where c.IdCargo = ? and cc.Estado = 1;";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }

    public function showJefe($id){
        $sql = "select IdEmpleado, PNombre, PApellido from empleados where IdEmpleado = ? and Estado = 1";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }

    public function showJefebyPosition($id){
        $sql = "select e.IdEmpleado, e.PNombre, e.PApellido from empleados e inner join cargos c on e.IdCargo = c.IdCargo 
        where c.IdCargo = (select IdJefe from cargos where IdCargo = ?)  and e.Estado = 1;";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }

    public function showJefeAdd($id){
        $sql = "select e.IdEmpleado, e.PNombre, e.PApellido from empleados e inner join cargos c on e.IdCargo = c.IdCargo 
        where c.IdCargo = (select IdJefe from Cargos where IdCargo = ?);";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }

   

    


    public function UpdateEmpleados(Empleado $data, User $datau){
        $sqlp = "update empleados set PNombre = ?, SNombre = ?, PApellido = ?, SApellido = ?, Residencia= ?, Cedula = ?, Pasaporte = ?, NInss = ?, FechaNac = ?, FechaIngreso = ?, Sexo = ?, Hijos = ?, NumHijos = ?, Hermanos = ?, NumHermanos = ?, Telefono = ?, EstadoCivil = ?, Correo = ?, Escolaridad = ?, NRuc = ?, Profesion = ?, Direccion = ?, Nacionalidad1 = ?, Nacionalidad2 = ?,  IdCargo = ?, IdJefe = ?, IdMunicipio = ? where IdEmpleado = ?";
        $boss = null;
                $sql = "select IdJefe from empleados where IdEmpleado = ? ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(array($data->__GET('idEmpleado')));
                if($row = $stmt->fetch(PDO::FETCH_OBJ)){
                    $boss=$row->IdJefe;
                }

        $consult = $this->db->prepare($sqlp);
        $consult->execute(array(
        $data->__GET('PNombre') /*= mysql_real_escape_string_PDO($clean['PNombre'])*/,
        $data->__GET('SNombre'),
        $data->__GET('PApellido'),
        $data->__GET('SApellido'),
        $data->__GET('Residencia'),
        $data->__GET('Cedula'),
        $data->__GET('Pasaporte'),
        $data->__GET('NInss'),
        $data->__GET('FechaNac'),
        $data->__GET('FechaIng'),
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
        $data->__GET('IdMunicipio'),
        $data->__GET('idEmpleado'),
        )); 
        /* Cambiar rol de antiguo Jefe si existe modificacion de la variable idjefe */
        if($data->__GET('IdJefe') != $boss){
            
            /* Actualizar rol d antiguo jefe */
            $sql = "call updateRololdBoss(?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(1, $boss, PDO::PARAM_INT, 10);
            $stmt->execute();
            $employee = (int)$data->__GET('idEmpleado');

            /* Actualizar rol del empleado actualizado*/
            $sql = "call updateRoltochangeEmployee(?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(1, $employee, PDO::PARAM_INT, 10);
            $stmt->execute();
        }
        
    }
}

?>