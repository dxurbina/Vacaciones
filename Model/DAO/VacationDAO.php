<?php 
    class VacationDAO{
        public $con, $db;
       public function __construct(){
        require_once('Model/Conexion.php');
        require_once('Model/Entity/Vacation.php');
        $this->con = new Conexion();
        $this->db= $this->con->conex();
       }

       public function store(Vacation $data){
           $sql = 'insert into vacaciones values(null, ?, ?, ?, ?, "Pendiente", ?, null, now(), null, ?);';
           $result = $this->db->prepare($sql);
           $result->execute(array($data->__GET('FechaI'), $data->__GET('FechaF'),
                            $data->__GET('Tipo'), $data->__GET('CantDias'), 
                            $_SESSION['ID']->IdEmpleado, $data->__GET('Descripcion')));
       }

       public function update($id, $Estado){
           $sql= "update Vacaciones set Estado = ?, IdRespSup = ?, FechaRespuesta = now() where IdVacaciones = ?; ";
           $result = $this->db->prepare($sql);
           $result->execute(array($Estado, $_SESSION['ID']->IdEmpleado, $id));
           if($Estado = "Aceptada"){
            $sql = "call UpdateSaldoRequested(?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT, 10);
            $stmt->execute();
           }
           
       }

    public function showAll(){
        $flag = true; $flag2 = true;
        $resulSet = array();
        $global = array();
        $resulSet2= array();
        $sql = "select IdEmpleado from Empleados where IdJefe = ?;";
        $consult = $this->db->prepare($sql);
        $id = $_SESSION['ID']->IdEmpleado;
        $consult->execute(array($id));
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                //$val = $row->IdEmpleado;
                array_push($global, $row);
                array_push($resulSet, $row);
                //$resulSet = $row; 
        }

        /* Obtain the connection of each employee with the head of IdSession */
               while($flag2 == true){
                $subjefe = array(); 
                for($i = 0; $i < count($resulSet); $i++){
                    for($j = 0; $j < count($resulSet[$i]); $j++){
                        $sql = "select IdEmpleado from Empleados where IdJefe = ?;";
                        $consult = $this->db->prepare($sql);
                        $consult->execute(array($resulSet[$i][$j]->IdEmpleado));
                        while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                            //$subjefe = $subjefe + $row;
                            $val = $row[0]->IdEmpleado;
                            array_push($subjefe, $row);
                            //$global = $global + $row;
                            array_push($global, $row);
                        }
                    }  
                }
                $resulSet = $subjefe;
                if($resulSet == null){
                    $flag2 = false;
                }
            }
               // while($flag == true){
                   /* List Vacation by each Id obtained in the past method*/
                   for($i = 0; $i < count($global); $i++){
                    for($j = 0; $j < count($global[$i]); $j++){
                        $sql = "select v.IdVacaciones, e.PNombre, e.PApellido, d.Nombre as Dep, c.NombreCargo, v.CantDias, v.FechaI, v.FechaF, v.tipo, v.Descripcion
                        from Vacaciones v inner join Empleados e on v.IdEmpleado = e.IdEmpleado,
                        Cargos c, CentroCostos cc, DeptosEmpresa d where e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and v.Estado = 'Pendiente'
                        and e.IdJefe = ?"; 
                        
                        $consult = $this->db->prepare($sql);
                        $foo = $global[$i][$j]->IdEmpleado;
                        $consult->execute(array($global[$i][$j]->IdEmpleado));
                            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                                // $resulSet = $row; 
                                for($k = 0; $k < count($row); $k ++){
                                    $val = $row[$k];
                                    array_push($resulSet2, $val);
                                }
                                
                            }
                    }
                   }

                   /*List employee vacations by IdSession*/
                   $sql = "select v.IdVacaciones, e.PNombre, e.PApellido, d.Nombre as Dep, c.NombreCargo, v.CantDias, v.FechaI, v.FechaF, v.tipo, v.Descripcion
                   from Vacaciones v inner join Empleados e on v.IdEmpleado = e.IdEmpleado,
                   Cargos c, CentroCostos cc, DeptosEmpresa d where e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and v.Estado = 'Pendiente'
                   and e.IdJefe = ?"; 
                   
                   $consult = $this->db->prepare($sql);
                   $consult->execute(array($id));
                       while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                           // $resulSet = $row; 
                           for($k = 0; $k < count($row); $k ++){
                            $val = $row[$k];
                            array_push($resulSet2, $val);
                        }
                       }


                       /* List the vacation of General Manager */
                       $sql = "select IdEmpleado from Empleados where IdJefe is null";
                        $result = $this->db->prepare($sql);
                        $result->execute();
                        if($row = $result->fetch(PDO::FETCH_OBJ)){
                            $lastid=$row->IdEmpleado;
                        }
                        if($lastid == $_SESSION['ID']->IdEmpleado){
                            $sql = "select v.IdVacaciones, e.PNombre, e.PApellido, d.Nombre as Dep, c.NombreCargo, v.CantDias, v.FechaI, v.FechaF, v.tipo, v.Descripcion
                            from Vacaciones v inner join Empleados e on v.IdEmpleado = e.IdEmpleado,
                            Cargos c, CentroCostos cc, DeptosEmpresa d where e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and v.Estado = 'Pendiente'
                            and e.IdEmpleado = ?"; 
                            
                            $consult = $this->db->prepare($sql);
                            $consult->execute(array( $_SESSION['ID']->IdEmpleado));
                                while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                                    // $resulSet = $row; 
                                    for($k = 0; $k < count($row); $k ++){
                                        $val = $row[$k];
                                        array_push($resulSet2, $val);
                                    }
                                }
                        }
            //} 
                return $resulSet2;
        }

        public function showGeneralManager(){
            try{
              $resultSet = array();
              $consult = $this->db->prepare("select v.IdVacaciones, e.PNombre, e.PApellido, v.CantDias, v.FechaI, v.FechaF, v.tipo, v.Descripcion
              from Vacaciones v inner join Empleados e on v.IdEmpleado = e.IdEmpleado where v.Estado = 'Pendiente'
              and e.IdJefe = ?;");
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


        public function showHistory(){
            $flag = true; $flag2 = true;
        $resulSet = array();
        $global = array();
        $resulSet2= array();
        $sql = "select IdEmpleado from Empleados where IdJefe = ?;";
        $consult = $this->db->prepare($sql);
        $id = $_SESSION['ID']->IdEmpleado;
        $consult->execute(array($id));
            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                //$val = $row->IdEmpleado;
                array_push($global, $row);
                array_push($resulSet, $row);
                //$resulSet = $row; 
        }

        /* Obtain the connection of each employee with the head of IdSession */
               while($flag2 == true){
                $subjefe = array(); 
                for($i = 0; $i < count($resulSet); $i++){
                    for($j = 0; $j < count($resulSet[$i]); $j++){
                        $sql = "select IdEmpleado from Empleados where IdJefe = ?;";
                        $consult = $this->db->prepare($sql);
                        $consult->execute(array($resulSet[$i][$j]->IdEmpleado));
                        while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                            //$subjefe = $subjefe + $row;
                            $val = $row[0]->IdEmpleado;
                            array_push($subjefe, $row);
                            //$global = $global + $row;
                            array_push($global, $row);
                        }
                    }  
                }
                $resulSet = $subjefe;
                if($resulSet == null){
                    $flag2 = false;
                }
            }

             /* List Vacation by each Id obtained in the past method*/
               // while($flag == true){
                   for($i = 0; $i < count($global); $i++){
                    for($j = 0; $j < count($global[$i]); $j++){
                        $sql = "select v.IdVacaciones, e.PNombre, e.PApellido, d.Nombre as Dep, c.NombreCargo, v.CantDias, v.Estado, v.FechaI, v.FechaF, v.tipo, v.FechaSolicitud, ej.PNombre as NJefe, ej.PApellido as AJefe, v.FechaRespuesta, v.Descripcion
                        from Vacaciones v inner join Empleados e on v.IdEmpleado = e.IdEmpleado 
                            inner join Empleados ej on v.IdRespSup = ej.IdEmpleado,
                            Cargos c, CentroCostos cc, DeptosEmpresa d where e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and v.Estado != 'Pendiente'
                        and e.IdJefe = ?;"; 
                        
                        $consult = $this->db->prepare($sql);
                        $foo = $global[$i][$j]->IdEmpleado;
                        $consult->execute(array($global[$i][$j]->IdEmpleado));
                            while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                                // $resulSet = $row; 
                                for($k = 0; $k < count($row); $k ++){
                                    $val = $row[$k];
                                    array_push($resulSet2, $val);
                                }
                                
                            }
                            /*
                        $consult = $this->db->prepare($sql);
                        $consult->execute(array($boss));
                            if($row = $consult->fetch(PDO::FETCH_OBJ)){
                                $boss = $row->IdJefe;
                                
                            }*/
                    }
                   }

                   /*List employee vacations by IdSession*/
                   
                   $sql = "select v.IdVacaciones, e.PNombre, e.PApellido, d.Nombre as Dep, c.NombreCargo, v.CantDias, v.Estado, v.FechaI, v.FechaF, v.tipo, v.FechaSolicitud, ej.PNombre as NJefe, ej.PApellido as AJefe, v.FechaRespuesta, v.Descripcion
                   from Vacaciones v inner join Empleados e on v.IdEmpleado = e.IdEmpleado 
                       inner join Empleados ej on v.IdRespSup = ej.IdEmpleado,
                       Cargos c, CentroCostos cc, DeptosEmpresa d where e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and v.Estado != 'Pendiente'
                   and e.IdJefe = ?;"; 
                   
                   $consult = $this->db->prepare($sql);
                   $consult->execute(array($id));
                       while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                           // $resulSet = $row; 
                           for($k = 0; $k < count($row); $k ++){
                            $val = $row[$k];
                            array_push($resulSet2, $val);
                        }
                       }
            //} 
            $sql = "select IdEmpleado from Empleados where IdJefe is null";
            $result = $this->db->prepare($sql);
            $result->execute();
            if($row = $result->fetch(PDO::FETCH_OBJ)){
                $lastid=$row->IdEmpleado;
            }
            if($lastid == $_SESSION['ID']->IdEmpleado){
                $sql = "select v.IdVacaciones, e.PNombre, e.PApellido, d.Nombre as Dep, c.NombreCargo, v.CantDias, v.Estado, v.FechaI, v.FechaF, v.tipo, v.FechaSolicitud, ej.PNombre as NJefe, ej.PApellido as AJefe, v.FechaRespuesta, v.Descripcion
                from Vacaciones v inner join Empleados e on v.IdEmpleado = e.IdEmpleado 
                    inner join Empleados ej on v.IdRespSup = ej.IdEmpleado,
                    Cargos c, CentroCostos cc, DeptosEmpresa d where e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep and v.Estado != 'Pendiente'
                and e.IdEmpleado = ?;"; 
                
                $consult = $this->db->prepare($sql);
                $consult->execute(array( $_SESSION['ID']->IdEmpleado));
                    while( $row = $consult->fetchAll(PDO::FETCH_OBJ)){
                        // $resulSet = $row; 
                        for($k = 0; $k < count($row); $k ++){
                            $val = $row[$k];
                            array_push($resulSet2, $val);
                        }
                    }
            }
            /* List the vacation of General Manager */
                return $resulSet2;
            }

    }
?>