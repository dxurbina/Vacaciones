var row;
$(document).ready(function(){
    $(document).on('click', '.btn-add', function (e) {
        e.preventDefault();
        
    });

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();
        
        showById();
    });

    $(document).on('click', '.btn-del', function(e){
        e.preventDefault();
       // var $d = $(this).parent("td");     
        row = $(this).parents("tr").find("td").eq(0).html(); //$d.parent().parent().children().index($d.parent());
        
    });

    showDeparment();
    sendDataAjax();

    $(document).on('click', '#btnStore', function (e) {
        e.preventDefault();
       
        if($('#name').val().length > 0 && $('#name').val().length < 20){
            if($('#codigo').val().length > 0 && $('#codigo').val().length < 20){
                if($("#depto option:selected").html() != 'Seleccione' && $("#depto option:selected").html() != null){
                    document.forms["send"].submit();       
                }else{
                    alert('Seleccione Departamento');
                }
            }else{
                alert('Valor en campo codigo no esperado');
            }
        }else{
            alert('Dato no esperado');
        }
    });

    $(document).on('click', '#btnActualizar', function (e) {
        e.preventDefault();
            if($('#nameu').val().length > 0 && $('#nameu').val().length < 20){
                if($('#codigou').val().length > 0 && $('#codigo').val().length < 20){
                    if($("#deptou option:selected").html() != 'Seleccione' && $("#deptou option:selected").html() != null){
                        var nombre = $("#nameu").val();
                        var codigo = $('#codigou').val();
                        var depto = $('#deptou').val();
                        var obj = JSON.stringify({ Id: row, Nombre: nombre, Codigo: codigo, Depto: depto });
                        flag = false;
                        $.ajax({
                            data: obj,
                            url: "?c=Center&a=update",
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
                        alert('Seleccione Departamento');
                    }
                }else{
                    alert('Valor en campo codigo no esperado');
                }
            }else{
                alert('Dato no esperado');
            }
                    

            });

            $(document).on('click', '#del', function (e) {
                e.preventDefault();
                var obj = JSON.stringify({ id: row });
                flag = false;
                $.ajax({
                    data: obj,
                    url: "?c=Center&a=destroy",
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

    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();
        
        row = $(this).parents("tr").find("td").eq(0).html();
        console.log(row);
    });

    $(document).on('click', '.btn-del', function(e){
        e.preventDefault();
       // var $d = $(this).parent("td");     
        row = $(this).parents("tr").find("td").eq(0).html(); //$d.parent().parent().children().index($d.parent());
        console.log(row);
    });

    function sendDataAjax(){
        $.ajax({
            type: "POST",
            url: "?c=Center&a=show",
            data: {},
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                //console.log(data);
               // console.log(data.length);
               
                //addRowDT(data.d);
                tabla = $("#tbl_center").DataTable();
                
                for (var i = 0; i < data.length; i++) {
                    tabla.fnAddData([
                        data[i].IdCosto,
                        ( data[i].dpto),
                        data[i].Nombre,
                        data[i].Codigo,
                        '<button title= "Editar/ver" value= "Actualizar" class="btn btn-primary btn-edit " data-target="#imodal2" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
                        '<button title= "Eliminar" value= "Borrar" class="btn btn-danger btn-del " data-target="#imodal3" data-toggle="modal"><i class="fa fa-eraser" aria-hidden="true"></i></button>&nbsp;&nbsp;' 
                       // '<button title= "Vacaciones" value= "VerVacaciones" class="btn btn-primary btn-vac " data-target="#imodalver" data-toggle="modal"><i class="fa fa-plus-square" aria-hidden="true"></i></button>'
                    ]);
                }
            }
        });
    }

    function showById(){
        var obj = JSON.stringify({ id: row });
    //console.log(obj);
     var dato;
        $.ajax({
            data: obj,
            url: "?c=Center&a=showToUpdate",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                dato = data;
                console.log(dato);
                $miSelect = $('#deptou');
                $miSelect.val($miSelect.children('option[value= ' + dato[0].IdDep + ']').val());
                $('#nameu').val(dato[0].Nombre);
                $('#codigou').val(dato[0].Codigo);
                
            }
        });
    }