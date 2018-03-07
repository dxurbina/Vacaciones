<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link href="View/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="View/css/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="View/css/estilos2.css" rel="stylesheet" type="text/css" />

    <script src="View/js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    
    <script src="View/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="View/js/plugins/datatables/dataTables.bootstrap.js"></script>
    <script src="View/js/AdminLTE/app.js" type="text/javascript"></script>
     <link rel="stylesheet" type="text/css" href="View/css/estilos.css"/>   

    <script language="javascript" src="js/jquery-3.1.1.min.js"></script>
		<script language="javascript">
			$(document).ready(function(){
				$("#cboDepto").change(function () {
 
					//$('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					
					$("#cboDepto option:selected").each(function () {
                        IdDepartamento = $(this).val();
                        //$.post("?c=Empleado&a=MunicipiosDepto", { IdDepartamento: IdDepartamento },
                        $.post("?c=Empleado&a=ListMunId", { IdDepartamento: IdDepartamento },
                        //$.post("?c=Empleado&a=listarMunPorDepto", { IdDepartamento: IdDepartamento },
                        //$.post("?c=Empleado&a=index.php", { IdDepartamento: IdDepartamento }, 
                        function(data){
							$("#cboMun").html(data);
						});            
					});
				})
			});
            
		</script>



     
    
</head>
<body>
    
