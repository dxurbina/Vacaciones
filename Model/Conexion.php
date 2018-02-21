<?php 
    class Conexion{
        public function conex(){
            $con = new PDO('mysql:host =' . HOST . 'dbname = ' . DB , $user, $pass );
            return $con;
        } 
    }
?>