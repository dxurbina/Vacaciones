var dato, tabla, idFeriado, $row, newDay, newNes, newAnio;
$(document).ready(function(){
    $('#calendar').datepicker(
        {  
           minDate: -7,
           beforeShow: function() {
           $(this).datepicker('option', 'maxDate', $('#dataF').val());
        }
           //beforeShowDay: $.datepicker.noWeekends -> DESACTIVA LOS FINDES DE SEMANA
    });
        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();
            $("#modal").modal("show");
        });
    

    var date = $('#fecha').datepicker({ dateFormat: 'yy-mm-dd' }).val(); //Formateo de la fecha seleccionada en el datepicker

    });

//Función para la carga de los valores del datatable
 function sendDataAjax() {
    $.ajax({
        type: "POST",
        url: "?c=Feriados&a=ListFeriados",
        data: {},
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            
            tabla = $("#tbl_Feriados").DataTable();
    for (var i = 0; i < data.length; i++) {
        tabla.fnAddData([
            data[i].IdFeriado,
            data[i].Nombre,
            data[i].Fecha,
           //'<button title= "Editar" value= "Editar" class="btn btn-primary btn-edit "><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
           '<button title= "Eliminar" value= "Cancelar" class="btn btn-danger btn-del " data-target="#imodalel" data-toggle="modal"><i class="fa fa-eraser" aria-hidden="true"></i></button>&nbsp;&nbsp;'
        ]);
    }
        }
    });
 }
sendDataAjax();

/*$('#addfe').on('click', function(e) {
    e.preventDefault();
    $("#modal").modal("show");
});*/

//Funcionalidad que valida que no se repita los datos ya registrados
$(document).on('click', '#btnGuardar', function (e) {
    e.preventDefault();
    var _select = $("#fecha").val();
    var obj = JSON.stringify({ Fecha: _select });
    flag = false;
    $.ajax({
        data: obj,
        url: "?c=Feriados&a=GetPosition",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            $(data).each(function(i, v){ // indice, valor
                if(v.Fecha == _select){
                    flag = true;
                }
            })
            if(flag == false){
                if(_select.length > 4 && _select.length < 20){
                    document.send.submit()   
                }else{
                    alert('Dato no esperado');
                }
            }else{
                alert("Esa fecha ya existe!!");
            }


        }
    });
});

// evento click para eliminar el día feriado
$(document).on('click', '.btn-del', function (e) {
    var eliminar = confirm('¿Desea cancelar la solicitud de vacaciones?');
    if(eliminar) {
            e.preventDefault;
            var _row = $(this).parent().parent()[0];
            dato = tabla.fnGetData(_row);
            idVac = dato[0];
            var obj = JSON.stringify({ id: idVac });
               $.ajax({
                  url: "?c=Feriados&a=DeleteFeriados",
                  type: "POST",
                  data: obj,
                  dataType: 'json',
                  contentType: 'application/json; charset= utf-8',
                  success: function(data){
                    location.reload();
                    }
                });
                  alert('Registro eliminado correctamente.');
        }else 
        {
            //alert('Usted solo puede eliminar las solicitudes que están pendientes.')
            return false;
        } 
               
});


