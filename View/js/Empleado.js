var data, tabla;
function addRowDT(data) {
    tabla = $("#tbl_Empleados").DataTable();
    for (var i = 0; i < data.length; i++) {
        tabla.fnAddData([
            data[i].IDEmpleado,
            data[i].SNombre,
            data[i].Telefono,
            data[i].IdCargo,
            data[i].IdJefe,
            '<button title= "Actualizar" value= "Actualizar" class="btn btn-primary btn-act " data-target="#imodal" data-toggle="modal"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button>&nbsp;' +
            '<button title= "delete" value= "Borrar" class="btn btn-danger btn-del "><i class="fa fa-eraser" aria-hidden="true"></i></button>'
        ]);
    }
    // ((data[i].estado == true)? "Activo" : "Inactivo")
}


function sendDataAjax() {
    $.ajax({
        type: "POST",
        url: "?c=Empleado&a=ListEmployee",
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
            tabla = $("#tbl_Empleados").DataTable();
    for (var i = 0; i < data.length; i++) {
        tabla.fnAddData([
            data[i].IdEmpleado,
            data[i].SNombre,
            data[i].Telefono,
            data[i].IdCargo,
            data[i].IdJefe,
            '<button title= "Actualizar" value= "Actualizar" class="btn btn-primary btn-act " data-target="#imodal" data-toggle="modal"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button>&nbsp;' +
            '<button title= "delete" value= "Borrar" class="btn btn-danger btn-del "><i class="fa fa-eraser" aria-hidden="true"></i></button>'
        ]);
    }
        }
    });
}


sendDataAjax();


//Ajax para cargar municipios
function CargarMunicipios(val)
{  
    $.ajax({
        type: "POST",
        url: "?c=Empleado&a=listarMunicipios",
        data: 'IdDepartamento='+val,
        success: function(resp){
            $('#cboDepto').html(resp);
        }
    });
}
