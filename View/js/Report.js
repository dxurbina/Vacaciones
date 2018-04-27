$(document).ready(function()
{   
    
jQuery(function($){
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
});
/*
    $("#datef").datepicker();
    $("#datei").datepicker();*/
    //$("#datei").datepicker({ appendText: ' Haga click para introducir una fecha' });
    //$("#datef").datepicker({ appendText: ' Haga click para introducir una fecha' });
  /*  var getDate = function (input) {
        return new Date(input.date.valueOf());
    }*/
    /*
    $('#entrada, #salida').datepicker({
        format: "dd/mm/yyyy",
        language: 'es'
    });*/
    var options = { year: 'numeric', month: 'long', day: 'numeric' };

    
    $( function() {
        var dateFormat = "dd/mm/yy",
          from = $( "#entrada" )
            .datepicker({
              defaultDate: "0w",
              changeMonth: true,
              numberOfMonths: 2
            })
            .on( "change", function() {
              to.datepicker( "option", "minDate", getDate( this ) );
              
            }),
          to = $( "#salida" ).datepicker({
            defaultDate: "0w",
            changeMonth: true,
            numberOfMonths: 2
          })
          .on( "change", function() {
            from.datepicker( "option", "maxDate", getDate( this ) );
          });
     
        function getDate( element ) {
          var date;
          try {
            date = $.datepicker.parseDate( dateFormat, element.value );
          } catch( error ) {
            date = null;
          }
     
          return date;
        }
      } );
      /*
      $('#entrada').datepicker( { 
        minDate: -7,
        beforeShow: function() {
        $(this).datepicker('option', 'maxDate', $('#salida').val());
      }
             });

     $('#salida').datepicker(
                 {
                 defaultDate: "+1w",
                 beforeShow: function() {
                 $(this).datepicker('option', 'minDate', $('#salida').val());
     if ($('#entrada').val() === '') $(this).datepicker('option', 'minDate', 0);                             
                 }
             });

             $('#entrada').change(function(){
              
                    
                       $('entrada').datepicker('option', 'maxDate', $('#salida').val());
                     

                
                    $('#salida').datepicker('option', 'minDate', $('#entrada').val());
                    if ($('#entrada').val() === '') $(this).datepicker('option', 'minDate', 0);                             
                    
            
        });

        $('#salida').change(function(){
            $('#salida').datepicker(
                {
                defaultDate: "+1w",
                beforeShow: function() {
                $(this).datepicker('option', 'minDate', $('#salida').val());
                if ($('#entrada').val() === '') $(this).datepicker('option', 'minDate', 0);                             
                }
        
         });
        });*/
 
 /*
    $('#entrada').datepicker(
        { 
            minDate: 0,
            beforeShow: function() {
            $(this).datepicker('option', 'maxDate', $('#salida').val());
        }
    });*/
        
    
    
});