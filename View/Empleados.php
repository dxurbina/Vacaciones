<!-- Inicia la tabla con los valores -->
<FRAME="border" RULES="none" >
<form class="form" action="?c=Empleado&a=AddEmpleados" method="POST">
<table width="80%" border="0" cellspacing="2" cellpadding="2"> 
<CAPTION style = "font-weight: bold" ><center> Datos personales</center></CAPTION>


<TBODY>
<TR><TD>Primer nombre: <TD> <input type="text" name="PNombre" size="15" required /><TD>Segundo nombre: <TD><input type="text" name="SNombre" size="15"  /></TR>
<TR><TD>Primer apellido: <TD><input type="text" name="PApellido" size="15" required /><TD>Segundo apellido: <TD><input type="text" name="SApellido" size="15" />
<TR><TD>N° cédula: <TD><input type="text" name="Cedula" size="15" required /><TD>Es Cédula Residencia: <TD><select name="Residencia"><option value="No">No</option>
    <option value="Si">Si</option>
</select>
<TR><TD>N° Inss: <TD><input type="text" name="NInss" size="15" /><TD>N° Pasaporte: <TD><input type="text" name="Pasaporte" size="15" />
<TR><TD>Fecha Nacimiento: <TD> <input type="text" name="FechaNac" size="15" placeholder="dd-mm-aaaa" required /><TD>Sexo: <TD><select name="Sexo">
        <option value="" disabled selected >Seleccione Sexo</option>
        <option value="Hombre">Hombre</option>
        <option value="Mujer">Mujer</option>
    </select>
<TR><TD>Hjos: <TD><select name="Hijos"><option value="0" >No</option>
    <option value="1">Si</option>
</select><TD>Num. Hijos: <TD><input type="text" name="NumHijos" size="5" placeholder="0" onkeypress="return valida(event)" maxlength="2"/>
<TR><TD>Hermanos: <TD><select name="Hermanos"><option value="0">No</option>
    <option value="1">Si</option>
</select><TD>Num. Hermanos: <TD><input type="text" name="NumHermanos" size="5" placeholder="0" onkeypress="return valida(event)" maxlength="2" />
<TR><TD>Télefonos: <TD><input type=a"text" name="Telefono" size="15" onkeypress="return valida(event)" maxlength="8" /><TD>Estado civil: <TD><select name="EstadoCivil">
                <option value="" disabled selected>Seleccione Estado civil</option>
                <option value="Soltero">Soltero/a.</option>
                <option value="Comprometido">Comprometido/a.</option>
                <option value="Casado">Casado/a.</option>   
                <option value="Divorciado">Divorciado/a.</option>
                <option value="Viudo">Viudo/a.</option>
            </select>
<TR><TD>E-mail: <TD> <input type="text" name="Correo" size="15" /><TD>Escolaridad: <TD><select name="Escolaridad">
                <option value="" disabled selected>Seleccione Escolaridad</option>
                <option value="Primaria">Primaria</option>
                <option value="Secundaria">Secundaria</option>
                <option value="Universidad">Universidad</option>
                <option value="Universidad">Postgrado</option>
                <option value="Universidad">Maestría</option>
                <option value="Universidad">Doctorado</option>
            </select>
<TR><TD>N° Ruc: <TD> <input value="" name="NRuc" size="15" /><TD>Profesión: <TD> <input value="" name="Profesion" size="20" />
    
<!-- VERIFICAR AQUÍ QUE SE VA A MANDAR A LLAMAR LA LISTA DE DEPTO -->
<TR><TD>Departamento: <TD> <select id = "cboDepto" name="Departamento" onchange="CargarMunicipios(this.value);">
                <option value="0" disabled selected>Seleccione  Departamento</option>
                <?php foreach ($this->Departamentos as $row){?> 
                <option value="<?php echo $row->IdDepartamento; ?>"> <?php echo $row->Nombre; ?></option>
                <?php } ?>
                </select> 

<!-- VERIFICAR AQUÍ QUE SE VA A MANDAR A LLAMAR LA LISTA DE MUNICIPIO FILTRADA POR EL IDDEPTO-->  
<br style="clear:both;">    
<TD>Municipio: <TD> <select id = "cboMun" name="IdMunicipio">
<option value="0" disabled selected>Seleccione Municipio</option>
<?php foreach ($this->mun as $mrow){?> 
                <option value="<?php echo $mrow->IdMunicipio; ?>"> <?php echo $mrow->Nombre; ?></option>
                <?php } ?>
                </select>  

       
<TR>
<TR><TD>Dirección: <TD> <textarea class="form-control" rows="1" id="Direccion"  cols="20" ></textarea> <TD>Nacionalidad 1: <TD><input type="text" name="Nacionalidad1" size="15" />

<TR><TD>Nacionalidad 2: <TD> <input type="text" name="Nacionalidad2" size="15" />

<TBODY>
<br>
</TABLE>
<br>
<div><center><input type="submit" value="Guardar Empleado"></center></div>  
</form>

<!-- valida que solo se escriba números -->
<script>
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>