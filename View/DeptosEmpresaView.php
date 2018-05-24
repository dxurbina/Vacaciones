<?php if(isset($_SESSION['nickname'])){
?>

<!--Modal para agregar deptosEmpresa -->
<div  class="modal fade" id ="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 10%; margin-top: 15%;" role="document">
            <div style="width: 165%;" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Registrar Departamentos Empresa</h4>
                </div>

                <form action="?c=DeptosEmpresa&a=AddDeptosEmpresa" method="POST" name ="send">
                <div class="modal-body">
                    <div class="row row-fluid">

                        <div class="col-sm-6">
                                <div class="form-group"><label>Nombre</label></div>
                                <div class="form-group"><input  id="nombre" class="input_let" name="nombre" ID="" required onkeypress="return validaLetras(event)"></input></div>
                        </div>

                        <div class="col-sm-6">
                                <div class="form-group"><label>Descipción</label></div>
                                <div class="form-group"><input  id="des" class="input_num" name="des" ID="" type="text" onkeypress="return validaLetras(event)"></input></div>
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

<div  class="modal fade" id ="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="margin: 10%; margin-top: 15%;" role="document">
            <div style="width: 165%;" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Departamento empresa</h4>
                </div>

                <form action="?c=DeptosEmpresa&a=EditDeptoEmp" method="POST" name ="send">
                <div class="modal-body">
                    <div class="row row-fluid">
                    
                        <div class="col-sm-6">
                        <input  hidden type = "text" id= "idDepEmpresa" name = "idDepEmpresa" />
                                <div class="form-group"><label>Nombre</label></div>
                                <div class="form-group"><input  id="nombre2" class="input_let" name="nombre" ID="" required onkeypress="return validaLetras(event)"></input></div>
                        </div>

                        <div class="col-sm-6">
                                <div class="form-group"><label>Descipción</label></div>
                                <div class="form-group"><input  id="des2" class="input_num" name="des" ID="" type="text" onkeypress="return validaLetras(event)"></input></div>
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

<!-- Datatable para mostrar los DeptosEmpresa-->
<div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 200%;">Gestion de Departamentos de la Empresa</h3>
                    <button title= "Add" value= "Agregar" class="btn btn-primary btn-add col-md-offset-8" data-target="#imodal" data-toggle="modal">Agregar DeptoEmpresa</button>

                </div>
                <div class="box-body table-responsive">
                    <table id="tbl_Feriados"  class="table table-bordered table-hover">
                        <thead>
                            <tr style="text-align: center;">
                                <th>IdDep</th>
                                <th>Nombre</th>
                                <!--<th>Descripción</th>-->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbl_body_table">
                                <!--Cargar lista de los DeptosEmpresa por medio de AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
</div>
    <script type="text/javascript" src="View/js/DeptosEmpresa.js"></script>

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
    //patron =/[a-z-A-Z- ñ-]/;
    patron = /^[a-zA-ZñÑ\s\W]+/; //corecto acepta espacio, acentos, ñ y espacio
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>


<?php
    }else {
        echo "Site not Found";
} ?>