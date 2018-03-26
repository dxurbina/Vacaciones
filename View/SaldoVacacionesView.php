<?php if(isset($_SESSION['nickname'])){
?>  

<div class="modal-dialog" role="document">
    <div style="width: 100%;" class="modal-content">
        <div class="modal-header">
                    <?php foreach ($this->emp as $row){?>
                    <h4 class="modal-title" id="myModalLabel">Saldo de Vacaciones <strong><?php echo $row->PNombre; ?>  <?php echo $row->PApellido; ?></strong> </h4>
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
                    <div class="form-group"><label>Saldo Actual: </label></div>
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

<!--Botón que redirecciona a la interface de la creación de una solicitud de Vacaciones-->
  <center><input type="submit"  id="solicitud" class="btn btn-primary" value="Solicitar Vacaciones" /></center>
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
<?php
    }else {
        echo "Site not Found";
} ?>