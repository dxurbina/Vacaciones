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

        
    <?php
        include('template/FormSugVac.php');
    ?>
        
        <script src="View/js/BalanceHistory.js" type="text/javascript"></script>
        <script src="View/js/Vacaciones.js" type="text/javascript"></script>
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