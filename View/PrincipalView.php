<?php 
session_start();
    if(!(isset($_SESSION['nickname']))){ ?>
<form method="POST" action="?c=Load&a=load">
    <center>Usuario</center>
    <center><input type="text" name="user" /></center>
    <center>Contraseña</center>
    <center><input type="password" name="pass" /></center>
    <center><input type="submit" value="Log In"/></center>
</form>
<?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 5){ ?>
    <p>accedió como RRHH-Supervisor</p>
    <a href="?c=Empleado">Registrar Empleado</a>
    <a href="?c=Empleado&a=ListEmployeeView">Ver Empleados</a>
<?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 4){ ?>
    <p>accedió como admin</p>
    <a href="?c=Empleado">Registrar Empleado</a>
    <a href="?c=Empleado&a=ListEmployeeView">Ver Empleados</a>
<?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 3){ ?>
    <p>Accedió como Recursos humanos</p>
    <a href="?c=Empleado">Registrar Empleado</a>
    <a href="?c=Empleado&a=ListEmployeeView">Ver Empleados</a>
<?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 2){ ?>
    <script>alert("Bienvenido")</script>
    <p>Usted tiene personal a cargo</p>
<?php }else if($_SESSION['nickname'] == "Error"){ ?>
    <script>alert("Usuario o contraseña incorrectos!!!")</script>
    <form method="POST" action="?c=Load&a=load">
    <center>Usuario</center>
    <center><input type="text" name="user" /></center>
    <center>Contraseña</center>
    <center><input type="text" name="pass" /></center>
    <center><input type="submit" value="Log In"/></center>
    </form>
    <?php  }
        else { ?>
            <p>Accedió como Usuario Comun</p>
        <?php }  ?>