var datos, tabla;
$(document).ready(function(){
	$("#casilla").change(function(){
        if($("#casilla").val()=="Ver") {
            $("#desac1").attr('disabled', 'disabled');
            $("#desac2").attr('disabled', 'disabled');
            $("#desac3").attr('disabled', 'disabled');
            $("#desac4").attr('disabled', 'disabled');
            $("#desac5").attr('disabled', 'disabled');
            $("#desac6").attr('disabled', 'disabled');
            $("#desac7").attr('disabled', 'disabled');
            $("#desac8").attr('disabled', 'disabled');
            $("#desac9").attr('disabled', 'disabled');
            $("#desac10").attr('disabled', 'disabled');
            $("#desac11").attr('disabled', 'disabled');
            $("#desac12").attr('disabled', 'disabled');
            $("#desac13").attr('disabled', 'disabled');
            $("#desac14").attr('disabled', 'disabled');
            $("#desac15").attr('disabled', 'disabled');
            $("#desac16").attr('disabled', 'disabled');
            $("#desac17").attr('disabled', 'disabled');
            $("#desac18").attr('disabled', 'disabled');
            $("#desac19").attr('disabled', 'disabled');
            $("#desac20").attr('disabled', 'disabled');
            $("#desac21").attr('disabled', 'disabled');
            $("#desac22").attr('disabled', 'disabled');
            $("#desac23").attr('disabled', 'disabled');
            $("#desac24").attr('disabled', 'disabled');
            $("#desac25").attr('disabled', 'disabled');
            $("#desac26").attr('disabled', 'disabled');
            $("#desac27").attr('disabled', 'disabled');
            $("#desac28").attr('disabled', 'disabled');
            $("#btnActualizar").attr('disabled', 'disabled');
        }
        else {
            $("#desac1").removeAttr("disabled");
            $("#desac2").removeAttr("disabled");
            $("#desac3").removeAttr("disabled");
            $("#desac4").removeAttr("disabled");
            $("#desac5").removeAttr("disabled");
            $("#desac6").removeAttr("disabled");
            $("#desac7").removeAttr("disabled");
            $("#desac8").removeAttr("disabled");
            $("#desac9").removeAttr("disabled");
            $("#desac10").removeAttr("disabled");
            $("#desac11").removeAttr("disabled");
            $("#desac12").removeAttr("disabled");
           
            $("#desac14").removeAttr("disabled");
            
            $("#desac16").removeAttr("disabled");
            $("#desac17").removeAttr("disabled");
            $("#desac18").removeAttr("disabled");
            $("#desac19").removeAttr("disabled");
            $("#desac20").removeAttr("disabled");
            $("#desac21").removeAttr("disabled");
            $("#desac22").removeAttr("disabled");
            $("#desac23").removeAttr("disabled");
            $("#desac24").removeAttr("disabled");
            $("#desac25").removeAttr("disabled");
            $("#desac26").removeAttr("disabled");
            $("#desac27").removeAttr("disabled");
            $("#desac28").removeAttr("disabled");
            
            $("#btnActualizar").removeAttr("disabled");
        }
        });
});

function DisabledField(){
    if($("#casilla").val()=="Ver") {
        $("#desac1").attr('disabled', 'disabled');
        $("#desac2").attr('disabled', 'disabled');
        $("#desac3").attr('disabled', 'disabled');
        $("#desac4").attr('disabled', 'disabled');
        $("#desac5").attr('disabled', 'disabled');
        $("#desac6").attr('disabled', 'disabled');
        $("#desac7").attr('disabled', 'disabled');
        $("#desac8").attr('disabled', 'disabled');
        $("#desac9").attr('disabled', 'disabled');
        $("#desac10").attr('disabled', 'disabled');
        $("#desac11").attr('disabled', 'disabled');
        $("#desac12").attr('disabled', 'disabled');
        $("#desac13").attr('disabled', 'disabled');
        $("#desac14").attr('disabled', 'disabled');
        $("#desac15").attr('disabled', 'disabled');
        $("#desac16").attr('disabled', 'disabled');
        $("#desac17").attr('disabled', 'disabled');
        $("#desac18").attr('disabled', 'disabled');
        $("#desac19").attr('disabled', 'disabled');
        $("#desac20").attr('disabled', 'disabled');
        $("#desac21").attr('disabled', 'disabled');
        $("#desac22").attr('disabled', 'disabled');
        $("#desac23").attr('disabled', 'disabled');
        $("#desac24").attr('disabled', 'disabled');
        $("#desac25").attr('disabled', 'disabled');
        $("#desac26").attr('disabled', 'disabled');
        $("#desac27").attr('disabled', 'disabled');
        $("#desac28").attr('disabled', 'disabled');
    }
    else {
        $("#desac").removeAttr("disabled");
    }
}
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


sendDataAjax();
DisabledField();


function fillModalData(dato){
    //var obj = { id: dato[0] };
   var obj = JSON.stringify({ id: dato[0] });
    console.log(obj);
    $.ajax({
        data: obj,
        url: "?c=Empleado&a=ListEmployeebyId",
        type: "POST",
        
        
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            //console.log(data.length);
            //addRowDT(data.d);
           // tabla = $("#tbl_Empleados").DataTable();
           $("#desac1").val(data[0].PNombre);
           $("#desac2").val(data[0].SNombre);
           $("#desac3").val(data[0].PApellido);
           $("#desac4").val(data[0].SApellido);
           if(data[0].Residencia == 0){
            $("#desac5").val("Si");
           }else{
            $("#desac5").val("No");
            
           }
           $("#desac6").val(data[0].Cedula);
           $("#desac7").val(data[0].Pasaporte);
           $("#desac8").val(data[0].NInss);
           $("#desac9").val(data[0].FechaNac);
           $("#desac9").val(data[0].FechaNac);
           

        }
    });
}

// evento click para boton actualizar
$(document).on('click', '.btn-edit', function (e) {
    e.preventDefault();

    var _row = $(this).parent().parent()[0];
    //data = tabla.row(_row).data();
    
    dato = tabla.fnGetData(_row);
    //console.log(data[0]);
    fillModalData(dato);

});

// evento click para boton eliminar
$(document).on('click', '.btn-del', function (e) {
    e.preventDefault();

    var _row = $(this).parent().parent()[0];
    
    dato = tabla.fnGetData(_row);
   
});





//Ajax para cargar municipios
function CargarMunicipios(val)
{  
    $.ajax({
        type: "POST",
        url: "?c=Empleado&a=ListMunId",
        data: 'IdDepartamento='+val,
        success: function(resp){
            $('#cboDepto').html(resp);
        }
    });
}

CargarMunicipios();