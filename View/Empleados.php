<?php if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
           ?>  
    <!-- Inicia la tabla con los valores -->
<form class="form" action="?c=Empleado&a=AddEmpleados" method="POST">
    <!-- POP UP -->
    <div class="modal-dialog" role="document">
        <div style="width: 130%;" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registar Empleado</h4>
            </div>

        <div class="modal-body">
            <div class="row row-fluid">
                <div class="col-sm-6">
                    <div class="form-group"><label>Primer Nombre</label><input id="desac1" name = "PNombre" ID="txtFullName"  Text=""  Enabled="false"></input></div>
                        <div class="form-group"><label>Primer Apellido</label><input id="desac3" name ="PApellido"ID="txtFullName"  Text=""  Enabled="false"></div>
                        <div class="form-group"><label>¿Reside en el país?</label>
                            <select id="desac5" name="Residencia">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select></div>
                        <div class="form-group"><label>Número INSS</label><input id="desac8" name="NInss" ID="" ></input></div>
                        <div class="form-group"><label>Fecha de Nacimiento</label>
                            <input  id="desac9" name ="FechaNac" type= "date" min="1950-01-01" max="2018-05-03"ID=""  Text=""  Enabled="false"></input></div>
                        <div class="form-group"><label>Hijos</label>
                            <select id="desac12" name="Hijos">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select></div>
                        </div>
                

                <div class="col-sm-6">
                    <div class="form-group"><label>SegundoNombre</label><input id="desac2" name ="SNombre" ID="txtmodaldireccion"  ></input></div>
                    <div class="form-group"><label>Segundo Apellido</label><input id="desac4" name="SApellido" ID="txtmodaldireccion"  ></input></div>
                    <div class="form-group"><label>Cedula</label><input id="desac6" name ="Cedula" ID=""></input></div>
                    <div class="form-group"><label>Pasaporte</label><input id="desac7" name ="Pasaporte" ID=""  Text=""  Enabled="false"></input></div>
                    <div class="form-group"><label>Sexo</label><select id="desac10" name="Sexo">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select></div>
                    <div class="form-group"><label>Número Hijos</label><input  id="desac13" name = "NumHijos" type="number" name="edad" min="0" max="30" step="1"></div>

                </div> <!-- ver si aquí da error -->

                <div class="col-sm-6">
                    <div class="form-group"><label>Hermanos</label><select id="desac14" name="Hermanos">
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div> 
                    <div class="form-group"><label>Teléfono</label><input id="desac16" name ="Telefono" ID=""  Text=""  Enabled="false"></input></div>
                    <div class="form-group"><label>Correo</label><input name="Correo" id="desac17"  ></input></div>
                    <div class="form-group"><label>N° Ruc</label><input id="desac19" name ="NRuc" type= "text"  Enabled="false"></input></div>
                             

                </div>

                <div class="col-sm-6">
                    <div class="form-group"><label>Numero hermanos</label><input  type="number" id="desac15" name="NumHermanos" min="0" max="30" step="1">
                    <div class="form-group"><label>Estado Civil</label> <select id="desac11" name="EstadoCivil">
                            <option value="Casado">Casado</option>
                            <option value="Soltero">Soltero</option>
                            <option value="Divorsiado">Divorsiado</option>
                            <option value="Viudo">Viudo</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Escolaridad</label><select id="desac18" name="Escolaridad">
                            <option value="Primaria">Primaria</option>
                            <option value="Secundaria">Secundaria</option>
                            <option value="Universidad">Universidad</option>
                            <option value="Postgrado">Postgrado</option>
                            <option value="Maestría">Maestría</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Profesión</label><input id="desac16" name ="Profesion" </input></div>
                    <div class="form-group"><label>Dirección</label><textarea id="desac21" name="Direccion" rows="3" style="width: 100%;" ></textarea>
                
                <br>
                <h3>Dirección:</h3>
                <div class="col-sm-6">
                    <div class="form-group"><label>Nacionalidad 1</label><input  id="desac22"name="Nacionalidad1" ID=""  ></input></div>
                </div>
                <div class="form-group"><label>Nacionalidad 2</label><input  id="desac23"name="Nacionalidad2" ID=""  ></input></div>

                            <div class="form-group"><label>Departamento</label>
                                <select id="desac24" name="Departamento">
                                    <option value="">Seleccione Departamento</option>          
                                </select> 
                            <div class="form-group"><label>Municipio</label>
                                <select id="desac25" name="IdMunicipio">
                                    <option value="">Seleccione Municipio</option>               
                                </select>
                            </div>        
                            
                            <div class="form-group"><label>Departamento Empresa</label>
                                <select id="desac24" name="Departamento">
                                    <option value="">Seleccione Departamento</option>         
                                </select></div>

                            <div class="form-group"><label>Cargo</label>
                                    <select  id="desac26"name="IdCargo">
                                        <option value="">Seleccione Cargo</option>
                                    </select>
                                </div>

                            <div class="form-group"><label>Jefe</label>
                                    <select  id="desac27" name="IdJefe">
                                        <option value="">Seleccione Jefe</option>
                                    </select>
                            </div>                    

                <div class="modal-footer">
                    <center><input type="submit" class="btn btn-primary"  value="Guardar Empleado"></input></center>
                </div>
            </div>
        </div>
        </div>
    </div>
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

<!-- valida que solo se escriba letras -->
<script>
function validaLetras(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[a-z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>
 <?php
    }else 
    {
        echo "Site not Found";
    } ?>

 <script src="View/js/RegistarEmp.js" type="text/javascript"></script>