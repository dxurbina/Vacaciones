var datos;
$(document).ready(function(){
    $("#cboDepto").change(function(){
        var _Mun = $("#cboMun");
        var _select = $("#cboDepto").val();
        var obj = JSON.stringify({ id: _select });
        console.log($("#cboDepto").val());

        $.ajax({
            data: obj,
            url: "?c=Empleado&a=listarMunPorDepto",
            type: "POST",
            
            
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
           /* beforeSend: function () 
            {
                $(this).prop('disabled', true);
            },*/
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                console.log(data);
                _Mun.find('option').remove();
                $(data).each(function(i, v){ // indice, valor
    
                    _Mun.append('<option value="' + v.IdMunicipio + '">' + v.Nombre + '</option>');
                })
            }
            });
    });

    //Carga el dptoEmp, el Cargo, el jefe de ese cargo
    $("#dptoEmp").change(function(){

        var Cargo = $("#cargos");
        var _select = $("#dptoEmp").val();
        var obj = JSON.stringify({ id: _select });
        //console.log($("#desac24").val());
        $.ajax({
            data: obj,
            url: "?c=Empleado&a=showCargos",
            type: "POST",
            
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
           /* beforeSend: function () 
            {
                $("#dptoEmp").prop('disabled', true);
            },*/
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                $("#dptoEmp").prop('disabled', false);
                console.log(data);
                Cargo.find('option').remove();
                $(data).each(function(i, v){ // indice, valor

                    Cargo.append('<option value="' + v.IdCargo + '">' + v.NombreCargo + '</option>');

                })
                var cargo2 = $("#cargos");
                var _select2 = $("#cargos").val();
                var obj2 = JSON.stringify({ id: _select2 });
                $.ajax({
                    data: obj2,
                    url: "?c=Empleado&a=showJefe",
                    type: "POST",
                    dataType: 'json',
                    contentType: 'application/json; charset= utf-8',
                   /* beforeSend: function () 
                            {
                                cargo2.prop('disabled', true);
                            },*/
                    error: function(xhr, ajaxOptions, thrownError){
                        console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                    },
                    success: function (data) {
                        cargo2.prop('disabled', false);
                        //console.log(data);
                        $("#jefe").find('option').remove();
                        $(data).each(function(i, v){ // indice, valor
                            $("#jefe").append('<option value="' + v.IdEmpleado + '">' + (v.PNombre + " "+ v.PApellido ) + '</option>');
                           
                        })
                        }
                    });
            }
            });
        
        });


    $("#cargos").change(function(){
        var _Jefe = $("#jefe");
        var _select = $("#cargos").val();
        var obj = JSON.stringify({ id: _select });
       // console.log($("#desac24").val());
        $.ajax({
            data: obj,
            url: "?c=Empleado&a=showJefebyPosition", //showJefeAdd
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            /*beforeSend: function () 
            {
                $("#cargos").prop('disabled', false);
            },*/
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                $("#cargos").prop('disabled', false);
                console.log(data);
                _Jefe.find('option').remove();
                $(data).each(function(i, v){ // indice, valor

                    $("#jefe").append('<option value="' + v.IdEmpleado + '">' + (v.PNombre + " "+ v.PApellido ) + '</option>');
                })
                $.ajax({
                    data: obj,
                    url: "?c=Empleado&a=showCCostosbyId",
                    type: "POST",
                    dataType: 'json',
                    contentType: 'application/json; charset= utf-8',
                    /*beforeSend: function () 
                    {
                        $("#cargos").prop('disabled', false);
                    },*/
                    error: function(xhr, ajaxOptions, thrownError){
                        console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
                    },
                    success: function (data) {
                        console.log(data)
                        $("#cc").val(data[0].Nombre + "-" + data[0].Codigo);
                    }
                    });
            }
            });
    });

});

//Aquí empiezan las funciones que uso.
    function CargarMun(val)
    {
         //Cargar Municipios por depto
      $("#cboDepto").change(function(){
        var _Mun = $("#cboMun");
        var _select = $("#cboDepto").val();
        var obj = JSON.stringify({ id: _select });
        console.log($("#cboDepto").val());
        $.ajax({
            data: obj,
            url: "?c=Empleado&a=listarMunPorDepto",
            type: "POST",
            
            
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
           /* beforeSend: function () 
            {
                $(this).prop('disabled', true);
            },*/
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                console.log(data);
                _Mun.find('option').remove();
                $(data).each(function(i, v){ // indice, valor
    
                    _Mun.append('<option value="' + v.IdMunicipio + '">' + v.Nombre + '</option>');
                })
            }
            });
    });
    }

//Cargos por DeptoEmp
    function Cargos(val)
    {
      $("#deptoEmp").change(function(){
        var _Mun = $("#cargos");
        var _select = $("#deptoEmp").val();
        var obj = JSON.stringify({ id: _select });
        console.log($("#deptoEmp").val());
        $.ajax({
            data: obj,
            url: "?c=Empleado&a=showCargos",
            type: "POST",
            
            
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
           /* beforeSend: function () 
            {
                $(this).prop('disabled', true);
            },*/
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                console.log(data);
                _Mun.find('option').remove();
                $(data).each(function(i, v){ // indice, valor
    
                    _Mun.append('<option value="' + v.IdCargo + '">' + v.NombreCargo + '</option>');
                })
            }
            });
    });
    }
    
    //Cargar jefe por cargos  
    function loadJefe(datos){
        var _Jefe = $("#jefe");
        var _idJefe = datos[0].IdJefeE;
        var obj = JSON.stringify({ id: datos[0].IdJefeE });
        
        $.ajax({
            data: obj,
            url: "?c=Empleado&a=showJefeAdd",
            type: "POST",
            dataType: 'json',
            contentType: 'application/json; charset= utf-8',
            beforeSend: function () 
                    {
                        _Jefe.prop('disabled', true);
                    },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
            },
            success: function (data) {
                console.log(data);
                _Jefe.find('option').remove();
                $(data).each(function(i, v){ // indice, valor
                    _Jefe.append('<option value="' + v.IdEmpleado + '">' + (v.PNombre + " "+ v.SNombre ) + '</option>');
                   
                })
                var $miSelect = $('#jefe');
                console.log($miSelect);
                //console.log(datos[0].IdCargo);
               $miSelect.val($miSelect.children('option[value= ' + _idJefe + ']').val());
               
              
            }
            });
    }
//Nuevo colaborador

$('#FechaNac').datepicker(
    {  
        //minDate: ("yearRange", "-99:+0"),
        maxDate: "today",
       //minDate: -7,
       
       beforeShow: function() {
        //onSelect: ListaFeriados(),
       //$(this).datepicker('option', 'maxDate', $('#dataF').val());
         $(this).datepicker( "option", "yearRange", "-99:+0" );
       
       }
       //beforeShowDay: $.datepicker.noWeekends -> DESACTIVA LOS FINDES DE SEMANA
    });

$('#FechaIng').datepicker(
    {  
        //minDate: -7,
        beforeShow: function() {
            //onSelect: ListaFeriados(),
           //$(this).datepicker('option', 'maxDate', $('#dataF').val());
        }
           //beforeShowDay: $.datepicker.noWeekends -> DESACTIVA LOS FINDES DE SEMANA
    });
    
//Funcionalidad que valida que no se repita los datos ya registrados
$(document).on('click', '#btnRegistar', function (e) {
    e.preventDefault();
    var _select = $("#usuario").val();
    var obj = JSON.stringify({ Usuario: _select });
    flag = false;
    $.ajax({
        data: obj,
        url: "?c=Empleado&a=GetPosition",
        type: "POST",
        dataType: 'json',
        contentType: 'application/json; charset= utf-8',
        error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr.status + "\n" + xhr.responseText, "\n" + thrownError)
        },
        success: function (data) {
            console.log(data);
            $(data).each(function(i, v){ // indice, valor
                if(v.Usuario == _select){
                    flag = true;
                }
            })
            if(flag == false){
                if(_select.length > 3 && _select.length < 20){
                    //document.send.submit()   
                    document.forms["send"].submit();
                    //$("#imodalEmpacept").modal("show");
                }else{
                    alert('Dato no esperado');
                }
            }else{
                alert("Este nombre de usuario ya existe, favor ingresar otro.");
            }


        }
    });
});