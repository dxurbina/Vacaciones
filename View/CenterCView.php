<?php if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
           ?>
<div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Gestión de Centro de Costos</h3>
                    <button title= "Add" value= "Agregar" class="btn btn-primary btn-add col-md-offset-7" data-target="#imodal" data-toggle="modal">Agregar</button>

                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_center"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">    
                                <th>Id Centro</th>
                                <th>Departamento</th>
                                <th>Nombre</th>
                                <th>Codigo</th>
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
                    <h4 class="modal-title" id="myModalLabel">Registrar Centro Costos</h4>
                    
                </div>
                <form action="?c=Center&a=store" method="POST" name ="send">
                <div class="modal-body">
                    <div class="row row-fluid">

                        <div class="col-sm-4">

                                <div class="form-group"><label>Nombre del centro </label></div>
                                <div class="form-group"><input  id="name" class="input_let" name="Nombre" ID=""  ></input></div>
                            

                            
                        </div>
                        <div class="col-sm-4">
                                <div class="form-group"><label>Codigo</label></div>
                                <div class="form-group"><input  id="codigo" class="input_num" name="Codigo" ID=""  ></input></div>
                            

                                    
                        </div>
                        <div class="col-sm-4">
                                        <div class="form-group">
                                        <label>Departamento</label></div>
                                        <div class="form-group"><select id="depto" name="Departamento">    
                                                                        <option value="">Seleccione</option>            
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


    <div class="modal fade" id="imodal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>¿Seguro desea eliminar el Centro de costo?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-primary" id="del" value="Eliminar" />
                    <button type="button"  data-dismiss="modal" class="btn btn-danger" id="btnCancel">Cancelar</button>
                </div>
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
                
                <div class="modal-body">
                    <div class="row row-fluid">

                        <div class="col-sm-4">

                        <div class="form-group"><label>Nombre del Centro </label></div>
                        <div class="form-group"><input  id="nameu" class="input_let" name="Nombre" ID=""  ></input></div>



                        </div>
                        <div class="col-sm-4">
                        <div class="form-group"><label>Codigo</label></div>
                        <div class="form-group"><input  id="codigou" class="input_let" name="Nombre" ID=""  ></input></div>


                            
                        </div>
                        <div class="col-sm-4">
                                <div class="form-group">
                                <label>Departamento</label></div>
                                <div class="form-group"><select id="deptou" name="Departamento">    
                                                                <option value="">Seleccione</option>            
                                                        </select>
                                </div>  
                        </div>
                    </div>
                </div>
                
                    
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" id="btnActualizar" value="Actualizar"></input>
                </div>
                
                
            </div>
        </div>
    </div>

    

    <script src="View/js/Center.js" type="text/javascript"></script>
    <script src="View/js/Validate.js" type="text/javascript"></script>
        <?php
}else {
        echo "Site not Found";
} ?>