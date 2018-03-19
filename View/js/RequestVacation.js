$(document).ready(function(){

});
$data;
function sendDataAjax1() {
    $.ajax({
        type: "POST",
        url: "?c=Vacaciones&a=showAll",
        data: {},
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            console.log(data.length);
            //addRowDT(data.d);
            tabla = $("#tbl_Solicitud").DataTable();
    for (var i = 0; i < data.length; i++) {
        tabla.fnAddData([
            data[i].IdVacaciones,
            ( data[i].PNombre + " "+ data[i].PApellido),
            data[i].CantDias,
            data[i].FechaI,
            data[i].FechaF,
            data[i].tipo,
            '<button title= "Aceptar" value= "show" class="btn btn-primary btn-edit " data-target="#imodal" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
            '<button title= "Rechezar" value= "grant" class="btn btn-danger btn-del "><i class="fa fa-eraser" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
            '<button title= "Ver Descripcion" value= "deny" class="btn btn-primary btn-vac " data-target="#imodalver" data-toggle="modal"><i class="fa fa-plus-square" aria-hidden="true"></i></button>'
        ]);
    }
        }
    });
}
$(documento).on('click', '#btnshow', function(e){
    e.preventDefault();
});


function sendDataAjax2() {
    $.ajax({
        type: "POST",
        url: "?c=Vacation&a=showHistory",
        data: {},
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            console.log(data.length);
            //addRowDT(data.d);
            tabla = $("#tbl_Solicitud").DataTable();
    for (var i = 0; i < data.length; i++) {
        tabla.fnAddData([
            data[i].IdEmpleado,
            ( data[i].PNombre + " "+ data[i].PApellido),
            data[i].Telefono,
            data[i].Dep,
            data[i].NombreCargo,
            (data[i].NJefe + " " + data[i].AJefe),
            '<button title= "Editar/ver" value= "Actualizar" class="btn btn-primary btn-edit " data-target="#imodal" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
            '<button title= "Eliminar" value= "Borrar" class="btn btn-danger btn-del "><i class="fa fa-eraser" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
            '<button title= "Vacaciones" value= "VerVacaciones" class="btn btn-primary btn-vac " data-target="#imodalver" data-toggle="modal"><i class="fa fa-plus-square" aria-hidden="true"></i></button>'
        ]);
    }
        }
    });
}

sendDataAjax1();