var dato, tabla, idEmp;

function fillModalData(dato){
     var obj = JSON.stringify({ id: dato[0] });
     console.log(obj);
     $.ajax({
         data: obj,
         url: "?c=SaldoVacaciones&a=SaldoVacacionesbyId",
         type: "POST",
         
         
         dataType: 'json',
         contentType: 'application/json; charset= utf-8',
         error: function(xhr, ajaxOptions, thrownError){
             console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
         },
         success: function (data) {
             console.log(data);
             
            $("#PNombre").val(data[0].PNombre );   
            $("#Cedula").val(data[0].Cedula);
            $("#CargarEmpleado").val(data[0].IdEmpleado);
            /*loadMunicipality(data);
            loadDptosEmpresa(data);
            loadCargos(data);
            loadJefe(data);*/
           
         }
     });
     
 }
 fillModalData(dato);