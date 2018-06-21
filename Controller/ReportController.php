<?php 
    class ReportController{
        public $model;
        public function __construct(){
            include("Model/DAO/ReportDAO.php");
            $this->model = new ReportDAO();
            

        }

        public function index(){
            if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
                include("View/Head.php");
                include("View/ReportView.php");
                include("View/Footer.php");
            }
        }

        public function generate(){
            if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
                $originalDate = $_REQUEST['dateI'];
                //$DateI = date("Y-m-d", strtotime($originalDate));
                $originalDate = ltrim($originalDate);
                $originalDate = rtrim($originalDate);
                $nums = explode('/', $originalDate);
                $dateI = $nums[2] . "-" . $nums[1] . "-" . $nums[0];
                $originalDate = $_REQUEST['dateE'];
                $originalDate = ltrim($originalDate);
                $originalDate = rtrim($originalDate);
                $nums = explode('/', $originalDate);
                $dateF = $nums[2] . "-" . $nums[1] . "-" . $nums[0];
                $libros = $this->model->report($dateI, $dateF);
                if(!empty($libros)) {

                    $filename = "reporte.csv";
                    
                    header("Content-Type: application/vnd.ms-excel");
                    
                    header("Content-Disposition: attachment; filename=".$filename);
                    
                     
                    
                    $mostrar_columnas = false;
                    
                     
                    
                    foreach($libros as $libro) {
                    
                    if(!$mostrar_columnas) {
                    
                    echo implode(",", array_keys($libro)) . "\r\n";
                    
                    $mostrar_columnas = true;
                    
                    }
                    
                    echo implode(",", array_values($libro)) . "\r\n";
                    
                    }
                    
                     
                    
                    }else{
                    
                    echo "No hay datos a exportar";
                    
                    }
                    
                    exit;
                    
                    }
            }
        


    }
?>