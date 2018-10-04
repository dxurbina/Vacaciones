<?php if(isset($_SESSION['nickname'])){
?>  

<div class="modal-dialog" role="document">
    <div style="width: 100%;" class="modal-content">
        <div class="modal-header">
                  <center><h4 class="modal-title" id="myModalLabel"><strong>Activar donación de vacaciones</strong></h4></center>
        </div>
        <div class="modal-body" onload="inicializar()">
            <div class="row row-fluid">
                
                   <center><p>En está pantalla puede habilitar y deshabilitar la opción de <strong>donar vacaciones</strong> en las pantallas
                   de solicitud de vacaciones de cada colaborador</p></center>
                 <center><label  class="donar" for="donar"></label></center>
            </div>
            <div class="modal-footer">
              <!--  <center><button class="btn btn-primary" type="button" id="ActDonar" data-dismiss="modal">Activar donar vacaciones </button></center>-->
              <!--<label for="Donar">Donar: </label>-->
              <input class="btn btn-primary"  type="button" value="Habilitar" id="ActDonarMostar">
              <input class="btn btn-primary"  type="button" value="Deshabilitar" id="ActDonarOcultar">
            </div>
        </div>
    </div> 
</div>

<script type="text/javascript" src="View/js/Vacaciones.js"></script>

<?php
    }else {
        echo "Site not Found";
} ?>