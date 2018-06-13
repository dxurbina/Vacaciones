var newDay, newNes, newAnio, bDisable;
$(document).ready(function(){
    $('#Add').click(function(){
        if( $('#Add').prop('checked') ) {
            $('#ExtraDay').show();
            $('#NumDayExtra').show();
            $('#ExtraDate').show();
            $('#ExtraDateIni').show();
            $('#NumDayExtra').show();
            $('#ExtraEnd').show();
            $('#ExtraDateEnd').show();
        }else {
            hideExtra();
        }
    });

    //Agregado a las 2:51 pm 08-05-2018
/*var arrDisabledDates = {};
arrDisabledDates[new Date('05/01/2018')] = new Date('05/01/2018');
arrDisabledDates[new Date('04/19/2018')] = new Date('04/19/2018');
arrDisabledDates[new Date('07/19/2018')] = new Date('07/19/2018');
*/
    $('#pointer').datepicker(
        {  
            /*beforeShowDay: function (dt) {
                var bDisable = arrDisabledDates[dt];
                console.log(bDisable);
                if (bDisable)
                    return [false, '', ''];
                else
                   return [true, '', ''];
            }*/ 
           minDate: -7,
           beforeShow: function() {
            //onSelect: ListaFeriados(),
           $(this).datepicker('option', 'maxDate', $('#dataF').val());
           
           }

           //beforeShowDay: $.datepicker.noWeekends -> DESACTIVA LOS FINDES DE SEMANA
        });

        $('#dataF').datepicker(
                    {                    
                    defaultDate: "+1w",
                    beforeShow: function() {
                    $(this).datepicker('option', 'minDate', $('#pointer').val());
        if ($('#pointer').val() === '') $(this).datepicker('option', 'minDate', 0);                             
                    }
                });

    $('#pointer').change(function(){
        //var fecha = $('#pointer').val();
        var sumar = $('#NumDay').val();

        if ((sumar == 0) && (sumar == "")){
            alert("Primero debe seleccionar  los días a tomar.");
        }else{
            if((sumar > 0)){
                var fecha = $('#pointer').val();
                var fecha2 = new Date(fecha);
                var fecha = new Date(fecha);
                console.log(fecha);
                dia = fecha.getDate();
                mes = fecha.getMonth() + 1;
                anio = fecha.getFullYear();

                if(sumar % 1 == 0){
                    addTime = (sumar * 24) - 24; //Tiempo en horas
                }else{
                    addTime = (sumar * 24); //Tiempo en horas
                }

                fecha.setHours(addTime); //Añado el tiempo
 
    str1 = "Fecha actual: " + dia + "/" + mes + "/" + anio + "<br />";
    str2 = "Tiempo añadido: " + sumar + " días<br />";
    str3 = "Fecha final: " + fecha.getDate() + "/" + (fecha.getMonth() + 1) + "/" + fecha.getFullYear();
       console.log(str1 + ' ' + str2 +' ' + str3 +' ');
       
       oldMes = (fecha2.getMonth() + 1);
       oldDay = (fecha2.getDate());
       oldAnio = (fecha2.getFullYear());

       newMes = (fecha.getMonth() + 1);
       newDay = (fecha.getDate());
       newAnio = (fecha.getFullYear());
       
     //  var options = { year: 'numeric', month: 'numeric', day: 'numeric' };
     //console.log(newMes.toString().length);
        if(newMes.toString().length > 1 && newDay.toString().length > 1){
            $('#dateF').val(newDay + "/" + newMes + "/" + newAnio);
        }else if(newMes.toString().length == 1 && newDay.toString().length == 1){
            $('#dateF').val("0" + newDay + "/" + "0" +newMes + "/" + newAnio);
        }else if(newDay.toString().length == 1){
            $('#dateF').val("0" + newDay + "/"  +newMes + "/" + newAnio);
        }else if (newMes.toString().length == 1){  
            $('#dateF').val(newDay + "/" + "0" +newMes + "/" + newAnio);
        }

        if(oldMes.toString().length > 1 && oldDay.toString().length > 1){
            $('#pointer').val(oldDay + "/" + oldMes + "/" + oldAnio);
        }else if(oldMes.toString().length == 1 && oldDay.toString().length == 1){
            $('#poiner').val("0" + oldDay + "/" + "0" + oldMes + "/" + oldAnio);
        }else if(oldDay.toString().length == 1){
            $('#pointer').val("0" + oldDay + "/"  + oldMes + "/" + oldAnio);
        }else if (oldMes.toString().length == 1){  
            $('#pointer').val(oldDay + "/" + "0" + oldMes + "/" + oldAnio);
        }
            
            console.log(fecha2);
           // $("#dateF").datepicker("setDate", fecha2);
         //  $('#pointer').val(fecha2.toLocaleDateString("es-ES", options));
            //$("#pointer").datepicker("setDate", fecha);
            console.log($('input:radio[name=Tipo]:checked').val());
            if($('input:radio[name=Tipo]:checked').val() == 'Vacaciones'){
                var factor =  $("label[for='factor']").text();
                var saldo = parseFloat(factor) * sumar;
                var resul = saldo.toFixed(2); 
                $("label[for='Saldo']").text(resul);
                console.log(resul);
                //Cálculo del saldo-saldoAct.
                var saldoactual = $("label[for='saldo']").text();
                var sal = parseFloat(saldoactual) - resul;
                var resultado = sal.toFixed(2);
                $("label[for='SaldoT']").text(resultado);
            }
            
            //$('#ExtraDateEnd').val(fecha.toLocaleDateString("es-ES", options));
            //$('#ExtraDateIni').val(fecha.toLocaleDateString("es-ES", options));
            $('#ExtraDateIni').datepicker(
                { 
                   minDate: new Date(newAnio, newMes, newDay),
                   beforeShow: function() {
                   $(this).datepicker('option', 'maxDate', $('#dataF').val());
                 }
                        });

            }else{
                alert("La cantidad de días debe ser mayor a 0");
            }
        }
               
    });

    $('#pointer2').datepicker(
        { 
           minDate: -7,
           beforeShow: function() {
           $(this).datepicker('option', 'maxDate', $('#dataF2').val());
         }
                });

        $('#dataF2').datepicker(
                    {
                    defaultDate: "+1w",
                    beforeShow: function() {
                    $(this).datepicker('option', 'minDate', $('#pointer2').val());
        if ($('#pointer2').val() === '') $(this).datepicker('option', 'minDate', 0);                             
                    }
                });

    $('#pointer2').change(function(){
        var fecha = $('#pointer2').val();
        var sumar = $('#NumDay2').val();

        var fecha2 = new Date(fecha);
        var fecha = new Date(fecha);
        console.log(fecha);
        dia = fecha.getDate();
        mes = fecha.getMonth() + 1;
        anio = fecha.getFullYear();
        if ((sumar == 0) && (sumar == "")){
            alert("Primero debe seleccionar  los días a tomar.");
        }else{
            if((sumar > 0)){
                if(sumar % 1 == 0){
                    addTime = (sumar * 24) - 24; //Tiempo en horas
                }else{
                    addTime = (sumar * 24); //Tiempo en horas
                }
            }else{
                alert("La cantidad de días debe ser mayor a 0");
            }
            
        }
        
    fecha.setHours(addTime); //Añado el tiempo
 
    str1 = "Fecha actual: " + dia + "/" + mes + "/" + anio + "<br />";
    str2 = "Tiempo añadido: " + sumar + " días<br />";
    str3 = "Fecha final: " + fecha.getDate() + "/" + (fecha.getMonth() + 1) + "/" + fecha.getFullYear();
       console.log(str1 + ' ' + str2 +' ' + str3 +' ');
       
       oldMes = (fecha2.getMonth() + 1);
       oldDay = (fecha2.getDate());
       oldAnio = (fecha2.getFullYear());

       newMes = (fecha.getMonth() + 1);
       newDay = (fecha.getDate());
       newAnio = (fecha.getFullYear());
       
     //  var options = { year: 'numeric', month: 'numeric', day: 'numeric' };
     //console.log(newMes.toString().length);
        if(newMes.toString().length > 1 && newDay.toString().length > 1){
            $('#dateF2').val(newDay + "/" + newMes + "/" + newAnio);
        }else if(newMes.toString().length == 1 && newDay.toString().length == 1){
            $('#dateF2').val("0" + newDay + "/" + "0" +newMes + "/" + newAnio);
        }else if(newDay.toString().length == 1){
            $('#dateF2').val("0" + newDay + "/"  +newMes + "/" + newAnio);
        }else if (newMes.toString().length == 1){  
            $('#dateF2').val(newDay + "/" + "0" +newMes + "/" + newAnio);
        }

        if(oldMes.toString().length > 1 && oldDay.toString().length > 1){
            $('#pointer2').val(oldDay + "/" + oldMes + "/" + oldAnio);
        }else if(oldMes.toString().length == 1 && oldDay.toString().length == 1){
            $('#pointer2').val("0" + oldDay + "/" + "0" + oldMes + "/" + oldAnio);
        }else if(oldDay.toString().length == 1){
            $('#pointer2').val("0" + oldDay + "/"  + oldMes + "/" + oldAnio);
        }else if (oldMes.toString().length == 1){  
            $('#pointer2').val(oldDay + "/" + "0" + oldMes + "/" + oldAnio);
        }

            //$('#dateF2').val(fecha.toLocaleDateString("es-ES", options));
            console.log(fecha2);
            //$('#pointer2').val(fecha2.toLocaleDateString("es-ES", options));
            console.log($('input:radio[name=Tipo]:checked').val());
            if($('input:radio[name=Tipo]:checked').val() == 'Vacaciones'){
                var factor =  $("label[for='factor2']").text();
                var saldo = parseFloat(factor) * sumar;
                var result = saldo.toFixed(2); 
                $("label[for='Saldo']").text(result);
                //Cálculo del saldo-saldoAct.
                var saldoactual = $("label[for='saldo']").text();
                var sal = parseFloat(saldoactual) - result;
                var resultado = sal.toFixed(2);
                $("label[for='SaldoTotal']").text(resultado);
            }
            
            //$('#ExtraDateEnd').val(fecha.toLocaleDateString("es-ES", options));
            //$('#ExtraDateIni').val(fecha.toLocaleDateString("es-ES", options));
            $('#ExtraDateIni').datepicker(
                { 
                   minDate: new Date(newAnio, newMes, newDay),
                   beforeShow: function() {
                   $(this).datepicker('option', 'maxDate', $('#dataF2').val());
                   }
                });
        
    });

    $('#ExtraDateIni').change(function(){
            var fecha = $('#ExtraDateIni').val();
            var sumar = $('#NumDayExtra').val();
            var fecha = new Date(fecha);
            addTime = (sumar * 24) - 24; //Tiempo en Horas
    
        fecha.setHours(addTime); //Añado el tiempo
        
        var options = { year: 'numeric', month: 'long', day: 'numeric' };

                $('#ExtraDateEnd').val(fecha.toLocaleDateString("es-ES", options));
    });
    
});

function sumarDias(fecha, dias){
    fecha.setDate(fecha.getDate() + dias);
    return fecha;
  }

  function radioSeleccionado(){
    elem=document.getElementsByName('Tipo'); 
    for(i=0;i<elem.length;i++) 
        if (elem[i].checked) { 
            valor = elem[i].value; 
        } return valor;
  }

 $(document).on('click','#enter', function(e){
    radioSeleccionado();
    var cantDias = document.getElementById('NumDay').value;
    var FechaI = document.getElementById('pointer').value;
    if((cantDias!=null && cantDias!= "") && valor!=null && (FechaI!=null && FechaI!= ""))
    {
        /*$.ajax({
            url: "?c=Vacaciones&a=store",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            success: function(data){
                //console.log('Todo ha funcionado');
                //location.reload(true); 
            }
            });*/
       
             $("#imodalsolacep").modal("show");
            //alert('solicitud enviada correctamente.');
    } else {
        //alert("Debe completar los campos");
        return $("#imodalsolinfo").modal("show");
    }
  });

 /* $(document).on('click', '.btn-accept', function(e){
    e.preventDefault();
    var $d = $(this).parent("td");     
    row = $d.parent().parent().children().index($d.parent()); 
});

  $(document).on('click','#enter', function(e){
    e.preventDefault();
    radioSeleccionado();
    var cantDias = document.getElementById('NumDay').value;
    var FechaI = document.getElementById('pointer').value;
    if((cantDias!=null && cantDias!= "") && valor!=null && (FechaI!=null && FechaI!= ""))
    {
        if($(this).val() == "Aceptar"){
            _state = "Aceptada";
        }else if($(this).val() == "Cancelar"){
            //_state = "Rechazada";
        }
        $.ajax({
            url: "?c=Vacaciones&a=store",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            success: function(data){
            }
            });
   } else {
        alert("Para poder enviar la solicitud de vacaciones debe completar los campos solicitados.");
    }
  });*/

    restaFechas = function(f1,f2)
    {
    var aFecha1 = f1.split('/');
    var aFecha2 = f2.split('/');
    var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
    var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
    return dias;
    }

  
function hideExtra(){
    $('#ExtraDay').hide();
    $('#NumDayExtra').hide();
    $('#ExtraDate').hide();
    $('#ExtraDateIni').hide();
    $('#NumDayExtra').hide();
    $('#ExtraEnd').hide();
    $('#ExtraDateEnd').hide();
}

hideExtra();


//Ingresado el 08-05-18 11:58 am

function ListaFeriados(){
    $.ajax({
        data: {},
        
        url: "?c=Feriados&a=ListFeriados",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
        }
    });
}
//ListaFeriados();
