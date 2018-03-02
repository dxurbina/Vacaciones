<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src= "js/jquery-1.9.0.min.js" type="text/javascript"></script>
    <script type="text/javascript"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empleados</title>
    <script src= "js/jspage.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="View/css/estilos.css"/>

    <!--<script type="text/javascript">
    
    /*Verificar aquí, para llamar la carga de la lista de los dptos y mun*/
    $('#cboDepto').change(function){
        $('#cboMun').empty();
        $.getJSOM('EmpleadoController.php', [Accion:'listarMunPorDeptos', IdDepartamento: $('#cboDepto option:selected'.val(), function(EmpleadoDAO))] )
           for (x=0; x<EmpleadoDAO.length;x++){
            $("#cboMun").append(new Option (EmpleadoDAO[x].Departamento, EmpleadoDAO[x].IdDepto));
           }
           
       }
   })
}
</script>-->

</head>

<body>

<!-- Inicia la tabla con los valores 
FRAME="border" RULES="none" -->

<TABLE class="tabla">
<table width="80%" border="0" cellspacing="2" cellpadding="0"> 
<CAPTION>Datos personales</CAPTION>
<COLGROUP align="center">
<COLGROUP align="left">
<COLGROUP align="center" span="2">
<COLGROUP align="center" span="3">

<TBODY>
<TR><TD>1er. nombre: <TD> <input type="text" name="PNombre" size="15" /><TD>2do. nombre: <TD><input type="text" name="SNombre" size="15" />
<TR><TD>1er. apellido: <TD><input type="text" name="PApellido" size="15" /><TD>2do. apellido: <TD><input type="text" name="SApellido" size="15" />
<TR><TD>Es Cédula Residencia: <TD><select name="Residencia"><option value="" disabled selected>No</option>
    <option value="">Si</option>
</select><TD>N° cédula: <TD><input type="text" name="Cedula" size="15" />
<TR><TD>N° Inss: <TD><input type="text" name="NInss" size="15" /><TD>N° Pasaporte: <TD><input type="text" name="Pasaporte" size="15" />
<TR><TD>Fecha Nacimiento: <TD> <input type="text" name="FechaNac" size="15" placeholder="dd-mm-aaaa" /><TD>Sexo: <TD><select name="Sexo">
        <option value="" disabled selected>Seleccione el Sexo</option>
        <option value="Hombre">Hombre</option>
        <option value="Mujer">Mujer</option>
    </select>
<TR><TD>Hjos: <TD><select name="Hijos"><option value="" disabled selected>No</option>
    <option value="">Si</option>
</select><TD>Num. Hijos: <TD><input type="text" name="NumHijos" size="5" placeholder="0" />
<TR><TD>Hermanos: <TD><select name="Hermanos"><option value="" disabled selected>No</option>
    <option value="">Si</option>
</select><TD>Num. Hermanos: <TD><input type="text" name="NumHermanos" size="5" placeholder="0" />
<TR><TD>Télefonos: <TD><input type="text" name="Telefono" size="15" /><TD>Estado civil: <TD><select name="EstadoCivil">
                <option value="" disabled selected>Seleccione Estado civil</option>
                <option value="Soltero">Soltero/a.</option>
                <option value="Comprometido">Comprometido/a.</option>
                <option value="Casado">Casado/a.</option>
                <option value="Divorciado">Divorciado/a.</option>
                <option value="Viudo">Viudo/a.</option>
            </select>
<TR><TD>E-mail: <TD> <input type="text" name="Correo" size="15" /><TD>Escolaridad: <TD><select name="Escolaridad">
                <option value="" disabled selected>Seleccione la Escolaridad</option>
                <option value="Primaria">Primaria</option>
                <option value="Secundaria">Secundaria</option>
                <option value="Universidad">Universidad</option>
                <option value="Universidad">Postgrado</option>
                <option value="Universidad">Maestría</option>
                <option value="Universidad">Doctorado</option>
            </select>
<TR><TD>N° Ruc: <TD> <input type="text" name="NRuc" size="15" /><TD>Profesión: <TD> <input type="text" name="Profesion" size="20" />
    <td>&nbsp;</td>
    
<!-- VERIFICAR AQUÍ QUE SE VA A MANDAR A LLAMAR LA LISTA DE DEPTO -->
<TR><TD>Departamento: <TD> <select id = "cboDepto" name="Departamento">
                <option value="0" disabled selected>Seleccione El Departamento</option>
                <?php foreach ($this->Departamentos as $row){?> 
                <option value="<?php echo $row->IdDepartamento; ?>"> <?php echo $row->Nombre; ?></option>
                <?php } ?>
                </select>

<!-- VERIFICAR AQUÍ QUE SE VA A MANDAR A LLAMAR LA LISTA DE MUNICIPIO FILTRADA POR EL IDDEPTO-->           
<TR><TD>Municipio: <TD> <select id = "cboMun" name="Municipio">
<option value="0" disabled selected>Seleccione El Municipio</option>
                <?php foreach ($this->mun as $mrow){?> 
                <option value="<?php echo $mrow->IdMunicipio; ?>"> <option value="<?php echo $mrow->IdDepartamento; ?>"> <?php echo $mrow->Nombre; ?></option>
                <?php } ?>
                </select>  

<TR><TD>Dirección: <TD> <textarea class="form-control" rows="2" id="Direccion" size="40"></textarea>
<TR><TD>Nacionalidad 1: <TD><input type="text" name="Nacionalidad" size="15" />
<TR><TD>Nacionalidad 2: <TD> <input type="text" name="Nacionalidad2" size="15" />
<TR><TD>Habilitado: <TD><select name="Estado">
                    <option value="" disabled selected>No</option>
                    <option value="">Si</option>
                </select>
<TBODY>
</TABLE>
<br><center><input type="button" value="Guardar Empleado"></center>

</body>

</html>