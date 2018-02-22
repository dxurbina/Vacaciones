<?php 
    class Conexion{
        public function conex(){
            try{      
            $con = new PDO('mysql:host=10.20.190.139; dbname=' . DB , _USER, _PASS );
            return $con;
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        } 
    }
?>