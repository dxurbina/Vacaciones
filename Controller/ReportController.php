<?php 
    class ReportController{
        public $model;
        public function __construct(){
            include("Model/ReportDAO.php");
            $this->model = new ReportDAO();
            

        }

        public function index(){
            if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
                include("View/Head.php");
                include("View/ReportView.php");
                include("View/Footer.php");
            }
        }

        public function report(){
            if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
                $libro = $this->model->report($_POST['dateI'], $_POST['dateE']);
                if(!empty($libros)) {

                    $filename = "libros.xls";
                    
                    header("Content-Type: application/vnd.ms-excel");
                    
                    header("Content-Disposition: attachment; filename=".$filename);
                    
                     
                    
                    $mostrar_columnas = false;
                    
                     
                    
                    foreach($libros as $libro) {
                    
                    if(!$mostrar_columnas) {
                    
                    echo implode(“\t”, array_keys($libro)) . “\n”;
                    
                    $mostrar_columnas = true;
                    
                    }
                    
                    echo implode(“\t”, array_values($libro)) . “\n”;
                    
                    }
                    
                     
                    
                    }else{
                    
                    echo "No hay datos a exportar";
                    
                    }
                    
                    exit;
                    
                    }
            }
        


    }
?>