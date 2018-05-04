<?php if(isset($_SESSION['nickname'])){
?>
<!--Modal para agregar factores -->
<div  class="modal fade" id ="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" name="form">
    <div class="modal-dialog" style="margin: 24%; margin-top: 15%;" role="document">
        <div style="width: 100%;" class="modal-content">
            <div class="modal-header">
                <h4>Agregar Factores
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
            </div>    
            <form action="?c=Factores&a=AddFactor" method="POST">
                <div class="modal-body">                       
                    <div class="col-xs-12">
                        <div class="row row-fluid">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Descripción</label><input  id="des" name = "des" type="text">
                                </div>
                            </div>

                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Factor</label><input id="factor" name ="factor"type="text" required />
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-xs-offset-4">
                            <input type="submit"  id="guardar" class="btn btn-primary" value="Guardar"/>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Modal para editar factores -->
<div  class="modal fade" id ="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" name="form">
    <div class="modal-dialog" style="margin: 24%; margin-top: 15%;" role="document">
        <div style="width: 100%;" class="modal-content">
            <div class="modal-header">
                <h4>Editar Factor
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
            </div>    
            <form action="?c=Factores&a=EditFactor" method="POST">
                <div class="modal-body">                       
                    <div class="col-xs-12">
                        <div class="row row-fluid">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input  hidden type = "text" id= "idFactor" name = "idFactor" />
                                    <label>Descripción</label><input  id="des2" name = "des" type="text">
                                </div>
                            </div>

                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Factor</label><input id="factor2" name ="factor"type="text" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <center><input type="submit" id="Actualizar"  class="btn btn-primary" value="Actualizar"></input></center>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Datatable para ver mostar los factores-->
<div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Gestion de Factores</h3>
                    <button title= "Add" value= "Agregar" class="btn btn-primary btn-add col-md-offset-8" data-target="#imodal" data-toggle="modal">Agregar Factor</button>

                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Feriados"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>IdFactor</th>
                                <th>Descripción</th>
                                <th>Factor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar lista de los factores por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
</div>
    <script type="text/javascript" src="View/js/Factores.js"></script>

<?php
    }else {
        echo "Site not Found";
} ?>