<?php if(isset($_SESSION['nickname'])){
?>  

<!-- Datatable para ver el saldo de vacaciones de todos los colaboradores-->
<div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Saldo de los colaboradores</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_saldo_vacaciones"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                               <!-- <th>IdEmpleado</th>-->
                                <th>Nombre y Apellido</th>
                                <th>Saldo Vacaciones</th>
                                <!--<th>Respuesta</th>
                                <th>Acciones</th>-->
                            </tr>
                        </thead>
                        <tbody id="tbl_saldo_vacaciones">
                                <!--Cargar el saldo de las vacaciones por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="View/js/SaldoColaboradores.js"></script>

<?php
    }else {
        echo "Site not Found";
} ?>