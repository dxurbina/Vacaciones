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
                <form action="?c=Vacaciones&a=Store" method="POST">
                <div class="modal-body">   
                    
                    <div class="row row-fluid">
                    
                        <div class="col-xs-6">
                            
                            <div class="form-group">
                                <h3>Tipo de Ausencia</h3>
                                <input type="radio" name="Tipo" value="Vacaciones"> Vacaciones<br>
                                <input type="radio" name="Tipo" value="Enfermedad"> Enfermedad<br>
                                <input type="radio" name="Tipo" value="Permiso Especial"> Permiso Especial
                            </div>
                        </div>
                        <div class="col-xs-6">
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
                                <input  id="NumDay" name = "NumDay" type="number" name="edad" min="0" max="30" step="0.5">
                            </div>
                            <div class="form-group">
                                <input id="Add" type="checkbox" name="Add" value="Add">Agregar Calendario para Intercalar Fechas
                            </div> 
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Seleccione Fecha de Inicio de Vacaciones</label>
                            </div>
                            <div class="form-group"><input id="pointer" type="text"  /></div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label id=''>Hasta</label>
                            </div>
                            <div class="form-group">
                                <input id="dateF" type="text" readonly="readonly"/>
                            </div>
                        </div>
                    </div>
                    <div class="row row-fluid">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label id="ExtraDay">Días A Tomar</label>
                            </div>
                            <div class="form-group">
                                <input  id="NumDayExtra" name = "NumDay" type="number" name="edad" min="0" max="30" step="0.5" />
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label id="ExtraDate">Seleccione Fecha de Inicio de Vacaciones</label>
                            </div>
                            <div  class="form-group"><input id="ExtraDateIni" type="text"/></div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label id='ExtraEnd'>Hasta</label>
                            </div>
                            <div  class="form-group"><input type="text" id='ExtraDateEnd'  readonly="readonly"/></div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>Comentarios</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="" id="" cols="50" rows="5"></textarea>
                        </div>

                    </div>
                    <div class="col-xs-offset-5">
                        <input type="text" class="btn btn-primary" value="Solicitar" />
                    </div>
                </div>
                </div>
                 <!--</div>
               
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnActualizar">Actualizar</button>
                </div>
            </div>
        </div>
    </div> -->
    <script type="text/javascript" src="View/js/Vacaciones.js"></script>