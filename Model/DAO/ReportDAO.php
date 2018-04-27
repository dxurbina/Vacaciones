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
            $sql = "select e.Cedula as 'N Cedula', v.FechaI as 'Fecha Inicio', v.FechaF as 'Fecha Final', v.CantDias as 'Dias Descansados',
            V.Descripcion as 'Descripcion', 'Si' as 'Dias Pagados' from Vacaciones v inner join Empleados e
            on v.IdEmpleado = e.IdEmpleado where v.Tipo = 'Vacaciones' and v.Estado = 'Aceptada'and v.FechaRespuesta between ? and ?;";
            $consult = $this->db->prepare($sql);
            $consult->execute(array($dateI, $dateE));
            while( $row = $consult->fetch(PDO::FETCH_ASSOC)){
                $resulSet[] = $row; 
            }
            return $resulSet;
        }
    }
?>