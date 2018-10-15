var Fecha1, Fecha2;
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
        
});

//Función para la carga de los valores del datatable
function sendDataAjax() {
  Fecha1 = $("#entrada").val();
  Fecha2 = $("#salida").val();
  console.log(Fecha1, Fecha2);
  var obj = JSON.stringify({ Fecha1: Fecha1, Fecha2: Fecha2 });
  if((Fecha1 != "" && Fecha1 != null) && (Fecha2 != "" && Fecha2 != null)){
    $.ajax({
      type: "POST",
      url: "?c=HisVacColaboradores&a=GenerarReporte",
      data: obj,
      dataType: 'json',
      contentType: 'application/json; charset= utf-8',
      error: function(xhr, ajaxOptions, thrownError){
          console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
      },
      success: function (data) {
          console.log(data);
          tabla = $("#tbl_Empleados_Vac").DataTable({
              "aaSorting": [[0, 'desc']]});
  for (var i = 0; i < data.length; i++) {
              
      tabla.fnAddData([
          data[i].IdVacaciones,
          (data[i].PNombre + " " + data[i].PApellido),
          data[i].Nombre,
          data[i].NombreCargo,
          (data[i].FechaI + " al " + data[i].FechaF),
          data[i].CantDias,
          data[i].Estado,
      ]);
  }
      }
  });

} else{
    alert("Debe ingresar fecha inicio y fecha final para poder generar el reporte.");
  }
  
}
//sendDataAjax();

$(document).on('click', "#btnGenerar", function (e) {
   e.preventDefault();
    sendDataAjax();
});