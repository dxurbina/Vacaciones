<!--<div class="modal fade" id ="imodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Solicitud Vacaciones</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tipo Ausencia</label>
                    </div>-->
            
            <div class="modal-body">   
                <form action="?c=Vacaciones&a=store" method="POST">
                    <div class="row row-fluid">
                    
                        <div class="col-xs-4">
                            
                            <div class="form-group">
                                <h3>Tipo de Ausencia</h3>
                                <input type="radio" name="Tipo" value="Vacaciones"> Vacaciones<br>
                                <input type="radio" name="Tipo" value="Enfermedad"> Enfermedad<br>
                                <input type="radio" name="Tipo" value="Permiso Especial"> Permiso Especial
                            </div>
                        </div>
                        <div class="col-xs-4">
                                <h3>Factor: </h3>
                                <label for="factor"><?php echo $this->factor; ?></label>&nbsp;&nbsp;
                                <label>Por Día</label>
                        </div>
                        <div class="col-xs-4">
                        </div> 
                            <div class="form-group">
                                
                            </div>
                        </div> 
                    </div>
                    
                    <h2 style="text-align: center;">Período de Descanso</h2>
                    
                
                    <div class="row row-fluid">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Días A Tomar</label>
                            </div>
                            <div class="form-group">
                                <input  id="NumDay" name = "CantDias" type="number" name="edad" min="0" max="30" step="0.5">
                            </div>
                            
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Seleccione Fecha de Inicio de Vacaciones</label>
                            </div>
                            <div class="form-group"><input id="pointer" name ="FechaI"type="text"  /></div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label id=''>Hasta</label>
                            </div>
                            <div class="form-group">
                                <input id="dateF" name = "FechaF" type="text" readonly="readonly"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group">
                            <label>Comentarios</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="Descripcion" id="" cols="50" rows="5"></textarea>
                        </div>

                    </div>
                    <div class="col-xs-offset-4">
                        <label>Días de Vacaciones con Factor: </label>&nbsp;
                        <label for="Saldo">0</label>&nbsp;&nbsp;
                        <input type="submit"  id="enter" class="btn btn-primary" value="Solicitar" />
                    </div>
                </form>
            </div>
            
                 <!--</div>
               
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnActualizar">Actualizar</button>
                </div>
            </div>
        </div>
    </div> -->
    <script type="text/javascript" src="View/js/Vacaciones.js"></script>