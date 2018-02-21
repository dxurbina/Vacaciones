<?php 
    class Conexion{
        public function conex(){
            $con = new PDO('mysql:host =' . HOST . 'dbname = ' . DB , _USER, _PASS );
            return $con;
        } 
    }
?>