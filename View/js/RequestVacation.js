$(document).ready(function(){

});
 var $dato, row;
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
            //console.log(data);
            //console.log(data.length);
            dato = data;
            console.log(dato);
            //addRowDT(data.d);
            tabla = $("#tbl_Solicitud").DataTable();
    for (var i = 0; i < data.length; i++) {
            tabla.fnAddData([
                data[i].IdVacaciones,
                ( data[i].PNombre + " "+ data[i].PApellido),
                (data[i].NombreCargo),
                data[i].CantDias,
                (data[i].FechaI ),
                data[i].FechaF,
                data[i].tipo,
                '<button title= "Aceptar" value= "show" class="btn btn-primary btn-accept " data-target="#imodal" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
                '<button title= "Rechezar" value= "grant" class="btn btn-danger btn-deny" data-target="#imodal2" data-toggle="modal"><i class="fa fa-eraser" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
                '<button title= "Ver Descripcion" value= "deny" class="btn btn-primary btn-show " ><i class="fa fa-plus-square" aria-hidden="true"></i></button>'
            ]);
        
        
    }
        }
    });
}
$(document).on('click', '.btn-show', function(e){
    e.preventDefault();
    var flag = true; var sum;
    var $d = $(this).parent("td");     
    //console.log($d);
    //var col = $d.parent().children().index($d);
    //console.log(col);
    row = $d.parent().parent().children().index($d.parent());
    //alert(dato[row].Descripcion);
    
    console.log(row);
    $("#Descrip").val(dato[row].Descripcion);
});

$(document).on('click', '.btn-accept', function(e){
    e.preventDefault();
    var $d = $(this).parent("td");     
    row = $d.parent().parent().children().index($d.parent()); 
});

$(document).on('click', '.btn-deny', function(e){
    e.preventDefault();
    var $d = $(this).parent("td");     
    row = $d.parent().parent().children().index($d.parent());
});

$(document).on('click', '#update', function(e){
    e.preventDefault();
    if($(this).val() == "Aceptar"){
        _state = "Aceptada";
    }else if($(this).val() == "Rechazar"){
        _state = "Rechazada";
    }else{
        alert('Datos Alterados');
        location.reload(true);
    }
    
    var obj = JSON.stringify({ id: dato[row].IdVacaciones, Estado: _state });
    $.ajax({
        data: obj,
        url: "?c=Vacaciones&a=update",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            location.reload(true); 
        }
        });
    
});

$(document).on('click', '#update-', function(e){
    e.preventDefault();
    var obj = JSON.stringify({ id: dato[row].IdVacaciones, Estado: 'Rechazada' });
    $.ajax({
        data: {},
        url: "?c=Vacaciones&a=update",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            location.reload(true); 
        }
        });
    
});


function sendDataAjax2() {
    $.ajax({
        type: "POST",
        url: "?c=Vacaciones&a=showHistory",
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
            tabla = $("#tbl_Historial").DataTable();
    for (var i = 0; i < data.length; i++) {
        tabla.fnAddData([
            data[i].IdVacaciones,
            (data[i].PNombre + " "+ data[i].PApellido),
            (data[i].NombreCargo),
            data[i].CantDias,
            (data[i].FechaI + " al " + data[i].FechaF),
            data[i].tipo,
            data[i].FechaSolicitud,
            data[i].FechaRespuesta,
            (data[i].NJefe + " " + data[i].AJefe + " - " + data[i].Estado)
        ]);
    }
        }
    });
}

sendDataAjax1();
sendDataAjax2();