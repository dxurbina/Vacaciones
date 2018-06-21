<html lang = es>
<head>
    <meta charset = "UTF-8">
    <title>Sistema Vacaciones Loto</title>
    <link rel="stylesheet" type="text/css"href="View/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="View/css/AdminLTE.css"/>
    <script src="View/js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="View/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body style="background-color: #222d32; ">
<?php 
    if(!(isset($_SESSION['nickname']))){ ?>

<div class="form-box" >
<form method="POST" action="?c=Load&a=load">
    <div class = "box" style = "border-top-width: 0px; border-radius: 15px 15px 0 0; ">
        
        <div class="header" id ="color-header" style = "margin-bottom: 20px; background: #1a709a; " >
            <h1>Iniciar Sesión</h1>
        </div>
        

        <div class = "row-fluid" style = "margin-left: 15px; margin-right: 15px;">
            
                <div class= "form-group">
                    <input name = "user" class = "form-control" type="text" placeholder="Usuario"></input>
                </div>
            
        </div>

        
        <div class = "row-fluid">
            
                <div class= "form-group" style = "margin-left: 15px; margin-right: 15px;">
                    <input name = "pass"  type= "password" class="form-control" type="text" placeholder="Contraseña"></input>
                </div>
            
        </div>

        
        <div class="col-xs-3" style="float: none; margin: 0 auto;">
            <input  style = "margin-bottom: 15px; background: #1a709a;" type="submit" value="Iniciar" class="btn btn-success"></input>
        </div>
        
    </div>
    </form>
</div>

    
    <?php }else if($_SESSION['nickname'] == "Error"){ ?>
        <script>alert("Usuario o Contraseña Incorrectos!!");</script>
            <div class="form-box" >
            <form method="POST" action="?c=Load&a=load">
                <div class = "box" style = "border-top-width: 0px; border-radius: 15px 15px 0 0; ">
                    
                    <div class="header" id ="color-header" style = "margin-bottom: 20px; background: #1a709a; " >
                        <h1>Iniciar Sesión</h1>
                    </div>
                    

                    <div class = "row-fluid" style = "margin-left: 15px; margin-right: 15px;">
                        
                            <div class= "form-group">
                                <input name = "user" class = "form-control" type="text" placeholder="Usuario" required></input>
                            </div>
                        
                    </div>

                    
                    <div class = "row-fluid">
                        
                            <div class= "form-group" style = "margin-left: 15px; margin-right: 15px;">
                                <input name = "pass"  type= "password" class="form-control" type="text" placeholder="Contraseña" required></input>
                            </div>
                        
                    </div>

                    
                    <div class="col-xs-3" style="float: none; margin: 0 auto;">
                        <input  style = "margin-bottom: 15px; background: #1a709a;" type="submit" value="Iniciar" class="btn btn-success"></input>
                    </div>
                    
                </div>
            </form>
            </div>
            
        <?php  }
       ?>
</body>
</html>
           



