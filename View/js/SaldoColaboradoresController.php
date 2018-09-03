<?php

Class SaldoColaboradoresController{
    public $obj, $obju, $model, $factor1;

    public function __construct(){
    include('Model/DAO/SaldoColaboradoresDAO.php');
    include('Model/Entity/SaldoVacaciones.php');
    include('Model/Entity/User.php');
    require('Model/DAO/LoadDAO.php');
    include('Model/DAO/FactoresDAO.php'); //Agregado 30/07/2018 1:29pm
    include('Model/Entity/Vacation.php'); //Agregado 31/07/2018 9:21am
    include('Model/DAO/SaldoVacacionesDAO.php'); //Agregado 09/08/2018 5:11pm
    $this->obj = new SaldoVacaciones();
    $this->obju = new User();
    $this->model = new SaldoColaboradoresDAO();
    $this->modelfe = new FactoresDAO(); //Agregado 30/07/2018 1:29pm
    $this->modelVac = new SaldoVacacionesDAO(); //Agregado 09/08/2018 5:10pm
    
}

    public function index(){
        if(isset($_SESSION['nickname'])){
            $this->donar = $this->modelVac->ListConfig();  // Lo agregue 09-08-2018 3:15 pm
            include("View/Head.php");
            include("View/SaldoColaboradoresView.php");
            //$this->factor1;
            include("View/Footer.php");
        }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}

//Lista para traer el factor de un empleado en específico.
public function listFacByEmp(){
    if(isset($_SESSION['nickname'])){
        header('Content-Type: application/json; charset=utf-8');
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str);
        $datos = $this->modelfe->listFacByEmp($json_obj->id);
        $factor1 = json_encode( $datos);
        echo $factor1;
        //include("View/SaldoColaboradoresView.php");
    }else {
        header('Location: index.php?c=Principal&a=AccessError');
    }
}

//Lista para traer los saldos de vacaciones de todos los empleados.
public function SaldoColaboradores(){
    if(isset($_SESSION['nickname'])){
        header('Content-Type: application/json; charset=utf-8');
        $List = $this->model->SaldoColaboradores();
        $var = json_encode($List);
        $json = json_last_error();
        echo $var; 
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
}

    public function deduce(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            $cant = $_REQUEST['CantDias'];
            $this->model->deduce($cant);
            header('Location: index.php?c=SaldoColaboradores&a=index');

             }else {
                 header('Location: index.php?c=Principal&a=AccessError');
             }
    }

    public function increase(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            $cant = $_REQUEST['CantDias_1'];
            $this->model->increase($cant);
            header('Location: index.php?c=SaldoColaboradores&a=index');

             }else {
                 header('Location: index.php?c=Principal&a=AccessError');
             }
    }

    public function deduce_csv_(){
        if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
        if($_SESSION['access'] == 3){
            var_dump($_FILES['archivo']);
            $file_size = $_FILES["archivo"]["size"];
            $max_size = 1240000;
            echo $file_size;
            if (isset($_FILES["archivo"]) && $_FILES["archivo"]["name"][0] && $file_size < $max_size)
            {
                /*
                echo "Nombre: " . $_FILES['archivo']['name'] . "<br>";

                echo "Tipo: " . $_FILES['archivo']['type'] . "<br>";

                echo "Tamaño: " . ($_FILES["archivo"]["size"] / 1024) . " kB<br>";

                echo "Carpeta temporal: " . $_FILES['archivo']['tmp_name'];
                */
                $origen = $_FILES["archivo"]['tmp_name'] ;
                    $info = new SplFileInfo($_FILES["archivo"]['name']);
                    $extension = '.'.$info->getExtension();
                    $Id = uniqid();
                    $destino = UPLOADS_DIR . $Id . $extension;
                    $__file__ = $Id . $extension;
                    echo $destino;
                    if(move_uploaded_file($origen, $destino))
                    {
                        $this->model->send_notif_csv_($__file__);
                        header('Location: index.php?c=SaldoColaboradores&a=index');
                    }else{
                        echo "no se pudo mover";
                    }
            }
            else
            {
                echo "Error: " . $_FILES['archivo']['error'] . "<br>";
            }
        }else if($_SESSION['access'] == 4 || $_SESSION['access'] == 5){
            /* Run file and pass the array to the model*/

            
            $linea = 0;
            $csv_upload = array();
            //Abrimos nuestro archivo
            //$archivo = fopen("clientes.csv", "r");*/
            $origen = $_FILES["archivo"]['tmp_name'] ;
            echo $origen;
            $archivo = fopen($origen, "r");

            //Lo recorremos
            while (($datos = fgetcsv($archivo, ",")) == true) 
            {
            $num = count($datos);
            
            //echo " " . $num;
            //var_dump($datos);
            //Recorremos las columnas de esa linea
            $row = array();
            for ($columna = 0; $columna < $num; $columna++) 
                {
                    $result = $datos[$columna] . "\n";
                    array_push($row, $result);
                }
                echo $linea;
             $csv_upload[$linea] = $row;
             $linea++;
            }
            //Cerramos el archivo
            fclose($archivo);
            //var_dump($csv_upload);
            //print_r($csv_upload[1][0] );
           // print_r($csv_upload[1][1] );

             $this->model->update_csv_($csv_upload, $linea);
             echo "done...";
        }
            

        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }

    public function deduce_csv_accepted(){
        if(isset($_SESSION['nickname']) && $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
           
            $linea = 0;
         //Abrimos nuestro archivo
        //    $archivo = fopen("clientes.csv", "r");*/
            $origen = $_FILES["archivo"]['tmp_name'] ;
            $archivo = fopen($origen, "r");

            //Lo recorremos
            while (($datos = fgetcsv($archivo, ",")) == true) 
            {
            $num = count($datos);
            $linea++;
            //Recorremos las columnas de esa linea
            for ($columna = 0; $columna > $num; $columna++) 
                {
                    echo $datos[$columna] . "\n";
                }
            }
            //Cerramos el archivo
            fclose($archivo);

           // $this->model->update_csv_($__file__);
        }else {
            header('Location: index.php?c=Principal&a=AccessError');
        }
    }

}
?>