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

  $(document).on('click','#enter', function(){

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