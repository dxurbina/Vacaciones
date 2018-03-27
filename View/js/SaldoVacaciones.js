var dato, tabla, idEmp;

/*function fillModalData(dato){
     $.ajax({
         data: obj,
         url: "?c=SaldoVacaciones&a=SaldoVacacionesbyId",
         type: "POST",
         dataType: 'json',
         contentType: 'application/json; charset= utf-8',
         error: function(xhr, ajaxOptions, thrownError){
             console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
         },
         success: function (data) {
             console.log(data);
             
            $("#PNombre").val(data[0].PNombre );   
            $("#Cedula").val(data[0].Cedula);
            $("#CargarEmpleado").val(data[0].IdEmpleado);
            /*loadMunicipality(data);
            loadDptosEmpresa(data);
            loadCargos(data);
            loadJefe(data);*/
           
        /* }
     });
     
}*/
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
            tabla = $("#tbl_Historial").DataTable();
    for (var i = 0; i < data.length; i++) {
        tabla.fnAddData([
            (data[i].PNombre + " "+ data[i].PApellido),
            (data[i].NombreCargo),
            data[i].CantDias,
            (data[i].FechaI + " al " + data[i].FechaF),
            data[i].Tipo,
            data[i].FechaSolicitud,
            data[i].FechaRespuesta,
           (data[i].NJefe + " " + data[i].AJefe + " - " + data[i].Estado),
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

/*$(document).ready(function()
{
   $("#modalsol").modal("show");
});*/