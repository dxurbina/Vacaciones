var datos, tabla;
$(document).ready(function(){
	$("#casilla").change(function(){
        if($("#casilla").val()=="Ver") {
            DisabledField();
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
            
            $("#btnActualizar").removeAttr("disabled");
            if($("#desac12").val() == "0"){
                $("#desac13").attr('disabled', 'disabled');
            }else{
                $("#desac13").removeAttr("disabled");
            }
        }
    });

        $("#desac12").change(function(){
            if($("#desac12").val() == "0"){
                $("#desac13").attr('disabled', 'disabled');
               }else{
                 $("#desac13").removeAttr("disabled");
               }
        });

        $("#desac14").change(function(){
            if($("#desac14").val() == "0"){
                $("#desac15").attr('disabled', 'disabled');
               }else{
                 $("#desac15").removeAttr("disabled");
               }
        });

        $("#desac24").change(function(){
            var _Mun = $("#desac25");
            var _select = $("#desac24").val();
            var obj = JSON.stringify({ id: _select });
            console.log($("#desac24").val());
            $.ajax({
                data: obj,
                url: "?c=Empleado&a=showMunicipality",
                type: "POST",
                
                
                dataType: 'json',
                contentType: 'application/json; charset= utf-8',
                beforeSend: function () 
                {
                    $(this).prop('disabled', true);
                },
                error: function(xhr, ajaxOptions, thrownError){
                    console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                },
                success: function (data) {
                    console.log(data);
                    _Mun.find('option').remove();
                    $(data).each(function(i, v){ // indice, valor

                        _Mun.append('<option value="' + v.IdMunicipio + '">' + v.Nombre + '</option>');
                    })
                }
                });
        });


});

    function clear(){
        for(var i =1; i < 28; i++){
            $("#desac" + i).val("");
        }
    }

function DisabledField(){
    for(var i =1; i < 28; i++){
        $("#desac" + i).attr('disabled', 'disabled');
        $("#btnActualizar").attr('disabled', 'disabled');
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

function loadDeparment(_dep) {
    var _deptos = $("#desac24");
    $.ajax({
        data: {},
        url: "?c=Empleado&a=showDeparment",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            $(data).each(function(i, v){ // indice, valor
                _deptos.append('<option value="' + v.IdDepartamento + '">' + v.Nombre + '</option>');
            })

            var $miSelect = $('#desac24');
           $miSelect.val($miSelect.children('option[value= ' + _dep + ']').val());
        }
        });
}

function loadMunicipality(datos){
    var _Mun = $("#desac25");
    var obj = JSON.stringify({ id: datos[0].IdDepartamento });
    console.log(obj);
    $.ajax({
        data: obj,
        url: "?c=Empleado&a=showMunicipality",
        type: "POST",
        
        
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            $(data).each(function(i, v){ // indice, valor
                _Mun.append('<option value="' + v.IdMunicipio + '">' + v.Nombre + '</option>');
            })

            var $miSelect = $('#desac25');
            console.log(data[0].IdMunicipio);
           $miSelect.val($miSelect.children('option[value= ' + data[0].IdMunicipio + ']').val());
        }
        });
}

function loadCargos(datos){
    var _Mun = $("#desac26");
    //var obj = JSON.stringify({ id: datos[0].IdDepartamento });
    console.log(obj);
    $.ajax({
        data: obj,
        url: "?c=Empleado&a=LoadCargos",
        type: "POST",
        
        
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            $(data).each(function(i, v){ // indice, valor
                _Mun.append('<option value="' + v.IdMunicipio + '">' + v.Nombre + '</option>');
            })

            var $miSelect = $('#desac26');
            console.log(data[0].IdMunicipio);
           $miSelect.val($miSelect.children('option[value= ' + data[0].IdMunicipio + ']').val());
        }
        });
}

function loadMunicipality(datos){
    var _Mun = $("#desac25");
    var obj = JSON.stringify({ id: datos[0].IdDepartamento });
    console.log(obj);
    $.ajax({
        data: obj,
        url: "?c=Empleado&a=showMunicipality",
        type: "POST",
        
        
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            $(data).each(function(i, v){ // indice, valor
                _Mun.append('<option value="' + v.IdMunicipio + '">' + v.Nombre + '</option>');
            })

            var $miSelect = $('#desac25');
            console.log(data[0].IdMunicipio);
           $miSelect.val($miSelect.children('option[value= ' + data[0].IdMunicipio + ']').val());
        }
        });
}



sendDataAjax();


function fillModalData(dato){
   // var obj = { id: dato[0] };
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
           if(data[0].Residencia == "0"){
           // $("#desac5 > option[value=0]").attr("selected",true);
            //$("#desac5").change();
            var $miSelect = $('#desac5');
            $miSelect.val($miSelect.children('option:eq(1)').val());
           }else{
            //$("#desac5 > option[value=1]").attr("selected",true);
            //$("#desac5").change();
            var $miSelect = $('#desac5');
            $miSelect.val($miSelect.children('option:first').val());
           }
           
           $("#desac6").val(data[0].Cedula);
           $("#desac7").val(data[0].Pasaporte);
           $("#desac8").val(data[0].NInss);
           var _date = data[0].FechaNac;
           _date.type = "date";
           if(!(_date  == "0000-00-00")){
            $("#desac9").val(_date);
           }else{
            $("#desac9").val("");
           }
           
           if(data[0].Sexo == "M"){
             var $miSelect = $('#desac10');
             $miSelect.val($miSelect.children('option:eq(0)').val());
            }else{
             var $miSelect = $('#desac10');
             $miSelect.val($miSelect.children('option:eq(1)').val());
            }

           if(data[0].EstadoCivil == "Casado"){
            var $miSelect = $('#desac11');
             $miSelect.val($miSelect.children('option:eq(0)').val());
           }else if(data[0].EstadoCivil == "Soltero"){
            var $miSelect = $('#desac11');
             $miSelect.val($miSelect.children('option:eq(1)').val());
           }else if(data[0].EstadoCivil == "Divorsiado"){
            var $miSelect = $('#desac11');
             $miSelect.val($miSelect.children('option:eq(2)').val());
           }else if(data[0].EstadoCivil == "Viudo"){
            var $miSelect = $('#desac11');
             $miSelect.val($miSelect.children('option:eq(3)').val());
           }

           if(data[0].Hijos == "0"){
            var $miSelect = $('#desac12');
            $miSelect.val($miSelect.children('option:eq(1)').val());
            
           }else{
            var $miSelect = $('#desac12');
            $miSelect.val($miSelect.children('option:eq(0)').val());
            $("#desac13").val(data[0].NumHijos);
           }

           if(data[0].Hermanos == "0"){
            var $miSelect = $('#desac14');
            $miSelect.val($miSelect.children('option:eq(1)').val());
            
           }else{
            var $miSelect = $('#desac14');
            $miSelect.val($miSelect.children('option:eq(0)').val());
            $("#desac15").val(data[0].NumHermanos);
           }

           $("#desac16").val(data[0].Telefono);
           $("#desac17").val(data[0].Correo);

           if(data[0].Escolaridad == "Primaria"){
            var $miSelect = $('#desac18');
             $miSelect.val($miSelect.children('option:eq(0)').val());
           }else if(data[0].Escolaridad == "Secundaria"){
            var $miSelect = $('#desac18');
             $miSelect.val($miSelect.children('option:eq(1)').val());
           }else if(data[0].Escolaridad == "Universidad"){
            var $miSelect = $('#desac18');
             $miSelect.val($miSelect.children('option:eq(2)').val());
           }else if(data[0].Escolaridad == "Postgrado"){
            var $miSelect = $('#desac18');
             $miSelect.val($miSelect.children('option:eq(3)').val());
           }else if(data[0].Escolaridad == "Maestría"){
            var $miSelect = $('#desac18');
             $miSelect.val($miSelect.children('option:eq(4)').val());
           }
           $("#desac19").val(data[0].NRuc);
           $("#desac20").val(data[0].Profesion);
           $("#desac21").val(data[0].Direccion);
           $("#desac22").val(data[0].Nacionalidad1);
           $("#desac23").val(data[0].Nacionalidad2);
           loadDeparment(data[0].IdDepartamento);
           loadMunicipality(data);
           //$('#desac24 option[value='+ data[0].IdMunicipio + ']')
           
           


        }
    });
    
}


// evento click para boton actualizar
$(document).on('click', '.btn-edit', function (e) {
    e.preventDefault();

    var _row = $(this).parent().parent()[0];
    //data = tabla.row(_row).data();
    
    dato = tabla.fnGetData(_row);
            var $miSelect = $('#casilla');
             $miSelect.val($miSelect.children('option:eq(0)').val());
             DisabledField()
    //console.log(data[0]);
    clear();
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