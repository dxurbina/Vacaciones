$(document).ready(function(){
    
});

var $dato, row;
function sendDataAjax() {
    $.ajax({
        type: "POST",
        url: "?c=SaldoVacaciones&a=ShowHistory",
        data: {},
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {

            console.log(data);
            dato = data;
            tabla = $("#tbl_History").DataTable();
            for (var i = 0; i < data.length; i++) {
                tabla.fnAddData([
                    data[i].IdEmpleado,
                    ( data[i].PNombre + " "+ data[i].PApellido),
                    (data[i].NombreCargo),
                    data[i].Saldo,
                    ( data[i].NJefe + " "+ data[i].AJefe)
                ]);
            }
        }
    });
}
/* Call functions  */
sendDataAjax();
