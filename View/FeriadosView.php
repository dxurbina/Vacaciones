<?php if(isset($_SESSION['nickname'])){
?>

<div class="modal-dialog" role="document">
    <div style="width: 100%;" class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Ver calendario</h4>
        </div>
    <div class="modal-body">
            <div class="row row-fluid">
                <div class="col-xs-6">
                    <div class="form-group">
                        <input id="calendar" name ="Fecha"type="text" size="30"/>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                         <input type="submit" id="addfe" class="btn btn-primary" value="Agregar feriado"/>
                    </div>
                </div>
            </div>
    </div>
    </div>
</div>

<!--Modal para agregar nuevo día feriado -->
<div  class="modal fade" id ="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" name="form">
<div class="modal-dialog" style="margin: 24%; margin-top: 15%;" role="document">
    <div style="width: 100%;" class="modal-content">
        <div class="modal-header">
       <b> <h4>Agregar día feriado</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
        </div>    
        <form action="?c=Feriados&a=Addferiados" method="POST">
            <div class="modal-body">                       
                <div class="col-xs-12">
                    <div class="row row-fluid">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Descripción</label><input  id="des" name = "des" type="text" required>
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Fecha</label><input id="fecha" name ="fecha"type="text" required />
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
</div>

<!-- Datatable para ver mostar los días feriados-->
<div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Días feriados</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Feriados"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>IdFeriado</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                <!--<th>Acciones</th>-->
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar lista de los días feriados por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="View/js/Feriados.js"></script>
<?php
    }else {
        echo "Site not Found";
} ?>