<?php 
    class VacationDAO{
        public $con, $db;
       public function __construct(){
        requiere('Model/Conexion');
        requiere('Model/Entity/Vacaciones.php');
        $this->con = new Conexion();
        $this->db= $this->conex();
       }

       public function store(Vacation $data){
           $sql = 'insert into vacaciones values(null, ?, ?, ?, ?, ?, ?, null, now(), null, ?);';
           $result = $this->db->prepare($sql);
           $result->execute(array($data->__GET('FechaI'), $data->__GET('FechaF'),
                            $data->__GET('Tipo'), $data->__GET('CantDias'), $data->__GET('Estado'),
                            $data->__GET('IdEmpleado'), $data->__GET('Descripcion')));
       }

       public function update(Vacation $data){
           $sql= "update Vacaciones set Estado = ?, IdRespSup = ?, FechaRespuesta = ? ";
           $result = $this->db->prepare($sql);
           $result->execute(array($data->__GET('Estado'), $data->__GET('IdRespSup'), $data->__GET('FechaREsp')));
       }

    }
?>