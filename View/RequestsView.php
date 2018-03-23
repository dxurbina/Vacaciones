<?php if((isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5)){
           ?>

        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Solicitudes de Vacaciones</h3>
                   

                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Solicitud"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>Num. de Solicitud</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Cant Días</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar Solicitudes por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                            <label>Comentarios</label>
                        </div>
        <div class="form-group">
                            
                            <textarea class="form-control" name="" id="Descrip" cols="50" rows="5" readonly="readonly"></textarea>
        </div>
            </div>
        </div>
        
        
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Historial de Solicitudes</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Historial"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>IdVacaciones</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Cant Días</th>
                                <th>Desde - Hasta</th>
                                <th>Tipo</th>
                                <th>Fecha Solicitud</th>
                                <th>Fecha Respuesta</th>
                                <th>Respuesta</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar Solicitudes por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    

    <div class="modal fade" id="imodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>¿Seguro desea Aprobar las vacaciones al empleado?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-primary" id="update" value ="Aceptar" />
                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="btnCancel">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imodal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>¿Seguro desea rechazar la solicitud al empleado?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-primary" id="update" value="Rechazar" />
                    <button type="button"  data-dismiss="modal" class="btn btn-danger" id="btnCancel">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    
        <script src="View/js/RequestVacation.js" type="text/javascript"></script>
        <?php
    }else {
        echo "Site not Found";
    } ?>