var newDay, newNes, newAnio, bDisable;
function addAlert(ClassAlerta, texto){
    $('.alert').remove();
    $(ClassAlerta).append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul><li style="list-style:none;"> ' + texto +'</li></ul></div>');
}

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
            dateFormat: 'dd/mm/yy',
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

                
                

function stringToDate(_date,_format,_delimiter)
{
            var formatLowerCase=_format.toLowerCase();
            var formatItems=formatLowerCase.split(_delimiter);
            var dateItems=_date.split(_delimiter);
            var monthIndex=formatItems.indexOf("mm");
            var dayIndex=formatItems.indexOf("dd");
            var yearIndex=formatItems.indexOf("yyyy");
            var month=parseInt(dateItems[monthIndex]);
            month-=1;
            var formatedDate = new Date(dateItems[yearIndex],month,dateItems[dayIndex]);
            return formatedDate;
}
/*
stringToDate("17/9/2014","dd/MM/yyyy","/");
stringToDate("9/17/2014","mm/dd/yyyy","/")
stringToDate("9-17-2014","mm-dd-yyyy","-")*/

    $('#pointer').change(function(){
        //var fecha = $('#pointer').val();
        var sumar = $('#NumDay').val();

        if ((sumar == 0) && (sumar == "")){
            $('#pointer').val('');
            $('.alert').remove();
            $('.modal-alert').append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul><li style="list-style:none;">Primero debe seleccionar  los días a tomar.</li></ul></div>');
         }else{
            if((sumar > 0)){
               // $porciones = $('#pointer').val().split('/');
               // console.log($porciones);
                var fecha = stringToDate($('#pointer').val(),"dd/MM/yyyy","/");
                var fecha2 = stringToDate($('#pointer').val(),"dd/MM/yyyy","/");
                //$fecha = stringToDate("05/07/2018","dd/MM/yyyy","/");
                //console.log(fecha);
               /// var fecha2 = new Date($porciones[2], $porciones[1], $porciones[0]);
               // var fecha = new Date();
                //console.log(fecha);
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
/*
        if(oldMes.toString().length > 1 && oldDay.toString().length > 1){
            $('#pointer').val(oldDay + "/" + oldMes + "/" + oldAnio);
        }else if(oldMes.toString().length == 1 && oldDay.toString().length == 1){
            $('#poiner').val("0" + oldDay + "/" + "0" + oldMes + "/" + oldAnio);
        }else if(oldDay.toString().length == 1){
            $('#pointer').val("0" + oldDay + "/"  + oldMes + "/" + oldAnio);
        }else if (oldMes.toString().length == 1){  
            $('#pointer').val(oldDay + "/" + "0" + oldMes + "/" + oldAnio);
        }*/
            
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

            //Nueva funcionalidad de donar vacaciones.
            if($('input:radio[name=Tipo]:checked').val() == 'Donar'){
              //  var donar = 1;
                $("label[for='Saldo']").text(sumar);
                //console.log(donar);
                //Cálculo del saldo-saldoAct.
                var saldoact = $("label[for='saldo']").text();
                var sal = parseFloat(saldoact) - sumar;
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
                //alert("La cantidad de días debe ser mayor a 0");
                $('#pointer').val('');
               $('.alert').remove();
               $('.modal-alert').append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul><li style="list-style:none;">La cantidad de días debe ser mayor a 0</li></ul></div>');
        
            }
        }
               
    });

    $('#pointer2').datepicker(
        { 
           minDate: -7,
           dateFormat: 'dd/mm/yy',
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

        var fecha = stringToDate($('#pointer2').val(),"dd/MM/yyyy","/");
        var fecha2 = stringToDate($('#pointer2').val(),"dd/MM/yyyy","/");
        console.log(fecha);
        dia = fecha.getDate();
        mes = fecha.getMonth() + 1;
        anio = fecha.getFullYear();
        if ((sumar == 0) && (sumar == "")){
            //alert("Primero debe seleccionar  los días a tomar.");
            $('#pointer2').val('');
            $('.alert').remove();
            $('.modal-alert2').append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul><li style="list-style:none;">Primero debe seleccionar  los días a tomar.</li></ul></div>');
        
        }else{
            if((sumar > 0)){
                if(sumar % 1 == 0){
                    addTime = (sumar * 24) - 24; //Tiempo en horas
                }else{
                    addTime = (sumar * 24); //Tiempo en horas
                }
            }else{
                $('#pointer2').val('');
                $('.alert').remove();
                $('.modal-alert2').append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul><li style="list-style:none;">Primero debe seleccionar  los días a tomar.</li></ul></div>');
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
/*
        if(oldMes.toString().length > 1 && oldDay.toString().length > 1){
            $('#pointer2').val(oldDay + "/" + oldMes + "/" + oldAnio);
        }else if(oldMes.toString().length == 1 && oldDay.toString().length == 1){
            $('#pointer2').val("0" + oldDay + "/" + "0" + oldMes + "/" + oldAnio);
        }else if(oldDay.toString().length == 1){
            $('#pointer2').val("0" + oldDay + "/"  + oldMes + "/" + oldAnio);
        }else if (oldMes.toString().length == 1){  
            $('#pointer2').val(oldDay + "/" + "0" + oldMes + "/" + oldAnio);
        }*/

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
            
             //Nueva funcionalidad de donar vacaciones.
             if($('input:radio[name=Tipo]:checked').val() == 'Donar'){
                //  var donar = 1;
                  $("label[for='Saldo']").text(sumar);
                  //console.log(donar);
                  //Cálculo del saldo-saldoAct.
                  var saldoact = $("label[for='saldo']").text();
                  var sal = parseFloat(saldoact) - sumar;
                  var resultado = sal.toFixed(2);
                  $("label[for='SaldoT']").text(resultado);
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


    //Modal de sugerir vacaciones desde la vista de saldo de colaboradores.
    $('#pointer3').datepicker(
        { 
           minDate: -7,
           dateFormat: 'dd/mm/yy',
           beforeShow: function() {
           $(this).datepicker('option', 'maxDate', $('#dataF3').val());
         }
                });

        $('#dataF3').datepicker(
                    {
                    defaultDate: "+1w",
                    beforeShow: function() {
                    $(this).datepicker('option', 'minDate', $('#pointer3').val());
        if ($('#pointer3').val() === '') $(this).datepicker('option', 'minDate', 0);                             
                    }
                });

    $('#pointer3').change(function(){
        var fecha = $('#pointer3').val();
        var sumar = $('#NumDay3').val();

        var fecha2 = new Date(fecha);
        var fecha = new Date(fecha);

        var fecha = stringToDate($('#pointer3').val(),"dd/MM/yyyy","/");
        var fecha2 = stringToDate($('#pointer3').val(),"dd/MM/yyyy","/");
        console.log(fecha);
        dia = fecha.getDate();
        mes = fecha.getMonth() + 1;
        anio = fecha.getFullYear();
        if ((sumar == 0) && (sumar == "")){
            //alert("Primero debe seleccionar  los días a tomar.");
            $('#pointer3').val('');
            addAlert('.modal-alert2','Primero debe seleccionar  los días a tomar.');
        }else{
            if((sumar > 0)){
                if(sumar % 1 == 0){
                    addTime = (sumar * 24) - 24; //Tiempo en horas
                }else{
                    addTime = (sumar * 24); //Tiempo en horas
                }
            }else{
               // alert("La cantidad de días debe ser mayor a 0");
               $('#pointer3').val('');
               addAlert('.modal-alert2','La cantidad de días debe ser mayor a 0.');
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
            $('#dateF3').val(newDay + "/" + newMes + "/" + newAnio);
        }else if(newMes.toString().length == 1 && newDay.toString().length == 1){
            $('#dateF3').val("0" + newDay + "/" + "0" +newMes + "/" + newAnio);
        }else if(newDay.toString().length == 1){
            $('#dateF3').val("0" + newDay + "/"  +newMes + "/" + newAnio);
        }else if (newMes.toString().length == 1){  
            $('#dateF3').val(newDay + "/" + "0" +newMes + "/" + newAnio);
        }
/*
        if(oldMes.toString().length > 1 && oldDay.toString().length > 1){
            $('#pointer2').val(oldDay + "/" + oldMes + "/" + oldAnio);
        }else if(oldMes.toString().length == 1 && oldDay.toString().length == 1){
            $('#pointer2').val("0" + oldDay + "/" + "0" + oldMes + "/" + oldAnio);
        }else if(oldDay.toString().length == 1){
            $('#pointer2').val("0" + oldDay + "/"  + oldMes + "/" + oldAnio);
        }else if (oldMes.toString().length == 1){  
            $('#pointer2').val(oldDay + "/" + "0" + oldMes + "/" + oldAnio);
        }*/

            //$('#dateF2').val(fecha.toLocaleDateString("es-ES", options));
            console.log(fecha2);
            //$('#pointer2').val(fecha2.toLocaleDateString("es-ES", options));
            console.log($('input:radio[name=Tipo]:checked').val());
            if($('input:radio[name=Tipo]:checked').val() == 'Vacaciones'){
                //var factor =  $("label[for='factor3']").text();
                var factor =  $("input[id='factor3']").val();
                var saldo = parseFloat(factor) * sumar;
                var result = saldo.toFixed(2); 
                $("label[for='Saldo']").text(result);
                //Cálculo del saldo-saldoAct.
                var saldoactual = $("input[id='SaldoAct']").val();
                var sal = parseFloat(saldoactual) - result;
                var resultado = sal.toFixed(2);
                $("label[for='SaldoT']").text(resultado);
            }
            /**/
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
     e.preventDefault();
    radioSeleccionado();
    var cantDias = document.getElementById('NumDay').value;
    var FechaI = document.getElementById('pointer').value;
    var FechaF = document.getElementById('dateF').value;
    var txtarea = document.getElementById('comentarios').value;

    var FechaIA = FechaI.split('/');
    var FechaFA = FechaF.split('/');
    var date_1 = new Date(FechaIA[2] + '-' + FechaIA[1] + '-' + FechaIA[0]).getTime();
    var date_2 = new Date(FechaFA[2] + '-' + FechaFA[1] + '-' + FechaFA[0]).getTime();
    var diff = date_2 - date_1;
    NumDay = diff/(1000*60*60*24) + 1;

    if(cantDias==null || cantDias== ""){
        addAlert('.modal-alert','Debe ingresar los días de vacaciones');
    }else if(cantDias <= 0 && cantDias > 30){
        addAlert('.modal-alert', 'Numero de dias fuera de rango');
    }else if(NumDay > cantDias && (NumDay - cantDias) >=0 && (cantDias - NumDay) <= 1 ){
        addAlert('.modal-alert', 'Se esperaba igualdad entre el numero de Días Digitado y el rango de fechas seleccionado');
    }else if(NumDay < cantDias && (NumDay - cantDias) <=0 && (cantDias - NumDay) >= 1 ){
        addAlert('.modal-alert', 'Se esperaba igualdad entre el numero de Días Digitado y el rango de fechas seleccionado');
    }else if(valor==null){
        addAlert('.modal-alert', 'Debe seleccionar el tipo de vacaciones');
    } else if(FechaI==null || FechaI== ""){
        addAlert('.modal-alert', 'Debe seleccionar la fecha de inicio de vacaciones');
    }else if(txtarea.length > 100){
        addAlert('.modal-alert', 'El comentario debe ser menor a 100 caracteres.!!!');
    }
    else {
            document.forms["sendNew"].submit();
        }
  });

  $(document).on('click','#editSol', function(e){
    e.preventDefault();
    radioSeleccionado();
    console.log('working ...');
    var cantDias = document.getElementById('NumDay2').value;
    var FechaI = document.getElementById('pointer2').value;
    var FechaF = document.getElementById('dateF2').value;
    var txtarea = document.getElementById('comentarios2').value;
    
    var FechaIA = FechaI.split('/');
    var FechaFA = FechaF.split('/');
    var date_1 = new Date(FechaIA[2] + '-' + FechaIA[1] + '-' + FechaIA[0]).getTime();
    var date_2 = new Date(FechaFA[2] + '-' + FechaFA[1] + '-' + FechaFA[0]).getTime();
    var diff = date_2 - date_1;
    NumDay = diff/(1000*60*60*24) + 1;

    if(cantDias==null || cantDias== ""){
        addAlert('.modal-alert','Debe ingresar los días de vacaciones');
    }else if(cantDias <= 0 && cantDias > 30){
        addAlert('.modal-alert2', 'Numero de dias fuera de rango');
    }else if(NumDay > cantDias && (NumDay - cantDias) >=0 && (cantDias - NumDay) <= 1 ){
        addAlert('.modal-alert2', 'Se esperaba igualdad entre el numero de Días Digitado y el rango de fechas seleccionado');
    }else if(NumDay < cantDias && (NumDay - cantDias) <=0 && (cantDias - NumDay) >= 1 ){
        addAlert('.modal-alert2', 'Se esperaba igualdad entre el numero de Días Digitado y el rango de fechas seleccionado');
    }else if(valor==null){
        addAlert('.modal-alert2', 'Debe seleccionar el tipo de vacaciones');
    } else if(FechaI==null || FechaI== ""){
        addAlert('.modal-alert2', 'Debe seleccionar la fecha de inicio de vacaciones');
    }else if(txtarea.length > 100){
        addAlert('.modal-alert2', 'El comentario debe ser menor a 100 caracteres.!!!');
    }
  else {
    document.forms["send"].submit();
    }
  });



  $(document).on('click','#enter3', function(e){
     e.preventDefault();
    radioSeleccionado();
    var cantDias = document.getElementById('NumDay3').value;
    var FechaI = document.getElementById('pointer3').value;
    var FechaF = document.getElementById('dateF3').value;
    var txtarea = document.getElementById('comentarios3').value;

    var FechaIA = FechaI.split('/');
    var FechaFA = FechaF.split('/');
    var date_1 = new Date(FechaIA[2] + '-' + FechaIA[1] + '-' + FechaIA[0]).getTime();
    var date_2 = new Date(FechaFA[2] + '-' + FechaFA[1] + '-' + FechaFA[0]).getTime();
    var diff = date_2 - date_1;
    NumDay = diff/(1000*60*60*24) + 1;

    if(cantDias==null || cantDias== ""){
        addAlert('.modal-alert3','Debe ingresar los días de vacaciones');
    }else if(cantDias <= 0 && cantDias > 30){
        addAlert('.modal-alert3', 'Numero de dias fuera de rango');
    }else if(NumDay > cantDias && (NumDay - cantDias) >=0 && (cantDias - NumDay) <= 1 ){
        addAlert('.modal-alert3', 'Se esperaba igualdad entre el numero de Días Digitado y el rango de fechas seleccionado');
    }else if(NumDay < cantDias && (NumDay - cantDias) <=0 && (cantDias - NumDay) >= 1 ){
        addAlert('.modal-alert3', 'Se esperaba igualdad entre el numero de Días Digitado y el rango de fechas seleccionado');
    }else if(valor==null){
        addAlert('.modal-alert3', 'Debe seleccionar el tipo de vacaciones');
    } else if(FechaI==null || FechaI== ""){
        addAlert('.modal-alert3', 'Debe seleccionar la fecha de inicio de vacaciones');
    }else if(txtarea.length > 100){
        addAlert('.modal-alert3', 'El comentario debe ser menor a 100 caracteres.!!!');
    }
    else {
            document.forms["sendNew3"].submit();
        }
  });

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
          //  console.log(data);
        }
    });
}
//ListaFeriados();

/*$(document).on('click', '#ActDonar', function (e) {
    e.preventDefault();
console.log("Entra aquí");

//Mandar un mensaje de confirmación para capturar el valor y hace según 
    var act = confirm('¿Seguro que desea activar la opción de donar vacaciones en el sistema?');
    if(act) {
    e.preventDefault;
    console.log(act);
    /*$("#Donar").show();
        location.reload();*/
       // $(':radio:not(:checked)').attr('disabled', true); 
      /* function mostrar(){
        document.getElementById('oculto').style.display = 'block';}
    } else{
        $("#Donar").hide();
    }
});*/

//Clic para guardar el estado de Habilitar a través de ajax 
$(document).on('click', '#ActDonarMostar', function (e) {
        e.preventDefault();
        //Mandar un mensaje de confirmación para capturar el valor y hace según 
    var act = confirm('¿Seguro que desea activar la opción de donar vacaciones en el sistema?');
    if(act) {
        $.ajax({
            data: {}, 
            url: "?c=SaldoVacaciones&a=ActEstadoConfig",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
               // console.log(data);
            }
        });
    }return false;
});

$(document).on('click', '#ActDonarOcultar', function (e) {
    e.preventDefault();
    //Mandar un mensaje de confirmación para capturar el valor y hace según 
var act = confirm('¿Seguro que desea inhabilitar la opción de donar vacaciones en el sistema?');
if(act) {
    $.ajax({
        data: {}, 
        url: "?c=SaldoVacaciones&a=ActEstadoConfig2",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
           // console.log(data);
        }
    });
}return false;
});

