<?php if(isset($_SESSION['nickname'])){
?>  

<!-- Datatable para ver los colaboradores inactivos-->
<div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Colaboradores inactivos</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_colaboradores_inactivos"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>IdEmpleado</th>
                                <th>Nombre y Apellido</th>
                                <th>Fecha de ingreso</th>
                                <th>Cargo</th>
                                <!--<th>Respuesta</th>
                                <th>Acciones</th>-->
                            </tr>
                        </thead>
                        <tbody id="tbl_colaboradores_inactivos">
                                <!--Cargar lista de colaboradores inactivos por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="View/js/EmpleadosInactivos.js"></script>

<?php
    }else {
        echo "Site not Found";
} ?>