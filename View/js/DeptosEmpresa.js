var row;
$(document).ready(function(){
    $(document).on('click', '.btn-add', function (e) {
        e.preventDefault();
        $("#modal").modal("show");
    });
});

//Funcionalidad que valida que no se repita los datos ya registrados
$(document).on('click', '#btnGuardar', function (e) {
    e.preventDefault();
    var _select = $("#nombre").val();
    var obj = JSON.stringify({ Nombre: _select });
    flag = false;
    $.ajax({
        data: obj,
        url: "?c=DeptosEmpresa&a=GetPosition",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            $(data).each(function(i, v){ // indice, valor
                if(v.Nombre == _select){
                    flag = true;
                }
            })
            if(flag == false){
                if(_select.length > 3 && _select.length < 20){
                    document.send.submit()   
                }else{
                    alert('Dato no esperado');
                }
            }else{
                alert("Ese Departamento empresa ya existe!!");
            }


        }
    });
});


//Función para la carga de los valores del datatable
function sendDataAjax() {
    $.ajax({
        type: "POST",
        url: "?c=DeptosEmpresa&a=ListDeptosEmpresa",
        data: {},
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            
            tabla = $("#tbl_Feriados").DataTable();
    for (var i = 0; i < data.length; i++) {
        tabla.fnAddData([
            data[i].IdDep,
            data[i].Nombre,
            //data[i].Descripcion,
           '<button title= "Editar" value= "Editar" class="btn btn-primary btn-edit "><i class="fa fa-pencil" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
           '<button title= "Eliminar" value= "Cancelar" class="btn btn-danger btn-del " data-target="#imodalel" data-toggle="modal"><i class="fa fa-eraser" aria-hidden="true"></i></button>&nbsp;&nbsp;'
        ]);
    }
        }
    });
 }
sendDataAjax();

//Función para cargar la modal con los campos que tiene en la base de datos.
function fillModalData(dato){
    var obj = JSON.stringify({ id: dato[0] });
    $.ajax({
        data: obj,
        url: "?c=DeptosEmpresa&a=ListDeptosEmpresaById",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
           $("#idDepEmpresa").val(data[0].IdDep)
           $("#nombre2").val(data[0].Nombre);
           $("#des2").val(data[0].Descripcion);
        }
    });
    }

// evento click para boton actualizar Este funciona 2:22 pm 04-05-2018
$(document).on('click', '.btn-edit', function (e) {
    e.preventDefault();
        var _row = $(this).parent().parent()[0];
        dato = tabla.fnGetData(_row);
        idDepEmpresa = dato[0];
        fillModalData(dato);
        //alert('Solo se pueden editar las Solicitudes que tienen un estado de Pendiente');
        $("#modalEdit").modal("show");
 
});

$(document).on('click', '#btnActualizar', function (e) {
    e.preventDefault();
    var _select = $("#nombre2").val();
    var obj = JSON.stringify({ Nombre: _select });
    flag = false;
    $.ajax({    
        data: obj,
        url: "?c=DeptosEmpresa&a=GetPosition",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            $(data).each(function(i, v){ // indice, valor
                if(v.Nombre == _select && v.IdDep != row ){
                    flag = true;
                }
            })
            if(flag == false){
                if(_select.length > 4 && _select.length < 20){
                            var nombre = $('#nombre2').val();
                            var descripcion = $('#des2').val();
                            var IdDep = $('#idDepEmpresa').val();
                            var obj = JSON.stringify({ Id: row, Nombre: nombre, Descripcion: descripcion, IdDep: IdDep});
                            flag = false;
                            $.ajax({
                                data: obj,
                                url: "?c=DeptosEmpresa&a=EditDeptoEmp",
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
                alert("Nombre del departamento empresa ya existe!!");
            }


        }
    });
});

// evento click para eliminar los deptoEmpresa
$(document).on('click', '.btn-del', function (e) {
    var eliminar = confirm('¿Desea eliminar el registro?');
    if(eliminar) {
            e.preventDefault;
            var _row = $(this).parent().parent()[0];
            dato = tabla.fnGetData(_row);
            idFac = dato[0];
            var obj = JSON.stringify({ id: idFac });
               $.ajax({
                  url: "?c=DeptosEmpresa&a=DeleteDeptosEmpresa",
                  type: "POST",
                  data: obj,
                  dataType: 'json',
                  contentType: 'application/json; charset= utf-8',
                  success: function(data){
                    location.reload();
                    }
                });
                  alert('Departamento empresa elimanado correctamente.'); 
    } return false;
});