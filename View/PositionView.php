<?php if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
           ?>
<div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Gestion de Cargos</h3>
                    <button title= "Add" value= "Agregar" class="btn btn-primary btn-add col-md-offset-8" data-target="#imodal" data-toggle="modal">Agregar Cargo</button>

                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Empleados"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">    
                                <th>IdCargo</th>
                                <th>Nombre del Cargo</th>
                                <th>Cargo Supervisor</th>
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

    <div  class="modal fade" id ="imodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 15%; margin-top: 5%;" role="document">
            <div style="width: 165%;" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Registrar Cargo</h4>
                    
                </div>
                <form action="?c=Position&a=store" method="POST">
                <div class="modal-body">
                    <div class="row row-fluid">

                        <div class="col-sm-4">

                                <div class="form-group"><label>Nombre Cargo </label></div>
                                <div class="form-group"><input  id="name" name="Nombre" ID=""  ></input></div>
                            

                            <div class="form-group">
                                        <label>Departamento</label></div>
                                        <div class="form-group"><select id="depto" name="Departamento">    
                                                                        <option value="">Seleccione</option>            
                                                                </select>
                                        </div>
                        </div>
                        <div class="col-sm-4">
                                    <div class="form-group">
                                    <label>Centro Costos</label></div>
                                    <div class="form-group"><select id="costo" name="costo">                
                                                            </select>
                                    </div>

                                    <div class="form-group">
                                    <label>Cargo Supervisor</label></div>
                                    <div class="form-group"><select id="jefe" name="jefe">                
                                                            </select>
                                    </div>
                        </div>
                        <div class="col-sm-4">
                                     <div class="form-group">
                                    <label>Factor</label></div>
                                    <div class="form-group"><select id="factor" name="factor">                
                                                            </select>
                                    </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                
                    <input type="submit" class="btn btn-primary" id="btnStore" value="Registrar"></input>
                </div>
                
                </form>
            </div>
        </div>
    </div>

    <div  class="modal fade" id ="imodal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 15%; margin-top: 5%;" role="document">
            <div style="width: 165%;" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actualizar registro</h4>
                    
                </div>
                <form action="?c=Position&a=update" method="POST">
                <div class="modal-body">
                    <div class="row row-fluid">

                         
                
                    </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" id="btnActualizar" value="Actualizar"></input>
                </div>
                
                </form>
            </div>
        </div>
    </div>

    <script src="View/js/Position.js" type="text/javascript"></script>
        <?php
}else {
        echo "Site not Found";
} ?>