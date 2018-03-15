<?php if(isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
           ?>
<div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Solicitudes de Vacaciones</h3>
                   

                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Empleados"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>IdVacaciones</th>
                                <th>Nombre</th>
                                <th>Cant Días</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>
                                <th>Tipo</th>
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
        <div class="form-group">
                            <textarea class="form-control" name="" id="" cols="50" rows="5" readonly="readonly"></textarea>
        </div>

        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Historial de Solicitudes</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Empleados"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>IdVacaciones</th>
                                <th>Nombre</th>
                                <th>Cant Días</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>
                                <th>Tipo</th>
                                <th>Fecha Solicitud</th>
                                <th>Fecha Respuesta</th>
                                <th>Aprobadá Por</th>
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

        <?php
    }else {
        echo "Site not Found";
    } ?>