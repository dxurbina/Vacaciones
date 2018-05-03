<?php if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
           ?>
<div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Lista de Empleados</h3>
                   

                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Empleados"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">    
                                <th>IdEmpleado</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Departamento</th>
                                <th>Nombre del Cargo</th>
                                <th>Nombre Jefe</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar Empleados por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>


    <!-- POP UP -->
    
    <div  class="modal fade" id ="imodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 15%; margin-top: 5%;" role="document">
            <div style="width: 165%;" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actualizar registro</h4>
                    
                </div>
                <form action="?c=Empleado&a=AddEmpleados" method="POST">
                <div class="modal-body">
                    <div class="row row-fluid">
                        <div class="col-sm-3">
                            <input  hidden type = "text" id= "CargarEmpleado" name = "idEmpleado" />
                            <div class="form-group"><label>Primer Nombre</label></div>
                            <div class="form-group"><input id="desac1" class="input_let" name = "PNombre" ID="txtFullName"  Text=""  Enabled="false" required /></div>
                            <div class="form-group"><label>SegundoNombre</label></div>
                            <div class="form-group"><input id="desac2" class="input_let" name ="SNombre" ID="txtmodaldireccion"  required></input></div>
                            <div class="form-group"><label>Primer Apellido</label></div>
                            <div class="form-group"><input id="desac3" class="input_let" name ="PApellido"ID="txtFullName"  Text=""  Enabled="false" required></input></div>
                            <div class="form-group"><label>Segundo Apellido</label></div>
                            <div class="form-group"><input id="desac4" class="input_let" name="SApellido" ID="txtmodaldireccion"  required></input></div>
                            <div class="form-group"><label>¿Reside en el país?</label></div>
                            <div class="form-group"><select id="desac5" name="Residencia">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select></div>
                            <div class="form-group"><label>Cedula</label></div>
                            <div class="form-group"><input id="desac6" name ="Cedula" ID="" required></input></div>
                            <div class="form-group"><label>Pasaporte</label></div>
                            <div class="form-group"><input id="desac7" name ="Pasaporte" ID=""  Text=""  Enabled="false"></input></div>
                            
                        </div>
                        <div class="col-sm-3">
                            
                            <div class="form-group"><label>Numero INSS</label></div>
                            <div class="form-group"><input id="desac8" name="NInss" ID=""  ></input></div>
                                <div class="form-group">
                                    <label>Fecha de Nacimiento</label>
                                </div>
                                <div class="form-group"><input  id="desac9" name ="FechaNac" type= "date" min="1950-01-01" max="2018-05-03"ID=""  Text=""  Enabled="false"></input></div>
                                <div class="form-group">
                                    <label>Fecha de Ingreso</label>
                                </div>
                                <div class="form-group"><input  id="desac29" name ="FechaIng" type= "date" min="1950-01-01" max="2018-05-03"ID=""  Text=""  Enabled="false" required></input></div>
                                
                                <div class="form-group">
                                    <div class="row row-fluid">
                                        <div class="col-xs-6">
                                            <div class="form-group"><label>Sexo</label></div>
                                            <div class="form-group"><select id="desac10" name="Sexo">
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                            </select></div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group"><label>Est. Civil</label></div>
                                            <div class="form-group"><select id="desac11" name="EstadoCivil">
                                                <option value="Casado">Casado</option>
                                                <option value="Soltero">Soltero</option>
                                                <option value="Divorsiado">Divorsiado</option>
                                                <option value="Viudo">Viudo</option>
                                            </select></div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-fluid">
                                        <div class="col-xs-6">
                                            <div class="form-group"><label>Hijos</label></div>
                                            <div class="form-group"><select id="desac12" name="Hijos">
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                            </select></div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group"><label>Numero</label></div>
                                            <input  id="desac13" class="input_num" name = "NumHijos" type="number" name="edad" min="0" max="30" step="1">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-fluid">
                                        <div class="col-xs-6">
                                            <div class="form-group"><label>Hermanos</label></div>
                                            <div class="form-group"><select  id="desac14" name="Hermanos">
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                            </select></div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group"><label>Numero</label></div>
                                            <input  type="number" class="input_num" id="desac15" name="NumHermanos" min="0" max="30" step="1">
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="form-group"><label>Telefono</label></div>
                                <div class="form-group"><input class="input_num" id="desac16" name ="Telefono" ID=""  Text=""  Enabled="false"></input></div>
                            
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group"><label>Correo</label></div>
                            <div class="form-group"><input type="email" name="Correo" id="desac17"  ></input></div>

                                <div class="form-group">
                                    <label>Escolaridad</label></div>
                                    <div class="form-group"><select id="desac18" name="Escolaridad">
                                                <option value="Primaria">Primaria</option>
                                                <option value="Secundaria">Secundaria</option>
                                                <option value="Universidad">Universidad</option>
                                                <option value="Postgrado">Postgrado</option>
                                                <option value="Maestría">Maestría</option>
                                                </select></div>
                                        
                                

                                <div class="form-group"><label>Num Ruc</label></div>
                                <div class="form-group"><input id="desac19" name ="NRuc" type= "text"  Enabled="false"></input></div>
                                <div class="form-group"><label>Profesion</label></div>
                                <div class="form-group"><input id="desac20" class="input_let" name ="Profesion" type= "text" Enabled="false"></input></div>
                                
                                <div class="form-group"><label>Dirección</label></div>
                                <textarea id="desac21" name="Direccion" rows="3" style="width: 100%;" >Write something here</textarea>
                                <div class="form-group">
                                    <label>Centro Costos</label>
                                </div>
                                <div class="form-group"><input  id="desac30" name ="FechaNac"  Text=""  Enabled="false"></input></div>
                                
                                
                        </div>



                         <div class="col-sm-3">
                            
                           
                            

                            <div class="form-group"><label>Nacionalidad 1</label></div>
                            <div class="form-group"><input  class="input_let" id="desac22"name="Nacionalidad1" ID=""  ></input></div>

                            <div class="form-group"><label>Nacionalidad2</label></div>
                            <div class="form-group"><input  class="input_let" id="desac23"name="Nacionalidad2" ID=""  ></input></div>

                                <div class="form-group">
                                    <label>Departamento</label></div>
                                    <div class="form-group"><select id="desac24" name="Departamento">
                                                
                                                
                                                </select></div>

                            <div class="form-group">
                                <label>Municipio</label></div>
                                <div class="form-group"><select id="desac25" name="IdMunicipio"> 
                                            </select>
                                </div>

                                <div class="form-group">
                                <label>Depto Empresa</label></div>
                                <div class="form-group"><select  id="desac26"name="DptoEmpresa">
                                                
                                            </select>
                                </div>
     
                                

                                <div class="form-group">
                                <label>Cargo</label></div>
                                <div class="form-group"><select  id="desac27" name="IdCargo">
                                                
                                            </select>
                                </div>

                                <div class="form-group">
                                <label>Jefe</label></div>
                                <div class="form-group"><select  id="desac28" name="IdJefe" required>
                                               
                                            </select>
                                </div>
                                
                               
                        </div>
                        

                    
                    </div>
                
                </div>
                <div class="modal-footer">
                <select  id="casilla" name="Edit">
                      <option value="Ver">Ver</option>
                      <option value="Editar">Editar</option>s
                    </select>
                    <input type="submit" class="btn btn-primary" id="btnActualizar" value="Actualizar"></input>
                </div>
                
                </form>
            </div>
        </div>
    </div>

<!--Modal para confirmar-->
   <div class="modal fade" id="imodalel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>¿Desea eliminar el empleado seleccionado?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-primary" id="update" value ="Aceptar" />
                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="btnCancel">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div  class="modal fade" id ="imodalusr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 15%; margin-top: 5%;" role="document">
            <div style="width: 165%;" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
                    
                </div>
                <form action="#" method="POST" name ="send">
                <div class="modal-body">
                    <div class="row row-fluid">

                        <div class="col-sm-6">

                                <div class="form-group"><label>Usuario</label></div>
                                <div class="form-group"><input  id="usr" name="Nombre"  required></input></div>
                            

                            
                        </div>
                        <div class="col-sm-6">
                                <div class="form-group"><label>Contraseña</label></div>
                                <div class="form-group"><input type="password" id="pass" name="Codigo" ID=""  required></input></div>
                            

                                    
                        </div>
                        

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" id="btnUser" value="Actualizar"></input>
                </div>
                
                </form>
            </div>
        </div>
    </div>

        <script src="View/js/Empleado.js" type="text/javascript"></script>
        <script src="View/js/Validate.js" type="text/javascript"></script>
        
        <?php
    }else {
        echo "Site not Found";
    } ?>