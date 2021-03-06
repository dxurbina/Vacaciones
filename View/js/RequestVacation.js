$(document).ready(function(){
    
});
 var $dato1, $dato2, row, f = new Date();;
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
            dato1 = data;
           // console.log(dato);
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
                '<button title= "Aceptar" value= "show" class="btn btn-primary btn-accept " data-target="#imodal" data-toggle="modal"><i class="fa fa-check" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
                '<button title= "Rechezar" value= "grant" class="btn btn-danger btn-deny" data-target="#imodal2" data-toggle="modal"><i class="fa fa-eraser" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
                '<button title= "Ver Descripcion" value= "deny" class="btn btn-primary btn-show "><i class="fa fa-commenting" aria-hidden="true"></i></button>'
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
    
    //console.log(row);
    $("#Descrip").val(dato1[row].Descripcion);
});

$(document).on('click', '.btn-accept', function(e){
    e.preventDefault();
    var $d = $(this).parent("td");     
    row = $d.parent().parent().children().index($d.parent()); 
    console.log(row);
    console.log(dato1[row].IdVacaciones);
});

$(document).on('click', '.btn-deny', function(e){
    e.preventDefault();
    var $d = $(this).parent("td");     
    row = $d.parent().parent().children().index($d.parent());
    console.log(row);
});

$(document).on('click', '.btn-revert', function(e){
    e.preventDefault();
    var $d = $(this).parent("td");     
    row = $d.parent().parent().children().index($d.parent());
    console.log(row);
});


$(document).on('click', '#update', function(e){
    e.preventDefault();
    if($(this).val() == "Aceptar"){
        _state = "Aceptada";
        var obj = JSON.stringify({ id: dato1[row].IdVacaciones, Estado: _state });
    }else if($(this).val() == "Rechazar"){
        _state = "Rechazada";
        var obj = JSON.stringify({ id: dato1[row].IdVacaciones, Estado: _state });
    }else if($(this).val() == "Revertir"){
        _state = "Revertida";
        var obj = JSON.stringify({ id: dato2[row].IdVacaciones, Estado: _state });
    }else{
        alert('Datos Alterados');
        location.reload(true);
    }
    //console.log(dato2[row].IdVacaciones);
    
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


function sendDataAjax2() {
    var i;
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
            dato2 = data;
            i = data.length - 1;
/*
            var myJsonString = JSON.stringify(data);
            console.log(myJsonString);
            dajs = JSON.parse(myJsonString);
            console.log(dajs);*/
            //addRowDT(data.d);
            tabla = $("#tbl_Historial").DataTable({
                    "aaSorting": [[0, 'desc']]});
        while(i != -1) {
          var accion;
          var dias =   calculardias(data[i].FechaRespuesta);
          if(dias < 8 && data[i].Estado != 'Revertida' && data[i].Estado != 'Rechazada'){
            accion = '<button title= "Revertir" value= "deny" class="btn btn-dark btn-revert" data-target="#imodal3" data-toggle="modal"><i class="fa fa-hand-o-left" aria-hidden="true"></i></i></button>'
        }else{
            accion = '-';
        }
        //fecha.diff(f.getDate(), 'days');
       // console.log(fecha);
        tabla.fnAddData([
            data[i].IdVacaciones,
            (data[i].PNombre + " "+ data[i].PApellido),
            (data[i].NombreCargo),
            data[i].CantDias,
            (data[i].FechaI + " al " + data[i].FechaF),
            data[i].tipo,
            data[i].FechaSolicitud,
            data[i].FechaRespuesta,
            (data[i].NJefe + " " + data[i].AJefe + " - " + data[i].Estado),
            accion
        ]);
        i = i - 1;
    }
        }
    });
}

function calculardias(fecha){
	var fechaini = new Date();
	var fechafin = new Date(fecha);
	var diasdif= fechafin.getTime()-fechaini.getTime();
	var contdias = Math.round(diasdif/(1000*60*60*24)) * -1;
	return contdias;
}
sendDataAjax1();
sendDataAjax2();