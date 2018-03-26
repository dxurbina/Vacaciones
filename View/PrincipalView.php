<?php 
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
    <a href="?c=Empleado">Registrar Empleado</a><br>
    <a href="?c=Empleado&a=ListEmployeeView">Ver Empleados</a><br>
    <a href="?c=Load&a=close">Cerrar Sesión</a>
<?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 4){ ?>
    <p>accedió como admin</p>
    <a href="?c=Empleado">Registrar Empleado</a><br>
    <a href="?c=Empleado&a=ListEmployeeView">Ver Empleados</a><br>
    <a href="?c=Load&a=close">Cerrar Sesión</a><br>
    <a href="?c=Vacaciones">Solicitar Vacaciones</a><br>
    <a href="?c=Vacaciones&a=Requests">Solicitudes de Vacaciones</a><br>
    <a href="?c=SaldoVacaciones&a=indexHistory">Balance Empleados a Cargo</a>
<?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 3){ ?>
    <p>Accedió como Recursos humanos</p>
    <a href="?c=Empleado">Registrar Empleado</a><br>
    <a href="?c=Empleado&a=ListEmployeeView">Ver Empleados</a><br>
    <a href="?c=Load&a=close">Cerrar Sesión</a>
<?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 2){ ?>
    <script>alert("Bienvenido")</script>
    <p>Usted tiene personal a cargo</p><br>
    <a href="?c=Load&a=close">Cerrar Sesión</a><br>
<?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 1){ ?> <!--Este lo agregue 14/03 -->
    <a href="?c=SaldoVacaciones">Ver Saldo Vacaciones</a><br> <!-- Este es para ver saldo vacaciones -->
    <a href="?c=Vacaciones">Solicitar Vacaciones</a><br>
    <a href="?c=Load&a=close">Cerrar Sesión</a><br>
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
        else { ?>
            <p>Accedió como Usuario Comun</p><br>
            <a href="?c=Load&a=close">Cerrar Sesión</a>
        <?php }  ?>