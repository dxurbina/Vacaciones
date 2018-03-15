<?php 
class VacacionesController{
    public function __construct(){

    }

    public function index(){
        require "View/Head.php";
        require "View/VacacionesView.php";
        require "View/Footer.php";
    }
    
    public function requests(){
        require "View/Head.php";
        require "View/RequestsView.php";
        require "View/Footer.php";
    }
    public function store(){

    }
    public function update(){

    }

}
?>