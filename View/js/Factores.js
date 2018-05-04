$(document).ready(function(){
    $(document).on('click', '.btn-add', function (e) {
        e.preventDefault();
        $("#modal").modal("show");
    });
});

//Función para la carga de los valores del datatable
function sendDataAjax() {
    $.ajax({
        type: "POST",
        url: "?c=Factores&a=ListFactores",
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
            data[i].IdFactor,
            data[i].Nombre,
            data[i].Factor,
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
        url: "?c=Factores&a=ListFactoresById",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
           $("#idFactor").val(data[0].IdFactor)
           $("#des2").val(data[0].Nombre);
           $("#factor2").val(data[0].Factor);
        }
    });
    }

// evento click para boton actualizar
$(document).on('click', '.btn-edit', function (e) {
    e.preventDefault();
        var _row = $(this).parent().parent()[0];
        dato = tabla.fnGetData(_row);
        idFactor = dato[0];
        fillModalData(dato);
        //alert('Solo se pueden editar las Solicitudes que tienen un estado de Pendiente');
        $("#modalEdit").modal("show");
 
});

// evento click para eliminar los factores
$(document).on('click', '.btn-del', function (e) {
    var eliminar = confirm('¿Desea eliminar el registro?');
    if(eliminar) {
            e.preventDefault;
            var _row = $(this).parent().parent()[0];
            dato = tabla.fnGetData(_row);
            idFac = dato[0];
            var obj = JSON.stringify({ id: idFac });
               $.ajax({
                  url: "?c=Factores&a=DeleteFac",
                  type: "POST",
                  data: obj,
                  dataType: 'json',
                  contentType: 'application/json; charset= utf-8',
                  success: function(data){
                    }
                });
                  alert('Factor elimanado correctamente.'); 
    } return false;
});