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
		as AJefe from Empleados e, Empleados ej, Cargos c, CentroCostos cc, DeptosEmpresa d where
        e.IdJefe = ej.IdEmpleado and e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and e.Estado !=0;");
        $consult->execute(); 
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                $resulSet = $row; 
            }


         $consult = $this->db->prepare("select e.IdEmpleado, e.PNombre, e.PApellido, e.Telefono, d.Nombre as Dep, c.NombreCargo
          from Empleados e inner join Cargos c on e.IdCargo = c.Idcargo inner join Centrocostos cc on c.IdCosto = cc.IdCosto
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
          from Empleados e inner join Cargos c on e.IdCargo = c.Idcargo inner join Centrocostos cc on c.IdCosto = cc.IdCosto
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
            $sql = "select IdEmpleado from Empleados where IdJefe is null and Estado = 1";
            $result = $this->db->prepare($sql);
            $result->execute();
            $resultSet = array();
            if($row = $result->fetch(PDO::FETCH_OBJ)){
                $lastid=$row->IdEmpleado;
                if($lastid == $id){
                    
                    $consult = $this->db->prepare("select e.IdEmpleado, e.PNombre, e.SNombre, e.PApellido, e.SApellido, e.Residencia, e.Cedula, e.Pasaporte, e.NInss, e.FechaNac, e.Sexo, e.Hijos, e.NumHijos, e.Hermanos, e.NumHermanos, e.Telefono, e.EstadoCivil, e.Correo, e.Escolaridad, e.NRuc, e.Profesion, e.Direccion, e.Nacionalidad1, e.Nacionalidad2, e.IdMunicipio,dt.IdDepartamento, d.Nombre as Dep, d.IdDep, c.NombreCargo, c.IdCargo, cc.IdCosto, cc.Nombre
                    from Empleados e, Cargos c, CentroCostos cc, DeptosEmpresa d, Municipio dt where
                      e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and dt.IdMunicipio = e.IdMunicipio  and e.IdEmpleado = ?;");
                    $consult->execute(array($id)); 
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        $resulSet = $row; 
                    }
                
            }else {
               
                $consult = $this->db->prepare("select e.IdEmpleado, e.PNombre, e.SNombre, e.PApellido, e.SApellido, e.Residencia, e.Cedula, e.Pasaporte, e.NInss, e.FechaNac, e.Sexo, e.Hijos, e.NumHijos, e.Hermanos, e.NumHermanos, e.Telefono, e.EstadoCivil, e.Correo, e.Escolaridad, e.NRuc, e.Profesion, e.Direccion, e.Nacionalidad1, e.Nacionalidad2, e.IdMunicipio,dt.IdDepartamento, d.Nombre as Dep, d.IdDep, c.NombreCargo, c.IdCargo, cc.IdCosto, cc.Nombre,  ej.PNombre as NJefe, ej.PApellido
                as AJefe, ej.IdEmpleado as IdJefeE from Empleados e, Empleados ej, Cargos c, CentroCostos cc, DeptosEmpresa d, Municipio dt where
                e.IdJefe = ej.IdEmpleado and e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and dt.IdMunicipio = e.IdMunicipio  and e.IdEmpleado = ?;");
                $consult->execute(array($id)); 
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
            }
            
        }else {
               
                $consult = $this->db->prepare("select e.IdEmpleado, e.PNombre, e.SNombre, e.PApellido, e.SApellido, e.Residencia, e.Cedula, e.Pasaporte, e.NInss, e.FechaNac, e.Sexo, e.Hijos, e.NumHijos, e.Hermanos, e.NumHermanos, e.Telefono, e.EstadoCivil, e.Correo, e.Escolaridad, e.NRuc, e.Profesion, e.Direccion, e.Nacionalidad1, e.Nacionalidad2, e.IdMunicipio,dt.IdDepartamento, d.Nombre as Dep, d.IdDep, c.NombreCargo, c.IdCargo, cc.IdCosto, cc.Nombre,  ej.PNombre as NJefe, ej.PApellido
                as AJefe, ej.IdEmpleado as IdJefeE from Empleados e, Empleados ej, Cargos c, CentroCostos cc, DeptosEmpresa d, Municipio dt where
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
            if($row = $resultSet>0)
            {
                $consult = $this->db->prepare("delete from vacaciones where IdEmpleado = ?;");
                $consult->execute(array($id)); //Elimina las vacaciones asociadas a ese Id de empleado.

                $consult = $this->db->prepare("delete from SaldoVacaciones where IdEmpleado = ?;");
                $consult->execute(array($id)); //Elimina el saldo de vacaciones asociado a ese id de empleado.
            }
            $consult = $this->db->prepare("delete from usuarios where IdEmpleado = ? ;");
            $consult->execute(array($id)); //Elimina el usuario asociado a este id de empleado.

            //$consult = $this->db->prepare("delete from Empleados where IdEmpleado = ?;");
            $consult = $this->db->prepare("update Empleados set empleados.Estado = 0 where IdEmpleado = ?;");
            $consult->execute(array($id)); //Actualiza el estado del empleado a inactivo.
        }catch(Exception $e)
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
       die($e->getMessage());
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
    $sql = "insert into Empleados values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?, ?, ?);"; /*Verificar esta línea de código*/
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
    $sql = "select MAX(IdEmpleado) as valor from Empleados";
    $result = $this->db->prepare($sql);
    $result->execute();
    if($row = $result->fetch(PDO::FETCH_OBJ)){
        $lastid=$row->valor;
    }
   /* $sql = "call adduser (?, ?, ?)";
    $consult2 = $this->db->prepare($sql);
    $consult->execute(array($datau->__GET('user'), $datau->__GET('pass'), $lastid));*/
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

    public function showDptosEmpresa(){
        $sql = "select IdDep, Nombre from DeptosEmpresa";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute();
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;

    }


    public function showCargos($id){
        $sql = "select c.IdCargo, c.NombreCargo from DeptosEmpresa dp
        inner join CentroCostos cc on dp.IdDep=cc.IdDptoEmp
        inner join Cargos c on c.IdCosto=cc.IdCosto
        where IdDep = ?;";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }

    public function showCCostobyId($id){
        $sql = "select cc.Codigo, cc.Nombre from CentroCostos cc inner join Cargos c on cc.IdCosto = c.IdCosto
        where c.IdCargo = ?;";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }

    public function showJefe($id){
        $sql = "select IdEmpleado, PNombre, PApellido from Empleados where IdEmpleado = ?";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }

    public function showJefebyPosition($id){
        $sql = "select e.IdEmpleado, e.PNombre, e.PApellido from empleados e inner join Cargos c on e.IdCargo = c.IdCargo 
        where c.IdCargo = (select IdJefe from Cargos where IdCargo = ?)  and e.Estado = 1;";
        $resulSet = array();
        $consult = $this->db->prepare($sql);
        $consult->execute(array($id));
                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                    $resulSet = $row; 
                }
                return $resulSet;
    }

    public function showJefeAdd($id){
        $sql = "select e.IdEmpleado, e.PNombre, e.PApellido from empleados e inner join Cargos c on e.IdCargo = c.IdCargo 
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
        $sqlp = "update Empleados set PNombre = ?, SNombre = ?, PApellido = ?, SApellido = ?, Residencia= ?, Cedula = ?, Pasaporte = ?, NInss = ?, FechaNac = ?, Sexo = ?, Hijos = ?, NumHijos = ?, Hermanos = ?, NumHermanos = ?, Telefono = ?, EstadoCivil = ?, Correo = ?, Escolaridad = ?, NRuc = ?, Profesion = ?, Direccion = ?, Nacionalidad1 = ?, Nacionalidad2 = ?,  IdCargo = ?, IdJefe = ?, IdMunicipio = ? where IdEmpleado = ?";
        $boss = null;
                $sql = "select IdJefe from Empleados where IdEmpleado = ? ";
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