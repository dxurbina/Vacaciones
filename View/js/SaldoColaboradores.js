var dato, tabla;
function sendDataAjax() {
    $.ajax({
        type: "POST",
        url: "?c=SaldoColaboradores&a=SaldoColaboradores",
        data: {},
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            tabla = $("#tbl_saldo_vacaciones").DataTable();
            
            for (var i = 0; i < data.length; i++) {
                tabla.fnAddData([
                    //data[i].IdEmpleado,
                    ( data[i].PNombre + " "+ data[i].PApellido),
                    //( data[i].PApellido + " "+ data[i].SApellido),
                    data[i].NombreCargo,
                    data[i].Saldo,
                    /* '<button title= "Editar/ver" value= "Actualizar" class="btn btn-primary btn-edit " data-target="#imodal" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
                    '<button title= "Editar Usuario" value= "EditUser" class="btn btn-primary btn-usr " data-target="#imodalusr" data-toggle="modal"><i class="fa fa-user-o" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
                    '<button title= "Eliminar" value= "Borrar" class="btn btn-danger btn-del "><i class="fa fa-eraser" aria-hidden="true"></i></button>'
                   */
                ]);
            }
        }
    });

}

sendDataAjax();