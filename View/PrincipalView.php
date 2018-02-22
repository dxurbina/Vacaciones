<?php if(!(isset($this->access))){ ?>
<form method="POST" action="?c=Load&a=load">
    <center>Usuario</center>
    <center><input type="text" name="user" /></center>
    <center>Contraseña</center>
    <center><input type="text" name="pass" /></center>
    <center><input type="submit" value="Log In"/></center>
</form>
<?php }else if( $this->access = "1"){ ?>
    <p>Accedio El Gerente</p>
<?php }else if( $this->access = "2"){ ?>
    <p>Accedio Un Empleado Comun</p>
<?php }else if($this->access = "incorrecto"){ ?>
    <script>alert("Usuario o contraseña incorrectos!!!");/script>
<?php header("Location: index.php?c=Principal"); } ?>