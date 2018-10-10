<?php if(isset($_SESSION['nickname'])){
?>  

<!-- Datatable para ver el saldo de vacaciones de todos los colaboradores-->
<div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                <form action="?c=SaldoColaboradores&a=deduce_csv_" method="POST" name="_send" enctype="multipart/form-data">
                    <h3 class="box-title" style="font-size: 200%;">Saldo de los colaboradores</h3>
                </div>
                <button title= "Add" value= "Agregar" class="btn btn-primary btn-add col-md-offset-5" data-target="#imodal" data-toggle="modal">Deducir Saldo</button>
                <button title= "Add" value= "Agregar" class="btn btn-danger btn-add" data-target="#imodal_1" data-toggle="modal">Revertir Deduccion</button>
                
                
                <label class="btn btn-default">Cargar CSV <input name ="archivo" id="_upload_" type="file" hidden>
                <button title= "Add" id="_update_" name ="_file_" value= "Agregar" class="btn btn-primary btn-add"y>Actualizar saldos</button>
                </label>
                </form>
                
                
                <div class="box-body table-responsive">
                    <table id="tbl_saldo_vacaciones"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>IdEmpleado</th>
                                <th>Nombre y Apellido</th>
                                <th>Cargo</th>
                                <th>Saldo Vacaciones</th>
                                <th>Factor</th>
                                <th>Acciones</th>
                                <!--<th>Respuesta</th> -->
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

    <div  class="modal fade" id ="_open_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actualizar saldo por csv</h4>
                    
                </div>
                
                <div class="modal-body">
                    <div class="row row-fluid">
                    <div class="form-group"><label>Esta acción requiere autentificación.</label></div>
                        <div class="col-sm-6">

                                <div class="form-group"><label>Usuario</label></div>
                                <div class="form-group"><input class="store-val" value="<?php echo $_SESSION['nickname'] ?>" type="text" id="user_3" name="user_3"  readonly="readonly" /></div>
                            
                            
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group"><label>Contraseña</label></div>
                            <div class="form-group"><input class="store-val" type="password" id="pass_3" name="pass_3"/></div>
                                
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" id="btn_update_csv" value="Deducir"></input>
                </div>
                
                
            </div>
        </div>
    </div>

        <div  class="modal fade" id ="imodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 15%; margin-top: 5%;" role="document">
            <div style="width: 165%;" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Realizar Deduccion</h4>
                    
                </div>
                <form action="?c=SaldoColaboradores&a=deduce" method="POST" name ="send">
                <div class="modal-body">
                    <div class="row row-fluid">
                    <div class="col-sm-4">

                    <div class="form-group"><label>Dias a Reducir</label></div>
                    <div class="form-group">
                                <input  id="NumDay" name = "CantDias" type="number" name="edad" min="0" max="30" step="0.5" required onkeypress="return valida(event)">
                            </div>

                    </div>
                    <div class="form-group"><label>Esta acción requiere autentificación.</label></div>
                        <div class="col-sm-4">

                                <div class="form-group"><label>Usuario</label></div>
                                <div class="form-group"><input class="store-val" value="<?php echo $_SESSION['nickname'] ?>" type="text" id="user" name="user"  readonly="readonly" /></div>
                            
                            
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label>Contraseña</label></div>
                            <div class="form-group"><input class="store-val" type="password" id="pass" name="pass"/></div>
                                
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                
                    <input type="submit" class="btn btn-primary" id="btnStore" value="Deducir"></input>
                </div>
                
                </form>
            </div>
        </div>
    </div>

    <div  class="modal fade" id ="imodal_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 15%; margin-top: 5%;" role="document">
            <div style="width: 165%;" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Realizar Deduccion</h4>
                    
                </div>
                <form action="?c=SaldoColaboradores&a=increase" method="POST" name ="send_1">
                <div class="modal-body">
                    <div class="row row-fluid">
                    <div class="col-sm-4">

                    <div class="form-group"><label>Dias a Revertir</label></div>
                    <div class="form-group">
                                <input  id="NumDay_1" name = "CantDias_1" type="number" name="edad" min="0" max="30" step="0.5" required onkeypress="return valida(event)">
                            </div>

                    </div>
                    <div class="form-group"><label>Esta acción requiere autentificación.</label></div>
                        <div class="col-sm-4">

                                <div class="form-group"><label>Usuario</label></div>
                                <div class="form-group"><input class="store-val" value="<?php echo $_SESSION['nickname'] ?>" type="text" id="_user_" name="user"  readonly="readonly" /></div>
                            
                            
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label>Contraseña</label></div>
                            <div class="form-group"><input class="store-val" type="password" id="pass_1" name="pass"/></div>
                                
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                
                    <input type="submit" class="btn btn-primary" id="btn_update" value="Revertir"></input>
                </div>
                
                </form>
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
        <form action="?c=Vacaciones&a=storeSugerir" method="POST" name="sendNew3">
            <div class="modal-body modal-alert3">   
                    <div class="row row-fluid">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <h3>Tipo de Ausencia</h3>
                                <input  hidden type = "text" id= "idEmp" name = "idEmpleado" />
                                <input type="radio" name="Tipo" value="Vacaciones" checked> Vacaciones<br>
                                <input type="radio" name="Tipo" value="Enfermedad"> Enfermedad<br>
                                <input type="radio" name="Tipo" value="Permiso Especial"> Permiso Especial <br>
                                <?php if($this->donar == true){
                                ?>
                                <input type="radio" name="Tipo" value="Donar"> Donar
                                <?php }?> 
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
                        <input type="submit"  id="enter3" class="btn btn-primary" value="Solicitar" />
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

        <script type="text/javascript" src="View/js/SaldoColaboradores.js"></script>
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
        <script type="text/javascript">
            $(document).on('click', '#_update_', function(e){
                e.preventDefault();
                var rol = <?php echo $_SESSION['access'] ?>;
           
                var archivo = $("#_upload_").val();
                console.log(archivo);
                if( archivo != ''){
                    var extensiones = archivo.substring(archivo.lastIndexOf("."));

                    if(extensiones == '.csv')
                    {
                        if(rol == 3){
                            console.log(rol);
                            alert('Esta accion requerirá la aprobacion de su jefe inmediato');
                            $('#_open_').modal();
                        }else{
                            $('#_open_').modal();
                        }
                    }else{
                        alert("El archivo de tipo " + extensiones + " no es válido");
                    }
                }else{
                    alert('No hay archivo');
                }
            });
        </script>


<?php
    }else {
        echo "Site not Found";
} ?>