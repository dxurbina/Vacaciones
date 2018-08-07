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
                    ( data[i].NJefe + " "+ data[i].AJefe),
                    data[i].Saldo,
                    
                    '<button title= "Sugerir vacaciones" value= "Sugerir" class="btn btn-primary btn-edit "><i class="fa fa-calendar" aria-hidden="true"></i></button>&nbsp;&nbsp;'
                ]);
            }
        }
    });
}
/* Call functions  */
sendDataAjax();

// evento click para boton sugerir vacaciones
$(document).on('click', '.btn-edit', function (e) {
    e.preventDefault();
    $("#modalSolSugerir").modal("show");
    var _row = $(this).parent().parent()[0];
    dato = tabla.fnGetData(_row);
    idEmpleado = dato[0];
    fillModalData(dato);
 
});

function fillModalData(dato){
    var obj = JSON.stringify({ id: dato[0] });
    console.log(obj);
    $.ajax({
        data: obj,
        url: "?c=SaldoColaboradores&a=listFacByEmp",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            //console.log(data.IdEmpleado);
            $("#idEmp").val(data.IdEmpleado);
            $("#factor3").val(data.Factor);
            $("#SaldoAct").val(data.Saldo);
        }
    });

}