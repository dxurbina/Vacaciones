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
                    <div class="form-group"><label>Primer Nombre</label><input id="PNombre" name = "PNombre" size="20" required onkeypress="return validaLetras(event)" ></input></div>
                        <div class="form-group"><label>Primer Apellido</label><input id="PApellido" name ="PApellido" size="20" required onkeypress="return validaLetras(event)"></div>
                        <div class="form-group"><label>¿Reside en el país?</label>
                            <select id="Residencia" name="Residencia">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select></div>
                        <div class="form-group"><label>Número INSS</label><input id="NInss" name="NInss" size="20" ></input></div>
                        <div class="form-group"><label>Fecha de Nacimiento</label>
                            <input  id="FechaNac" name ="FechaNac" type= "date" min="1950-01-01" max="2018-05-03"ID=""  Text=""  Enabled="false"></input></div>
                        <div class="form-group"><label>Hijos</label>
                            <select id="Hijos" name="Hijos" onkeypress="return valida(event)">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select></div>
                        </div>
                
                <div class="col-sm-6">
                    <div class="form-group"><label>SegundoNombre</label><input id="SNombre" name ="SNombre" ID="txtmodaldireccion"  ></input></div>
                    <div class="form-group"><label>Segundo Apellido</label><input id="SApellido" name="SApellido" ID="txtmodaldireccion" onkeypress="return validaLetras(event)"></input></div>
                    <div class="form-group"><label>Cédula</label><input id="Cedula" name ="Cedula" ID=""></input></div>
                    <div class="form-group"><label>Pasaporte</label><input id="Pasaporte" name ="Pasaporte" ID=""  Text=""  Enabled="false"></input></div>
                    <div class="form-group"><label>Sexo</label><select id="Sexo" name="Sexo">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select></div>
                    <div class="form-group"><label>Número Hijos</label><input type="text" name="NumHijos" size="5" placeholder="0" onkeypress="return valida(event)" maxlength="2"></div>

                </div> <!-- ver si aquí da error -->

                <div class="col-sm-6">
                    <div class="form-group"><label>Hermanos</label><select id="Hermanos" name="Hermanos"></div>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div> 
                    <div class="form-group"><label>Teléfono</label><input id="Telefono" name ="Telefono" ID=""  Text=""  Enabled="false" onkeypress="return valida(event)" maxlength="8"></input></div>
                    <div class="form-group"><label>Correo</label><input id="Correo" name="Correo" ></input></div>
                    <div class="form-group"><label>Nacionalidad 1</label><input  id="Nacionalidad1"name="Nacionalidad1" ID=""  ></input></div>
                    <div class="form-group"><label>Estado Civil</label> <select id="EstadoCivil" name="EstadoCivil">
                            <option value="" disabled selected>Seleccione Estado civil</option>
                            <option value="Casado">Casado</option>
                            <option value="Soltero">Soltero</option>
                            <option value="Divorsiado">Divorsiado</option>
                            <option value="Viudo">Viudo</option>
                        </select>
                    </div>
               </div>

                <div class="col-sm-6">
                    <div class="form-group"><label>Número hermanos</label><input type="text" name="NumHijos" size="5" placeholder="0" onkeypress="return valida(event)" maxlength="2"></div>
                    <div class="form-group"><label>Profesión</label><input id="Profesion" name ="Profesion" </input></div>
                    <div class="form-group"><label>N° Ruc</label><input id="NRuc" name ="NRuc" type= "text"  Enabled="false"></input></div> 
                    <div class="form-group"><label>Nacionalidad 2</label><input  id="Nacionalidad2"name="Nacionalidad2" ID=""  ></input></div>
                    <div class="form-group"><label>Escolaridad</label><select id="Escolaridad" name="Escolaridad">
                            <option value="" disabled selected>Seleccione Escolaridad</option>
                            <option value="Primaria">Primaria</option>
                            <option value="Secundaria">Secundaria</option>
                            <option value="Universidad">Universidad</option>
                            <option value="Postgrado">Postgrado</option>
                            <option value="Maestría">Maestría</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group"><label>Dirección</label><textarea id="Direccion" name="Direccion" rows="3" style="width: 100%;" ></textarea></div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group"><label>Departamento</label>
                        <select id="cboDepto" name="Departamento">
                            <option value="0">Seleccione Departamento</option>
                            <?php foreach ($this->Departamentos as $row){?> 
                            <option value="<?php echo $row->IdDepartamento; ?>"> <?php echo $row->Nombre; ?></option>
                            <?php } ?>
                        </select>
                </div> 
                    <div class="form-group"><label>Depto. Empresa</label>
                        <select id="dptoEmp" name="Departamento">
                            <option value="0">Seleccione Depto Empresa</option>
                            <?php foreach ($this->DeptoEmp as $row){?> 
                            <option value="<?php echo $row->IdDep; ?>"> <?php echo $row->Nombre; ?></option>
                            <?php } ?>         
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group"><label>Municipio</label>
                        <select id="cboMun" name="IdMunicipio">
                            <option value="">Seleccione Municipio</option>               
                        </select>
                    </div>  
                    <div class="form-group"><label>Cargo</label>
                        <select  id="cargos"name="IdCargo">
                            <option value="">Seleccione Cargo</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Jefe</label>
                        <select  id="jefe" name="IdJefe">
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                </div>                              

                <div class="modal-footer">
                    <center><input type="submit" class="btn btn-primary" value="Guardar Empleado"></input></center>
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