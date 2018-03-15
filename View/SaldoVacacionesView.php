<?php if(isset($_SESSION['nickname'])){
?>  

<div class="modal-dialog" role="document">
    <div style="width: 100%;" class="modal-content">
        <div class="modal-header">
                    <?php foreach ($this->emp as $row){?>
                    <h4 class="modal-title" id="myModalLabel">Saldo de Vacaciones <?php echo $row->PNombre; ?>  <?php echo $row->PApellido; ?> </h4>
                    <?php } ?> 
        </div>
    <form class="form" action="?c=SaldoVacaciones&a=SaldoVacacionesbyId" method="POST">
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
    </form>
        </div>
    </div>
    
</div>

<?php
    }else {
        echo "Site not Found";
} ?>