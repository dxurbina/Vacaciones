$(document).ready(function(){
    
});

function stringToDate(_date,_format,_delimiter)
{
            var formatLowerCase=_format.toLowerCase();
            var formatItems=formatLowerCase.split(_delimiter);
            var dateItems=_date.split(_delimiter);
            var monthIndex=formatItems.indexOf("mm");
            var dayIndex=formatItems.indexOf("dd");
            var yearIndex=formatItems.indexOf("yyyy");
            var month=parseInt(dateItems[monthIndex]);
            month-=1;
            var formatedDate = new Date(dateItems[yearIndex],month,dateItems[dayIndex]);
            return formatedDate;
}


 var $dato1, $dato2, row, f = new Date();
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
            
            var options = { year: 'numeric', month: 'long', day: 'numeric' };
            tabla = $("#tbl_Solicitud").DataTable({
                "aaSorting": [[0, 'desc']]});
    for (var i = 0; i < data.length; i++) {
        $porciones =data[i].FechaI.split('-');
        $newDateI = $porciones[2] + "/" + $porciones[1] + "/" + $porciones[0];
        $porciones =data[i].FechaF.split('-');
        $newDateF = $porciones[2] + "/" + $porciones[1] + "/" + $porciones[0]; 
       
            var f = stringToDate($newDateI,"dd/MM/yyyy","/");
            var t = stringToDate($newDateF,"dd/MM/yyyy","/");
            tabla.fnAddData([
                data[i].IdVacaciones,
                ( data[i].PNombre + " "+ data[i].PApellido),
                (data[i].NombreCargo),
                data[i].CantDias,
                (f.toLocaleDateString("es-ES", options) ),
                t.toLocaleDateString("es-ES", options),
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
    //var $d = $(this).parent("td");     
    //console.log($d);
    //var col = $d.parent().children().index($d);
    //console.log(col);
    //row = $d.parent().parent().children().index($d.parent());
    //row = $('.btn-show').parent().parent()[0];
    
    rowid = $(this).parents("tr").find("td").eq(0).html();
    //console.log(id);
    //EData = tabla.fnGetData(id);
   // console.log(EData);
    //alert(dato[row].Descripcion);
    
    console.log(rowid);
    //$("#Descrip").val(dato1[EData[0]].Descripcion);
    obj = JSON.stringify({ id: rowid });
    $.ajax({
        data: obj,
        url: "?c=Vacaciones&a=showById",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
           $("#Descrip").val(data[0].Descripcion);
        }
        });
});

$(document).on('click', '.btn-accept', function(e){
    e.preventDefault();
    //var $d = $(this).parent("td");     
    row = $(this).parents("tr").find("td").eq(0).html(); // $d.parent().parent().children().index($d.parent()); 
    console.log(row);
   // console.log(dato1[row].IdVacaciones);
});

$(document).on('click', '.btn-deny', function(e){
    e.preventDefault();
    //var $d = $(this).parent("td");     
    row = $(this).parents("tr").find("td").eq(0).html(); //$d.parent().parent().children().index($d.parent());
    console.log(row);
});

$(document).on('click', '.btn-revert', function(e){
    e.preventDefault();
   // var $d = $(this).parent("td");     
    row = $(this).parents("tr").find("td").eq(0).html(); //$d.parent().parent().children().index($d.parent());
    console.log(row);
});


$(document).on('click', '#update', function(e){
    e.preventDefault();
    if($(this).val() == "Aceptar"){
        _state = "Aceptada";
        var obj = JSON.stringify({ id: row, Estado: _state });
    }else if($(this).val() == "Rechazar"){
        _state = "Rechazada";
        var obj = JSON.stringify({ id: row, Estado: _state });
    }else if($(this).val() == "Revertir"){
        _state = "Revertida";
        var obj = JSON.stringify({ id: row, Estado: _state });
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
            //console.log(data);
           // console.log(data.length);
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