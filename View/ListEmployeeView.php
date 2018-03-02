<?php if(isset($_SESSION['nickname']) and $_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['access'] == 5){
           ?>
<div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Lista de Empleados</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Empleados" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>IdEmpleado</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Nombre del Cargo</th>
                                <th>Nombre Jefe</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar Empleados por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php
    }else {
        echo "Site not Found";
    } ?>