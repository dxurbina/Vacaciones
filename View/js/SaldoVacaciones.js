var dato, tabla, idEmp, $row, $dato2, Tipo;

//Función para la carga de los valores del datatable
 function sendDataAjax() {
    $.ajax({
        type: "POST",
        url: "?c=SaldoVacaciones&a=HistVac",
        data: {},
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            console.log(data.length);
            dato2 = data;
            var boss;
            tabla = $("#tbl_Historial").DataTable({
                "aaSorting": [[0, 'desc']]});
                 
    for (var i = 0; i < data.length; i++) {
        if(typeof(data[i].NJefe) == "undefined"){
            boss = " - ";
        }else {boss = data[i].NJefe + " " + data[i].AJefe + " - " + data[i].Estado}
        var cambio;
        if((data[i].Estado=='Aceptada') || (data[i].Estado=='Rechazada') || (data[i].Estado=='Revertida')){
            cambio = '-'
            
        }else{
            cambio = '<button title= "Editar" value= "Editar" class="btn btn-primary btn-edit "><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
            '<button title= "Eliminar" value= "Cancelar" class="btn btn-danger btn-del " data-target="#imodalel" data-toggle="modal"><i class="fa fa-eraser" aria-hidden="true"></i></button>&nbsp;&nbsp;'
        }
        
        tabla.fnAddData([
            //(data[i].PNombre + " "+ data[i].PApellido),
            //(data[i].NombreCargo),
            data[i].IdVacaciones,
            data[i].CantDias,
            (data[i].FechaI + " al " + data[i].FechaF),
            data[i].Tipo,
            data[i].FechaSolicitud,
            data[i].FechaRespuesta,
            //boss,
           //(data[i].NJefe + " " + data[i].AJefe + " - " + data[i].Estado),
           data[i].Estado,
           cambio
           //'<button title= "Editar" value= "Editar" class="btn btn-primary btn-edit "><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
           //'<button title= "Eliminar" value= "Cancelar" class="btn btn-danger btn-del " data-target="#imodalel" data-toggle="modal"><i class="fa fa-eraser" aria-hidden="true"></i></button>&nbsp;&nbsp;'
        ]);
    }
        }
    });
}
sendDataAjax();

//Botón para abrir la modal solicitar vacaciones.
$('#openModal').on('click', function(e) {
    e.preventDefault();
    $("#modalsol").modal("show");
});

//Método para ver el valor del radio button desde la base de datos.
function radioSeleccionadoEdit(){
    elem=document.getElementsByName('Tipo'); 
    for(i=0;i<elem.length;i++) 
        if (elem[i].checked) { 
            valor = elem[i].value; 
        } return valor;
  }

  //Funcion para capturar el valor del radio button en bd
  function selectRadio(){
  radioSeleccionadoEdit();
    if((valor=='Vacaciones')){ //aqui por favor
        $("#Tipo").val(data[0].Tipo).checked;
    if(valor=='Enfermedad'){
        $("#Tipo").val(data[0].Tipo).checked;
        }
    if(valor=='Permiso Especial'){
        $("#Tipo").val(data[0].Tipo).checked;
        }
    }
   // console.log(valor);
   
  }

//Función para cargar la modal con los campos que tiene en la base de datos.
function fillModalData(dato){
    //selectRadio();
    var obj = JSON.stringify({ id: dato[0] });
  //  console.log(obj);
    $.ajax({
        data: obj,
        url: "?c=Vacaciones&a=ListSolicitudById",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {

            //Para marcar el radio button que trae de la base de datos.
        if(data[0].Tipo=='Vacaciones'){
           $('input:radio[name="Tipo"][value="Vacaciones"]').prop('checked', true);
        }else if(data[0].Tipo=='Enfermedad'){
            $('input:radio[name="Tipo"][value="Enfermedad"]').prop('checked', true);
        }else if(data[0].Tipo=='Permiso Especial'){
            $('input:radio[name="Tipo"][value="Permiso Especial"]').prop('checked', true);
        }
           $("#idVac").val(data[0].IdVacaciones)
           $("#NumDay2").val(data[0].CantDias);
           //Así estaba a las 9:50 am 23-05-18
           /*$("#pointer2").val(data[0].FechaI);
           $("#dateF2").val(data[0].FechaF);*/

           //Formatear las fechas recibidas de la base de datos 23-05-18 11:29 am.
           var FechaInicial = moment(data[0].FechaI).format("DD/MM/YYYY");
           $('#pointer2').val(FechaInicial);
           var FechaFinal = moment(data[0].FechaF).format("DD/MM/YYYY");
           $('#dateF2').val(FechaFinal);
           $("#comentarios2").val(data[0].Descripcion);
        }
    });
}

// evento click para boton actualizar
$(document).on('click', '.btn-edit', function (e) {
    e.preventDefault();
    var valores = $(this).parents("tr").find("td")[6].innerHTML; // obtiene una columna especifica de la fila seleccionada
    //console.log(valores);
    if(valores=='Pendiente'){
        $("#modalSolEdit").modal("show");
        var _row = $(this).parent().parent()[0];
        dato = tabla.fnGetData(_row);
                /* var $miSelect = $('#modalsol');
                 $miSelect.val($miSelect.children('option:eq(0)').val());*/
        idVacaciones = dato[0];
        fillModalData(dato);
    } else {
        //alert('Solo se pueden editar las Solicitudes que tienen un estado de Pendiente');
        $("#imodalSolEditInfo").modal("show");
    }   
 
});

// evento click para cancelar la solicitud de vacaciones
$(document).on('click', '.btn-del', function (e) {
    var eliminar = confirm('¿Desea cancelar la solicitud de vacaciones?');
    var valores = $(this).parents("tr").find("td")[6].innerHTML; // obtiene una columna especifica de la fila seleccionada
   // console.log(valores);    0
    if(eliminar) {
        if(valores!='Aceptada' && valores!='Rechazada'){
            e.preventDefault;
            var _row = $(this).parent().parent()[0];
           // console.log(_row);
            dato = tabla.fnGetData(_row);
            idVac = dato[0];
            //console.log(idVac);
            var obj = JSON.stringify({ id: idVac });
               $.ajax({
                  url: "?c=Vacaciones&a=CancelarSolicitud",
                  type: "POST",
                  data: obj,
                  dataType: 'json',
                  contentType: 'application/json; charset= utf-8',
                  success: function(data){
                    }
                });
                  alert('Solicitud de vacaciones cancelada correctamente.');
                  location.reload();
        }else 
        {
            alert('Usted solo puede eliminar las solicitudes que están pendientes.')
        } 
    }
          return false;     
});