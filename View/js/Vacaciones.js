var newDay, newNes, newAnio;
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

    $('#pointer').datepicker(
        { 
           minDate: -7,
           beforeShow: function() {
           $(this).datepicker('option', 'maxDate', $('#dataF').val());
         }
                });

        $('#dataF').datepicker(
                    {
                    defaultDate: "+1w",
                    beforeShow: function() {
                    $(this).datepicker('option', 'minDate', $('#pointer').val());
        if ($('#pointer').val() === '') $(this).datepicker('option', 'minDate', 0);                             
                    }
                });
    
    /*
    $('#pointer').datepicker(
        { 
           minDate: 0,
           beforeShow: function() {
           $(this).datepicker('option', 'maxDate', $('#dateF').val());
         }
      });*/

    $('#pointer').change(function(){
        var fecha = $('#pointer').val();
        var sumar = $('#NumDay').val();
       // console.log(fecha);
        //console.log(sumar);
       // var da = new Date();
        //da.setHours(da.getDate() + sumar);
       // console.log(da);
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
       
       newMes = (fecha.getMonth() + 1);
       newDay = (fecha.getDate());
       newAnio = (fecha.getFullYear());
       
       var options = { year: 'numeric', month: 'long', day: 'numeric' };

            $('#dateF').val(fecha.toLocaleDateString("es-ES", options));
            console.log(fecha2);
            $('#pointer').val(fecha2.toLocaleDateString("es-ES", options));
            console.log($('input:radio[name=Tipo]:checked').val());
            if($('input:radio[name=Tipo]:checked').val() == 'Vacaciones'){
                var factor =  $("label[for='factor']").text();
                var saldo = parseFloat(factor) * sumar; 
                $("label[for='Saldo']").text(saldo);
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
       // console.log(fecha);
        //console.log(sumar);
       // var da = new Date();
        //da.setHours(da.getDate() + sumar);
       // console.log(da);
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
       
       newMes = (fecha.getMonth() + 1);
       newDay = (fecha.getDate());
       newAnio = (fecha.getFullYear());
       
       var options = { year: 'numeric', month: 'long', day: 'numeric' };

            $('#dateF2').val(fecha.toLocaleDateString("es-ES", options));
            console.log(fecha2);
            $('#pointer2').val(fecha2.toLocaleDateString("es-ES", options));
            console.log($('input:radio[name=Tipo]:checked').val());
            if($('input:radio[name=Tipo]:checked').val() == 'Vacaciones'){
                var factor =  $("label[for='factor']").text();
                var saldo = parseFloat(factor) * sumar; 
                $("label[for='Saldo']").text(saldo);
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
        $.ajax({
            url: "?c=Vacaciones&a=store",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            success: function(data){
                //console.log('Todo ha funcionado');
                //location.reload(true); 
            }
            });
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

