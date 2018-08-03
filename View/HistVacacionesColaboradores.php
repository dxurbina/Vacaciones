<!--<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Reporte de Vacaciones</h3>
                </div>
            <div class="form-group">
                <form action="?c=HisVacColaboradores&a=GenerarReporte" method="POST">
                                    <div class="row row-fluid">
                                        <div class="col-sm-2" style="margin-left: 3%;">
                                            <div class="form-group"><label>Fecha Inicio</label></div>
                                            <div class="form-group">
                                                <input id="entrada" name="FechaI" type="text" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-2" style="margin-left: 3%;">
                                            <div class="form-group"><label>Fecha Final</label></div>
                                            <div class="form-group">
                                                <input id="salida" name="FechaE" type="text"/>
                                            </div>
                                        </div> 
                                         
                                        <div class="col-xs-6 col-xs-offset-6" style="margin-bottom: 2%;">
                                          <input type="submit" class="btn btn-primary" id="btnGenerar" value="Generar Reporte"></input>
                                        </div>  
                                    </div>
                </form>                               
            </div>
        </div>
    </div>
</div> -->

<div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Reporte de Vacaciones</h3>
                </div>
                <div class="form-group">
                <form action="?c=HisVacColaboradores&a=GenerarReporte" method="POST">
                                    <div class="row row-fluid">
                                        <div class="col-sm-2" style="margin-left: 3%;">
                                            <div class="form-group"><label>Fecha Inicio</label></div>
                                            <div class="form-group">
                                                <input id="entrada" name="Fecha1" type="text" required readonly = "true" />
                                            </div>
                                        </div>
                                        <div class="col-sm-2" style="margin-left: 3%;">
                                            <div class="form-group"><label>Fecha Final</label></div>
                                            <div class="form-group">
                                                <input id="salida" name="Fecha2" type="text" readonly = "true"/>
                                            </div>
                                        </div> 
                                         
                                        <div class="col-xs-6 col-xs-offset-6" style="margin-bottom: 2%;">
                                          <input type="submit" class="btn btn-primary" id="btnGenerar" value="Generar Reporte"></input>
                                        </div>  
                                    </div>
                </form>                              
                </div>
        </div>
    </div>
</div>



<!-- Datatable para ver la lista de los empleados-->
<div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Lista de colaboradores</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Empleados_Vac"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>IdVacaciones</th>
                                <th>Nombre y apellido</th>
                                <th>Departamento</th>
                                <th>Cargo</th>
                                <th>Desde - Hasta</th>
                                <th>Días</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar lista de los empleados por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
</div>
            
<script type="text/javascript" src="View/js/HisVacColaboradores.js"></script>