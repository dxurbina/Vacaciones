<div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Reporte de Vacaciones</h3>
                </div>
                <div class="form-group">
                <form action="?c=Report&a=generate" method="POST">
                                    <div class="row row-fluid">
                                        
                                        <!--Radio botoon para seleccionar el tipo de reporte-->
                                        <div class="col-sm-2" style="margin-left: 3%;">
                                            <input type="radio" id="rf" name="Tipo" value="RangoFechas"> Rango Fechas<br>
                                            <input type="radio" id="m" name="Tipo" value="Mes"> Por Mes<br>
                                        </div><br>
                                                                                
                                        <div class="col-sm-2" style="margin-left: 3%;">
                                            <div class="form-group"><label>Fecha Inicio</label></div>
                                            <div class="form-group">
                                                <input id="entrada" name="dateI" type="text" required disabled/>
                                            </div>
                                        </div>
                                        <div class="col-sm-2" style="margin-left: 3%;">
                                            <div class="form-group"><label>Fecha Final</label></div>
                                            <div class="form-group">
                                                <input id="salida" name="dateE" type="text" required disabled/>
                                            </div>
                                        </div> 

                                        <div class="col-sm-2" style="margin-left: 3%;">
                                        <div class="form-group"><label>Seleccionar Mes :</label></div>
                                        <div class="form-group"><input id="mes" value="" name="date" class="date-picker" disabled/></div>
                                        </div>
                                        
                                         
                                        <div class="col-xs-6 col-xs-offset-5" style="margin-bottom: 2%;">
                                          <input type="submit" class="btn btn-primary" id="btnActualizar" value="Generar Reporte" />
                                          <!--<input hidden type="submit" class="btn btn-primary" id="btnActualizar2" value="Generar Reporte"/>-->
                                        </div>  
                                    </div>
                </form>                              
                </div>
        </div>
    </div>
</div>
<script src="View/js/Report.js" type="text/javascript"></script>
<!--Estilo para la clase del calendario que mando a llamar en el div. -->
 <style>
    .ui-datepicker-calendar {
        /*display: none;*/
    }
    
    .calendario {
        /*display: none;*/
        
    }

    </style>