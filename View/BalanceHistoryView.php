<?php if((isset($_SESSION['nickname']) and $_SESSION['access'] == 2 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5)){
           ?>

        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Saldo de Empleados</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_History"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>IdEmpleado</th>
                                <th>Nombre y Apellido</th>
                                <th>Cargo</th>
                                <th>Jefe Inmediato</th>
                                <th>Saldo vacaciones</th>
                                
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar Solicitudes por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

            <!--Modal de mi saldo para sugerir vacaciones -->
    <!--Modal Para que el colaborador pueda solicitar vacaciones a partir de la pantalla de saldo de Vacaciones  -->
<!-- POP UP -->
<div  class="modal fade" id ="modalSolSugerir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" name="formsol">
<div class="modal-dialog" style="margin: 10%; margin-top: 15%;" role="document">
    <div style="width: 160%;" class="modal-content">
        <div class="modal-header">
       <b> <h4>Solicitar Vacaciones</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
        </div>    
        <form action="?c=Vacaciones&a=storeSugerir" method="POST">
            <div class="modal-body">   
                    <div class="row row-fluid">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <h3>Tipo de Ausencia</h3>
                                <input  hidden type = "text" id= "idEmp" name = "idEmpleado" />
                                <input type="radio" name="Tipo" value="Vacaciones" checked> Vacaciones<br>
                                <input type="radio" name="Tipo" value="Enfermedad"> Enfermedad<br>
                                <input type="radio" name="Tipo" value="Permiso Especial"> Permiso Especial 
                            </div>
                        </div>
                        <div class="col-xs-4">
                                <h3>Factor: </h3>
                                <!--<label name="factor3" > </label> --> 
                               <input  id="factor3" name = "factor" readonly = "true" size= "1.7%" >&nbsp;&nbsp;
                                <label>Por Día</label>
                        </div>
                        
                    
                    <!--Agregado 03-08-2018 10:01 -->
                    <div class="col-xs-4">
                                <h3>Saldo: </h3>
                                <!--<label name="factor3" > </label> --> 
                                &nbsp;&nbsp;&nbsp;&nbsp; <input  id="SaldoAct" name = "saldo" readonly = "true" size= "1.5%" >
                        </div>
                        <div class="col-xs-4">
                        </div> 
                            <div class="form-group">
                                
                            </div>
                        </div> 
                    </div>

                    
                   <b><h2 style="text-align: center;">Período de Descanso</h2></b>
                    
                <div class="col-xs-12">
                    <div class="row row-fluid">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Días A Tomar</label><input  id="NumDay3" name = "CantDias" type="number" name="edad" min="0" max="30" step="0.5" required onkeypress="return valida(event)" maxlength="2">
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Fecha de Inicio</label><input id="pointer3" name ="FechaI"type="text" required readonly = "true"/>
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label id=''>Hasta</label> <input id="dateF3" name = "FechaF" type="text" readonly="readonly"/>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Comentarios</label>
                                <textarea class="form-control" name="Descripcion" id="comentarios3" cols="50" rows="5"></textarea>
                            </div>
                        </div> 
                    <div class="col-xs-offset-4">
                        <label>Días de Vacaciones con Factor: </label>&nbsp;
                        <label for="Saldo">0</label>&nbsp;&nbsp;
                        <input type="submit"  id="enter" class="btn btn-primary" value="Solicitar" />
                    </div>
                    
                    <div class="col-xs-offset-4">
                       <label>Saldo Actual total: </label>&nbsp;
                       <label for="SaldoT">0</label>&nbsp;&nbsp;
                    </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
        
        <script src="View/js/BalanceHistory.js" type="text/javascript"></script>
        <script src="View/js/Vacaciones.js" type="text/javascript"></script>
    <?php
}else {
    echo "Site not Found";
} ?>