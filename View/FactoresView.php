<?php if(isset($_SESSION['nickname'])){
?>
<!--Modal para agregar nuevo día factores -->
<div  class="modal fade" id ="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 10%; margin-top: 15%;" role="document">
            <div style="width: 165%;" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Registrar Factores</h4>
                </div>

                <form action="?c=Factores&a=AddFactor" method="POST" name ="send" id="formFac">
                <div class="modal-body">
                    <div class="row row-fluid">

                        <div class="col-sm-6">
                                <div class="form-group"> <label>Descripción</label></div>
                                <div class="form-group"><input  id="des" class="input_let" name="des" ID="" onkeypress="return validaLetras(event)"></input></div>
                        </div>

                        <div class="col-sm-6">
                                <div class="form-group"><label>Factor</label></div>
                                <div class="form-group"><input  id="factor" class="input_num" name="factor" ID="" type="txt" required onkeypress="return validaNumericos(valor)"  ></input></div> <!-- pattern="[0-9]{10}"-->
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

<!--Modal para editar factores -->
<div  class="modal fade" id ="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 10%; margin-top: 15%;" role="document">
            <div style="width: 165%;" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Factor</h4>
                </div>

                <form action="?c=Factores&a=EditFactor" method="POST" name ="send">
                <div class="modal-body">
                    <div class="row row-fluid">
                        <input  hidden type = "text" id= "idFactor" name = "idFactor" />
                        <div class="col-sm-6">
                                <div class="form-group"><label>Descripción</label></div>
                                <div class="form-group"><input  id="des2" class="input_let" name="des" ID="" onkeypress="return validaLetras(valor)"></input></div>
                        </div>

                        <div class="col-sm-6">
                                <div class="form-group"><label>Factor</label></div>
                                <div class="form-group"><input  id="factor2" class="input_num" name="factor" ID="" type="number" required onkeypress="return validateDecimal(valor)"></input></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" id="btnActualizar" value="Actualizar"></input>
                </div>
                </form>
            </div>
        </div>
    </div>

<!-- Datatable para mostar los factores-->
<div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Gestion de Factores</h3>
                    <button title= "Add" value= "Agregar" class="btn btn-primary btn-add col-md-offset-8" data-target="#imodal" data-toggle="modal">Agregar Factor</button>
                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Feriados"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>IdFactor</th>
                                <th>Descripción</th>
                                <th>Factor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar lista de los factores por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
</div>
<script type="text/javascript" src="View/js/Factores.js"></script>

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


<!-- valida que solo se escriba letras -->
<script>
function validaLetras(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    //patron =/[a-z-A-Z-]/;
    patron = /^[a-zA-ZñÑ\s\W]+/; //corecto acepta espacio, acentos, ñ y espacio
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>

<!--Valida que permita decimales-->
<script>
function validateDecimal(valor) {
    var RE = /\d+(\.\d{1,2})?/;
    //var RE =  /[0-9] + (\. [0-9] [0-9]?)?/
    //var RE = /(\. \ d {1,2})?/

    if (RE.test(valor)) {
        return true;
    } else {
        return false;
    }
}
</script>

<script>

/*function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}

$(function(){

$('.validanumericos').keypress(function(e) {
  if(isNaN(this.value + String.fromCharCode(e.charCode))) 
   return false;
})
.on("cut copy paste",function(e){
  e.preventDefault();
});

});
*/

onload = function(){ 
  var ele = document.querySelectorAll('.validanumericos')[0];
  ele.onkeypress = function(e) {
     if(isNaN(this.value+String.fromCharCode(e.charCode)))
        return false;
  }
  ele.onpaste = function(e){
     e.preventDefault();
  }
}


<?php
    }else {
        echo "Site not Found";
} ?>