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
           '<button title= "Editar" value= "Editar" class="btn btn-primary btn-edit "><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
           '<button title= "Eliminar" value= "Cancelar" class="btn btn-danger btn-del " data-target="#imodalel" data-toggle="modal"><i class="fa fa-eraser" aria-hidden="true"></i></button>&nbsp;&nbsp;'
        ]);
    }
        }
    });
 }
sendDataAjax();

$('#addfe').on('click', function(e) {
    e.preventDefault();
    $("#modal").modal("show");
});
