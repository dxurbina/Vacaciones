var row;
$(document).ready(function(){

    showFactor();
    showDeparment();

    $(document).on('click', '.btn-add', function (e) {
        e.preventDefault();
        
        
    });

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();
        
        
        showById();
    });

    
    $(document).on('click', '#del', function (e) {
        e.preventDefault();
        var obj = JSON.stringify({ id: row });
        flag = false;
        $.ajax({
            data: obj,
            url: "?c=Position&a=destroy",
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
            
                
            
    });

    $(document).on('click', '#btnActualizar', function (e) {
        e.preventDefault();

        var _select = $("#nameu").val();
        var obj = JSON.stringify({ Nombre: _select });
        flag = false;
        $.ajax({
            data: obj,
            url: "?c=Position&a=GetPosition",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                console.log(data);
                $(data).each(function(i, v){ // indice, valor
                    if(v.NombreCargo == _select && v.IdCargo != row ){
                        flag = true;
                    }
                })
                if(flag == false){
                    if(_select.length > 4 && _select.length < 40){
                        console.log();
                        $( ".remove" ).remove();
                        $( ".del" ).remove();
                        if($("#jefeu option:selected").html() != 'Seleccione' && $("#jefeu option:selected").html() != null){
                            if($("#factoru option:selected").html() != 'Seleccione'){
                                var nombre = $("#nameu").val();
                                var costo = $('#costou').val();
                                var jefe = $('#jefeu').val();
                                var factor = $('#factoru').val();
                                var obj = JSON.stringify({ Id: row, Nombre: nombre, IdCosto: costo, IdJefe: jefe, IdFactor: factor });
                                flag = false;
                                $.ajax({
                                    data: obj,
                                    url: "?c=Position&a=update",
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
                               
                                alert('Seleccione un factor');
                            }
                        }else{
                            alert('Seleccione un cargo supervisor');
                        }
                    }else{
                        alert('Dato no esperado');
                    }
                    

                }else{
                    alert("Nombre del Cargo ya Existe!!");
                }
            }
                
            });

    });

    $(document).on('click', '#btnStore', function (e) {
        e.preventDefault();
        var _select = $("#name").val();
        var obj = JSON.stringify({ Nombre: _select });
        flag = false;
        $.ajax({
            data: obj,
            url: "?c=Position&a=GetPosition",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                $(data).each(function(i, v){ // indice, valor
                    if(v.NombreCargo == _select){
                        flag = true;
                    }
                })
                if(flag == false){
                    if(_select.length > 4 && _select.length < 30){
                        console.log(flag);
                        $( ".remove" ).remove();
                        $( ".del" ).remove();
                        if($("#jefe option:selected").html() != 'Seleccione' && $("#jefe option:selected").html() != null){
                            if($("#factor option:selected").html() != 'Seleccione'){
                                document.forms["send"].submit();
                            }else{
                               
                                alert('Seleccione un factor');
                            }
                        }else{
                            alert('Seleccione un cargo supervisor');
                        }
                    }else{
                        alert('Dato no esperado');
                    }
                        
                    

                }else{
                    alert("Nombre del Cargo ya Existe!!");
                }
            }
                
            });
            
            
       });

    sendDataAjax();

    $("#depto").change(function(){
        var _select = $("#depto").val();
        var obj = JSON.stringify({ id: _select });
        //console.log(obj);
        $.ajax({
            data: obj,
            url: "?c=Center&a=showById",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            beforeSend: function () 
            {
                $("#depto").prop('disabled', true);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
            //console.log(data);
            $("#depto").prop('disabled', false);
            $("#costo").find('option').remove();
            $("#jefe").find('option').remove();
                $("#costo").append('<option value="">Seleccione</option>');
                $(data).each(function(i, v){ // indice, valor
                    $("#costo").append('<option value="' + v.IdCosto + '">' + v.Codigo + " - "+ v.Nombre + '</option>');
                })
            }
            });
    });

    $("#deptou").change(function(){
        var _select = $("#deptou").val();
        var obj = JSON.stringify({ id: _select });
        //console.log(obj);
        $.ajax({
            data: obj,
            url: "?c=Center&a=showById",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            beforeSend: function () 
            {
                $("#deptou").prop('disabled', true);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
            //console.log(data);
            $("#deptou").prop('disabled', false);
            $("#costou").find('option').remove();
            $("#jefeu").find('option').remove();
                $("#costou").append('<option value="">Seleccione</option>');
                $(data).each(function(i, v){ // indice, valor
                    $("#costou").append('<option value="' + v.IdCosto + '">' + v.Codigo + " - "+ v.Nombre + '</option>');
                })
            }
            });
    });

    $("#costo").change(function(){
        var _select = $("#depto").val();
        var ncosto = $("#depto option:selected").html();;

        console.log(_select);
        var obj = JSON.stringify({ id: _select });
        //console.log(obj);
        $.ajax({
            data: obj,
            url: "?c=Position&a=showById",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            beforeSend: function () 
            {
                $("#costo").prop('disabled', true);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
            //console.log(data);
            $("#costo").prop('disabled', false);
            $("#jefe").find('option').remove();
                $("#jefe").append('<option value="">Seleccione</option>');
                $(data).each(function(i, v){ // indice, valor
                    $("#jefe").append('<option value="' + v.IdCargo + '">' + v.NombreCargo + ' ' + v.Codigo  + '</option>');
                })
                if(ncosto == 'Gerencia General'){
                    $("#jefe").append('<option value="null">Sin Supervisor</option>');
                }

/*
                $.ajax({
                    data: obj,
                    url: "?c=Position&a=showEspecial",
                    type: "POST",
                    dataType: 'json',
                    contentType: 'application/json; charset= utf-8',
                    beforeSend: function () 
                    {
                        $("#costo").prop('disabled', true);
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                    },
                    success: function (data) {
                    //console.log(data);
                    $("#costo").prop('disabled', false);
                    console.log(_select);
                        
                        $(data).each(function(i, v){ // indice, valor
                            console.log(v.IdCosto);
                            if(v.IdCosto == _select){
                                $("#jefe").append('<option value="null">Sin Supervisor</option>');
                            }
                        })
                    }
                    });
                    */
            }
            });
    });

    $("#costou").change(function(){
        var _select = $("#deptou").val();
        var obj = JSON.stringify({ id: _select });
        //console.log(obj);
        $.ajax({
            data: obj,
            url: "?c=Position&a=showById",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            beforeSend: function () 
            {
                $("#costou").prop('disabled', true);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
            //console.log(data);
            $("#costou").prop('disabled', false);
            $("#jefeu").find('option').remove();
                $("#jefeu").append('<option value="">Seleccione</option>');
                $(data).each(function(i, v){ // indice, valor
                    $("#jefeu").append('<option value="' + v.IdCargo + '">' + v.NombreCargo + ' ' + v.Codigo +  '</option>');
                })
                $.ajax({
                    data: obj,
                    url: "?c=Position&a=showEspecial",
                    type: "POST",
                    dataType: 'json',
                    contentType: 'application/json; charset= utf-8',
                    beforeSend: function () 
                    {
                        $("#costou").prop('disabled', true);
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                    },
                    success: function (data) {
                    //console.log(data);
                    $("#costou").prop('disabled', false);
                    console.log(_select);
                        
                        $(data).each(function(i, v){ // indice, valor
                            console.log(v.IdCosto);
                            if(v.IdCosto == _select){
                                $("#jefeu").append('<option value="null">Sin Supervisor</option>');
                            }
                        })
                    }
                    });
            }
            });
    });
});

function showDeparment(){
    var _Dptos = $("#depto");
    var _Dptos2 = $("#deptou");
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
           _Dptos.prop('disabled', false);
           $("#depto").find('option').remove();
           $("#deptou").find('option').remove();
           _Dptos.append('<option value="">Seleccione</option>');
           _Dptos2.append('<option value="">Seleccione</option>');
            $(data).each(function(i, v){ // indice, valor
                _Dptos.append('<option value="' + v.IdDep + '">' + v.Nombre + '</option>');

                _Dptos2.append('<option value="' + v.IdDep + '">' + v.Nombre + '</option>');
            })
        }
        });
    }

    function showFactor(){
        var _Dptos = $("#factor");
        var _Dptos2 = $("#factoru");
            //var obj = JSON.stringify({ id: datos[0].IdDepartamento });
        $.ajax({
            data: {},
            url: "?c=Position&a=showFactor",
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
               _Dptos.prop('disabled', false);
               $("#factoru").find('option').remove();
               $("#factor").find('option').remove();
               _Dptos.append('<option value="">Seleccione</option>');
               _Dptos2.append('<option value="">Seleccione</option>');
                $(data).each(function(i, v){ // indice, valor
                    _Dptos.append('<option value="' + v.IdFactor + '">' + v.Factor + '</option>');

                    _Dptos2.append('<option value="' + v.IdFactor + '">' + v.Factor + '</option>');
                })
            }
            });
        }

        function sendDataAjax(){
            $.ajax({
                type: "POST",
                url: "?c=Position&a=show",
                data: {},
                dataType: 'json',
                contentType: 'application/json; charset= utf-8',
                error: function(xhr, ajaxOptions, thrownError){
                    console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                },
                success: function (data) {
                    //console.log(data);
                   // console.log(data.length);
                    var boss;
                    //addRowDT(data.d);
                    tabla = $("#tbl_Empleados").DataTable();
                    
                    for (var i = 0; i < data.length; i++) {
                        tabla.fnAddData([
                            data[i].IdCargo,
                            ( data[i].Nombre),
                            data[i].NombreCargo,
                            data[i].CargoSup,
                            '<button title= "Editar/ver" value= "Actualizar" class="btn btn-primary btn-edit " data-target="#imodal2" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
                            '<button title= "Eliminar" value= "Borrar" class="btn btn-danger btn-del " data-target="#imodal3" data-toggle="modal"><i class="fa fa-eraser" aria-hidden="true"></i></button>&nbsp;&nbsp;' 
                           // '<button title= "Vacaciones" value= "VerVacaciones" class="btn btn-primary btn-vac " data-target="#imodalver" data-toggle="modal"><i class="fa fa-plus-square" aria-hidden="true"></i></button>'
                        ]);
                    }
                }
            });
        }

        // evento click para boton actualizar
        $(document).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            
            row = $(this).parents("tr").find("td").eq(0).html();
           // console.log(row);
        });

        $(document).on('click', '.btn-del', function(e){
            e.preventDefault();
           // var $d = $(this).parent("td");     
            row = $(this).parents("tr").find("td").eq(0).html(); //$d.parent().parent().children().index($d.parent());
            console.log(row);
        });

        function showById(){
            var obj = JSON.stringify({ id: row });
        //console.log(obj);
         var dato;
        $.ajax({
            data: obj,
            url: "?c=Position&a=showToUpdate",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                dato = data;
                console.log(dato);
                $('#nameu').val(dato[0].NombreCargo);
               
                var _select = dato[0].IdDep;
                obj = JSON.stringify({ id: _select });
                $miSelect = $('#factoru');
                $miSelect.val($miSelect.children('option[value= ' + dato[0].IdFactor + ']').val());
                //console.log(obj);
                $.ajax({
                    data: obj,
                    url: "?c=Center&a=showById",
                    type: "POST",
                    dataType: 'json',
                    contentType: 'application/json; charset= utf-8',
                    beforeSend: function () 
                    {
                        $("#deptou").prop('disabled', true);
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                    },
                    success: function (data) {
                    //console.log(data);
                    $("#deptou").prop('disabled', false);
                    $("#costou").find('option').remove();
                    $("#jefeu").find('option').remove();
                        $("#costou").append('<option value="">Seleccione</option>');
                        $(data).each(function(i, v){ // indice, valor
                            $("#costou").append('<option value="' + v.IdCosto + '">' + v.Codigo + " - "+ v.Nombre + '</option>');
                        })
                        $miSelect = $('#costou');
                        $miSelect.val($miSelect.children('option[value= ' + dato[0].Idcosto + ']').val());

                    }
                    });

             _select = dato[0].Idcosto;
             obj = JSON.stringify({ id: _select });
        //console.log(obj);
        $.ajax({
            data: obj,
            url: "?c=Position&a=showById",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            beforeSend: function () 
            {
                $("#costou").prop('disabled', true);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
            //console.log(data);
            $("#costou").prop('disabled', false);
            $("#jefeu").find('option').remove();
                $("#jefeu").append('<option value="">Seleccione</option>');
                $(data).each(function(i, v){ // indice, valor
                    $("#jefeu").append('<option value="' + v.IdCargo + '">' + v.NombreCargo + '</option>');
                })

                $miSelect = $('#jefeu');
                $miSelect.val($miSelect.children('option[value= ' + dato[0].IdJefe + ']').val());

                $.ajax({
                    data: obj,
                    url: "?c=Position&a=showEspecial",
                    type: "POST",
                    dataType: 'json',
                    contentType: 'application/json; charset= utf-8',
                    beforeSend: function () 
                    {
                        $("#costou").prop('disabled', true);
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                    },
                    success: function (data) {
                    //console.log(data);
                    $("#costou").prop('disabled', false);
                    console.log(_select);
                        
                        $(data).each(function(i, v){ // indice, valor
                            console.log(v.IdCosto);
                            if(v.IdCosto == _select){
                                $("#jefeu").append('<option value="null">Sin Supervisor</option>');
                            }
                        })
                    }
                    });
            }
            });
            
            }
            });
   
        }
