<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <title>Vacaciones</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="View/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="View/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="View/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="View/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="View/AdminLTE/dist/css/skins/skin-blue.min.css">
    <link rel="stylesheet" href="View/js/jquery-ui-1.12.1.custom/jquery-ui.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">




    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    -->
    <link href="View/css/estilos2.css" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css" type="text/css" media="all">

    
    
     <link rel="stylesheet" type="text/css" href="View/css/estilos.css"/>  


  

    <script src="View/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="View/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="View/AdminLTE/dist/js/adminlte.min.js"></script>

    <script src="View/js/jquery-ui-1.12.1.custom/jquery-ui.min.js" type="text/javascript"></script>
    
    <script src="View/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>

    <script src="View/js/plugins/datatables/dataTables.bootstrap.js"></script>

    <script src="View/js/notif.js" type="text/javascript"></script>
    <!--Libreria min -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

      
    
</head>
<body class="skin-blue">
  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="?c=Principal" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sistema</b>Vacaciones</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu" style = "">
            <!-- Menu toggle button -->
            <a href="#" id="notif" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span id="cont" class="label label-warning"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Notificaciones</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul id="list" class="menu">
                  <li id="base">
                    <!-- start notification -->
                    
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="?c=Principal">Inicio</a></li>
            </ul>
          </li>
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="img/perfil.jpg" class="user-image" alt="User Image">&nbsp;&nbsp;&nbsp;&nbsp;
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo  $_SESSION['data']->PNombre . " " .  $_SESSION['data']->PApellido . " "; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="img/perfil.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php  echo $_SESSION['data']->PNombre . " " .  $_SESSION['data']->PApellido; ?> - <?php echo $_SESSION['data']->NombreCargo ?>
                 <!--  <small>Member since Nov. 2012</small>-->
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                   <!-- <a href="#">Followers</a>-->
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="?c=SaldoVacaciones">Mi saldo</a>
                  </div>
                  <div class="col-xs-4 text-center">
                  <!--  <a href="#">Friends</a>-->
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="" class="btn-usrI btn btn-default btn-flat" data-target="#imodalusrI" data-toggle="modal">Cambiar Contraseña</a>
                </div>
                <div class="pull-right">
                  <a href="?c=Load&a=close" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
     <!--   <div class="user-panel">
        <div class="pull-left image"> -->
        <!--  <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
      <!--    </div>
        <div class="pull-left info"> -->
          <!-- print Name -->
    <!--        <p>Alexander Pierce</p> -->
          <!-- Status -->
      <!--       <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
    <!--      </div>
      </div>
 -->
      <!-- search form (Optional) -->
    <!--     <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>-->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
                <?php 
            if( isset($_SESSION['access']) && $_SESSION['access'] == 5){ ?>
           <!--  <p>accedió como RRHH-Supervisor</p>-->
            <li><a href="?c=Empleado"><i class="fa fa-link"></i> <span>Nuevo Colaborador</span></a></li>
            <li><a href="?c=Empleado&a=ListEmployeeView"><i class="fa fa-link"></i> <span>Registros de Colaboradores</span></a></li>
            <li><a href="?c=SaldoVacaciones"><i class="fa fa-link"></i> <span>Mi Saldo</span></a></li>
            <li><a href="?c=Vacaciones&a=Requests"><i class="fa fa-link"></i> <span>His Solicitudes Colaboradores</span></a></li>
            <li><a href="?c=SaldoVacaciones&a=indexHistory"><i class="fa fa-link"></i> <span>Saldo de Colaboradores</span></a></li>
              <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Catálogo</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?c=Report">Reporte Vacaciones</a></li>
              <li><a href="?c=Position">Gestión de Cargos</a></li>
              <li><a href="?c=Center">Gestión de Centro de Costos</a></li>
              <li><a href="?c=Factores">Gestión de Factores</a></li>
              <li><a href="?c=DeptosEmpresa">Gestión de DeptosEmpresa</a></li>
              <li><a href="?c=Feriados">Feriados</a></li>
              <li><a href="?c=SaldoColaboradores">Saldo de colaboradores</a></li>
            </ul>


          </li>
        <?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 4){ ?>
           <!--  <p>accedió como admin</p> -->
            <li><a href="?c=Empleado"><i class="fa fa-link"></i> <span>Nuevo Colaborador</span></a></li>
            <li><a href="?c=Empleado&a=ListEmployeeView"><i class="fa fa-link"></i> <span>Registros de Colaboradores</span></a></li>
            <li><a href="?c=SaldoVacaciones"><i class="fa fa-link"></i> <span>Mi Saldo</span></a></li>
            <li><a href="?c=Vacaciones&a=Requests"><i class="fa fa-link"></i> <span>His Solicitudes Colaboradores</span></a></li>
            <li><a href="?c=SaldoVacaciones&a=indexHistory"><i class="fa fa-link"></i> <span>Saldo de Colaboradores</span></a></li>
  
            <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Catálogo</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="?c=Report">Reporte Vacaciones</a></li>
              <li><a href="?c=Factores">Gestión de Factores</a></li>
              <li><a href="?c=DeptosEmpresa">Gestión de DeptosEmpresa</a></li>
              <li><a href="?c=Position">Gestión de Cargos</a></li>
              <li><a href="?c=Center">Gestión de Centro de Costos</a></li>
              <li><a href="?c=Feriados">Feriados</a></li>
              <li><a href="?c=SaldoColaboradores">Saldo de colaboradores</a></li>
            </ul>


          </li>
        <?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 3){ ?>
           <!--  <p>Accedió como Recursos humanos</p>-->
          <li><a href="?c=Empleado"><i class="fa fa-link"></i> <span>Nuevo Colaborador</span></a></li>
          <li><a href="?c=Empleado&a=ListEmployeeView"><i class="fa fa-link"></i> <span>Registros de Colaboradores</span></a></li>
          <li><a href="?c=SaldoVacaciones"><i class="fa fa-link"></i> <span>Mi Saldo</span></a></li>
            <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Catálogo</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="?c=Report">Reporte Vacaciones</a></li>
              <li><a href="?c=Position">Gestión de Cargos</a></li>
              <li><a href="?c=Center">Gestión de Centro de Costos</a></li>
              <li><a href="?c=DeptosEmpresa">Gestión de DeptosEmpresa</a></li>
              <li><a href="?c=SaldoColaboradores">Saldo de colaboradores</a></li>
            </ul>


          </li>
          
        <?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 2){ ?>
             <!-- <p>Usted tiene personal a cargo</p><br> -->
            <li><a href="?c=SaldoVacaciones"><i class="fa fa-link"></i> <span>Mi Saldo</span></a></li>
            <li><a href="?c=Vacaciones&a=Requests"><i class="fa fa-link"></i> <span>His Solicitudes Colaboradores</span></a></li>
            <li><a href="?c=SaldoVacaciones&a=indexHistory"><i class="fa fa-link"></i> <span>Saldo de Colaboradores</span></a></li>
            
        <?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 1){ ?> <!--Este lo agregue 14/03 -->
             <!-- <p>Accedió como Colaborador</p> -->
             <li><a href="?c=SaldoVacaciones"><i class="fa fa-link"></i> <span>Mi Saldo</span></a></li>
             <!--<li><a href="?c=Feriados"><i class="fa fa-link"></i> <span>Feriados</span></a></li>-->
        <?php }else if($_SESSION['nickname'] == "Error"){ ?>
            <script>alert("Usuario o contraseña incorrectos!!!")</script>
            <form method="POST" action="?c=Load&a=load">
            <center>Usuario</center>
            <center><input type="text" name="user" /></center>
            <center>Contraseña</center>
            <center><input type="password" name="pass" /></center>
            <center><input type="submit" value="Log In"/></center>
            </form>
            <?php  }
        ?>
            



      
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) 
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>
-->
    <!-- Main content  -->
    <section class="content container-fluid">

  
  

    
