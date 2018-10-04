var dato, tabla;

$(document).ready(function(){

    

    $(document).on('click', '#btnStore', function (e) {
        e.preventDefault();
        var _select = $("#pass").val();
        var cant = $("#NumDay").val();
        var obj = JSON.stringify({ pass: _select });
        flag = false;
        $.ajax({
            data: obj,
            url: "?c=Load&a=verify",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                console.log(data.d);
                if(typeof data.IdEmpleado == "undefined"){
                    flag=true;
                }
                if(flag == false){
                    if(cant > 0 && cant < 30){
                        console.log(flag);
                       
                                document.forms["send"].submit();
                           
                    }else{
                        alert('Error en la cantidad de Dias');
                    }
                }else{
                    alert("Verifique contraseña. Dato no esperado!!");
                }
            }
                
            });

    });

    $(document).on('click', '#btn_update', function (e) {
        e.preventDefault();
        var _select = $("#pass_1").val();
        var cant = $("#NumDay_1").val();
        var obj = JSON.stringify({ pass: _select });
        flag = false;
        $.ajax({
            data: obj,
            url: "?c=Load&a=verify",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                console.log(data.d);
                if(typeof data.IdEmpleado == "undefined"){
                    flag=true;
                }
                if(flag == false){
                    if(cant > 0 && cant < 30){
                        console.log(flag);
                       
                                document.forms["send_1"].submit();
                           
                    }else{
                        alert('Error en la cantidad de Dias');
                    }
                }else{
                    alert("Verifique contraseña. Dato no esperado!!");
                }
            }
                
            });

    });


    /*Poner los colores según la condición en el datatable*/
  /*   $ ( '#tbl_saldo_vacaciones' ).dataTable ({ 
       "fnRowCallback" :   function(nRow , aData, iDisplayIndex, iDisplayIndexFull){ 
          if(aData[3]>=15){ 
            $('td', nRow ).css('background-color', '#eeb2b2'); 
          }else{ 
            $('td', nRow ).css('background-color', '#e6f2f8'); 
          } 
        } 
      }); */
});

$(document).on('click', '#btn_update_csv', function (e) {
    e.preventDefault();
    var _select = $("#pass_3").val();
    var obj = JSON.stringify({ pass: _select });
    flag = false;
    $.ajax({
        data: obj,
        url: "?c=Load&a=verify",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data.d);
            if(typeof data.IdEmpleado == "undefined"){
                flag=true;
            }
            if(flag == false){
                            document.forms["_send"].submit();    
            }else{
                alert("Verifique contraseña. Dato no esperado!!");
            }
        }
            
        });

});


function sendDataAjax() {
    $.ajax({
        type: "POST",
        url: "?c=SaldoColaboradores&a=SaldoColaboradores",
        data: {},
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            tabla = $("#tbl_saldo_vacaciones").DataTable({
                "fnRowCallback" :   function(nRow , aData, iDisplayIndex, iDisplayIndexFull){ 
                    if(aData[3]>=15){ 
                      $('td', nRow ).css('background-color', '#eeb2b2'); 
                    }else{ 
                      $('td', nRow ).css('background-color', '#e6f2f8'); 
                    } 
                  }
                }
            );
            for (var i = 0; i < data.length; i++) {
                tabla.fnAddData([
                    data[i].IdEmpleado,
                    ( data[i].PNombre + " "+ data[i].PApellido),
                    //( data[i].PApellido + " "+ data[i].SApellido),
                    data[i].NombreCargo,
                    data[i].Saldo,
                    data[i].Factor,
                    '<button title= "Sugerir vacaciones" value= "Sugerir" class="btn btn-primary btn-edit "><i class="fa fa-calendar" aria-hidden="true"></i></button>&nbsp;&nbsp;'
                    /* '<button title= "Editar Usuario" value= "EditUser" class="btn btn-primary btn-usr " data-target="#imodalusr" data-toggle="modal"><i class="fa fa-user-o" aria-hidden="true"></i></button>&nbsp;&nbsp;' +
                    '<button title= "Eliminar" value= "Borrar" class="btn btn-danger btn-del "><i class="fa fa-eraser" aria-hidden="true"></i></button>'
                   */
                ]);
            }
        }
    });
}
sendDataAjax();

// evento click para boton actualizar
$(document).on('click', '.btn-edit', function (e) {
    e.preventDefault();
    $("#modalSolSugerir").modal("show");
    var _row = $(this).parent().parent()[0];
    dato = tabla.fnGetData(_row);
    idEmpleado = dato[0];
    fillModalData(dato);
    console.log(_row);
 
});

function fillModalData(dato){
    var obj = JSON.stringify({ id: dato[0] });
    console.log(obj);
    $.ajax({
        data: obj,
        url: "?c=SaldoColaboradores&a=listFacByEmp",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            //console.log(data.IdEmpleado);
            $("#idEmp").val(data.IdEmpleado);
            $("#factor3").val(data.Factor);
            $("#SaldoAct").val(data.Saldo);
        }
    });

}