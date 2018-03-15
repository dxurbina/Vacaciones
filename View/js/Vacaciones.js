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
        var fecha = new Date(fecha);
        console.log(fecha);
        dia = fecha.getDate();
        mes = fecha.getMonth() + 1;
        anio = fecha.getFullYear();
        
        addTime = (sumar * 24) - 24; //Tiempo en segundos
 
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
            $('#ExtraDateIni').val(fecha.toLocaleDateString("es-ES", options));
            $('#ExtraDateIni').datepicker(
                { 
                   minDate: new Date(newAnio, newMes, newDay),
                   beforeShow: function() {
                   $(this).datepicker('option', 'maxDate', $('#dataF').val());
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