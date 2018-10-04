<?php 
    class ReportDAO{
        public $db;
        public function __construct(){
            include("Model/Conexion.php");
            $con = new Conexion();
            $this->db = $con->conex();
        }

        public function report($dateI, $dateE){
            $resulSet = array();
            $i = 0;
            $sql = "select e.Cedula as 'NCedula', v.FechaI as 'Fecha Inicio', v.FechaF as 'Fecha Final', v.CantDias as 'Dias Descansados',
            v.Descripcion as 'Descripcion', 'No' as 'Dias Pagados' from vacaciones v inner join empleados e
            on v.IdEmpleado = e.IdEmpleado where v.Tipo = 'Vacaciones' and v.Estado = 'Aceptada'and v.FechaRespuesta between ? and ?;";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($dateI, $dateE));
            while( $row = $consult->fetch(PDO::FETCH_ASSOC)){
                $row['NCedula'] = str_replace("-","",$row['NCedula']);
                $resulSet[] = $row; 
                
              
            }

           

            return $resulSet;
        }

        public function report2($date){
            $resulSet = array();
            $i = 0;
            $sql = "select  e.Cedula as 'NCedula', v.FechaI as 'Fecha Inicio', v.FechaF as 'Fecha Final', format((v.CantDias * f.Factor), 2) as 'Dias Descansados',
            '-' as 'Descripcion', 'no' as 'Dias Pagados' from vacaciones v inner join empleados e
            on v.IdEmpleado = e.IdEmpleado inner join cargos c on c.IdCargo = e.IdCargo inner join factor f on
            f.IdFactor = c.IdFactor  where v.Tipo = 'Vacaciones' and v.Estado = 'Aceptada'and v.FechaI 
            >= FIRST_DAY(?) and v.FechaF <= LAST_DAY(?);";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($date, $date));
            while( $row = $consult->fetch(PDO::FETCH_ASSOC)){
                $row['NCedula'] = str_replace("-","",$row['NCedula']);
                //$resulSet[] = $row; 
                array_push($resulSet, $row);
              
            }

            $sql = "select e.Cedula as 'NCedula', v.FechaI as 'Fecha Inicio', v.FechaF as 'Fecha Final', format(
                (DATEDIFF(DATE_ADD(LAST_DAY(?), INTERVAL 1 DAY), v.FechaI) * f.Factor), 2) as 'Dias Descansados',
                            '-' as 'Descripcion', 'no' as 'Dias Pagados' from vacaciones v inner join empleados e
                            on v.IdEmpleado = e.IdEmpleado inner join cargos c on c.IdCargo = e.IdCargo inner join factor f on
                            f.IdFactor = c.IdFactor  where v.Tipo = 'Vacaciones' and v.Estado = 'Aceptada'
                            and v.FechaI between FIRST_DAY(?) and LAST_DAY(?)
                            and v.FechaF between LAST_DAY(?) and DATE_ADD(LAST_DAY(?), INTERVAL 30 DAY)";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($date, $date, $date, $date, $date));
            while( $row = $consult->fetch(PDO::FETCH_ASSOC)){
                $row['NCedula'] = str_replace("-","",$row['NCedula']);
                //$resulSet[] = $row; 
                array_push($resulSet, $row);
              
            }

            $sql = "select e.Cedula as 'NCedula', v.FechaI as 'Fecha Inicio', v.FechaF as 'Fecha Final', format((
                DATEDIFF(v.FechaF, DATE_ADD(FIRST_DAY(?), INTERVAL -1 DAY)) * f.Factor), 2) as 'Dias Descansados',
                            '-' as 'Descripcion', 'no' as 'Dias Pagados' from vacaciones v inner join empleados e
                            on v.IdEmpleado = e.IdEmpleado inner join cargos c on c.IdCargo = e.IdCargo inner join factor f on
                            f.IdFactor = c.IdFactor  where v.Tipo = 'Vacaciones' and v.Estado = 'Aceptada'
                            and v.FechaI between DATE_ADD(FIRST_DAY(?), INTERVAL -30 DAY) and DATE_ADD(FIRST_DAY(?), INTERVAL -1 DAY)
                            and v.FechaF >= FIRST_DAY(?)";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($date, $date, $date, $date));
            while( $row = $consult->fetch(PDO::FETCH_ASSOC)){
                $row['NCedula'] = str_replace("-","",$row['NCedula']);
                //$resulSet[] = $row; 
                array_push($resulSet, $row);
            }

            


            /* Donaciones */
            $sql = "select e.Cedula as 'NCedula', v.FechaI as 'Fecha Inicio', v.FechaF as 'Fecha Final', format(v.CantDias, 2) as 'Dias Descansados',
            v.Descripcion as 'Descripcion', 'no' as 'Dias Pagados' from vacaciones v inner join empleados e
            on v.IdEmpleado = e.IdEmpleado inner join cargos c on c.IdCargo = e.IdCargo  where v.Tipo = 'Donar' and v.Estado = 'Aceptada'and v.FechaRespuesta between FIRST_DAY(?) and LAST_DAY(?);";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($date, $date));
            while( $row = $consult->fetch(PDO::FETCH_ASSOC)){
                $row['NCedula'] = str_replace("-","",$row['NCedula']);
                //$resulSet[] = $row; 
                array_push($resulSet, $row);
            }

            $sql = "insert into _logs values(null, ?, now(), ?, ?)";
                $result = $this->db->prepare($sql);
                $tipo = "Generar Reporte Mensual";
                
                $sql = "select  e.PNombre, e.PApellido, c.NombreCargo from  empleados e, cargos c, centrocostos cc, deptosempresa d where e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep 
                and e.IdEmpleado = ?;";
                $data2 = array();
                $result2 = $this->db->prepare($sql);
                $result2->execute(array( $_SESSION['ID']->IdEmpleado));
                $data2 = array();
                if($row = $result2->fetch(PDO::FETCH_OBJ)){
                   
                    $data2 = $row;
                    
                }


                $Nombre = $data2->PNombre . " " . $data2->PApellido . " (" . $data2->NombreCargo . ")";
                $result->execute(array($_SESSION['nickname'], $tipo, $Nombre));


            return $resulSet;
        }
    }
?>