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
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Saldo</th>
                                <th>Jefe Inmediato</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar Solicitudes por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <script src="View/js/BalanceHistory.js" type="text/javascript"></script>
    <?php
}else {
    echo "Site not Found";
} ?>