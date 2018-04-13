<?php 
    class Conexion{
        public function conex(){
            try{      
           
            $con = new PDO('mysql:host=' . HOST . '; dbname=' . DB  . ";charset=utf8", _USER, _PASS,
            array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' "));
            return $con;
        } catch (PDOException $e) {
            return null;
        }
        } 

        public function conexLoad(){
            try{      
                $con = new PDO('mysql:host=localhost; dbname=' . DB , $this->userP, $this->passP,
                array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' "));
                
                return $con;
            } catch (PDOException $e) {
                return null;
            }
            } 
        }
    
?>