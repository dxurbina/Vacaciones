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

    //Datepicker con solo los meses del año, con el año actual.
    $(function() {
      $('.date-picker').datepicker( {
      closeText: 'Cerrar',
      prevText: '<Ant',
      nextText: 'Sig>',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                changeMonth: true,
                yearRange: "1900:2035",
                showButtonPanel: true,
                dateFormat: 'MM yy',
                onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
      });
  });

  $('#mes').on('click', this, function(){
    var element = $('.ui-datepicker-calendar').css({
      "display": "none"
    });
  }); 

  //Validación de los radio buton
  function validacion() {
    var rango = ($("input:radio[name=Tipo]:checked").val());
    var mes =($("input:radio[name=Tipo]:checked").val());
    
    if(rango == 'RangoFechas'){
      document.getElementById("mes").disabled = true;
      document.getElementById("entrada").disabled = false;
      document.getElementById("salida").disabled = false;
      //Si hay valor en el input habilitado lo limpia.
      document.getElementById("mes").value = "";
    }else if(mes=='Mes'){
      document.getElementById("entrada").disabled = true;
      document.getElementById("salida").disabled = true;
      document.getElementById("mes").disabled = false;
      //Si hay valor en el input habilitado lo limpia.
      document.getElementById("entrada").value = "";
      document.getElementById("salida").value = "";
    }
  }

  $("input:radio[name=Tipo]").on('click', this, function(){
    validacion();
   });

});
