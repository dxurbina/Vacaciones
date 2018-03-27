<?php if(isset($_SESSION['nickname'])){
?>  

<div class="modal-dialog" role="document">
    <div style="width: 100%;" class="modal-content">
        <div class="modal-header">
                    <?php foreach ($this->emp as $row){?>
                    <h4 class="modal-title" id="myModalLabel">Saldo de Vacaciones <b><?php echo $row->PNombre; ?>  <?php echo $row->PApellido; ?></b> </h4>
                    <?php } ?> 
        </div>
    <!--<form class="form" action="?c=SaldoVacaciones&a=SaldoVacacionesbyId" method="POST">-->
        <div class="modal-body">
            <div class="row row-fluid">
                <div class="col-sm-5">
                        
                    <!--<div class="form-group"><label>Nombres y Apellidos:</label></div>
                    <div class="form-group"><label>No. Identificación:</label></div>
                    <div class="form-group"><label>Departamento:</label></div>
                    <div class="form-group"><label>Cargo:</label></div>-->
                    <div class="form-group"><label>Saldo Actual: </label>
                    </div>
                </div>
                <div class="col-sm-5">   
                    <!--<div class="form-group"><input id="Nombre" name = "Nombre"></input></div>
                    <div class="form-group"><input id="Cedula" name ="Cedula"></input></div>
                    <div class="form-group"><input id="DptoEmpresa" name="DptoEmpresa"></input></div>
                    <div class="form-group"><input id="cargo" name="cargo" ></input></div>-->
                    <?php foreach ($this->emp as $row){?>
                    <div class="form-group"><input id="saldo" name="saldo" disabled value="<?php echo $row->Saldo; ?>"> </input></div>
                    <?php } ?>  
                </div>
            </div>
    <!--</form>-->
        </div>
    </div>
    
</div>

<!--Botón que redirecciona a la interface de Vacaciones-->
<!--<center><button> Solicitar Vacaciones <a href="View/VacacionesView.php"></a></button></center>
<br>-->
<!--<center><input type="submit"  id="sol" class="btn btn-primary" value="Solicitar Vacaciones" /></center>
<br>-->
<center><button id="openModal" type="button" class="btn btn-primary"6>Solicitar Vacaciones </button></center>
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
                                <!--Cargar historial de Solicitudes por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

        
    <script type="text/javascript" src="View/js/SaldoVacaciones.js"></script>

<!--Modal Para que el colaborador pueda solicitar vacaciones a partir de la pantalla de saldo de Vacaciones  -->
<!-- POP UP -->
<div  class="modal fade" id ="modalsol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" style="margin: 10%; margin-top: 5%;" role="document">
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
                    
                   <b><h2 style="text-align: center;">Período de Descanso</h2></b>
                    
                <div class="col-xs-12">
                    <div class="row row-fluid">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Días A Tomar</label><input  id="NumDay" name = "CantDias" type="number" name="edad" min="0" max="30" step="0.5">
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Fecha de Inicio</label><input id="pointer" name ="FechaI"type="text"  />
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
                                <textarea class="form-control" name="Descripcion" id="" cols="50" rows="5"></textarea>
                            </div>
                        </div> 
                    <div class="col-xs-offset-4">
                        <label>Días de Vacaciones con Factor: </label>&nbsp;
                        <label for="Saldo">0</label>&nbsp;&nbsp;
                        <input type="submit"  id="enter" class="btn btn-primary" value="Solicitar" />
                    </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>

    <script type="text/javascript" src="View/js/Vacaciones.js"></script>

<?php
    }else {
        echo "Site not Found";
} ?>