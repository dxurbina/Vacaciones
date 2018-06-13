<?php if(isset($_SESSION['nickname'])){
?>  

<div class="modal-dialog" role="document">
    <div style="width: 100%;" class="modal-content">
        <div class="modal-header">
                    <?php foreach ($this->emp as $row){?>
                    <h4 class="modal-title" id="myModalLabel">Saldo de Vacaciones <b><?php echo $row->PNombre; ?>  <?php echo $row->PApellido; ?></b> </h4>
                    <?php } ?> 
        </div>
        <div class="modal-body">
            <div class="row row-fluid">
                <div class="col-sm-5">
                    <div class="form-group"><label>Saldo Actual: </label>
                    </div>
                </div>
                <div class="col-sm-5">   
                    <?php foreach ($this->emp as $row){?>
                   <!-- <div class="form-group"><input id="saldo" name="saldo" disabled value=""> </input></div>-->
                    <div class="form-group"><label for="saldo"><?php echo $row->Saldo; ?></div>
                    <?php } ?>  
                </div>
            </div>
        </div>
    </div>
    
</div>


<center><button id="openModal" type="button" class="btn btn-primary">Solicitar Vacaciones </button></center>
<br>
<!-- Datatable para ver el historial de sus solicitudes de vacaciones-->
<div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Historial de Solicitudes</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Historial"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                               <!-- <th>Nombre</th>
                                <th>Cargo</th>-->
                                <th>IdVacaciones</th>
                                <th>Días</th>
                                <th>Desde - Hasta</th>
                                <th>Tipo</th>
                                <th>Fecha Solicitud</th>
                                <th>Fecha Respuesta</th>
                                <th>Respuesta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar historial de Solicitudes por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

<!--Modal Para que el colaborador pueda editar su solicitud de vacaciones a partir de la pantalla de saldo de Vacaciones  -->
<!-- POP UP -->
<div  class="modal fade" id ="modalSolEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" name="formsol">
<div class="modal-dialog" style="margin: 10%; margin-top: 15%;" role="document">
    <div style="width: 160%;" class="modal-content">
        <div class="modal-header">
       <b> <h4>Editar solicitud de vacaciones</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
        </div>    
        <form action="?c=Vacaciones&a=EditSolicitud" method="POST" name="send">
            <div class="modal-body">   
                    <div class="row row-fluid">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <h3>Tipo de Ausencia</h3>
                                <input  hidden type = "text" id= "idVac" name = "idVacaciones" />
                                <input type="radio" name="Tipo" value="Vacaciones" > Vacaciones<br>
                                <input type="radio" name="Tipo" value="Enfermedad" > Enfermedad<br>
                                <input type="radio" name="Tipo" value="Permiso Especial" > Permiso Especial
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
                    
                   <b><h2 style="text-align: center;">Período de Descanso</h2></b>
                    
                <div class="col-xs-12">
                    <div class="row row-fluid">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Días A Tomar</label><input  id="NumDay2" name = "CantDias" type="number" name="edad" min="0" max="2" step="0.5" required onkeypress="return valida(event)">
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Fecha de Inicio</label><input id="pointer2" name ="FechaI"type="text" readonly = "true" required />
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label id=''>Hasta</label> <input id="dateF2" name = "FechaF" type="text" readonly="readonly"/>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Comentarios</label>
                                <textarea class="form-control" name="Descripcion" id="comentarios2" cols="50" rows="5"></textarea>
                            </div>
                        </div> 
                    <div class="col-xs-offset-4">
                        <label>Días de Vacaciones con Factor: </label>&nbsp;
                        <label for="Saldo">0</label>&nbsp;&nbsp;
                        <input type="submit"  id="editSol" class="btn btn-primary" value="Enviar Solicitud" /> <!-- data-target="#imodal" data-toggle="modal" onclick="alert('Su solicitud ha sido enviada exitosamente')" -->
                       <!-- <button id="enter" type="button" class="btn btn-primary" onclick="alert('Su solicitud ha sido enviada exitosamente')">Solicitar </button>-->
                    </div>

                    <div class="col-xs-offset-4">
                       <label>Saldo Actual total: </label>&nbsp;
                       <label for="SaldoTotal">0</label>&nbsp;&nbsp;
                    </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="View/js/SaldoVacaciones.js"></script>

<!--Modal Para que el colaborador pueda solicitar vacaciones a partir de la pantalla de saldo de Vacaciones  -->
<!-- POP UP -->
<div  class="modal fade" id ="modalsol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" name="formsol">
<div class="modal-dialog" style="margin: 10%; margin-top: 15%;" role="document">
    <div style="width: 160%;" class="modal-content">
        <div class="modal-header">
       <b> <h4>Solicitar Vacaciones</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
        </div>    
        <form action="?c=Vacaciones&a=store" method="POST">
            <div class="modal-body">   
                    <div class="row row-fluid">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <h3>Tipo de Ausencia</h3>
                                <input type="radio" name="Tipo" value="Vacaciones" checked> Vacaciones<br>
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
                    
                   <b><h2 style="text-align: center;">Período de Descanso</h2></b>
                    
                <div class="col-xs-12">
                    <div class="row row-fluid">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Días A Tomar</label><input  id="NumDay" name = "CantDias" type="number" name="edad" min="0" max="2" step="0.5" required onkeypress="return valida(event)" maxlength="2">
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Fecha de Inicio</label><input id="pointer" name ="FechaI"type="text" required readonly = "true"/>
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label id=''>Hasta</label> <input id="dateF" name = "FechaF" type="text" readonly="readonly"/>
                            </div>
                        </div>
                    </div>
                </div>
                    
                   <!-- <div class="row">
                        <div class="form-group">
                            <label>Comentarios</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="Descripcion" id="" cols="50" rows="5"></textarea>
                        </div> --> <!-- Así estaba anteriormente 27-03-18 10.46 am -->

                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Comentarios</label>
                                <textarea class="form-control" name="Descripcion" id="comentarios" cols="50" rows="5"></textarea>
                            </div>
                        </div> 
                    <div class="col-xs-offset-4">
                        <label>Días de Vacaciones con Factor: </label>&nbsp;
                        <label for="Saldo">0</label>&nbsp;&nbsp;
                        <input type="submit"  id="enter" class="btn btn-primary" value="Solicitar" /> <!-- data-target="#imodal" data-toggle="modal" onclick="alert('Su solicitud ha sido enviada exitosamente')" -->
                       <!-- <button id="enter" type="button" class="btn btn-primary" onclick="alert('Su solicitud ha sido enviada exitosamente')">Solicitar </button>-->
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
        

<!--Modal para confirmar la solicitud de vacaciones-->
<!--<div class="modal fade" id="imodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" style="margin: 30%; margin-top: 20%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <center><h4 class="modal-title" id="myModalLabel">Confirmar</h4></center>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>¿Seguro desea enviar la solicitud de vacaciones?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-primary" id="aceptar" value ="Aceptar" />
                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="btnCancel">Cancelar</button>
                </div>
            </div>
        </div>
    </div>-->

    <!-- Este esta bueno 10:08 am 04-04-18 -->
    <div class="modal fade" id="imodalsolinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 30%; margin-top: 20%; background:red;" role="document">
            <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <center><strong><label>Para poder enviar la solicitud de vacaciones debe completar los campos solicitados.</label></strong></center>
                    </div>
                </div>
                <div class="modal-footer">
                    <center><button class="btn btn-primary" type="button" data-dismiss="modal">Cerrar </button></center>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imodalsolacep" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 30%; margin-top: 20%; background:blue;" role="document">
            <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <center><strong><label>Su solicitud de vacaciones ha sido enviada satisfactoriamente.</label></strong></center>
                    </div>
                </div>
                <div class="modal-footer">
                    <center><button class="btn btn-primary" type="button" data-dismiss="modal">Cerrar </button></center>
                </div>
            </div>
        </div>
    </div>

<!--Modal para informar que solo se puede editar las solicitudes con estado pendiente -->
    <div class="modal fade" id="imodalSolEditInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" style="margin: 30%; margin-top: 20%; background:red;" role="document">
                <div class="modal-content">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                        <center><strong><label>Solo se pueden editar las Solicitudes que tienen un estado de "Pendiente".</label></strong></center>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <center><button class="btn btn-primary" type="button" data-dismiss="modal">Cerrar </button></center>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="View/js/Vacaciones.js"></script>

<!-- valida que solo se escriba números -->
<script>
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>

<?php
    }else {
        echo "Site not Found";
} ?>