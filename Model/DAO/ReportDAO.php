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
    }
?>