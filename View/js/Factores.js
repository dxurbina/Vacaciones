var row, idFactor;
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

//Funcionalidad que valida que no se repita los datos ya registrados
$(document).on('click', '#btnGuardar', function (e) {
    e.preventDefault();
    var _select = $("#factor").val();
    var obj = JSON.stringify({ Factor: _select });
    flag = false;
    $.ajax({
        data: obj,
        url: "?c=Factores&a=GetPosition",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            $(data).each(function(i, v){ // indice, valor
                if(v.Factor == _select){
                    flag = true;
                }
            })
            if(flag == false){
                if((_select.length >= 3) && (_select.length <= 4) && (_select != null)){
                    //document.send.submit()   
                    //document.getElementById('#formFac').submit();
                    document.forms["send"].submit();
                }else{
                    alert('Dato no esperado');
                }
            }else{
                alert("Ese factor ya existe!!");
            }


        }
    });
});

// evento click para boton actualizar Funciona 1:20 pm 04-05-2018
$(document).on('click', '.btn-edit', function (e) {
    e.preventDefault();
        var _row = $(this).parent().parent()[0];
        dato = tabla.fnGetData(_row);
        idFactor = dato[0];
        fillModalData(dato);
        //alert('Solo se pueden editar las Solicitudes que tienen un estado de Pendiente');
        $("#modalEdit").modal("show");
 
});

$(document).on('click', '#btnActualizar', function (e) {
    e.preventDefault();
    var _select = $("#factor2").val();
    var obj = JSON.stringify({ Factor: _select });
    flag = false;
    $.ajax({
        data: obj,
        url: "?c=Factores&a=GetPosition",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            $(data).each(function(i, v){ // indice, valor
                
                if(v.Factor == _select && v.IdFactor != idFactor ){
                    flag = true;
                }
            })
            if(flag == false){
                var nombre = $("#des2").val();
                var factor = $('#factor2').val();
                var idfac = $("#idFactor").val();
                console.log(idfac);
                var obj = JSON.stringify({ Nombre: nombre, Factor: factor, IdFactor: idfac });
                flag = false;
                    $.ajax({
                        data: obj,
                        url: "?c=Factores&a=EditFactor",
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
                alert("Este factor ya Existe!!");
            }
        }
    });
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

/*
function solo_JQdecimal(id) {
    //PARA LLAMARLO EN EL OBJETO ---> onkeypress="solo_JQdecimal(this.id)"
$('#factor2'+id).on('keypress', function (e) {
    // Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
    var field = $(this);
    key = e.keyCode ? e.keyCode : e.which;

    if (key == 8) return true;
    if (key > 47 && key < 58) {
      if (field.val() === "") return true;
      var existePto = (/[.]/).test(field.val());
      if (existePto === false){
          regexp = /.[0-9]{3}$/; //PARTE ENTERA 10
      }
      else {
        regexp = /.[0-9]{3}$/; //PARTE DECIMAL2
      }
      return !(regexp.test(field.val()));
    }
    if (key == 46) {
      if (field.val() === "") return false;
      regexp = /^[0-9]+$/;
      return regexp.test(field.val());
    }
    return false;
});
}*/