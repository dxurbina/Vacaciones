<?php if(isset($_SESSION['nickname'])){
?>

<!--<div class="modal-dialog" role="document">
    <div style="width: 100%;" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Ver calendario</h4>
            </div>
        <div class="modal-body">
                <div class="row row-fluid">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input id="calendar" name ="Fecha"type="text" size="30"/>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input type="submit" id="addfe" class="btn btn-primary" value="Agregar feriado"/>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>-->

<!--Modal para agregar nuevo día feriado -->
    <div  class="modal fade" id ="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 10%; margin-top: 15%;" role="document">
            <div style="width: 165%;" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Registrar día feriado</h4>
                </div>

                <form action="?c=Feriados&a=Addferiados" method="POST" name ="send">
                <div class="modal-body">
                    <div class="row row-fluid">

                        <div class="col-sm-6">
                                <div class="form-group"><label>Descripción</label></div>
                                <div class="form-group"><input  id="des" class="input_let" name="des" ID="" type="text" required onkeypress="return validaLetras(event)" ></input></div>
                        </div>

                        <div class="col-sm-6">
                                <div class="form-group"><label>Fecha</label></div>
                                <div class="form-group"><input  id="fecha" class="input_num" name="fecha" ID="" type="text" required readonly="true"></input></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" id="btnGuardar" value="Registrar"></input>
                </div>
                </form>
            </div>
        </div>
    </div>


<!-- Datatable para mostar los días feriados-->
<div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Días feriados</h3>
                    <button title= "Add" value= "addfe" class="btn btn-primary btn-add col-md-offset-8" data-target="#imodal" data-toggle="modal">Agregar feriado</button>
                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Feriados"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>IdFeriado</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar lista de los días feriados por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
</div>

        <script type="text/javascript" src="View/js/Feriados.js"></script>

        <!-- valida que solo se escriba números -->
<script>
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    //patron =/[0-9]/;
    patron =/[0-9-]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>


<!-- valida que solo se escriba letras -->
<script>
function validaLetras(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[a-z-A-Z -ñ]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>

<?php
    }else {
        echo "Site not Found";
} ?>