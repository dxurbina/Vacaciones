var dato, tabla, idEmp, row;
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
            $("#desac28").removeAttr("disabled");
            $("#desac29").removeAttr("disabled");
            
            
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
               // console.log($("#desac24").val());
                $.ajax({
                    data: obj,
                    url: "?c=Empleado&a=showMunicipality",
                    type: "POST",
                    
                    
                    dataType: 'json',
                    contentType: 'application/json; charset= utf-8',
                    beforeSend: function () 
                    {
                        $("#desac24").prop('disabled', true);
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                    },
                    success: function (data) {
                        $("#desac24").prop('disabled', false);
                        //console.log(data);
                        _Mun.find('option').remove();
                        $(data).each(function(i, v){ // indice, valor

                            _Mun.append('<option value="' + v.IdMunicipio + '">' + v.Nombre + '</option>');
                        })
                    }
                    });
                
                });
        
                $("#desac26").change(function(){
                    
        
                        var Cargo = $("#desac27");
                        var _select = $("#desac26").val();
                        var obj = JSON.stringify({ id: _select });
                        //console.log($("#desac24").val());
                        $.ajax({
                            data: obj,
                            url: "?c=Empleado&a=showCargos",
                            type: "POST",
                            
                            dataType: 'json',
                            contentType: 'application/json; charset= utf-8',
                            beforeSend: function () 
                            {
                                $("#desac26").prop('disabled', true);
                            },
                            error: function(xhr, ajaxOptions, thrownError){
                                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                            },
                            success: function (data) {
                                $("#desac26").prop('disabled', false);
                                //console.log(data);
                                Cargo.find('option').remove();
                                $(data).each(function(i, v){ // indice, valor
        
                                    Cargo.append('<option value="' + v.IdCargo + '">' + v.NombreCargo + '</option>');

                                })
                                var cargo2 = $("#desac27");
                                var _select2 = $("#desac27").val();
                               
                                var obj2 = JSON.stringify({ id: _select2 });
                                $.ajax({
                                    data: obj2,
                                    url: "?c=Empleado&a=showJefebyPosition",
                                    type: "POST",
                                    dataType: 'json',
                                    contentType: 'application/json; charset= utf-8',
                                    beforeSend: function () 
                                            {
                                                cargo2.prop('disabled', true);
                                            },
                                    error: function(xhr, ajaxOptions, thrownError){
                                        console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                                    },
                                    success: function (data) {
                                        cargo2.prop('disabled', false);
                                        //console.log(data);
                                        $("#desac28").find('option').remove();
                                        $(data).each(function(i, v){ // indice, valor
                                            $("#desac28").append('<option value="' + v.IdEmpleado + '">' + (v.PNombre + " "+ v.PApellido ) + '</option>');
                                           
                                        })
                                        }
                                    });
                            }
                            });
                        
                        });

                        $("#desac27").change(function(){
                            var _Jefe = $("#desac28");
                            var _select = $("#desac27").val();
                            var obj = JSON.stringify({ id: _select });
                           //console.log(_select);
                            $.ajax({
                                data: obj,
                                url: "?c=Empleado&a=showJefebyPosition",
                                type: "POST",
                                dataType: 'json',
                                contentType: 'application/json; charset= utf-8',
                                beforeSend: function () 
                                {
                                    $("#desac27").prop('disabled', true);
                                },
                                error: function(xhr, ajaxOptions, thrownError){
                                    console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                                },
                                success: function (data) {
                                    $("#desac27").prop('disabled', false);
                                   // console.log(data);
                                    _Jefe.find('option').remove();
                                    $(data).each(function(i, v){ // indice, valor
            
                                        $("#desac28").append('<option value="' + v.IdEmpleado + '">' + (v.PNombre + " "+ v.PApellido ) + '</option>');
                                    });
                                  //  console.log(obj);
                                    $.ajax({
                                        data: obj,
                                        url: "?c=Empleado&a=showCCostosbyId",
                                        type: "POST",
                                        dataType: 'json',
                                        contentType: 'application/json; charset= utf-8',
                                        error: function(xhr, ajaxOptions, thrownError){
                                            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                                        },
                                        success: function (data) {
                                            //console.log(data);
                                            $("#desac30").val(data[0].Nombre + "-" + data[0].Codigo);
                                        }
                                        });
                                }
                                });
                            });

                            $("#CargarEmpleado").change(function(){
                              //  console.log(idEmp);
                                $("#CargarEmpleado").val(idEmp);
                            });
    


});

    function clear(){
        for(var i =1; i < 31; i++){
            $("#desac" + i).val("");
        }
    }

function DisabledField(){
    for(var i =1; i < 31; i++){
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
                   // console.log(data.length);
                    var boss;
                    //addRowDT(data.d);
                    tabla = $("#tbl_Empleados").DataTable();
                    
                    for (var i = 0; i < data.length; i++) {
                        if(typeof(data[i].NJefe) == "undefined"){
                            boss = " - ";
                        }else {boss = data[i].NJefe + " " + data[i].AJefe }
                        tabla.fnAddData([
                            data[i].IdEmpleado,
                            ( data[i].PNombre + " "+ data[i].PApellido),
                            data[i].Telefono,
                            data[i].Dep,
                            data[i].NombreCargo,
                            boss,
                            '<button title= "Editar/ver" value= "Actualizar" class="btn btn-primary btn-edit " data-target="#imodal" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
                            '<button title= "Editar Usuario" value= "EditUser" class="btn btn-primary btn-usr " data-target="#imodalusr" data-toggle="modal"><i class="fa fa-user-o" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
                            '<button title= "Eliminar" value= "Borrar" class="btn btn-danger btn-del "><i class="fa fa-eraser" aria-hidden="true"></i></button>'
                            
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
        beforeSend: function () 
                {
                    _deptos.prop('disabled', true);
                },
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            _deptos.find('option').remove();
           // console.log(data);
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
    var _idmun = datos[0].IdMunicipio;
    var obj = JSON.stringify({ MUN: _idmun });

     //console.log(obj);
    $.ajax({
        data: obj,
        url: "?c=Empleado&a=showMunicipality",
        type: "POST",
        
        
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        beforeSend: function () 
                {
                    _Mun.prop('disabled', true);
                },
        error: function(xhr, ajaxOptions, thrownError){
           // console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
          // console.log(data);
            _Mun.find('option').remove();
            $(data).each(function(i, v){ // indice, valor
                _Mun.append('<option value="' + v.IdMunicipio + '">' + v.Nombre + '</option>');
            })

            var $miSelect = $('#desac25');
            //console.log(data[0].IdMunicipio);
            $miSelect.val($miSelect.children('option[value= ' + _idmun + ']').val());
           // $("#desac25 option[value='"+ data[0].IdMunicipio +"']").attr("selected",true);
        }
        });
}

function loadDptosEmpresa(datos){
    var _Dptos = $("#desac26");
    var _idDep = datos[0].IdDep;
        //var obj = JSON.stringify({ id: datos[0].IdDepartamento });
    
    $.ajax({
        data: {},
        url: "?c=Empleado&a=showDptosEmpresa",
        type: "POST",
        
        
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        beforeSend: function () 
                {
                    _Dptos.prop('disabled', true);
                },
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
           // console.log(data);
            _Dptos.find('option').remove();
            $(data).each(function(i, v){ // indice, valor
                _Dptos.append('<option value="' + v.IdDep + '">' + v.Nombre + '</option>');
            })

            var $miSelect = $('#desac26');
            //console.log(datos[0].IdCargo);
           $miSelect.val($miSelect.children('option[value= ' + _idDep + ']').val());
        }
        });
}

function loadCargos(datos){
    var _Cargo = $("#desac27");
    var _idCargo = datos[0].IdCargo;
    var obj = JSON.stringify({ id: datos[0].IdDep });
    
    $.ajax({
        data: obj,
        url: "?c=Empleado&a=showCargos",
        type: "POST",
        
        
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        beforeSend: function () 
                {
                    _Cargo.prop('disabled', true);
                },
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            //console.log(data);
            _Cargo.find('option').remove();
            $(data).each(function(i, v){ // indice, valor
                _Cargo.append('<option value="' + v.IdCargo + '">' + v.NombreCargo + '</option>');
            })

            var $miSelect = $('#desac27');
            //console.log(datos[0].IdCargo);
           $miSelect.val($miSelect.children('option[value= ' + _idCargo + ']').val());
        }
        });
}

function loadJefe(datos){
    var _Jefe = $("#desac28");
    var _idJefe = datos[0].IdJefeE;
     
    var obj = JSON.stringify({ id: datos[0].IdJefeE });
    //console.log(_idJefe);
    if (typeof _idJefe != "undefined") {
        $.ajax({
            data: obj,
            url: "?c=Empleado&a=showJefe",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            beforeSend: function () 
                    {
                        _Jefe.prop('disabled', true);
                    },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
               // console.log(data);
                _Jefe.find('option').remove();
                $(data).each(function(i, v){ // indice, valor
                    _Jefe.append('<option value="' + v.IdEmpleado + '">' + (v.PNombre + " "+ v.PApellido ) + '</option>');
                   
                })
                var $miSelect = $('#desac28');
                //console.log($miSelect);
                //console.log(datos[0].IdCargo);
               $miSelect.val($miSelect.children('option[value= ' + _idJefe + ']').val());
               var _Empleado  =  data[0].IdEmpleado;
              // var $miSelect2 = $('#CargarEmpleado');
              // console.log(_cargo);
              // $miSelect2.val($miSelect2.children('option[value= ' + _Empleado + ']').val());
              
            }
            });
    }
    
}




sendDataAjax();


function fillModalData(dato){
   // var obj = { id: dato[0] };
   var obj = JSON.stringify({ id: dato[0] });
  //console.log(obj);
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
            //console.log(data);
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
           if(data[0].FechaNac == null){
                $("#desac9").val("");
           }else{
                    _date.type = "date";
                if(!(_date  == "0000-00-00")){
                    $("#desac9").val(_date);
                }else{
                    $("#desac9").val("");
            }
           }
           
           if(data[0].Sexo == null || data[0].Sexo == ""){
            var $miSelect = $('#desac10');
           
             $miSelect.val($miSelect.children('option:eq(0)').val());
           }else if(data[0].Sexo == "M"){
             var $miSelect = $('#desac10');
             
             $miSelect.val($miSelect.children('option:eq(1)').val());
            }else{
             var $miSelect = $('#desac10');
             $miSelect.val($miSelect.children('option:eq(2)').val());
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

           if(data[0].Hijos == "0" || data[0].NumHijos == null){
            var $miSelect = $('#desac12');
            $miSelect.val($miSelect.children('option:eq(1)').val());
            
           }else{
            var $miSelect = $('#desac12');
            $miSelect.val($miSelect.children('option:eq(0)').val());
            $("#desac13").val(data[0].NumHijos);
           }

           if(data[0].Hermanos == "0" || data[0].NumHermanos == null){
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
           $("#desac29").val(data[0].FechaIngreso);
           $("#desac30").val(data[0].Nombre + " - " + data[0].Codigo);
           $("#CargarEmpleado").val(data[0].IdEmpleado);
           loadDeparment(data[0].IdDepartamento);
           loadMunicipality(data);
           loadDptosEmpresa(data);
           loadCargos(data);
           if($('#desac27').val() != 'Gerente General'){
            loadJefe(data);
           }
           
           //$("#idEmpleado").val(data[0].IdEmpleado);
          // $("#desac1").val(data[0].IdEmpleado);
           
           //$('#desac25 option[value='+ _dep + ']').attr("selected",true);
           
        }
    });
    
}
    function showusrById(){
        var obj = JSON.stringify({ id: row });
        //console.log(obj);
         var dato;
        $.ajax({
            data: obj,
            url: "?c=Empleado&a=showUserById",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                dato = data;
               // console.log(dato);
                $('#usr').val(dato[0].Usuario);
            }
        });
    }

    $(document).on('click', '#btnUser', function (e) {
        e.preventDefault();

        var _select = $("#usr").val();
        //console.log(_select);
        var obj = JSON.stringify({ Nombre: _select });
        flag = false;
        $.ajax({
            data: obj,
            url: "?c=Empleado&a=GetUser",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
              //  console.log(data);
                $(data).each(function(i, v){ // indice, valor
                    if(v.Usuario == _select && v.IdUsuario != row ){
                        flag = true;
                    }
                })
                if(flag == false){
                    var user = $('#usr').val();
                    var pass = $('#pass').val();
                    if( pass.length > 4 && pass.length < 20 && user.length > 3){
                                
                                var obj = JSON.stringify({ Id: row, Usuario: user, Pass: pass });
                                flag = false;
                                $.ajax({
                                    data: obj,
                                    url: "?c=Empleado&a=updateUser",
                                    type: "POST",
                                    dataType: 'json',
                                    contentType: 'application/json; charset= utf-8',
                                    error: function(xhr, ajaxOptions, thrownError){
                                        console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                                    },
                                    success: function (data) {
                                        location.reload();
                                    }
                                        
                                    });  
                            
                    }else{
                        alert('Dato no esperado');
                    }
                    

                }else{
                    alert("Nombre de usuario ya existe!!");
                }
            }
                
            });

    });

// evento click para boton actualizar
$(document).on('click', '.btn-edit', function (e) {
    e.preventDefault();

    var _row = $(this).parent().parent()[0];
    //data = tabla.row(_row).data();
    
    dato = tabla.fnGetData(_row);
             var $miSelect = $('#casilla');
             $miSelect.val($miSelect.children('option:eq(0)').val());
             DisabledField();
    
    idEmp = dato[0];
    //console.log(data[0]);
    clear();
    fillModalData(dato);
    //$("#desac1").val(dato[0].IdEmpleado);
});

$(document).on('click', '.btn-usr', function (e) {
    e.preventDefault();
    
    row = $(this).parents("tr").find("td").eq(0).html();
    showusrById();
    //console.log(row);
});






// evento click para boton Eliminar
$(document).on('click', '.btn-del', function (e) {
    var eliminar = confirm('¿Desea eliminar el empleado seleccionado?');
    if(eliminar) {
    e.preventDefault;
    var _row = $(this).parent().parent()[0];
    //console.log(_row);
    dato = tabla.fnGetData(_row);
    idEmp = dato[0];
    //console.log(idEmp);
    var obj = JSON.stringify({ id: idEmp });
    $.ajax({
        url: "?c=Empleado&a=EliminarEmpId",
        type: "POST",
        data: obj,
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        success: function(data){
        }
        });
        alert('Registro eliminado correctamente.');
    }
     return false;  
});

//VER 
/*$(document).on('click', '.btn-del', function(e){
    var _row = $(this).parent().parent()[0];
    console.log(_row);
    dato = tabla.fnGetData(_row);
    idEmp = dato[0];
    console.log(idEmp);
});

$(document).on('click', '.btn-deny', function(e){
    e.preventDefault();
    var $d = $(this).parent("td");     
    row = $d.parent().parent().children().index($d.parent());
}); 

// evento click para boton Eliminar
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
    var _row = $(this).parent().parent()[0];
    console.log(_row);
    dato = tabla.fnGetData(_row);
    idEmp = dato[0];
    console.log(idEmp);
    var obj = JSON.stringify({ id: IdEmp });
    $.ajax({
        data: obj,
        url: "?c=Empleado&a=EliminarEmpId",
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
    
});*/