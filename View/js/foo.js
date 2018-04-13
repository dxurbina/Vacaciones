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

    $('#pointer').change(function(){
        var fecha = $('#pointer').val();
        var sumar = $('#NumDay').val();
        console.log(fecha);
        console.log(sumar);
        var d = new Date(fecha);
        console.log(d);
        console.log(sumarDias(d, sumar));
        
        $('')
       
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