<div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Reporte de Vacaciones</h3>
                </div>
                <div class="form-group">
                <form action="?c=Report&a=generate" method="POST">
                                    <div class="row row-fluid">
                                        <div class="col-sm-2" style="margin-left: 3%;">
                                            <div class="form-group"><label>Fecha Inicio</label></div>
                                            <div class="form-group">
                                                <input id="entrada" name="dateI" type="text" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-2" style="margin-left: 3%;">
                                            <div class="form-group"><label>Fecha Final</label></div>
                                            <div class="form-group">
                                                <input id="salida" name="dateE" type="text"/>
                                            </div>
                                        </div> 
                                         
                                        <div class="col-xs-6 col-xs-offset-6" style="margin-bottom: 2%;">
                                          <input type="submit" class="btn btn-primary" id="btnActualizar" value="Generar Reporte"></input>
                                        </div>  
                                    </div>
                </form>                              
                </div>
        </div>
    </div>
</div>
<script src="View/js/Report.js" type="text/javascript"></script>