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
    <div class="modal fade" id ="imodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actualizar registro</h4>
                </div>
                <div class="modal-body">
                    <div class="row row-fluid">
                        <div class="col-xs-6">
                            <div class="form-group"><label>Primer Nombre</label></div>
                            <div class="form-group"><input name = "PNombre" ID="txtFullName"  Text=""  Enabled="false"></input></div>
                            <div class="form-group"><label>SegundoNombre</label></div>
                            <div class="form-group"><input name ="SNombre" ID="txtmodaldireccion"  ></input></div>
                            <div class="form-group"><label>Primer Apellido</label></div>
                            <div class="form-group"><input name ="PApellido"ID="txtFullName"  Text=""  Enabled="false"></input></div>
                            <div class="form-group"><label>Segundo Apellido</label></div>
                            <div class="form-group"><input name="SApellido" ID="txtmodaldireccion"  ></input></div>
                            <div class="form-group"><label>¿Reside en el país?</label></div>
                            <div class="form-group"><select name="Residencia">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select></div>
                            <div class="form-group"><label>Cedula</label></div>
                            <div class="form-group"><input name ="Cedula" ID=""></input></div>
                            <div class="form-group"><label>Pasaporte</label></div>
                            <div class="form-group"><input name ="Pasaporte" ID=""  Text=""  Enabled="false"></input></div>
                            <div class="form-group"><label>Numero INSS</label></div>
                            <div class="form-group"><input name="NInss" ID=""  ></input></div>

                        </div>
                        <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Fecha de Nacimiento</label>
                                </div>
                                <div class="form-group"><input name ="FechaNac" type= "date" min="1950-01-01" max="2018-05-03"ID=""  Text=""  Enabled="false"></input></div>
                                <div class="form-group"><label>Sexo</label></div>
                                <div class="form-group"><select name="Residencia">
                                <option value="Hombre">Si</option>
                                <option value="Mujer">No</option>
                                </select></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" id="btnActualizar" value="Actualizar"></input>
                </div>
            </div>
        </div>

    </div>



        <script src="View/js/Empleado.js" type="text/javascript"></script>
        <?php
    }else {
        echo "Site not Found";
    } ?>