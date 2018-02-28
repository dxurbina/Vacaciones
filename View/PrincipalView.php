<?php 
    if(!(isset($_SESSION['nickname']))){ ?>
<form method="POST" action="?c=Load&a=load">
    <center>Usuario</center>
    <center><input type="text" name="user" /></center>
    <center>Contraseña</center>
    <center><input type="text" name="pass" /></center>
    <center><input type="submit" value="Log In"/></center>
</form>
<?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 5){ ?>
    <p>accedió como RRHH-Supervisor</p>
<?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 4){ ?>
    <p>accedió como admin</p>
<?php }else if( isset($_SESSION['access']) && $_SESSION['access'] == 3){ ?>
    <p>Accedió como Recursos humanos</p>
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